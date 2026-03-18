<?php
require_once '../../config/database.php';
require_once '../../config/admin-config.php';

requireLogin(); // Just need to be logged in, no edit rights

$conn = getDB();
$projects = $conn->query("SELECT * FROM projects");
$team = $conn->query("SELECT * FROM team");
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Only - SDC2</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="p-8">
        <h1 class="text-2xl font-bold mb-4">Content Viewer</h1>
        <p class="text-gray-600 mb-6">You have read-only access</p>
        
        <div class="grid grid-cols-2 gap-6">
            <div class="bg-white p-4 rounded shadow">
                <h2 class="font-bold mb-2">Projects (<?php echo $projects->num_rows; ?>)</h2>
                <ul class="list-disc pl-5">
                    <?php while($p = $projects->fetch_assoc()): ?>
                    <li><?php echo $p['title']; ?></li>
                    <?php endwhile; ?>
                </ul>
            </div>
            
            <div class="bg-white p-4 rounded shadow">
                <h2 class="font-bold mb-2">Team (<?php echo $team->num_rows; ?>)</h2>
                <ul class="list-disc pl-5">
                    <?php while($t = $team->fetch_assoc()): ?>
                    <li><?php echo $t['name']; ?> - <?php echo $t['position']; ?></li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>