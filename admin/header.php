<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/admin-config.php';
require_once __DIR__ . '/../includes/tracker.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'] ?? 0;
$user_name = $_SESSION['user_name'] ?? 'User';
$user_role = $_SESSION['user_role'] ?? 'editor';
$user_email = $_SESSION['user_email'] ?? '';

$current_page = basename($_SERVER['PHP_SELF']);

$conn = getDB();

$res1 = $conn->query("SELECT COUNT(*) as count FROM projects");
$pending_projects = $res1 ? $res1->fetch_assoc()['count'] : 0;

$res2 = $conn->query("SELECT COUNT(*) as count FROM team");
$pending_team = $res2 ? $res2->fetch_assoc()['count'] : 0;

$total_pending = 0;

$name_parts = explode(' ', $user_name);
$initials = '';
foreach ($name_parts as $part) {
    $initials .= strtoupper(substr($part, 0, 1));
}
if (strlen($initials) > 2) {
    $initials = substr($initials, 0, 2);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - SDC2 Admin' : 'SDC2 Admin Panel'; ?></title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

    <style>
       
        /* Custom height for CKEditor */
        .ck-editor__editable_inline {
            min-height: 250px;
        }
        /* Fix for CKEditor list styling in Tailwind environments */
        .ck-content ul {
            list-style-type: disc !important;
            padding-left: 2rem !important;
        }
        .ck-content ol {
            list-style-type: decimal !important;
            padding-left: 2rem !important;
        }

[x-cloak]{display:none;}
body{
    background:#fff;
    font-family:"Poppins",sans-serif;
}
</style>

 <!-- Custom Admin CSS -->
    <style>
        /* Custom scrollbar for webkit browsers */
        [x-cloak]{
            display:none;
        }
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #1a4d3e;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #c95c0e;
        }
        
        /* Smooth transitions */
        .transition-all {
            transition: all 0.3s ease;
        }
        
        /* Card hover effects */
        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        /* Loading animation */
        .loader {
            border: 3px solid #f3f3f3;
            border-radius: 50%;
            border-top: 3px solid #c95c0e;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            animation: slideIn 0.3s ease;
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        /* Dropdown animation */
        .dropdown-enter-active {
            animation: dropdownIn 0.2s ease;
        }
        
        @keyframes dropdownIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
       

    </style>
</head>

<body class="bg-gray-100"
      x-data="{sidebarOpen:true,profileDropdown:false,loading:false,search:''}"
      @click.away="profileDropdown=false">

<div x-show="loading" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center" x-cloak>
    <div class="w-10 h-10 border-4 border-gray-200 border-t-[#c95c0e] rounded-full animate-spin"></div>
</div>

<div class="lg:ml-64">
<nav class="py-3">
<div class="flex justify-between items-center px-6">

<div class="flex items-center flex-1">
<button @click="sidebarOpen=!sidebarOpen" class="text-gray-500 mr-4 lg:hidden">
<i class="fas fa-bars text-xl"></i>
</button>

<h1 class="text-xl font-semibold text-[#1a4d3e] hidden md:block">
<?php echo isset($page_title) ? $page_title : 'Dashboard'; ?>
</h1>

<div class="ml-6 hidden lg:block relative">
<i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
<input type="text" x-model="search" placeholder="Search..."
class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg text-sm w-64">
</div>
</div>

<div class="flex items-center space-x-4">

<div class="relative" x-data="{open:false}">
<button @click="open=!open" class="p-2 text-gray-500 hover:text-[#1a4d3e] rounded-full">
<i class="fas fa-bell text-xl"></i>
</button>

<div x-show="open" @click.away="open=false" x-cloak
class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow border z-50">
<div class="p-4 border-b"><h3 class="font-semibold">Notifications</h3></div>

<div class="p-4 border-b">
<p class="text-sm font-medium">New project added</p>
<p class="text-xs text-gray-500">2 minutes ago</p>
</div>

<div class="p-4 border-b">
<p class="text-sm font-medium">Team updated</p>
<p class="text-xs text-gray-500">1 hour ago</p>
</div>

<div class="p-4">
<p class="text-sm font-medium">Stats updated</p>
<p class="text-xs text-gray-500">3 hours ago</p>
</div>
</div>
</div>

<button class="p-2 text-gray-500 hover:text-[#1a4d3e] rounded-full hidden sm:block">
<i class="fas fa-envelope text-xl"></i>
</button>

<div class="relative">
<button @click="profileDropdown=!profileDropdown" class="flex items-center space-x-3">

<div class="w-10 h-10 bg-[#1a4d3e] rounded-full flex items-center justify-center text-white font-semibold text-sm">
<?php echo $initials ?: 'U'; ?>
</div>

<div class="hidden md:block text-left">
<p class="text-sm font-medium"><?php echo $user_name; ?></p>
<p class="text-xs text-gray-500"><?php echo $user_role; ?></p>
</div>

<i class="fas fa-chevron-down text-xs"></i>
</button>

<div x-show="profileDropdown" x-cloak @click.away="profileDropdown=false"
class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow border z-50">

<div class="p-4 border-b bg-gray-50">
<div class="flex items-center space-x-3">

<div class="w-12 h-12 bg-[#1a4d3e] rounded-full flex items-center justify-center text-white font-bold">
<?php echo $initials ?: 'U'; ?>
</div>

<div>
<p class="font-semibold"><?php echo $user_name; ?></p>
<p class="text-xs text-gray-600"><?php echo $user_email; ?></p>
</div>

</div>
</div>

<div class="p-2">

<a href="profile.php" class="flex items-center px-4 py-2 hover:bg-gray-50">
<i class="fas fa-user w-6 text-[#1a4d3e]"></i>
<span>Profile</span>
</a>


<?php if (isAdmin()): ?>
<a href="users.php" class="flex items-center px-4 py-2 hover:bg-gray-50">
<i class="fas fa-user-lock w-6 text-[#1a4d3e]"></i>
<span>Users</span>
</a>
<?php endif; ?>

<a href="stats.php" class="flex items-center px-4 py-2 hover:bg-gray-50">
<i class="fas fa-chart-line w-6 text-[#1a4d3e]"></i>
<span>Analytics</span>
</a>

<hr class="my-2">

<a href="logout.php" class="flex items-center px-4 py-2 text-red-600 hover:bg-red-50">
<i class="fas fa-sign-out-alt w-6"></i>
<span>Logout</span>
</a>

</div>

</div>
</div>

</div>
</div>
</nav>
</div>

<div class="h-16"></div>

<div class="flex">