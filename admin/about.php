<?php
$page_title = 'About Us';

// Include header (Ensure CKEditor is NOT also included here to avoid duplication errors)
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
        echo "<script>window.location.href='about.php';</script>";
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


<style>
    .ck-editor__editable_inline {
        min-height: 200px;
    }
    .ck-editor {
        color: #333;
    }
</style>

<script>
    // Global function to avoid Alpine.js attribute syntax errors
    function calculateWords(text) {
        if (!text) return 0;
        const cleanText = text.replace(/<\/?[^>]+(>|$)/g, "").replace(/&nbsp;/g, " ").trim();
        return cleanText ? cleanText.split(/\s+/).length : 0;
    }
</script>

<div class="flex-1 p-8 overflow-y-auto" 
     x-data="{ 
        about: <?php echo json_encode($content['about'] ?? ''); ?>,
        story: <?php echo json_encode($content['story'] ?? ''); ?>,
        drive: <?php echo json_encode($content['drive'] ?? ''); ?>
     }">
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-[#1a4d3e]">About Us</h1>
            <p class="text-gray-600 mt-1">Manage your company information, story, and motivation.</p>
        </div>
    </div>
    
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
    
    <?php if ($error): ?>
    <div class="bg-red-100 border-l-4 border-red-600 text-red-700 p-4 rounded-lg mb-4 flex items-center">
        <i class="fa-solid fa-exclamation-circle mr-3 text-red-600"></i>
        <span><?php echo $error; ?></span>
    </div>
    <?php endif; ?>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-blue-50 p-3 rounded-lg flex items-center">
            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                <i class="fa-solid fa-info text-white text-sm"></i>
            </div>
            <div>
                <p class="text-xs text-gray-600">About Section</p>
                <p class="text-sm font-semibold" x-text="calculateWords(about) + ' words'"></p>
            </div>
        </div>
        <div class="bg-green-50 p-3 rounded-lg flex items-center">
            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mr-3">
                <i class="fa-solid fa-book-open text-white text-sm"></i>
            </div>
            <div>
                <p class="text-xs text-gray-600">Our Story</p>
                <p class="text-sm font-semibold" x-text="calculateWords(story) + ' words'"></p>
            </div>
        </div>
        <div class="bg-purple-50 p-3 rounded-lg flex items-center">
            <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center mr-3">
                <i class="fa-solid fa-fire text-white text-sm"></i>
            </div>
            <div>
                <p class="text-xs text-gray-600">What Drives Us</p>
                <p class="text-sm font-semibold" x-text="calculateWords(drive) + ' words'"></p>
            </div>
        </div>
    </div>
    
    <form method="POST" id="aboutForm" class="space-y-6">
        <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <label class="text-lg font-bold text-[#1a4d3e] flex items-center">
                    <i class="fa-solid fa-building mr-2 text-[#c95c0e]"></i>
                    About Us
                </label>
                <span class="text-xs bg-gray-100 px-2 py-1 rounded-full" x-text="calculateWords(about) + ' words'"></span>
            </div>
            <textarea name="about" id="editor-about"><?php echo htmlspecialchars($content['about'] ?? ''); ?></textarea>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <label class="text-lg font-bold text-[#1a4d3e] flex items-center">
                    <i class="fa-solid fa-timeline mr-2 text-[#c95c0e]"></i>
                    Our Story
                </label>
                <span class="text-xs bg-gray-100 px-2 py-1 rounded-full" x-text="calculateWords(story) + ' words'"></span>
            </div>
            <textarea name="story" id="editor-story"><?php echo htmlspecialchars($content['story'] ?? ''); ?></textarea>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <label class="text-lg font-bold text-[#1a4d3e] flex items-center">
                    <i class="fa-solid fa-heart mr-2 text-[#c95c0e]"></i>
                    What Drives Us
                </label>
                <span class="text-xs bg-gray-100 px-2 py-1 rounded-full" x-text="calculateWords(drive) + ' words'"></span>
            </div>
            <textarea name="drive" id="editor-drive"><?php echo htmlspecialchars($content['drive'] ?? ''); ?></textarea>
        </div>
        
        <div class="flex gap-3">
            <button type="submit" 
                    class="bg-[#1a4d3e] text-white px-8 py-3 rounded-xl hover:bg-[#c95c0e] transition-colors font-medium flex items-center">
                <i class="fa-solid fa-save mr-2"></i> Save All Changes
            </button>
            <button type="button" @click="window.location.reload()" 
                    class="bg-gray-200 text-gray-700 px-8 py-3 rounded-xl hover:bg-gray-300 transition-colors font-medium flex items-center">
                <i class="fa-solid fa-rotate-right mr-2"></i> Reset
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const alpineElement = document.querySelector('[x-data]');
        
        const initEditor = (selector, alpineKey) => {
            ClassicEditor
                .create(document.querySelector(selector), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo']
                })
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                        // Safe way to update Alpine data
                        if (alpineElement.__x) {
                            alpineElement.__x.$data[alpineKey] = editor.getData();
                        }
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        };

        initEditor('#editor-about', 'about');
        initEditor('#editor-story', 'story');
        initEditor('#editor-drive', 'drive');
    });
</script>