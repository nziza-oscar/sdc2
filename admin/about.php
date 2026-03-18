<?php
require_once '../../config/database.php';
require_once '../../config/admin-config.php';

requireEdit();

$conn = getDB();
$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sections = ['about', 'story', 'drive'];
    foreach ($sections as $section) {
        if (isset($_POST[$section])) {
            $stmt = $conn->prepare("UPDATE company_info SET content=?, updated_by=? WHERE section=?");
            $stmt->bind_param("sis", $_POST[$section], $_SESSION['user_id'], $section);
            $stmt->execute();
        }
    }
    $message = "About page updated successfully!";
}

// Get current content
$content = [];
$result = $conn->query("SELECT section, content FROM company_info WHERE section IN ('about', 'story', 'drive')");
while($row = $result->fetch_assoc()) {
    $content[$row['section']] = $row['content'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - SDC2 Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <?php include '../includes/sidebar.php'; ?>
        
        <div class="flex-1 p-8 ml-64" x-data="{ 
            about: '<?php echo addslashes($content['about'] ?? ''); ?>',
            story: '<?php echo addslashes($content['story'] ?? ''); ?>',
            drive: '<?php echo addslashes($content['drive'] ?? ''); ?>',
            wordCount(text) {
                return text.trim() ? text.trim().split(/\s+/).length : 0;
            }
        }">
            <h1 class="text-3xl font-bold text-[#1a4d3e] mb-6">About Us</h1>
            
            <?php if ($message): ?>
                <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4"><?php echo $message; ?></div>
            <?php endif; ?>
            
            <form method="POST" class="space-y-6">
                <!-- About Section -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <label class="block text-lg font-bold mb-2">About Us</label>
                    <p class="text-sm text-gray-500 mb-2" x-text="wordCount(about) + ' words'"></p>
                    <textarea name="about" x-model="about" rows="6" 
                              class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-[#1a4d3e]"
                              placeholder="Write about your company..."></textarea>
                </div>
                
                <!-- Our Story -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <label class="block text-lg font-bold mb-2">Our Story</label>
                    <p class="text-sm text-gray-500 mb-2" x-text="wordCount(story) + ' words'"></p>
                    <textarea name="story" x-model="story" rows="4" 
                              class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-[#1a4d3e]"
                              placeholder="Tell your company story..."></textarea>
                </div>
                
                <!-- What Drives Us -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <label class="block text-lg font-bold mb-2">What Drives Us</label>
                    <p class="text-sm text-gray-500 mb-2" x-text="wordCount(drive) + ' words'"></p>
                    <textarea name="drive" x-model="drive" rows="4" 
                              class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-[#1a4d3e]"
                              placeholder="What motivates your team..."></textarea>
                </div>
                
                <button type="submit" class="bg-[#1a4d3e] text-white px-8 py-3 rounded-xl hover:bg-[#c95c0e]">
                    <i class="fa-solid fa-save mr-2"></i> Save All Changes
                </button>
            </form>
        </div>
    </div>
</body>
</html>