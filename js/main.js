// GSAP Animations
document.addEventListener('DOMContentLoaded', function() {
    // Register ScrollTrigger
    gsap.registerPlugin(ScrollTrigger);
    
    // Hero section animation
    gsap.from('.hero-content', {
        y: 100,
        opacity: 0,
        duration: 1,
        ease: 'power3.out'
    });
    
    // Animate sections on scroll
    gsap.utils.toArray('.section-padding').forEach(section => {
        gsap.from(section.querySelectorAll('h2, p, .card, .about-content, .stat-number'), {
            scrollTrigger: {
                trigger: section,
                start: 'top 80%',
                end: 'bottom 20%',
                toggleActions: 'play none none reverse'
            },
            y: 50,
            opacity: 0,
            duration: 0.8,
            stagger: 0.2
        });
    });
    
    // Staggered cards animation
    gsap.from('.card', {
        scrollTrigger: {
            trigger: '.card',
            start: 'top 90%'
        },
        y: 50,
        opacity: 0,
        duration: 0.6,
        stagger: 0.1
    });
    
    // Animate stat numbers
    gsap.utils.toArray('.stat-number').forEach(stat => {
        gsap.from(stat, {
            scrollTrigger: {
                trigger: stat,
                start: 'top 90%'
            },
            textContent: 0,
            duration: 2,
            snap: { textContent: 1 },
            ease: 'power1.inOut'
        });
    });
    
    // Parallax effect on hero images
    gsap.utils.toArray('.parallax-image').forEach(image => {
        gsap.to(image, {
            scrollTrigger: {
                trigger: image.parentElement,
                start: 'top bottom',
                end: 'bottom top',
                scrub: true
            },
            y: 100,
            ease: 'none'
        });
    });
    
    // Smooth hover effects for cards
    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('mouseenter', () => {
            gsap.to(card, {
                scale: 1.02,
                duration: 0.3,
                ease: 'power2.out',
                boxShadow: '0 30px 50px -20px rgba(15, 118, 110, 0.2)'
            });
        });
        
        card.addEventListener('mouseleave', () => {
            gsap.to(card, {
                scale: 1,
                duration: 0.3,
                ease: 'power2.out',
                boxShadow: '0 20px 40px -15px rgba(0,0,0,0.05)'
            });
        });
    });
    
    // Form input animations
    document.querySelectorAll('.input-field').forEach(input => {
        input.addEventListener('focus', () => {
            gsap.to(input, {
                scale: 1.02,
                duration: 0.2,
                ease: 'power2.out'
            });
        });
        
        input.addEventListener('blur', () => {
            gsap.to(input, {
                scale: 1,
                duration: 0.2,
                ease: 'power2.out'
            });
        });
    });
    
    // Counter animation for stats
    function animateCounter(element) {
        const target = parseInt(element.innerText);
        let current = 0;
        const increment = target / 50;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.innerText = target + '+';
                clearInterval(timer);
            } else {
                element.innerText = Math.floor(current) + '+';
            }
        }, 30);
    }
    
    // Trigger counter when stats come into view
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const stats = entry.target.querySelectorAll('.stat-number');
                stats.forEach(animateCounter);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    document.querySelectorAll('.stats-section').forEach(section => {
        observer.observe(section);
    });
});