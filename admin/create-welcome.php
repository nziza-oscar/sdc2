<?php
$page_title = 'Create Welcome Section';

include 'header.php';
include 'includes/sidebar.php';

require_once '../config/database.php';
require_once '../config/admin-config.php';

requireEdit();

$conn = getDB();
$message = '';
$error = '';

$stmt_fetch = $conn->prepare("SELECT * FROM welcome_section WHERE id = 1");
$stmt_fetch->execute();
$result = $stmt_fetch->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    $conn->query("INSERT INTO welcome_section (id) VALUES (1)");
    $stmt_fetch->execute();
    $result = $stmt_fetch->get_result();
    $data = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $welcome_badge = mysqli_real_escape_string($conn, $_POST['welcome_badge']);
    $title_white = mysqli_real_escape_string($conn, $_POST['title_white']);
    $title_green = mysqli_real_escape_string($conn, $_POST['title_green']);
    $description = mysqli_real_escape_string($conn, $_POST['description']); 
    $image_path = $data['image_path']; 

    if (isset($_FILES['welcome_image']) && $_FILES['welcome_image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "../uploads/welcome/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

        $file_extension = pathinfo($_FILES["welcome_image"]["name"], PATHINFO_EXTENSION);
        $new_filename = "welcome_hero_" . time() . "." . $file_extension;
        $target_file = $target_dir . $new_filename;

        if (move_uploaded_file($_FILES["welcome_image"]["tmp_name"], $target_file)) {
            $image_path = "uploads/welcome/" . $new_filename;
            if (!empty($data['image_path']) && $data['image_path'] !== 'assets/img/default-welcome.jpg' && file_exists("../" . $data['image_path'])) {
                unlink("../" . $data['image_path']);
            }
        }
    }

    if (empty($error)) {
        $stmt_update = $conn->prepare("UPDATE welcome_section SET welcome_badge=?, title_white=?, title_green=?, description=?, image_path=? WHERE id=1");
        $stmt_update->bind_param("sssss", $welcome_badge, $title_white, $title_green, $description, $image_path);
        if ($stmt_update->execute()) {
            $_SESSION['message'] = "Welcome section updated successfully!";
            echo "<script>window.location.href='create-welcome.php';</script>";
            exit;
        }
    }
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>

<style>
    .ck-editor__editable_inline { min-height: 250px; }
    .ck-editor { color: #333; }
    .image-preview-hex {
        clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%);
        object-fit: cover;
    }
</style>

<script>
    window.initialDescription = <?php echo json_encode($data['description'] ?? ''); ?>;
</script>

<div class="flex-1 p-8 overflow-y-auto" 
     x-data="{ description: '' }" 
     x-init="description = window.initialDescription">
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-[#1a4d3e]">Welcome Section</h1>
            <p class="text-gray-600 mt-1">Manage the main welcome message, titles, and main image.</p>
        </div>
    </div>

    <?php if ($message): ?>
    <div class="bg-green-100 border-l-4 border-green-600 text-green-700 p-4 rounded-lg mb-6 flex justify-between items-center">
        <span><i class="fa-solid fa-check-circle mr-2"></i><?php echo $message; ?></span>
        <button onclick="this.parentElement.remove()" class="text-green-700">&times;</button>
    </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="grid grid-cols-1 xl:grid-cols-4 gap-8">
        <div class="xl:col-span-3 space-y-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Welcome Badge Message</label>
                        <input type="text" name="welcome_badge" value="<?php echo htmlspecialchars($data['welcome_badge']); ?>" 
                               class="w-full p-4 border border-gray-300 rounded-xl outline-none">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Main Title (White Part)</label>
                            <input type="text" name="title_white" value="<?php echo htmlspecialchars($data['title_white']); ?>" 
                                   class="w-full p-4 border border-gray-300 rounded-xl outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Main Title (Green Part)</label>
                            <input type="text" name="title_green" value="<?php echo htmlspecialchars($data['title_green']); ?>" 
                                   class="w-full p-4 border border-gray-300 rounded-xl outline-none text-[#37d997]">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Description Contents</label>
                        <textarea name="description" id="welcome-editor"><?php echo htmlspecialchars($data['description']); ?></textarea>
                    </div>
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-[#1a4d3e] text-white px-10 py-4 rounded-xl font-semibold shadow">
                    Save Welcome Section
                </button>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <label class="block text-sm font-semibold text-gray-700 mb-4">Hero Image</label>
                <div class="flex flex-col items-center">
                    <div class="w-full aspect-square bg-gray-50 rounded-2xl border p-2 mb-4">
                        <img id="image-preview" src="../<?php echo $data['image_path']; ?>" class="w-full h-full image-preview-hex">
                    </div>
                    <input type="file" name="welcome_image" id="welcome_image_input" accept="image/*" class="text-xs">
                </div>
            </div>

            <div class="bg-[#0f2a36] p-6 rounded-2xl border border-gray-800">
                <div class="space-y-2">
                    <h2 class="text-white text-lg font-bold">Preview</h2>
                    <div class="text-gray-300 text-[10px] leading-relaxed prose prose-invert" x-html="description"></div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        ClassicEditor
            .create(document.querySelector('#welcome-editor'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    // Correct way to access Alpine data from outside
                    const el = document.querySelector('[x-data]');
                    if (el && el.__x) {
                        el.__x.$data.description = editor.getData();
                    } else if (window.Alpine) {
                        // For Alpine v3
                        Alpine.store('description', editor.getData());
                    }
                });
            });

        const imageInput = document.getElementById('welcome_image_input');
        imageInput.addEventListener('change', function() {
            if (this.files[0]) {
                const reader = new FileReader();
                reader.onload = e => document.getElementById('image-preview').src = e.target.result;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>