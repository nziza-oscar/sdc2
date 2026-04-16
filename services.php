<?php
$page_title = 'Services';
include 'header.php';
?>

<!-- Hero Section - Redesigned -->
<section class="relative py-20 flex items-center bg-gradient-to-br from-[#0a2d4d] via-[#0e3a5f] to-[#0a2d4d] text-white overflow-hidden">
    <!-- Decorative elements -->
    <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-emerald-400/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-[#c95c0e]/10 rounded-full blur-3xl"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-white/5 rounded-full blur-2xl"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 mb-6">
            <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
            <span class="text-sm font-medium tracking-wide">Excellence in Every Project</span>
        </div>
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold leading-tight mb-4">
            Our <span class="text-emerald-400">Services</span>
        </h1>
        <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-[#c95c0e] mx-auto mb-8 rounded-full"></div>
        <p class="text-lg md:text-xl text-white/80 max-w-3xl mx-auto leading-relaxed">
            Comprehensive design and construction solutions crafted to transform your vision into reality with precision, innovation, and excellence.
        </p>
    </div>
</section>

<!-- Services Section - Redesigned Layout -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-28">
            
            <!-- Architectural Design -->
            <div id="architectural" class="grid lg:grid-cols-2 gap-16 items-center scroll-mt-24">
                <div class="order-2 lg:order-1">
                    <div class="w-20 h-20 bg-[#0a2d4d]/10 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fa-solid fa-ruler text-4xl text-[#0a2d4d]"></i>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">Architectural Design</h2>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Our architectural design service brings your vision to life with innovative, sustainable, and functional solutions.
                    </p>
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-emerald-500 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Conceptualization and design development</span>
                                <p class="text-gray-500 text-sm">Transform your ideas into initial concepts and develop them into detailed designs.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-emerald-500 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Interior design and space planning</span>
                                <p class="text-gray-500 text-sm">Optimize your space with thoughtful interior layouts and design.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-emerald-500 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">3D modeling and visualization</span>
                                <p class="text-gray-500 text-sm">See your project before it's built with photorealistic 3D renderings.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-emerald-500 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Sustainable design solutions</span>
                                <p class="text-gray-500 text-sm">Eco-friendly approaches that reduce environmental impact.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors sm:col-span-2">
                            <i class="fa-regular fa-circle-check text-emerald-500 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Construction documentation</span>
                                <p class="text-gray-500 text-sm">Detailed drawings and specifications for construction.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="relative group">
                        <div class="absolute -inset-2 bg-gradient-to-r from-[#0a2d4d] to-emerald-600 rounded-3xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                        <div class="relative bg-white rounded-3xl overflow-hidden shadow-2xl transform group-hover:scale-[1.02] transition-all duration-500">
                            <div class="bg-gradient-to-br from-[#0a2d4d] to-[#143d62] p-12 text-center">
                                <i class="fa-solid fa-compass-drafting text-7xl text-emerald-400 mb-4"></i>
                                <h3 class="text-emerald-400 text-xl font-bold uppercase tracking-wider">Architectural Vision</h3>
                                <p class="text-white/50 text-sm mt-2">Precision & Innovation</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Construction Management -->
            <div id="construction" class="grid lg:grid-cols-2 gap-16 items-center scroll-mt-24">
                <div class="order-2 lg:order-1">
                    <div class="relative group">
                        <div class="absolute -inset-2 bg-gradient-to-r from-[#c95c0e] to-orange-600 rounded-3xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                        <div class="relative bg-white rounded-3xl overflow-hidden shadow-2xl transform group-hover:scale-[1.02] transition-all duration-500">
                            <div class="bg-gradient-to-br from-[#c95c0e] to-[#e07018] p-12 text-center">
                                <i class="fa-solid fa-helmet-safety text-7xl text-white/30 mb-4"></i>
                                <h3 class="text-white text-xl font-bold uppercase tracking-wider">Built to Last</h3>
                                <p class="text-white/40 text-sm mt-2">Quality Assured</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="w-20 h-20 bg-[#c95c0e]/10 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fa-regular fa-building text-4xl text-[#c95c0e]"></i>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">Construction Management</h2>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Comprehensive project oversight ensuring quality, timeliness, and budget adherence from start to finish.
                    </p>
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-[#c95c0e] text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">General contracting</span>
                                <p class="text-gray-500 text-sm">Complete construction services with single-point accountability.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-[#c95c0e] text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Construction planning and scheduling</span>
                                <p class="text-gray-500 text-sm">Detailed project timelines and resource allocation.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-[#c95c0e] text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Cost estimation and budgeting</span>
                                <p class="text-gray-500 text-sm">Accurate cost projections and budget management.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-[#c95c0e] text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Quality control and assurance</span>
                                <p class="text-gray-500 text-sm">Rigorous quality checks at every stage.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors sm:col-span-2">
                            <i class="fa-regular fa-circle-check text-[#c95c0e] text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Project coordination and supervision</span>
                                <p class="text-gray-500 text-sm">On-site management and team coordination.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Construction Permits and All Associated Services (NEW) -->
            <div id="permits" class="grid lg:grid-cols-2 gap-16 items-center scroll-mt-24">
                <div class="order-2 lg:order-1">
                    <div class="w-20 h-20 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fa-solid fa-file-contract text-4xl text-blue-600"></i>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">Construction Permits and All Associated Services</h2>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Comprehensive permit and compliance solutions to navigate regulatory requirements seamlessly, ensuring your project moves forward without delays or complications.
                    </p>
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-blue-500 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Site and Feasibility Services</span>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-blue-500 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Approval and Compliance Services</span>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-blue-500 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Permit Processing & Liaison</span>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-blue-500 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Inspection Services</span>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-blue-500 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Utility Connection Services</span>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-blue-500 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Completion and Occupancy Certification</span>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors sm:col-span-2">
                            <i class="fa-regular fa-circle-check text-blue-500 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Post-Construction Services</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="relative group">
                        <div class="absolute -inset-2 bg-gradient-to-r from-blue-500 to-blue-600 rounded-3xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                        <div class="relative bg-white rounded-3xl overflow-hidden shadow-2xl transform group-hover:scale-[1.02] transition-all duration-500">
                            <div class="bg-gradient-to-br from-blue-600 to-blue-800 p-12 text-center">
                                <i class="fa-solid fa-clipboard-list text-7xl text-white/30 mb-4"></i>
                                <h3 class="text-white text-xl font-bold uppercase tracking-wider">Permit & Compliance</h3>
                                <p class="text-white/50 text-sm mt-2">Seamless Approvals</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Project Advisory, Cost & Performance Control -->
            <div id="project" class="grid lg:grid-cols-2 gap-16 items-center scroll-mt-24">
                <div class="order-2 lg:order-1">
                    <div class="w-20 h-20 bg-emerald-100 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fa-solid fa-chart-line text-4xl text-emerald-600"></i>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">Project Advisory, Cost & Performance Control</h2>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Strategic financial and operational oversight to ensure projects remain viable, profitable, and on schedule.
                    </p>
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-emerald-600 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Project planning and scheduling</span>
                                <p class="text-gray-500 text-sm">Master scheduling and critical path analysis for efficient delivery.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-emerald-600 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Cost control and budget monitoring</span>
                                <p class="text-gray-500 text-sm">Continuous tracking of project expenditures against initial budgets.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-emerald-600 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Contract administration and claims management</span>
                                <p class="text-gray-500 text-sm">Professional oversight of legal agreements and dispute resolution.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-emerald-600 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Project audit and technical review</span>
                                <p class="text-gray-500 text-sm">Independent assessments to ensure compliance and technical integrity.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-emerald-600 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Earned Value Management (EVM)</span>
                                <p class="text-gray-500 text-sm">Tracking cost and schedule performance through integrated data analysis.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-emerald-600 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Value engineering and cost optimization</span>
                                <p class="text-gray-500 text-sm">Maximizing functionality while minimizing unnecessary expenses.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-emerald-600 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Procurement and tender process support</span>
                                <p class="text-gray-500 text-sm">Expert guidance through vendor selection and contract bidding.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-emerald-600 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Risk assessment and compliance monitoring</span>
                                <p class="text-gray-500 text-sm">Proactive identification of project risks and regulatory adherence.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="relative group">
                        <div class="absolute -inset-2 bg-gradient-to-r from-emerald-400 to-emerald-600 rounded-3xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                        <div class="relative bg-white rounded-3xl overflow-hidden shadow-2xl transform group-hover:scale-[1.02] transition-all duration-500">
                            <div class="bg-gradient-to-br from-[#0a2d4d] to-[#143d62] p-12 text-center">
                                <i class="fa-solid fa-magnifying-glass-chart text-7xl text-emerald-400 mb-4"></i>
                                <h3 class="text-emerald-400 text-xl font-bold uppercase tracking-wider">Performance Optimization</h3>
                                <p class="text-white/50 text-sm mt-2">Data-Driven Decisions</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Renovation & Retrofitting -->
            <div id="renovation" class="grid lg:grid-cols-2 gap-16 items-center scroll-mt-24">
                <div class="order-2 lg:order-1">
                    <div class="relative group">
                        <div class="absolute -inset-2 bg-gradient-to-r from-[#0a2d4d] to-emerald-600 rounded-3xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                        <div class="relative bg-white rounded-3xl overflow-hidden shadow-2xl transform group-hover:scale-[1.02] transition-all duration-500">
                            <div class="bg-gradient-to-br from-[#0a2d4d] to-[#143d62] p-12 text-center">
                                <i class="fa-solid fa-screwdriver-wrench text-7xl text-white/20 mb-4"></i>
                                <h3 class="text-white text-xl font-bold uppercase tracking-wider">Renovation Specialists</h3>
                                <p class="text-white/40 text-sm mt-2">Transform & Modernize</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="w-20 h-20 bg-[#0a2d4d]/10 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fa-solid fa-wrench text-4xl text-[#0a2d4d]"></i>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">Renovation & Retrofitting</h2>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Transform existing spaces with modern upgrades while improving energy efficiency and functionality.
                    </p>
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-emerald-600 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Residential and commercial renovations</span>
                                <p class="text-gray-500 text-sm">Complete interior and exterior renovations.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-emerald-600 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Structural modifications</span>
                                <p class="text-gray-500 text-sm">Safe and compliant structural changes.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-emerald-600 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Interior upgrades and finishes</span>
                                <p class="text-gray-500 text-sm">Modern finishes and interior improvements.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors">
                            <i class="fa-regular fa-circle-check text-emerald-600 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Adaptive reuse and restoration</span>
                                <p class="text-gray-500 text-sm">Repurpose existing buildings for new uses.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-white transition-colors sm:col-span-2">
                            <i class="fa-regular fa-circle-check text-emerald-600 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-gray-800 block">Energy-efficient retrofitting</span>
                                <p class="text-gray-500 text-sm">Upgrade systems for better energy performance.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Process Section - Redesigned -->
<section id="process" class="py-20 bg-gradient-to-br from-[#0a2d4d] via-[#0e3a5f] to-[#0a2d4d] relative overflow-hidden">
    <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-[48px] p-10 md:p-16 shadow-2xl">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm rounded-full px-4 py-1.5 mb-6">
                    <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                    <span class="text-emerald-400 text-sm font-medium tracking-wide uppercase">Our Process</span>
                </div>
                <h2 class="text-3xl md:text-5xl font-bold text-white mb-4">How we bring your project to life</h2>
            </div>

            <div class="grid md:grid-cols-4 gap-10 md:gap-6">
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-br from-emerald-400 to-emerald-600 text-white rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-5 shadow-xl shadow-emerald-500/30 group-hover:scale-110 transition-all duration-300">1</div>
                    <h3 class="font-bold text-xl text-white mb-2">Consultation</h3>
                    <p class="text-white/60 leading-relaxed">We discuss your vision, needs, and budget.</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-br from-emerald-400 to-emerald-600 text-white rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-5 shadow-xl shadow-emerald-500/30 group-hover:scale-110 transition-all duration-300">2</div>
                    <h3 class="font-bold text-xl text-white mb-2">Design</h3>
                    <p class="text-white/60 leading-relaxed">Creating detailed plans and 3D visualizations.</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-br from-emerald-400 to-emerald-600 text-white rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-5 shadow-xl shadow-emerald-500/30 group-hover:scale-110 transition-all duration-300">3</div>
                    <h3 class="font-bold text-xl text-white mb-2">Planning</h3>
                    <p class="text-white/60 leading-relaxed">Budgeting, scheduling, and permits.</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 bg-gradient-to-br from-emerald-400 to-emerald-600 text-white rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-5 shadow-xl shadow-emerald-500/30 group-hover:scale-110 transition-all duration-300">4</div>
                    <h3 class="font-bold text-xl text-white mb-2">Construction</h3>
                    <p class="text-white/60 leading-relaxed">Building with quality and precision.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>