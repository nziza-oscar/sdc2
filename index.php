<?php
$page_title = 'Home';
include 'header.php';
?>

<section class="relative min-h-[90vh] flex items-center bg-[#1a4d3e]">
<div class="absolute inset-0 overflow-hidden">
<div class="absolute -top-40 -right-40 w-80 h-80 bg-[#c95c0e]/10 rounded-full blur-3xl"></div>
<div class="absolute -bottom-40 -left-40 w-80 h-80 bg-[#c95c0e]/5 rounded-full blur-3xl"></div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
    <div class="grid lg:grid-cols-2 gap-5 items-center">
        <div class="hero-content ">
            <span class="text-[#c95c0e] font-semibold tracking-wider uppercase text-sm mb-4 block">Welcome to SDC2</span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6 text-white">
                We help you<br>build your
                <span class="text-[#c95c0e] block">dream professionally.</span>
            </h1>
            <p class="text-lg text-gray-300 mb-8  leading-relaxed">
                Sustainable Design and Construction Consultancy is an architectural firm in Kigali with
                 a great passion for designing outstanding architecture and challenging the status.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="services.php" class="bg-[#c95c0e] text-white px-8 py-3 rounded-full font-semibold text-base hover:bg-[#b04d0c] transition-all duration-300 shadow-lg">Explore our Services</a>
                <a href="projects.php" class="border-2 border-[#c95c0e] text-white px-8 py-3 rounded-full font-semibold text-base hover:bg-[#c95c0e] transition-all duration-300">View Projects</a>
            </div>
        </div>
        <div class="relative">
            <div class=" p-8 ">
                <img src="images/welcome.png" alt="Sustainable Architecture" class=" rounded-xl w-full">
            </div>
        </div>
    </div>
</div>
</section>

<section class="py-16 md:py-24">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="grid lg:grid-cols-2 gap-16 items-center">
<div class="relative">
<div class="bg-[#1a4d3e]/10 rounded-[48px] p-8">
<img src="images/about_us.png" alt="Construction Team" class="rounded-3xl w-full">
</div>
</div>
<div class="about-content">
<span class="text-[#c95c0e] font-semibold tracking-wider uppercase text-sm mb-4 block">About Us</span>
<h2 class="text-2xl md:text-3xl font-bold mb-6 text-[#1a4d3e]">We are one of the largest construction companies</h2>
<p class="text-base text-gray-600 mb-8 leading-relaxed">
SDC2 is a leading architectural and investment firm in Rwanda, known for its innovative design and strategic expansion into the hospitality sector. The company excels in offering comprehensive solutions, including design, construction, and management of villa projects, catering to both residential and commercial clients.
</p>
<div class="grid grid-cols-2 gap-6 mb-8">
<div>
<div class="text-3xl font-bold text-[#c95c0e]">15+</div>
<div class="text-sm text-gray-600 uppercase tracking-wide">Years Experience</div>
</div>
<div>
<div class="text-3xl font-bold text-[#c95c0e]">200+</div>
<div class="text-sm text-gray-600 uppercase tracking-wide">Projects Completed</div>
</div>
<div>
<div class="text-3xl font-bold text-[#c95c0e]">50+</div>
<div class="text-sm text-gray-600 uppercase tracking-wide">Expert Members</div>
</div>
<div>
<div class="text-3xl font-bold text-[#c95c0e]">98%</div>
<div class="text-sm text-gray-600 uppercase tracking-wide">Happy Clients</div>
</div>
</div>
<a href="about.php" class="inline-block bg-[#1a4d3e] text-white px-8 py-3 rounded-full font-semibold text-base hover:bg-[#c95c0e] transition-all duration-300">Get in Touch</a>
</div>
</div>
</div>
</section>

<section class="py-16 md:py-24 bg-gray-50">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="text-center max-w-3xl mx-auto mb-16">
<span class="text-[#c95c0e] font-semibold tracking-wider uppercase text-sm mb-4 block">Our Services</span>
<h2 class="text-2xl md:text-3xl font-bold mb-4 text-[#1a4d3e]">Providing quality services</h2>
<p class="text-base text-gray-600">Comprehensive construction solutions tailored to your needs.</p>
</div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="w-16 h-16 bg-[#1a4d3e]/10 rounded-2xl flex items-center justify-center mb-6">
                <i class="fa-regular fa-pen-to-ruler text-2xl text-[#1a4d3e]"></i>
            </div>
            <h3 class="text-xl font-semibold mb-4 text-[#1a4d3e]">Architectural Design</h3>
            <ul class="space-y-3 text-sm text-gray-600">
                <li class="flex items-center gap-2">
                    <i class="fa-regular fa-circle-check text-[#c95c0e]"></i>
                    Conceptualization and design development
                </li>
                <li class="flex items-center gap-2">
                    <i class="fa-regular fa-circle-check text-[#c95c0e]"></i>
                    Interior design and space planning
                </li>
                <li class="flex items-center gap-2">
                    <i class="fa-regular fa-circle-check text-[#c95c0e]"></i>
                    3D modeling and visualization
                </li>
                <li class="flex items-center gap-2">
                    <i class="fa-regular fa-circle-check text-[#c95c0e]"></i>
                    Sustainable design solutions
                </li>
                <li class="flex items-center gap-2">
                    <i class="fa-regular fa-circle-check text-[#c95c0e]"></i>
                    Construction documentation
                </li>
            </ul>
        </div>
        
        <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="w-16 h-16 bg-[#1a4d3e]/10 rounded-2xl flex items-center justify-center mb-6">
                <i class="fa-regular fa-building text-2xl text-[#1a4d3e]"></i>
            </div>
            <h3 class="text-xl font-semibold mb-4 text-[#1a4d3e]">Construction Management</h3>
            <ul class="space-y-3 text-sm text-gray-600">
                <li class="flex items-center gap-2">
                    <i class="fa-regular fa-circle-check text-[#c95c0e]"></i>
                    General contracting
                </li>
                <li class="flex items-center gap-2">
                    <i class="fa-regular fa-circle-check text-[#c95c0e]"></i>
                    Construction planning and scheduling
                </li>
                <li class="flex items-center gap-2">
                    <i class="fa-regular fa-circle-check text-[#c95c0e]"></i>
                    Cost estimation and budgeting
                </li>
                <li class="flex items-center gap-2">
                    <i class="fa-regular fa-circle-check text-[#c95c0e]"></i>
                    Quality control and assurance
                </li>
                <li class="flex items-center gap-2">
                    <i class="fa-regular fa-circle-check text-[#c95c0e]"></i>
                    Project coordination and supervision
                </li>
            </ul>
        </div>
        
        <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="w-16 h-16 bg-[#1a4d3e]/10 rounded-2xl flex items-center justify-center mb-6">
                <i class="fa-regular fa-wrench text-2xl text-[#1a4d3e]"></i>
            </div>
            <h3 class="text-xl font-semibold mb-4 text-[#1a4d3e]">Renovation & Retrofitting</h3>
            <ul class="space-y-3 text-sm text-gray-600">
                <li class="flex items-center gap-2">
                    <i class="fa-regular fa-circle-check text-[#c95c0e]"></i>
                    Residential and commercial renovations
                </li>
                <li class="flex items-center gap-2">
                    <i class="fa-regular fa-circle-check text-[#c95c0e]"></i>
                    Structural modifications
                </li>
                <li class="flex items-center gap-2">
                    <i class="fa-regular fa-circle-check text-[#c95c0e]"></i>
                    Interior upgrades and finishes
                </li>
                <li class="flex items-center gap-2">
                    <i class="fa-regular fa-circle-check text-[#c95c0e]"></i>
                    Adaptive reuse and restoration
                </li>
                <li class="flex items-center gap-2">
                    <i class="fa-regular fa-circle-check text-[#c95c0e]"></i>
                    Energy-efficient retrofitting
                </li>
            </ul>
        </div>
    </div>
</div>
</section>

<section class="py-16 md:py-24">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="text-center max-w-3xl mx-auto mb-16">
<span class="text-[#c95c0e] font-semibold tracking-wider uppercase text-sm mb-4 block">Featured Projects</span>
<h2 class="text-2xl md:text-3xl font-bold mb-4 text-[#1a4d3e]">Able to do the right things at the right time.</h2>

        <div class="flex flex-wrap justify-center gap-4 mt-8" id="filter-buttons">
            <button class="filter-btn active px-5 py-2 rounded-full bg-[#1a4d3e] text-white text-sm font-medium" data-filter="all">All Projects</button>
            <button class="filter-btn px-5 py-2 rounded-full bg-gray-100 text-gray-700 text-sm hover:bg-[#c95c0e] hover:text-white transition-colors" data-filter="commercial">Commercial</button>
            <button class="filter-btn px-5 py-2 rounded-full bg-gray-100 text-gray-700 text-sm hover:bg-[#c95c0e] hover:text-white transition-colors" data-filter="industrial">Industrial</button>
            <button class="filter-btn px-5 py-2 rounded-full bg-gray-100 text-gray-700 text-sm hover:bg-[#c95c0e] hover:text-white transition-colors" data-filter="architecture">Architecture</button>
            <button class="filter-btn px-5 py-2 rounded-full bg-gray-100 text-gray-700 text-sm hover:bg-[#c95c0e] hover:text-white transition-colors" data-filter="plumbing">Plumbing</button>
            <button class="filter-btn px-5 py-2 rounded-full bg-gray-100 text-gray-700 text-sm hover:bg-[#c95c0e] hover:text-white transition-colors" data-filter="interior">Interior</button>
        </div>
    </div>
    
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" id="projects-grid">
        <?php 
        $projects = [
            ['title' => 'Eco-Haven Residence', 'category' => 'residential', 'description' => 'Sustainable hillside villa with green roof.'],
            ['title' => 'Green Office Complex', 'category' => 'commercial', 'description' => 'Energy-efficient office building with solar integration.'],
            ['title' => 'Riverside Apartments', 'category' => 'residential', 'description' => 'Multi-family sustainable housing development.'],
            ['title' => 'Eco-Industrial Park', 'category' => 'industrial', 'description' => 'Sustainable manufacturing facility with rainwater harvesting.'],
            ['title' => 'Modern Office Tower', 'category' => 'commercial', 'description' => 'Contemporary office design with natural ventilation.'],
            ['title' => 'Luxury Interior Design', 'category' => 'interior', 'description' => 'Modern interior design with sustainable materials.']
        ];
        
        foreach($projects as $project): 
        ?>
        <div class="project-item group cursor-pointer" data-category="<?php echo $project['category']; ?>">
            <div class="relative overflow-hidden rounded-[32px] mb-4">
                <img src="[https://placehold.co/600x400/1a4d3e/white?text=](https://placehold.co/600x400/1a4d3e/white?text=)<?php echo urlencode($project['title']); ?>" 
                     alt="<?php echo $project['title']; ?>"
                     class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>
            <h3 class="text-lg font-semibold mb-1 text-[#1a4d3e]"><?php echo $project['title']; ?></h3>
            <p class="text-sm text-gray-600 leading-snug"><?php echo $project['description']; ?></p>
            <span class="inline-block mt-2 text-xs text-[#c95c0e] font-bold uppercase tracking-wider"><?php echo $project['category']; ?></span>
        </div>
        <?php endforeach; ?>
    </div>
    
    <div class="text-center mt-12">
        <a href="projects.php" class="border-2 border-[#1a4d3e] text-[#1a4d3e] px-8 py-3 rounded-full font-semibold text-base hover:bg-[#1a4d3e] hover:text-white transition-all duration-300">View All Projects</a>
    </div>
</div>
</section>

<section class="bg-[#1a4d3e] text-white py-20">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
<h2 class="text-3xl md:text-4xl font-bold mb-6">We're here to help you build your dream</h2>
<p class="text-lg text-gray-300 mb-8 max-w-3xl mx-auto">
SDC2 is a young architectural firm in Kigali with a great passion for designing outstanding architecture and challenging the status quo. Our residential designs have a successful track record in Rwanda.
</p>
<a href="contact.php" class="inline-block bg-[#c95c0e] text-white px-10 py-4 rounded-full font-semibold text-base hover:bg-[#b04d0c] transition-colors shadow-lg">
Contact us now
</a>
</div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
const filterButtons = document.querySelectorAll('.filter-btn');
const projectItems = document.querySelectorAll('.project-item');

filterButtons.forEach(button =&gt; {
    button.addEventListener(&#39;click&#39;, function() {
        filterButtons.forEach(btn =&gt; {
            btn.classList.remove(&#39;bg-[#1a4d3e]&#39;, &#39;text-white&#39;);
            btn.classList.add(&#39;bg-gray-100&#39;, &#39;text-gray-700&#39;);
        });
        
        this.classList.remove(&#39;bg-gray-100&#39;, &#39;text-gray-700&#39;);
        this.classList.add(&#39;bg-[#1a4d3e]&#39;, &#39;text-white&#39;);
        
        const filterValue = this.dataset.filter;
        
        projectItems.forEach(item =&gt; {
            if(filterValue === &#39;all&#39; || item.dataset.category === filterValue) {
                item.style.display = &#39;block&#39;;
            } else {
                item.style.display = &#39;none&#39;;
            }
        });
    });
});
});
</script>

<?php include 'footer.php'; ?>