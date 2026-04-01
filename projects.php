<?php
$page_title = 'Projects';
include 'header.php';
displayBanner($page_title);
?>

<section class="relative py-20 bg-gradient-to-br from-primary-light/30 to-secondary-light/30">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
<h1 class="text-5xl md:text-6xl mb-6 font-poppi">Featured <span class="text-primary">Projects</span></h1>
<p class="text-xl text-neutral-700 max-w-3xl mx-auto font-rale">
Able to do the right things at the right time. Explore our portfolio of completed works across Rwanda.
</p>
</div>
</section>

<section class="py-8 sticky top-0 bg-white/80 backdrop-blur-md z-30 border-b border-neutral-100">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="flex flex-wrap justify-center gap-3">
<button class="filter-btn active px-6 py-2.5 rounded-xl bg-primary text-white text-sm font-medium font-poppi transition-all shadow-sm" data-filter="all">All Projects</button>
<button class="filter-btn px-6 py-2.5 rounded-xl bg-neutral-50 text-neutral-600 text-sm font-medium font-poppi hover:bg-primary-light transition-all" data-filter="commercial">Commercial</button>
<button class="filter-btn px-6 py-2.5 rounded-xl bg-neutral-50 text-neutral-600 text-sm font-medium font-poppi hover:bg-primary-light transition-all" data-filter="industrial">Industrial</button>
<button class="filter-btn px-6 py-2.5 rounded-xl bg-neutral-50 text-neutral-600 text-sm font-medium font-poppi hover:bg-primary-light transition-all" data-filter="architecture">Architecture</button>
<button class="filter-btn px-6 py-2.5 rounded-xl bg-neutral-50 text-neutral-600 text-sm font-medium font-poppi hover:bg-primary-light transition-all" data-filter="plumbing">Plumbing</button>
<button class="filter-btn px-6 py-2.5 rounded-xl bg-neutral-50 text-neutral-600 text-sm font-medium font-poppi hover:bg-primary-light transition-all" data-filter="interior">Interior</button>
</div>
</div>
</section>

<section class="py-16 md:py-24">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10" id="projects-grid">

        <div class="project-item group relative overflow-hidden rounded-[40px] bg-white shadow-sm hover:shadow-xl transition-all duration-500" data-category="commercial">
            <div class="aspect-[4/5] overflow-hidden">
                <img src="images/1.jpg" alt="Advertise Windows" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-8">
                <span class="text-primary-light text-xs font-bold uppercase tracking-widest mb-2 font-poppi">Commercial</span>
                <h3 class="text-2xl text-white font-semibold mb-3 font-poppi">Advertise Windows</h3>
                <p class="text-neutral-200 text-sm font-rale mb-4">Modern office space window installations with thermal efficiency.</p>
                <a href="#" class="text-white text-sm font-semibold font-poppi flex items-center gap-2">View Case Study <i class="fa-solid fa-arrow-right-long"></i></a>
            </div>
            <div class="p-6 group-hover:hidden transition-all">
                <span class="text-xs text-primary font-bold uppercase tracking-wider font-poppi">Commercial</span>
                <h3 class="text-xl font-semibold mt-2 font-poppi text-neutral-800">Advertise Windows</h3>
            </div>
        </div>

        <div class="project-item group relative overflow-hidden rounded-[40px] bg-white shadow-sm hover:shadow-xl transition-all duration-500" data-category="residential">
            <div class="aspect-[4/5] overflow-hidden">
                <img src="images/2.jpg" alt="Eco Villa" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-8">
                <span class="text-primary-light text-xs font-bold uppercase tracking-widest mb-2 font-poppi">Residential</span>
                <h3 class="text-2xl text-white font-semibold mb-3 font-poppi">Eco Villa Kigali</h3>
                <p class="text-neutral-200 text-sm font-rale mb-4">Sustainable luxury villa featuring full solar integration.</p>
                <a href="#" class="text-white text-sm font-semibold font-poppi flex items-center gap-2">View Case Study <i class="fa-solid fa-arrow-right-long"></i></a>
            </div>
            <div class="p-6 group-hover:hidden transition-all">
                <span class="text-xs text-primary font-bold uppercase tracking-wider font-poppi">Residential</span>
                <h3 class="text-xl font-semibold mt-2 font-poppi text-neutral-800">Eco Villa Kigali</h3>
            </div>
        </div>

        <div class="project-item group relative overflow-hidden rounded-[40px] bg-white shadow-sm hover:shadow-xl transition-all duration-500" data-category="industrial">
            <div class="aspect-[4/5] overflow-hidden">
                <img src="images/3.jpg" alt="Industrial Park" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-8">
                <span class="text-primary-light text-xs font-bold uppercase tracking-widest mb-2 font-poppi">Industrial</span>
                <h3 class="text-2xl text-white font-semibold mb-3 font-poppi">Green Industrial Park</h3>
                <p class="text-neutral-200 text-sm font-rale mb-4">Eco-friendly manufacturing facility with advanced waste management.</p>
                <a href="#" class="text-white text-sm font-semibold font-poppi flex items-center gap-2">View Case Study <i class="fa-solid fa-arrow-right-long"></i></a>
            </div>
            <div class="p-6 group-hover:hidden transition-all">
                <span class="text-xs text-primary font-bold uppercase tracking-wider font-poppi">Industrial</span>
                <h3 class="text-xl font-semibold mt-2 font-poppi text-neutral-800">Green Industrial Park</h3>
            </div>
        </div>

        <div class="project-item group relative overflow-hidden rounded-[40px] bg-white shadow-sm hover:shadow-xl transition-all duration-500" data-category="architecture">
            <div class="aspect-[4/5] overflow-hidden">
                <img src="images/4.jpg" alt="Modern Office" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-8">
                <span class="text-primary-light text-xs font-bold uppercase tracking-widest mb-2 font-poppi">Architecture</span>
                <h3 class="text-2xl text-white font-semibold mb-3 font-poppi">Riverside Tower</h3>
                <p class="text-neutral-200 text-sm font-rale mb-4">Contemporary office design with natural ventilation systems.</p>
                <a href="#" class="text-white text-sm font-semibold font-poppi flex items-center gap-2">View Case Study <i class="fa-solid fa-arrow-right-long"></i></a>
            </div>
            <div class="p-6 group-hover:hidden transition-all">
                <span class="text-xs text-primary font-bold uppercase tracking-wider font-poppi">Architecture</span>
                <h3 class="text-xl font-semibold mt-2 font-poppi text-neutral-800">Riverside Tower</h3>
            </div>
        </div>

        <div class="project-item group relative overflow-hidden rounded-[40px] bg-white shadow-sm hover:shadow-xl transition-all duration-500" data-category="plumbing">
            <div class="aspect-[4/5] overflow-hidden">
                <img src="images/5.jpg" alt="Smart Water" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-8">
                <span class="text-primary-light text-xs font-bold uppercase tracking-widest mb-2 font-poppi">Plumbing</span>
                <h3 class="text-2xl text-white font-semibold mb-3 font-poppi">Smart Water System</h3>
                <p class="text-neutral-200 text-sm font-rale mb-4">Intelligent water management for high-rise commercial complexes.</p>
                <a href="#" class="text-white text-sm font-semibold font-poppi flex items-center gap-2">View Case Study <i class="fa-solid fa-arrow-right-long"></i></a>
            </div>
            <div class="p-6 group-hover:hidden transition-all">
                <span class="text-xs text-primary font-bold uppercase tracking-wider font-poppi">Plumbing</span>
                <h3 class="text-xl font-semibold mt-2 font-poppi text-neutral-800">Smart Water System</h3>
            </div>
        </div>

        <div class="project-item group relative overflow-hidden rounded-[40px] bg-white shadow-sm hover:shadow-xl transition-all duration-500" data-category="interior">
            <div class="aspect-[4/5] overflow-hidden">
                <img src="images/6.jpg" alt="Luxury Interior" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-8">
                <span class="text-primary-light text-xs font-bold uppercase tracking-widest mb-2 font-poppi">Interior</span>
                <h3 class="text-2xl text-white font-semibold mb-3 font-poppi">Luxury Interiors</h3>
                <p class="text-neutral-200 text-sm font-rale mb-4">Minimalist aesthetic using sustainable local materials.</p>
                <a href="#" class="text-white text-sm font-semibold font-poppi flex items-center gap-2">View Case Study <i class="fa-solid fa-arrow-right-long"></i></a>
            </div>
            <div class="p-6 group-hover:hidden transition-all">
                <span class="text-xs text-primary font-bold uppercase tracking-wider font-poppi">Interior</span>
                <h3 class="text-xl font-semibold mt-2 font-poppi text-neutral-800">Luxury Interiors</h3>
            </div>
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
        // Update active button state
        filterBtns.forEach(b =&gt; {
            b.classList.remove(&#39;bg-primary&#39;, &#39;text-white&#39;, &#39;shadow-sm&#39;);
            b.classList.add(&#39;bg-neutral-50&#39;, &#39;text-neutral-600&#39;);
        });
        btn.classList.remove(&#39;bg-neutral-50&#39;, &#39;text-neutral-600&#39;);
        btn.classList.add(&#39;bg-primary&#39;, &#39;text-white&#39;, &#39;shadow-sm&#39;);
        
        // Filter animation logic
        const filter = btn.dataset.filter;
        
        projectItems.forEach(item =&gt; {
            item.style.opacity = &#39;0&#39;;
            item.style.transform = &#39;scale(0.95)&#39;;
            
            setTimeout(() =&gt; {
                if (filter === &#39;all&#39; || item.dataset.category === filter) {
                    item.style.display = &#39;block&#39;;
                    setTimeout(() =&gt; {
                        item.style.opacity = &#39;1&#39;;
                        item.style.transform = &#39;scale(1)&#39;;
                    }, 50);
                } else {
                    item.style.display = &#39;none&#39;;
                }
            }, 300);
        });
    });
});
});
</script>

<?php include 'footer.php'; ?>