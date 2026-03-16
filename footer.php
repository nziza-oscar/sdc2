<!-- Footer -->
<footer class="bg-neutral-50 border-t border-neutral-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            
            <!-- Company Info -->
            <div>
                <h3 class="text-xl font-semibold mb-6">
                    <span class="text-primary">EVER</span>
                    <span class="text-secondary">DESIGN</span>
                </h3>
                <p class="text-neutral-700 mb-6 leading-relaxed">
                    Ever Design Group transforms ideas into architectural masterpieces with innovative design and quality construction. We prioritize sustainability and efficiency to create lasting, functional spaces.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all shadow-sm">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all shadow-sm">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all shadow-sm">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all shadow-sm">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                </div>
            </div>
            
            <!-- Our Services -->
            <div>
                <h4 class="text-lg font-semibold mb-6">Our Services</h4>
                <ul class="space-y-4">
                    <li><a href="#" class="text-neutral-700 hover:text-primary transition-colors">Architectural Design</a></li>
                    <li><a href="#" class="text-neutral-700 hover:text-primary transition-colors">Construction Management</a></li>
                    <li><a href="#" class="text-neutral-700 hover:text-primary transition-colors">Renovation and Remodeling</a></li>
                    <li><a href="#" class="text-neutral-700 hover:text-primary transition-colors">Urban planning and development</a></li>
                </ul>
            </div>
            
            <!-- Useful Links -->
            <div>
                <h4 class="text-lg font-semibold mb-6">Useful links</h4>
                <ul class="space-y-4">
                    <?php foreach($nav_items as $name => $link): ?>
                        <li><a href="<?php echo $link; ?>" class="text-neutral-700 hover:text-primary transition-colors"><?php echo $name; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <!-- Contact Us -->
            <div>
                <h4 class="text-lg font-semibold mb-6">Contact Us</h4>
                <ul class="space-y-4">
                    <li class="flex items-start space-x-3">
                        <i class="fa-regular fa-envelope text-primary mt-1"></i>
                        <div>
                            <p class="text-neutral-700">info@everdesigngroupe.com</p>
                            <p class="text-neutral-700">everdesigncompany@td@gmail.com</p>
                        </div>
                    </li>
                    <li class="flex items-start space-x-3">
                        <i class="fa-regular fa-building text-primary mt-1"></i>
                        <p class="text-neutral-700">M.peace plaza 3rd floor Block B F3 31 room</p>
                    </li>
                    <li class="flex items-start space-x-3">
                        <i class="fa-regular fa-phone text-primary mt-1"></i>
                        <p class="text-neutral-700">+250785035071</p>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Bottom Bar -->
        <div class="border-t border-neutral-200 mt-16 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-neutral-600 text-sm">© Copyright 2026 EverDesign. All rights reserved.</p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="text-sm text-neutral-600 hover:text-primary">Privacy Policy</a>
                <a href="#" class="text-sm text-neutral-600 hover:text-primary">Terms of Service</a>
                <a href="#" class="text-sm text-neutral-600 hover:text-primary">Cookie Policy</a>
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
</script>

</body>
</html>