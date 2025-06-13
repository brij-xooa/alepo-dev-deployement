# Alepo Website – Complete Design & Implementation Guide v5.0
*Unified best practices from v2, v3, and v4*

## Design Philosophy
"Clean, professional, and trustworthy with subtle modern touches" - A minimalistic approach that prioritizes clarity and usability while incorporating refined modern design elements.

---

## Table of Contents
1. [Color System](#1--color-system)
2. [Typography](#2--typography)
3. [Spacing & Layout](#3--spacing--layout)
4. [Component Library](#4--component-library)
5. [Animation & Interactions](#5--animation--interactions)
6. [Page Structure](#6--page-structure)
7. [Grid System](#7--grid-system)
8. [Icons & Visual Elements](#8--icons--visual-elements)
9. [Accessibility](#9--accessibility)
10. [Implementation Notes](#10--implementation-notes)

---

## 1 · Color System

### 1.1 Core Brand Colors

```css
:root {
    /* Primary (Azure → Royal) - From v4 */
    --c-primary-50: #EEF7FF;
    --c-primary-100: #D9ECFF;
    --c-primary-200: #BCDEFF;
    --c-primary-300: #8DCBFF;
    --c-primary-400: #58ACFF;
    --c-primary-500: #318AFF; /* main brand */
    --c-primary-600: #1A6AF6;
    --c-primary-700: #1353E2;
    --c-primary-800: #1644B7;
    --c-primary-900: #183D90;
    --c-primary-950: #172D66;
    
    /* Secondary (Teal → Charcoal) - From v4 */
    --c-secondary-50: #F2F9F9;
    --c-secondary-100: #DDF0F0;
    --c-secondary-200: #BEE1E3;
    --c-secondary-300: #92CACE;
    --c-secondary-400: #5EABB2;
    --c-secondary-500: #4697A0; /* accent */
    --c-secondary-600: #3A7680;
    --c-secondary-700: #34606A;
    --c-secondary-800: #315159;
    --c-secondary-900: #2D454C;
    --c-secondary-950: #1A2C32;
    
    /* Utility */
    --c-black: #000000;
    --c-white: #FFFFFF;
    --c-gray-50: #FAFAFA;
    --c-gray-100: #F7F7F9;
    --c-gray-200: #E9ECEF;
    --c-gray-300: #DEE2E6;
    --c-gray-400: #CED4DA;
    --c-gray-500: #ADB5BD;
    --c-gray-600: #6C757D;
    --c-gray-700: #495057;
    --c-gray-800: #343A40;
    --c-gray-900: #212529;
    
    /* Semantic Colors */
    --c-success: #28A745;
    --c-warning: #FFC107;
    --c-danger: #DC3545;
    --c-info: #17A2B8;
}
```

### 1.2 Named Gradients (From v3 + v4 enhancements)

```css
/* Core Gradients */
.gradient-ocean {
    background: linear-gradient(135deg, var(--c-primary-400) 0%, var(--c-secondary-500) 100%);
}

.gradient-sky {
    background: linear-gradient(45deg, var(--c-primary-200) 0%, var(--c-secondary-300) 100%);
}

.gradient-deep {
    background: linear-gradient(135deg, var(--c-primary-700) 0%, var(--c-secondary-700) 100%);
}

/* Subtle Animated Gradient (toned down from v4) */
.gradient-subtle-animated {
    background: linear-gradient(135deg, var(--c-primary-400), var(--c-secondary-500), var(--c-primary-500));
    background-size: 200% 200%;
    animation: gradient-shift 12s ease infinite; /* Slower for subtlety */
}

@keyframes gradient-shift {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

/* Light Mesh Background (subtle) */
.gradient-mesh-light {
    background: 
        radial-gradient(at 30% 20%, var(--c-primary-100) 0px, transparent 40%),
        radial-gradient(at 70% 80%, var(--c-secondary-100) 0px, transparent 40%),
        var(--c-white);
}
```

### 1.3 Shadow System (From v4, refined)

```css
:root {
    /* Subtle shadows for clean look */
    --shadow-xs: 0 1px 2px rgba(0, 0, 0, 0.05);
    --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.06);
    --shadow-md: 0 4px 8px rgba(0, 0, 0, 0.08);
    --shadow-lg: 0 8px 16px rgba(0, 0, 0, 0.10);
    --shadow-xl: 0 12px 24px rgba(0, 0, 0, 0.12);
    
    /* Colored shadows for hover states */
    --shadow-primary: 0 8px 24px rgba(49, 138, 255, 0.15);
    --shadow-primary-lg: 0 12px 32px rgba(49, 138, 255, 0.20);
}
```

### 1.4 Text on Colored Backgrounds

```css
/* Important: Never use pure black on blue backgrounds */
.bg-primary, .bg-gradient {
    color: var(--c-white);
}

.bg-primary-light {
    color: var(--c-gray-700); /* Not black */
}

.bg-dark {
    color: var(--c-gray-100); /* Softer than pure white */
}
```

---

## 2 · Typography

### 2.1 Font Stack (From v2)

```css
:root {
    --font-primary: -apple-system, BlinkMacSystemFont, 'Inter', 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
    --font-mono: 'SF Mono', 'Monaco', 'Inconsolata', 'Fira Code', monospace;
}
```

### 2.2 Type Scale (From v2 + v4 fluid approach)

```css
/* Fluid Typography for better responsiveness */
:root {
    /* Display */
    --font-size-hero: clamp(2rem, 4vw + 1rem, 3rem); /* 32px → 48px */
    --font-size-display: clamp(1.75rem, 3vw + 0.5rem, 2rem); /* 28px → 32px */
    
    /* Headings */
    --font-size-h1: clamp(1.75rem, 3vw + 0.5rem, 2rem); /* 28px → 32px */
    --font-size-h2: clamp(1.5rem, 2.5vw + 0.5rem, 1.5rem); /* 24px */
    --font-size-h3: clamp(1.25rem, 2vw + 0.25rem, 1.25rem); /* 20px */
    --font-size-h4: 1.125rem; /* 18px */
    --font-size-h5: 1rem; /* 16px */
    --font-size-h6: 0.875rem; /* 14px */
    
    /* Body */
    --font-size-body: 1rem; /* 16px */
    --font-size-body-lg: 1.125rem; /* 18px */
    --font-size-small: 0.875rem; /* 14px */
    --font-size-tiny: 0.8125rem; /* 13px */
    --font-size-micro: 0.75rem; /* 12px */
}
```

### 2.3 Font Weights (From v2)

```css
:root {
    --font-weight-regular: 400;
    --font-weight-medium: 500;
    --font-weight-semibold: 600;
    --font-weight-bold: 700;
}
```

### 2.4 Line Heights & Letter Spacing (From v2)

```css
:root {
    /* Line Heights */
    --line-height-tight: 1.2;   /* Headings */
    --line-height-snug: 1.4;    /* Subheadings */
    --line-height-normal: 1.6;  /* Body text */
    --line-height-relaxed: 1.8; /* Paragraphs */
    
    /* Letter Spacing */
    --letter-spacing-tight: -0.02em;  /* Large headings */
    --letter-spacing-normal: 0;        /* Body text */
    --letter-spacing-wide: 0.05em;    /* Uppercase labels */
}
```

---

## 3 · Spacing & Layout

### 3.1 Spacing Scale (From v2 - 8px grid)

```css
:root {
    --space-1: 4px;
    --space-2: 8px;
    --space-3: 12px;
    --space-4: 16px;
    --space-5: 24px;
    --space-6: 32px;
    --space-7: 48px;
    --space-8: 64px;
    --space-9: 80px;
    --space-10: 96px;
    --space-11: 120px;
}
```

### 3.2 Container Widths (From v2)

```css
:root {
    --container-max: 1440px;
    --container-xl: 1200px;
    --container-lg: 1140px;
    --container-md: 960px;
    --container-sm: 768px;
    --container-xs: 576px;
}
```

### 3.3 Section Spacing

```css
/* Consistent section padding */
.section {
    padding: var(--space-9) 0; /* 80px */
}

.section-sm {
    padding: var(--space-7) 0; /* 48px */
}

.section-lg {
    padding: var(--space-11) 0; /* 120px */
}

/* Mobile adjustments */
@media (max-width: 768px) {
    .section { padding: var(--space-7) 0; }
    .section-sm { padding: var(--space-6) 0; }
    .section-lg { padding: var(--space-9) 0; }
}
```

### 3.4 Section Background Patterns (From v3)

```css
/* Clean rotation pattern for visual flow */
.section-pattern-1 { background: var(--c-white); }
.section-pattern-2 { background: var(--c-gray-50); }
.section-pattern-3 { background: linear-gradient(135deg, var(--c-primary-50) 0%, var(--c-secondary-50) 100%); }
.section-pattern-4 { background: var(--c-white); }
.section-pattern-5 { background: var(--c-secondary-950); color: var(--c-white); }
```

---

## 4 · Component Library

### 4.1 Buttons (From v4, refined)

```css
/* Base Button */
.btn {
    padding: 14px 32px;
    font-weight: var(--font-weight-semibold);
    font-size: var(--font-size-body);
    border-radius: 6px;
    border: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
}

/* Primary Button with subtle shimmer */
.btn-primary {
    background: linear-gradient(135deg, var(--c-primary-500) 0%, var(--c-primary-600) 100%);
    color: var(--c-white);
    position: relative;
    overflow: hidden;
}

.btn-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-primary);
}

.btn-primary:hover::before {
    left: 100%;
}

/* Secondary Button */
.btn-secondary {
    background: transparent;
    color: var(--c-primary-600);
    border: 2px solid var(--c-primary-600);
    padding: 12px 30px;
}

.btn-secondary:hover {
    background: var(--c-primary-600);
    color: var(--c-white);
    transform: translateY(-2px);
}

/* Text Button */
.btn-text {
    background: transparent;
    color: var(--c-primary-600);
    padding: var(--space-2) var(--space-4);
    font-weight: var(--font-weight-medium);
}

.btn-text:hover {
    color: var(--c-primary-700);
}

.btn-text::after {
    content: '→';
    margin-left: var(--space-2);
    transition: transform 0.3s ease;
}

.btn-text:hover::after {
    transform: translateX(4px);
}
```

### 4.2 Cards (From v4, refined for minimalism)

```css
/* Base Card */
.card {
    background: var(--c-white);
    border-radius: 12px;
    padding: var(--space-6);
    transition: all 0.3s ease;
}

/* Elevated Card */
.card-elevated {
    box-shadow: var(--shadow-sm);
}

.card-elevated:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}

/* Glass Card (subtle) */
.card-glass {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

/* Feature Card with gradient border */
.card-feature {
    position: relative;
    background: var(--c-white);
    padding: 2px;
    background: linear-gradient(135deg, var(--c-primary-400), var(--c-secondary-400));
    border-radius: 12px;
}

.card-feature-inner {
    background: var(--c-white);
    border-radius: 10px;
    padding: var(--space-6);
    height: 100%;
}
```

### 4.3 Navigation & Mega Menu (From v2 structure + v4 styling)

```css
/* Navigation Bar */
.navbar {
    height: 72px;
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-bottom: 1px solid var(--c-gray-200);
    position: sticky;
    top: 0;
    z-index: 1000;
    transition: all 0.3s ease;
}

.navbar-scrolled {
    box-shadow: var(--shadow-md);
}

/* Mega Menu */
.mega-menu {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: var(--c-white);
    border-radius: 12px;
    box-shadow: var(--shadow-xl);
    margin-top: var(--space-2);
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
}

.mega-menu.active {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

/* Menu Sections */
.mega-menu-section {
    background: var(--c-gray-50);
    border-radius: 8px;
    padding: var(--space-5);
    height: 100%;
}

.mega-menu-section:hover {
    background: var(--c-gray-100);
}
```

### 4.4 Forms (From v4, simplified)

```css
/* Form Controls */
.form-control {
    width: 100%;
    padding: var(--space-3) var(--space-4);
    border: 2px solid var(--c-gray-300);
    border-radius: 6px;
    font-size: var(--font-size-body);
    background: var(--c-white);
    transition: all 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: var(--c-primary-500);
    box-shadow: 0 0 0 3px rgba(49, 138, 255, 0.1);
}

/* Newsletter Form (From v3 style) */
.newsletter-form {
    background: var(--c-secondary-950);
    padding: var(--space-7);
    border-radius: 16px;
    text-align: center;
}

.newsletter-input {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: var(--c-white);
}

.newsletter-input::placeholder {
    color: rgba(255, 255, 255, 0.6);
}
```

---

## 5 · Animation & Interactions

### 5.1 Transition System (Subtle approach)

```css
:root {
    --transition-fast: 0.2s ease;
    --transition-medium: 0.3s ease;
    --transition-smooth: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
```

### 5.2 Hover Effects (Refined from v4)

```css
/* Subtle lift */
.hover-lift {
    transition: transform var(--transition-smooth), box-shadow var(--transition-smooth);
}

.hover-lift:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}

/* Scale effect (minimal) */
.hover-scale {
    transition: transform var(--transition-medium);
}

.hover-scale:hover {
    transform: scale(1.02);
}

/* Underline animation */
.link-underline {
    position: relative;
    text-decoration: none;
}

.link-underline::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    background: var(--c-primary-500);
    transition: width var(--transition-medium);
}

.link-underline:hover::after {
    width: 100%;
}
```

### 5.3 Customer Testimonial Carousel

```css
/* Carousel Container */
.testimonial-carousel {
    position: relative;
    overflow: hidden;
    padding: var(--space-7) 0;
}

.testimonial-slide {
    opacity: 0;
    transform: translateX(50px);
    transition: all 0.5s ease;
    position: absolute;
    width: 100%;
}

.testimonial-slide.active {
    opacity: 1;
    transform: translateX(0);
    position: relative;
}

/* Navigation Buttons */
.carousel-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: var(--c-white);
    border: 2px solid var(--c-gray-300);
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all var(--transition-medium);
    z-index: 2;
}

.carousel-btn:hover {
    border-color: var(--c-primary-500);
    background: var(--c-primary-50);
}

.carousel-btn-prev { left: 0; }
.carousel-btn-next { right: 0; }

/* Dots Indicator */
.carousel-dots {
    display: flex;
    justify-content: center;
    gap: var(--space-2);
    margin-top: var(--space-5);
}

.carousel-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--c-gray-300);
    cursor: pointer;
    transition: all var(--transition-medium);
}

.carousel-dot.active {
    width: 24px;
    border-radius: 4px;
    background: var(--c-primary-500);
}
```

### 5.4 Loading States (From v3)

```css
/* Simple spinner */
.spinner {
    width: 40px;
    height: 40px;
    border: 3px solid var(--c-gray-200);
    border-top-color: var(--c-primary-500);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Skeleton loading */
.skeleton {
    background: var(--c-gray-200);
    border-radius: 4px;
    position: relative;
    overflow: hidden;
}

.skeleton::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    animation: skeleton-wave 1.5s ease-in-out infinite;
}

@keyframes skeleton-wave {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}
```

---

## 6 · Page Structure

### 6.1 Hero Section (From v3 approach)

```css
/* Hero - Not full viewport height for better flow */
.hero {
    padding: var(--space-11) 0 var(--space-9); /* 120px top, 80px bottom */
    background: linear-gradient(135deg, var(--c-primary-500) 0%, var(--c-secondary-500) 100%);
    position: relative;
    overflow: hidden;
}

/* Subtle animated background */
.hero-bg-animation {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: 0.1;
}

.hero-bg-animation::before {
    content: '';
    position: absolute;
    width: 200%;
    height: 200%;
    top: -50%;
    left: -50%;
    background: radial-gradient(circle, var(--c-white) 1px, transparent 1px);
    background-size: 50px 50px;
    animation: hero-drift 20s linear infinite;
}

@keyframes hero-drift {
    0% { transform: translate(0, 0); }
    100% { transform: translate(50px, 50px); }
}

/* Hero Content */
.hero-content {
    position: relative;
    z-index: 1;
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.hero-title {
    font-size: var(--font-size-hero);
    font-weight: var(--font-weight-bold);
    color: var(--c-white);
    margin-bottom: var(--space-4);
    line-height: var(--line-height-tight);
}

.hero-subtitle {
    font-size: var(--font-size-body-lg);
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: var(--space-6);
    line-height: var(--line-height-normal);
}

.hero-cta {
    display: flex;
    gap: var(--space-4);
    justify-content: center;
    flex-wrap: wrap;
}

/* Mobile adjustments */
@media (max-width: 768px) {
    .hero {
        padding: var(--space-9) 0 var(--space-8);
    }
    
    .hero-cta {
        flex-direction: column;
        align-items: center;
    }
    
    .hero-cta .btn {
        width: 100%;
        max-width: 280px;
    }
}
```

### 6.2 Section Order (As specified)

```css
/* 1. Hero */
.section-hero { /* Defined above */ }

/* 2. Why Alepo */
.section-why {
    background: var(--c-gray-50);
    padding: var(--space-9) 0;
}

/* 3. Three Core Solutions */
.section-solutions {
    background: var(--c-white);
    padding: var(--space-9) 0;
}

/* 4. Customer Portfolio (Logos) */
.section-portfolio {
    background: linear-gradient(135deg, var(--c-primary-50) 0%, var(--c-secondary-50) 100%);
    padding: var(--space-8) 0;
}

/* 5. Stats */
.section-stats {
    background: var(--c-white);
    padding: var(--space-9) 0;
}

/* 6. Customer Success Stories */
.section-testimonials {
    background: var(--c-secondary-950);
    color: var(--c-white);
    padding: var(--space-9) 0;
}

/* 7. Resources */
.section-resources {
    background: var(--c-gray-50);
    padding: var(--space-9) 0;
}

/* 8. Newsletter (From v3) */
.section-newsletter {
    background: var(--c-primary-950);
    padding: var(--space-8) 0;
}

/* 9. CTA (Ready to Transform - From v3) */
.section-cta {
    background: linear-gradient(135deg, var(--c-primary-600) 0%, var(--c-primary-700) 100%);
    padding: var(--space-10) 0;
    text-align: center;
}
```

---

## 7 · Grid System

### 7.1 Grid Layouts (From v2)

```css
/* Base Grid */
.grid {
    display: grid;
    gap: var(--space-6);
}

/* Solutions Grid (3 columns) */
.grid-solutions {
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
}

/* Stats Grid (4 columns) */
.grid-stats {
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
}

/* Resources Grid (3 columns) */
.grid-resources {
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
}

/* Portfolio Logos (6 columns) */
.grid-logos {
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: var(--space-5);
    align-items: center;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .grid {
        gap: var(--space-5);
    }
    
    .grid-logos {
        grid-template-columns: repeat(3, 1fr);
        gap: var(--space-4);
    }
}
```

---

## 8 · Icons & Visual Elements

### 8.1 Icon System (From v2)

```css
/* Icon wrapper */
.icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    line-height: 1;
}

/* Icon backgrounds */
.icon-box {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    background: var(--c-primary-50);
    color: var(--c-primary-600);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all var(--transition-medium);
}

.icon-box:hover {
    background: var(--c-primary-100);
    transform: scale(1.05);
}

/* Icon with gradient background */
.icon-box-gradient {
    background: linear-gradient(135deg, var(--c-primary-100) 0%, var(--c-secondary-100) 100%);
}
```

### 8.2 Emoji Icons (From v2)

```css
/* Navigation Icons */
.icon-dropdown::after { content: '▼'; margin-left: var(--space-2); font-size: 12px; }
.icon-menu::before { content: '☰'; }
.icon-close::before { content: '✕'; }

/* Category Icons */
.icon-solutions { content: '🚀'; }
.icon-security { content: '🔐'; }
.icon-business { content: '💼'; }
.icon-ai { content: '🤖'; }
.icon-mobile { content: '📱'; }
.icon-global { content: '🌐'; }
.icon-enterprise { content: '🏢'; }
.icon-government { content: '🏛️'; }
.icon-resources { content: '📚'; }
.icon-tools { content: '🛠️'; }
.icon-calendar { content: '📅'; }
.icon-news { content: '📰'; }
.icon-email { content: '📧'; }
.icon-check { content: '✓'; }
.icon-arrow { content: '→'; }
```

---

## 9 · Accessibility

### 9.1 Focus States

```css
/* Visible focus indicators */
:focus-visible {
    outline: 3px solid var(--c-primary-400);
    outline-offset: 2px;
}

/* Button focus */
.btn:focus-visible {
    outline-offset: 4px;
}

/* Skip to content link */
.skip-to-content {
    position: absolute;
    top: -40px;
    left: 0;
    background: var(--c-primary-600);
    color: var(--c-white);
    padding: var(--space-3) var(--space-5);
    text-decoration: none;
    border-radius: 0 0 8px 0;
    transition: top var(--transition-medium);
}

.skip-to-content:focus {
    top: 0;
}
```

### 9.2 Color Contrast Requirements

```css
/* Minimum contrast ratios maintained:
   - Normal text on white: #495057 (AAA compliant)
   - Large text on white: #6C757D (AA compliant)
   - White text on primary: Always passes AA
   - Never use black on blue backgrounds
*/
```

### 9.3 Interactive Targets

```css
/* Minimum touch targets */
.btn,
.form-control,
.carousel-btn {
    min-height: 44px; /* Mobile touch target */
}

/* Link padding for easier clicking */
a {
    padding: var(--space-2);
    margin: calc(var(--space-2) * -1);
}
```

---

## 10 · Implementation Notes

### 10.1 CSS Architecture (From v2)

1. **Use CSS Custom Properties**: All values defined as variables for easy theming
2. **BEM Methodology**: For maintainable component classes
3. **Mobile-First**: Start with mobile styles, enhance for desktop
4. **Progressive Enhancement**: Core functionality works without JS
5. **Performance First**: Optimize animations with `will-change` and GPU acceleration

### 10.2 Browser Support

```css
/* Modern CSS with fallbacks */
.card-glass {
    background: rgba(255, 255, 255, 0.9); /* Fallback */
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

/* Clamp fallbacks */
.hero-title {
    font-size: 2rem; /* Fallback */
    font-size: clamp(2rem, 4vw + 1rem, 3rem);
}
```

### 10.3 Performance Guidelines

1. **Animations**: Use `transform` and `opacity` for smooth 60fps
2. **Images**: Lazy load below the fold, use WebP with fallbacks
3. **Fonts**: Preload critical fonts, use font-display: swap
4. **CSS**: Minify and inline critical CSS
5. **JavaScript**: Defer non-critical scripts

### 10.4 Component States

```css
/* Define all component states clearly */
.component {
    /* Default state */
}

.component:hover {
    /* Hover state */
}

.component:focus {
    /* Focus state */
}

.component:active {
    /* Active state */
}

.component:disabled {
    /* Disabled state */
    opacity: 0.6;
    cursor: not-allowed;
}

.component.loading {
    /* Loading state */
    pointer-events: none;
}
```

### 10.5 Dark Mode Preparation

```css
/* Structure for future dark mode */
@media (prefers-color-scheme: dark) {
    :root {
        /* Override color variables here */
    }
}

/* Or with class-based toggle */
[data-theme="dark"] {
    /* Dark mode overrides */
}
```

---

## Summary

This v5 design guide combines:
- **From v2**: Practical implementation details, spacing system, icon approach, grid layouts
- **From v3**: Clean hero sections, minimalist design philosophy, section patterns
- **From v4**: Modern enhancements (subtle animations, glass morphism, enhanced components)

The result is a professional, clean, and modern design system that prioritizes usability and performance while incorporating refined modern touches.