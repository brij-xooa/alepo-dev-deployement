/**
 * Alepo Theme Animations
 * Scroll effects, interactions, and visual enhancements
 * 
 * @package Alepo
 * @version 1.0.0
 */

(function() {
    'use strict';

    // Initialize when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        initScrollAnimations();
        initIntersectionObserver();
        initCountUpAnimations();
        initParallaxEffects();
        initCardAnimations();
        initProgressBars();
        initTypewriterEffect();
    });

    /**
     * Scroll-triggered animations
     */
    function initScrollAnimations() {
        const animatedElements = document.querySelectorAll([
            '.hero-headline',
            '.hero-subheadline', 
            '.hero-actions',
            '.feature-item',
            '.testimonial-item',
            '.stat-item',
            '.card',
            '.cta-section',
            '.content-section'
        ].join(','));

        // Add initial animation classes
        animatedElements.forEach((element, index) => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(30px)';
            element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            element.style.transitionDelay = `${index * 0.1}s`;
        });

        // Trigger animations on scroll
        function animateOnScroll() {
            animatedElements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;

                if (elementTop < window.innerHeight - elementVisible) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                    element.classList.add('animated');
                }
            });
        }

        // Initial check
        animateOnScroll();

        // Throttled scroll listener
        let scrollTimer = null;
        window.addEventListener('scroll', function() {
            if (scrollTimer !== null) {
                clearTimeout(scrollTimer);
            }
            scrollTimer = setTimeout(animateOnScroll, 16); // ~60fps
        });
    }

    /**
     * Intersection Observer for more efficient scroll animations
     */
    function initIntersectionObserver() {
        if (!window.IntersectionObserver) return;

        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    
                    // Add staggered animation for child elements
                    const children = entry.target.querySelectorAll('.feature-item, .testimonial-item, .stat-item');
                    children.forEach((child, index) => {
                        setTimeout(() => {
                            child.classList.add('animate-in');
                        }, index * 100);
                    });
                }
            });
        }, observerOptions);

        // Observe elements
        const observeElements = document.querySelectorAll([
            '.features-container',
            '.testimonials-container',
            '.stats-container',
            '.hero',
            '.success-story'
        ].join(','));

        observeElements.forEach(element => {
            observer.observe(element);
        });
    }

    /**
     * Count-up animations for statistics
     */
    function initCountUpAnimations() {
        const statNumbers = document.querySelectorAll('.stat-number');

        statNumbers.forEach(statElement => {
            const finalValue = statElement.textContent.trim();
            const numericValue = parseFloat(finalValue.replace(/[^\d.]/g, ''));
            const suffix = finalValue.replace(/[\d.,]/g, '');

            if (isNaN(numericValue)) return;

            statElement.textContent = '0' + suffix;

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCount(statElement, 0, numericValue, suffix, 2000);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            observer.observe(statElement);
        });
    }

    /**
     * Count animation helper
     */
    function animateCount(element, start, end, suffix, duration) {
        const startTime = performance.now();
        const isDecimal = end % 1 !== 0;

        function updateCount(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);

            // Easing function (easeOutCubic)
            const easeProgress = 1 - Math.pow(1 - progress, 3);
            
            const current = start + (end - start) * easeProgress;
            const displayValue = isDecimal ? current.toFixed(1) : Math.floor(current);
            
            element.textContent = displayValue + suffix;

            if (progress < 1) {
                requestAnimationFrame(updateCount);
            } else {
                element.textContent = end + suffix;
            }
        }

        requestAnimationFrame(updateCount);
    }

    /**
     * Parallax effects for hero sections
     */
    function initParallaxEffects() {
        const parallaxElements = document.querySelectorAll('.hero-image img, .hero');

        if (parallaxElements.length === 0) return;

        function updateParallax() {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;

            parallaxElements.forEach(element => {
                if (element.tagName === 'IMG') {
                    element.style.transform = `translateY(${rate * 0.3}px)`;
                } else {
                    element.style.backgroundPosition = `center ${rate * 0.1}px`;
                }
            });
        }

        // Throttled scroll listener for parallax
        let parallaxTimer = null;
        window.addEventListener('scroll', function() {
            if (parallaxTimer !== null) {
                clearTimeout(parallaxTimer);
            }
            parallaxTimer = setTimeout(updateParallax, 16);
        });
    }

    /**
     * Enhanced card hover animations
     */
    function initCardAnimations() {
        const cards = document.querySelectorAll('.card, .feature-item, .testimonial-item, .stat-item');

        cards.forEach(card => {
            // Mouse move effect
            card.addEventListener('mousemove', function(e) {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const centerX = rect.width / 2;
                const centerY = rect.height / 2;

                const rotateX = (y - centerY) / 10;
                const rotateY = (centerX - x) / 10;

                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateZ(0)`;
            });

            // Reset on mouse leave
            card.addEventListener('mouseleave', function() {
                card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateZ(0)';
            });

            // Add ripple effect
            card.addEventListener('click', function(e) {
                createRipple(e, card);
            });
        });
    }

    /**
     * Create ripple effect
     */
    function createRipple(event, element) {
        const ripple = document.createElement('span');
        const rect = element.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = event.clientX - rect.left - size / 2;
        const y = event.clientY - rect.top - size / 2;

        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.classList.add('ripple-effect');

        // Add ripple styles
        if (!document.querySelector('#ripple-styles')) {
            const style = document.createElement('style');
            style.id = 'ripple-styles';
            style.textContent = `
                .ripple-effect {
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.3);
                    transform: scale(0);
                    animation: ripple-animation 0.6s linear;
                    pointer-events: none;
                    z-index: 1;
                }
                
                @keyframes ripple-animation {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        }

        element.style.position = 'relative';
        element.style.overflow = 'hidden';
        element.appendChild(ripple);

        setTimeout(() => {
            ripple.remove();
        }, 600);
    }

    /**
     * Animated progress bars
     */
    function initProgressBars() {
        const progressBars = document.querySelectorAll('.progress-bar');

        progressBars.forEach(bar => {
            const targetWidth = bar.getAttribute('data-width') || '0%';
            bar.style.width = '0%';

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            bar.style.transition = 'width 1.5s ease-out';
                            bar.style.width = targetWidth;
                        }, 200);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            observer.observe(bar);
        });
    }

    /**
     * Typewriter effect for headlines
     */
    function initTypewriterEffect() {
        const typewriterElements = document.querySelectorAll('.typewriter-effect');

        typewriterElements.forEach(element => {
            const text = element.textContent;
            element.textContent = '';
            element.style.borderRight = '2px solid var(--primary-blue)';
            element.style.animation = 'blink 1s infinite';

            let i = 0;
            function typeWriter() {
                if (i < text.length) {
                    element.textContent += text.charAt(i);
                    i++;
                    setTimeout(typeWriter, 50);
                } else {
                    // Remove cursor after typing is complete
                    setTimeout(() => {
                        element.style.borderRight = 'none';
                        element.style.animation = 'none';
                    }, 1000);
                }
            }

            // Start typewriter when element comes into view
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        setTimeout(typeWriter, 500);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            observer.observe(element);
        });

        // Add blinking cursor animation
        if (!document.querySelector('#typewriter-styles')) {
            const style = document.createElement('style');
            style.id = 'typewriter-styles';
            style.textContent = `
                @keyframes blink {
                    0%, 50% { border-color: var(--primary-blue); }
                    51%, 100% { border-color: transparent; }
                }
            `;
            document.head.appendChild(style);
        }
    }

    /**
     * Smooth scroll for anchor links
     */
    function initSmoothScroll() {
        const anchorLinks = document.querySelectorAll('a[href^="#"]');

        anchorLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#') return;

                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    
                    const offsetTop = target.getBoundingClientRect().top + window.pageYOffset - 80;
                    
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    /**
     * Lazy loading for images
     */
    function initLazyLoading() {
        if ('IntersectionObserver' in window) {
            const lazyImages = document.querySelectorAll('img[data-src]');

            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                        
                        img.addEventListener('load', function() {
                            this.style.opacity = '1';
                        });
                    }
                });
            });

            lazyImages.forEach(img => {
                img.style.opacity = '0';
                img.style.transition = 'opacity 0.3s';
                imageObserver.observe(img);
            });
        }
    }

    /**
     * Performance optimization
     */
    function optimizeAnimations() {
        // Reduce animations for users who prefer reduced motion
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            const style = document.createElement('style');
            style.textContent = `
                *, *::before, *::after {
                    animation-duration: 0.01ms !important;
                    animation-iteration-count: 1 !important;
                    transition-duration: 0.01ms !important;
                }
            `;
            document.head.appendChild(style);
        }

        // Pause animations when tab is not visible
        document.addEventListener('visibilitychange', function() {
            const animatedElements = document.querySelectorAll('.animated, .in-view');
            
            if (document.hidden) {
                animatedElements.forEach(element => {
                    element.style.animationPlayState = 'paused';
                });
            } else {
                animatedElements.forEach(element => {
                    element.style.animationPlayState = 'running';
                });
            }
        });
    }

    /**
     * Initialize additional features
     */
    initSmoothScroll();
    initLazyLoading();
    optimizeAnimations();

    // Add CSS animations
    const animationStyles = document.createElement('style');
    animationStyles.textContent = `
        .animate-in {
            animation: slideInUp 0.6s ease forwards;
        }
        
        .in-view .feature-item,
        .in-view .testimonial-item,
        .in-view .stat-item {
            opacity: 1;
            transform: translateY(0);
        }
        
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        .card {
            will-change: transform;
        }
        
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-blue);
        }
        
        .scale-animation {
            transition: transform 0.2s ease;
        }
        
        .scale-animation:hover {
            transform: scale(1.05);
        }
    `;
    document.head.appendChild(animationStyles);

})();