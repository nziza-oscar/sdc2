<?php
$page_title = 'Contact Information';

// Include header
include 'header.php';

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

// Ensure social_array is not empty for JSON encoding
if (empty($social_array)) {
    $social_array = (object)[];
}
?>

<!-- Main Content - Add x-data to the main container -->
<div class="flex">
    <!-- Sidebar is already included above -->
    
  <div class="flex-1 p-8 x` overflow-y-auto" 
    x-data='{
    activeTab: "contact",
    showSuccess: <?php echo $message ? 'true' : 'false'; ?>,
    contact: <?php echo json_encode([
        "phone_call" => $contact['phone_call'] ?? "",
        "phone_whatsapp" => $contact['phone_whatsapp'] ?? "",
        "email" => $contact['email'] ?? "",
        "address" => $contact['address'] ?? "",
        "google_maps" => $contact['google_maps'] ?? ""
    ]); ?>,
    social: <?php echo json_encode($social_array ?: new stdClass()); ?>,
    newPlatform: "",
    newUrl: "",
    copyToClipboard(text) {
        if (!text) return;
        navigator.clipboard.writeText(text);
        alert("Copied to clipboard!");
    },
    addSocial() {
        if (this.newPlatform && this.newUrl) {
            this.social[this.newPlatform] = this.newUrl;
            this.newPlatform = "";
            this.newUrl = "";
        }
    },
    removeSocial(platform) {
        if (confirm("Remove this platform?")) {
            delete this.social[platform];
        }
    }
}'
     x-init="if (showSuccess) { setTimeout(() => { showSuccess = false }, 3000) }">
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-[#1a4d3e]">Contact Information</h1>
            <p class="text-gray-600 mt-1">Manage your contact details and social media links</p>
        </div>
        
        <div class="flex bg-white rounded-lg shadow-sm p-1">
            <button @click="activeTab = 'contact'" 
                    :class="activeTab === 'contact' ? 'bg-[#1a4d3e] text-white' : 'text-gray-600'"
                    class="px-4 py-2 rounded-lg transition-colors">
                <i class="fa-solid fa-phone mr-2"></i>Contact
            </button>
            <button @click="activeTab = 'social'" 
                    :class="activeTab === 'social' ? 'bg-[#1a4d3e] text-white' : 'text-gray-600'"
                    class="px-4 py-2 rounded-lg transition-colors">
                <i class="fa-solid fa-share-nodes mr-2"></i>Social Media
            </button>
        </div>
    </div>
    
    <div x-show="showSuccess" x-cloak x-transition
         class="bg-green-100 border-l-4 border-green-600 text-green-700 p-4 rounded-lg mb-4 flex justify-between items-center">
        <div class="flex items-center">
            <i class="fa-solid fa-circle-check mr-3 text-green-600"></i>
            <span><?php echo htmlspecialchars($message ?: 'Updated successfully!'); ?></span>
        </div>
        <button @click="showSuccess = false" class="text-green-700 hover:text-green-900">
            <i class="fa-solid fa-times"></i>
        </button>
    </div>
    
    <?php if (!empty($error)): ?>
    <div class="bg-red-100 border-l-4 border-red-600 text-red-700 p-4 rounded-lg mb-4 flex items-center">
        <i class="fa-solid fa-exclamation-circle mr-3 text-red-600"></i>
        <span><?php echo htmlspecialchars($error); ?></span>
    </div>
    <?php endif; ?>
    
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
                </div>
                
                <div class="flex gap-3">
                    <button type="submit" name="update_contact" 
                            class="bg-[#1a4d3e] text-white px-8 py-3 rounded-xl hover:bg-[#c95c0e] transition-colors font-medium">
                        <i class="fa-solid fa-save mr-2"></i> Save Changes
                    </button>
                    <button type="button" @click="window.location.reload()" 
                            class="bg-gray-200 text-gray-700 px-8 py-3 rounded-xl hover:bg-gray-300 transition-colors font-medium">
                        <i class="fa-solid fa-rotate-right mr-2"></i> Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <div x-show="activeTab === 'social'" x-cloak x-transition>
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form method="POST">
                <div class="space-y-4 mb-6">
                    <template x-for="(url, platform) in social" :key="platform">
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl mb-3">
                            <div class="w-32">
                                <span class="text-sm font-medium capitalize" x-text="platform"></span>
                            </div>
                            <div class="flex-1 relative">
                                <input type="url" :name="'social[' + platform + ']'" x-model="social[platform]"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1a4d3e]">
                            </div>
                            <button type="button" @click="removeSocial(platform)" class="text-red-500">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </template>
                    
                    <div class="flex items-center gap-3 pt-4 border-t">
                        <input type="text" x-model="newPlatform" placeholder="Platform" class="border p-2 rounded w-32">
                        <input type="url" x-model="newUrl" placeholder="URL" class="border p-2 rounded flex-1">
                        <button type="button" @click="addSocial" class="bg-[#1a4d3e] text-white px-4 py-2 rounded">Add</button>
                    </div>
                </div>
                <button type="submit" name="update_social" class="bg-[#1a4d3e] text-white px-8 py-3 rounded-xl">Update Socials</button>
            </form>
        </div>
    </div>
</div>
</div>


