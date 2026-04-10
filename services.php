<?php
$page_title = 'Services';
include 'header.php';
?>

<section class="relative py-16 flex items-center bg-[#0a2d4d] text-white overflow-hidden">
    <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
    <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-400/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-[#c95c0e]/10 rounded-full -ml-32 -mb-32 blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
        <h1 class="text-3xl md:text-5xl font-extrabold leading-tight mb-3 text-emerald-400 uppercase tracking-tight">
            Our Services
        </h1>
        <div class="w-20 h-1 bg-[#c95c0e] mx-auto mb-6"></div>
        <p class="text-base md:text-lg text-white/80 max-w-3xl mx-auto leading-relaxed font-rale">
            Comprehensive architectural and construction solutions designed to transform your vision into reality with precision, innovation, and excellence.
        </p>
    </div>
</section>

<section class="section-padding py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-20">
            <div id="architectural" class="grid lg:grid-cols-2 gap-12 items-center scroll-mt-24">
                <div>
                    <div class="w-20 h-20 bg-primary-light rounded-2xl flex items-center justify-center mb-6">
                        <i class="fa-solid fa-ruler text-4xl text-primary"></i>
                    </div>
                    <h2 class="text-3xl mb-4 font-poppi">Architectural Design</h2>
                    <p class="text-lg text-neutral-700 mb-6 font-rale">
                        Our architectural design service brings your vision to life with innovative, sustainable, and functional solutions.
                    </p>
                    <ul class="space-y-4 font-rale">
                        <li class="flex items-start gap-3">
                            <i class="fa-regular fa-circle-check text-primary text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-neutral-800">Conceptualization and design development</span>
                                <p class="text-neutral-600">Transform your ideas into initial concepts and develop them into detailed designs.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-regular fa-circle-check text-primary text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-neutral-800">Interior design and space planning</span>
                                <p class="text-neutral-600">Optimize your space with thoughtful interior layouts and design.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-regular fa-circle-check text-primary text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-neutral-800">3D modeling and visualization</span>
                                <p class="text-neutral-600">See your project before it's built with photorealistic 3D renderings.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-regular fa-circle-check text-primary text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-neutral-800">Sustainable design solutions</span>
                                <p class="text-neutral-600">Eco-friendly approaches that reduce environmental impact.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-regular fa-circle-check text-primary text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-neutral-800">Construction documentation</span>
                                <p class="text-neutral-600">Detailed drawings and specifications for construction.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="relative">
                    <div class="bg-primary-light rounded-[48px] p-8">
                        <img src="images/house.png" alt="Architectural Design" class="rounded-3xl w-full">
                    </div>
                </div>
            </div>

            <div id="construction" class="grid lg:grid-cols-2 gap-12 items-center scroll-mt-24">
                <div class="order-2 lg:order-1">
                    <div class="bg-secondary-light rounded-[48px] p-8">
                        <img src="images/under_contruction.png" alt="Construction Management" class="rounded-3xl w-full">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="w-20 h-20 bg-secondary-light rounded-2xl flex items-center justify-center mb-6">
                        <i class="fa-regular fa-building text-4xl text-secondary"></i>
                    </div>
                    <h2 class="text-3xl mb-4 font-poppi">Construction Management</h2>
                    <p class="text-lg text-neutral-700 mb-6 font-rale">
                        Comprehensive project oversight ensuring quality, timeliness, and budget adherence from start to finish.
                    </p>
                    <ul class="space-y-4 font-rale">
                        <li class="flex items-start gap-3">
                            <i class="fa-regular fa-circle-check text-secondary text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-neutral-800">General contracting</span>
                                <p class="text-neutral-600">Complete construction services with single-point accountability.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-regular fa-circle-check text-secondary text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-neutral-800">Construction planning and scheduling</span>
                                <p class="text-neutral-600">Detailed project timelines and resource allocation.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-regular fa-circle-check text-secondary text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-neutral-800">Cost estimation and budgeting</span>
                                <p class="text-neutral-600">Accurate cost projections and budget management.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-regular fa-circle-check text-secondary text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-neutral-800">Quality control and assurance</span>
                                <p class="text-neutral-600">Rigorous quality checks at every stage.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-regular fa-circle-check text-secondary text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-neutral-800">Project coordination and supervision</span>
                                <p class="text-neutral-600">On-site management and team coordination.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div id="project" class="grid lg:grid-cols-2 gap-12 items-center scroll-mt-24">
                <div>
                    <div class="w-20 h-20 bg-emerald-100 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fa-solid fa-chart-line text-4xl text-emerald-600"></i>
                    </div>
                    <h2 class="text-3xl mb-4 font-poppi">Project Advisory, Cost & Performance Control</h2>
                    <p class="text-lg text-neutral-700 mb-6 font-rale">
                        Strategic financial and operational oversight to ensure projects remain viable, profitable, and on schedule.
                    </p>
                    <ul class="space-y-4 font-rale">
                        <li class="flex items-start gap-3">
                            <i class="fa-regular fa-circle-check text-emerald-600 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-neutral-800">Project planning and scheduling</span>
                                <p class="text-neutral-600">Master scheduling and critical path analysis for efficient delivery.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-regular fa-circle-check text-emerald-600 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-neutral-800">Cost control and budget monitoring</span>
                                <p class="text-neutral-600">Continuous tracking of project expenditures against initial budgets.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-regular fa-circle-check text-emerald-600 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-neutral-800">Contract administration and claims management</span>
                                <p class="text-neutral-600">Professional oversight of legal agreements and dispute resolution.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-regular fa-circle-check text-emerald-600 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-neutral-800">Project audit and technical review</span>
                                <p class="text-neutral-600">Independent assessments to ensure compliance and technical integrity.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-regular fa-circle-check text-emerald-600 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-neutral-800">Earned Value Management (EVM)</span>
                                <p class="text-neutral-600">Tracking cost and schedule performance through integrated data analysis.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-regular fa-circle-check text-emerald-600 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-neutral-800">Value engineering and cost optimization</span>
                                <p class="text-neutral-600">Maximizing functionality while minimizing unnecessary expenses.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-regular fa-circle-check text-emerald-600 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-neutral-800">Procurement and tender process support</span>
                                <p class="text-neutral-600">Expert guidance through vendor selection and contract bidding.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-regular fa-circle-check text-emerald-600 text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-neutral-800">Risk assessment and compliance monitoring</span>
                                <p class="text-neutral-600">Proactive identification of project risks and regulatory adherence.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="relative">
                    <div class="bg-emerald-50 rounded-[48px] p-8 border border-emerald-100">
                        <div class="bg-[#0a2d4d] rounded-3xl p-10 text-white min-h-[400px] flex flex-col justify-center">
                            <i class="fa-solid fa-file-invoice-dollar text-6xl text-emerald-400 mb-6"></i>
                            <h3 class="text-2xl font-bold mb-4 font-poppi">Performance Optimization</h3>
                            <p class="text-white/80 font-rale leading-relaxed">
                                We utilize industry-leading Earned Value Management and Value Engineering techniques to ensure every dollar invested delivers maximum value.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="renovation" class="grid lg:grid-cols-2 gap-12 items-center scroll-mt-24">
                <div class="order-2 lg:order-1">
                    <div class="bg-primary-light rounded-[48px] p-8">
                        <img src="images/hospital.png" alt="Renovation Services" class="rounded-3xl w-full">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="w-20 h-20 bg-primary-light rounded-2xl flex items-center justify-center mb-6">
                        <i class="fa-solid fa-wrench text-4xl text-primary"></i>
                    </div>
                    <h2 class="text-3xl mb-4 font-poppi">Renovation & Retrofitting</h2>
                    <p class="text-lg text-neutral-700 mb-6 font-rale">
                        Transform existing spaces with modern upgrades while improving energy efficiency and functionality.
                    </p>
                    <ul class="space-y-4 font-rale">
                        <li class="flex items-start gap-3">
                            <i class="fa-regular fa-circle-check text-primary text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-neutral-800">Residential and commercial renovations</span>
                                <p class="text-neutral-600">Complete interior and exterior renovations.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-regular fa-circle-check text-primary text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-neutral-800">Structural modifications</span>
                                <p class="text-neutral-600">Safe and compliant structural changes.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-regular fa-circle-check text-primary text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-neutral-800">Interior upgrades and finishes</span>
                                <p class="text-neutral-600">Modern finishes and interior improvements.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-regular fa-circle-check text-primary text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-neutral-800">Adaptive reuse and restoration</span>
                                <p class="text-neutral-600">Repurpose existing buildings for new uses.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-regular fa-circle-check text-primary text-xl mt-1"></i>
                            <div>
                                <span class="font-semibold text-neutral-800">Energy-efficient retrofitting</span>
                                <p class="text-neutral-600">Upgrade systems for better energy performance.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="process" class="section-padding banner-bg scroll-mt-24 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white/40 backdrop-blur-md border border-white/20 rounded-[40px] p-8 md:p-16 shadow-xl">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-primary font-semibold tracking-wider uppercase text-sm mb-4 block font-poppi">Our Process</span>
                <h2 class="section-title font-poppi">How we bring your project to life</h2>
            </div>

            <div class="grid md:grid-cols-4 gap-12 md:gap-6">
                <div class="text-center relative">
                    <div class="w-16 h-16 bg-primary text-white rounded-full flex items-center justify-center text-2xl font-semibold mx-auto mb-4 font-poppi shadow-lg shadow-primary/20">1</div>
                    <h3 class="font-semibold text-lg mb-2 font-poppi">Consultation</h3>
                    <p class="text-slate-800 font-rale font-semibold">We discuss your vision, needs, and budget.</p>
                    <div class="hidden md:block absolute top-8 left-[65%] w-[70%] h-0.5 bg-primary/20"></div>
                </div>
                
                <div class="text-center relative">
                    <div class="w-16 h-16 bg-primary text-white rounded-full flex items-center justify-center text-2xl font-semibold mx-auto mb-4 font-poppi shadow-lg shadow-primary/20">2</div>
                    <h3 class="font-semibold text-lg mb-2 font-poppi">Design</h3>
                    <p class="text-slate-800 font-rale font-semibold">Creating detailed plans and 3D visualizations.</p>
                    <div class="hidden md:block absolute top-8 left-[65%] w-[70%] h-0.5 bg-primary/20"></div>
                </div>
                
                <div class="text-center relative">
                    <div class="w-16 h-16 bg-primary text-white rounded-full flex items-center justify-center text-2xl font-semibold mx-auto mb-4 font-poppi shadow-lg shadow-primary/20">3</div>
                    <h3 class="font-semibold text-lg mb-2 font-poppi">Planning</h3>
                    <p class="text-slate-800 font-rale font-semibold">Budgeting, scheduling, and permits.</p>
                    <div class="hidden md:block absolute top-8 left-[65%] w-[70%] h-0.5 bg-primary/20"></div>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary text-white rounded-full flex items-center justify-center text-2xl font-semibold mx-auto mb-4 font-poppi shadow-lg shadow-primary/20">4</div>
                    <h3 class="font-semibold text-lg mb-2 font-poppi">Construction</h3>
                    <p class="text-slate-800 font-rale font-semibold">Building with quality and precision.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>