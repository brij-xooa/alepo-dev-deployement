# Alepo Website Consistency Guide

## How This System Achieves Consistency at Scale

### 1. **Template-Based Architecture**

Every page type follows a predefined template structure:
- **Products**: Hero → Challenge → Features → Technical → ROI → Testimonial → CTA
- **Solutions**: Hero → Challenge → Approach → Benefits → Implementation → Proof → CTA
- **Industries**: Hero → Context → Challenges → Solutions → Success Stories → CTA

### 2. **Reusable Block Components**

Instead of unique HTML per page, we use:
```
Block Library/
├── hero-blocks/
│   ├── product-hero.json      # Consistent hero for all products
│   ├── solution-hero.json     # Consistent hero for all solutions
│   └── industry-hero.json     # Consistent hero for all industries
├── content-blocks/
│   ├── challenge-grid.json    # Reusable challenge presentation
│   ├── feature-showcase.json  # Standard feature display
│   └── methodology-steps.json # Consistent process visualization
└── cta-blocks/
    └── final-cta.json        # Unified CTA approach
```

### 3. **Content-Template Binding**

AI-generated content follows strict mapping rules:
```json
{
  "content": {
    "headline": "Maps to → {{productHeadline}}",
    "subheadline": "Maps to → {{productSubheadline}}",
    "features": "Maps to → {{productFeatures}}"
  }
}
```

### 4. **Consistency Enforcement Points**

#### a) **Visual Consistency**
- All heroes use the same gradient styles
- Consistent spacing variables (--spacing-40, --spacing-60)
- Unified typography scale
- Standard button styles

#### b) **Structural Consistency**
- Fixed section order per template
- Required vs. optional sections defined
- Consistent heading hierarchy (H1 → H2 → H3)
- Standard breadcrumb navigation

#### c) **Content Consistency**
- CTA patterns per page type
- Headline formulas
- Stats presentation format
- Internal linking patterns

### 5. **The Enhanced Page Creator Tool**

The new tool ensures consistency by:
1. **Section-based creation**: "Create all solution pages" → All use solution template
2. **Batch operations**: Apply same template to multiple pages
3. **Validation**: Ensures all required sections are present
4. **Preview**: See template application before creation

### 6. **Workflow for Consistency**

```
1. AI generates content following template structure
   ↓
2. Content includes template mapping metadata
   ↓
3. Page creator applies appropriate template
   ↓
4. Gutenberg blocks are generated consistently
   ↓
5. Marketing team edits within template constraints
```

### 7. **Benefits of This Approach**

#### For Development:
- One template update affects all pages in that category
- Predictable DOM structure for styling
- Easier maintenance and debugging
- Consistent performance optimization

#### For Marketing:
- Familiar editing experience across pages
- Can't accidentally break design consistency
- Reusable content patterns
- Predictable user experience

#### For Brand:
- Consistent messaging hierarchy
- Unified visual language
- Predictable user journey
- Professional, cohesive appearance

### 8. **Example: Creating 15 Solution Pages**

Instead of 15 unique designs:
```php
// Old approach: 15 different HTML structures
create_page('5g-evolution', $unique_html_1);
create_page('cloud-migration', $unique_html_2);
// ... 13 more unique structures

// New approach: 1 template, 15 content variations
$solution_template = load_template('solution-template');
foreach ($solutions as $solution) {
    $content = map_content_to_template($solution['content'], $solution_template);
    create_page($solution['slug'], $content);
}
```

### 9. **Maintaining Creative Flexibility**

While ensuring consistency, the system allows:
- **Content Variety**: Each page has unique narratives, examples, and messaging
- **Optional Sections**: Include/exclude sections based on content needs
- **Variation Points**: Hero styles, visualization types, CTA messaging
- **Dynamic Elements**: Stats, testimonials, case studies remain unique

### 10. **Quality Assurance**

The system includes validation for:
- ✓ All required sections present
- ✓ Gutenberg block syntax valid
- ✓ SEO requirements met
- ✓ Internal linking patterns followed
- ✓ Brand terminology consistent
- ✓ Accessibility standards maintained

## Implementation Checklist

- [ ] Templates created for all page types
- [ ] Block library components defined
- [ ] Content mapping rules documented
- [ ] Page creator tool deployed
- [ ] AI content generation guidelines updated
- [ ] Marketing team trained on Spectra editing
- [ ] Validation scripts in place
- [ ] Documentation complete

## Next Steps

1. **Test with pilot pages**: Create 2-3 pages per template
2. **Refine templates**: Based on feedback and testing
3. **Scale creation**: Use batch operations for all pages
4. **Monitor consistency**: Regular audits and updates
5. **Iterate**: Continuous improvement based on usage

This system ensures every Alepo page maintains brand consistency while allowing for creative, engaging content that speaks to specific audiences and use cases.