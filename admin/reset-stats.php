<?php
require_once '../../config/database.php';
require_once '../../config/admin-config.php';

requireAdmin();

$conn = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
    $conn->query("TRUNCATE TABLE page_views");
    $conn->query("TRUNCATE TABLE daily_stats");
    $_SESSION['message'] = "Statistics reset successfully!";
    header('Location: stats.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Stats - SDC2 Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-2xl shadow-lg max-w-md w-full">
            <h1 class="text-2xl font-bold text-red-600 mb-4">Reset Statistics</h1>
            <p class="text-gray-600 mb-6">Are you sure you want to delete all page view data? This action cannot be undone.</p>
            
            <form method="POST">
                <div class="flex gap-4">
                    <button type="submit" name="confirm" 
                            class="flex-1 bg-red-600 text-white py-2 rounded-lg hover:bg-red-700">
                        Yes, Reset All
                    </button>
                    <a href="stats.php" 
                       class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400 text-center">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>