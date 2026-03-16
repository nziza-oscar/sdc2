<?php
$page_title = 'Home';
include 'header.php';
?>

<!-- Hero Section -->
<section class="relative min-h-[90vh] flex items-center bg-gradient-to-br from-primary-light/30 to-secondary-light/30">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary/5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-secondary/5 rounded-full blur-3xl"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="hero-content">
                <span class="text-primary font-semibold tracking-wider uppercase text-sm mb-4 block">Welcome to Everdesign</span>
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6">
                    We help you<br>build your
                    <span class="text-primary block">dream professionally.</span>
                </h1>
                <p class="text-xl text-neutral-700 mb-8 max-w-lg leading-relaxed">
                    Ever Design is an architectural firm in Kigali with a great passion for designing outstanding architecture and challenging the status quo.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="services.php" class="btn-primary text-lg">Explore our Services</a>
                    <a href="projects.php" class="btn-outline text-lg">View Projects</a>
                </div>
            </div>
            <div class="relative">
                <div class="bg-white/80 backdrop-blur-sm p-8 rounded-[48px] shadow-xl">
                    <img src="https://placehold.co/600x400/0f766e/white?text=Sustainable+Design" alt="Modern Architecture" class="rounded-3xl w-full">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="section-padding">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="relative">
                <div class="bg-primary-light rounded-[48px] p-8">
                    <img src="https://placehold.co/500x600/0369a1/white?text=About+Us" alt="Construction Team" class="rounded-3xl w-full">
                </div>
            </div>
            <div class="about-content">
                <span class="text-secondary font-semibold tracking-wider uppercase text-sm mb-4 block">About Us</span>
                <h2 class="section-title">We are one of the largest construction companies</h2>
                <p class="text-lg text-neutral-700 mb-8">
                    Ever Design Group is a leading architectural and investment firm in Rwanda, known for its innovative design and strategic expansion into the hospitality sector. The company excels in offering comprehensive solutions, including design, construction, and management of villa projects, catering to both residential and commercial clients.
                </p>
                <div class="grid grid-cols-2 gap-6 mb-8">
                    <div>
                        <div class="text-4xl font-bold text-primary">15+</div>
                        <div class="text-neutral-600">Years Experience</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold text-primary">200+</div>
                        <div class="text-neutral-600">Projects Completed</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold text-primary">50+</div>
                        <div class="text-neutral-600">Expert Members</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold text-primary">98%</div>
                        <div class="text-neutral-600">Happy Clients</div>
                    </div>
                </div>
                <a href="about.php" class="btn-primary">Get in Touch</a>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="section-padding bg-neutral-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-primary font-semibold tracking-wider uppercase text-sm mb-4 block">Our Services</span>
            <h2 class="section-title">Providing quality services</h2>
            <p class="section-subtitle">Comprehensive construction solutions tailored to your needs</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Service Card 1 -->
            <div class="card group">
                <div class="w-16 h-16 bg-primary-light rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i class="fa-regular fa-pen-to-ruler text-3xl text-primary"></i>
                </div>
                <h3 class="text-2xl font-semibold mb-4">Architectural Design</h3>
                <ul class="space-y-3 text-neutral-700">
                    <li class="flex items-center gap-2">
                        <i class="fa-regular fa-circle-check text-primary"></i>
                        Conceptualization and design development
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-regular fa-circle-check text-primary"></i>
                        Interior design and space planning
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-regular fa-circle-check text-primary"></i>
                        3D modeling and visualization
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-regular fa-circle-check text-primary"></i>
                        Sustainable design solutions
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-regular fa-circle-check text-primary"></i>
                        Construction documentation
                    </li>
                </ul>
            </div>
            
            <!-- Service Card 2 -->
            <div class="card group">
                <div class="w-16 h-16 bg-primary-light rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i class="fa-regular fa-building text-3xl text-primary"></i>
                </div>
                <h3 class="text-2xl font-semibold mb-4">Construction Management</h3>
                <ul class="space-y-3 text-neutral-700">
                    <li class="flex items-center gap-2">
                        <i class="fa-regular fa-circle-check text-primary"></i>
                        General contracting
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-regular fa-circle-check text-primary"></i>
                        Construction planning and scheduling
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-regular fa-circle-check text-primary"></i>
                        Cost estimation and budgeting
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-regular fa-circle-check text-primary"></i>
                        Quality control and assurance
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-regular fa-circle-check text-primary"></i>
                        Project coordination and supervision
                    </li>
                </ul>
            </div>
            
            <!-- Service Card 3 -->
            <div class="card group">
                <div class="w-16 h-16 bg-primary-light rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i class="fa-regular fa-wrench text-3xl text-primary"></i>
                </div>
                <h3 class="text-2xl font-semibold mb-4">Renovation & Retrofitting</h3>
                <ul class="space-y-3 text-neutral-700">
                    <li class="flex items-center gap-2">
                        <i class="fa-regular fa-circle-check text-primary"></i>
                        Residential and commercial renovations
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-regular fa-circle-check text-primary"></i>
                        Structural modifications
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-regular fa-circle-check text-primary"></i>
                        Interior upgrades and finishes
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-regular fa-circle-check text-primary"></i>
                        Adaptive reuse and restoration
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-regular fa-circle-check text-primary"></i>
                        Energy-efficient retrofitting
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Projects Section -->
<section class="section-padding">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-primary font-semibold tracking-wider uppercase text-sm mb-4 block">Featured Projects</span>
            <h2 class="section-title">Able to do the right things at the right time.</h2>
            <div class="flex flex-wrap justify-center gap-4 mt-8">
                <button class="px-6 py-2 rounded-full bg-primary text-white font-medium">All Projects</button>
                <button class="px-6 py-2 rounded-full bg-neutral-100 text-neutral-700 hover:bg-primary-light transition-colors">Commercial</button>
                <button class="px-6 py-2 rounded-full bg-neutral-100 text-neutral-700 hover:bg-primary-light transition-colors">Industrial</button>
                <button class="px-6 py-2 rounded-full bg-neutral-100 text-neutral-700 hover:bg-primary-light transition-colors">Architecture</button>
                <button class="px-6 py-2 rounded-full bg-neutral-100 text-neutral-700 hover:bg-primary-light transition-colors">Plumbing</button>
                <button class="px-6 py-2 rounded-full bg-neutral-100 text-neutral-700 hover:bg-primary-light transition-colors">Interior</button>
            </div>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach(array_slice($projects, 0, 3) as $project): ?>
            <div class="group cursor-pointer">
                <div class="relative overflow-hidden rounded-[32px] mb-4">
                    <img src="https://placehold.co/600x400/0f766e/white?text=<?php echo urlencode($project['title']); ?>" 
                         alt="<?php echo $project['title']; ?>"
                         class="w-full h-72 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>
                <h3 class="text-xl font-semibold mb-2"><?php echo $project['title']; ?></h3>
                <p class="text-neutral-600"><?php echo $project['description']; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-12">
            <a href="projects.php" class="btn-outline">View All Projects</a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-gradient-to-r from-primary to-secondary text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">We're here to help you build your dream</h2>
        <p class="text-xl text-white/90 mb-8 max-w-3xl mx-auto">
            Ever Design is a young architectural firm in Kigali with a great passion for designing outstanding architecture and challenging the status quo. Our residential designs have a successful track record in Rwanda.
        </p>
        <a href="contact.php" class="inline-block bg-white text-primary px-10 py-4 rounded-full font-semibold text-lg hover:bg-neutral-100 transition-colors shadow-lg">
            Contact us now
        </a>
    </div>
</section>

<?php include 'footer.php'; ?>