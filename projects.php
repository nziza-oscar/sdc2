<?php
$page_title = 'Projects';
include 'header.php';
?>

<section class="relative py-10 flex items-center bg-[#0a2d4d] text-white pt-20 overflow-hidden">
    <div class="absolute inset-0 opacity-20 pointer-events-none" 
    style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
        <h1 class="text-5xl md:text-7xl font-extrabold leading-tight mb-6">
            Our <span class="text-emerald-400">Projects</span>
        </h1>
        <p class="text-sm text-white/70 max-w-2xl mx-auto leading-relaxed">
            A visual showcase of our structural integrity and architectural precision across Rwanda.
        </p>
    </div>
</section>

<?php include 'project-slides.php'; ?>
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4" id="gallery-grid">
            <?php
            for ($i = 1; $i <= 20; $i++):
                $imagePath = "images/projects/sdc2-{$i}.jpeg";
                if (!file_exists($imagePath)) {
                    continue;
                }
            ?>
            <div class="gallery-item cursor-pointer overflow-hidden group relative aspect-square bg-slate-100">
                <img src="<?php echo $imagePath; ?>" 
                     alt="SDC2 Project <?php echo $i; ?>"
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                
                <div class="absolute inset-0 bg-[#0a2d4d]/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <div class="translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        <span class="text-white font-bold tracking-widest uppercase text-xs border border-white/30 px-4 py-2">View Project</span>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<div id="lightbox-modal" class="fixed inset-0 bg-[#0a2d4d] z-[200] hidden items-center justify-center opacity-0 transition-opacity duration-300">
    <div class="relative w-full h-full flex flex-col items-center justify-center p-4">
        
        <button id="close-modal" class="absolute top-8 right-8 text-white/50 hover:text-white text-3xl transition-colors z-[210]">
            <i class="fa-solid fa-xmark"></i>
        </button>
        
        <button id="prev-slide" class="absolute left-4 md:left-8 text-white/50 hover:text-emerald-400 text-4xl transition-colors z-[210] p-4">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        
        <button id="next-slide" class="absolute right-4 md:right-8 text-white/50 hover:text-emerald-400 text-4xl transition-colors z-[210] p-4">
            <i class="fa-solid fa-chevron-right"></i>
        </button>
        
        <div class="relative max-w-5xl w-full flex flex-col items-center">
            <img id="modal-image" src="" alt="Gallery Image" class="max-h-[75vh] w-auto object-contain shadow-2xl border border-white/10">
            
            <div id="image-counter" class="mt-8 text-white/40 font-mono text-sm tracking-[0.3em] uppercase">
                01 / 20
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const galleryItems = document.querySelectorAll('.gallery-item');
    const images = [];
    
    galleryItems.forEach(item => {
        const img = item.querySelector('img');
        if (img) images.push(img.src);
    });
    
    let currentIndex = 0;
    const modal = document.getElementById('lightbox-modal');
    const modalImage = document.getElementById('modal-image');
    const closeModal = document.getElementById('close-modal');
    const prevSlide = document.getElementById('prev-slide');
    const nextSlide = document.getElementById('next-slide');
    const imageCounter = document.getElementById('image-counter');
    
    function openModal(index) {
        currentIndex = index;
        updateModalContent();
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modal.classList.add('opacity-100');
        }, 10);
        document.body.style.overflow = 'hidden';
    }
    
    function closeModalFunc() {
        modal.classList.remove('opacity-100');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
        document.body.style.overflow = '';
    }
    
    function nextSlideFunc() {
        currentIndex = (currentIndex + 1) % images.length;
        updateModalContent();
    }
    
    function prevSlideFunc() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateModalContent();
    }
    
    function updateModalContent() {
        modalImage.style.opacity = '0';
        setTimeout(() => {
            modalImage.src = images[currentIndex];
            modalImage.style.opacity = '1';
            imageCounter.textContent = `${(currentIndex + 1).toString().padStart(2, '0')} / ${images.length.toString().padStart(2, '0')}`;
        }, 150);
    }
    
    galleryItems.forEach((item, index) => {
        item.addEventListener('click', () => openModal(index));
    });
    
    closeModal.addEventListener('click', closeModalFunc);
    nextSlide.addEventListener('click', nextSlideFunc);
    prevSlide.addEventListener('click', prevSlideFunc);
    
    document.addEventListener('keydown', (e) => {
        if (!modal.classList.contains('hidden')) {
            if (e.key === 'Escape') closeModalFunc();
            if (e.key === 'ArrowRight') nextSlideFunc();
            if (e.key === 'ArrowLeft') prevSlideFunc();
        }
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal || e.target.id === 'lightbox-modal') {
            closeModalFunc();
        }
    });
});
</script>



<?php include 'footer.php'; ?>