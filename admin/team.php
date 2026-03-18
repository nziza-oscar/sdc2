<?php
require_once '../../config/database.php';
require_once '../../config/admin-config.php';

requireEdit();

$conn = getDB();
$message = '';
$error = '';

// Handle add team member
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    // Check team limit (max 5)
    $count = $conn->query("SELECT COUNT(*) as total FROM team")->fetch_assoc()['total'];
    
    if ($count >= 5) {
        $error = "Maximum 5 team members reached. Please delete an existing member first.";
    } else {
        $target_dir = "../uploads/team/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $image = '';
        if ($_FILES['image']['name']) {
            $image = time() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $_FILES['image']['name']);
            $target_file = $target_dir . $image;
            move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        }
        
        $stmt = $conn->prepare("INSERT INTO team (name, position, bio, image, linkedin, email, display_order, created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssii", 
            $_POST['name'], 
            $_POST['position'], 
            $_POST['bio'], 
            $image, 
            $_POST['linkedin'], 
            $_POST['email'], 
            $_POST['display_order'], 
            $_SESSION['user_id']
        );
        
        if ($stmt->execute()) {
            $message = "Team member added successfully!";
        } else {
            $error = "Error adding team member.";
        }
    }
}

// Handle update team member
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['member_id'];
    
    // Get current image
    $result = $conn->query("SELECT image FROM team WHERE id = $id");
    $current = $result->fetch_assoc();
    $image = $current['image'];
    
    // Handle new image upload
    if ($_FILES['image']['name']) {
        $target_dir = "../uploads/team/";
        $image = time() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $_FILES['image']['name']);
        $target_file = $target_dir . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        
        // Delete old image
        if ($current['image'] && file_exists($target_dir . $current['image'])) {
            unlink($target_dir . $current['image']);
        }
    }
    
    $stmt = $conn->prepare("UPDATE team SET name=?, position=?, bio=?, image=?, linkedin=?, email=?, display_order=? WHERE id=?");
    $stmt->bind_param("ssssssii", 
        $_POST['name'], 
        $_POST['position'], 
        $_POST['bio'], 
        $image, 
        $_POST['linkedin'], 
        $_POST['email'], 
        $_POST['display_order'], 
        $id
    );
    
    if ($stmt->execute()) {
        $message = "Team member updated successfully!";
    } else {
        $error = "Error updating team member.";
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    // Delete image file
    $result = $conn->query("SELECT image FROM team WHERE id = $id");
    if ($row = $result->fetch_assoc()) {
        if ($row['image'] && file_exists("../uploads/team/" . $row['image'])) {
            unlink("../uploads/team/" . $row['image']);
        }
    }
    
    $conn->query("DELETE FROM team WHERE id = $id");
    $message = "Team member deleted successfully!";
}

// Get all team members
$team = $conn->query("SELECT * FROM team ORDER BY display_order");
$team_count = $team->num_rows;
$team_array = [];
while($row = $team->fetch_assoc()) {
    $team_array[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team - SDC2 Admin</title>
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
        <div class="flex-1 p-8 ml-64 overflow-y-auto" 
             x-data="{
                team: <?php echo json_encode($team_array); ?>,
                showForm: false,
                editingId: null,
                formData: {
                    name: '',
                    position: '',
                    bio: '',
                    linkedin: '',
                    email: '',
                    display_order: 1
                },
                previewImage: null,
                showSuccess: <?php echo $message ? 'true' : 'false'; ?>,
                showError: <?php echo $error ? 'true' : 'false'; ?>,
                limit: 5,
                
                get teamCount() {
                    return this.team.length;
                },
                
                canAdd() {
                    return this.teamCount < this.limit;
                },
                
                resetForm() {
                    this.formData = {
                        name: '',
                        position: '',
                        bio: '',
                        linkedin: '',
                        email: '',
                        display_order: this.teamCount + 1
                    };
                    this.previewImage = null;
                    this.editingId = null;
                },
                
                editMember(index) {
                    const m = this.team[index];
                    this.formData = {
                        name: m.name,
                        position: m.position,
                        bio: m.bio,
                        linkedin: m.linkedin || '',
                        email: m.email || '',
                        display_order: m.display_order
                    };
                    this.editingId = m.id;
                    this.previewImage = m.image ? '../../uploads/team/' + m.image : null;
                    this.showForm = true;
                },
                
                deleteMember(id, index) {
                    if (confirm('Are you sure you want to delete this team member?')) {
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
                    return imageName ? '../../uploads/team/' + imageName : null;
                },
                
                validateEmail(email) {
                    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
                },
                
                validateLinkedin(url) {
                    return !url || url.includes('linkedin.com/') || url === '';
                }
             }"
             x-init="setTimeout(() => { showSuccess = false; showError = false; }, 3000)">
            
            <!-- Header with counter -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-[#1a4d3e]">Team Members</h1>
                    <p class="text-gray-600 mt-1">Manage your team (max 5 members)</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="bg-[#1a4d3e] text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fa-solid fa-users mr-2"></i>
                        <span x-text="teamCount"></span>/<span x-text="limit"></span> Members
                    </div>
                    
                    <template x-if="canAdd()">
                        <button @click="resetForm(); showForm = !showForm" 
                                class="bg-[#c95c0e] text-white px-4 py-2 rounded-lg hover:bg-[#b04d0c] transition-colors flex items-center">
                            <i class="fa-solid fa-user-plus mr-2"></i>
                            <span x-text="showForm ? 'Cancel' : 'Add Member'"></span>
                        </button>
                    </template>
                </div>
            </div>
            
            <!-- Success Message -->
            <div x-show="showSuccess" x-cloak x-transition
                 class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex justify-between items-center">
                <span><i class="fa-solid fa-circle-check mr-2"></i> <?php echo $message ?: 'Operation successful!'; ?></span>
                <button @click="showSuccess = false"><i class="fa-solid fa-times"></i></button>
            </div>
            
            <!-- Error Message -->
            <div x-show="showError" x-cloak x-transition
                 class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 flex justify-between items-center">
                <span><i class="fa-solid fa-exclamation-circle mr-2"></i> <?php echo $error ?: 'Error occurred!'; ?></span>
                <button @click="showError = false"><i class="fa-solid fa-times"></i></button>
            </div>
            
            <!-- Add/Edit Form -->
            <div x-show="showForm" x-cloak x-transition class="bg-white rounded-2xl shadow-lg p-6 mb-8 border-2 border-[#c95c0e]">
                <h2 class="text-lg font-bold mb-4" x-text="editingId ? 'Edit Team Member' : 'Add New Team Member'"></h2>
                
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="member_id" x-model="editingId">
                    
                    <div class="grid md:grid-cols-3 gap-6">
                        <!-- Left Column - Image Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Profile Photo</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 text-center"
                                 :class="{ 'border-[#c95c0e] bg-orange-50': previewImage }">
                                
                                <!-- Image Preview -->
                                <template x-if="previewImage">
                                    <div class="mb-4">
                                        <img :src="previewImage" class="w-full h-48 object-cover rounded-lg shadow-md">
                                    </div>
                                </template>
                                
                                <template x-if="!previewImage && editingId">
                                    <div class="mb-4">
                                        <img :src="getImageUrl(team.find(m => m.id === editingId)?.image)" 
                                             class="w-full h-48 object-cover rounded-lg shadow-md">
                                    </div>
                                </template>
                                
                                <template x-if="!previewImage && !editingId">
                                    <div class="py-8">
                                        <i class="fa-solid fa-user-circle text-5xl text-gray-300 mb-3"></i>
                                        <p class="text-gray-500">Click to upload photo</p>
                                        <p class="text-xs text-gray-400 mt-1">PNG, JPG up to 2MB</p>
                                    </div>
                                </template>
                                
                                <input type="file" name="image" @change="previewFile" accept="image/*"
                                       class="mt-4 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#1a4d3e] file:text-white hover:file:bg-[#c95c0e]">
                                
                                <p class="text-xs text-gray-400 mt-2">Square image recommended (400x400)</p>
                            </div>
                        </div>
                        
                        <!-- Right Column - Form Fields (2 columns) -->
                        <div class="md:col-span-2 space-y-4">
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                    <input type="text" name="name" x-model="formData.name" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1a4d3e] focus:border-transparent"
                                           placeholder="e.g., John Doe">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Position *</label>
                                    <input type="text" name="position" x-model="formData.position" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1a4d3e] focus:border-transparent"
                                           placeholder="e.g., Lead Architect">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bio *</label>
                                <textarea name="bio" x-model="formData.bio" rows="4" required
                                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1a4d3e] focus:border-transparent"
                                          placeholder="Write a brief bio..."></textarea>
                                <p class="text-xs text-gray-500 mt-1" x-text="formData.bio.length + ' characters'"></p>
                            </div>
                            
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fa-brands fa-linkedin text-blue-600 mr-1"></i> LinkedIn URL
                                    </label>
                                    <input type="url" name="linkedin" x-model="formData.linkedin"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1a4d3e] focus:border-transparent"
                                           placeholder="https://linkedin.com/in/...">
                                    <p class="text-xs text-gray-500 mt-1" x-show="!validateLinkedin(formData.linkedin) && formData.linkedin" class="text-red-500">
                                        Should be a LinkedIn URL
                                    </p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fa-regular fa-envelope text-gray-600 mr-1"></i> Email
                                    </label>
                                    <input type="email" name="email" x-model="formData.email"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1a4d3e] focus:border-transparent"
                                           placeholder="john@example.com">
                                    <p class="text-xs text-gray-500 mt-1" x-show="!validateEmail(formData.email) && formData.email" class="text-red-500">
                                        Enter a valid email
                                    </p>
                                </div>
                            </div>
                            
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Display Order</label>
                                    <input type="number" name="display_order" x-model="formData.display_order" min="1" max="5" required
                                           class="w-32 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1a4d3e] focus:border-transparent">
                                    <p class="text-xs text-gray-500 mt-1">Lower numbers appear first</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex gap-3 mt-6 pt-4 border-t">
                        <button type="submit" name="add" x-show="!editingId" 
                                class="bg-[#1a4d3e] text-white px-8 py-3 rounded-xl hover:bg-[#c95c0e] transition-colors font-medium">
                            <i class="fa-solid fa-user-plus mr-2"></i> Add Team Member
                        </button>
                        
                        <button type="submit" name="update" x-show="editingId" 
                                class="bg-[#1a4d3e] text-white px-8 py-3 rounded-xl hover:bg-[#c95c0e] transition-colors font-medium">
                            <i class="fa-solid fa-save mr-2"></i> Update Member
                        </button>
                        
                        <button type="button" @click="showForm = false; resetForm()" 
                                class="bg-gray-200 text-gray-700 px-8 py-3 rounded-xl hover:bg-gray-300 transition-colors font-medium">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Team Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <template x-for="(member, index) in team" :key="member.id">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <!-- Photo -->
                        <div class="relative h-64 bg-gray-100">
                            <img :src="getImageUrl(member.image) || 'https://via.placeholder.com/400x400?text=No+Photo'" 
                                 :alt="member.name"
                                 class="w-full h-full object-cover">
                            
                            <!-- Order Badge -->
                            <div class="absolute top-3 left-3 bg-[#1a4d3e] text-white text-xs px-2 py-1 rounded-full">
                                #<span x-text="member.display_order"></span>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="absolute top-3 right-3 flex gap-2">
                                <button @click="editMember(index)" 
                                        class="w-8 h-8 bg-white rounded-full flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition-colors shadow-md">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button @click="deleteMember(member.id, index)" 
                                        class="w-8 h-8 bg-white rounded-full flex items-center justify-center text-red-600 hover:bg-red-600 hover:text-white transition-colors shadow-md">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                            
                            <!-- Social Icons Overlay -->
                            <div class="absolute bottom-3 right-3 flex gap-2">
                                <a x-show="member.linkedin" :href="member.linkedin" target="_blank"
                                   class="w-8 h-8 bg-white/90 rounded-full flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition-colors shadow-md">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                </a>
                                <a x-show="member.email" :href="'mailto:' + member.email"
                                   class="w-8 h-8 bg-white/90 rounded-full flex items-center justify-center text-gray-600 hover:bg-gray-600 hover:text-white transition-colors shadow-md">
                                    <i class="fa-regular fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-5">
                            <h3 class="font-bold text-lg text-[#1a4d3e]" x-text="member.name"></h3>
                            <p class="text-[#c95c0e] text-sm font-medium mb-2" x-text="member.position"></p>
                            <p class="text-gray-600 text-sm line-clamp-3" x-text="member.bio"></p>
                            
                            <!-- Social Links (text version) -->
                            <div class="mt-3 flex gap-3 text-xs text-gray-400">
                                <a x-show="member.linkedin" :href="member.linkedin" target="_blank" class="hover:text-blue-600">
                                    <i class="fa-brands fa-linkedin mr-1"></i> LinkedIn
                                </a>
                                <a x-show="member.email" :href="'mailto:' + member.email" class="hover:text-gray-600">
                                    <i class="fa-regular fa-envelope mr-1"></i> Email
                                </a>
                            </div>
                        </div>
                    </div>
                </template>
                
                <!-- Empty State -->
                <template x-if="team.length === 0">
                    <div class="col-span-3 bg-white rounded-2xl shadow-lg p-12 text-center">
                        <i class="fa-solid fa-users-slash text-5xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-bold text-gray-500 mb-2">No Team Members Yet</h3>
                        <p class="text-gray-400 mb-6">Click the "Add Member" button to build your team.</p>
                        <button @click="resetForm(); showForm = true" 
                                class="bg-[#1a4d3e] text-white px-6 py-3 rounded-xl hover:bg-[#c95c0e] inline-flex items-center">
                            <i class="fa-solid fa-user-plus mr-2"></i> Add Your First Member
                        </button>
                    </div>
                </template>
            </div>
            
            <!-- Quick Stats -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-xl shadow flex items-center">
                    <div class="w-10 h-10 bg-[#1a4d3e]/10 rounded-full flex items-center justify-center mr-3">
                        <i class="fa-solid fa-users text-[#1a4d3e]"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Members</p>
                        <p class="text-xl font-bold" x-text="teamCount + ' / ' + limit"></p>
                    </div>
                </div>
                
                <div class="bg-white p-4 rounded-xl shadow flex items-center">
                    <div class="w-10 h-10 bg-[#c95c0e]/10 rounded-full flex items-center justify-center mr-3">
                        <i class="fa-solid fa-user-plus text-[#c95c0e]"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Slots Available</p>
                        <p class="text-xl font-bold" x-text="limit - teamCount"></p>
                    </div>
                </div>
                
                <div class="bg-white p-4 rounded-xl shadow flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                        <i class="fa-brands fa-linkedin text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">With LinkedIn</p>
                        <p class="text-xl font-bold" x-text="team.filter(m => m.linkedin).length"></p>
                    </div>
                </div>
                
                <div class="bg-white p-4 rounded-xl shadow flex items-center">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                        <i class="fa-regular fa-envelope text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">With Email</p>
                        <p class="text-xl font-bold" x-text="team.filter(m => m.email).length"></p>
                    </div>
                </div>
            </div>
            
            <!-- Instructions -->
            <div class="mt-6 bg-blue-50 p-4 rounded-xl">
                <h4 class="font-semibold text-blue-800 text-sm mb-2 flex items-center">
                    <i class="fa-solid fa-circle-info mr-2"></i>
                    Team Management Tips:
                </h4>
                <ul class="text-xs text-blue-700 space-y-1 list-disc list-inside">
                    <li>Maximum <strong>5 team members</strong> allowed at a time</li>
                    <li>Each member needs: <strong>Name, Position, Bio, and Photo</strong></li>
                    <li>LinkedIn and Email are optional but recommended</li>
                    <li>Display order controls the sequence (1 appears first, 5 appears last)</li>
                    <li>Square photos (400x400 pixels) work best for team cards</li>
                    <li>Click the <i class="fa-solid fa-pen text-blue-600 mx-1"></i> icon to edit a member</li>
                    <li>Click the <i class="fa-solid fa-trash text-red-600 mx-1"></i> icon to delete a member</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>