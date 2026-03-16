<!-- Footer -->
<footer class="bg-neutral-50 border-t border-neutral-200 relative">
    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="fixed bottom-8 right-8 w-12 h-12 bg-dark-orange rounded-full flex items-center justify-center text-white shadow-lg hover:bg-dark-green transition-all duration-300 z-50 opacity-0 invisible cursor-pointer">
        <i class="fa-solid fa-arrow-up text-xl"></i>
    </button>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            
            <!-- Company Info -->
            <div>
                <h3 class="text-xl font-semibold mb-6 text-dark-green">
                    SUSTAINABLE DESIGN<br>
                    <span class="text-sm font-normal text-neutral-600">& CONSTRUCTION CONSULTANCY</span>
                </h3>
                <p class="text-neutral-700 mb-6 leading-relaxed">
                    We transform ideas into architectural masterpieces with innovative design and quality construction. We prioritize sustainability and efficiency to create lasting, functional spaces.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-dark-green hover:bg-dark-orange hover:text-white transition-all shadow-sm">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-dark-green hover:bg-dark-orange hover:text-white transition-all shadow-sm">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-dark-green hover:bg-dark-orange hover:text-white transition-all shadow-sm">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-dark-green hover:bg-dark-orange hover:text-white transition-all shadow-sm">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                </div>
            </div>
            
            <!-- Our Services -->
            <div>
                <h4 class="text-lg font-semibold mb-6 text-dark-green">Our Services</h4>
                <ul class="space-y-4">
                    <li><a href="#" class="text-neutral-700 hover:text-dark-orange transition-colors">Architectural Design</a></li>
                    <li><a href="#" class="text-neutral-700 hover:text-dark-orange transition-colors">Construction Management</a></li>
                    <li><a href="#" class="text-neutral-700 hover:text-dark-orange transition-colors">Renovation and Remodeling</a></li>
                    <li><a href="#" class="text-neutral-700 hover:text-dark-orange transition-colors">Urban planning and development</a></li>
                </ul>
            </div>
            
            <!-- Useful Links -->
            <div>
                <h4 class="text-lg font-semibold mb-6 text-dark-green">Useful links</h4>
                <ul class="space-y-4">
                    <?php foreach($nav_items as $name => $link): ?>
                        <li><a href="<?php echo $link; ?>" class="text-neutral-700 hover:text-dark-orange transition-colors"><?php echo $name; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <!-- Contact Us -->
            <div>
                <h4 class="text-lg font-semibold mb-6 text-dark-green">Contact Us</h4>
                <ul class="space-y-4">
                    <li class="flex items-start space-x-3">
                        <i class="fa-regular fa-envelope text-dark-orange mt-1"></i>
                        <div>
                            <p class="text-neutral-700">info@sustainableconstruct.com</p>
                            <p class="text-neutral-700">consultancy@sustainable.rw</p>
                        </div>
                    </li>
                    <li class="flex items-start space-x-3">
                        <i class="fa-regular fa-building text-dark-orange mt-1"></i>
                        <p class="text-neutral-700">Plot 37, Avenue, Kigali, Rwanda</p>
                    </li>
                    <li class="flex items-start space-x-3">
                        <i class="fa-regular fa-phone text-dark-orange mt-1"></i>
                        <p class="text-neutral-700">(+250) 790 022 000 / 111</p>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Bottom Bar -->
        <div class="border-t border-neutral-200 mt-16 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-neutral-600 text-sm">© Copyright 2026 Sustainable Design & Construction Consultancy. All rights reserved.</p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="text-sm text-neutral-600 hover:text-dark-orange">Privacy Policy</a>
                <a href="#" class="text-sm text-neutral-600 hover:text-dark-orange">Terms of Service</a>
                <a href="#" class="text-sm text-neutral-600 hover:text-dark-orange">Cookie Policy</a>
            </div>
        </div>
    </div>
</footer>

<!-- GSAP Animations -->
<script src="js/main.js"></script>

<!-- Mobile menu toggle -->
<script>
document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
});

// Close mobile menu when clicking a link
document.querySelectorAll('#mobile-menu a').forEach(link => {
    link.addEventListener('click', () => {
        document.getElementById('mobile-menu').classList.add('hidden');
    });
});

// Scroll to Top functionality
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