# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

# Claude Code Instructions: Alepo Website Generation
*Comprehensive file generation specifications*

## Overview for Claude Code

You will generate a complete file structure for the Alepo website. Create folders recursively and populate each with specific files as detailed below. Reference documents in `alepo-docs/` folder for all content details.

## Project Context

### Current Project Structure
```
/mnt/d/Website Works/alepo-dryrun/
├── alepo-docs/                    # Documentation and reference files
├── wp-content/themes/alepo-theme/ # WordPress theme location
└── CLAUDE.md                      # This file
```

### Key Reference Documents
- `alepo-docs/alepo_website_structure.md` - Complete website architecture and page structure
- `alepo-docs/alepo_company_profile.md` - Company information, products, and content source
- `alepo-docs/design-system.md` - Design tokens and visual guidelines
- `alepo-docs/content-guidelines.md` - Writing style and brand voice

---

## Root Folder Structure to Create

```
alepo-website-complete/
├── 01-content-generation/
│   ├── pages/
│   ├── custom-post-types/
│   ├── media-assets/
│   └── navigation/
├── 02-wordpress-theme/
│   ├── alepo-theme/
│   └── child-theme/
├── 03-automation-scripts/
│   ├── content-import/
│   ├── page-creation/
│   └── deployment/
├── 04-deployment-config/
│   ├── github-workflows/
│   ├── wp-engine-config/
│   └── environment-setup/
└── 05-documentation/
    ├── implementation-guide.md
    ├── content-strategy.md
    └── deployment-checklist.md
```

---

## 01-content-generation/ Instructions

### pages/ folder
Create individual `.md` files for each of the 47 pages with this exact structure:

#### File naming convention:
```
homepage.md
product-aaa-solutions.md
product-digital-bss.md
product-bss-now.md
product-ai-customer-assistant.md
product-ai-agent-assistant.md
solution-legacy-aaa-replacement.md
solution-5g-network-evolution.md
[continue for all 15 solutions]
industry-mobile-operators.md
[continue for all 6 industries]
company-about-alepo.md
company-leadership-team.md
[continue for all company pages]
```

#### Content template for each .md file:
```markdown
---
page_type: "homepage|product|solution|industry|company"
title: "Exact Page Title"
slug: "url-slug"
meta_description: "150-155 character meta description with primary keyword"
primary_keyword: "main SEO keyword"
secondary_keywords: ["keyword1", "keyword2", "keyword3"]
page_template: "template-name"
acf_fields:
  field_name: "field_value"
internal_links:
  - page: "related-page-slug"
    anchor_text: "link text"
cta_primary:
  text: "Primary CTA Text"
  url: "destination-url"
  style: "button-primary"
cta_secondary:
  text: "Secondary CTA Text"  
  url: "destination-url"
  style: "button-secondary"
---

# Page Title

## Hero Section
[Specific hero content based on page type]

## Main Content Sections
[Structured content sections]

## Call-to-Action Section
[Page-specific CTA with consistent formatting]

## Related Resources
[Internal links and related content]

## SEO Content
[Additional content for SEO and completeness]
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

## 03-automation-scripts/ Instructions

### content-import/ folder

#### import-all-content.php
```php
<?php
/**
 * Complete Alepo Website Content Import
 * Imports all pages, posts, and custom content
 */

function alepo_import_all_content() {
    // Import pages
    alepo_import_pages();
    
    // Import custom post types
    alepo_import_products();
    alepo_import_solutions();
    alepo_import_industries();
    alepo_import_case_studies();
    
    // Set up navigation
    alepo_create_navigation_menus();
    
    // Configure WordPress settings
    alepo_configure_wordpress_settings();
    
    // Set up internal linking
    alepo_create_internal_links();
    
    echo "✅ Alepo website content import complete!\n";
}

function alepo_import_pages() {
    $pages_dir = get_template_directory() . '/content-generation/pages/';
    $page_files = glob($pages_dir . '*.md');
    
    foreach ($page_files as $file) {
        $content = alepo_parse_markdown_file($file);
        $page_id = alepo_create_page_from_content($content);
        alepo_log_import("Page created: {$content['title']} (ID: {$page_id})");
    }
}

// Additional import functions...
```

### page-creation/ folder

#### create-page-structure.php
Generate functions for each page type with consistent structure:

```php
<?php
function alepo_create_product_page($product_data) {
    $content = alepo_build_product_content($product_data);
    
    $page_data = array(
        'post_title' => $product_data['title'],
        'post_content' => $content,
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_name' => $product_data['slug'],
        'page_template' => 'page-templates/page-product.php'
    );
    
    $page_id = wp_insert_post($page_data);
    
    // Add ACF fields
    alepo_populate_product_acf_fields($page_id, $product_data['acf_fields']);
    
    // Add SEO meta
    alepo_add_seo_meta($page_id, $product_data);
    
    return $page_id;
}

function alepo_build_product_content($product_data) {
    $content = '';
    
    // Hero section
    $content .= alepo_build_hero_section($product_data);
    
    // Features section  
    $content .= alepo_build_features_section($product_data['acf_fields']['key_features']);
    
    // Technical specs
    $content .= alepo_build_specs_section($product_data['acf_fields']['technical_specs']);
    
    // Benefits section
    $content .= alepo_build_benefits_section($product_data);
    
    // CTA section
    $content .= alepo_build_cta_section($product_data['cta_primary']);
    
    return $content;
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

## File Generation Execution Order

1. **Create folder structure** (all directories first)
2. **Generate content files** (pages/ folder - all .md files)
3. **Generate structured data** (custom-post-types/ JSON files)
4. **Generate WordPress theme** (alepo-theme/ complete structure)
5. **Generate automation scripts** (page creation and import scripts)
6. **Generate deployment config** (GitHub workflows, WP Engine setup)
7. **Generate documentation** (implementation guides and checklists)

## Success Validation

After generation, verify:
- [ ] All 47 .md content files created with proper front matter
- [ ] JSON data files contain structured, consistent data
- [ ] WordPress theme files include all required functions
- [ ] Automation scripts reference correct file paths
- [ ] CTA consistency maintained across all page types
- [ ] Brand voice consistency in all content
- [ ] Internal linking strategy implemented
- [ ] SEO optimization complete on all pages

This structure ensures Claude Code can work systematically through each folder, generating consistent, professional content that maintains Alepo's brand standards while creating a complete, functional website.

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
cd /mnt/d/Website\ Works/alepo-dryrun/wp-content/themes/alepo-theme/
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
/mnt/d/Website Works/alepo-dryrun/alepo-docs/
├── alepo_website_structure.md
├── alepo_company_profile.md
├── design-system.md
├── content-guidelines.md
├── seo-strategy.md
└── deployment-guide.md
```

### Generated Content Locations
```
/mnt/d/Website Works/alepo-dryrun/
├── 01-content-generation/
│   ├── pages/               # Markdown content files
│   ├── custom-post-types/   # JSON data structures
│   ├── media-assets/        # Image specifications
│   └── navigation/          # Menu configurations
└── wp-content/themes/alepo-theme/  # WordPress theme files
```

### Automation Scripts
```
/mnt/d/Website Works/alepo-dryrun/03-automation-scripts/
├── content-import/
│   ├── import-all-content.php
│   ├── parse-markdown.php
│   └── create-acf-fields.php
├── page-creation/
│   ├── create-page-structure.php
│   ├── generate-templates.php
│   └── populate-content.php
└── deployment/
    ├── deploy.sh
    ├── backup-site.sh
    └── rollback.sh
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