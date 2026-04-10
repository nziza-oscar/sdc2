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


                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 reveal-up">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-leaf text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#0a2d4d]">Sustainability First</h4>
                            <p class="text-sm text-gray-500">Eco-friendly materials and energy-efficient designs.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-microchip text-[#c95c0e] text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#0a2d4d]">Modern Tech</h4>
                            <p class="text-sm text-gray-500">Utilizing the latest BIM and structural software.</p>
                        </div>
                    </div>
                </div>

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



<?php include 'footer.php'; ?>