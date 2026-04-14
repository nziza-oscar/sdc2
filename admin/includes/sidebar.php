<?php
// Get current page for active state
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!-- Reusable Sidebar Component -->
<div class="w-64 bg-[#1a4d3e] text-white flex flex-col h-screen fixed left-0 top-0">
    <!-- Logo & User Info -->
    <div class="p-6 border-b border-[#c95c0e]/30">
        <h2 class="text-xl font-bold">SDC2 Admin</h2>
        <p class="text-sm text-gray-300 mt-1 flex items-center">
            <i class="fa-regular fa-circle-user mr-2"></i>
            <?php echo $_SESSION['user_name'] ?? 'User'; ?>
            <span class="bg-[#c95c0e] text-xs px-2 py-0.5 rounded-full ml-2">
                <?php echo $_SESSION['user_role'] ?? 'editor'; ?>
            </span>
        </p>
    </div>
    
    <!-- Navigation -->
    <nav class="flex-1 mt-4 overflow-y-auto pb-20">
        <!-- Main Dashboard -->
        <a href="../dashboard.php" 
           class="flex items-center py-3 px-6 hover:bg-[#c95c0e] transition-colors <?php echo ($current_page == 'dashboard.php') ? 'bg-[#c95c0e]' : ''; ?>">
            <i class="fa-solid fa-dashboard mr-3 w-5"></i> Dashboard
        </a>
        
        <?php if (canEdit()): ?>
        <!-- Content Management Section -->
        <div class="mt-4 mb-1 px-6 text-xs text-gray-400 uppercase tracking-wider font-semibold">Content</div>
         <a href="create-welcome.php" 
           class="flex items-center py-3 px-6 hover:bg-[#c95c0e] transition-colors <?php echo ($current_page == 'welcome.php') ? 'bg-[#c95c0e]' : ''; ?>">
            <i class="fa-solid fa-address-book mr-3 w-5"></i> Welcome Info
        </a>
        
        <a href="contact.php" 
           class="flex items-center py-3 px-6 hover:bg-[#c95c0e] transition-colors <?php echo ($current_page == 'contact.php') ? 'bg-[#c95c0e]' : ''; ?>">
            <i class="fa-solid fa-address-book mr-3 w-5"></i> Contact Info
        </a>
        
        <a href="about.php" 
           class="flex items-center py-3 px-6 hover:bg-[#c95c0e] transition-colors <?php echo ($current_page == 'about.php') ? 'bg-[#c95c0e]' : ''; ?>">
            <i class="fa-solid fa-building mr-3 w-5"></i> About Us
        </a>
        
        <a href="mission.php" 
           class="flex items-center py-3 px-6 hover:bg-[#c95c0e] transition-colors <?php echo ($current_page == 'mission.php') ? 'bg-[#c95c0e]' : ''; ?>">
            <i class="fa-solid fa-bullseye mr-3 w-5"></i> Mission & Vision
        </a>
        
        <a href="values.php" 
           class="flex items-center py-3 px-6 hover:bg-[#c95c0e] transition-colors <?php echo ($current_page == 'values.php') ? 'bg-[#c95c0e]' : ''; ?>">
            <i class="fa-solid fa-heart mr-3 w-5"></i> Core Values
        </a>
        
        <a href="services.php" 
           class="flex items-center py-3 px-6 hover:bg-[#c95c0e] transition-colors <?php echo ($current_page == 'services.php') ? 'bg-[#c95c0e]' : ''; ?>">
            <i class="fa-solid fa-wrench mr-3 w-5"></i> Services
        </a>
        
        <a href="projects.php" 
           class="flex items-center py-3 px-6 hover:bg-[#c95c0e] transition-colors <?php echo ($current_page == 'projects.php') ? 'bg-[#c95c0e]' : ''; ?>">
            <i class="fa-solid fa-folder-open mr-3 w-5"></i> Projects
        </a>
        
        <a href="team.php" 
           class="flex items-center py-3 px-6 hover:bg-[#c95c0e] transition-colors <?php echo ($current_page == 'team.php') ? 'bg-[#c95c0e]' : ''; ?>">
            <i class="fa-solid fa-users mr-3 w-5"></i> Team Members
        </a>
        <?php endif; ?>
        
        <!-- Analytics Section - Visible to all logged in users -->
        <div class="mt-4 mb-1 px-6 text-xs text-gray-400 uppercase tracking-wider font-semibold">Analytics</div>
        
        <a href="stats.php" 
           class="flex items-center py-3 px-6 hover:bg-[#c95c0e] transition-colors <?php echo ($current_page == 'stats.php') ? 'bg-[#c95c0e]' : ''; ?>">
            <i class="fa-solid fa-chart-simple mr-3 w-5"></i> Site Statistics
        </a>
        
        <?php if (isAdmin()): ?>
        <!-- Administration Section - Admin only -->
        <div class="mt-4 mb-1 px-6 text-xs text-gray-400 uppercase tracking-wider font-semibold">Administration</div>
        
        <a href="users.php" 
           class="flex items-center py-3 px-6 hover:bg-[#c95c0e] transition-colors <?php echo ($current_page == 'users.php') ? 'bg-[#c95c0e]' : ''; ?>">
            <i class="fa-solid fa-user-lock mr-3 w-5"></i> Manage Users
        </a>
        
        <a href="settings.php" 
           class="flex items-center py-3 px-6 hover:bg-[#c95c0e] transition-colors <?php echo ($current_page == 'settings.php') ? 'bg-[#c95c0e]' : ''; ?>">
            <i class="fa-solid fa-gear mr-3 w-5"></i> Settings
        </a>
        <?php endif; ?>
    </nav>
    
    <!-- User Menu at Bottom -->
    <div class="absolute bottom-0 left-0 right-0 p-4 bg-[#1a4d3e] border-t border-[#c95c0e]/30">
        <!-- Quick Stats Preview (optional) -->
        <div class="mb-3 px-2 text-xs text-gray-300 flex justify-between">
            <span><i class="fa-regular fa-clock mr-1"></i> <?php echo date('M d, Y'); ?></span>
            <?php if (isAdmin()): ?>
            <span><i class="fa-regular fa-eye mr-1"></i> <a href="stats.php" class="hover:text-white">Views</a></span>
            <?php endif; ?>
        </div>
        
        <!-- Logout Button -->
        <a href="../logout.php" 
           class="flex items-center justify-center w-full py-2.5 bg-red-600 rounded-lg hover:bg-red-700 transition-colors font-medium">
            <i class="fa-solid fa-sign-out-alt mr-2"></i> Logout
        </a>
    </div>
</div>

<!-- Spacer for fixed sidebar -->
<div class="ml-64"></div>

<!-- Mobile menu toggle for small screens (optional) -->
<style>
@media (max-width: 768px) {
    .ml-64 {
        margin-left: 0;
    }
    .w-64 {a
        width: 0;
        display: none;
    }
}
</style>