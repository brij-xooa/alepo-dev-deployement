/**
 * Alepo Theme Navigation
 * Mega menu interactions, mobile menu, and navigation enhancements
 * 
 * @package Alepo
 * @version 1.0.0
 */

(function() {
    'use strict';

    // Initialize when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        initMegaMenu();
        initMobileMenu();
        initSearchFunctionality();
        initStickyNavigation();
        initActiveMenuStates();
        initKeyboardNavigation();
    });

    /**
     * Mega Menu Functionality
     */
    function initMegaMenu() {
        const navItems = document.querySelectorAll('.nav-item');
        let activeMenu = null;
        let hoverTimer = null;

        navItems.forEach(item => {
            const megaMenu = item.querySelector('.mega-menu, .dropdown-menu');
            if (!megaMenu) return;

            // Mouse enter - show menu with delay
            item.addEventListener('mouseenter', function() {
                clearTimeout(hoverTimer);
                
                hoverTimer = setTimeout(() => {
                    hideAllMenus();
                    showMegaMenu(item, megaMenu);
                    activeMenu = item;
                }, 150); // Small delay to prevent flickering
            });

            // Mouse leave - hide menu with delay
            item.addEventListener('mouseleave', function() {
                clearTimeout(hoverTimer);
                
                hoverTimer = setTimeout(() => {
                    hideMegaMenu(item, megaMenu);
                    if (activeMenu === item) {
                        activeMenu = null;
                    }
                }, 300); // Longer delay for better UX
            });

            // Prevent hiding when hovering over the menu itself
            megaMenu.addEventListener('mouseenter', function() {
                clearTimeout(hoverTimer);
            });

            megaMenu.addEventListener('mouseleave', function() {
                hoverTimer = setTimeout(() => {
                    hideMegaMenu(item, megaMenu);
                    if (activeMenu === item) {
                        activeMenu = null;
                    }
                }, 100);
            });
        });

        // Hide menus when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.nav-item')) {
                hideAllMenus();
                activeMenu = null;
            }
        });

        // Hide menus on scroll (mobile)
        let scrollTimer = null;
        window.addEventListener('scroll', function() {
            if (window.innerWidth <= 768) {
                clearTimeout(scrollTimer);
                scrollTimer = setTimeout(hideAllMenus, 100);
            }
        });
    }

    /**
     * Show mega menu with animation
     */
    function showMegaMenu(item, menu) {
        // Update aria attributes
        const link = item.querySelector('.nav-link');
        if (link) {
            link.setAttribute('aria-expanded', 'true');
        }

        // Add active class
        item.classList.add('menu-active');

        // Show menu with animation
        menu.style.display = 'block';
        menu.style.opacity = '0';
        menu.style.transform = 'translateY(-10px)';
        
        // Force reflow
        menu.offsetHeight;
        
        // Animate in
        menu.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        menu.style.opacity = '1';
        menu.style.transform = 'translateY(0)';

        // Add staggered animation for menu items
        const menuItems = menu.querySelectorAll('a, .featured-card, .industry-card');
        menuItems.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(10px)';
            
            setTimeout(() => {
                item.style.transition = 'opacity 0.2s ease, transform 0.2s ease';
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, index * 30);
        });
    }

    /**
     * Hide mega menu with animation
     */
    function hideMegaMenu(item, menu) {
        // Update aria attributes
        const link = item.querySelector('.nav-link');
        if (link) {
            link.setAttribute('aria-expanded', 'false');
        }

        // Remove active class
        item.classList.remove('menu-active');

        // Animate out
        menu.style.transition = 'opacity 0.2s ease, transform 0.2s ease';
        menu.style.opacity = '0';
        menu.style.transform = 'translateY(-10px)';

        setTimeout(() => {
            menu.style.display = 'none';
        }, 200);
    }

    /**
     * Hide all mega menus
     */
    function hideAllMenus() {
        const navItems = document.querySelectorAll('.nav-item');
        navItems.forEach(item => {
            const menu = item.querySelector('.mega-menu, .dropdown-menu');
            if (menu) {
                hideMegaMenu(item, menu);
            }
        });
    }

    /**
     * Mobile Menu Functionality
     */
    function initMobileMenu() {
        const mobileToggle = document.querySelector('.mobile-menu-toggle');
        const mobileMenu = document.querySelector('.mobile-menu');
        const body = document.body;

        if (!mobileToggle || !mobileMenu) return;

        // Toggle mobile menu
        mobileToggle.addEventListener('click', function() {
            const isOpen = mobileMenu.classList.contains('active');
            
            if (isOpen) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (mobileMenu.classList.contains('active') && 
                !e.target.closest('.mobile-menu') && 
                !e.target.closest('.mobile-menu-toggle')) {
                closeMobileMenu();
            }
        });

        // Close mobile menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
                closeMobileMenu();
            }
        });

        // Handle mobile submenu toggles
        const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
        mobileNavLinks.forEach(link => {
            if (link.nextElementSibling && link.nextElementSibling.classList.contains('mobile-submenu')) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    toggleMobileSubmenu(this);
                });
            }
        });

        function openMobileMenu() {
            mobileMenu.classList.add('active');
            mobileToggle.setAttribute('aria-expanded', 'true');
            mobileToggle.innerHTML = '✕';
            body.style.overflow = 'hidden';
            
            // Animate menu items
            const menuItems = mobileMenu.querySelectorAll('.mobile-nav-item');
            menuItems.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateX(-20px)';
                
                setTimeout(() => {
                    item.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                    item.style.opacity = '1';
                    item.style.transform = 'translateX(0)';
                }, index * 50);
            });
        }

        function closeMobileMenu() {
            mobileMenu.classList.remove('active');
            mobileToggle.setAttribute('aria-expanded', 'false');
            mobileToggle.innerHTML = '☰';
            body.style.overflow = '';
            
            // Close all submenus
            const openSubmenus = mobileMenu.querySelectorAll('.mobile-submenu.active');
            openSubmenus.forEach(submenu => {
                submenu.classList.remove('active');
            });
        }

        function toggleMobileSubmenu(link) {
            const submenu = link.nextElementSibling;
            const isOpen = submenu.classList.contains('active');
            
            // Close other submenus
            const otherSubmenus = mobileMenu.querySelectorAll('.mobile-submenu.active');
            otherSubmenus.forEach(sub => {
                if (sub !== submenu) {
                    sub.classList.remove('active');
                }
            });
            
            // Toggle current submenu
            if (isOpen) {
                submenu.classList.remove('active');
            } else {
                submenu.classList.add('active');
            }
        }
    }

    /**
     * Search Functionality
     */
    function initSearchFunctionality() {
        const searchIcon = document.querySelector('.search-icon');
        const searchOverlay = createSearchOverlay();

        if (!searchIcon) return;

        searchIcon.addEventListener('click', function() {
            showSearchOverlay();
        });

        searchIcon.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                showSearchOverlay();
            }
        });

        function createSearchOverlay() {
            const overlay = document.createElement('div');
            overlay.className = 'search-overlay';
            overlay.innerHTML = `
                <div class="search-container">
                    <div class="search-form">
                        <input type="search" placeholder="Search..." class="search-input" autocomplete="off">
                        <button type="button" class="search-close" aria-label="Close search">✕</button>
                    </div>
                    <div class="search-suggestions">
                        <div class="suggestion-group">
                            <h4>Quick Links</h4>
                            <a href="/products">Products</a>
                            <a href="/solutions">Solutions</a>
                            <a href="/industries">Industries</a>
                            <a href="/request-demo">Request Demo</a>
                        </div>
                    </div>
                </div>
            `;

            // Add styles
            const style = document.createElement('style');
            style.textContent = `
                .search-overlay {
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: rgba(0, 0, 0, 0.8);
                    backdrop-filter: blur(5px);
                    z-index: 9999;
                    display: none;
                    opacity: 0;
                    transition: opacity 0.3s ease;
                }
                
                .search-overlay.active {
                    display: flex;
                    align-items: flex-start;
                    justify-content: center;
                    padding-top: 10vh;
                }
                
                .search-container {
                    background: white;
                    border-radius: 12px;
                    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
                    width: 90%;
                    max-width: 600px;
                    overflow: hidden;
                    transform: translateY(-20px);
                    transition: transform 0.3s ease;
                }
                
                .search-overlay.active .search-container {
                    transform: translateY(0);
                }
                
                .search-form {
                    display: flex;
                    align-items: center;
                    padding: 20px;
                    border-bottom: 1px solid #eee;
                }
                
                .search-input {
                    flex: 1;
                    border: none;
                    outline: none;
                    font-size: 18px;
                    padding: 10px 0;
                }
                
                .search-close {
                    background: none;
                    border: none;
                    font-size: 20px;
                    cursor: pointer;
                    padding: 10px;
                    color: #666;
                }
                
                .search-suggestions {
                    padding: 20px;
                }
                
                .suggestion-group h4 {
                    margin: 0 0 10px 0;
                    color: #333;
                    font-size: 14px;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                }
                
                .suggestion-group a {
                    display: block;
                    padding: 8px 0;
                    color: #666;
                    text-decoration: none;
                    transition: color 0.2s ease;
                }
                
                .suggestion-group a:hover {
                    color: var(--primary-blue);
                }
            `;
            document.head.appendChild(style);

            document.body.appendChild(overlay);

            // Add event listeners
            const closeBtn = overlay.querySelector('.search-close');
            const searchInput = overlay.querySelector('.search-input');

            closeBtn.addEventListener('click', hideSearchOverlay);
            overlay.addEventListener('click', function(e) {
                if (e.target === overlay) {
                    hideSearchOverlay();
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && overlay.classList.contains('active')) {
                    hideSearchOverlay();
                }
            });

            // Simple search functionality
            searchInput.addEventListener('input', function() {
                // Here you would implement actual search logic
                console.log('Searching for:', this.value);
            });

            return overlay;
        }

        function showSearchOverlay() {
            searchOverlay.classList.add('active');
            setTimeout(() => {
                searchOverlay.style.opacity = '1';
                const searchInput = searchOverlay.querySelector('.search-input');
                if (searchInput) {
                    searchInput.focus();
                }
            }, 10);
        }

        function hideSearchOverlay() {
            searchOverlay.style.opacity = '0';
            setTimeout(() => {
                searchOverlay.classList.remove('active');
            }, 300);
        }
    }

    /**
     * Sticky Navigation
     */
    function initStickyNavigation() {
        const header = document.querySelector('.main-nav');
        if (!header) return;

        let lastScrollY = window.scrollY;
        let isHeaderHidden = false;

        function updateHeaderVisibility() {
            const currentScrollY = window.scrollY;
            
            if (currentScrollY > 100) {
                header.classList.add('scrolled');
                
                if (currentScrollY > lastScrollY && !isHeaderHidden) {
                    // Scrolling down - hide header
                    header.style.transform = 'translateY(-100%)';
                    isHeaderHidden = true;
                } else if (currentScrollY < lastScrollY && isHeaderHidden) {
                    // Scrolling up - show header
                    header.style.transform = 'translateY(0)';
                    isHeaderHidden = false;
                }
            } else {
                header.classList.remove('scrolled');
                header.style.transform = 'translateY(0)';
                isHeaderHidden = false;
            }
            
            lastScrollY = currentScrollY;
        }

        // Throttled scroll listener
        let scrollTimer = null;
        window.addEventListener('scroll', function() {
            if (scrollTimer !== null) {
                clearTimeout(scrollTimer);
            }
            scrollTimer = setTimeout(updateHeaderVisibility, 10);
        });

        // Add sticky styles
        const stickyStyles = document.createElement('style');
        stickyStyles.textContent = `
            .main-nav {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            
            .main-nav.scrolled {
                box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
                backdrop-filter: blur(10px);
                background: rgba(255, 255, 255, 0.95);
            }
        `;
        document.head.appendChild(stickyStyles);
    }

    /**
     * Active Menu States
     */
    function initActiveMenuStates() {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.nav-link, .mobile-nav-link');

        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href && (currentPath === href || currentPath.startsWith(href + '/'))) {
                link.classList.add('active');
                
                // Add active class to parent nav item
                const navItem = link.closest('.nav-item, .mobile-nav-item');
                if (navItem) {
                    navItem.classList.add('current-menu-item');
                }
            }
        });
    }

    /**
     * Keyboard Navigation
     */
    function initKeyboardNavigation() {
        const navItems = document.querySelectorAll('.nav-item');

        navItems.forEach(item => {
            const link = item.querySelector('.nav-link');
            const megaMenu = item.querySelector('.mega-menu, .dropdown-menu');

            if (!link || !megaMenu) return;

            // Open menu on Enter/Space
            link.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    
                    if (megaMenu.style.display === 'block') {
                        hideMegaMenu(item, megaMenu);
                    } else {
                        hideAllMenus();
                        showMegaMenu(item, megaMenu);
                    }
                }
            });

            // Navigate within mega menu
            const menuLinks = megaMenu.querySelectorAll('a');
            menuLinks.forEach((menuLink, index) => {
                menuLink.addEventListener('keydown', function(e) {
                    if (e.key === 'ArrowDown') {
                        e.preventDefault();
                        const nextLink = menuLinks[index + 1];
                        if (nextLink) {
                            nextLink.focus();
                        }
                    } else if (e.key === 'ArrowUp') {
                        e.preventDefault();
                        const prevLink = menuLinks[index - 1];
                        if (prevLink) {
                            prevLink.focus();
                        } else {
                            link.focus();
                        }
                    } else if (e.key === 'Escape') {
                        hideMegaMenu(item, megaMenu);
                        link.focus();
                    }
                });
            });
        });
    }

    /**
     * Demo button interactions
     */
    document.addEventListener('click', function(e) {
        if (e.target.matches('.btn-demo, .btn-primary[href*="demo"]')) {
            // Add analytics tracking or other demo-specific logic here
            console.log('Demo button clicked:', e.target.textContent);
            
            // Add visual feedback
            e.target.style.transform = 'scale(0.95)';
            setTimeout(() => {
                e.target.style.transform = '';
            }, 150);
        }
    });

})();