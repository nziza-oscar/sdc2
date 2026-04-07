<?php
$page_title = 'Projects';
include 'header.php';
displayBanner($page_title);
?>

<section class="relative py-20 bg-gradient-to-br from-primary-light/30 to-secondary-light/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl md:text-6xl mb-6 font-poppi">Our <span class="text-primary">Gallery</span></h1>
        <p class="text-xl text-neutral-700 max-w-3xl mx-auto font-rale">
            Explore our portfolio of completed works across Rwanda.
        </p>
    </div>
</section>

<section class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 " id="gallery-grid">
            <?php
            // Generate gallery items from sdc2-1.jpeg to sdc2-20.jpeg
            for ($i = 1; $i <= 20; $i++):
                $imagePath = "images/projects/sdc2-{$i}.jpeg";
                // Check if file exists, if not use placeholder
                if (!file_exists($imagePath)) {
                    continue;
                }
            ?>
            <div class="gallery-item cursor-pointer overflow-hidden shadow-md  transition-all duration-300 group">
                <div class="aspect-square overflow-hidden">
                    <img src="<?php echo $imagePath; ?>" alt="SDC2 Project <?php echo $i; ?>"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox-modal" class="fixed inset-0 bg-black/95 z-50 hidden items-center justify-center opacity-0 transition-opacity duration-300">
    <div class="relative w-full h-full flex items-center justify-center">
        <!-- Close button -->
        <button id="close-modal" class="absolute top-5 right-5 text-white text-4xl hover:text-primary transition-colors z-20">
            <i class="fa-solid fa-times"></i>
        </button>
        
        <!-- Prev button -->
        <button id="prev-slide" class="absolute left-5 md:left-10 text-white text-3xl md:text-5xl hover:text-primary transition-colors z-20 bg-black/50 w-12 h-12 md:w-16 md:h-16 rounded-full flex items-center justify-center backdrop-blur-sm">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        
        <!-- Next button -->
        <button id="next-slide" class="absolute right-5 md:right-10 text-white text-3xl md:text-5xl hover:text-primary transition-colors z-20 bg-black/50 w-12 h-12 md:w-16 md:h-16 rounded-full flex items-center justify-center backdrop-blur-sm">
            <i class="fa-solid fa-chevron-right"></i>
        </button>
        
        <!-- Image container -->
        <div class="relative max-w-7xl max-h-full p-4 md:p-8">
            <img id="modal-image" src="" alt="Gallery Image" class="max-h-[90vh] w-auto object-contain mx-auto rounded-lg shadow-2xl">
            
            <!-- Counter -->
            <div id="image-counter" class="absolute bottom-5 left-1/2 transform -translate-x-1/2 text-white text-sm font-poppi bg-black/50 px-4 py-2 rounded-full backdrop-blur-sm">
                1 / 20
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all gallery images
    const galleryItems = document.querySelectorAll('.gallery-item');
    const images = [];
    
    // Collect all image paths
    galleryItems.forEach(item => {
        const img = item.querySelector('img');
        if (img) {
            images.push(img.src);
        }
    });
    
    let currentIndex = 0;
    const modal = document.getElementById('lightbox-modal');
    const modalImage = document.getElementById('modal-image');
    const closeModal = document.getElementById('close-modal');
    const prevSlide = document.getElementById('prev-slide');
    const nextSlide = document.getElementById('next-slide');
    const imageCounter = document.getElementById('image-counter');
    
    // Open modal function
    function openModal(index) {
        currentIndex = index;
        modalImage.src = images[currentIndex];
        updateCounter();
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.add('opacity-100');
        }, 10);
        document.body.style.overflow = 'hidden';
    }
    
    // Close modal function
    function closeModalFunc() {
        modal.classList.remove('opacity-100');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
        document.body.style.overflow = '';
    }
    
    // Next slide function
    function nextSlideFunc() {
        currentIndex = (currentIndex + 1) % images.length;
        modalImage.src = images[currentIndex];
        updateCounter();
    }
    
    // Prev slide function
    function prevSlideFunc() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        modalImage.src = images[currentIndex];
        updateCounter();
    }
    
    // Update counter display
    function updateCounter() {
        imageCounter.textContent = `${currentIndex + 1} / ${images.length}`;
    }
    
    // Add click event to each gallery item
    galleryItems.forEach((item, index) => {
        item.addEventListener('click', () => {
            openModal(index);
        });
    });
    
    // Modal controls
    closeModal.addEventListener('click', closeModalFunc);
    nextSlide.addEventListener('click', nextSlideFunc);
    prevSlide.addEventListener('click', prevSlideFunc);
    
    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (!modal.classList.contains('hidden')) {
            if (e.key === 'Escape') {
                closeModalFunc();
            } else if (e.key === 'ArrowRight') {
                nextSlideFunc();
            } else if (e.key === 'ArrowLeft') {
                prevSlideFunc();
            }
        }
    });
    
    // Close modal when clicking on background
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModalFunc();
        }
    });
});
</script>

<style>
/* Additional gallery styling */
.gallery-item {
    position: relative;
    overflow: hidden;
}

.gallery-item::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, transparent 60%, rgba(0,0,0,0.3) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
}

.gallery-item:hover::after {
    opacity: 1;
}
</style>

<?php include 'footer.php'; ?>