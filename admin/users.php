<?php
require_once '../../config/database.php';
require_once '../../config/admin-config.php';

requireAdmin();

$conn = getDB();
$message = '';
$error = '';

// Handle add user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $role = $_POST['role'];
    
    $stmt = $conn->prepare("INSERT INTO users (username, password, email, full_name, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $password, $email, $full_name, $role);
    
    if ($stmt->execute()) {
        $message = "User added successfully!";
    } else {
        $error = "Username already exists!";
    }
}

// Handle delete user
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if ($id != $_SESSION['user_id']) { // Can't delete yourself
        $conn->query("DELETE FROM users WHERE id = $id");
        $message = "User deleted!";
    } else {
        $error = "You cannot delete your own account!";
    }
}

// Handle role update
if (isset($_POST['update_role'])) {
    $id = $_POST['user_id'];
    $role = $_POST['role'];
    $stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
    $stmt->bind_param("si", $role, $id);
    $stmt->execute();
    $message = "Role updated!";
}

$users = $conn->query("SELECT * FROM users ORDER BY role, username");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - SDC2 Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-[#1a4d3e] text-white">
            <div class="p-6"><h2 class="text-xl font-bold">SDC2 Admin</h2></div>
            <nav class="mt-6">
                <a href="../dashboard.php" class="block py-3 px-6 hover:bg-[#c95c0e]">Dashboard</a>
                <a href="contact.php" class="block py-3 px-6 hover:bg-[#c95c0e]">Contact</a>
                <a href="about.php" class="block py-3 px-6 hover:bg-[#c95c0e]">About</a>
                <a href="projects.php" class="block py-3 px-6 hover:bg-[#c95c0e]">Projects</a>
                <a href="team.php" class="block py-3 px-6 hover:bg-[#c95c0e]">Team</a>
                <a href="users.php" class="block py-3 px-6 bg-[#c95c0e]">Users</a>
            </nav>
            <div class="absolute bottom-0 w-64 p-6">
                <a href="../logout.php" class="block text-center py-2 bg-red-600 rounded">Logout</a>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 p-8 overflow-y-auto">
            <h1 class="text-2xl font-bold mb-6">Manage Users</h1>
            
            <?php if ($message): ?>
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4"><?php echo $message; ?></div>
            <?php endif; ?>
            <?php if ($error): ?>
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <!-- Add User Form -->
            <div class="bg-white p-6 rounded-2xl shadow mb-6">
                <h2 class="text-lg font-bold mb-4">Add New User</h2>
                <form method="POST">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <input type="text" name="username" placeholder="Username" required 
                               class="p-2 border rounded">
                        <input type="password" name="password" placeholder="Password" required 
                               class="p-2 border rounded">
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <input type="email" name="email" placeholder="Email" required 
                               class="p-2 border rounded">
                        <input type="text" name="full_name" placeholder="Full Name" required 
                               class="p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <select name="role" class="p-2 border rounded">
                            <option value="admin">Admin</option>
                            <option value="editor" selected>Editor</option>
                            <option value="viewer">Viewer</option>
                        </select>
                    </div>
                    <button type="submit" name="add" class="bg-[#1a4d3e] text-white px-6 py-2 rounded">
                        Add User
                    </button>
                </form>
            </div>
            
            <!-- Users List -->
            <div class="bg-white rounded-2xl shadow">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="p-3 text-left">Username</th>
                            <th class="p-3 text-left">Full Name</th>
                            <th class="p-3 text-left">Email</th>
                            <th class="p-3 text-left">Role</th>
                            <th class="p-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($user = $users->fetch_assoc()): ?>
                        <tr class="border-b">
                            <td class="p-3"><?php echo $user['username']; ?></td>
                            <td class="p-3"><?php echo $user['full_name']; ?></td>
                            <td class="p-3"><?php echo $user['email']; ?></td>
                            <td class="p-3">
                                <?php if ($user['id'] != $_SESSION['user_id']): ?>
                                <form method="POST" class="inline">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <select name="role" onchange="this.form.submit()" class="border rounded p-1">
                                        <option value="admin" <?php echo $user['role']=='admin'?'selected':''; ?>>Admin</option>
                                        <option value="editor" <?php echo $user['role']=='editor'?'selected':''; ?>>Editor</option>
                                        <option value="viewer" <?php echo $user['role']=='viewer'?'selected':''; ?>>Viewer</option>
                                    </select>
                                    <input type="hidden" name="update_role" value="1">
                                </form>
                                <?php else: ?>
                                    <span class="bg-[#c95c0e] text-white px-2 py-1 rounded text-sm">
                                        <?php echo $user['role']; ?> (you)
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="p-3">
                                <?php if ($user['id'] != $_SESSION['user_id']): ?>
                                <a href="?delete=<?php echo $user['id']; ?>" 
                                   onclick="return confirm('Delete this user?')"
                                   class="text-red-500 hover:text-red-700">
                                    Delete
                                </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>