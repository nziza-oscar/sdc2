<?php


// If already logged in, redirect to dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

require_once '../config/database.php';
require_once '../config/admin-config.php';

$error = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password';
    } else {
        $conn = getDB();
        $stmt = $conn->prepare("SELECT id, username, password, full_name, email, role FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                // Set session variables
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_name'] = $row['full_name'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_role'] = $row['role'];
                
                // Redirect to dashboard
                header('Location: dashboard.php');
                exit;
            } else {
                $error = 'Invalid password';
            }
        } else {
            $error = 'User not found';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - SDC2</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-[#1a4d3e] min-h-screen flex items-center justify-center p-4">
    <!-- Simple Background Pattern -->
    <div class="absolute inset-0 overflow-hidden opacity-5">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-white rounded-full"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-white rounded-full"></div>
    </div>
    
    <div class="relative w-full max-w-md">
        <!-- Logo or Brand -->
        <div class="text-center mb-6">
            <div class="inline-block p-4 bg-white rounded-2xl shadow-lg mb-4">
                <i class="fa-solid fa-hard-hat text-[#1a4d3e] text-4xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-white">SDC2 Admin</h1>
            <p class="text-white/80 mt-1">Sustainable Design & Construction</p>
        </div>
        
        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-[#1a4d3e]">Welcome Back</h2>
                <p class="text-gray-600 text-sm mt-1">Please login to your account</p>
            </div>
            
            <?php if ($error): ?>
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 flex items-start">
                    <i class="fa-solid fa-circle-exclamation mt-0.5 mr-3"></i>
                    <span><?php echo htmlspecialchars($error); ?></span>
                </div>
            <?php endif; ?>
            
            <form method="POST" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user mr-2 text-[#c95c0e]"></i>Username
                    </label>
                    <input type="text" 
                           name="username" 
                           value="<?php echo htmlspecialchars($username); ?>"
                           required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1a4d3e] focus:border-transparent transition-all"
                           placeholder="Enter your username">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-shield mr-2 text-[#c95c0e]"></i>Password
                    </label>
                    <input type="password" 
                           name="password" 
                           required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1a4d3e] focus:border-transparent transition-all"
                           placeholder="Enter your password">
                </div>
                
              
                
                <button type="submit" 
                        class="w-full bg-[#1a4d3e] text-white py-3 rounded-lg font-semibold hover:bg-[#c95c0e] transition-all duration-300">
                    <i class="fas fa-arrow-right-to-bracket mr-2"></i>
                    Login
                </button>
            </form>
            
          
            
            <!-- Footer -->
            <div class="mt-6 text-center text-xs text-gray-500">
                <p>&copy; <?php echo date('Y'); ?> SDC2. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>