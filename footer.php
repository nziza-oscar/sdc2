<footer class="bg-[#0b0f1a] text-gray-300 relative border-t border-gray-800 overflow-hidden">
    <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>

    <button id="scrollToTop" class="fixed bottom-8 right-8 w-12 h-12 bg-emerald-500 rounded-2xl flex items-center justify-center text-white shadow-2xl hover:bg-[#c95c0e] hover:-translate-y-2 transition-all duration-300 z-50 opacity-0 invisible cursor-pointer border-none">
        <i class="fa-solid fa-arrow-up text-lg"></i>
    </button>
    
    <a href="https://wa.me/250788282953" target="_blank" class="fixed bottom-8 right-24 w-12 h-12 bg-[#25D366] rounded-2xl flex items-center justify-center text-white shadow-2xl hover:scale-110 transition-all duration-300 z-50 border-none">
        <i class="fa-brands fa-whatsapp text-xl"></i>
    </a>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16">
            
            <div class="space-y-8">
                <div class="flex flex-col gap-4">
                    <img src="images/logo2.png" alt="SDC2 Logo" class="w-52 object-contain">
                    <h3 class="text-lg font-poppi font-bold tracking-tight text-white leading-tight">
                        SUSTAINABLE DESIGN<br>
                        <span class=" font-medium text-emerald-500 uppercase tracking-[0.2em]">CONSTRUCTION CONSULTANCY</span>
                    </h3>
                </div>

                <p class="text-[14px] text-gray-400 leading-relaxed font-rale">
                    REDEFINING THE MAKING.
                </p>

                <div class="flex space-x-4">
                    <?php 
                    $socials = [
                        'linkedin-in' => 'https://www.linkedin.com/in/sustainable-design-and-construction-consultancy-a7808b3ba',
                        'x-twitter' => 'https://x.com/Sdc2Connect',
                        'instagram' => 'https://www.instagram.com/connect2sdc2/',
                        'facebook-f' => 'https://www.facebook.com/profile.php?id=61576456765986'
                    ];
                    foreach($socials as $icon => $url): ?>
                        <a href="<?php echo $url; ?>" target="_blank" class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center text-gray-400 hover:bg-emerald-500 hover:text-white hover:-rotate-12 transition-all duration-300">
                            <i class="fa-brands fa-<?php echo $icon; ?> text-sm"></i>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div>
                <h4 class="text-sm font-poppi font-bold uppercase tracking-widest text-white mb-8 border-l-4 border-emerald-500 pl-4">Services</h4>
                <ul class="space-y-4 text-[14px] font-rale">
                    <li><a href="services.php#architectural" class="hover:text-emerald-400 flex items-center gap-2 transition-colors"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500/30"></span> Architectural Design</a></li>
                    <li><a href="services.php#construction" class="hover:text-emerald-400 flex items-center gap-2 transition-colors"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500/30"></span> Construction Management</a></li>
                    <li><a href="services.php#permits" class="hover:text-emerald-400 flex items-center gap-2 transition-colors"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500/30"></span> Construction Permits and All Associated Services</a></li>
                    <li><a href="services.php#project" class="hover:text-emerald-400 flex items-center gap-2 transition-colors"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500/30"></span> Project Advisory</a></li>
                    <li><a href="services.php#renovation" class="hover:text-emerald-400 flex items-center gap-2 transition-colors"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500/30"></span> Renovation & Retrofitting</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="text-sm font-poppi font-bold uppercase tracking-widest text-white mb-8 border-l-4 border-emerald-500 pl-4">Company</h4>
                <ul class="space-y-4 text-[14px] font-rale">
                    <?php foreach($nav_items as $name => $link): ?>
                        <li><a href="<?php echo $link; ?>" class="hover:text-emerald-400 transition-colors"><?php echo $name; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <div>
                <h4 class="text-sm font-poppi font-bold uppercase tracking-widest text-white mb-8 border-l-4 border-emerald-500 pl-4">Get In Touch</h4>
                <ul class="space-y-5 text-[14px] font-rale">
                    <li class="flex items-start space-x-4 group">
                        <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center shrink-0 group-hover:bg-[#c95c0e] transition-colors">
                            <i class="fa-regular fa-envelope text-emerald-400 group-hover:text-white"></i>
                        </div>
                        <span class="text-gray-400 pt-2">connect2sdc2@gmail.com</span>
                    </li>
                    <li class="flex items-start space-x-4 group">
                        <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center shrink-0 group-hover:bg-[#c95c0e] transition-colors">
                            <i class="fa-regular fa-building text-emerald-400 group-hover:text-white"></i>
                        </div>
                        <span class="text-gray-400 pt-1">Rubis Buriza Service Station<br>Kigali, Rwanda</span>
                    </li>
                    <li class="flex items-start space-x-4 group">
                        <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center shrink-0 group-hover:bg-[#c95c0e] transition-colors">
                            <i class="fa-solid fa-phone text-emerald-400 group-hover:text-white"></i>
                        </div>
                        <span class="text-gray-400 pt-2">+250 788 231 758</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-white/5 mt-20 pt-10 flex flex-col md:row justify-between items-center gap-6">
            <p class="text-gray-500 text-xs font-rale tracking-wide">
                © <?php echo date('Y'); ?> Sustainable Design & Construction Consultancy.
            </p>
        </div>
    </div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js" integrity="sha512-Ysw1DcK1P+uYLqprEAzNQJP+J4hTx4t/3X2nbVwszao8wD+9afLjBQYjz7Uk4ADP+Er++mJoScI42ueGtQOzEA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="app.js"></script>

<script>
    const mobileBtn = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const scrollToTopBtn = document.getElementById('scrollToTop');

    mobileBtn?.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));

    document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', () => mobileMenu.classList.add('hidden'));
    });

    window.addEventListener('scroll', () => {
        const isVisible = window.pageYOffset > 400;
        scrollToTopBtn.style.opacity = isVisible ? '1' : '0';
        scrollToTopBtn.style.visibility = isVisible ? 'visible' : 'hidden';
        scrollToTopBtn.style.transform = isVisible ? 'translateY(0)' : 'translateY(20px)';
    });

    scrollToTopBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Disable right-click on all images
document.querySelectorAll('img').forEach(img => {
    img.addEventListener('contextmenu', (e) => {
        e.preventDefault();
        return false;
    });
    
    // Disable dragging
    img.addEventListener('dragstart', (e) => {
        e.preventDefault();
        return false;
    });
});

// Also disable keyboard shortcuts (Print Screen, etc.)
document.addEventListener('keydown', (e) => {
    if (e.key === 'PrintScreen' || 
        (e.ctrlKey && (e.key === 's' || e.key === 'S'))) {
        e.preventDefault();
        return false;
    }
});
</script>

</body>
</html>