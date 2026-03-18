<?php
require_once '../../config/database.php';
require_once '../../config/admin-config.php';

requireEdit();

$conn = getDB();
$message = '';

// Handle add
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $stmt = $conn->prepare("INSERT INTO core_values (title, description, display_order, updated_by) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $_POST['title'], $_POST['description'], $_POST['display_order'], $_SESSION['user_id']);
    $stmt->execute();
    $message = "Core value added!";
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM core_values WHERE id = $id");
    $message = "Core value deleted!";
}

// Handle update order
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_order'])) {
    foreach ($_POST['order'] as $id => $order) {
        $stmt = $conn->prepare("UPDATE core_values SET display_order = ? WHERE id = ?");
        $stmt->bind_param("ii", $order, $id);
        $stmt->execute();
    }
    $message = "Order updated!";
}

$values = $conn->query("SELECT * FROM core_values ORDER BY display_order");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Core Values - SDC2 Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <?php include '../includes/sidebar.php'; ?>
        
        <div class="flex-1 p-8 ml-64" x-data="{ 
            showForm: false,
            newTitle: '',
            newDesc: '',
            values: <?php 
                $vals = [];
                while($v = $values->fetch_assoc()) {
                    $vals[] = $v;
                }
                echo json_encode($vals);
            ?>,
            addValue() {
                if (this.newTitle && this.newDesc) {
                    this.values.push({
                        id: Date.now(),
                        title: this.newTitle,
                        description: this.newDesc,
                        display_order: this.values.length + 1
                    });
                    this.newTitle = '';
                    this.newDesc = '';
                    this.showForm = false;
                }
            },
            removeValue(index) {
                if (confirm('Remove this value?')) {
                    this.values.splice(index, 1);
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
            }
        }">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-[#1a4d3e]">Core Values</h1>
                <button @click="showForm = !showForm" 
                        class="bg-[#1a4d3e] text-white px-4 py-2 rounded-lg hover:bg-[#c95c0e]">
                    <i class="fa-solid fa-plus mr-2"></i> Add Value
                </button>
            </div>
            
            <?php if ($message): ?>
                <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4"><?php echo $message; ?></div>
            <?php endif; ?>
            
            <!-- Add Form -->
            <div x-show="showForm" x-cloak x-transition class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                <h2 class="text-lg font-bold mb-4">New Core Value</h2>
                <div class="space-y-4">
                    <input type="text" x-model="newTitle" placeholder="Value Title (e.g., Integrity)" 
                           class="w-full p-3 border rounded-lg">
                    <textarea x-model="newDesc" rows="3" placeholder="Description" 
                              class="w-full p-3 border rounded-lg"></textarea>
                    <div class="flex gap-3">
                        <button @click="addValue" class="bg-[#1a4d3e] text-white px-6 py-2 rounded-lg hover:bg-[#c95c0e]">
                            Save
                        </button>
                        <button @click="showForm = false" class="bg-gray-300 px-6 py-2 rounded-lg hover:bg-gray-400">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Values List -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <template x-if="values.length === 0">
                    <p class="text-gray-500 text-center py-8">No core values yet. Click "Add Value" to start.</p>
                </template>
                
                <template x-for="(value, index) in values" :key="value.id">
                    <div class="flex items-center border-b last:border-0 py-4">
                        <div class="flex flex-col mr-4">
                            <button @click="moveUp(index)" :disabled="index === 0"
                                    :class="{'opacity-30': index === 0}" 
                                    class="text-gray-500 hover:text-[#c95c0e]">
                                <i class="fa-solid fa-chevron-up"></i>
                            </button>
                            <button @click="moveDown(index)" :disabled="index === values.length-1"
                                    :class="{'opacity-30': index === values.length-1}"
                                    class="text-gray-500 hover:text-[#c95c0e]">
                                <i class="fa-solid fa-chevron-down"></i>
                            </button>
                        </div>
                        
                        <div class="flex-1">
                            <h3 class="font-bold text-[#1a4d3e]" x-text="value.title"></h3>
                            <p class="text-gray-600 text-sm" x-text="value.description"></p>
                        </div>
                        
                        <button @click="removeValue(index)" 
                                class="text-red-500 hover:text-red-700 ml-4">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </template>
            </div>
        </div>
    </div>
</body>
</html>