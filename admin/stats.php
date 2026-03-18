<?php
require_once '../../config/database.php';
require_once '../../config/admin-config.php';
require_once '../../includes/tracker.php';

requireLogin();

$total_views = getTotalViews();
$total_visitors = getTotalUniqueVisitors();
$today = getViewsToday();
$week = getViewsThisWeek();
$month = getViewsThisMonth();
$popular_pages = getPopularPages();
$daily_stats = getViewsByDay(14); // Last 14 days
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Statistics - SDC2 Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <?php include '../includes/sidebar.php'; ?>
        
        <div class="flex-1 p-8 ml-64" x-data="{
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
        }" x-init="initChart()">
            
            <h1 class="text-3xl font-bold text-[#1a4d3e] mb-6">Site Statistics</h1>
            
            <!-- Overview Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-eye text-blue-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Total Views</p>
                            <p class="text-2xl font-bold"><?php echo number_format($total_views); ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-users text-green-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Unique Visitors</p>
                            <p class="text-2xl font-bold"><?php echo number_format($total_visitors); ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-[#1a4d3e]/10 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-calendar-day text-[#1a4d3e] text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Today</p>
                            <p class="text-2xl font-bold"><?php echo $today['total_views']; ?></p>
                            <p class="text-xs text-gray-500"><?php echo $today['unique_visitors']; ?> unique</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-[#c95c0e]/10 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-chart-line text-[#c95c0e] text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">This Month</p>
                            <p class="text-2xl font-bold"><?php echo number_format($month['total'] ?? 0); ?></p>
                            <p class="text-xs text-gray-500"><?php echo number_format($month['unique_total'] ?? 0); ?> unique</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Chart -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                <h2 class="text-lg font-bold mb-4">Last 14 Days Activity</h2>
                <div class="h-80">
                    <canvas id="viewsChart"></canvas>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Popular Pages -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-lg font-bold mb-4">Popular Pages (Last 30 Days)</h2>
                    <div class="space-y-3">
                        <?php foreach($popular_pages as $page): ?>
                        <div class="flex items-center">
                            <span class="flex-1 capitalize"><?php echo str_replace('.php', '', $page['page']); ?></span>
                            <span class="bg-[#1a4d3e] text-white px-3 py-1 rounded-full text-sm"><?php echo $page['views']; ?> views</span>
                        </div>
                        <?php endforeach; ?>
                        
                        <?php if(empty($popular_pages)): ?>
                        <p class="text-gray-500 text-center py-4">No data yet</p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Recent Stats Table -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-lg font-bold mb-4">Daily Breakdown</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="p-3 text-left text-sm">Date</th>
                                    <th class="p-3 text-left text-sm">Views</th>
                                    <th class="p-3 text-left text-sm">Unique</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach(array_slice($daily_stats, -7) as $stat): ?>
                                <tr class="border-b">
                                    <td class="p-3 text-sm"><?php echo date('M d, Y', strtotime($stat['view_date'])); ?></td>
                                    <td class="p-3 text-sm font-medium"><?php echo $stat['total_views']; ?></td>
                                    <td class="p-3 text-sm"><?php echo $stat['unique_visitors']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                                
                                <?php if(empty($daily_stats)): ?>
                                <tr>
                                    <td colspan="3" class="p-6 text-center text-gray-500">No data available</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Reset Stats (Admin only) -->
            <?php if(isAdmin()): ?>
            <div class="mt-6 bg-yellow-50 p-4 rounded-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="font-semibold text-yellow-800">Reset Statistics</h4>
                        <p class="text-sm text-yellow-600">Clear all page view data (cannot be undone)</p>
                    </div>
                    <button onclick="if(confirm('Are you sure? This will delete all stats permanently.')) window.location.href='reset-stats.php'"
                            class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700">
                        Reset Stats
                    </button>
                </div>
            </div>
            <?php endif; ?>
            
        </div>
    </div>
</body>
</html>