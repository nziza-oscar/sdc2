<?php
$page_title = 'About Us';

// Include header
include 'header.php';

// Include sidebar
include 'includes/sidebar.php';

require_once '../config/database.php';
require_once '../config/admin-config.php';

requireEdit();

$conn = getDB();
$message = '';
$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sections = ['about', 'story', 'drive'];
    $success = true;
    
    foreach ($sections as $section) {
        if (isset($_POST[$section])) {
            $stmt = $conn->prepare("UPDATE company_info SET content=?, updated_by=? WHERE section=?");
            $stmt->bind_param("sis", $_POST[$section], $_SESSION['user_id'], $section);
            if (!$stmt->execute()) {
                $success = false;
            }
        }
    }
    
    if ($success) {
        $_SESSION['message'] = "About page updated successfully!";
        header('Location: about.php');
        exit;
    } else {
        $error = "Error updating content.";
    }
}

// Get current content
$content = [];
$result = $conn->query("SELECT section, content FROM company_info WHERE section IN ('about', 'story', 'drive')");
while($row = $result->fetch_assoc()) {
    $content[$row['section']] = $row['content'];
}

// Check for session message
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<!-- Main Content -->
<div class="flex-1 p-8 overflow-y-auto" 
     x-data="{ 
        about: <?php echo json_encode($content['about'] ?? ''); ?>,
        story: <?php echo json_encode($content['story'] ?? ''); ?>,
        drive: <?php echo json_encode($content['drive'] ?? ''); ?>,
        wordCount(text) {
            if (!text) return 0;
            return text.trim() ? text.trim().split(/\s+/).length : 0;
        }
     }">
    
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-[#1a4d3e]">About Us</h1>
            <p class="text-gray-600 mt-1">Manage your company information, story, and motivation</p>
        </div>
    </div>
    
    <!-- Success Message -->
    <?php if ($message): ?>
    <div class="bg-green-100 border-l-4 border-green-600 text-green-700 p-4 rounded-lg mb-4 flex items-center justify-between">
        <div class="flex items-center">
            <i class="fa-solid fa-circle-check mr-3 text-green-600"></i>
            <span><?php echo $message; ?></span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
            <i class="fa-solid fa-times"></i>
        </button>
    </div>
    <?php endif; ?>
    
    <!-- Error Message -->
    <?php if ($error): ?>
    <div class="bg-red-100 border-l-4 border-red-600 text-red-700 p-4 rounded-lg mb-4 flex items-center">
        <i class="fa-solid fa-exclamation-circle mr-3 text-red-600"></i>
        <span><?php echo $error; ?></span>
    </div>
    <?php endif; ?>
    
    <!-- Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-blue-50 p-3 rounded-lg flex items-center">
            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                <i class="fa-solid fa-info text-white text-sm"></i>
            </div>
            <div>
                <p class="text-xs text-gray-600">About Section</p>
                <p class="text-sm font-semibold" x-text="wordCount(about) + ' words'"></p>
            </div>
        </div>
        <div class="bg-green-50 p-3 rounded-lg flex items-center">
            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mr-3">
                <i class="fa-solid fa-book-open text-white text-sm"></i>
            </div>
            <div>
                <p class="text-xs text-gray-600">Our Story</p>
                <p class="text-sm font-semibold" x-text="wordCount(story) + ' words'"></p>
            </div>
        </div>
        <div class="bg-purple-50 p-3 rounded-lg flex items-center">
            <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center mr-3">
                <i class="fa-solid fa-fire text-white text-sm"></i>
            </div>
            <div>
                <p class="text-xs text-gray-600">What Drives Us</p>
                <p class="text-sm font-semibold" x-text="wordCount(drive) + ' words'"></p>
            </div>
        </div>
    </div>
    
    <!-- Main Form -->
    <form method="POST" class="space-y-6">
        <!-- About Section -->
        <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <label class="text-lg font-bold text-[#1a4d3e] flex items-center">
                    <i class="fa-solid fa-building mr-2 text-[#c95c0e]"></i>
                    About Us
                </label>
                <span class="text-xs bg-gray-100 px-2 py-1 rounded-full" x-text="wordCount(about) + ' words'"></span>
            </div>
            <textarea name="about" x-model="about" rows="6" 
                      class="w-full p-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1a4d3e] focus:border-transparent resize-y"
                      placeholder="Write about your company... e.g., We are a sustainable design and construction consultancy dedicated to creating eco-friendly, innovative spaces in Rwanda and across East Africa."></textarea>
            <p class="text-xs text-gray-500 mt-2">
                <i class="fa-regular fa-circle-info mr-1"></i>
                Describe your company's mission, expertise, and what makes you unique.
            </p>
        </div>
        
        <!-- Our Story -->
        <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <label class="text-lg font-bold text-[#1a4d3e] flex items-center">
                    <i class="fa-solid fa-timeline mr-2 text-[#c95c0e]"></i>
                    Our Story
                </label>
                <span class="text-xs bg-gray-100 px-2 py-1 rounded-full" x-text="wordCount(story) + ' words'"></span>
            </div>
            <textarea name="story" x-model="story" rows="4" 
                      class="w-full p-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1a4d3e] focus:border-transparent resize-y"
                      placeholder="Tell your company story... e.g., SDC2 was founded in 2026 with a bold vision to bring sustainable, innovative design to Rwanda's growing construction industry."></textarea>
            <p class="text-xs text-gray-500 mt-2">
                <i class="fa-regular fa-circle-info mr-1"></i>
                Share how your company started, its journey, and key milestones.
            </p>
        </div>
        
        <!-- What Drives Us -->
        <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <label class="text-lg font-bold text-[#1a4d3e] flex items-center">
                    <i class="fa-solid fa-heart mr-2 text-[#c95c0e]"></i>
                    What Drives Us
                </label>
                <span class="text-xs bg-gray-100 px-2 py-1 rounded-full" x-text="wordCount(drive) + ' words'"></span>
            </div>
            <textarea name="drive" x-model="drive" rows="4" 
                      class="w-full p-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1a4d3e] focus:border-transparent resize-y"
                      placeholder="What motivates your team... e.g., We are driven by passion for sustainable design, commitment to excellence, and the desire to create spaces that positively impact communities."></textarea>
            <p class="text-xs text-gray-500 mt-2">
                <i class="fa-regular fa-circle-info mr-1"></i>
                Describe the passion, values, and motivation behind your work.
            </p>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex gap-3">
            <button type="submit" 
                    class="bg-[#1a4d3e] text-white px-8 py-3 rounded-xl hover:bg-[#c95c0e] transition-colors font-medium flex items-center">
                <i class="fa-solid fa-save mr-2"></i> Save All Changes
            </button>
            <button type="button" @click="about = <?php echo json_encode($content['about'] ?? ''); ?>; story = <?php echo json_encode($content['story'] ?? ''); ?>; drive = <?php echo json_encode($content['drive'] ?? ''); ?>" 
                    class="bg-gray-200 text-gray-700 px-8 py-3 rounded-xl hover:bg-gray-300 transition-colors font-medium flex items-center">
                <i class="fa-solid fa-rotate-right mr-2"></i> Reset
            </button>
        </div>
    </form>
    
    <!-- Preview Card (how it might look) -->
    <div class="mt-8 bg-white rounded-2xl shadow-lg p-6 border-t-4 border-[#c95c0e]">
        <h2 class="text-lg font-bold mb-4 flex items-center">
            <i class="fa-regular fa-eye text-[#c95c0e] mr-2"></i>
            Preview
        </h2>
        
        <div class="grid md:grid-cols-3 gap-4">
            <div class="p-3 bg-gray-50 rounded-lg">
                <p class="text-xs font-semibold text-gray-500 mb-1">About Us</p>
                <p class="text-sm line-clamp-3" x-text="about ? about.substring(0, 100) + (about.length > 100 ? '...' : '') : 'No content yet'"></p>
            </div>
            <div class="p-3 bg-gray-50 rounded-lg">
                <p class="text-xs font-semibold text-gray-500 mb-1">Our Story</p>
                <p class="text-sm line-clamp-3" x-text="story ? story.substring(0, 100) + (story.length > 100 ? '...' : '') : 'No content yet'"></p>
            </div>
            <div class="p-3 bg-gray-50 rounded-lg">
                <p class="text-xs font-semibold text-gray-500 mb-1">What Drives Us</p>
                <p class="text-sm line-clamp-3" x-text="drive ? drive.substring(0, 100) + (drive.length > 100 ? '...' : '') : 'No content yet'"></p>
            </div>
        </div>
    </div>
    
    <!-- Tips -->
    <div class="mt-6 bg-blue-50 p-4 rounded-lg">
        <h4 class="font-semibold text-blue-800 text-sm mb-2 flex items-center">
            <i class="fa-solid fa-lightbulb mr-2"></i>
            Writing Tips:
        </h4>
        <ul class="text-xs text-blue-700 space-y-1 list-disc list-inside">
            <li><strong>About Us:</strong> Keep it professional but engaging. Highlight your expertise and what makes you unique.</li>
            <li><strong>Our Story:</strong> Be authentic. Share the journey, challenges overcome, and vision for the future.</li>
            <li><strong>What Drives Us:</strong> Focus on passion, values, and the impact you want to make.</li>
            <li>Aim for 100-300 words per section for optimal readability.</li>
        </ul>
    </div>
</div>
