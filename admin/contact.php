<?php
$page_title = 'Contact Information';

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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_contact'])) {
    $stmt = $conn->prepare("UPDATE contact_info SET phone_call=?, phone_whatsapp=?, email=?, address=?, google_maps=?, updated_by=? WHERE id=1");
    $stmt->bind_param("sssssi", 
        $_POST['phone_call'],
        $_POST['phone_whatsapp'],
        $_POST['email'],
        $_POST['address'],
        $_POST['google_maps'],
        $_SESSION['user_id']
    );
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Contact information updated successfully!";
        header('Location: contact.php');
        exit;
    } else {
        $error = "Error updating contact information.";
    }
}

// Handle social links update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_social'])) {
    foreach ($_POST['social'] as $platform => $url) {
        $stmt = $conn->prepare("UPDATE social_links SET url=?, updated_by=? WHERE platform=?");
        $stmt->bind_param("sis", $url, $_SESSION['user_id'], $platform);
        $stmt->execute();
    }
    $_SESSION['message'] = "Social media links updated!";
    header('Location: contact.php');
    exit;
}

// Get current data
$contact = $conn->query("SELECT * FROM contact_info WHERE id=1")->fetch_assoc();
$socials = $conn->query("SELECT * FROM social_links ORDER BY platform");
$social_array = [];
while($row = $socials->fetch_assoc()) {
    $social_array[$row['platform']] = $row['url'];
}

// Check for session message
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<!-- Main Content -->
<div class="flex-1 p-8 overflow-y-auto" x-data="{ 
    activeTab: 'contact',
    showSuccess: <?php echo $message ? 'true' : 'false'; ?>,
    contact: {
        phone_call: '<?php echo addslashes($contact['phone_call']); ?>',
        phone_whatsapp: '<?php echo addslashes($contact['phone_whatsapp']); ?>',
        email: '<?php echo addslashes($contact['email']); ?>',
        address: '<?php echo addslashes($contact['address']); ?>',
        google_maps: '<?php echo addslashes($contact['google_maps']); ?>'
    },
    social: <?php echo json_encode($social_array); ?>,
    copyToClipboard(text) {
        navigator.clipboard.writeText(text);
        alert('Copied to clipboard!');
    },
    newPlatform: '',
    newUrl: '',
    addSocial() {
        if (this.newPlatform && this.newUrl) {
            this.social[this.newPlatform] = this.newUrl;
            this.newPlatform = '';
            this.newUrl = '';
        }
    },
    removeSocial(platform) {
        if (confirm('Remove this platform?')) {
            delete this.social[platform];
        }
    }
}" x-init="setTimeout(() => showSuccess = false, 3000)">
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-[#1a4d3e]">Contact Information</h1>
            <p class="text-gray-600 mt-1">Manage your contact details and social media links</p>
        </div>
        
        <!-- Tab Switcher -->
        <div class="flex bg-white rounded-lg shadow-sm p-1">
            <button @click="activeTab = 'contact'" 
                    :class="{ 'bg-[#1a4d3e] text-white': activeTab === 'contact', 'text-gray-600': activeTab !== 'contact' }"
                    class="px-4 py-2 rounded-lg transition-colors">
                <i class="fa-solid fa-phone mr-2"></i>Contact
            </button>
            <button @click="activeTab = 'social'" 
                    :class="{ 'bg-[#1a4d3e] text-white': activeTab === 'social', 'text-gray-600': activeTab !== 'social' }"
                    class="px-4 py-2 rounded-lg transition-colors">
                <i class="fa-solid fa-share-nodes mr-2"></i>Social Media
            </button>
        </div>
    </div>
    
    <!-- Success Message -->
    <div x-show="showSuccess" x-cloak x-transition
         class="bg-green-100 border-l-4 border-green-600 text-green-700 p-4 rounded-lg mb-4 flex justify-between items-center">
        <div class="flex items-center">
            <i class="fa-solid fa-circle-check mr-3 text-green-600"></i>
            <span><?php echo $message ?: 'Updated successfully!'; ?></span>
        </div>
        <button @click="showSuccess = false" class="text-green-700 hover:text-green-900">
            <i class="fa-solid fa-times"></i>
        </button>
    </div>
    
    <!-- Error Message -->
    <?php if ($error): ?>
    <div class="bg-red-100 border-l-4 border-red-600 text-red-700 p-4 rounded-lg mb-4 flex items-center">
        <i class="fa-solid fa-exclamation-circle mr-3 text-red-600"></i>
        <span><?php echo $error; ?></span>
    </div>
    <?php endif; ?>
    
    <!-- Contact Tab -->
    <div x-show="activeTab === 'contact'" x-cloak x-transition>
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form method="POST">
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            <i class="fa-solid fa-phone text-[#c95c0e] mr-1"></i> Phone (Call)
                        </label>
                        <div class="relative">
                            <input type="text" name="phone_call" x-model="contact.phone_call"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1a4d3e]"
                                   placeholder="+250 790 022 000">
                            <button type="button" @click="copyToClipboard(contact.phone_call)"
                                    class="absolute right-3 top-3 text-gray-400 hover:text-[#c95c0e]">
                                <i class="fa-regular fa-copy"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            <i class="fa-brands fa-whatsapp text-[#25D366] mr-1"></i> Phone (WhatsApp)
                        </label>
                        <div class="relative">
                            <input type="text" name="phone_whatsapp" x-model="contact.phone_whatsapp"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1a4d3e]"
                                   placeholder="+250 785 140 170">
                            <button type="button" @click="copyToClipboard(contact.phone_whatsapp)"
                                    class="absolute right-3 top-3 text-gray-400 hover:text-[#25D366]">
                                <i class="fa-regular fa-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        <i class="fa-regular fa-envelope text-[#c95c0e] mr-1"></i> Email
                    </label>
                    <div class="relative">
                        <input type="email" name="email" x-model="contact.email"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1a4d3e]"
                               placeholder="info@sdc2.rw">
                        <button type="button" @click="copyToClipboard(contact.email)"
                                class="absolute right-3 top-3 text-gray-400 hover:text-[#c95c0e]">
                            <i class="fa-regular fa-copy"></i>
                        </button>
                    </div>
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        <i class="fa-regular fa-building text-[#c95c0e] mr-1"></i> Address
                    </label>
                    <textarea name="address" x-model="contact.address" rows="2"
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1a4d3e]"
                              placeholder="Plot 37, Avenue, Kigali, Rwanda"></textarea>
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        <i class="fa-regular fa-map text-[#c95c0e] mr-1"></i> Google Maps Embed URL
                    </label>
                    <input type="text" name="google_maps" x-model="contact.google_maps"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1a4d3e]"
                           placeholder="https://www.google.com/maps/embed?pb=...">
                    <p class="text-xs text-gray-500 mt-1">Paste the embed URL from Google Maps</p>
                </div>
                
                <div class="flex gap-3">
                    <button type="submit" name="update_contact" 
                            class="bg-[#1a4d3e] text-white px-8 py-3 rounded-xl hover:bg-[#c95c0e] transition-colors font-medium">
                        <i class="fa-solid fa-save mr-2"></i> Save Changes
                    </button>
                    <button type="button" @click="contact = {
                        phone_call: '<?php echo addslashes($contact['phone_call']); ?>',
                        phone_whatsapp: '<?php echo addslashes($contact['phone_whatsapp']); ?>',
                        email: '<?php echo addslashes($contact['email']); ?>',
                        address: '<?php echo addslashes($contact['address']); ?>',
                        google_maps: '<?php echo addslashes($contact['google_maps']); ?>'
                    }" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-xl hover:bg-gray-300 transition-colors font-medium">
                        <i class="fa-solid fa-rotate-right mr-2"></i> Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Social Media Tab -->
    <div x-show="activeTab === 'social'" x-cloak x-transition>
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form method="POST">
                <div class="space-y-4 mb-6">
                    <template x-for="(url, platform) in social" :key="platform">
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                            <div class="w-32">
                                <span class="text-sm font-medium capitalize" x-text="platform"></span>
                            </div>
                            <div class="flex-1 relative">
                                <input type="url" :name="'social[' + platform + ']'" x-model="social[platform]"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1a4d3e]"
                                       :placeholder="'https://' + platform + '.com/yourprofile'">
                                <button type="button" @click="copyToClipboard(social[platform])"
                                        class="absolute right-3 top-2 text-gray-400 hover:text-[#c95c0e]">
                                    <i class="fa-regular fa-copy"></i>
                                </button>
                            </div>
                            <button type="button" @click="removeSocial(platform)"
                                    class="text-red-500 hover:text-red-700">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </template>
                    
                    <!-- Add new social platform -->
                    <div class="flex items-center gap-3 pt-4 border-t">
                        <div class="w-32">
                            <input type="text" x-model="newPlatform" placeholder="Platform" 
                                   class="w-full px-3 py-2 border rounded-lg text-sm"
                                   placeholder="e.g., youtube">
                        </div>
                        <div class="flex-1">
                            <input type="url" x-model="newUrl" placeholder="URL" 
                                   class="w-full px-3 py-2 border rounded-lg text-sm"
                                   placeholder="https://youtube.com/@channel">
                        </div>
                        <button type="button" @click="addSocial" 
                                class="bg-[#1a4d3e] text-white px-4 py-2 rounded-lg hover:bg-[#c95c0e] text-sm">
                            <i class="fa-solid fa-plus mr-1"></i> Add
                        </button>
                    </div>
                </div>
                
                <button type="submit" name="update_social" 
                        class="bg-[#1a4d3e] text-white px-8 py-3 rounded-xl hover:bg-[#c95c0e] transition-colors font-medium">
                    <i class="fa-solid fa-save mr-2"></i> Update Social Links
                </button>
            </form>
            
            <!-- Preview Section -->
            <div class="mt-8 p-4 bg-gray-50 rounded-xl">
                <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
                    <i class="fa-regular fa-eye text-[#c95c0e] mr-2"></i>
                    Preview
                </h3>
                <div class="flex gap-4">
                    <template x-for="(url, platform) in social" :key="platform">
                        <a :href="url" target="_blank" 
                           class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:shadow-lg transition-all hover:-translate-y-1">
                            <i :class="{
                                'fa-brands fa-instagram text-pink-600': platform === 'instagram',
                                'fa-brands fa-x-twitter text-blue-400': platform === 'twitter',
                                'fa-brands fa-facebook-f text-blue-600': platform === 'facebook',
                                'fa-brands fa-linkedin-in text-blue-700': platform === 'linkedin',
                                'fa-brands fa-youtube text-red-600': platform === 'youtube',
                                'fa-brands fa-tiktok text-black': platform === 'tiktok',
                                'fa-brands fa-whatsapp text-green-500': platform === 'whatsapp',
                                'fa-solid fa-link text-gray-600': !['instagram','twitter','facebook','linkedin','youtube','tiktok','whatsapp'].includes(platform)
                            }" class="text-lg"></i>
                        </a>
                    </template>
                    
                    <template x-if="Object.keys(social).length === 0">
                        <span class="text-gray-400 text-sm">No social links added yet</span>
                    </template>
                </div>
            </div>
            
            <!-- Tips -->
            <div class="mt-4 bg-blue-50 p-4 rounded-lg">
                <h4 class="font-semibold text-blue-800 text-sm mb-2 flex items-center">
                    <i class="fa-solid fa-lightbulb mr-2"></i>
                    Tips:
                </h4>
                <ul class="text-xs text-blue-700 space-y-1 list-disc list-inside">
                    <li>Use full URLs including https:// (e.g., https://instagram.com/yourprofile)</li>
                    <li>You can add any custom platform like YouTube, TikTok, Pinterest, etc.</li>
                    <li>Icons will automatically appear for supported platforms</li>
                </ul>
            </div>
        </div>
    </div>
</div>
