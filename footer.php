<footer class="bg-[#111827] text-gray-300 relative border-t border-gray-800">
    <button id="scrollToTop" class="fixed bottom-8 right-8 w-11 h-11 bg-[#c95c0e] rounded-full flex items-center justify-center text-white shadow-lg hover:bg-white hover:text-[#1a4d3e] transition-all duration-300 z-50 opacity-0 invisible cursor-pointer border-none">
        <i class="fa-solid fa-arrow-up text-lg"></i>
    </button>
    
    <a href="https://wa.me/250788282953" target="_blank" class="fixed bottom-8 right-24 w-11 h-11 bg-[#25D366] rounded-full flex items-center justify-center text-white shadow-lg hover:bg-white hover:text-[#25D366] transition-all duration-300 z-50 border-none">
        <i class="fa-brands fa-whatsapp text-lg"></i>
    </a>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            
            <div class="space-y-6">
                <h3 class="text-lg font-bold tracking-tight text-white leading-tight">
                    SUSTAINABLE DESIGN<br>
                    <span class="text-xs font-medium text-gray-400 uppercase tracking-widest">& CONSTRUCTION CONSULTANCY</span>
                </h3>
                <p class="text-[14px] text-gray-400 leading-relaxed">
                    We transform ideas into architectural masterpieces with innovative design and quality construction. We prioritize sustainability and efficiency to create lasting, functional spaces.
                </p>
                <div class="flex space-x-3">
                    <a href="www.linkedin.com/in/sustainable-design-and-construction-consultancy-a7808b3ba" target="_blank" class="w-9 h-9 bg-gray-800 rounded-full flex items-center justify-center text-gray-300 hover:bg-[#c95c0e] hover:text-white transition-all">
                        <i class="fa-brands fa-linkedin-in text-sm"></i>
                    </a>
                    <a href="https://x.com/Sdc2Connect" target="_blank" class="w-9 h-9 bg-gray-800 rounded-full flex items-center justify-center text-gray-300 hover:bg-[#c95c0e] hover:text-white transition-all">
                        <i class="fa-brands fa-x-twitter text-sm"></i>
                    </a>
                    <a href="https://www.instagram.com/connect2sdc2/" target="_blank" class="w-9 h-9 bg-gray-800 rounded-full flex items-center justify-center text-gray-300 hover:bg-[#c95c0e] hover:text-white transition-all">
                        <i class="fa-brands fa-instagram text-sm"></i>
                    </a>
                    <a href="https://www.facebook.com/profile.php?id=61576456765986" target="_blank" class="w-9 h-9 bg-gray-800 rounded-full flex items-center justify-center text-gray-300 hover:bg-[#c95c0e] hover:text-white transition-all">
                        <i class="fa-brands fa-facebook-f text-sm"></i>
                    </a>
                    <a href="https://wa.me/250788282953" target="_blank" class="w-9 h-9 bg-gray-800 rounded-full flex items-center justify-center text-gray-300 hover:bg-[#25D366] hover:text-white transition-all">
                        <i class="fa-brands fa-whatsapp text-sm"></i>
                    </a>
                </div>
            </div>
            
            <div>
                <h4 class="text-sm font-bold uppercase tracking-wider text-white mb-6">Our Services</h4>
                <ul class="space-y-3 text-[14px]">
                    <li><a href="services.php#architectural" class="hover:text-[#c95c0e] transition-colors">Architectural Design</a></li>
                    <li><a href="services.php#construction" class="hover:text-[#c95c0e] transition-colors">Construction Management</a></li>
                    <li><a href="services.php#renovation" class="hover:text-[#c95c0e] transition-colors">Renovation and Remodeling</a></li>
                    <li><a href="services.php#urban" class="hover:text-[#c95c0e] transition-colors">Urban planning and development</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="text-sm font-bold uppercase tracking-wider text-white mb-6">Useful links</h4>
                <ul class="space-y-3 text-[14px]">
                    <?php foreach($nav_items as $name => $link): ?>
                        <li><a href="<?php echo $link; ?>" class="hover:text-[#c95c0e] transition-colors"><?php echo $name; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <div>
                <h4 class="text-sm font-bold uppercase tracking-wider text-white mb-6">Contact Us</h4>
                <ul class="space-y-4 text-[14px]">
                    <li class="flex items-start space-x-3">
                        <i class="fa-regular fa-envelope text-[#c95c0e] mt-1"></i>
                        <div class="text-gray-400">
                            <p>connect2sdc2@gmail.com</p>
                        </div>
                    </li>
                    <li class="flex items-start space-x-3">
                        <i class="fa-regular fa-building text-[#c95c0e] mt-1"></i>
                        <p class="text-gray-400">RWANDA-KIGALI-GASABO, Rubis Buriza Service Station</p>
                    </li>
                    <li class="flex items-start space-x-3">
                        <i class="fa-solid fa-phone text-[#c95c0e] mt-1"></i>
                        <p class="text-gray-400">+250 788 282 953</p>
                    </li>
                    <li class="flex items-start space-x-3">
                        <i class="fa-brands fa-whatsapp text-[#25D366] mt-1"></i>
                        <a href="https://wa.me/250788282953" target="_blank" class="text-gray-400 hover:text-[#25D366] transition-colors">+250 788 282 953</a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-800 mt-16 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-500 text-xs">© Copyright 2026 Sustainable Design & Construction Consultancy. All rights reserved.</p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="privacy.php" class="text-xs text-gray-500 hover:text-white transition-colors">Privacy Policy</a>
                <a href="terms.php" class="text-xs text-gray-500 hover:text-white transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<script src="js/main.js"></script>

<script>
    document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });

    document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.add('hidden');
        });
    });

    const scrollToTopBtn = document.getElementById('scrollToTop');

    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            scrollToTopBtn.style.opacity = '1';
            scrollToTopBtn.style.visibility = 'visible';
        } else {
            scrollToTopBtn.style.opacity = '0';
            scrollToTopBtn.style.visibility = 'hidden';
        }
    });

    scrollToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>

</body>
</html>