<?php
$page_title = 'Core Values';

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

// Handle add
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $stmt = $conn->prepare("INSERT INTO core_values (title, description, display_order, updated_by) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $_POST['title'], $_POST['description'], $_POST['display_order'], $_SESSION['user_id']);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Core value added successfully!";
        header('Location: values.php');
        exit;
    } else {
        $error = "Error adding core value.";
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM core_values WHERE id = $id");
    $_SESSION['message'] = "Core value deleted!";
    header('Location: values.php');
    exit;
}

// Handle update order
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_order'])) {
    foreach ($_POST['order'] as $id => $order) {
        $stmt = $conn->prepare("UPDATE core_values SET display_order = ? WHERE id = ?");
        $stmt->bind_param("ii", $order, $id);
        $stmt->execute();
    }
    $_SESSION['message'] = "Order updated successfully!";
    header('Location: values.php');
    exit;
}

// Get all values
$values = $conn->query("SELECT * FROM core_values ORDER BY display_order");

// Check for session message
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

// Build values array for Alpine
$values_array = [];
while($v = $values->fetch_assoc()) {
    $values_array[] = $v;
}
?>

<!-- Main Content -->
<div class="flex-1 p-8  overflow-y-auto" 
x-data='{
    showForm: false,
    newTitle: "",
    newDesc: "",
    newOrder: 1,
    values: <?php echo json_encode($values_array ?: []); ?>,

    get nextOrder() {
        return this.values.length + 1;
    },

    addValue() {
        if (this.newTitle && this.newDesc) {
            document.getElementById("add-form").submit();
        }
    },

    removeValue(id) {
        if (confirm("Remove this value?")) {
            window.location.href = "?delete=" + id;
        }
    },

    moveUp(index) {
        if (index > 0) {
            [this.values[index-1], this.values[index]] = [this.values[index], this.values[index-1]];
        }
    },

    moveDown(index) {
        if (index < this.values.length - 1) {
            [this.values[index], this.values[index+1]] = [this.values[index+1], this.values[index]];
        }
    },

    saveOrder() {
        let form = document.createElement("form");
        form.method = "POST";

        this.values.forEach((value, idx) => {
            let input = document.createElement("input");
            input.type = "hidden";
            input.name = "order[" + value.id + "]";
            input.value = idx + 1;
            form.appendChild(input);
        });

        let submitInput = document.createElement("input");
        submitInput.type = "hidden";
        submitInput.name = "update_order";
        submitInput.value = "1";
        form.appendChild(submitInput);

        document.body.appendChild(form);
        form.submit();
    }
}'    
>
    
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-[#1a4d3e]">Core Values</h1>
            <p class="text-gray-600 mt-1">Define the principles that guide your company</p>
        </div>
        
        <div class="flex gap-3">
            <!-- Order counter -->
            <div class="bg-[#1a4d3e]/10 px-4 py-2 rounded-lg flex items-center">
                <i class="fa-solid fa-list-ol text-[#1a4d3e] mr-2"></i>
                <span class="font-medium" x-text="values.length + ' values'"></span>
            </div>
            
            <!-- Save Order button (only show if > 1 value) -->
            <button x-show="values.length > 1" @click="saveOrder" 
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                <i class="fa-solid fa-arrow-up-wide-short mr-2"></i> Save Order
            </button>
            
            <!-- Add button -->
            <button @click="showForm = !showForm; newOrder = nextOrder" 
                    class="bg-[#1a4d3e] text-white px-4 py-2 rounded-lg hover:bg-[#c95c0e] transition-colors flex items-center">
                <i x-text="showForm ? '×' : '+'" class="text-xl mr-1"></i>
                <span x-text="showForm ? 'Cancel' : 'Add Value'"></span>
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
            Add New Core Value
        </h2>
        
        <form method="POST" id="add-form">
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Value Title</label>
                    <input type="text" name="title" x-model="newTitle" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1a4d3e]"
                           placeholder="e.g., Integrity, Innovation, Excellence">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Display Order</label>
                    <input type="number" name="display_order" x-model="newOrder" min="1" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1a4d3e]">
                    <p class="text-xs text-gray-500 mt-1">Position in list (1 = first)</p>
                </div>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" x-model="newDesc" rows="3" required
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1a4d3e]"
                          placeholder="Describe what this value means..."></textarea>
            </div>
            
            <div class="flex gap-3">
                <button type="submit" name="add" 
                        class="bg-[#1a4d3e] text-white px-6 py-3 rounded-xl hover:bg-[#c95c0e] transition-colors">
                    <i class="fa-solid fa-save mr-2"></i> Save Value
                </button>
                <button type="button" @click="showForm = false" 
                        class="bg-gray-200 text-gray-700 px-6 py-3 rounded-xl hover:bg-gray-300 transition-colors">
                    Cancel
                </button>
            </div>
        </form>
    </div>
    
    <!-- Values Grid/List -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <!-- Empty State -->
        <template x-if="values.length === 0">
            <div class="text-center py-12">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-heart text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-500 mb-2">No Core Values Yet</h3>
                <p class="text-gray-400 mb-6">Add your first core value to define your company principles.</p>
                <button @click="showForm = true; newOrder = 1" 
                        class="bg-[#1a4d3e] text-white px-6 py-3 rounded-xl hover:bg-[#c95c0e] inline-flex items-center">
                    <i class="fa-solid fa-plus mr-2"></i> Add Your First Value
                </button>
            </div>
        </template>
        
        <!-- Values List -->
        <template x-if="values.length > 0">
            <div>
                <div class="grid gap-3">
                    <template x-for="(value, index) in values" :key="value.id">
                        <div class="flex items-center p-4 bg-gray-50 rounded-xl hover:shadow-md transition-shadow">
                            <!-- Drag Handle / Order Controls -->
                            <div class="flex flex-col mr-4">
                                <button @click="moveUp(index)" :disabled="index === 0"
                                        :class="{'opacity-30 cursor-not-allowed': index === 0}" 
                                        class="text-gray-500 hover:text-[#c95c0e]">
                                    <i class="fa-solid fa-chevron-up"></i>
                                </button>
                                <button @click="moveDown(index)" :disabled="index === values.length-1"
                                        :class="{'opacity-30 cursor-not-allowed': index === values.length-1}"
                                        class="text-gray-500 hover:text-[#c95c0e]">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </button>
                            </div>
                            
                            <!-- Order Badge -->
                            <div class="w-10 h-10 bg-[#1a4d3e] text-white rounded-full flex items-center justify-center font-bold mr-4">
                                <span x-text="index + 1"></span>
                            </div>
                            
                            <!-- Content -->
                            <div class="flex-1">
                                <h3 class="font-bold text-lg text-[#1a4d3e]" x-text="value.title"></h3>
                                <p class="text-gray-600" x-text="value.description"></p>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex gap-2">
                                <button @click="removeValue(value.id, index)" 
                                        class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-red-500 hover:bg-red-500 hover:text-white transition-colors shadow-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
                
                <!-- Example Preview -->
                <div class="mt-8 p-4 bg-gradient-to-r from-[#1a4d3e]/5 to-[#c95c0e]/5 rounded-xl">
                    <h4 class="font-semibold text-gray-700 mb-3 flex items-center">
                        <i class="fa-regular fa-eye text-[#c95c0e] mr-2"></i>
                        How they appear on website:
                    </h4>
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <template x-for="(value, index) in values.slice(0,4)" :key="'preview-'+index">
                            <div class="bg-white p-4 rounded-xl shadow-sm text-center">
                                <div class="w-12 h-12 bg-[#1a4d3e]/10 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fa-solid fa-heart text-[#c95c0e]"></i>
                                </div>
                                <h5 class="font-bold text-[#1a4d3e]" x-text="value.title"></h5>
                                <p class="text-xs text-gray-600 mt-1 line-clamp-2" x-text="value.description"></p>
                            </div>
                        </template>
                    </div>
                </div>
                
                <!-- Tips -->
                <div class="mt-6 bg-blue-50 p-4 rounded-lg">
                    <h4 class="font-semibold text-blue-800 text-sm mb-2 flex items-center">
                        <i class="fa-solid fa-lightbulb mr-2"></i>
                        Core Values Tips:
                    </h4>
                    <ul class="text-xs text-blue-700 space-y-1 list-disc list-inside">
                        <li><strong>Keep it concise:</strong> Values should be 1-3 words (e.g., "Integrity", "Innovation")</li>
                        <li><strong>Be specific:</strong> Descriptions should explain what the value means in practice</li>
                        <li><strong>Order matters:</strong> Most important values should appear first</li>
                        <li><strong>3-7 values ideal:</strong> Enough to be meaningful, not too many to remember</li>
                    </ul>
                </div>
            </div>
        </template>
    </div>
</div>
