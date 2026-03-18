<?php
$page_title = 'Projects';

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

// Handle add project
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    // Check project limit (max 5)
    $count = $conn->query("SELECT COUNT(*) as total FROM projects")->fetch_assoc()['total'];
    
    if ($count >= 5) {
        $_SESSION['error'] = "Maximum 5 projects reached. Please delete an existing project first.";
        header('Location: projects.php');
        exit;
    } else {
        $target_dir = "../uploads/projects/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $image = '';
        if ($_FILES['image']['name']) {
            $image = time() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $_FILES['image']['name']);
            $target_file = $target_dir . $image;
            move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        }
        
        $stmt = $conn->prepare("INSERT INTO projects (title, description, image, display_order, created_by) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssii", $_POST['title'], $_POST['description'], $image, $_POST['display_order'], $_SESSION['user_id']);
        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Project added successfully!";
            header('Location: projects.php');
            exit;
        } else {
            $_SESSION['error'] = "Error adding project.";
            header('Location: projects.php');
            exit;
        }
    }
}

// Handle update project
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['project_id'];
    
    // Get current image
    $result = $conn->query("SELECT image FROM projects WHERE id = $id");
    $current = $result->fetch_assoc();
    $image = $current['image'];
    
    // Handle new image upload
    if ($_FILES['image']['name']) {
        $target_dir = "../uploads/projects/";
        $image = time() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $_FILES['image']['name']);
        $target_file = $target_dir . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        
        // Delete old image
        if ($current['image'] && file_exists($target_dir . $current['image'])) {
            unlink($target_dir . $current['image']);
        }
    }
    
    $stmt = $conn->prepare("UPDATE projects SET title=?, description=?, image=?, display_order=? WHERE id=?");
    $stmt->bind_param("sssii", $_POST['title'], $_POST['description'], $image, $_POST['display_order'], $id);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Project updated successfully!";
        header('Location: projects.php');
        exit;
    } else {
        $_SESSION['error'] = "Error updating project.";
        header('Location: projects.php');
        exit;
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    // Delete image file
    $result = $conn->query("SELECT image FROM projects WHERE id = $id");
    if ($row = $result->fetch_assoc()) {
        if ($row['image'] && file_exists("../uploads/projects/" . $row['image'])) {
            unlink("../uploads/projects/" . $row['image']);
        }
    }
    
    $conn->query("DELETE FROM projects WHERE id = $id");
    $_SESSION['message'] = "Project deleted successfully!";
    header('Location: projects.php');
    exit;
}

// Get all projects
$projects = $conn->query("SELECT * FROM projects ORDER BY display_order");
$project_count = $projects->num_rows;
$projects_array = [];
while($row = $projects->fetch_assoc()) {
    $projects_array[] = $row;
}

// Check for session messages
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>

<!-- Main Content -->
<div class="flex-1 p-8  overflow-y-auto" 
     x-data="{
        projects: <?php echo json_encode($projects_array); ?>,
        showForm: false,
        editingId: null,
        formData: {
            title: '',
            description: '',
            display_order: 1
        },
        previewImage: null,
        showSuccess: <?php echo $message ? 'true' : 'false'; ?>,
        showError: <?php echo $error ? 'true' : 'false'; ?>,
        limit: 5,
        
        get projectCount() {
            return this.projects.length;
        },
        
        canAdd() {
            return this.projectCount < this.limit;
        },
        
        resetForm() {
            this.formData = {
                title: '',
                description: '',
                display_order: this.projectCount + 1
            };
            this.previewImage = null;
            this.editingId = null;
        },
        
        editProject(index) {
            const p = this.projects[index];
            this.formData = {
                title: p.title,
                description: p.description,
                display_order: p.display_order
            };
            this.editingId = p.id;
            this.previewImage = p.image ? '../../uploads/projects/' + p.image : null;
            this.showForm = true;
        },
        
        deleteProject(id, index) {
            if (confirm('Are you sure you want to delete this project?')) {
                window.location.href = `?delete=${id}`;
            }
        },
        
        previewFile(event) {
            const file = event.target.files[0];
            if (file) {
                this.previewImage = URL.createObjectURL(file);
            }
        },
        
        getImageUrl(imageName) {
            return imageName ? '../../uploads/projects/' + imageName : null;
        }
     }"
     x-init="setTimeout(() => { showSuccess = false; showError = false; }, 3000)">
    
    <!-- Header with counter -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-[#1a4d3e]">Projects</h1>
            <p class="text-gray-600 mt-1">Manage your portfolio projects (max 5)</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="bg-[#1a4d3e] text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fa-solid fa-layer-group mr-2"></i>
                <span x-text="projectCount"></span>/<span x-text="limit"></span> Projects
            </div>
            
            <template x-if="canAdd()">
                <button @click="resetForm(); showForm = !showForm" 
                        class="bg-[#c95c0e] text-white px-4 py-2 rounded-lg hover:bg-[#b04d0c] transition-colors flex items-center">
                    <i class="fa-solid fa-plus mr-2"></i>
                    <span x-text="showForm ? 'Cancel' : 'Add Project'"></span>
                </button>
            </template>
        </div>
    </div>
    
    <!-- Success Message -->
    <div x-show="showSuccess" x-cloak x-transition
         class="bg-green-100 border-l-4 border-green-600 text-green-700 p-4 rounded-lg mb-4 flex justify-between items-center">
        <div class="flex items-center">
            <i class="fa-solid fa-circle-check mr-3 text-green-600"></i>
            <span><?php echo $message ?: 'Operation successful!'; ?></span>
        </div>
        <button @click="showSuccess = false"><i class="fa-solid fa-times"></i></button>
    </div>
    
    <!-- Error Message -->
    <div x-show="showError" x-cloak x-transition
         class="bg-red-100 border-l-4 border-red-600 text-red-700 p-4 rounded-lg mb-4 flex justify-between items-center">
        <div class="flex items-center">
            <i class="fa-solid fa-exclamation-circle mr-3 text-red-600"></i>
            <span><?php echo $error ?: 'Error occurred!'; ?></span>
        </div>
        <button @click="showError = false"><i class="fa-solid fa-times"></i></button>
    </div>
    
    <!-- Add/Edit Form -->
    <div x-show="showForm" x-cloak x-transition class="bg-white rounded-2xl shadow-lg p-6 mb-8 border-2 border-[#c95c0e]">
        <h2 class="text-lg font-bold mb-4" x-text="editingId ? 'Edit Project' : 'Add New Project'"></h2>
        
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="project_id" x-model="editingId">
            
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Left Column - Form Fields -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Project Title</label>
                        <input type="text" name="title" x-model="formData.title" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1a4d3e] focus:border-transparent bg-white"
                               placeholder="e.g., Eco-Haven Residence">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="description" x-model="formData.description" rows="4" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1a4d3e] focus:border-transparent bg-white"
                                  placeholder="Describe the project..."></textarea>
                        <p class="text-xs text-gray-500 mt-1" x-text="formData.description.length + ' characters'"></p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Display Order</label>
                        <input type="number" name="display_order" x-model="formData.display_order" min="1" max="5" required
                               class="w-32 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1a4d3e] focus:border-transparent bg-white">
                        <p class="text-xs text-gray-500 mt-1">Lower numbers appear first</p>
                    </div>
                </div>
                
                <!-- Right Column - Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Project Image</label>
                    
                    <!-- Image Preview -->
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 text-center bg-white"
                         :class="{ 'border-[#c95c0e] bg-orange-50': previewImage }">
                        
                        <template x-if="previewImage">
                            <div class="mb-4">
                                <img :src="previewImage" class="w-full h-48 object-cover rounded-lg shadow-md">
                            </div>
                        </template>
                        
                        <template x-if="!previewImage && editingId">
                            <div class="mb-4">
                                <img :src="getImageUrl(projects.find(p => p.id === editingId)?.image)" 
                                     class="w-full h-48 object-cover rounded-lg shadow-md"
                                     @error="$event.target.src='https://via.placeholder.com/600x400?text=No+Image'">
                            </div>
                        </template>
                        
                        <template x-if="!previewImage && !editingId">
                            <div class="py-8">
                                <i class="fa-solid fa-cloud-upload-alt text-4xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500">Click to upload an image</p>
                                <p class="text-xs text-gray-400 mt-1">PNG, JPG, JPEG up to 5MB</p>
                            </div>
                        </template>
                        
                        <input type="file" name="image" @change="previewFile" accept="image/*"
                               class="mt-4 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#1a4d3e] file:text-white hover:file:bg-[#c95c0e]">
                        
                        <p class="text-xs text-gray-400 mt-2">Recommended size: 600x400 pixels</p>
                    </div>
                </div>
            </div>
            
            <div class="flex gap-3 mt-6 pt-4 border-t">
                <button type="submit" name="add" x-show="!editingId" 
                        class="bg-[#1a4d3e] text-white px-8 py-3 rounded-xl hover:bg-[#c95c0e] transition-colors font-medium">
                    <i class="fa-solid fa-save mr-2"></i> Add Project
                </button>
                
                <button type="submit" name="update" x-show="editingId" 
                        class="bg-[#1a4d3e] text-white px-8 py-3 rounded-xl hover:bg-[#c95c0e] transition-colors font-medium">
                    <i class="fa-solid fa-save mr-2"></i> Update Project
                </button>
                
                <button type="button" @click="showForm = false; resetForm()" 
                        class="bg-gray-200 text-gray-700 px-8 py-3 rounded-xl hover:bg-gray-300 transition-colors font-medium">
                    Cancel
                </button>
            </div>
        </form>
    </div>
    
    <!-- Projects Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <template x-for="(project, index) in projects" :key="project.id">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow border border-gray-200">
                <!-- Image -->
                <div class="relative h-48 bg-gray-100">
                    <img :src="getImageUrl(project.image)" 
                         :alt="project.title"
                         class="w-full h-full object-cover"
                         @error="$event.target.src = 'https://via.placeholder.com/600x400?text=No+Image'">
                    
                    <!-- Order Badge -->
                    <div class="absolute top-3 left-3 bg-[#1a4d3e] text-white text-xs px-2 py-1 rounded-full">
                        #<span x-text="project.display_order"></span>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="absolute top-3 right-3 flex gap-2">
                        <button @click="editProject(index)" 
                                class="w-8 h-8 bg-white rounded-full flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition-colors shadow-md">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button @click="deleteProject(project.id, index)" 
                                class="w-8 h-8 bg-white rounded-full flex items-center justify-center text-red-600 hover:bg-red-600 hover:text-white transition-colors shadow-md">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Content -->
                <div class="p-5">
                    <h3 class="font-bold text-lg text-[#1a4d3e] mb-2" x-text="project.title"></h3>
                    <p class="text-gray-600 text-sm line-clamp-3" x-text="project.description"></p>
                    
                    <!-- Character count -->
                    <div class="mt-3 flex justify-between items-center text-xs text-gray-400">
                        <span x-text="project.description.length + ' characters'"></span>
                        <span class="capitalize">Project</span>
                    </div>
                </div>
            </div>
        </template>
        
        <!-- Empty State -->
        <template x-if="projects.length === 0">
            <div class="col-span-3 bg-white rounded-2xl shadow-lg p-12 text-center border border-gray-200">
                <i class="fa-solid fa-folder-open text-5xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-500 mb-2">No Projects Yet</h3>
                <p class="text-gray-400 mb-6">Click the "Add Project" button to create your first project.</p>
                <button @click="resetForm(); showForm = true" 
                        class="bg-[#1a4d3e] text-white px-6 py-3 rounded-xl hover:bg-[#c95c0e] inline-flex items-center">
                    <i class="fa-solid fa-plus mr-2"></i> Add Your First Project
                </button>
            </div>
        </template>
    </div>
    
    <!-- Quick Stats -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-xl shadow flex items-center border border-gray-200">
            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                <i class="fa-solid fa-images text-[#1a4d3e]"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Projects</p>
                <p class="text-xl font-bold" x-text="projectCount + ' / ' + limit"></p>
            </div>
        </div>
        
        <div class="bg-white p-4 rounded-xl shadow flex items-center border border-gray-200">
            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                <i class="fa-solid fa-plus-circle text-[#c95c0e]"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Slots Available</p>
                <p class="text-xl font-bold" x-text="limit - projectCount"></p>
            </div>
        </div>
        
        <div class="bg-white p-4 rounded-xl shadow flex items-center border border-gray-200">
            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                <i class="fa-solid fa-check-circle text-green-600"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">With Images</p>
                <p class="text-xl font-bold" x-text="projects.filter(p => p.image).length"></p>
            </div>
        </div>
    </div>
    
    <!-- Instructions -->
    <div class="mt-6 bg-blue-50 p-4 rounded-xl border border-blue-200">
        <h4 class="font-semibold text-blue-800 text-sm mb-2 flex items-center">
            <i class="fa-solid fa-circle-info mr-2"></i>
            Project Management Tips:
        </h4>
        <ul class="text-xs text-blue-700 space-y-1 list-disc list-inside">
            <li>Maximum <strong>5 projects</strong> allowed at a time</li>
            <li>Each project needs: <strong>Title, Description, and Image</strong></li>
            <li>Display order controls the sequence (1 appears first, 5 appears last)</li>
            <li>Click the <i class="fa-solid fa-pen text-blue-600 mx-1"></i> icon to edit a project</li>
            <li>Click the <i class="fa-solid fa-trash text-red-600 mx-1"></i> icon to delete a project</li>
            <li>Recommended image size: 600x400 pixels for best display</li>
        </ul>
    </div>
</div>
