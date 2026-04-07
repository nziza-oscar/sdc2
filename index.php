<?php
$page_title = 'Home';
include 'header.php';
?>

<section class="relative min-h-[90vh] flex items-center banner-bg">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-[#c95c0e]/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-[#c95c0e]/5 rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
        <div class="grid lg:grid-cols-2 gap-5 items-center">
            <div class="hero-content">
                <span class="text-[#c95c0e] font-poppi font-semibold tracking-wider uppercase text-sm mb-4 block">Welcome to SDC2</span>
                <h1 class="text-2xl md:text-5xl lg:text-6xl font-poppi leading-tight mb-6 text-white font-bold">
                    Welcome to <span class="text-[#c95c0e]">Sustainable Design<br>and Construction Consultancy</span>
                    
                </h1>

                <p class="text-lg text-gray-100 mb-6 font-rale leading-relaxed font-medium" style="text-shadow: 0 1px 3px rgb(0 0 0 / 50%), 0 2px 6px rgb(0 0 0 / 30%);">
                    At Sustainable Design and Construction Consultancy, we turn ideas into resilient, efficient, and future-ready structures. We are committed to delivering innovative engineering and design solutions that balance functionality, cost-effectiveness, and environmental responsibility.
                </p>
                <p class="text-lg text-gray-100 mb-6 font-rale leading-relaxed font-medium" style="text-shadow: 0 1px 3px rgb(0 0 0 / 50%), 0 2px 6px rgb(0 0 0 / 30%);">
                    From concept to completion, we bring cutting-edge engineering, smart design strategies, and sustainable practices together to deliver results that exceed expectations.
                </p>
                <p class="text-lg text-gray-100 mb-8 font-rale leading-relaxed font-medium" style="text-shadow: 0 1px 3px rgb(0 0 0 / 50%), 0 2px 6px rgb(0 0 0 / 30%);">
                    Whether you're developing a new project, solving complex structural challenges, or optimizing costs without compromising quality, SDC2 is your trusted partner.
                </p>
                
                <div class="flex flex-wrap gap-4">
                    <a href="services.php" class="bg-[#c95c0e] text-white px-8 py-3 rounded-full font-poppi font-semibold text-base hover:bg-[#b04d0c] transition-all duration-300 shadow-lg">Explore our Services</a>
                    <a href="projects.php" class="border-2 border-[#c95c0e] text-white px-8 py-3 rounded-full font-poppi font-semibold text-base hover:bg-[#c95c0e] transition-all duration-300">View Projects</a>
                </div>
            </div>
            <div class="relative">
                <div class="p-8">
                    <img src="images/welcome.png" alt="Sustainable Architecture" class="rounded-xl w-full">
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
                <span class="text-[#c95c0e] font-poppi font-semibold tracking-wider uppercase text-sm mb-4 block">Why Choose Us</span>
                <h2 class="text-2xl md:text-3xl font-poppi mb-6 text-[#1a4d3e] font-bold">Intelligent design. Lasting value.</h2>
                <p class="text-base text-gray-600 mb-8 font-rale leading-relaxed">
                    From concept to completion, we bring cutting-edge engineering, smart design strategies, and sustainable practices together to deliver results that exceed expectations. Whether you're developing a new project, solving complex structural challenges, or optimizing costs without compromising quality, SDC2 is your trusted partner.
                </p>
                <div class="grid grid-cols-1 gap-4 mb-8">
                    <div class="flex items-center gap-3">
                        <i class="fa-regular fa-circle-check text-[#c95c0e] text-xl"></i>
                        <span class="text-gray-700 font-poppi">Innovative & practical design solutions</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-regular fa-circle-check text-[#c95c0e] text-xl"></i>
                        <span class="text-gray-700 font-poppi">Cost-effective and efficient project delivery</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-regular fa-circle-check text-[#c95c0e] text-xl"></i>
                        <span class="text-gray-700 font-poppi">Commitment to sustainability and durability</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-regular fa-circle-check text-[#c95c0e] text-xl"></i>
                        <span class="text-gray-700 font-poppi">Reliable expertise you can trust</span>
                    </div>
                </div>
                <a href="about.php" class="inline-block bg-[#1a4d3e] text-white px-8 py-3 rounded-full font-poppi font-semibold text-base hover:bg-[#c95c0e] transition-all duration-300">Get in Touch</a>
            </div>
        </div>
    </div>
</section>

<section class="py-16 md:py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-[#c95c0e] font-poppi font-semibold tracking-wider uppercase text-sm mb-4 block">Our Services</span>
            <h2 class="text-2xl md:text-3xl font-poppi text-[#1a4d3e] font-bold mb-4">Providing quality services</h2>
            <p class="text-base text-gray-600 font-rale">Comprehensive construction solutions tailored to your needs.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="w-16 h-16 bg-[#1a4d3e]/10 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-ruler text-2xl text-[#1a4d3e]"></i>
                </div>
                <h3 class="text-xl font-poppi font-semibold mb-4 text-[#1a4d3e]">Architectural Design</h3>
                <ul class="space-y-3 text-sm text-gray-600 font-rale">
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
                <h3 class="text-xl font-poppi font-semibold mb-4 text-[#1a4d3e]">Construction Management</h3>
                <ul class="space-y-3 text-sm text-gray-600 font-rale">
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
                    <i class="fa-solid fa-wrench text-2xl text-[#1a4d3e]"></i>
                </div>
                <h3 class="text-xl font-poppi font-semibold mb-4 text-[#1a4d3e]">Renovation & Retrofitting</h3>
                <ul class="space-y-3 text-sm text-gray-600 font-rale">
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

<section class="bg-[#1a4d3e] text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-poppi font-bold mb-6">Your project deserves more than just construction</h2>
        <p class="text-lg text-gray-300 mb-8 max-w-3xl mx-auto font-rale">
            It deserves intelligent design and lasting value. Start building with confidence. Start with SDC2.
        </p>
        <a href="contact.php" class="inline-block bg-[#c95c0e] text-white px-10 py-4 rounded-full font-poppi font-semibold text-base hover:bg-[#b04d0c] transition-colors shadow-lg">
            Contact us now
        </a>
    </div>
</section>

<?php include 'footer.php'; ?>