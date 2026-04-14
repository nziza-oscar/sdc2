<?php
$page_title = 'Mission & Vision';

// Include header from admin root
include 'header.php';

// Include sidebar from includes folder
include 'includes/sidebar.php';

require_once '../config/database.php';
require_once '../config/admin-config.php';

requireEdit();

$conn = getDB();
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sections = ['mission', 'vision'];
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
        $_SESSION['message'] = "Mission & Vision updated successfully!";
        echo "<script>window.location.href='mission.php';</script>";
        exit;
    } else {
        $error = "Error updating content.";
    }
}

$content = [];
$result = $conn->query("SELECT section, content FROM company_info WHERE section IN ('mission', 'vision')");
while($row = $result->fetch_assoc()) {
    $content[$row['section']] = $row['content'];
}

// Check for session message
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

<style>
    .ck-editor__editable_inline {
        min-height: 150px;
    }
    .ck-editor {
        color: #333;
    }
</style>

<script>
    // Global helper for accurate counts without breaking Alpine syntax
    function getEditorStats(html) {
        if (!html) return { words: 0, chars: 0 };
        const cleanText = html.replace(/<\/?[^>]+(>|$)/g, "").replace(/&nbsp;/g, " ").trim();
        return {
            words: cleanText ? cleanText.split(/\s+/).length : 0,
            chars: cleanText.length
        };
    }
</script>

<div class="flex-1 p-8 overflow-y-auto" 
     x-data="{ 
        mission: <?php echo json_encode($content['mission'] ?? ''); ?>,
        vision: <?php echo json_encode($content['vision'] ?? ''); ?>
     }">
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-[#1a4d3e]">Mission & Vision</h1>
            <p class="text-gray-600 mt-1">Define your company's purpose and future aspirations.</p>
        </div>
        
        <div class="flex gap-3">
            <div class="bg-blue-50 px-3 py-2 rounded-lg flex items-center">
                <i class="fa-solid fa-bullseye text-blue-600 mr-2"></i>
                <span class="text-sm" x-text="getEditorStats(mission).words + ' words'"></span>
            </div>
            <div class="bg-purple-50 px-3 py-2 rounded-lg flex items-center">
                <i class="fa-solid fa-eye text-purple-600 mr-2"></i>
                <span class="text-sm" x-text="getEditorStats(vision).words + ' words'"></span>
            </div>
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
    
    <form method="POST" class="space-y-6">
        <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <label class="text-lg font-bold text-[#1a4d3e] flex items-center">
                    <i class="fa-solid fa-bullseye text-[#c95c0e] mr-2"></i>
                    Mission Statement
                </label>
                <span class="text-xs bg-gray-100 px-2 py-1 rounded-full" 
                      x-text="getEditorStats(mission).words + ' words · ' + getEditorStats(mission).chars + ' chars'"></span>
            </div>
            <textarea name="mission" id="editor-mission"><?php echo htmlspecialchars($content['mission'] ?? ''); ?></textarea>
            <p class="text-xs text-gray-500 mt-2 flex items-center">
                <i class="fa-regular fa-circle-info mr-1 text-[#c95c0e]"></i>
                Your mission explains why your company exists and what you aim to achieve.
            </p>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <label class="text-lg font-bold text-[#1a4d3e] flex items-center">
                    <i class="fa-solid fa-eye text-[#c95c0e] mr-2"></i>
                    Vision Statement
                </label>
                <span class="text-xs bg-gray-100 px-2 py-1 rounded-full" 
                      x-text="getEditorStats(vision).words + ' words · ' + getEditorStats(vision).chars + ' chars'"></span>
            </div>
            <textarea name="vision" id="editor-vision"><?php echo htmlspecialchars($content['vision'] ?? ''); ?></textarea>
            <p class="text-xs text-gray-500 mt-2 flex items-center">
                <i class="fa-regular fa-circle-info mr-1 text-[#c95c0e]"></i>
                Your vision describes where you want to be in the future.
            </p>
        </div>
        
        <div class="flex gap-3">
            <button type="submit" 
                    class="bg-[#1a4d3e] text-white px-8 py-3 rounded-xl hover:bg-[#c95c0e] transition-colors font-medium flex items-center">
                <i class="fa-solid fa-save mr-2"></i> Save Changes
            </button>
            <button type="button" @click="window.location.reload()" 
                    class="bg-gray-200 text-gray-700 px-8 py-3 rounded-xl hover:bg-gray-300 transition-colors font-medium flex items-center">
                <i class="fa-solid fa-rotate-right mr-2"></i> Reset
            </button>
        </div>
    </form>
    
    <div class="mt-8 grid md:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-[#1a4d3e]">
            <h3 class="font-bold text-[#1a4d3e] mb-2 flex items-center">
                <i class="fa-solid fa-bullseye text-[#c95c0e] mr-2 text-sm"></i>
                Mission Preview
            </h3>
            <div class="text-gray-700 italic prose prose-sm max-w-none" x-html="mission || 'No mission statement yet.'"></div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-[#c95c0e]">
            <h3 class="font-bold text-[#1a4d3e] mb-2 flex items-center">
                <i class="fa-solid fa-eye text-[#c95c0e] mr-2 text-sm"></i>
                Vision Preview
            </h3>
            <div class="text-gray-700 italic prose prose-sm max-w-none" x-html="vision || 'No vision statement yet.'"></div>
        </div>
    </div>
    
    <div class="mt-6 bg-blue-50 p-4 rounded-lg">
        <h4 class="font-semibold text-blue-800 text-sm mb-2 flex items-center">
            <i class="fa-solid fa-lightbulb mr-2"></i>
            Tips for Great Mission & Vision Statements:
        </h4>
        <ul class="text-xs text-blue-700 space-y-1 list-disc list-inside grid md:grid-cols-2">
            <li><strong>Mission:</strong> Focus on present - what you do and why.</li>
            <li><strong>Vision:</strong> Focus on future - where you want to be.</li>
            <li>Keep it concise (1-3 sentences ideal).</li>
            <li>Make it memorable and inspiring.</li>
            <li>Be specific to your company.</li>
            <li>Align with your core values.</li>
        </ul>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const alpineElement = document.querySelector('[x-data]');
        
        const initEditor = (selector, alpineKey) => {
            ClassicEditor
                .create(document.querySelector(selector), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo']
                })
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                        if (alpineElement.__x) {
                            alpineElement.__x.$data[alpineKey] = editor.getData();
                        }
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        };

        initEditor('#editor-mission', 'mission');
        initEditor('#editor-vision', 'vision');
    });
</script>