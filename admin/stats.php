<?php
$page_title = 'Site Statistics';

// Include header
include 'header.php';

// Include sidebar
include 'includes/sidebar.php';

require_once '../config/database.php';
require_once '../config/admin-config.php';
require_once '../includes/tracker.php';

requireLogin();

$total_views = getTotalViews();
$total_visitors = getTotalUniqueVisitors();
$today = getViewsToday();
$week = getViewsThisWeek();
$month = getViewsThisMonth();
$popular_pages = getPopularPages();
$daily_stats = getViewsByDay(14); // Last 14 days
?>

<!-- Main Content -->
<div class="flex-1 p-8 ml-64 overflow-y-auto" 
     x-data="{
        dailyStats: <?php echo json_encode($daily_stats); ?>,
        initChart() {
            const ctx = document.getElementById('viewsChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: this.dailyStats.map(s => s.view_date),
                    datasets: [{
                        label: 'Total Views',
                        data: this.dailyStats.map(s => s.total_views),
                        borderColor: '#1a4d3e',
                        backgroundColor: 'rgba(26, 77, 62, 0.1)',
                        tension: 0.4,
                        fill: true
                    }, {
                        label: 'Unique Visitors',
                        data: this.dailyStats.map(s => s.unique_visitors),
                        borderColor: '#c95c0e',
                        backgroundColor: 'rgba(201, 92, 14, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }
     }"
     x-init="initChart()">
    
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-[#1a4d3e]">Site Statistics</h1>
            <p class="text-gray-600 mt-1">Track your website traffic and visitor analytics</p>
        </div>
        
        <!-- Date Range (optional) -->
        <div class="bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-200 text-sm text-gray-600">
            <i class="fa-regular fa-calendar mr-2 text-[#c95c0e]"></i>
            Last 30 days
        </div>
    </div>
    
    <!-- Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Views -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-eye text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Total Views</p>
                    <p class="text-2xl font-bold text-[#1a4d3e]"><?php echo number_format($total_views); ?></p>
                </div>
            </div>
        </div>
        
        <!-- Unique Visitors -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-users text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Unique Visitors</p>
                    <p class="text-2xl font-bold text-[#1a4d3e]"><?php echo number_format($total_visitors); ?></p>
                </div>
            </div>
        </div>
        
        <!-- Today -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-calendar-day text-[#1a4d3e] text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Today</p>
                    <p class="text-2xl font-bold text-[#1a4d3e]"><?php echo $today['total_views']; ?></p>
                    <p class="text-xs text-gray-500"><?php echo $today['unique_visitors']; ?> unique</p>
                </div>
            </div>
        </div>
        
        <!-- This Month -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-chart-line text-[#c95c0e] text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">This Month</p>
                    <p class="text-2xl font-bold text-[#1a4d3e]"><?php echo number_format($month['total'] ?? 0); ?></p>
                    <p class="text-xs text-gray-500"><?php echo number_format($month['unique_total'] ?? 0); ?> unique</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Chart -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-200">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold text-[#1a4d3e]">Last 14 Days Activity</h2>
            <div class="flex gap-3 text-xs">
                <span class="flex items-center"><span class="w-3 h-3 bg-[#1a4d3e] rounded-full mr-1"></span> Views</span>
                <span class="flex items-center"><span class="w-3 h-3 bg-[#c95c0e] rounded-full mr-1"></span> Unique</span>
            </div>
        </div>
        <div class="h-80">
            <canvas id="viewsChart"></canvas>
        </div>
    </div>
    
    <!-- Bottom Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Popular Pages -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
            <h2 class="text-lg font-bold mb-4 text-[#1a4d3e] flex items-center">
                <i class="fa-solid fa-fire text-[#c95c0e] mr-2"></i>
                Popular Pages (Last 30 Days)
            </h2>
            <div class="space-y-3">
                <?php if(!empty($popular_pages)): ?>
                    <?php foreach($popular_pages as $page): ?>
                    <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-lg transition-colors">
                        <span class="capitalize font-medium"><?php echo str_replace('.php', '', $page['page']); ?></span>
                        <span class="bg-[#1a4d3e] text-white px-3 py-1 rounded-full text-sm"><?php echo $page['views']; ?> views</span>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-8">
                        <i class="fa-solid fa-chart-simple text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">No data available yet</p>
                        <p class="text-xs text-gray-400 mt-1">Start tracking by visiting your website</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Recent Stats Table -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
            <h2 class="text-lg font-bold mb-4 text-[#1a4d3e] flex items-center">
                <i class="fa-solid fa-table text-[#c95c0e] mr-2"></i>
                Daily Breakdown (Last 7 Days)
            </h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="p-3 text-left text-sm font-semibold text-gray-600">Date</th>
                            <th class="p-3 text-left text-sm font-semibold text-gray-600">Views</th>
                            <th class="p-3 text-left text-sm font-semibold text-gray-600">Unique</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $recent_stats = array_slice($daily_stats, -7);
                        foreach($recent_stats as $stat): 
                        ?>
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="p-3 text-sm"><?php echo date('M d, Y', strtotime($stat['view_date'])); ?></td>
                            <td class="p-3 text-sm font-medium"><?php echo $stat['total_views']; ?></td>
                            <td class="p-3 text-sm"><?php echo $stat['unique_visitors']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <?php if(empty($daily_stats)): ?>
                        <tr>
                            <td colspan="3" class="p-8 text-center text-gray-500">
                                <i class="fa-regular fa-calendar-xmark text-3xl text-gray-300 mb-2"></i>
                                <p>No data available</p>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Summary -->
            <?php if(!empty($daily_stats)): ?>
            <div class="mt-4 pt-4 border-t border-gray-200 grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">Total (7 days)</p>
                    <p class="text-xl font-bold text-[#1a4d3e]">
                        <?php 
                        $week_total = array_sum(array_column($recent_stats, 'total_views'));
                        echo $week_total;
                        ?>
                    </p>
                </div>
                <div>
                    <p class="text-gray-500">Avg. per day</p>
                    <p class="text-xl font-bold text-[#1a4d3e]">
                        <?php echo round($week_total / count($recent_stats)); ?>
                    </p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Reset Stats (Admin only) -->
    <?php if(isAdmin()): ?>
    <div class="mt-6 bg-yellow-50 p-6 rounded-xl border border-yellow-200">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-triangle-exclamation text-yellow-600"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-yellow-800">Reset Statistics</h4>
                    <p class="text-sm text-yellow-600">This will permanently delete all page view data. This action cannot be undone.</p>
                </div>
            </div>
            <button onclick="if(confirm('⚠️ WARNING: Are you absolutely sure? This will delete ALL statistics permanently.')) window.location.href='reset-stats.php'"
                    class="bg-yellow-600 text-white px-6 py-3 rounded-lg hover:bg-yellow-700 transition-colors font-medium">
                <i class="fa-solid fa-rotate-left mr-2"></i> Reset All Stats
            </button>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Info Card -->
    <div class="mt-6 bg-blue-50 p-4 rounded-xl border border-blue-200">
        <h4 class="font-semibold text-blue-800 text-sm mb-2 flex items-center">
            <i class="fa-solid fa-circle-info mr-2"></i>
            About Statistics:
        </h4>
        <ul class="text-xs text-blue-700 space-y-1 list-disc list-inside grid md:grid-cols-2">
            <li><strong>Total Views:</strong> Every page load counts as a view</li>
            <li><strong>Unique Visitors:</strong> Based on anonymized IP addresses (last octet removed)</li>
            <li><strong>Daily stats update</strong> in real-time as visitors browse</li>
            <li>Popular pages show which content is most viewed</li>
            <li>Data is stored for historical trending</li>
        </ul>
    </div>
</div>
