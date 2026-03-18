<?php
require_once '../../config/database.php';
require_once '../../config/admin-config.php';

requireEdit();

$conn = getDB();
$message = '';

// Handle add category/service
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $stmt = $conn->prepare("INSERT INTO services (category, name, display_order, updated_by) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $_POST['category'], $_POST['name'], $_POST['display_order'], $_SESSION['user_id']);
    $stmt->execute();
    $message = "Service added!";
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM services WHERE id = $id");
    $message = "Service deleted!";
}

$services = $conn->query("SELECT * FROM services ORDER BY category, display_order");
$categories = $conn->query("SELECT DISTINCT category FROM services ORDER BY category");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - SDC2 Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <?php include '../includes/sidebar.php'; ?>
        
        <div class="flex-1 p-8 ml-64" x-data="{ 
            showForm: false,
            newCategory: '',
            newName: '',
            categories: <?php 
                $cats = [];
                while($c = $categories->fetch_assoc()) {
                    $cats[] = $c['category'];
                }
                echo json_encode($cats);
            ?>,
            services: <?php 
                $services->data_seek(0);
                $svcs = [];
                while($s = $services->fetch_assoc()) {
                    $svcs[] = $s;
                }
                echo json_encode($svcs);
            ?>,
            addService() {
                if (this.newCategory && this.newName) {
                    // Add via form submit
                    document.getElementById('add-form').submit();
                }
            }
        }">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-[#1a4d3e]">Services</h1>
                <button @click="showForm = !showForm" 
                        class="bg-[#1a4d3e] text-white px-4 py-2 rounded-lg hover:bg-[#c95c0e]">
                    <i class="fa-solid fa-plus mr-2"></i> Add Service
                </button>
            </div>
            
            <?php if ($message): ?>
                <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4"><?php echo $message; ?></div>
            <?php endif; ?>
            
            <!-- Add Form -->
            <div x-show="showForm" x-cloak x-transition class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                <h2 class="text-lg font-bold mb-4">New Service</h2>
                <form method="POST" id="add-form">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <select name="category" x-model="newCategory" required class="p-3 border rounded-lg">
                            <option value="">Select Category</option>
                            <option value="Architectural Design">Architectural Design</option>
                            <option value="Construction Management">Construction Management</option>
                            <option value="Renovation">Renovation</option>
                            <option value="Consulting">Consulting</option>
                            <template x-for="cat in categories" :key="cat">
                                <option x-text="cat" :value="cat"></option>
                            </template>
                        </select>
                        <input type="text" name="category" x-model="newCategory" placeholder="Or new category" 
                               class="p-3 border rounded-lg">
                    </div>
                    <div class="mb-4">
                        <input type="text" name="name" x-model="newName" placeholder="Service name" required 
                               class="w-full p-3 border rounded-lg">
                    </div>
                    <input type="number" name="display_order" value="1" hidden>
                    <div class="flex gap-3">
                        <button type="submit" name="add" class="bg-[#1a4d3e] text-white px-6 py-2 rounded-lg hover:bg-[#c95c0e]">
                            Save
                        </button>
                        <button type="button" @click="showForm = false" class="bg-gray-300 px-6 py-2 rounded-lg hover:bg-gray-400">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Services List by Category -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <?php 
                $services->data_seek(0);
                $current_cat = '';
                while($s = $services->fetch_assoc()): 
                    if ($current_cat != $s['category']):
                        if ($current_cat != '') echo '</div>';
                        $current_cat = $s['category'];
                ?>
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-[#1a4d3e] mb-3"><?php echo $s['category']; ?></h2>
                <?php endif; ?>
                
                <div class="flex items-center justify-between py-2 border-b last:border-0">
                    <span class="text-gray-700"><?php echo $s['name']; ?></span>
                    <a href="?delete=<?php echo $s['id']; ?>" onclick="return confirm('Delete?')" 
                       class="text-red-500 hover:text-red-700 text-sm">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </div>
                
                <?php endwhile; ?>
                <?php if ($current_cat != '') echo '</div>'; ?>
                
                <?php if ($services->num_rows == 0): ?>
                    <p class="text-gray-500 text-center py-8">No services yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>