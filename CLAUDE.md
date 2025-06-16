# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

# Claude Code Instructions: Alepo Website Generation
*Creative content generation and WordPress integration*

## Overview for Claude Code

You will generate unique, customized content for each of the 47 Alepo website pages. Each page should be crafted with creativity, personality, and specific details while maintaining brand consistency. Pages will be generated as HTML/content files and then pushed to WordPress. Reference documents in `alepo-docs/` folder for company information and guidelines.

## Project Context

### Current Project Structure
```
/mnt/d/Website Works/alepo-new-website-project/
├── alepo-docs/                    # Documentation and reference files
├── wp-content/themes/alepo-theme/ # WordPress theme location
├── alepo-generated-content/       # Generated content for WordPress
├── tools/                         # Development and maintenance tools
└── CLAUDE.md                      # This file
```

### Key Reference Documents
- `alepo-docs/alepo_website_structure.md` - Complete website architecture and page structure
- `alepo-docs/alepo_company_profile.md` - Company information, products, and content source
- `alepo-docs/design-system.md` - Design tokens and visual guidelines
- `alepo-docs/content-guidelines.md` - Writing style and brand voice

---

## Generation Approach - Creative Content, Not Templates

### Key Principles
1. **Each page is unique** - No two pages should feel templated or generic
2. **Creative storytelling** - Use engaging narratives, metaphors, and industry-specific language
3. **Custom design elements** - Suggest unique layouts, interactive elements, and visual concepts for each page
4. **Brand personality** - Let Alepo's expertise and innovation shine through varied content approaches
5. **SEO without compromise** - Optimize for search while maintaining engaging, human-centric content

### Folder Structure for Generated Content

```
alepo-generated-content/
├── 01-page-content/
│   ├── homepage/
│   │   ├── content.html
│   │   ├── metadata.json
│   │   └── design-notes.md
│   ├── products/
│   │   ├── aaa-solutions/
│   │   ├── digital-bss/
│   │   ├── bss-now/
│   │   ├── ai-customer-assistant/
│   │   └── ai-agent-assistant/
│   ├── solutions/
│   │   └── [15 solution folders]
│   ├── industries/
│   │   └── [6 industry folders]
│   └── company/
│       └── [company page folders]
├── 02-wordpress-integration/
│   ├── import-scripts/
│   ├── page-mapping.json
│   └── acf-field-data/
└── 03-assets/
    ├── image-specs/
    ├── interactive-elements/
    └── custom-scripts/
```

---

## Page Content Generation Guidelines

### Creative Content Structure
Each page folder should contain:

#### 1. content.html - The main page content
```html
<!-- Example structure - each page should be unique -->
<section class="hero-section" data-animation="fade-in">
  <div class="container">
    <h1>Creative, Engaging Headline Specific to This Page</h1>
    <p class="lead">Compelling subheadline that tells a story</p>
    <!-- Unique hero elements per page -->
  </div>
</section>

<section class="content-section">
  <!-- Rich, varied content with:
    - Storytelling elements
    - Industry-specific scenarios
    - Interactive components
    - Visual suggestions
    - Customer success stories
    - Technical depth where appropriate
  -->
</section>
```

#### 2. metadata.json - SEO and WordPress integration data
```json
{
  "title": "Page Title - Unique and Compelling",
  "slug": "url-slug",
  "meta_description": "150-155 character description that compels clicks",
  "primary_keyword": "main keyword",
  "secondary_keywords": ["keyword1", "keyword2", "keyword3"],
  "schema_type": "Product|Service|Organization|Article",
  "acf_fields": {
    "hero_style": "video-background|animated-graphics|split-screen|etc",
    "cta_primary": {
      "text": "Action-oriented CTA",
      "url": "/contact",
      "style": "primary"
    }
  },
  "internal_links": [
    {
      "context": "When discussing authentication needs",
      "target_page": "product-aaa-solutions",
      "anchor_text": "comprehensive AAA solution"
    }
  ]
}
```

#### 3. design-notes.md - Creative direction for developers
```markdown
# Design Notes: [Page Name]

## Visual Concept
[Unique visual theme for this page]

## Interactive Elements
- [Specific animations or interactions]
- [Data visualizations]
- [User engagement features]

## Content Highlights
- [Key differentiators to emphasize]
- [Unique value propositions]
- [Customer proof points]

## Technical Considerations
- [Any special functionality needed]
- [Performance optimizations]
- [Accessibility notes]
```

### custom-post-types/ folder
Create these files with structured data:

#### products.json
```json
[
  {
    "title": "AAA Authentication Server",
    "slug": "aaa-authentication-server",
    "content": "Full product description from company profile",
    "acf_fields": {
      "product_icon": "🔐",
      "product_category": "aaa",
      "key_features": [
        "RADIUS/Diameter Support",
        "5G & WiFi Authentication", 
        "Policy Control",
        "Security & Fraud Management"
      ],
      "technical_specs": "Detailed specs from company profile",
      "performance_metrics": [
        {"metric": "99.999%", "label": "Uptime"},
        {"metric": "36,000", "label": "TPS"}
      ],
      "pricing_info": "Contact Sales",
      "deployment_options": ["On-premises", "Private Cloud", "Public Cloud"],
      "integration_apis": ["REST", "SOAP", "RADIUS", "Diameter"]
    }
  }
]
```

#### solutions.json, industries.json, case-studies.json
[Follow same structured format]

### media-assets/ folder
Create specification files for all required assets:

#### image-requirements.json
```json
{
  "hero_images": [
    {
      "page": "homepage",
      "filename": "alepo-hero-digital-transformation.jpg",
      "alt_text": "Alepo digital transformation solutions",
      "dimensions": "1920x1080",
      "description": "Three pillars visualization with modern telecom imagery"
    }
  ],
  "product_screenshots": [...],
  "customer_logos": [...],
  "icon_library": [...]
}
```

### navigation/ folder

#### primary-menu.json
```json
{
  "menu_structure": [
    {
      "title": "Solutions",
      "type": "mega_menu",
      "submenu": {
        "columns": 4,
        "sections": [
          {
            "title": "By Challenge",
            "icon": "🔄",
            "items": [
              {
                "title": "Modernize Network Infrastructure",
                "items": [
                  {"title": "Legacy AAA Replacement", "url": "/solutions/legacy-aaa-replacement"},
                  {"title": "5G Network Evolution", "url": "/solutions/5g-network-evolution"}
                ]
              }
            ]
          }
        ]
      }
    }
  ]
}
```

---

## 02-wordpress-theme/ Instructions

### alepo-theme/ folder structure:
```
alepo-theme/
├── style.css
├── functions.php
├── index.php
├── front-page.php
├── page-templates/
│   ├── page-product.php
│   ├── page-solution.php
│   ├── page-industry.php
│   └── page-landing.php
├── template-parts/
│   ├── hero/
│   ├── content/
│   ├── cta/
│   └── navigation/
├── inc/
│   ├── custom-post-types.php
│   ├── acf-fields.php
│   ├── enqueue-scripts.php
│   └── seo-functions.php
└── assets/
    ├── css/
    ├── js/
    └── images/
```

#### functions.php content requirements:
```php
<?php
/**
 * Alepo Theme Functions
 * Page Builder Agnostic WordPress Theme
 */

// Theme setup
function alepo_theme_setup() {
    // Add theme supports
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form', 'comment-form'));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'alepo'),
        'utility' => __('Utility Menu', 'alepo'),
        'footer' => __('Footer Menu', 'alepo')
    ));
    
    // Content width
    $GLOBALS['content_width'] = 1200;
}
add_action('after_setup_theme', 'alepo_theme_setup');

// Include all theme components
require get_template_directory() . '/inc/custom-post-types.php';
require get_template_directory() . '/inc/acf-fields.php';
require get_template_directory() . '/inc/enqueue-scripts.php';
require get_template_directory() . '/inc/seo-functions.php';
```

#### Page template consistency requirements:
Each page template must include:
1. **Consistent header structure** with breadcrumbs
2. **Hero section** with page-specific content
3. **Main content area** with proper spacing
4. **CTA sections** at logical intervals
5. **Related content** section
6. **Footer integration** points

---

## WordPress Integration Approach

### Content Import Strategy

Instead of using templated scripts, we'll push Claude-generated content to WordPress:

#### 1. import-generated-content.php
```php
<?php
/**
 * Import Claude-generated content to WordPress
 * Preserves unique content while setting up WordPress structure
 */

function alepo_import_claude_content($content_dir) {
    $pages = alepo_scan_content_directory($content_dir);
    
    foreach ($pages as $page_path) {
        $content = file_get_contents($page_path . '/content.html');
        $metadata = json_decode(file_get_contents($page_path . '/metadata.json'), true);
        
        // Create/update WordPress page
        $page_id = alepo_create_or_update_page([
            'post_title' => $metadata['title'],
            'post_content' => $content,
            'post_name' => $metadata['slug'],
            'post_status' => 'publish',
            'meta_input' => [
                '_yoast_wpseo_metadesc' => $metadata['meta_description'],
                '_yoast_wpseo_focuskw' => $metadata['primary_keyword']
            ]
        ]);
        
        // Set ACF fields
        if (function_exists('update_field')) {
            foreach ($metadata['acf_fields'] as $field => $value) {
                update_field($field, $value, $page_id);
            }
        }
        
        echo "✅ Imported: {$metadata['title']} (ID: {$page_id})\n";
    }
}
```

#### 2. preserve-customization.php
```php
<?php
/**
 * Ensures Claude's creative content is preserved
 * Prevents overwriting of custom designs
 */

function alepo_preserve_custom_content($page_id, $new_content) {
    // Store revision for rollback
    wp_save_post_revision($page_id);
    
    // Preserve custom blocks and shortcodes
    $content = alepo_merge_custom_elements($new_content);
    
    // Update with preservation flags
    wp_update_post([
        'ID' => $page_id,
        'post_content' => $content,
        'meta_input' => [
            '_alepo_custom_generated' => true,
            '_alepo_generation_date' => current_time('mysql')
        ]
    ]);
}
```

---

## CTA Consistency Requirements

### CTA Templates by Page Type

#### Product Pages:
- **Primary CTA**: "Request [Product] Demo" / "Get [Product] Pricing"
- **Secondary CTA**: "Download [Product] Datasheet" / "Watch Demo Video"
- **Placement**: After hero, after benefits, at page end

#### Solution Pages:
- **Primary CTA**: "Explore [Solution] Approach" / "Schedule Consultation"
- **Secondary CTA**: "Download Solution Guide" / "View Case Study"
- **Placement**: After challenge description, at page end

#### Industry Pages:
- **Primary CTA**: "See [Industry] Solutions" / "Contact Industry Expert"
- **Secondary CTA**: "Download Industry Report" / "View Customer Stories"
- **Placement**: After industry overview, at page end

### CTA Styling Standards:
```css
.cta-primary {
    background: var(--primary-blue);
    color: white;
    padding: 16px 32px;
    border-radius: 4px;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
}

.cta-secondary {
    background: transparent;
    color: var(--primary-blue);
    border: 2px solid var(--primary-blue);
    padding: 14px 30px;
    border-radius: 4px;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
}
```

---

## Content Consistency Requirements

### Page Structure Template
Every page must follow this structure:

1. **Page Header** (breadcrumbs, page title)
2. **Hero Section** (page-specific hero content)
3. **Main Content** (3-5 sections with H2 headings)
4. **Mid-page CTA** (relevant to page content)
5. **Supporting Content** (2-3 additional sections)
6. **Related Resources** (internal links, downloads)
7. **Final CTA Section** (conversion-focused)
8. **Page Footer** (next steps, contact info)

### Content Quality Standards
- **Word Count**: Minimum per page type (homepage: 3000+, products: 1500+, solutions: 1000+)
- **Headings**: Proper H1-H6 hierarchy with keywords
- **Internal Links**: Minimum 3-5 relevant internal links per page
- **External Links**: 1-2 authoritative external references where appropriate
- **CTAs**: 2-3 strategically placed calls-to-action per page
- **Keywords**: Primary keyword in H1, secondary keywords in H2s

### Brand Voice Consistency
Every content piece must include:
- **Authoritative tone** with telecom expertise
- **Specific metrics** and quantified benefits
- **Customer success references** where relevant
- **Future-ready messaging** (5G, AI, cloud-native)
- **Partnership language** (collaborative, supportive)

---

## Creative Content Examples

### Homepage - Breaking the Mold
Instead of: "Welcome to Alepo, a leading telecom solutions provider"
Create: "When 5G networks demand microsecond decisions, legacy systems become tomorrow's bottlenecks. Alepo transforms how operators evolve."

### Product Pages - Technical Storytelling
Instead of: "Our AAA solution provides authentication, authorization, and accounting"
Create: "Picture 50 million subscribers attempting to connect simultaneously during a major event. Your AAA infrastructure either scales gracefully or becomes the story no operator wants to tell."

### Solution Pages - Problem-First Narratives
Instead of: "We offer 5G network solutions"
Create: "The jump from 4G to 5G isn't an upgrade—it's a metamorphosis. Like asking a freight train to become a fighter jet mid-journey."

### Industry Pages - Sector-Specific Language
Instead of: "Solutions for mobile operators"
Create: "Built by operators, for operators. We've walked in your shoes through 3G sunsets, 4G battles, and now guide you through 5G's promises."

## Content Generation Workflow

1. **Research Phase** - Deep dive into alepo-docs/ for each page
2. **Creative Ideation** - Develop unique angle for each page
3. **Content Creation** - Write rich HTML with personality
4. **Metadata Setup** - SEO and WordPress integration data
5. **Design Documentation** - Visual and interactive concepts
6. **Quality Review** - Ensure uniqueness and brand alignment
7. **WordPress Import** - Push to WordPress preserving creativity

## Success Validation

After generation, verify:
- [ ] All 47 pages have unique, creative content (no templating)
- [ ] Each page tells a distinct story while maintaining brand coherence
- [ ] HTML content is rich with varied structures and elements
- [ ] Metadata files contain proper SEO and WordPress integration data
- [ ] Design notes provide clear creative direction
- [ ] No two pages feel similar in approach or structure
- [ ] Technical accuracy maintained while being engaging
- [ ] Content connects emotionally with target audience
- [ ] WordPress import preserves all creative elements
- [ ] Interactive elements and visual concepts documented

## Key Differentiator

This approach ensures every page is crafted with care and creativity, avoiding the cookie-cutter feel of template-based generation. Each page should feel like it was written by a skilled content strategist who deeply understands both Alepo's technology and their customers' challenges.

---

## Design System from Mega Menu

### Visual Hierarchy
```css
/* Typography Scale */
--font-size-xs: 12px;
--font-size-sm: 14px;
--font-size-base: 16px;
--font-size-lg: 18px;
--font-size-xl: 24px;
--font-size-2xl: 32px;
--font-size-3xl: 40px;

/* Color Palette */
--primary-blue: #0056b3;
--secondary-blue: #004085;
--accent-teal: #17a2b8;
--text-primary: #212529;
--text-secondary: #6c757d;
--background-light: #f8f9fa;
--border-color: #dee2e6;
```

### Mega Menu Structure
The mega menu uses a 4-column grid with categorized sections:
- **By Challenge**: Problem-focused navigation
- **By Solution**: Product-based navigation
- **By Industry**: Vertical-specific navigation
- **Resources**: Supporting content and tools

Each section includes:
- Icon identifier (emoji or SVG)
- Category heading
- Nested item groups
- Descriptive link text

---

## Image Placeholder Format

### Standard Placeholder Syntax
```
[Image: description | dimensions | style]
```

Examples:
- `[Image: Hero banner showing digital transformation | 1920x600 | gradient-overlay]`
- `[Image: Product screenshot of AAA dashboard | 800x600 | shadow-box]`
- `[Image: Customer logo grid | 1200x400 | grayscale]`

### Image Categories and Specifications

#### Hero Images
- Homepage: 1920x1080, abstract telecom visualization
- Product pages: 1920x600, product interface showcase
- Solution pages: 1920x600, challenge-solution visualization
- Industry pages: 1920x600, industry-specific imagery

#### Product Screenshots
- Dashboard views: 1200x800, clean interface capture
- Feature highlights: 800x600, focused UI elements
- Architecture diagrams: 1200x900, technical flowcharts

#### Icons and Graphics
- Feature icons: 64x64, line art style
- Process diagrams: 1200x600, step-by-step visuals
- Benefit illustrations: 400x400, conceptual graphics

---

## Common Commands and Workflows

### Development Commands
```bash
# WordPress Theme Development
cd /mnt/d/Website\ Works/alepo-new-website-project/wp-content/themes/alepo-theme/
npm install              # Install dependencies
npm run dev             # Start development server
npm run build           # Build for production
npm run lint            # Run code linting
npm run test            # Run theme tests

# Content Generation
php generate-pages.php --type=all        # Generate all page content
php import-content.php --source=markdown  # Import markdown to WordPress
php create-menus.php                      # Set up navigation menus

# Deployment
./deploy.sh staging     # Deploy to staging
./deploy.sh production  # Deploy to production
```

### File Generation Workflow
1. Create directory structure first
2. Generate content files (.md) with front matter
3. Create JSON data structures
4. Build WordPress theme files
5. Generate automation scripts
6. Create deployment configurations

### Content Validation Checklist
```bash
# Run validation scripts
php validate-content.php    # Check all content files
php check-links.php        # Verify internal links
php seo-audit.php          # SEO validation
```

---

## Content Guidelines Summary

### Writing Style
- **Tone**: Professional, authoritative, yet approachable
- **Voice**: Expert consultant, not salesperson
- **Perspective**: Customer-benefit focused
- **Technical Level**: Accessible to business and technical audiences

### SEO Requirements
- **Title Tags**: 50-60 characters with primary keyword
- **Meta Descriptions**: 150-155 characters with call-to-action
- **H1 Tags**: One per page, includes primary keyword
- **URL Structure**: Lowercase, hyphenated, descriptive slugs

### Internal Linking Strategy
- Minimum 3-5 contextual links per page
- Link to related products, solutions, and resources
- Use descriptive anchor text (avoid "click here")
- Create topic clusters around main themes

---

## File Path References

### Documentation Files
```
/mnt/d/Website Works/alepo-new-website-project/alepo-docs/
├── alepo_website_structure.md
├── alepo_company_profile.md
├── design-system.md
├── content-guidelines.md
├── seo-strategy.md
└── deployment-guide.md
```

### Generated Content Locations
```
/mnt/d/Website Works/alepo-new-website-project/
├── alepo-generated-content/
│   ├── 01-page-content/     # HTML content files
│   ├── 02-wordpress-integration/  # Import scripts
│   └── 03-assets/           # Image and media specifications
└── wp-content/themes/alepo-theme/  # WordPress theme files
```

### Automation Scripts
```
/mnt/d/Website Works/alepo-new-website-project/tools/
├── theme-utilities/         # WordPress theme management tools
│   ├── create-claude-pages.php
│   ├── import-claude-content.php
│   └── regenerate-mega-menu.php
├── database/                # Database management
│   └── cleanup-queries.sql
├── maintenance/             # System maintenance scripts
│   ├── fix-structure.sh
│   └── wp-config-debug.txt
└── wordpress-integration/   # WordPress import tools
    └── import-claude-content.php
```

---

## Quick Reference

### Page Types and Templates
- **Homepage**: `front-page.php`
- **Products**: `page-templates/page-product.php`
- **Solutions**: `page-templates/page-solution.php`
- **Industries**: `page-templates/page-industry.php`
- **Company**: `page-templates/page-company.php`
- **Landing**: `page-templates/page-landing.php`

### ACF Field Groups
- `product_details` - Product specifications and features
- `solution_components` - Solution architecture and benefits
- `industry_challenges` - Industry-specific content
- `company_info` - About and team information
- `global_cta` - Call-to-action components

### Content Priorities
1. Homepage and main navigation pages
2. Product pages (5 products)
3. Solution pages (15 solutions)
4. Industry pages (6 industries)
5. Company and support pages

This comprehensive structure ensures consistent, high-quality output across all generated files while maintaining Alepo's brand standards and technical requirements.