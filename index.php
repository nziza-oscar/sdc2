<?php
 require_once 'header.php';
?>

    <section class="relative min-h-[90vh] flex items-center overflow-hidden hero-gradient text-white pt-10 pb-20">
        <div class="hidden md:block absolute bottom-0 right-0 w-1/3 h-full accent-bg" style="clip-path: polygon(100% 0, 0% 100%, 100% 100%);"></div>

        <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-12 px-6 md:px-8 mx-auto max-w-7xl items-center">
            
            <div class="space-y-8 text-center md:text-left">
                <span class="inline-block px-4 py-1 rounded-full bg-emerald-500/10 text-emerald-400 text-xs font-poppi uppercase tracking-widest mb-4 border border-emerald-500/20">
                    Welcome to SDC2
                </span>
                <h2 class="reveal-up text-3xl md:text-4xl lg:text-5xl font-extrabold leading-tight ">
                    Sustainable Design and <br/> <span class="text-emerald-400 whitespace-nowrap">Construction Consultancy</span>
                </h2>
                <p class="reveal-up max-w-xl mx-auto md:mx-0 text-sm leading-relaxed opacity-80">
                    At Sustainable Design and Construction Consultancy, we turn ideas into resilient, efficient, and future-ready structures. We are committed to delivering innovative engineering and design solutions that balance functionality, cost-effectiveness, and environmental responsibility.
                </p>

                 <p class="reveal-up max-w-xl mx-auto md:mx-0 text-sm leading-relaxed opacity-80">
                  From concept to completion, we bring cutting-edge engineering, smart design strategies, and sustainable practices together to deliver results that exceed expectations.
                </p>

                <div class="reveal-up flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="projects.php" class="px-8 py-4 bg-green-400 text-cyan-900 rounded-full font-bold shadow-xl hover:bg-green-300 transition-all">Explore Projects</a>
                </div>
            </div>

            <div class="hidden md:flex relative justify-center">
                <div class="absolute -top-2 -left-12 grid grid-cols-4 gap-4 opacity-30">
                    <div class="w-2 h-2 bg-white rounded-full reveal-up"></div><div class="w-2 h-2 bg-white rounded-full"></div>
                    <div class="w-2 h-2 bg-white rounded-full reveal-up"></div><div class="w-2 h-2 bg-white rounded-full"></div>
                    <div class="w-2 h-2 bg-white rounded-full reveal-up"></div><div class="w-2 h-2 bg-white rounded-full"></div>
                    <div class="w-2 h-2 bg-white rounded-full reveal-up"></div><div class="w-2 h-2 bg-white rounded-full"></div>
                </div>

                <div id="hero-img-box" class="hex-shape w-full aspect-square max-w-md bg-transparent overflow-hidden border-[12px] border-white/10 shadow-2xl">
                    <img src="images/projects/sdc2-7.jpeg" alt="Sustainable Construction Project" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </section>

   
    <section class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 md:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                
                <div class="relative order-2 lg:order-1 flex justify-center lg:justify-start">
                    <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-green-100 rounded-full -z-10 opacity-60"></div>
                    <div class="absolute -top-10 left-10 text-orange-500/10 scale-150 -z-10">
                        <i class="fa-solid fa-quote-left text-9xl"></i>
                    </div>

                    <div class="about-image-wrapper relative w-full max-w-md aspect-square">
                        <svg width="0" height="0" style="position: absolute;">
                            <defs>
                                <mask id="rounded-hex" maskUnits="objectBoundingBox" maskContentUnits="objectBoundingBox">
                                    <path d="M0.5,0 L0.9,0.25 L0.9,0.75 L0.5,1 L0.1,0.75 L0.1,0.25 Z" fill="white" />
                                </mask>
                            </defs>
                        </svg>
                        
                        <div class="w-full h-full overflow-hidden"
                        style="clip-path: polygon(15% 0%, 85% 0%, 100% 15%, 100% 85%, 85% 100%, 15% 100%, 0% 85%, 0% 15%); border-radius: 2rem;">
                            <img src="images/projects/sdc2-8.jpeg" 
                                alt="Engineers at work" 
                                class="w-full h-full object-cover reveal-up rounded-xl"/>
                        </div>

                        <div class="absolute -bottom-4 -right-4 bg-[#c95c0e] text-white p-6 rounded-2xl shadow-2xl reveal-up">
                            <span class="block text-4xl font-extrabold">10+</span>
                            <span class="text-xs uppercase tracking-widest font-semibold opacity-80">Years of<br>Excellence</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-8 order-1 lg:order-2">
                    <div class="reveal-up">
                        <span class="text-[#c95c0e] font-bold tracking-[0.2em] uppercase text-sm border-l-4 border-[#c95c0e] pl-4">Who We Are</span>
                        <h2 class="text-4xl md:text-5xl font-extrabold text-[#0a2d4d] mt-4 leading-tight">
                        AT SDC2
                        </h2>
                    </div>

                    <p class="text-gray-600 text-lg leading-relaxed reveal-up">
                        From concept to completion, we bring cutting-edge engineering, smart design strategies, and sustainable practices together to deliver results that exceed expectations.
                    </p>

                    <p class="text-gray-600 text-lg leading-relaxed reveal-up">
                    Whether you're developing a new project, solving complex structural challenges, or optimizing costs without compromising quality, SDC2 is your trusted partner.


                    

                    <div class="pt-4 reveal-up">
                        <a href="about.php" class="inline-flex items-center gap-3 text-[#0a2d4d] font-bold group">
                            Learn More About Our Journey
                            <span class="w-10 h-10 bg-green-400 rounded-full flex items-center justify-center group-hover:bg-[#0a2d4d] group-hover:text-white transition-all">
                                <i class="fa-solid fa-arrow-right"></i>
                            </span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- Why Choose Us Section -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 md:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-extrabold text-[#0a2d4d]">Why choose us?</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12 mb-16 max-w-4xl mx-auto reveal-up">
            <div class="flex items-start gap-4">
                <div class="shrink-0 w-6 h-6 bg-emerald-500 rounded-full flex items-center justify-center mt-1">
                    <i class="fa-solid fa-check text-white text-xs"></i>
                </div>
                <p class="text-gray-700 font-bold text-lg">Innovative & practical design solutions</p>
            </div>
            
            <div class="flex items-start gap-4">
                <div class="shrink-0 w-6 h-6 bg-emerald-500 rounded-full flex items-center justify-center mt-1">
                    <i class="fa-solid fa-check text-white text-xs"></i>
                </div>
                <p class="text-gray-700 font-bold text-lg">Cost-effective and efficient project delivery</p>
            </div>
            
            <div class="flex items-start gap-4">
                <div class="shrink-0 w-6 h-6 bg-emerald-500 rounded-full flex items-center justify-center mt-1">
                    <i class="fa-solid fa-check text-white text-xs"></i>
                </div>
                <p class="text-gray-700 font-bold text-lg">Commitment to sustainability and durability</p>
            </div>
            
            <div class="flex items-start gap-4">
                <div class="shrink-0 w-6 h-6 bg-emerald-500 rounded-full flex items-center justify-center mt-1">
                    <i class="fa-solid fa-check text-white text-xs"></i>
                </div>
                <p class="text-gray-700 font-bold text-lg">Reliable expertise you can trust</p>
            </div>
        </div>

        <div class="text-center space-y-6 border-t border-gray-100 pt-12">
            <p class="text-lg text-gray-600 max-w-2xl mx-auto font-rale">
                Your project deserves more than just construction, it deserves intelligent design and lasting value.
            </p>
            <p class="text-2xl font-extrabold text-[#0a2d4d] tracking-tight">
                Start building with confidence. Start with SDC2.
            </p>
        </div>
    </div>
</section>



<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 md:px-8">
        <div class="mb-16">
            <span class="text-[#c95c0e] font-bold tracking-widest uppercase text-xs border-l-4 border-[#c95c0e] pl-4">Expertise</span>
            <h2 class="text-4xl md:text-5xl font-extrabold text-[#0a2d4d] mt-4">Our Services</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white p-10 shadow-sm border-b-4 border-emerald-500 hover:shadow-xl transition-all group">
                <div class="w-16 h-16 bg-emerald-50 flex items-center justify-center mb-8 group-hover:bg-emerald-500 transition-colors">
                    <i class="fa-solid fa-compass-drafting text-emerald-600 text-3xl group-hover:text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-[#0a2d4d] mb-4">Architectural Design</h3>
                <p class="text-gray-600 leading-relaxed mb-6 font-rale">
                    Innovative blueprints and spatial planning that balance aesthetic vision with functional requirements and environmental context.
                </p>
                <a href="services.php#architectural" class="text-[#c95c0e] font-bold flex items-center gap-2 group-hover:gap-4 transition-all">
                    Explore Service <i class="fa-solid fa-arrow-right-long"></i>
                </a>
            </div>

            <div class="bg-white p-10 shadow-sm border-b-4 border-[#0a2d4d] hover:shadow-xl transition-all group">
                <div class="w-16 h-16 bg-blue-50 flex items-center justify-center mb-8 group-hover:bg-[#0a2d4d] transition-colors">
                    <i class="fa-solid fa-trowel-bricks text-[#0a2d4d] text-3xl group-hover:text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-[#0a2d4d] mb-4">Construction Management</h3>
                <p class="text-gray-600 leading-relaxed mb-6 font-rale">
                    End-to-end supervision ensuring projects are delivered on time, within budget, and to the highest technical standards.
                </p>
                <a href="services.php#construction" class="text-[#c95c0e] font-bold flex items-center gap-2 group-hover:gap-4 transition-all">
                    Explore Service <i class="fa-solid fa-arrow-right-long"></i>
                </a>
            </div>

            <div class="bg-white p-10 shadow-sm border-b-4 border-teal-500 hover:shadow-xl transition-all group">
                <div class="w-16 h-16 bg-teal-50 flex items-center justify-center mb-8 group-hover:bg-teal-500 transition-colors">
                    <i class="fa-solid fa-handshake-angle text-teal-600 text-3xl group-hover:text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-[#0a2d4d] mb-4">Project Advisory</h3>
                <p class="text-gray-600 leading-relaxed mb-6 font-rale">
                    Strategic consultancy for complex structural challenges, land use planning, and navigating regional development regulations.
                </p>
                <a href="services.php" class="text-[#c95c0e] font-bold flex items-center gap-2 group-hover:gap-4 transition-all">
                    Explore Service <i class="fa-solid fa-arrow-right-long"></i>
                </a>
            </div>

            <div class="bg-white p-10 shadow-sm border-b-4 border-[#c95c0e] hover:shadow-xl transition-all group">
                <div class="w-16 h-16 bg-orange-50 flex items-center justify-center mb-8 group-hover:bg-[#c95c0e] transition-colors">
                    <i class="fa-solid fa-file-invoice-dollar text-[#c95c0e] text-3xl group-hover:text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-[#0a2d4d] mb-4">Cost & Performance Control</h3>
                <p class="text-gray-600 leading-relaxed mb-6 font-rale">
                    Detailed quantity surveying and budgeting to ensure financial feasibility and prevent resource waste throughout the project.
                </p>
                <a href="services.php" class="text-[#c95c0e] font-bold flex items-center gap-2 group-hover:gap-4 transition-all">
                    Explore Service <i class="fa-solid fa-arrow-right-long"></i>
                </a>
            </div>

            <div class="bg-white p-10 shadow-sm border-b-4 border-green-500 hover:shadow-xl transition-all group">
                <div class="w-16 h-16 bg-green-50 flex items-center justify-center mb-8 group-hover:bg-green-500 transition-colors">
                    <i class="fa-solid fa-hammer text-green-600 text-3xl group-hover:text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-[#0a2d4d] mb-4">Renovation & Retrofitting</h3>
                <p class="text-gray-600 leading-relaxed mb-6 font-rale">
                    Modernizing existing structures with structural reinforcements and energy-efficient systems to improve longevity and value.
                </p>
                <a href="services.php#renovation" class="text-[#c95c0e] font-bold flex items-center gap-2 group-hover:gap-4 transition-all">
                    Explore Service <i class="fa-solid fa-arrow-right-long"></i>
                </a>
            </div>
        </div>
    </div>
</section>



<!-- <section class="py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 md:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            <div class="space-y-8">
                <div class="reveal-up">
                    <span class="text-[#c95c0e] font-bold tracking-[0.2em] uppercase text-sm border-l-4 border-[#c95c0e] pl-4">Our Commitment</span>
                    <h2 class="text-4xl md:text-5xl font-extrabold text-[#0a2d4d] mt-4 leading-tight">
                        Excellence in Engineering & <span class="text-emerald-600">Smart Strategy</span>
                    </h2>
                </div>

                <div class="space-y-6 text-gray-600 text-lg leading-relaxed font-rale">
                    <p class="reveal-up">
                        From concept to completion, we bring cutting-edge engineering, smart design strategies, and sustainable practices together to deliver results that exceed expectations.
                    </p>
                    <p class="reveal-up">
                        Whether you're developing a new project, solving complex structural challenges, or optimizing costs without compromising quality, SDC2 is your trusted partner.
                    </p>
                </div>

                <div class="pt-4 reveal-up">
                    <a href="contact.php" class="inline-flex items-center gap-3 px-8 py-4 bg-[#0a2d4d] text-white rounded-xl font-bold hover:bg-[#c95c0e] transition-all duration-300 shadow-lg group">
                        Start Your Project
                        <i class="fa-solid fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
                    </a>
                </div>
            </div>

            <div class="relative">
                <div class="relative z-10 rounded-[40px] overflow-hidden shadow-2xl">
                    <img src="images/projects/sdc2-2.jpeg" alt="Engineering Excellence" class="w-full h-[500px] object-cover">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#0a2d4d]/20 to-transparent"></div>
                </div>
                
                <div class="absolute -bottom-10 -right-10 bg-emerald-500 p-12 shadow-2xl text-white hidden md:block z-40" 
                     style="clip-path: polygon(15% 0, 100% 0, 100% 100%, 0% 100%);">
                    <div class="flex items-center gap-4">
                        <i class="fa-solid fa-shield-check text-4xl"></i>
                        <div>
                            <p class="text-2xl font-extrabold leading-none">Quality</p>
                            <p class="text-xs uppercase tracking-widest font-bold opacity-80">Guaranteed</p>
                        </div>
                    </div>
                </div>

                <div class="absolute -top-10 -left-10 w-32 h-32 bg-[#c95c0e]/10 rounded-full blur-3xl"></div>
                <div class="absolute top-1/2 right-0 w-64 h-64 bg-emerald-500/5 rounded-full blur-[100px]"></div>
            </div>

        </div>
    </div>
</section> -->

<section class="py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 md:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            <!-- Content Side -->
            <div class="space-y-8">
                <div class="reveal-up">
                    <span class="text-[#c95c0e] font-bold tracking-[0.2em] uppercase text-sm border-l-4 border-[#c95c0e] pl-4">Certified Expertise</span>
                    <h2 class="text-4xl md:text-5xl font-extrabold text-[#0a2d4d] mt-4 leading-tight">
                        Professional Integrity & <span class="text-emerald-600">Verified Quality</span>
                    </h2>
                </div>

                <div class="space-y-6 text-gray-600 text-lg leading-relaxed font-rale">
                    <p class="reveal-up">
                        From concept to completion, we bring cutting-edge engineering, smart design strategies, and sustainable practices together to deliver results that exceed expectations.
                    </p>
                    <p class="reveal-up">
                        Whether you're developing a new project, solving complex structural challenges, or optimizing costs without compromising quality, SDC2 is your trusted partner.
                    </p>
                </div>

                <div class="flex items-center gap-6 pt-4 reveal-up">
                    <div class="flex -space-x-3">
                        <div class="w-12 h-12 rounded-full border-4 border-white bg-gray-200 overflow-hidden shadow-sm">
                            <img src="images/team/mwizerwa-ceo-founder.jpeg" alt="Lead Engineer" class="w-full h-full object-cover">
                        </div>
                        <!-- <div class="w-12 h-12 rounded-full border-4 border-white bg-gray-300 overflow-hidden shadow-sm">
                            <img src="images/team/mwizerwa-ceo-founder.jpeg" alt="Structural Consultant" class="w-full h-full object-cover">
                        </div> -->
                        
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 uppercase tracking-widest font-bold">Licensed Professionals</p>
                        <p class="text-[#0a2d4d] font-bold">IESR Reg: No. 000/CE/IER/2026</p>
                    </div>
                </div>
            </div>

            <!-- Visual Side -->
            <div class="relative">
                <div class="relative z-10 rounded-3xl overflow-hidden shadow-2xl border-8 border-gray-100">
                    <img src="images/projects/sdc2-8.jpeg" alt="Certified Engineering" class="w-full h-[450px] object-cover">
                </div>
                
                <!-- Polygon Badge -->
                <div class="absolute -bottom-6 -left-6 bg-[#0a2d4d] p-10 pr-16 shadow-2xl text-white hidden md:block z-40" 
                     style="clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%);">
                    <p class="text-3xl font-extrabold mb-1">IER Certified</p>
                    <p class="text-emerald-400 font-bold text-xs uppercase tracking-widest">
                        Official Registration: #IER/0000/2026
                    </p>
                </div>

                <!-- Background Element -->
                <div class="absolute -top-10 -right-10 w-48 h-48 bg-emerald-500/10 rounded-full blur-3xl"></div>
            </div>

        </div>
    </div>
</section>

<?php include 'footer.php'; ?>