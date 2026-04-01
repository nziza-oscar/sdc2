<?php
$page_title = 'Manage Users';

// Include header
include 'header.php';

// Include sidebar
include 'includes/sidebar.php';

require_once '../config/database.php';
require_once '../config/admin-config.php';

requireAdmin();

$conn = getDB();
$message = '';
$error = '';

// Handle add user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = trim($_POST['email']);
    $full_name = trim($_POST['full_name']);
    $role = $_POST['role'];
    
    $stmt = $conn->prepare("INSERT INTO users (username, password, email, full_name, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $password, $email, $full_name, $role);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "User added successfully!";
        echo "<script>window.location.href='users.php';</script>";
        exit;
    } else {
        $error = "Username already exists!";
    }
}

// Handle delete user
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if ($id != $_SESSION['user_id']) {
        $conn->query("DELETE FROM users WHERE id = $id");
        $_SESSION['message'] = "User deleted!";
    } else {
        $_SESSION['error'] = "You cannot delete your own account!";
    }
    echo "<script>window.location.href='users.php';</script>";
    exit;
}

// Handle role update
if (isset($_POST['update_role'])) {
    $id = $_POST['user_id'];
    $role = $_POST['role'];
    $stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
    $stmt->bind_param("si", $role, $id);
    $stmt->execute();
    $_SESSION['message'] = "Role updated!";
    echo "<script>window.location.href='users.php';</script>";
    exit;
}
// Get all users
$users = $conn->query("SELECT * FROM users ORDER BY role, username");

// Check for session messages
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>

<!-- Main Content -->
<div class="flex-1 p-8  overflow-y-auto" 
     x-data="{ 
        showForm: false,
        newUser: {
            username: '',
            password: '',
            email: '',
            full_name: '',
            role: 'editor'
        }
     }">
    
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-[#1a4d3e]">Manage Users</h1>
            <p class="text-gray-600 mt-1">Add, edit, and manage system users</p>
        </div>
        
        <button @click="showForm = !showForm" 
                class="bg-[#1a4d3e] text-white px-4 py-2 rounded-lg hover:bg-[#c95c0e] transition-colors flex items-center">
            <i class="fa-solid fa-plus mr-2"></i>
            <span x-text="showForm ? 'Cancel' : 'Add User'"></span>
        </button>
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
    
    <!-- Add User Form -->
    <div x-show="showForm" x-cloak x-transition class="bg-white rounded-2xl shadow-lg p-6 mb-6 border-2 border-[#c95c0e]">
        <h2 class="text-lg font-bold mb-4">Add New User</h2>
        
        <form method="POST">
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                    <input type="text" name="username" x-model="newUser.username" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1a4d3e] bg-white">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" x-model="newUser.password" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1a4d3e] bg-white">
                </div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input type="text" name="full_name" x-model="newUser.full_name" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1a4d3e] bg-white">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" x-model="newUser.email" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1a4d3e] bg-white">
                </div>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                <select name="role" x-model="newUser.role" class="w-full md:w-64 px-4 py-3 border border-gray-300 rounded-xl bg-white">
                    <option value="admin">Admin</option>
                    <option value="editor">Editor</option>
                    <option value="viewer">Viewer</option>
                </select>
            </div>
            
            <button type="submit" name="add" 
                    class="bg-[#1a4d3e] text-white px-6 py-3 rounded-xl hover:bg-[#c95c0e] transition-colors">
                <i class="fa-solid fa-save mr-2"></i> Add User
            </button>
        </form>
    </div>
    
    <!-- Users List -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="p-4 text-left text-sm font-semibold text-gray-600">User</th>
                    <th class="p-4 text-left text-sm font-semibold text-gray-600">Username</th>
                    <th class="p-4 text-left text-sm font-semibold text-gray-600">Email</th>
                    <th class="p-4 text-left text-sm font-semibold text-gray-600">Role</th>
                    <th class="p-4 text-left text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($user = $users->fetch_assoc()): ?>
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="p-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-[#1a4d3e] rounded-full flex items-center justify-center text-white text-sm font-bold mr-3">
                                <?php 
                                $name_parts = explode(' ', $user['full_name']);
                                $initials = '';
                                foreach ($name_parts as $part) {
                                    $initials .= strtoupper(substr($part, 0, 1));
                                }
                                echo substr($initials, 0, 2);
                                ?>
                            </div>
                            <span class="font-medium"><?php echo htmlspecialchars($user['full_name']); ?></span>
                        </div>
                    </td>
                    <td class="p-4"><?php echo htmlspecialchars($user['username']); ?></td>
                    <td class="p-4"><?php echo htmlspecialchars($user['email']); ?></td>
                    <td class="p-4">
                        <?php if ($user['id'] == $_SESSION['user_id']): ?>
                            <span class="bg-[#c95c0e] text-white px-3 py-1 rounded-full text-xs">
                                <?php echo ucfirst($user['role']); ?> (you)
                            </span>
                        <?php else: ?>
                            <form method="POST" class="inline">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                <select name="role" onchange="this.form.submit()" 
                                        class="border border-gray-300 rounded-lg px-3 py-1 text-sm bg-white">
                                    <option value="admin" <?php echo $user['role']=='admin'?'selected':''; ?>>Admin</option>
                                    <option value="editor" <?php echo $user['role']=='editor'?'selected':''; ?>>Editor</option>
                                    <option value="viewer" <?php echo $user['role']=='viewer'?'selected':''; ?>>Viewer</option>
                                </select>
                                <input type="hidden" name="update_role" value="1">
                            </form>
                        <?php endif; ?>
                    </td>
                    <td class="p-4">
                        <?php if ($user['id'] != $_SESSION['user_id']): ?>
                            <a href="?delete=<?php echo $user['id']; ?>" 
                               onclick="return confirm('Delete this user?')"
                               class="text-red-500 hover:text-red-700">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
                
                <?php if ($users->num_rows == 0): ?>
                <tr>
                    <td colspan="5" class="p-8 text-center text-gray-500">
                        <i class="fa-solid fa-users-slash text-3xl text-gray-300 mb-2"></i>
                        <p>No users found</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Role Descriptions -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-blue-50 p-4 rounded-xl border border-blue-200">
            <h4 class="font-bold text-blue-800 mb-1">Admin</h4>
            <p class="text-xs text-blue-700">Full access - can manage users, edit content, and view everything</p>
        </div>
        <div class="bg-green-50 p-4 rounded-xl border border-green-200">
            <h4 class="font-bold text-green-800 mb-1"> Editor</h4>
            <p class="text-xs text-green-700">Can edit all content but cannot manage users</p>
        </div>
        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
            <h4 class="font-bold text-gray-800 mb-1">Viewer</h4>
            <p class="text-xs text-gray-700">Read-only access - can view but not edit</p>
        </div>
    </div>
</div>
