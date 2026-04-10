/**
 * Sustainable Design and Construction Consultancy (SDC2)
 * Main Application Script
 */

// 1. Register GSAP Plugins
gsap.registerPlugin(ScrollTrigger);

// 2. DOM Content Loaded Wrapper
window.addEventListener('DOMContentLoaded', () => {
    
    // --- Mobile Menu Interaction ---
    const openBtn = document.getElementById('menu-open');
    const closeBtn = document.getElementById('menu-close');
    const overlay = document.getElementById('mobile-overlay');

    if (openBtn && closeBtn && overlay) {
        openBtn.addEventListener('click', () => {
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        closeBtn.addEventListener('click', () => {
            overlay.classList.remove('active');
            document.body.style.overflow = 'auto';
        });

        // Close menu on link click
        overlay.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                overlay.classList.remove('active');
                document.body.style.overflow = 'auto';
            });
        });
    }

    // --- Hero Section Timeline ---
    const heroTl = gsap.timeline({ 
        defaults: { ease: "power4.out", duration: 1.2 } 
    });

    // Animate Header
    heroTl.from("header", {
        y: -120,
        opacity: 0,
    });

    // Animate Hero Content (Specific to Hero only)
    heroTl.to("section.hero-gradient .reveal-up", {
        opacity: 1,
        y: 0,
        stagger: 0.15,
    }, "-=0.6");

    // Animate Hexagon (Visible on MD+)
    const heroImg = document.getElementById('hero-img-box');
    if (heroImg && window.innerWidth >= 768) {
        heroTl.from(heroImg, {
            scale: 0.8,
            opacity: 0,
            x: 80,
            rotate: 8,
            duration: 1.5,
        }, "-=1.2");
    }

    // --- Global Scroll Reveal (About, Services, etc.) ---
    // This finds all elements with .reveal-up that weren't part of the hero timeline
    gsap.utils.toArray('.reveal-up').forEach((elem) => {
        // Prevent double animation if the element was already handled by the hero timeline
        if (gsap.getProperty(elem, "opacity") > 0) return;

        gsap.fromTo(elem, 
            { y: 50, opacity: 0 },
            { 
                scrollTrigger: {
                    trigger: elem,
                    start: "top 85%",
                    toggleActions: "play none none none"
                },
                y: 0, 
                opacity: 1, 
                duration: 1,
                ease: "power3.out"
            }
        );
    });
});