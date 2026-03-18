<?php
$page_title = 'Dashboard';

include 'header.php';
// Include sidebar
include 'includes/sidebar.php';

// Now get dashboard-specific data
$conn = getDB(); // $conn is available from header

// Get counts
$projects = $conn->query("SELECT COUNT(*) as count FROM projects")->fetch_assoc()['count'];
$team = $conn->query("SELECT COUNT(*) as count FROM team")->fetch_assoc()['count'];
$users = $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];
$services = $conn->query("SELECT COUNT(*) as count FROM services")->fetch_assoc()['count'];
$values = $conn->query("SELECT COUNT(*) as count FROM core_values")->fetch_assoc()['count'];

// Get stats for today
$today_views = getViewsToday();
$total_views = getTotalViews();

// Get recent activity if admin
$recent = [];
if (isAdmin()) {
    $recent = $conn->query("
        (SELECT 'project' as type, title as name, created_at, 'added' as action FROM projects)
        UNION 
        (SELECT 'team' as type, name, created_at, 'added' as action FROM team)
        UNION
        (SELECT 'user' as type, username, created_at, 'joined' as action FROM users)
        ORDER BY created_at DESC LIMIT 5
    ");
}

?>

<!-- Main Content - This is the ONLY part that goes inside the main area -->
<div class="flex-1 p-8 overflow-y-auto" x-data="{ showWelcome: true }">
    <!-- Welcome Banner -->
    <div x-show="showWelcome" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-90"
         x-transition:enter-end="opacity-100 transform scale-100"
         class="bg-gradient-to-r from-[#1a4d3e] to-[#c95c0e] text-white p-6 rounded-2xl mb-6 flex justify-between items-center shadow-lg">
        <div>
            <h1 class="text-2xl font-bold">Welcome back, <?php echo htmlspecialchars($user_name); ?>! 👋</h1>
            <p class="opacity-90"><?php echo date('l, F j, Y'); ?></p>
        </div>
        <div class="flex items-center space-x-3">
            <span class="bg-white/20 px-3 py-1 rounded-full text-sm">
                <i class="fa-regular fa-calendar mr-1"></i> <?php echo date('H:i'); ?>
            </span>
            <button @click="showWelcome = false" class="text-white/70 hover:text-white transition-colors">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
    </div>
    
    <?php if (isset($_GET['error']) && $_GET['error'] === 'unauthorized'): ?>
        <div class="bg-red-100 border-l-4 border-red-600 text-red-700 p-4 rounded-lg mb-4 flex items-center">
            <i class="fa-solid fa-exclamation-circle mr-3 text-red-600"></i>
            <span>You don't have permission to access that page.</span>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['message'])): ?>
        <div class="bg-green-100 border-l-4 border-green-600 text-green-700 p-4 rounded-lg mb-4 flex items-center justify-between">
            <div class="flex items-center">
                <i class="fa-solid fa-check-circle mr-3 text-green-600"></i>
                <span><?php echo $_SESSION['message']; ?></span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Projects Card -->
        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Total Projects</p>
                    <p class="text-3xl font-bold text-[#1a4d3e]"><?php echo $projects; ?>/5</p>
                </div>
                <div class="w-14 h-14 bg-[#1a4d3e]/10 rounded-2xl flex items-center justify-center">
                    <i class="fa-solid fa-folder-open text-[#1a4d3e] text-2xl"></i>
                </div>
            </div>
            <div class="mt-3 w-full bg-gray-200 rounded-full h-1.5">
                <div class="bg-[#1a4d3e] h-1.5 rounded-full" style="width: <?php echo ($projects/5)*100; ?>%"></div>
            </div>
        </div>
        
        <!-- Team Card -->
        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Team Members</p>
                    <p class="text-3xl font-bold text-[#1a4d3e]"><?php echo $team; ?>/5</p>
                </div>
                <div class="w-14 h-14 bg-[#1a4d3e]/10 rounded-2xl flex items-center justify-center">
                    <i class="fa-solid fa-users text-[#1a4d3e] text-2xl"></i>
                </div>
            </div>
            <div class="mt-3 w-full bg-gray-200 rounded-full h-1.5">
                <div class="bg-[#1a4d3e] h-1.5 rounded-full" style="width: <?php echo ($team/5)*100; ?>%"></div>
            </div>
        </div>
        
        <!-- Services Card -->
        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Services</p>
                    <p class="text-3xl font-bold text-[#1a4d3e]"><?php echo $services; ?></p>
                </div>
                <div class="w-14 h-14 bg-[#1a4d3e]/10 rounded-2xl flex items-center justify-center">
                    <i class="fa-solid fa-wrench text-[#1a4d3e] text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Core Values Card -->
        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Core Values</p>
                    <p class="text-3xl font-bold text-[#1a4d3e]"><?php echo $values; ?></p>
                </div>
                <div class="w-14 h-14 bg-[#1a4d3e]/10 rounded-2xl flex items-center justify-center">
                    <i class="fa-solid fa-heart text-[#1a4d3e] text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Second Row Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <?php if (isAdmin()): ?>
        <div class="bg-white p-6 rounded-2xl shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">System Users</p>
                    <p class="text-2xl font-bold text-[#c95c0e]"><?php echo $users; ?></p>
                </div>
                <div class="w-12 h-12 bg-[#c95c0e]/10 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-user-lock text-[#c95c0e] text-xl"></i>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <div class="bg-white p-6 rounded-2xl shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Today's Views</p>
                    <p class="text-2xl font-bold text-[#c95c0e]"><?php echo $today_views['total_views']; ?></p>
                </div>
                <div class="w-12 h-12 bg-[#c95c0e]/10 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-eye text-[#c95c0e] text-xl"></i>
                </div>
            </div>
            <div class="mt-2 text-xs text-gray-500">
                <?php echo $today_views['unique_visitors']; ?> unique
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-2xl shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Total Views</p>
                    <p class="text-2xl font-bold text-[#c95c0e]"><?php echo number_format($total_views); ?></p>
                </div>
                <div class="w-12 h-12 bg-[#c95c0e]/10 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-chart-line text-[#c95c0e] text-xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Activity -->
    <?php if (isAdmin() && $recent && $recent->num_rows > 0): ?>
    <div class="bg-white p-6 rounded-2xl shadow">
        <h2 class="text-lg font-bold mb-4 flex items-center">
            <i class="fa-solid fa-clock-rotate-left text-[#c95c0e] mr-2"></i>
            Recent Activity
        </h2>
        <div class="space-y-3">
            <?php while($row = $recent->fetch_assoc()): ?>
            <div class="flex items-center justify-between border-b pb-2">
                <div class="flex items-center">
                    <?php 
                    $icon = $row['type'] == 'project' ? 'fa-folder-open' : ($row['type'] == 'team' ? 'fa-user' : 'fa-user-lock');
                    $color = $row['type'] == 'project' ? 'text-blue-600' : ($row['type'] == 'team' ? 'text-green-600' : 'text-purple-600');
                    ?>
                    <i class="fa-solid <?php echo $icon; ?> <?php echo $color; ?> mr-3"></i>
                    <div>
                        <p class="text-sm">
                            <span class="font-medium"><?php echo htmlspecialchars($row['name']); ?></span>
                            <span class="text-gray-500"> was <?php echo $row['action']; ?></span>
                        </p>
                        <p class="text-xs text-gray-400">
                            <?php echo date('M d, Y H:i', strtotime($row['created_at'])); ?>
                        </p>
                    </div>
                </div>
                <span class="text-xs capitalize bg-gray-100 px-2 py-1 rounded-full">
                    <?php echo $row['type']; ?>
                </span>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
