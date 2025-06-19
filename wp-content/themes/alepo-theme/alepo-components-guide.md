# 🎨 Alepo Components Library - Usage Guide

## Overview

The Alepo Components Library extracts all the sophisticated design elements, animations, and effects from the advanced card-design.html prototype and makes them reusable across WordPress pages.

## 🚀 Features Extracted

### **Background Effects**
- ✨ **Gradient Mesh Background** - Subtle radial gradients
- 🌊 **Animated Curved Lines** - SVG paths with dash animations  
- 🎯 **Flying Particles** - Physics-based floating elements
- 📱 **Parallax Scrolling** - Multi-layer depth effects

### **Advanced Card System**
- 🎯 **Aim Dot Animation** - Target-style hover indicators
- 🖱️ **Mouse-Following Gradients** - Interactive light effects
- 📐 **Top Border Animations** - Gradient line reveals
- 🎪 **Glassmorphism Effects** - Modern blur and transparency
- ⚡ **Hover Transformations** - Scale, lift, and glow effects

### **Interactive Elements**
- 🎭 **Staggered Animations** - Choreographed entrance effects
- 📍 **Sticky Parallax** - Advanced scroll behavior
- 🎯 **Intersection Observer** - Viewport-based triggers
- 🔄 **FAB (Floating Action Button)** - Scroll-to-top with style

## 📁 File Structure

```
wp-content/themes/alepo-theme/
├── assets/
│   ├── css/alepo-components.css     # Main component styles
│   └── js/alepo-components.js       # Interactive functionality
├── template-parts/blocks/
│   ├── alepo-feature-cards.php      # Feature cards block
│   └── alepo-diagram-container.php  # Diagram container block  
├── inc/
│   └── alepo-components-enqueue.php # WordPress integration
└── alepo-components-guide.md        # This guide
```

## 🔧 Installation & Setup

### 1. **Add to functions.php**
```php
// Add this line to your theme's functions.php
require_once get_template_directory() . '/inc/alepo-components-enqueue.php';
```

### 2. **Automatic Loading**
The components will automatically:
- ✅ Load CSS and JS on frontend and admin
- ✅ Register block patterns in WordPress
- ✅ Add component category in block inserter
- ✅ Initialize interactive functionality

## 🎯 Usage in wp-admin

### **Method 1: Block Patterns (Recommended)**

1. **Open Block Inserter** in Gutenberg editor
2. **Search for "Alepo"** or browse **"Alepo Components"** category
3. **Insert patterns**:
   - 🎨 **Alepo Feature Cards** - Advanced card layout
   - 📊 **Alepo Diagram Container** - Sticky parallax diagram
   - 🌐 **Alepo Features + Diagram Grid** - Complete layout

### **Method 2: Custom HTML Blocks**

#### **Feature Cards**
```html
<div class="alepo-flex-column">
    <div class="alepo-feature-card">
        <div class="alepo-aim-dot"></div>
        <div class="alepo-mouse-gradient"></div>
        <div class="alepo-icon-wrapper">
            <svg class="alepo-icon" viewBox="0 0 24 24">
                <path d="M12 2L2 7L12 12L22 7L12 2Z" />
            </svg>
        </div>
        <h3 class="alepo-feature-title">Your Title</h3>
        <p class="alepo-feature-description">Your description...</p>
    </div>
    <!-- Add more cards -->
</div>
```

#### **Diagram Container**
```html
<div class="alepo-sticky-container">
    <div class="alepo-sticky-wrapper">
        <h2 class="alepo-fade-in-up">Your Heading</h2>
        <div class="alepo-diagram-container" style="min-height: 500px;">
            <div class="alepo-bg-gradient-light" style="height: 100%; border-radius: 12px; position: relative;">
                <div class="alepo-particle-container"></div>
                <div style="position: relative; z-index: 2; text-align: center; color: var(--c-gray-600);">
                    Your content here
                </div>
            </div>
        </div>
    </div>
</div>
```

#### **Full Background Effects**
```html
<!-- Add these for full background experience -->
<div class="alepo-gradient-mesh"></div>
<div class="alepo-curved-lines"></div>
<div class="alepo-particles-bg"></div>

<!-- Your content here -->

<!-- Floating Action Button -->
<button class="alepo-fab">
    <svg viewBox="0 0 24 24">
        <path d="M7 14l5-5 5 5" />
    </svg>
</button>
```

## 🎨 Component Classes Reference

### **Layout Classes**
- `.alepo-container` - Main container with responsive padding
- `.alepo-grid-2` - Two-column responsive grid
- `.alepo-flex-column` - Vertical flexbox with gap

### **Card Classes**
- `.alepo-feature-card` - Main card with all hover effects
- `.alepo-aim-dot` - Target-style hover indicator
- `.alepo-mouse-gradient` - Mouse-following light effect
- `.alepo-icon-wrapper` - Gradient icon background

### **Animation Classes**
- `.alepo-fade-in-up` - Fade in from bottom animation
- `.alepo-hover-lift` - Subtle lift on hover
- `.alepo-title-gradient` - Gradient text effect
- `.alepo-title-underline` - Animated underline

### **Background Classes**
- `.alepo-gradient-mesh` - Subtle mesh background
- `.alepo-curved-lines` - Animated line patterns
- `.alepo-particles-bg` - Flying particles
- `.alepo-particle-container` - Local particle container

### **Utility Classes**
- `.alepo-text-center` - Center text alignment
- `.alepo-text-gradient` - Gradient text effect
- `.alepo-bg-gradient-light` - Light gradient background
- `.alepo-mb-9`, `.alepo-mt-9`, `.alepo-py-11` - Spacing utilities

## ⚙️ Customization Options

### **Color Customization**
All components use existing CSS variables from your main style.css:
```css
/* These are already defined - no need to duplicate */
--c-primary-500, --c-secondary-500, --c-gray-600, etc.
```

### **Animation Timing**
```css
/* Override in your custom CSS */
.alepo-feature-card {
    animation-duration: 1s; /* Default: 0.6s */
}
```

### **Particle Settings**
```javascript
// Customize in alepo-components.js
const particleCount = 50; // Default: 25
```

### **Responsive Breakpoints**
```css
/* Built-in responsive behavior */
@media (max-width: 968px) {
    .alepo-grid-2 { grid-template-columns: 1fr; }
}
```

## 🎯 Advanced Usage Examples

### **Solution Page Template**
```html
<!-- Background Effects -->
<div class="alepo-gradient-mesh"></div>
<div class="alepo-curved-lines"></div>
<div class="alepo-particles-bg"></div>

<div class="alepo-container">
    <!-- Page Title -->
    <h1 class="alepo-text-center alepo-mb-9 alepo-title-underline">
        <span class="alepo-title-gradient">Solution</span> Framework
    </h1>
    
    <!-- Main Content Grid -->
    <div class="alepo-grid-2">
        <!-- Left: Features -->
        <div class="alepo-flex-column">
            <!-- Feature cards here -->
        </div>
        
        <!-- Right: Sticky Diagram -->
        <div class="alepo-sticky-container">
            <!-- Diagram container here -->
        </div>
    </div>
</div>

<!-- FAB -->
<button class="alepo-fab">
    <svg viewBox="0 0 24 24"><path d="M7 14l5-5 5 5" /></svg>
</button>
```

### **Product Showcase**
```html
<div class="alepo-container">
    <div class="alepo-flex-column">
        <!-- Multiple feature cards showcasing product capabilities -->
        <div class="alepo-feature-card">...</div>
        <div class="alepo-feature-card">...</div>
        <div class="alepo-feature-card">...</div>
    </div>
</div>
```

### **About Page Section**
```html
<div class="alepo-bg-gray-50 alepo-py-11">
    <div class="alepo-container">
        <div class="alepo-grid-2">
            <div class="alepo-fade-in-up">
                <h2>Our Approach</h2>
                <p>Content here...</p>
            </div>
            <div class="alepo-diagram-container" style="min-height: 400px;">
                <!-- Diagram or image -->
            </div>
        </div>
    </div>
</div>
```

## 🔧 Performance Notes

### **Automatic Optimizations**
- ✅ **Throttled scroll events** - Smooth 60fps animations
- ✅ **Intersection Observer** - Only animate visible elements  
- ✅ **CSS transforms** - Hardware-accelerated animations
- ✅ **RequestAnimationFrame** - Optimized parallax updates

### **Best Practices**
- 🎯 Use sparingly on key pages for maximum impact
- 📱 Components automatically simplify on mobile
- ⚡ Background effects pause when not in viewport
- 🎪 Animations respect user motion preferences

## 🐛 Troubleshooting

### **Components Not Loading**
```php
// Check if enqueue file is included in functions.php
require_once get_template_directory() . '/inc/alepo-components-enqueue.php';
```

### **Animations Not Working**
- ✅ Ensure CSS and JS files are loading
- ✅ Check console for JavaScript errors
- ✅ Verify CSS variables are defined in main style.css

### **Patterns Not Showing**
- ✅ Clear WordPress cache
- ✅ Check if block patterns are enabled in theme
- ✅ Verify WordPress version supports patterns

## 🎨 Icon Library

### **Built-in Icons** (SVG Paths)
```html
<!-- Layers/Stack -->
<path d="M12 2L2 7L12 12L22 7L12 2Z" /><path d="M2 17L12 22L22 17" /><path d="M2 12L12 17L22 12" />

<!-- Lightning/Performance -->
<path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" />

<!-- Shield/Security -->
<path d="M12 2L3.5 7V11.5C3.5 16.5 6.5 21 12 22C17.5 21 20.5 16.5 20.5 11.5V7L12 2Z" /><path d="M9 12L11 14L15 10" />

<!-- Arrow Up -->
<path d="M7 14l5-5 5 5" />

<!-- Add your own SVG paths -->
```

## 📚 References

- **Design System**: Uses existing Alepo CSS variables
- **WordPress Integration**: Block patterns and Gutenberg ready
- **Accessibility**: WCAG compliant animations and interactions
- **Performance**: Optimized for 60fps animations

---

**🎯 Ready to use! Start with the block patterns for quick implementation, then customize as needed.**