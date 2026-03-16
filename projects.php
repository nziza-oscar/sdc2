<?php
$page_title = 'Projects';
include 'header.php';
?>

<!-- Projects Hero -->
<section class="relative py-20 bg-gradient-to-br from-primary-light/30 to-secondary-light/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="text-primary font-semibold tracking-wider uppercase text-sm mb-4 block">Our Portfolio</span>
        <h1 class="text-5xl md:text-6xl font-bold mb-6">Featured <span class="text-primary">Projects</span></h1>
        <p class="text-xl text-neutral-700 max-w-3xl mx-auto">
            Able to do the right things at the right time. Explore our completed projects across Rwanda.
        </p>
    </div>
</section>

<!-- Project Filters -->
<section class="py-8 border-b border-neutral-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-center gap-3">
            <button class="filter-btn active px-6 py-2 rounded-full bg-primary text-white font-medium" data-filter="all">All Projects</button>
            <button class="filter-btn px-6 py-2 rounded-full bg-neutral-100 text-neutral-700 hover:bg-primary-light transition-colors" data-filter="commercial">Commercial</button>
            <button class="filter-btn px-6 py-2 rounded-full bg-neutral-100 text-neutral-700 hover:bg-primary-light transition-colors" data-filter="industrial">Industrial</button>
            <button class="filter-btn px-6 py-2 rounded-full bg-neutral-100 text-neutral-700 hover:bg-primary-light transition-colors" data-filter="architecture">Architecture</button>
            <button class="filter-btn px-6 py-2 rounded-full bg-neutral-100 text-neutral-700 hover:bg-primary-light transition-colors" data-filter="plumbing">Plumbing</button>
            <button class="filter-btn px-6 py-2 rounded-full bg-neutral-100 text-neutral-700 hover:bg-primary-light transition-colors" data-filter="interior">Interior</button>
        </div>
    </div>
</section>

<!-- Projects Grid -->
<section class="section-padding">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" id="projects-grid">
            <!-- Project 1 -->
            <div class="project-item card p-0 overflow-hidden" data-category="commercial">
                <img src="https://placehold.co/600x400/0f766e/white?text=Advertise+Windows" alt="Advertise Windows" class="w-full h-64 object-cover">
                <div class="p-6">
                    <span class="text-sm text-primary font-semibold">Commercial</span>
                    <h3 class="text-xl font-semibold mt-2 mb-2">Advertise Windows</h3>
                    <p class="text-neutral-600">Setting up a new office space in your building with modern window installations.</p>
                    <a href="#" class="inline-block mt-4 text-primary font-semibold hover:underline">View Project →</a>
                </div>
            </div>
            
            <!-- Project 2 -->
            <div class="project-item card p-0 overflow-hidden" data-category="residential">
                <img src="https://placehold.co/600x400/0369a1/white?text=Eco+Villa" alt="Eco Villa" class="w-full h-64 object-cover">
                <div class="p-6">
                    <span class="text-sm text-primary font-semibold">Residential</span>
                    <h3 class="text-xl font-semibold mt-2 mb-2">Eco Villa Kigali</h3>
                    <p class="text-neutral-600">Sustainable luxury villa with solar panels and rainwater harvesting.</p>
                    <a href="#" class="inline-block mt-4 text-primary font-semibold hover:underline">View Project →</a>
                </div>
            </div>
            
            <!-- Project 3 -->
            <div class="project-item card p-0 overflow-hidden" data-category="industrial">
                <img src="https://placehold.co/600x400/0f766e/white?text=Industrial+Park" alt="Industrial Park" class="w-full h-64 object-cover">
                <div class="p-6">
                    <span class="text-sm text-primary font-semibold">Industrial</span>
                    <h3 class="text-xl font-semibold mt-2 mb-2">Green Industrial Park</h3>
                    <p class="text-neutral-600">Eco-friendly manufacturing facility with waste management systems.</p>
                    <a href="#" class="inline-block mt-4 text-primary font-semibold hover:underline">View Project →</a>
                </div>
            </div>
            
            <!-- Project 4 -->
            <div class="project-item card p-0 overflow-hidden" data-category="architecture">
                <img src="https://placehold.co/600x400/0369a1/white?text=Modern+Office" alt="Modern Office" class="w-full h-64 object-cover">
                <div class="p-6">
                    <span class="text-sm text-primary font-semibold">Architecture</span>
                    <h3 class="text-xl font-semibold mt-2 mb-2">Riverside Office Tower</h3>
                    <p class="text-neutral-600">Contemporary office design with natural ventilation and green spaces.</p>
                    <a href="#" class="inline-block mt-4 text-primary font-semibold hover:underline">View Project →</a>
                </div>
            </div>
            
            <!-- Project 5 -->
            <div class="project-item card p-0 overflow-hidden" data-category="plumbing">
                <img src="https://placehold.co/600x400/0f766e/white?text=Plumbing+System" alt="Plumbing System" class="w-full h-64 object-cover">
                <div class="p-6">
                    <span class="text-sm text-primary font-semibold">Plumbing</span>
                    <h3 class="text-xl font-semibold mt-2 mb-2">Smart Water System</h3>
                    <p class="text-neutral-600">Efficient plumbing and water management for commercial complex.</p>
                    <a href="#" class="inline-block mt-4 text-primary font-semibold hover:underline">View Project →</a>
                </div>
            </div>
            
            <!-- Project 6 -->
            <div class="project-item card p-0 overflow-hidden" data-category="interior">
                <img src="https://placehold.co/600x400/0369a1/white?text=Interior+Design" alt="Interior Design" class="w-full h-64 object-cover">
                <div class="p-6">
                    <span class="text-sm text-primary font-semibold">Interior</span>
                    <h3 class="text-xl font-semibold mt-2 mb-2">Luxury Apartment Interior</h3>
                    <p class="text-neutral-600">Modern interior design with sustainable materials and smart home features.</p>
                    <a href="#" class="inline-block mt-4 text-primary font-semibold hover:underline">View Project →</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Project Stats -->
<section class="section-padding bg-neutral-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl md:text-5xl font-bold text-primary mb-2">200+</div>
                <div class="text-neutral-600">Projects Completed</div>
            </div>
            <div>
                <div class="text-4xl md:text-5xl font-bold text-primary mb-2">150+</div>
                <div class="text-neutral-600">Happy Clients</div>
            </div>
            <div>
                <div class="text-4xl md:text-5xl font-bold text-primary mb-2">15+</div>
                <div class="text-neutral-600">Years Experience</div>
            </div>
            <div>
                <div class="text-4xl md:text-5xl font-bold text-primary mb-2">5</div>
                <div class="text-neutral-600">Countries Served</div>
            </div>
        </div>
    </div>
</section>

<!-- Filter Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const projectItems = document.querySelectorAll('.project-item');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Update active button
            filterBtns.forEach(b => {
                b.classList.remove('bg-primary', 'text-white');
                b.classList.add('bg-neutral-100', 'text-neutral-700');
            });
            btn.classList.remove('bg-neutral-100', 'text-neutral-700');
            btn.classList.add('bg-primary', 'text-white');
            
            // Filter projects
            const filter = btn.dataset.filter;
            
            projectItems.forEach(item => {
                if (filter === 'all' || item.dataset.category === filter) {
                    item.style.display = 'block';
                    gsap.fromTo(item, {opacity: 0, scale: 0.9}, {opacity: 1, scale: 1, duration: 0.5});
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
</script>

<?php include 'footer.php'; ?>