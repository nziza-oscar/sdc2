<?php
$page_title = 'My Profile';

// Include header
include 'header.php';

// Include sidebar
include 'includes/sidebar.php';

require_once '../config/database.php';
require_once '../config/admin-config.php';

requireLogin();

$conn = getDB();
$message = '';
$error = '';

// Get current user data
$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM users WHERE id = $user_id");
$user = $result->fetch_assoc();

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    
    $stmt = $conn->prepare("UPDATE users SET full_name = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $full_name, $email, $user_id);
    
    if ($stmt->execute()) {
        $_SESSION['user_name'] = $full_name;
        $_SESSION['user_email'] = $email;
        $_SESSION['message'] = "Profile updated successfully!";
        header('Location: profile.php');
        exit;
    } else {
        $error = "Error updating profile.";
    }
}

// Handle password change
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Verify current password
    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_data = $result->fetch_assoc();
    
    if (!password_verify($current_password, $user_data['password'])) {
        $error = "Current password is incorrect.";
    } elseif (strlen($new_password) < 6) {
        $error = "New password must be at least 6 characters.";
    } elseif ($new_password !== $confirm_password) {
        $error = "New passwords do not match.";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $hashed_password, $user_id);
        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Password changed successfully!";
            header('Location: profile.php');
            exit;
        } else {
            $error = "Error changing password.";
        }
    }
}

// Check for session message
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

// Get user initials
$name_parts = explode(' ', $user['full_name']);
$initials = '';
foreach ($name_parts as $part) {
    $initials .= strtoupper(substr($part, 0, 1));
}
if (strlen($initials) > 2) {
    $initials = substr($initials, 0, 2);
}
?>

<!-- Main Content -->
<div class="flex-1 p-8  overflow-y-auto">
    
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-[#1a4d3e]">My Profile</h1>
    </div>
    
    <!-- Success Message -->
    <?php if ($message): ?>
    <div class="bg-green-100 border-l-4 border-green-600 text-green-700 p-4 rounded-lg mb-4 flex justify-between items-center">
        <div class="flex items-center">
            <i class="fa-solid fa-circle-check mr-3 text-green-600"></i>
            <span><?php echo $message; ?></span>
        </div>
        <button onclick="this.parentElement.remove()"><i class="fa-solid fa-times"></i></button>
    </div>
    <?php endif; ?>
    
    <!-- Error Message -->
    <?php if ($error): ?>
    <div class="bg-red-100 border-l-4 border-red-600 text-red-700 p-4 rounded-lg mb-4 flex items-center">
        <i class="fa-solid fa-exclamation-circle mr-3 text-red-600"></i>
        <span><?php echo $error; ?></span>
    </div>
    <?php endif; ?>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Info Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
                <div class="text-center">
                    <!-- Avatar -->
                    <div class="w-24 h-24 bg-[#1a4d3e] rounded-full flex items-center justify-center mx-auto mb-4 text-white text-3xl font-bold">
                        <?php echo $initials ?: 'U'; ?>
                    </div>
                    
                    <h2 class="text-xl font-bold text-[#1a4d3e]"><?php echo htmlspecialchars($user['full_name']); ?></h2>
                    <p class="text-[#c95c0e] mb-3"><?php echo ucfirst($user['role']); ?></p>
                    
                    <div class="border-t border-gray-200 pt-4 mt-2 text-left">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-500">Username</span>
                            <span class="font-medium"><?php echo htmlspecialchars($user['username']); ?></span>
                        </div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-500">Email</span>
                            <span class="font-medium"><?php echo htmlspecialchars($user['email']); ?></span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Member since</span>
                            <span class="font-medium"><?php echo date('M d, Y', strtotime($user['created_at'])); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Edit Profile Form -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Profile Information -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
                <h2 class="text-lg font-bold mb-4 text-[#1a4d3e]">Edit Profile</h2>
                
                <form method="POST">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1a4d3e] focus:border-transparent bg-white">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1a4d3e] focus:border-transparent bg-white">
                        </div>
                        
                        <button type="submit" name="update_profile" 
                                class="bg-[#1a4d3e] text-white px-6 py-3 rounded-xl hover:bg-[#c95c0e] transition-colors font-medium">
                            <i class="fa-solid fa-save mr-2"></i> Update Profile
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Change Password -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
                <h2 class="text-lg font-bold mb-4 text-[#1a4d3e]">Change Password</h2>
                
                <form method="POST">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                            <input type="password" name="current_password" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1a4d3e] focus:border-transparent bg-white">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                            <input type="password" name="new_password" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1a4d3e] focus:border-transparent bg-white">
                            <p class="text-xs text-gray-500 mt-1">Minimum 6 characters</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                            <input type="password" name="confirm_password" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1a4d3e] focus:border-transparent bg-white">
                        </div>
                        
                        <button type="submit" name="change_password" 
                                class="bg-[#1a4d3e] text-white px-6 py-3 rounded-xl hover:bg-[#c95c0e] transition-colors font-medium">
                            <i class="fa-solid fa-key mr-2"></i> Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
