<section class="py-6 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="relative max-w-3xl mx-auto rounded-xl overflow-hidden shadow-lg">
            <div class="swiper projectSwiper">
                <div class="swiper-wrapper">
                    
                    <?php
                    $projectImages = [];
                    for ($i = 1; $i <= 24; $i++) {
                        $imagePath = "projects/{$i}.jpeg";
                        if (file_exists($imagePath)) {
                            $projectImages[] = $imagePath;
                        } else {
                            $imagePathJpg = "projects/{$i}.jpg";
                            if (file_exists($imagePathJpg)) {
                                $projectImages[] = $imagePathJpg;
                            }
                        }
                    }
                    
                    if (empty($projectImages)) {
                        $projectImages = ['https://placehold.co/800x300/0a2d4d/ffffff?text=No+Projects+Found'];
                    }
                    
                    foreach ($projectImages as $index => $image): ?>
                        <div class="swiper-slide">
                            <div class="relative h-[200px] md:h-[300px] w-full overflow-hidden">
                                <img src="<?php echo $image; ?>" 
                                     alt="Project <?php echo $index + 1; ?>" 
                                     class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                </div>
                
                <div class="swiper-button-next !w-8 !h-8 !bg-white/20 backdrop-blur-sm rounded-full !text-white hover:!bg-[#c95c0e] transition-all duration-300 after:!text-[12px]"><i class="fa-solid fa-angle-right"></i></div>
                <div class="swiper-button-prev !w-8 !h-8 !bg-white/20 backdrop-blur-sm rounded-full !text-white hover:!bg-[#c95c0e] transition-all duration-300 after:!text-[12px]"><i class="fa-solid fa-angle-left"></i></div>
                
                <div class="swiper-pagination !bottom-2"></div>
            </div>
        </div>

        
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const projectSwiper = new Swiper('.projectSwiper', {
            loop: true,
            effect: 'flip',
            grabCursor: true,
            flipEffect: {
                slideShadows: true,
                limitRotation: true,
            },
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            speed: 1000,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true,
            },
            on: {
                slideChange: function() {
                    const counter = document.getElementById('currentSlide');
                    if (counter) {
                        counter.textContent = this.realIndex + 1;
                    }
                }
            }
        });
    });
</script>