<?php

// Require database and config
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/admin-config.php';
require_once __DIR__ . '/../includes/tracker.php';

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Get current user info
$user_id = $_SESSION['user_id'] ?? 0;
$user_name = $_SESSION['user_name'] ?? 'User';
$user_role = $_SESSION['user_role'] ?? 'editor';
$user_email = $_SESSION['user_email'] ?? '';

// Get current page for active states
$current_page = basename($_SERVER['PHP_SELF']);

// Get unread notifications or pending items (optional)
$conn = getDB();
$pending_projects = $conn->query("SELECT COUNT(*) as count FROM projects WHERE 1=1")->fetch_assoc()['count'];
$pending_team = $conn->query("SELECT COUNT(*) as count FROM team WHERE 1=1")->fetch_assoc()['count'];
$total_pending = 0; // You can customize this based on your needs

// Get user avatar initials
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
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
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
        
        /* Toast notification styles */
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
        
        /* User avatar */
        .user-avatar {
            background: linear-gradient(135deg, #1a4d3e 0%, #c95c0e 100%);
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased" 
      x-data="{ 
          sidebarOpen: true,
          profileDropdown: false,
          notifications: false,
          darkMode: false,
          loading: false,
          search: ''
      }"
      :class="{ 'dark': darkMode }"
      @click.away="profileDropdown = false">
      
    <!-- Loading Overlay -->
    <div x-show="loading" 
         class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center"
         x-cloak>
        <div class="loader"></div>
    </div>
    
    <!-- Top Navigation Bar -->
    <nav class="bg-white shadow-sm fixed top-0 right-0 left-64 z-30 h-16">
        <div class="flex justify-between items-center h-full px-6">
            <!-- Left side - Page title and search (optional) -->
            <div class="flex items-center flex-1">
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-[#1a4d3e] mr-4 lg:hidden">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <h1 class="text-xl font-semibold text-[#1a4d3e] hidden md:block">
                    <?php echo isset($page_title) ? $page_title : 'Dashboard'; ?>
                </h1>
                
                <!-- Search Bar (optional) -->
                <div class="ml-6 hidden lg:block relative">
                    <i class="fa-solid fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" 
                           x-model="search"
                           placeholder="Search..." 
                           class="pl-10 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-[#1a4d3e] focus:ring-1 focus:ring-[#1a4d3e] w-64">
                </div>
            </div>
            
            <!-- Right side - Icons and Profile -->
            <div class="flex items-center space-x-4">
                <!-- Notifications -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="relative p-2 text-gray-500 hover:text-[#1a4d3e] hover:bg-gray-100 rounded-full transition-colors">
                        <i class="fa-regular fa-bell text-xl"></i>
                        <?php if($total_pending > 0): ?>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        <?php endif; ?>
                    </button>
                    
                    <!-- Notifications Dropdown -->
                    <div x-show="open" 
                         @click.away="open = false"
                         x-cloak
                         class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl border z-50 dropdown-enter-active">
                        <div class="p-4 border-b">
                            <h3 class="font-semibold">Notifications</h3>
                        </div>
                        <div class="max-h-96 overflow-y-auto">
                            <div class="p-4 hover:bg-gray-50 border-b">
                                <p class="text-sm font-medium">New project added</p>
                                <p class="text-xs text-gray-500 mt-1">2 minutes ago</p>
                            </div>
                            <div class="p-4 hover:bg-gray-50 border-b">
                                <p class="text-sm font-medium">Team member updated</p>
                                <p class="text-xs text-gray-500 mt-1">1 hour ago</p>
                            </div>
                            <div class="p-4 hover:bg-gray-50">
                                <p class="text-sm font-medium">Website statistics updated</p>
                                <p class="text-xs text-gray-500 mt-1">3 hours ago</p>
                            </div>
                        </div>
                        <div class="p-3 border-t text-center">
                            <a href="#" class="text-sm text-[#c95c0e] hover:text-[#1a4d3e]">View all</a>
                        </div>
                    </div>
                </div>
                
                <!-- Messages (optional) -->
                <button class="relative p-2 text-gray-500 hover:text-[#1a4d3e] hover:bg-gray-100 rounded-full transition-colors hidden sm:block">
                    <i class="fa-regular fa-envelope text-xl"></i>
                </button>
                
                <!-- Profile Dropdown -->
                <div class="relative">
                    <button @click="profileDropdown = !profileDropdown" 
                            class="flex items-center space-x-3 focus:outline-none group">
                        <!-- User Avatar with Initials -->
                        <div class="w-10 h-10 user-avatar rounded-full flex items-center justify-center text-white font-semibold text-sm shadow-md group-hover:shadow-lg transition-shadow">
                            <?php echo $initials ?: 'U'; ?>
                        </div>
                        <div class="hidden md:block text-left">
                            <p class="text-sm font-medium text-gray-700 group-hover:text-[#1a4d3e]"><?php echo $user_name; ?></p>
                            <p class="text-xs text-gray-500 capitalize"><?php echo $user_role; ?></p>
                        </div>
                        <i class="fa-solid fa-chevron-down text-xs text-gray-500 group-hover:text-[#1a4d3e]" 
                           :class="{ 'rotate-180': profileDropdown }"></i>
                    </button>
                    
                    <!-- Profile Dropdown Menu -->
                    <div x-show="profileDropdown" 
                         x-cloak
                         @click.away="profileDropdown = false"
                         class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-xl border z-50 dropdown-enter-active">
                        
                        <!-- User Info -->
                        <div class="p-4 border-b bg-gradient-to-r from-[#1a4d3e]/5 to-[#c95c0e]/5">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 user-avatar rounded-full flex items-center justify-center text-white font-bold text-lg">
                                    <?php echo $initials ?: 'U'; ?>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800"><?php echo $user_name; ?></p>
                                    <p class="text-xs text-gray-600"><?php echo $user_email ?: 'user@sdc2.rw'; ?></p>
                                    <span class="inline-block mt-1 px-2 py-0.5 bg-[#c95c0e] text-white text-xs rounded-full capitalize">
                                        <?php echo $user_role; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Menu Items -->
                        <div class="p-2">
                            <a href="profile.php" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                                <i class="fa-regular fa-user w-6 text-[#1a4d3e]"></i>
                                <span class="text-sm">My Profile</span>
                            </a>
                            
                            <a href="settings.php" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                                <i class="fa-regular fa-gear w-6 text-[#1a4d3e]"></i>
                                <span class="text-sm">Settings</span>
                            </a>
                            
                            <hr class="my-2">
                            
                            <?php if (isAdmin()): ?>
                            <a href="sections/users.php" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                                <i class="fa-regular fa-user-lock w-6 text-[#1a4d3e]"></i>
                                <span class="text-sm">User Management</span>
                            </a>
                            <?php endif; ?>
                            
                            <a href="sections/stats.php" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                                <i class="fa-regular fa-chart-line w-6 text-[#1a4d3e]"></i>
                                <span class="text-sm">Analytics</span>
                            </a>
                            
                            <hr class="my-2">
                            
                            <a href="logout.php" class="flex items-center px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                <i class="fa-regular fa-sign-out-alt w-6"></i>
                                <span class="text-sm">Logout</span>
                            </a>
                        </div>
                        
                        <!-- Footer -->
                        <div class="p-3 border-t bg-gray-50 rounded-b-lg">
                            <p class="text-xs text-gray-500 text-center">
                                SDC2 Admin v1.0
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Spacer for fixed navbar -->
    <div class="h-16"></div>
    
    <!-- Main content wrapper (will be closed in footer) -->
    <div class="flex">
        <!-- Sidebar will be included separately -->