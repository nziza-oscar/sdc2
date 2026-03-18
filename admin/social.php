<?php
require_once '../../config/database.php';
require_once '../../config/admin-config.php';

requireEdit();

$conn = getDB();
$message = '';
$error = '';

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_social'])) {
    foreach ($_POST['social'] as $platform => $url) {
        // Check if platform exists
        $check = $conn->query("SELECT id FROM social_links WHERE platform = '$platform'");
        if ($check->num_rows > 0) {
            $stmt = $conn->prepare("UPDATE social_links SET url=?, updated_by=? WHERE platform=?");
            $stmt->bind_param("sis", $url, $_SESSION['user_id'], $platform);
        } else {
            $stmt = $conn->prepare("INSERT INTO social_links (platform, url, updated_by) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $platform, $url, $_SESSION['user_id']);
        }
        $stmt->execute();
    }
    $message = "Social media links updated successfully!";
}

// Handle add new platform
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_platform'])) {
    $platform = strtolower(trim($_POST['new_platform']));
    $url = trim($_POST['new_url']);
    
    // Check if platform already exists
    $check = $conn->query("SELECT id FROM social_links WHERE platform = '$platform'");
    if ($check->num_rows > 0) {
        $error = "Platform '$platform' already exists!";
    } else {
        $stmt = $conn->prepare("INSERT INTO social_links (platform, url, updated_by) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $platform, $url, $_SESSION['user_id']);
        $stmt->execute();
        $message = "New platform added successfully!";
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $platform = $_GET['delete'];
    // Don't allow deletion of default platforms if you want to keep them
    $defaults = ['instagram', 'twitter', 'facebook', 'linkedin'];
    if (!in_array($platform, $defaults)) {
        $conn->query("DELETE FROM social_links WHERE platform = '$platform'");
        $message = "Platform deleted!";
    } else {
        $error = "Cannot delete default platform!";
    }
}

// Get all social links
$socials = $conn->query("SELECT * FROM social_links ORDER BY 
                         CASE platform 
                            WHEN 'instagram' THEN 1
                            WHEN 'twitter' THEN 2
                            WHEN 'facebook' THEN 3
                            WHEN 'linkedin' THEN 4
                            ELSE 5
                         END, platform");
$social_array = [];
while($row = $socials->fetch_assoc()) {
    $social_array[$row['platform']] = $row['url'];
}

// Get platform icons mapping
$icons = [
    'instagram' => 'fa-instagram',
    'twitter' => 'fa-x-twitter',
    'facebook' => 'fa-facebook-f',
    'linkedin' => 'fa-linkedin-in',
    'youtube' => 'fa-youtube',
    'tiktok' => 'fa-tiktok',
    'pinterest' => 'fa-pinterest',
    'snapchat' => 'fa-snapchat',
    'whatsapp' => 'fa-whatsapp',
    'telegram' => 'fa-telegram',
    'github' => 'fa-github',
    'medium' => 'fa-medium',
    'discord' => 'fa-discord',
    'twitch' => 'fa-twitch'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media - SDC2 Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Include reusable sidebar -->
        <?php include '../includes/sidebar.php'; ?>
        
        <!-- Main Content -->
        <div class="flex-1 p-8 ml-64" 
             x-data="{ 
                social: <?php echo json_encode($social_array); ?>,
                showAddForm: false,
                newPlatform: '',
                newUrl: '',
                showSuccess: <?php echo $message ? 'true' : 'false'; ?>,
                showError: <?php echo $error ? 'true' : 'false'; ?>,
                
                getIcon(platform) {
                    const icons = <?php echo json_encode($icons); ?>;
                    return icons[platform] || 'fa-link';
                },
                
                copyToClipboard(text) {
                    navigator.clipboard.writeText(text);
                    alert('Copied to clipboard!');
                },
                
                addPlatform() {
                    if (this.newPlatform && this.newUrl) {
                        // Submit form
                        document.getElementById('add-platform-form').submit();
                    }
                },
                
                removePlatform(platform) {
                    if (confirm(`Remove ${platform}?`)) {
                        window.location.href = `?delete=${platform}`;
                    }
                },
                
                getPlatformColor(platform) {
                    const colors = {
                        'instagram': 'text-pink-600',
                        'twitter': 'text-blue-400',
                        'facebook': 'text-blue-600',
                        'linkedin': 'text-blue-700',
                        'youtube': 'text-red-600',
                        'tiktok': 'text-black',
                        'pinterest': 'text-red-700',
                        'snapchat': 'text-yellow-500',
                        'whatsapp': 'text-green-500',
                        'telegram': 'text-blue-500'
                    };
                    return colors[platform] || 'text-gray-600';
                }
             }"
             x-init="setTimeout(() => { showSuccess = false; showError = false; }, 3000)">
            
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-[#1a4d3e]">Social Media Links</h1>
                <button @click="showAddForm = !showAddForm" 
                        class="bg-[#1a4d3e] text-white px-4 py-2 rounded-lg hover:bg-[#c95c0e] transition-colors flex items-center">
                    <i class="fa-solid fa-plus mr-2"></i> 
                    <span x-text="showAddForm ? 'Cancel' : 'Add Platform'"></span>
                </button>
            </div>
            
            <!-- Success Message -->
            <div x-show="showSuccess" x-cloak x-transition
                 class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex justify-between items-center">
                <span><i class="fa-solid fa-circle-check mr-2"></i> <?php echo $message ?: 'Updated successfully!'; ?></span>
                <button @click="showSuccess = false"><i class="fa-solid fa-times"></i></button>
            </div>
            
            <!-- Error Message -->
            <div x-show="showError" x-cloak x-transition
                 class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 flex justify-between items-center">
                <span><i class="fa-solid fa-exclamation-circle mr-2"></i> <?php echo $error ?: 'Error occurred!'; ?></span>
                <button @click="showError = false"><i class="fa-solid fa-times"></i></button>
            </div>
            
            <!-- Add Platform Form -->
            <div x-show="showAddForm" x-cloak x-transition class="bg-white rounded-2xl shadow-lg p-6 mb-6 border-2 border-[#c95c0e]">
                <h2 class="text-lg font-bold mb-4 flex items-center">
                    <i class="fa-solid fa-plus-circle text-[#c95c0e] mr-2"></i> 
                    Add New Social Platform
                </h2>
                <form method="POST" id="add-platform-form">
                    <div class="grid md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Platform Name</label>
                            <div class="relative">
                                <i class="fa-solid fa-hashtag absolute left-3 top-3 text-gray-400"></i>
                                <input type="text" name="new_platform" x-model="newPlatform" 
                                       class="w-full pl-10 pr-3 py-2 border rounded-lg focus:ring-2 focus:ring-[#1a4d3e]" 
                                       placeholder="e.g., youtube, tiktok" required>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Use lowercase (e.g., instagram, twitter)</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Profile URL</label>
                            <div class="relative">
                                <i class="fa-solid fa-link absolute left-3 top-3 text-gray-400"></i>
                                <input type="url" name="new_url" x-model="newUrl" 
                                       class="w-full pl-10 pr-3 py-2 border rounded-lg focus:ring-2 focus:ring-[#1a4d3e]" 
                                       placeholder="https://..." required>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <button type="submit" name="add_platform" 
                                class="bg-[#1a4d3e] text-white px-6 py-2 rounded-lg hover:bg-[#c95c0e] transition-colors">
                            <i class="fa-solid fa-save mr-2"></i> Add Platform
                        </button>
                        <button type="button" @click="showAddForm = false" 
                                class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition-colors">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Main Form -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <form method="POST">
                    <div class="space-y-4 mb-8">
                        <template x-for="(url, platform) in social" :key="platform">
                            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl hover:shadow-md transition-shadow">
                                <!-- Platform Icon & Name -->
                                <div class="w-48 flex items-center gap-3">
                                    <i :class="['fa-brands', getIcon(platform), getPlatformColor(platform), 'text-xl w-6']"></i>
                                    <span class="font-medium capitalize" x-text="platform"></span>
                                </div>
                                
                                <!-- URL Input -->
                                <div class="flex-1 relative">
                                    <input type="url" :name="'social[' + platform + ']'" x-model="social[platform]"
                                           class="w-full px-4 py-2 pr-20 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a4d3e] focus:border-transparent"
                                           placeholder="https://...">
                                    <div class="absolute right-2 top-1/2 -translate-y-1/2 flex gap-2">
                                        <!-- Preview Button -->
                                        <a :href="social[platform]" target="_blank" 
                                           class="text-gray-400 hover:text-[#1a4d3e] transition-colors"
                                           x-show="social[platform] && social[platform].startsWith('http')">
                                            <i class="fa-solid fa-external-link-alt"></i>
                                        </a>
                                        <!-- Copy Button -->
                                        <button type="button" @click="copyToClipboard(social[platform])"
                                                class="text-gray-400 hover:text-[#c95c0e] transition-colors">
                                            <i class="fa-regular fa-copy"></i>
                                        </button>
                                        <!-- Delete Button (only for non-default platforms) -->
                                        <button type="button" 
                                               x-show="!['instagram', 'twitter', 'facebook', 'linkedin'].includes(platform)"
                                               @click="removePlatform(platform)"
                                               class="text-gray-400 hover:text-red-500 transition-colors">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>
                        
                        <!-- Empty State -->
                        <div x-show="Object.keys(social).length === 0" x-cloak 
                             class="text-center py-12 text-gray-500">
                            <i class="fa-solid fa-share-nodes text-4xl mb-3 opacity-30"></i>
                            <p>No social media links yet. Click "Add Platform" to get started.</p>
                        </div>
                    </div>
                    
                    <!-- Quick Add Common Platforms (when no links exist) -->
                    <div x-show="Object.keys(social).length === 0" class="mb-6">
                        <p class="text-sm text-gray-500 mb-3">Quick add common platforms:</p>
                        <div class="flex gap-3 flex-wrap">
                            <button type="button" @click="newPlatform='instagram'; newUrl='https://instagram.com/'; showAddForm=true"
                                    class="px-3 py-1 bg-pink-100 text-pink-600 rounded-full text-sm hover:bg-pink-200">
                                <i class="fa-brands fa-instagram mr-1"></i> Instagram
                            </button>
                            <button type="button" @click="newPlatform='twitter'; newUrl='https://twitter.com/'; showAddForm=true"
                                    class="px-3 py-1 bg-blue-100 text-blue-400 rounded-full text-sm hover:bg-blue-200">
                                <i class="fa-brands fa-x-twitter mr-1"></i> Twitter
                            </button>
                            <button type="button" @click="newPlatform='facebook'; newUrl='https://facebook.com/'; showAddForm=true"
                                    class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm hover:bg-blue-200">
                                <i class="fa-brands fa-facebook mr-1"></i> Facebook
                            </button>
                            <button type="button" @click="newPlatform='linkedin'; newUrl='https://linkedin.com/company/'; showAddForm=true"
                                    class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm hover:bg-blue-200">
                                <i class="fa-brands fa-linkedin mr-1"></i> LinkedIn
                            </button>
                        </div>
                    </div>
                    
                    <!-- Save Button (only show if there are links) -->
                    <div x-show="Object.keys(social).length > 0" class="flex gap-3 border-t pt-6">
                        <button type="submit" name="update_social" 
                                class="bg-[#1a4d3e] text-white px-8 py-3 rounded-xl hover:bg-[#c95c0e] transition-colors font-medium">
                            <i class="fa-solid fa-save mr-2"></i> Save All Changes
                        </button>
                        <button type="button" @click="social = <?php echo json_encode($social_array); ?>" 
                                class="bg-gray-200 text-gray-700 px-8 py-3 rounded-xl hover:bg-gray-300 transition-colors font-medium">
                            <i class="fa-solid fa-rotate-right mr-2"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Preview Card (how it looks on website) -->
            <div class="mt-8 bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-lg font-bold mb-4 flex items-center">
                    <i class="fa-solid fa-eye text-[#c95c0e] mr-2"></i>
                    Preview (How it looks on website)
                </h2>
                
                <div class="bg-gray-50 p-6 rounded-xl">
                    <p class="text-sm text-gray-500 mb-3">Follow us on social media:</p>
                    <div class="flex gap-4">
                        <template x-for="(url, platform) in social" :key="platform">
                            <a :href="url" target="_blank" 
                               class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:shadow-lg transition-all hover:-translate-y-1"
                               :class="'hover:bg-' + platform">
                                <i :class="['fa-brands', getIcon(platform), getPlatformColor(platform), 'text-lg']"></i>
                            </a>
                        </template>
                        
                        <template x-if="Object.keys(social).length === 0">
                            <span class="text-gray-400 text-sm">No social links added yet</span>
                        </template>
                    </div>
                </div>
                
                <!-- Tips -->
                <div class="mt-4 bg-blue-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-blue-800 text-sm mb-2 flex items-center">
                        <i class="fa-solid fa-lightbulb mr-2"></i>
                        Tips:
                    </h3>
                    <ul class="text-xs text-blue-700 space-y-1 list-disc list-inside">
                        <li>Use full URLs including https:// (e.g., https://instagram.com/yourprofile)</li>
                        <li>Default platforms (Instagram, Twitter, Facebook, LinkedIn) cannot be deleted</li>
                        <li>You can add any custom platform like YouTube, TikTok, Pinterest, etc.</li>
                        <li>Icons will automatically appear for supported platforms</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>