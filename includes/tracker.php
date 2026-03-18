<?php
require_once  __DIR__ . '/../config/database.php';
function trackPageView($page_name = '') {
    
    $conn = getDB();
    
    // Get page name
    if (empty($page_name)) {
        $page_name = basename($_SERVER['PHP_SELF']);
    }
    
    // Get visitor IP (anonymized for privacy)
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    // Anonymize IP (remove last octet)
    $ip_parts = explode('.', $ip);
    if (count($ip_parts) == 4) {
        $ip_parts[3] = '0';
        $ip = implode('.', $ip_parts);
    }
    
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $today = date('Y-m-d');
    
    // Insert page view
    $stmt = $conn->prepare("INSERT INTO page_views (page, visitor_ip, user_agent) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $page_name, $ip, $user_agent);
    $stmt->execute();
    
    // Check if this IP has visited today
    $check = $conn->prepare("SELECT id FROM page_views WHERE visitor_ip = ? AND DATE(viewed_at) = ? LIMIT 1");
    $check->bind_param("ss", $ip, $today);
    $check->execute();
    $result = $check->get_result();
    $is_new_visitor = $result->num_rows === 1; // First visit today
    
    // Update daily stats
    $stmt = $conn->prepare("INSERT INTO daily_stats (view_date, total_views, unique_visitors) 
                           VALUES (?, 1, ?) 
                           ON DUPLICATE KEY UPDATE 
                           total_views = total_views + 1,
                           unique_visitors = unique_visitors + ?");
    $unique_increment = $is_new_visitor ? 1 : 0;
    $stmt->bind_param("sii", $today, $unique_increment, $unique_increment);
    $stmt->execute();
}

function getTotalViews() {
    $conn = getDB();
    $result = $conn->query("SELECT SUM(total_views) as total FROM daily_stats");
    $row = $result->fetch_assoc();
    return $row['total'] ?? 0;
}

function getTotalUniqueVisitors() {
    $conn = getDB();
    $result = $conn->query("SELECT SUM(unique_visitors) as total FROM daily_stats");
    $row = $result->fetch_assoc();
    return $row['total'] ?? 0;
}

function getViewsToday() {
    $conn = getDB();
    $today = date('Y-m-d');
    $result = $conn->query("SELECT total_views, unique_visitors FROM daily_stats WHERE view_date = '$today'");
    return $result->fetch_assoc() ?: ['total_views' => 0, 'unique_visitors' => 0];
}

function getViewsThisWeek() {
    $conn = getDB();
    $week_ago = date('Y-m-d', strtotime('-7 days'));
    $result = $conn->query("SELECT SUM(total_views) as total, SUM(unique_visitors) as unique_total 
                           FROM daily_stats WHERE view_date >= '$week_ago'");
    return $result->fetch_assoc();
}

function getViewsThisMonth() {
    $conn = getDB();
    $month_start = date('Y-m-01');
    $result = $conn->query("SELECT SUM(total_views) as total, SUM(unique_visitors) as unique_total 
                           FROM daily_stats WHERE view_date >= '$month_start'");
    return $result->fetch_assoc();
}

function getPopularPages($limit = 5) {
    $conn = getDB();
    $result = $conn->query("SELECT page, COUNT(*) as views 
                           FROM page_views 
                           WHERE viewed_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
                           GROUP BY page 
                           ORDER BY views DESC 
                           LIMIT $limit");
    $pages = [];
    while($row = $result->fetch_assoc()) {
        $pages[] = $row;
    }
    return $pages;
}

function getViewsByDay($days = 7) {
    $conn = getDB();
    $result = $conn->query("SELECT view_date, total_views, unique_visitors 
                           FROM daily_stats 
                           ORDER BY view_date DESC 
                           LIMIT $days");
    $stats = [];
    while($row = $result->fetch_assoc()) {
        $stats[] = $row;
    }
    return array_reverse($stats);
}
?>