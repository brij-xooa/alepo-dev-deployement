# Alepo Design Guide
*Extracted from new-alepo-website-mega-menu.html*

## Table of Contents
1. [Color Palette](#color-palette)
2. [Typography System](#typography-system)
3. [Spacing & Layout](#spacing--layout)
4. [Component Styles](#component-styles)
5. [Animation Patterns](#animation-patterns)
6. [Grid System](#grid-system)
7. [Interactive States](#interactive-states)
8. [Special Effects](#special-effects)
9. [Responsive Design](#responsive-design)
10. [Icons & Visual Elements](#icons--visual-elements)

---

## Color Palette

### Core Brand Colors
```css
:root {
  /* Primary Colors */
  --primary-blue: #0066CC;
  --primary-blue-dark: #0052A3;
  --primary-blue-light: #1976D2;
  
  /* Neutral Colors */
  --dark-gray: #2C3E50;
  --text-gray: #666666;
  --light-gray: #F8F9FA;
  --border-gray: #E0E0E0;
  --white: #FFFFFF;
  
  /* Accent Colors */
  --accent-green: #00C851;
  --accent-blue-light: #42A5F5;
}
```

### Solution Menu Color System
A sophisticated blue monochrome palette for the Solutions mega menu:

```css
/* Background Gradients */
--solution-bg-1: #F8FBFF;
--solution-bg-2: #F0F7FF;
--solution-bg-3: #E8F2FF;
--solution-bg-4: #F5F8FB;

/* Interactive States */
--solution-hover: #E3F2FD;
--solution-card-border: #D6E7FF;
--solution-footer-bg: #E8F2FF;
--solution-footer-accent: #0052A3;
```

### Industry Icon Backgrounds
Gradient color schemes for industry-specific visual elements:

```css
/* Industry Gradients */
--gradient-blue: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%);
--gradient-purple: linear-gradient(135deg, #F3E5F5 0%, #E1BEE7 100%);
--gradient-green: linear-gradient(135deg, #E8F5E9 0%, #C8E6C9 100%);
--gradient-orange: linear-gradient(135deg, #FFF3E0 0%, #FFE0B2 100%);
--gradient-pink: linear-gradient(135deg, #FCE4EC 0%, #F8BBD0 100%);
--gradient-teal: linear-gradient(135deg, #E0F2F1 0%, #B2DFDB 100%);
```

### Card & Button Gradients
```css
/* Button Gradients */
--gradient-primary: linear-gradient(135deg, #0066CC 0%, #0052A3 100%);
--gradient-secondary: linear-gradient(135deg, #0052A3 0%, #1976D2 100%);
--gradient-tertiary: linear-gradient(135deg, #1976D2 0%, #42A5F5 100%);

/* Background Gradient */
--gradient-light: linear-gradient(135deg, #F5F7FA 0%, #E8F2FF 50%, #F0F4F8 100%);
```

---

## Typography System

### Font Stack
```css
--font-primary: -apple-system, BlinkMacSystemFont, 'Inter', 'Helvetica Neue', sans-serif;
--font-mono: 'SF Mono', 'Monaco', 'Inconsolata', 'Fira Code', monospace;
```

### Type Scale
```css
/* Display */
--font-size-hero: 48px;
--font-size-display: 32px;
--font-size-logo: 28px;

/* Headings */
--font-size-h1: 32px;
--font-size-h2: 24px;
--font-size-h3: 20px;
--font-size-h4: 18px;
--font-size-h5: 16px;
--font-size-h6: 14px;

/* Body */
--font-size-large: 20px;
--font-size-body: 16px;
--font-size-small: 14px;
--font-size-tiny: 13px;
--font-size-micro: 12px;

/* Navigation */
--font-size-nav: 15px;
--font-size-mega-menu: 14px;
```

### Font Weights
```css
--font-weight-regular: 400;
--font-weight-medium: 500;
--font-weight-semibold: 600;
--font-weight-bold: 700;
```

### Line Heights
```css
--line-height-tight: 1.2;   /* Headings */
--line-height-snug: 1.4;    /* Descriptions */
--line-height-normal: 1.6;  /* Body text */
--line-height-relaxed: 1.8; /* Paragraphs */
```

### Letter Spacing
```css
--letter-spacing-tight: -0.02em;  /* Large headings */
--letter-spacing-normal: 0;        /* Body text */
--letter-spacing-wide: 0.05em;    /* Uppercase labels */
```

---

## Spacing & Layout

### Spacing Scale
Based on an 8px grid system:

```css
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
```

### Container Widths
```css
--container-max: 1440px;
--container-mega-menu: 1200px;
--container-content: 1140px;
--container-narrow: 768px;
```

### Component Spacing

#### Navigation
- **Height**: 72px
- **Padding**: 0 24px
- **Link spacing**: 32px gap
- **Link padding**: 24px 8px

#### Cards
- **Padding**: 24px (small), 32px (medium)
- **Gap between cards**: 20px (mobile), 32px (desktop)
- **Border radius**: 8px (small), 12px (large)

#### Buttons
- **Small**: 8px 18px
- **Medium**: 12px 24px
- **Large**: 16px 32px
- **Border radius**: 4px

#### Sections
- **Hero padding**: 80px 0
- **Section padding**: 48px 0
- **Content gap**: 24px

---

## Component Styles

### Navigation Bar
```css
.navigation {
  height: 72px;
  background: white;
  box-shadow: 0 2px 4px rgba(0,0,0,0.08);
  position: sticky;
  top: 0;
  z-index: 1000;
}
```

### Buttons

#### Primary Button
```css
.btn-primary {
  background: #0066CC;
  color: white;
  padding: 16px 32px;
  border-radius: 4px;
  font-weight: 600;
  font-size: 16px;
  border: 2px solid #0066CC;
  transition: all 0.2s ease;
}

.btn-primary:hover {
  background: #0052A3;
  transform: translateY(-2px);
  box-shadow: 0 8px 16px rgba(0,102,204,0.2);
}
```

#### Secondary Button
```css
.btn-secondary {
  background: transparent;
  color: #0066CC;
  padding: 14px 30px;
  border-radius: 4px;
  font-weight: 600;
  font-size: 16px;
  border: 2px solid #0066CC;
  transition: all 0.2s ease;
}

.btn-secondary:hover {
  background: #0066CC;
  color: white;
  transform: translateY(-2px);
}
```

### Cards

#### Basic Card
```css
.card {
  background: white;
  border-radius: 8px;
  padding: 24px;
  box-shadow: 0 2px 8px rgba(0, 66, 204, 0.08);
  transition: all 0.3s ease;
}

.card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 24px rgba(0, 66, 204, 0.12);
}
```

#### Solution Card
```css
.solution-card {
  background: white;
  border: 1px solid #D6E7FF;
  border-radius: 12px;
  padding: 32px;
  transition: all 0.3s ease;
}

.solution-card:hover {
  background: #F8FBFF;
  border-color: #0066CC;
  transform: translateY(-6px);
  box-shadow: 0 12px 24px rgba(0, 66, 204, 0.12);
}
```

### Mega Menu
```css
.mega-menu {
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  background: white;
  border-radius: 8px;
  box-shadow: 0 8px 32px rgba(0,0,0,0.12);
  margin-top: 8px;
  opacity: 0;
  transform: translateY(-10px);
  transition: all 0.3s ease;
  z-index: 999;
}

.mega-menu.active {
  opacity: 1;
  transform: translateY(0);
}
```

---

## Animation Patterns

### Transition Durations
```css
--transition-fast: 0.2s;    /* Buttons, links */
--transition-medium: 0.3s;  /* Cards, menus */
--transition-slow: 0.6s;    /* Ripple effects */
```

### Common Animations

#### Hover Lift
```css
.hover-lift {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-lift:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 24px rgba(0, 66, 204, 0.12);
}
```

#### Scale Animation
```css
.scale-animation {
  transition: transform 0.2s ease;
}

.scale-animation:hover {
  transform: scale(1.05);
}
```

#### Underline Animation
```css
.underline-animation::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 3px;
  background: #0066CC;
  transform: scaleX(0);
  transition: transform 0.3s ease;
}

.underline-animation:hover::after {
  transform: scaleX(1);
}
```

#### Ripple Effect
```css
.ripple::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 0;
  height: 0;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 50%;
  transform: translate(-50%, -50%);
  transition: width 0.6s, height 0.6s;
}

.ripple:hover::before {
  width: 300%;
  height: 300%;
}
```

---

## Grid System

### Grid Layouts

#### Solutions Grid (4 columns)
```css
.solutions-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 32px;
}

@media (max-width: 1024px) {
  .solutions-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
  }
}
```

#### Products Grid (3 columns)
```css
.products-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 32px;
}
```

#### Industries Grid (6 columns)
```css
.industries-grid {
  display: grid;
  grid-template-columns: repeat(6, 1fr);
  gap: 20px;
}
```

#### Resources Grid (Asymmetric)
```css
.resources-grid {
  display: grid;
  grid-template-columns: 1fr 1fr 1.5fr;
  gap: 48px;
}
```

---

## Interactive States

### Link States
```css
a {
  color: #0066CC;
  text-decoration: none;
  transition: color 0.2s ease;
}

a:hover {
  color: #0052A3;
}

a:active {
  color: #003D7A;
}
```

### Form Elements
```css
input, textarea, select {
  border: 1px solid #E0E0E0;
  border-radius: 4px;
  padding: 12px 16px;
  font-size: 16px;
  transition: border-color 0.2s ease;
}

input:focus, textarea:focus, select:focus {
  outline: none;
  border-color: #0066CC;
  box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
}
```

### Navigation Active State
```css
.nav-link {
  position: relative;
  color: #2C3E50;
  font-weight: 500;
  transition: color 0.2s ease;
}

.nav-link:hover,
.nav-link.active {
  color: #0066CC;
}

.nav-link.active::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 3px;
  background: #0066CC;
}
```

---

## Special Effects

### Glass Morphism
```css
.glass-effect {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.18);
}
```

### Gradient Overlays
```css
.gradient-overlay::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(135deg, rgba(0, 102, 204, 0.9) 0%, rgba(0, 82, 163, 0.9) 100%);
  z-index: 1;
}
```

### Shadow System
```css
/* Elevation Levels */
--shadow-sm: 0 2px 4px rgba(0,0,0,0.08);
--shadow-md: 0 4px 8px rgba(0,0,0,0.1);
--shadow-lg: 0 8px 16px rgba(0,0,0,0.12);
--shadow-xl: 0 16px 32px rgba(0,0,0,0.16);

/* Colored Shadows */
--shadow-blue: 0 8px 24px rgba(0, 102, 204, 0.12);
--shadow-blue-lg: 0 16px 48px rgba(0, 102, 204, 0.16);
```

---

## Responsive Design

### Breakpoints
```css
/* Mobile First Approach */
--breakpoint-sm: 640px;
--breakpoint-md: 768px;
--breakpoint-lg: 1024px;
--breakpoint-xl: 1280px;
--breakpoint-2xl: 1440px;
```

### Mobile Adaptations

#### Typography Scaling
```css
@media (max-width: 768px) {
  :root {
    --font-size-hero: 32px;
    --font-size-display: 24px;
    --font-size-h1: 24px;
    --font-size-h2: 20px;
    --font-size-body: 14px;
  }
}
```

#### Spacing Adjustments
```css
@media (max-width: 768px) {
  :root {
    --space-section: 40px;
    --space-component: 24px;
    --container-padding: 16px;
  }
}
```

#### Layout Changes
- Navigation: Hamburger menu with slide-out drawer
- Grid columns: Reduced to 1-2 columns
- Cards: Full width with reduced padding
- Buttons: Full width on mobile
- Mega menu: Full screen overlay

---

## Icons & Visual Elements

### Icon System
The design uses emoji icons for visual consistency:

#### Navigation Icons
- Dropdown: ▼
- Menu: ☰
- Close: ✕

#### Category Icons
- Solutions: 🔄 🏗️ 💰 🌟 ⭐ 🚀
- Products: 🔐 💼 🤖
- Industries: 📱 🌐 📡 🚀 🏢 🏛️
- Resources: 📚 🛠️ 📅 📰 📧
- Features: ✓
- Direction: →

### Icon Styling
```css
.icon {
  font-size: 24px;
  line-height: 1;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}

.icon-badge {
  width: 48px;
  height: 48px;
  border-radius: 12px;
  background: var(--gradient-blue);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
}
```

---

## Accessibility Guidelines

### Focus States
```css
:focus-visible {
  outline: 3px solid #0066CC;
  outline-offset: 2px;
}
```

### Color Contrast
- Text on white: #2C3E50 (AAA compliant)
- Text on blue: #FFFFFF (AA compliant)
- Secondary text: #666666 (AA compliant)

### Interactive Targets
- Minimum touch target: 44x44px
- Link padding: 8px minimum
- Button height: 40px minimum

### ARIA Support
- Use semantic HTML elements
- Add ARIA labels for icons
- Include skip navigation links
- Ensure keyboard navigation works

---

## Implementation Notes

1. **CSS Variables**: Define all values as CSS custom properties for easy theming
2. **Component Classes**: Use BEM methodology for maintainable CSS
3. **Performance**: Optimize animations with `will-change` and GPU acceleration
4. **Browser Support**: Test across modern browsers and provide fallbacks
5. **Dark Mode**: Consider implementing with CSS variables and media queries

This design guide provides a comprehensive foundation for implementing the Alepo website with consistency and professionalism across all pages and components.