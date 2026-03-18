<?php
require_once '../../config/database.php';
require_once '../../config/admin-config.php';

requireEdit();

$conn = getDB();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sections = ['mission', 'vision'];
    foreach ($sections as $section) {
        if (isset($_POST[$section])) {
            $stmt = $conn->prepare("UPDATE company_info SET content=?, updated_by=? WHERE section=?");
            $stmt->bind_param("sis", $_POST[$section], $_SESSION['user_id'], $section);
            $stmt->execute();
        }
    }
    $message = "Mission & Vision updated!";
}

$content = [];
$result = $conn->query("SELECT section, content FROM company_info WHERE section IN ('mission', 'vision')");
while($row = $result->fetch_assoc()) {
    $content[$row['section']] = $row['content'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mission & Vision - SDC2 Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <?php include '../includes/sidebar.php'; ?>
        
        <div class="flex-1 p-8 ml-64" x-data="{ 
            mission: `<?php echo addslashes($content['mission'] ?? ''); ?>`,
            vision: `<?php echo addslashes($content['vision'] ?? ''); ?>`
        }">
            <h1 class="text-3xl font-bold text-[#1a4d3e] mb-6">Mission & Vision</h1>
            
            <?php if ($message): ?>
                <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4"><?php echo $message; ?></div>
            <?php endif; ?>
            
            <form method="POST" class="space-y-6">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <label class="block text-lg font-bold mb-2">
                        <i class="fa-solid fa-bullseye text-[#c95c0e] mr-2"></i> Mission Statement
                    </label>
                    <textarea name="mission" x-model="mission" rows="4" 
                              class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-[#1a4d3e]"
                              placeholder="What is your company's mission?"></textarea>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <label class="block text-lg font-bold mb-2">
                        <i class="fa-solid fa-eye text-[#c95c0e] mr-2"></i> Vision Statement
                    </label>
                    <textarea name="vision" x-model="vision" rows="4" 
                              class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-[#1a4d3e]"
                              placeholder="What is your company's vision?"></textarea>
                </div>
                
                <button type="submit" class="bg-[#1a4d3e] text-white px-8 py-3 rounded-xl hover:bg-[#c95c0e]">
                    <i class="fa-solid fa-save mr-2"></i> Save Changes
                </button>
            </form>
        </div>
    </div>
</body>
</html>