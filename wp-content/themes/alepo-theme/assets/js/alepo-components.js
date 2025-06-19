/**
 * ALEPO COMPONENTS JAVASCRIPT
 * Interactive functionality for reusable components
 * Extracted from advanced design prototypes
 */

class AlepoComponents {
    constructor() {
        this.init();
    }

    init() {
        // Initialize when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.initializeComponents());
        } else {
            this.initializeComponents();
        }
    }

    initializeComponents() {
        this.createBackgroundParticles();
        this.createDiagramParticles();
        this.initializeMouseFollowEffects();
        this.initializeScrollAnimations();
        this.initializeParallaxEffects();
        this.initializeFAB();
        this.createCurvedLines();
    }

    // ===== BACKGROUND PARTICLES ===== //
    createBackgroundParticles() {
        const container = document.querySelector('.alepo-particles-bg');
        if (!container) return;

        const particleCount = 25;

        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'alepo-particle-bg';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 20 + 's';
            particle.style.animationDuration = (15 + Math.random() * 15) + 's';

            // Vary the opacity, size and color
            const size = 4 + Math.random() * 6;
            particle.style.width = particle.style.height = size + 'px';
            particle.style.opacity = 0.3 + Math.random() * 0.4;

            // Some particles use secondary color
            if (Math.random() > 0.5) {
                particle.style.background = 'var(--c-secondary-400)';
                particle.style.boxShadow = '0 0 10px rgba(70, 151, 160, 0.3)';
            }

            container.appendChild(particle);
        }
    }

    // ===== DIAGRAM PARTICLES ===== //
    createDiagramParticles() {
        const containers = document.querySelectorAll('.alepo-particle-container');
        
        containers.forEach(container => {
            const particleCount = 15;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'alepo-particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 15 + 's';
                particle.style.animationDuration = (15 + Math.random() * 10) + 's';
                container.appendChild(particle);
            }
        });
    }

    // ===== MOUSE FOLLOW EFFECTS ===== //
    initializeMouseFollowEffects() {
        const cards = document.querySelectorAll('.alepo-feature-card');
        
        cards.forEach(card => {
            const mouseGradient = card.querySelector('.alepo-mouse-gradient');
            if (!mouseGradient) return;

            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                mouseGradient.style.left = x + 'px';
                mouseGradient.style.top = y + 'px';
            });

            card.addEventListener('mouseleave', () => {
                mouseGradient.style.opacity = '0';
            });

            card.addEventListener('mouseenter', () => {
                mouseGradient.style.opacity = '0.15';
            });
        });
    }

    // ===== SCROLL ANIMATIONS ===== //
    initializeScrollAnimations() {
        // Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Start animation when element comes into view
                    entry.target.style.animationPlayState = 'running';
                    entry.target.classList.add('animate-in');
                    
                    // Remove observer once animated
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe elements with animation classes
        const animateElements = document.querySelectorAll(
            '.alepo-feature-card, .alepo-fade-in-up, .alepo-diagram-container, [class*="alepo-"][class*="slide"], [class*="alepo-"][class*="fade"]'
        );
        
        animateElements.forEach(el => {
            // Pause animations initially
            el.style.animationPlayState = 'paused';
            observer.observe(el);
        });
    }

    // ===== PARALLAX EFFECTS ===== //
    initializeParallaxEffects() {
        let ticking = false;
        const solutionWrapper = document.querySelector('.alepo-sticky-wrapper');
        const diagramContainer = document.querySelector('.alepo-diagram-container');
        const contentSection = document.querySelector('.alepo-grid-2');
        const featuresContainer = document.querySelector('.alepo-flex-column');

        const updateParallax = () => {
            const scrolled = window.pageYOffset;
            
            // Background parallax
            const meshBg = document.querySelector('.alepo-gradient-mesh');
            const particlesBg = document.querySelector('.alepo-particles-bg');
            const curvedLines = document.querySelector('.alepo-curved-lines');

            if (meshBg) meshBg.style.transform = `translateY(${scrolled * 0.3}px)`;
            if (particlesBg) particlesBg.style.transform = `translateY(${scrolled * 0.5}px)`;
            if (curvedLines) curvedLines.style.transform = `translateY(${scrolled * 0.2}px)`;

            // Sticky diagram parallax effect - only on desktop
            if (window.innerWidth > 968 && solutionWrapper && contentSection && featuresContainer) {
                const contentRect = contentSection.getBoundingClientRect();
                const featuresRect = featuresContainer.getBoundingClientRect();

                // Calculate scroll progress
                const scrollProgress = Math.max(0, -contentRect.top / (featuresRect.height - window.innerHeight));

                // Apply parallax: diagram moves at 30% of scroll speed
                const parallaxOffset = scrollProgress * featuresRect.height * 0.3;
                solutionWrapper.style.transform = `translateY(${parallaxOffset}px)`;

                // Fade out effect when nearing the end
                if (diagramContainer) {
                    if (scrollProgress > 0.7) {
                        const fadeProgress = (scrollProgress - 0.7) / 0.3;
                        diagramContainer.classList.add('fade-out');
                        diagramContainer.style.opacity = 1 - (fadeProgress * 0.7);
                    } else {
                        diagramContainer.classList.remove('fade-out');
                        diagramContainer.style.opacity = '';
                    }
                }
            }

            ticking = false;
        };

        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(updateParallax);
                ticking = true;
            }
        });

        // Reset parallax on resize
        window.addEventListener('resize', () => {
            if (window.innerWidth <= 968 && solutionWrapper && diagramContainer) {
                solutionWrapper.style.transform = 'translateY(0)';
                diagramContainer.style.opacity = '';
                diagramContainer.classList.remove('fade-out');
            }
        });
    }

    // ===== FLOATING ACTION BUTTON ===== //
    initializeFAB() {
        const fab = document.querySelector('.alepo-fab');
        if (!fab) return;

        // Show/hide based on scroll position
        let lastScrollTop = 0;
        window.addEventListener('scroll', () => {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > 300) {
                fab.style.opacity = '1';
                fab.style.pointerEvents = 'auto';
            } else {
                fab.style.opacity = '0';
                fab.style.pointerEvents = 'none';
            }
            
            lastScrollTop = scrollTop;
        });

        // Click handler
        fab.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // ===== CURVED LINES BACKGROUND ===== //
    createCurvedLines() {
        const container = document.querySelector('.alepo-curved-lines');
        if (!container) return;

        const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        svg.setAttribute('viewBox', '0 0 1440 900');
        svg.setAttribute('preserveAspectRatio', 'none');
        svg.style.width = '100%';
        svg.style.height = '100%';

        // Create multiple curved paths
        const paths = [
            {
                d: 'M 0,450 Q 360,300 720,450 T 1440,450',
                stroke: 'var(--c-gray-200)',
                dashArray: '5,5'
            },
            {
                d: 'M 0,500 Q 360,350 720,500 T 1440,500',
                stroke: 'var(--c-gray-300)',
                dashArray: '8,8'
            },
            {
                d: 'M 0,400 Q 360,250 720,400 T 1440,400',
                stroke: 'var(--c-primary-100)',
                dashArray: '3,7'
            }
        ];

        paths.forEach(pathData => {
            const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            path.setAttribute('d', pathData.d);
            path.setAttribute('stroke', pathData.stroke);
            path.setAttribute('stroke-dasharray', pathData.dashArray);
            path.setAttribute('fill', 'none');
            path.setAttribute('stroke-width', '1');
            path.style.animation = 'alepo-dash-move 20s linear infinite';
            svg.appendChild(path);
        });

        const curveDiv = document.createElement('div');
        curveDiv.className = 'alepo-curve-line';
        curveDiv.appendChild(svg);
        container.appendChild(curveDiv);
    }

    // ===== UTILITY METHODS ===== //
    
    // Add staggered animation delays
    static addStaggeredDelay(elements, baseDelay = 100) {
        elements.forEach((el, index) => {
            el.style.animationDelay = `${baseDelay * index}ms`;
        });
    }

    // Trigger animation on element
    static triggerAnimation(element, animationClass) {
        element.classList.remove(animationClass);
        // Force reflow
        element.offsetHeight;
        element.classList.add(animationClass);
    }

    // Check if element is in viewport
    static isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    // Throttle function calls
    static throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        }
    }
}

// ===== INITIALIZATION ===== //

// Auto-initialize when script loads
window.AlepoComponents = new AlepoComponents();

// ===== WORDPRESS BLOCK EDITOR SUPPORT ===== //

// Re-initialize components when new blocks are added in editor
if (typeof wp !== 'undefined' && wp.data) {
    let previousBlockCount = 0;
    
    wp.data.subscribe(() => {
        const currentBlockCount = wp.data.select('core/block-editor').getBlockCount();
        if (currentBlockCount !== previousBlockCount) {
            // Delay to ensure DOM is updated
            setTimeout(() => {
                window.AlepoComponents.initializeComponents();
            }, 100);
            previousBlockCount = currentBlockCount;
        }
    });
}

// ===== EXPORT FOR MODULE SYSTEMS ===== //
if (typeof module !== 'undefined' && module.exports) {
    module.exports = AlepoComponents;
}