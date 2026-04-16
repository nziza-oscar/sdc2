<?php
$page_title = 'Our Mission';
include 'header.php';
?>

<!-- Hero Section -->
<section class="relative py-16 flex items-center bg-[#0a2d4d] text-white overflow-hidden">
    <!-- Carbon Fiber Pattern Overlay -->
    <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
    
    <!-- Glowing Accents -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-96 h-96 bg-emerald-500 rounded-full blur-[120px] -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#c95c0e] rounded-full blur-[120px] translate-x-1/2 translate-y-1/2"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
       
        
        <!-- Heading -->
        <h1 class="text-3xl md:text-5xl font-extrabold leading-tight mb-4 text-emerald-400 uppercase font-poppi">
            Our <span class="text-white">Mission</span>
        </h1>
        
        <!-- Description -->
        <p class="text-sm text-white/70 max-w-3xl mx-auto leading-relaxed font-rale">
            Transforming ideas into architectural masterpieces through innovative design and quality construction, while prioritizing sustainability and efficiency to create lasting, functional spaces.
        </p>
    </div>
</section>

<!-- Mission Content Section -->
<section class="py-24 bg-white relative -mt-12 rounded-t-[60px] z-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            
            <!-- Left Side: Interactive Quote & Image -->
            <div class="relative">
                <div class="relative z-10 rounded-[60px] overflow-hidden border-[12px] border-neutral-50 shadow-2xl group">
                    <img src="images/projects/sdc2-20.jpeg" alt="Our Mission" class="w-full h-[550px] object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div class="absolute bottom-10 left-10 right-10">
                        <div class="w-16 h-16 bg-emerald-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                            <i class="fa-solid fa-quote-left text-2xl text-white"></i>
                        </div>
                        <p class="text-2xl font-poppi font-medium text-white leading-relaxed italic">
                            "Sustainability and efficiency are at the core of every functional space we create."
                        </p>
                    </div>
                </div>
                <!-- Decorative backgrounds -->
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-emerald-500/10 rounded-full blur-3xl"></div>
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#c95c0e]/10 rounded-full blur-3xl"></div>
            </div>

            <!-- Right Side: Details -->
            <div class="space-y-10">
                <div>
                    <h2 class="text-4xl font-poppi font-bold text-neutral-900 mb-6 leading-tight">
                        What Drives <span class="text-emerald-600">SDC2</span>
                    </h2>
                    <div class="space-y-6 text-lg text-neutral-600 font-rale leading-relaxed">
                        <p>
                            At <span class="font-bold text-neutral-900">Sustainable Design and Construction Consultancy (SDC2)</span>, our mission is rooted in the belief that exceptional design and responsible construction can coexist harmoniously.
                        </p>
                        <p>
                            We are committed to pushing the boundaries of sustainable architecture in Rwanda and beyond. 
                            Every project we undertake is an opportunity to demonstrate that beautiful, 
                            functional spaces can be created with minimal environmental impact.
                        </p>
                    </div>
                </div>

                <!-- Feature List -->
                <div class="grid sm:grid-cols-2 gap-8">
                    <div class="flex gap-4">
                        <div class="shrink-0 w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600">
                            <i class="fa-solid fa-leaf text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-poppi font-bold text-neutral-900">Eco-Friendly</h4>
                            <p class="text-sm text-neutral-500 font-rale">Sustainability in every phase.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="shrink-0 w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                            <i class="fa-solid fa-star text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-poppi font-bold text-neutral-900">Quality</h4>
                            <p class="text-sm text-neutral-500 font-rale">Superior construction results.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="shrink-0 w-12 h-12 bg-[#c95c0e]/10 rounded-xl flex items-center justify-center text-[#c95c0e]">
                            <i class="fa-solid fa-clock text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-poppi font-bold text-neutral-900">Timely</h4>
                            <p class="text-sm text-neutral-500 font-rale">Delivered on schedule.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="shrink-0 w-12 h-12 bg-teal-50 rounded-xl flex items-center justify-center text-teal-600">
                            <i class="fa-solid fa-handshake text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-poppi font-bold text-neutral-900">Integrity</h4>
                            <p class="text-sm text-neutral-500 font-rale">Honest & transparent.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Core Values Section -->
<section class="py-24 bg-neutral-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h2 class="text-4xl font-poppi font-bold text-neutral-900 mb-4">Our Core Values</h2>
            <p class="text-neutral-500 font-rale text-lg">The principles that guide our craft and define our impact on the community.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Value Card 1 -->
            <div class="bg-white p-10 rounded-[40px] shadow-sm border border-neutral-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 group">
                <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                    <i class="fa-solid fa-leaf text-2xl"></i>
                </div>
                <h3 class="text-xl font-poppi font-bold text-neutral-900 mb-3">Sustainability</h3>
                <p class="text-neutral-500 font-rale text-sm leading-relaxed">Environmental responsibility in every decision we make.</p>
            </div>

            <!-- Value Card 2 -->
            <div class="bg-white p-10 rounded-[40px] shadow-sm border border-neutral-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 group">
                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-all">
                    <i class="fa-solid fa-medal text-2xl"></i>
                </div>
                <h3 class="text-xl font-poppi font-bold text-neutral-900 mb-3">Excellence</h3>
                <p class="text-neutral-500 font-rale text-sm leading-relaxed">
                Consistently delivering outstanding quality, precision, and value without compromise.</p>
            </div>

            <!-- Value Card 3 -->
            <div class="bg-white p-10 rounded-[40px] shadow-sm border border-neutral-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 group">
                <div class="w-16 h-16 bg-[#c95c0e]/10 text-[#c95c0e] rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#c95c0e] group-hover:text-white transition-all">
                    <i class="fa-solid fa-scale-balanced text-2xl"></i>
                </div>
                <h3 class="text-xl font-poppi font-bold text-neutral-900 mb-3">Integrity</h3>
                <p class="text-neutral-500 font-rale text-sm leading-relaxed">Building trust through honest, transparent, and ethical business practices.</p>
            </div>

            <!-- Value Card 4 -->
            <div class="bg-white p-10 rounded-[40px] shadow-sm border border-neutral-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-500 group">
                <div class="w-16 h-16 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-teal-600 group-hover:text-white transition-all">
                    <i class="fa-solid fa-users text-2xl"></i>
                </div>
                <h3 class="text-xl font-poppi font-bold text-neutral-900 mb-3">Partnership</h3>
                <p class="text-neutral-500 font-rale text-sm leading-relaxed">Working together with our clients to turn their unique vision into reality.</p>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>