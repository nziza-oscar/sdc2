<?php
$page_title = 'Projects';
include 'header.php';
displayBanner($page_title);

?>

<section class="relative py-20 bg-gradient-to-br from-primary-light/30 to-secondary-light/30">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

<h1 class="text-4xl md:text-5xl font-bold mb-6">Featured <span class="text-primary">Projects</span></h1>
<p class="text-lg text-neutral-700 max-w-3xl mx-auto">
Able to do the right things at the right time. Explore our completed projects across Rwanda.
</p>
</div>
</section>

<section class="py-8 border-b border-neutral-200">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="flex flex-wrap justify-center gap-3">
<button class="filter-btn active px-5 py-2 rounded-full bg-primary text-white text-sm font-medium" data-filter="all">All Projects</button>
<button class="filter-btn px-5 py-2 rounded-full bg-neutral-100 text-neutral-700 text-sm hover:bg-primary-light transition-colors" data-filter="commercial">Commercial</button>
<button class="filter-btn px-5 py-2 rounded-full bg-neutral-100 text-neutral-700 text-sm hover:bg-primary-light transition-colors" data-filter="industrial">Industrial</button>
<button class="filter-btn px-5 py-2 rounded-full bg-neutral-100 text-neutral-700 text-sm hover:bg-primary-light transition-colors" data-filter="architecture">Architecture</button>
<button class="filter-btn px-5 py-2 rounded-full bg-neutral-100 text-neutral-700 text-sm hover:bg-primary-light transition-colors" data-filter="plumbing">Plumbing</button>
<button class="filter-btn px-5 py-2 rounded-full bg-neutral-100 text-neutral-700 text-sm hover:bg-primary-light transition-colors" data-filter="interior">Interior</button>
</div>
</div>
</section>

<section class="py-16 md:py-24">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" id="projects-grid">
<div class="project-item card p-0 overflow-hidden" data-category="commercial">
<img src="images/1.jpg" alt="Advertise Windows" class="w-full h-64 object-cover">
<div class="p-6">
<span class="text-xs text-primary font-bold uppercase tracking-wider">Commercial</span>
<h3 class="text-lg font-semibold mt-2 mb-2">Advertise Windows</h3>
<p class="text-sm text-neutral-600 leading-relaxed">Setting up a new office space in your building with modern window installations.</p>
<a href="#" class="inline-block mt-4 text-sm text-primary font-semibold hover:underline">View Project →</a>
</div>
</div>

        <div class="project-item card p-0 overflow-hidden" data-category="residential">
            <img src="images/2.jpg" alt="Eco Villa" class="w-full h-64 object-cover">
            <div class="p-6">
                <span class="text-xs text-primary font-bold uppercase tracking-wider">Residential</span>
                <h3 class="text-lg font-semibold mt-2 mb-2">Eco Villa Kigali</h3>
                <p class="text-sm text-neutral-600 leading-relaxed">Sustainable luxury villa with solar panels and rainwater harvesting.</p>
                <a href="#" class="inline-block mt-4 text-sm text-primary font-semibold hover:underline">View Project →</a>
            </div>
        </div>
        
        <div class="project-item card p-0 overflow-hidden" data-category="industrial">
            <img src="images/3.jpg" alt="Industrial Park" class="w-full h-64 object-cover">
            <div class="p-6">
                <span class="text-xs text-primary font-bold uppercase tracking-wider">Industrial</span>
                <h3 class="text-lg font-semibold mt-2 mb-2">Green Industrial Park</h3>
                <p class="text-sm text-neutral-600 leading-relaxed">Eco-friendly manufacturing facility with waste management systems.</p>
                <a href="#" class="inline-block mt-4 text-sm text-primary font-semibold hover:underline">View Project →</a>
            </div>
        </div>
        
        <div class="project-item card p-0 overflow-hidden" data-category="architecture">
            <img src="images/4.jpg" alt="Modern Office" class="w-full h-64 object-cover">
            <div class="p-6">
                <span class="text-xs text-primary font-bold uppercase tracking-wider">Architecture</span>
                <h3 class="text-lg font-semibold mt-2 mb-2">Riverside Office Tower</h3>
                <p class="text-sm text-neutral-600 leading-relaxed">Contemporary office design with natural ventilation and green spaces.</p>
                <a href="#" class="inline-block mt-4 text-sm text-primary font-semibold hover:underline">View Project →</a>
            </div>
        </div>
        
        <div class="project-item card p-0 overflow-hidden" data-category="plumbing">
            <img src="images/5.jpg" alt="Plumbing System" class="w-full h-64 object-cover">
            <div class="p-6">
                <span class="text-xs text-primary font-bold uppercase tracking-wider">Plumbing</span>
                <h3 class="text-lg font-semibold mt-2 mb-2">Smart Water System</h3>
                <p class="text-sm text-neutral-600 leading-relaxed">Efficient plumbing and water management for commercial complex.</p>
                <a href="#" class="inline-block mt-4 text-sm text-primary font-semibold hover:underline">View Project →</a>
            </div>
        </div>
        
        <div class="project-item card p-0 overflow-hidden" data-category="interior">
            <img src="images/6.jpg" alt="Interior Design" class="w-full h-64 object-cover">
            <div class="p-6">
                <span class="text-xs text-primary font-bold uppercase tracking-wider">Interior</span>
                <h3 class="text-lg font-semibold mt-2 mb-2">Luxury Apartment Interior</h3>
                <p class="text-sm text-neutral-600 leading-relaxed">Modern interior design with sustainable materials and smart home features.</p>
                <a href="#" class="inline-block mt-4 text-sm text-primary font-semibold hover:underline">View Project →</a>
            </div>
        </div>

         <div class="project-item card p-0 overflow-hidden" data-category="commercial">
            <img src="images/7.jpg" alt="Commercial Plaza" class="w-full h-64 object-cover">
            <div class="p-6">
                <span class="text-xs text-primary font-bold uppercase tracking-wider">Commercial</span>
                <h3 class="text-lg font-semibold mt-2 mb-2">The Kigali Plaza</h3>
                <p class="text-sm text-neutral-600 leading-relaxed">A landmark mixed-use commercial development in the heart of the city.</p>
                <a href="#" class="inline-block mt-4 text-sm text-primary font-semibold hover:underline">View Project →</a>
            </div>
        </div>
    </div>
</div>
</section>

<section class="py-16 md:py-24 bg-neutral-50">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
<div>
<div class="text-3xl md:text-4xl font-bold text-primary mb-2">200+</div>
<div class="text-sm text-neutral-600 uppercase tracking-wide">Projects Completed</div>
</div>
<div>
<div class="text-3xl md:text-4xl font-bold text-primary mb-2">150+</div>
<div class="text-sm text-neutral-600 uppercase tracking-wide">Happy Clients</div>
</div>
<div>
<div class="text-3xl md:text-4xl font-bold text-primary mb-2">15+</div>
<div class="text-sm text-neutral-600 uppercase tracking-wide">Years Experience</div>
</div>
<div>
<div class="text-3xl md:text-4xl font-bold text-primary mb-2">5</div>
<div class="text-sm text-neutral-600 uppercase tracking-wide">Countries Served</div>
</div>
</div>
</div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
const filterBtns = document.querySelectorAll('.filter-btn');
const projectItems = document.querySelectorAll('.project-item');

filterBtns.forEach(btn =&gt; {
    btn.addEventListener(&#39;click&#39;, () =&gt; {
        // Update active button
        filterBtns.forEach(b =&gt; {
            b.classList.remove(&#39;bg-primary&#39;, &#39;text-white&#39;);
            b.classList.add(&#39;bg-neutral-100&#39;, &#39;text-neutral-700&#39;);
        });
        btn.classList.remove(&#39;bg-neutral-100&#39;, &#39;text-neutral-700&#39;);
        btn.classList.add(&#39;bg-primary&#39;, &#39;text-white&#39;);
        
        // Filter projects
        const filter = btn.dataset.filter;
        
        projectItems.forEach(item =&gt; {
            if (filter === &#39;all&#39; || item.dataset.category === filter) {
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