<?php
$page_title = 'Services';

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

// Handle add category/service
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $display_order = $_POST['display_order'] ?: 1;
    
    $stmt = $conn->prepare("INSERT INTO services (category, name, display_order, updated_by) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $_POST['category'], $_POST['name'], $display_order, $_SESSION['user_id']);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Service added successfully!";
        header('Location: services.php');
        exit;
    } else {
        $error = "Error adding service.";
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM services WHERE id = $id");
    $_SESSION['message'] = "Service deleted!";
    header('Location: services.php');
    exit;
}

// Handle category delete
if (isset($_GET['delete_category'])) {
    $category = $_GET['delete_category'];
    $conn->query("DELETE FROM services WHERE category = '$category'");
    $_SESSION['message'] = "Category '$category' and all its services deleted!";
    header('Location: services.php');
    exit;
}

// Get all services
$services = $conn->query("SELECT * FROM services ORDER BY category, display_order");

// Get unique categories with counts
$categories_result = $conn->query("
    SELECT category, COUNT(*) as service_count 
    FROM services 
    GROUP BY category 
    ORDER BY category
");

$categories = [];
$categories_list = [];
while($c = $categories_result->fetch_assoc()) {
    $categories[] = $c;
    $categories_list[] = $c['category'];
}

// Build services array for Alpine
$services_array = [];
$services->data_seek(0);
while($s = $services->fetch_assoc()) {
    $services_array[] = $s;
}

// Check for session message
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<!-- Main Content -->
<div class="flex-1 p-8  overflow-y-auto" 
x-data="{
    showForm: false,
    newCategory: '',
    newName: '',
    newOrder: 1,
    selectedCategory: '',

    categories: <?php echo json_encode($categories_list ?: [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>,
    services: <?php echo json_encode($services_array ?: [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>,

    get categoryCount() {
        return this.categories.length;
    },

    get totalServices() {
        return this.services.length;
    },

    getServicesByCategory(category) {
        return this.services.filter(s => s.category === category);
    },

    addService() {
        if (this.newCategory && this.newName) {
            document.getElementById('add-form').submit();
        }
    },

    deleteCategory(category) {
        if (confirm('Delete entire category \"' + category + '\" and all its services?')) {
            window.location.href = '?delete_category=' + encodeURIComponent(category);
        }
    }
}"
>
    
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-[#1a4d3e]">Services</h1>
            <p class="text-gray-600 mt-1">Manage your service offerings and categories</p>
        </div>
        
        <div class="flex gap-3">
            <!-- Stats -->
            <div class="bg-gray-100 px-4 py-2 rounded-lg flex items-center">
                <i class="fa-solid fa-layer-group text-[#1a4d3e] mr-2"></i>
                <span class="font-medium" x-text="categoryCount + ' categories'"></span>
            </div>
            <div class="bg-gray-100 px-4 py-2 rounded-lg flex items-center">
                <i class="fa-solid fa-wrench text-[#c95c0e] mr-2"></i>
                <span class="font-medium" x-text="totalServices + ' services'"></span>
            </div>
            
            <!-- Add button -->
            <button @click="showForm = !showForm" 
                    class="bg-[#1a4d3e] text-white px-4 py-2 rounded-lg hover:bg-[#c95c0e] transition-colors flex items-center">
                <i x-text="showForm ? '×' : '+'" class="text-xl mr-1"></i>
                <span x-text="showForm ? 'Cancel' : 'Add Service'"></span>
            </button>
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
    
    <!-- Add Form -->
    <div x-show="showForm" x-cloak x-transition class="bg-white rounded-2xl shadow-lg p-6 mb-6 border-2 border-[#c95c0e]">
        <h2 class="text-lg font-bold mb-4 flex items-center">
            <i class="fa-solid fa-plus-circle text-[#c95c0e] mr-2"></i>
            Add New Service
        </h2>
        
        <form method="POST" id="add-form">
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <div class="flex gap-2">
                        <select x-model="selectedCategory" class="flex-1 p-3 border rounded-lg bg-white">
                            <option value="">Select existing</option>
                            <template x-for="cat in categories" :key="cat">
                                <option x-text="cat" :value="cat"></option>
                            </template>
                        </select>
                        <span class="text-gray-500 flex items-center">or</span>
                        <input type="text" x-model="newCategory" placeholder="New category" 
                               class="flex-1 p-3 border rounded-lg bg-white">
                    </div>
                    <input type="hidden" name="category" x-model="selectedCategory || newCategory">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Display Order</label>
                    <input type="number" name="display_order" x-model="newOrder" min="1" 
                           class="w-full p-3 border rounded-lg bg-white">
                </div>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Service Name</label>
                <input type="text" name="name" x-model="newName" required
                       class="w-full p-3 border rounded-lg bg-white focus:ring-2 focus:ring-[#1a4d3e]"
                       placeholder="e.g., Conceptualization and design development">
            </div>
            
            <div class="flex gap-3">
                <button type="submit" name="add" 
                        class="bg-[#1a4d3e] text-white px-6 py-3 rounded-lg hover:bg-[#c95c0e] transition-colors">
                    <i class="fa-solid fa-save mr-2"></i> Add Service
                </button>
                <button type="button" @click="showForm = false" 
                        class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition-colors">
                    Cancel
                </button>
            </div>
        </form>
    </div>
    
    <!-- Services by Category -->
    <div class="space-y-6">
        <?php 
        $services->data_seek(0);
        $cat_services = [];
        
        // Group services by category
        while($s = $services->fetch_assoc()) {
            $cat_services[$s['category']][] = $s;
        }
        
        if (empty($cat_services)): 
        ?>
            <!-- Empty State -->
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-wrench text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-500 mb-2">No Services Yet</h3>
                <p class="text-gray-400 mb-6">Add your first service to showcase what you offer.</p>
                <button @click="showForm = true" 
                        class="bg-[#1a4d3e] text-white px-6 py-3 rounded-xl hover:bg-[#c95c0e] inline-flex items-center">
                    <i class="fa-solid fa-plus mr-2"></i> Add Your First Service
                </button>
            </div>
        <?php else: ?>
            <!-- Category Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach($cat_services as $category => $items): ?>
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">
                    <!-- Category Header - Solid colors, no gradient -->
                    <div class="bg-[#1a4d3e] p-4 text-white flex justify-between items-center">
                        <div>
                            <h2 class="text-xl font-bold"><?php echo htmlspecialchars($category); ?></h2>
                            <p class="text-sm text-gray-300"><?php echo count($items); ?> services</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="?delete_category=<?php echo urlencode($category); ?>" 
                               onclick="return confirm('Delete entire category & all services?')"
                               class="w-8 h-8 bg-white/10 rounded-full flex items-center justify-center hover:bg-red-600 transition-colors"
                               title="Delete category">
                                <i class="fa-solid fa-trash text-sm"></i>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Services List -->
                    <div class="p-4">
                        <ul class="space-y-2">
                            <?php foreach($items as $service): ?>
                            <li class="flex items-center justify-between group py-1 border-b border-gray-100 last:border-0">
                                <span class="text-gray-700"><?php echo htmlspecialchars($service['name']); ?></span>
                                <a href="?delete=<?php echo $service['id']; ?>" 
                                   onclick="return confirm('Delete this service?')"
                                   class="text-red-500 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        
                        <!-- Add service to this category quick button -->
                        <button @click="showForm = true; newCategory = '<?php echo addslashes($category); ?>'; selectedCategory = '<?php echo addslashes($category); ?>'"
                                class="mt-4 text-sm text-[#c95c0e] hover:text-[#1a4d3e] flex items-center">
                            <i class="fa-solid fa-plus mr-1"></i> Add service to this category
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Preview Section -->
            <div class="mt-8 bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
                <h3 class="text-lg font-bold mb-4 flex items-center">
                    <i class="fa-regular fa-eye text-[#c95c0e] mr-2"></i>
                    How services appear on website
                </h3>
                
                <div class="grid md:grid-cols-3 gap-4">
                    <?php 
                    $preview_categories = array_slice(array_keys($cat_services), 0, 3, true);
                    foreach($preview_categories as $cat): 
                    ?>
                    <div class="border border-gray-200 rounded-xl p-4 bg-gray-50">
                        <h4 class="font-bold text-[#1a4d3e] mb-2"><?php echo htmlspecialchars($cat); ?></h4>
                        <ul class="space-y-1">
                            <?php 
                            $preview_items = array_slice($cat_services[$cat], 0, 3);
                            foreach($preview_items as $item): 
                            ?>
                            <li class="text-sm text-gray-600 flex items-center">
                                <i class="fa-regular fa-circle-check text-[#c95c0e] mr-2 text-xs"></i>
                                <?php echo htmlspecialchars($item['name']); ?>
                            </li>
                            <?php endforeach; ?>
                            <?php if(count($cat_services[$cat]) > 3): ?>
                            <li class="text-xs text-gray-400 mt-1">+<?php echo count($cat_services[$cat]) - 3; ?> more</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Tips -->
            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                <h4 class="font-semibold text-blue-800 text-sm mb-2 flex items-center">
                    <i class="fa-solid fa-lightbulb mr-2"></i>
                    Service Management Tips:
                </h4>
                <ul class="text-xs text-blue-700 space-y-1 list-disc list-inside grid md:grid-cols-2">
                    <li><strong>Categories:</strong> Group related services (e.g., "Architectural Design")</li>
                    <li><strong>Service names:</strong> Use clear, descriptive names</li>
                    <li><strong>Order:</strong> Most important services should appear first</li>
                    <li><strong>Delete category:</strong> Removes all services in that category</li>
                    <li><strong>3-5 categories ideal:</strong> Not too many, not too few</li>
                    <li><strong>5-8 services per category:</strong> Keeps lists manageable</li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</div>
