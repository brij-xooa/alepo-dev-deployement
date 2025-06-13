### **Prompt Objective**
Generate **responsive**, **accessible**, and **semantic HTML** for a complete WordPress page. The output must be **fully editable within the Gutenberg block editor**, prioritize **Spectra plugin compatibility**, and support **modular block reuse, structured data, and dynamic content integration**.

---

### **Key Requirements**

#### 1. **Semantic and Accessible HTML Structure**
- Use semantic tags: `<main>`, `<section>`, `<article>`, `<header>`, `<footer>`, `<nav>`, `<aside>`, `<h1>`-`<h6>`, `<p>`, `<ul>`, `<li>`, `<figure>`, `<figcaption>`.
- Include **WCAG-compliant accessibility features**:
  - Use `alt` attributes for images.
  - Add relevant ARIA roles (`role="main"`, `aria-labelledby`, etc.).
  - **Never use raw HTML form elements** - Use Gutenberg form blocks (wp:button with links) or contact form plugins compatible with Spectra
  - For email capture: Use wp:button linking to dedicated signup pages
  - For search: Use wp:search block
  - For contact: Use contact form plugins that render as Gutenberg blocks

#### 2. **Gutenberg & Spectra Block Comments**
Wrap each content block with appropriate Gutenberg block comments:
```html
<!-- wp:paragraph -->
<p>Your editable paragraph text here.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Your Editable Headline Here</h2>
<!-- /wp:heading -->
```
Use valid block names such as:
- `paragraph`, `heading`, `image`, `button`, `columns`, `column`, `list`, `quote`, `cover`, `group`

#### 3. **Modular Layouts with Flexbox-Friendly Containers**
Use nested Flexbox containers (Spectra's preference) via:
```html
<!-- wp:columns -->
<div class="wp-block-columns">
  <!-- wp:column -->
  <div class="wp-block-column">
    <!-- wp:heading -->
    <h3>Left Column Heading</h3>
    <!-- /wp:heading -->
  </div>
  <!-- /wp:column -->
</div>
<!-- /wp:columns -->
```
Avoid CSS Grid (not supported natively by Spectra).

#### 4. **Drag-and-Drop Friendly Images**
Use the following structure:
```html
<!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large">
  <img decoding="async" src="placeholder.jpg" alt="Descriptive Alt Text" class="wp-image-0" />
</figure>
<!-- /wp:image -->
```
- Always include `alt` text.
- Use class `wp-image-0` or incrementing ID for WordPress editor recognition.

#### 5. **Structured Data (Schema Markup)**
Where applicable, include JSON-LD blocks for:
- FAQ, How-To, Product, Review
Example:
```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "What is Spectra?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Spectra is a block-based design plugin for Gutenberg."
      }
    }
  ]
}
</script>
```

#### 6. **Dynamic Content Tags / Placeholders**
Use curly braces to mark content for dynamic population by Spectra or ACF:
```html
<p>{{post_title}}</p>
<p>{{acf_event_date}}</p>
```
Supported placeholders:
- `{{post_title}}`, `{{post_author}}`, `{{acf_FIELD_NAME}}`, `{{custom_taxonomy}}`

#### 7. **CSS and Class Naming Guidelines**
- **Gutenberg-required inline styles are MANDATORY** for validation (gradients, typography, spacing)
- **Avoid unnecessary inline styles** outside of WordPress block requirements
- Use WordPress-generated classes (e.g., `has-white-background-color`, `wp-container-core-buttons-is-layout-*`) when required
- Add custom theme-consistent class names only as supplementary (e.g., `hero-section`, `cta-button`)
- Prioritize validation over clean code: WordPress classes > Custom classes

#### 8. **Iterative Prompt Guidance**
Recommend double-checks for assurance:
```text
Review the output for:
- Nested <div> overuse
- Unused or redundant CSS
- Missing accessibility labels
- Overly generic alt text or heading levels
Refine output accordingly.
```

---

### **🎯 Development Priority Hierarchy**

When conflicts arise, follow this priority order:
1. **Gutenberg Validation** (prevents editor errors)
2. **Accessibility Compliance** (WCAG standards)
3. **Spectra Compatibility** (non-technical editing)
4. **Clean Code Practices** (maintainability)

**Example**: WordPress requires `has-white-background-color` class for validation, even if it's not "clean" naming.

---

### **🎯 Critical Gutenberg Compatibility Guidelines**

**IMPORTANT**: The following guidelines are MANDATORY to prevent "Block contains unexpected or invalid content" errors in the WordPress Gutenberg editor.

#### 9. **Gradient Definitions**
❌ **Never use both `gradient` and `customGradient` together:**
```html
<!-- WRONG -->
<!-- wp:cover {"gradient":"ocean-blue","customGradient":"linear-gradient(...)"} -->

<!-- CORRECT -->
<!-- wp:cover {"customGradient":"linear-gradient(135deg,rgb(49,138,255) 0%,rgb(70,151,160) 100%)"} -->
```

✅ **Always add inline gradient styles to background spans:**
```html
<span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim has-background-gradient" style="background:linear-gradient(135deg,rgb(49,138,255) 0%,rgb(70,151,160) 100%)"></span>
```

#### 10. **Custom HTML Elements**
❌ **Never add custom HTML elements outside Gutenberg block structure:**
```html
<!-- WRONG -->
<div class="wp-block-cover">
    <span class="wp-block-cover__background"></span>
    <div class="hero-bg-animation"></div> <!-- Custom element breaks validation -->
    <div class="wp-block-cover__inner-container">
```

✅ **Keep only standard Gutenberg structure**

#### 11. **CSS Functions in Inline Styles**
❌ **Avoid CSS clamp() functions in block attributes:**
```html
<!-- WRONG -->
"typography":{"fontSize":"clamp(2rem, 4vw + 1rem, 3rem)"}

<!-- CORRECT -->
"typography":{"fontSize":"3rem"}
```

#### 12. **Gutenberg Blocks Only**
❌ **Never use raw HTML elements or shortcodes:**
```html
<!-- WRONG - Raw HTML -->
<!-- wp:html -->
<input type="email" class="newsletter-input" placeholder="Enter your email">
<!-- /wp:html -->

<!-- WRONG - Shortcodes -->
[contact-form-7 id="123"]
```

✅ **Use only Gutenberg blocks for non-technical editing:**
```html
<!-- Email capture via button link -->
<!-- wp:button -->
<div class="wp-block-button">
    <a class="wp-block-button__link" href="/newsletter-signup">Subscribe to Newsletter</a>
</div>
<!-- /wp:button -->

<!-- Contact forms via block-based plugins -->
<!-- wp:contact-form/form -->
<!-- (Use contact form plugins that provide Gutenberg blocks) -->
```

#### 13. **Button Block HTML Classes**
**Critical: HTML classes must match block attributes exactly!**

For `backgroundColor:"white"`:
```html
<!-- Must include: has-white-background-color -->
<a class="wp-block-button__link has-white-background-color has-text-color has-background">
```

For custom `typography:{"fontSize":"1.125rem"}`:
```html
<!-- Must include: has-custom-font-size -->
<a class="wp-block-button__link ... has-custom-font-size">
```

#### 14. **WordPress Layout Classes**
✅ **Include all WordPress-generated layout classes:**
```html
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons is-content-justification-center is-layout-flex wp-container-core-buttons-is-layout-[id] wp-block-buttons-is-layout-flex">
```

#### 15. **Color Handling Best Practices**
- ✅ Use `backgroundColor` for preset colors when available (e.g., "white", "primary")
- ✅ Use custom `color:{"text":"#hex"}` for brand-specific colors not in presets
- ✅ **Always include both block attributes AND matching HTML classes** for validation
- ❌ Avoid `textColor` presets if they create invisible text (white on white)
- ❌ Don't mix inline `background-color` styles with `backgroundColor` attribute
- **Remember**: Block attributes must exactly match HTML classes for validation

#### 16. **Block Attribute to HTML Mapping**
Ensure perfect mapping between block attributes and HTML:

| Block Attribute | Required HTML Class/Style |
|----------------|-------------------------|
| `backgroundColor:"white"` | `has-white-background-color` class |
| `textColor:"primary"` | `has-primary-color` class |
| `color:{"text":"#hex"}` | Inline `style="color:#hex"` |
| `typography:{"fontSize":"X"}` | `has-custom-font-size` class + inline style |
| `border:{"color":"#hex"}` | `has-border-color` class + inline style |

### **📋 Pre-Flight Checklist for Gutenberg Blocks**

Before saving any Gutenberg content, verify:

1. ✅ No duplicate gradient definitions
2. ✅ No custom HTML elements outside block structure
3. ✅ No CSS functions (clamp, calc) in inline styles
4. ✅ No raw HTML form elements
5. ✅ All color/typography attributes have matching HTML classes
6. ✅ Background spans have inline gradient styles (not just classes)
7. ✅ WordPress layout container classes are present
8. ✅ Button links have all required has-* classes

### **🚨 Common Validation Error Patterns**

If you see "Block contains unexpected or invalid content":
1. Check for missing `has-*` classes (has-custom-font-size, has-background-color-*, etc.)
2. Look for custom HTML elements
3. Verify gradient definitions aren't duplicated
4. Ensure inline styles match block attributes
5. Check that WordPress layout classes are included

**Note**: Always test your generated content in the WordPress Gutenberg editor before finalizing. The editor will immediately show validation errors if any of these guidelines are violated.

---

### **🎨 Spectra Editor Compatibility**

**For non-technical team editing:**
- All content must be standard Gutenberg blocks (wp:paragraph, wp:heading, wp:button, etc.)
- Avoid custom HTML, shortcodes, or code blocks
- Use wp:columns and wp:group for layouts (Spectra's preferred structure)
- Ensure all styling is accessible through Spectra's visual controls
- Test all blocks in Spectra editor before finalizing

**Spectra-Friendly Block Types:**
- ✅ wp:heading, wp:paragraph, wp:image, wp:button
- ✅ wp:columns, wp:column, wp:group, wp:cover
- ✅ wp:list, wp:quote, wp:separator
- ❌ wp:html, wp:shortcode, wp:code
- ❌ Custom blocks that require coding knowledge



