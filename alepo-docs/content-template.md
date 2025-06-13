# Alepo Content Template Guide
*Consistent structure for all page content generation*

## Table of Contents
1. [Universal Page Structure](#universal-page-structure)
2. [Front Matter Template](#front-matter-template)
3. [Content Sections by Page Type](#content-sections-by-page-type)
4. [SEO Content Requirements](#seo-content-requirements)
5. [CTA Patterns](#cta-patterns)
6. [Image Placeholder Standards](#image-placeholder-standards)
7. [Internal Linking Rules](#internal-linking-rules)
8. [Content Length Guidelines](#content-length-guidelines)

---

## Universal Page Structure

Every page follows this 10-section structure:

```markdown
1. Front Matter (metadata)
2. Hero Section
3. Introduction/Overview
4. Main Content Block 1
5. Mid-Page CTA
6. Main Content Block 2
7. Supporting Evidence/Benefits
8. Related Resources
9. Final CTA Section
10. SEO Footer Content
```

---

## Front Matter Template

### Base Template (All Pages)
```yaml
---
# Page Metadata
page_type: "homepage|product|solution|industry|company|resource"
title: "Page Title - Maximum 60 characters"
slug: "url-friendly-slug"
meta_description: "Compelling description with primary keyword - 150-155 characters"
publish_date: "2024-01-15"

# SEO Data
primary_keyword: "main keyword phrase"
secondary_keywords: 
  - "supporting keyword 1"
  - "supporting keyword 2"
  - "supporting keyword 3"
focus_keyphrase: "exact match phrase for SEO"
canonical_url: "/canonical-path"

# Page Configuration
page_template: "template-name"
breadcrumb_parent: "parent-page-slug"
menu_order: 10
exclude_from_search: false

# ACF Fields
acf_fields:
  hero_headline: "Compelling Hero Headline"
  hero_subheadline: "Supporting hero text that expands on the value proposition"
  hero_image: "[Image: Hero visual | 1920x600 | gradient-overlay]"
  hero_cta_primary: "Get Started"
  hero_cta_secondary: "Learn More"
  
# Navigation
internal_links:
  - page: "related-page-1"
    anchor_text: "descriptive link text"
    context: "why this link is relevant"
  - page: "related-page-2"
    anchor_text: "another descriptive link"
    context: "connection to current content"

# CTAs
cta_primary:
  text: "Primary Action Text"
  url: "/destination-url"
  style: "button-primary"
  placement: ["hero", "mid-page", "footer"]
  
cta_secondary:
  text: "Secondary Action Text"
  url: "/destination-url"
  style: "button-secondary"
  placement: ["hero", "footer"]

# Schema Markup
schema_type: "Product|Service|Organization|FAQPage"
schema_properties:
  name: "Item Name"
  description: "Item Description"
  brand: "Alepo"
---
```

### Page-Specific Front Matter Extensions

#### Product Pages
```yaml
# Product-Specific Fields
product_data:
  product_name: "Full Product Name"
  product_category: "aaa|bss|ai"
  product_icon: "🔐"
  pricing_model: "subscription|perpetual|custom"
  deployment_options: ["on-premises", "cloud", "hybrid"]
  
technical_specs:
  supported_protocols: ["RADIUS", "Diameter", "REST"]
  performance_metrics:
    - metric: "99.999%"
      label: "Uptime SLA"
    - metric: "36,000"
      label: "Transactions/Second"
  integration_apis: ["REST", "SOAP", "GraphQL"]
  
key_features:
  - title: "Feature Name"
    description: "Feature benefit description"
    icon: "✓"
```

#### Solution Pages
```yaml
# Solution-Specific Fields
solution_data:
  challenge_addressed: "Primary business challenge"
  target_audience: ["CSPs", "MVNOs", "ISPs"]
  implementation_time: "6-8 weeks"
  roi_metrics:
    - metric: "50%"
      description: "Reduction in operational costs"
    - metric: "3x"
      description: "Faster time to market"
      
solution_components:
  - product: "product-slug"
    role: "How this product contributes"
  - product: "another-product"
    role: "Additional component role"
```

#### Industry Pages
```yaml
# Industry-Specific Fields
industry_data:
  industry_name: "Mobile Network Operators"
  industry_icon: "📱"
  market_size: "$1.7 trillion"
  key_challenges:
    - "5G network deployment costs"
    - "Legacy system modernization"
    - "Subscriber experience optimization"
    
  alepo_solutions:
    - solution: "5g-monetization"
      relevance: "Why this matters for industry"
    - solution: "legacy-aaa-replacement"
      relevance: "Industry-specific benefits"
      
customer_logos:
  - name: "Customer Name"
    logo: "[Image: Customer logo | 200x80 | grayscale]"
    case_study_url: "/case-studies/customer-slug"
```

---

## Content Sections by Page Type

### Homepage Structure
```markdown
# [Company Name]: [Primary Value Proposition]

## Hero Section
[Image: Hero banner | 1920x1080 | gradient-overlay]

**Headline**: Transform Your Network with Future-Ready Solutions
**Subheadline**: Comprehensive telecom software for 5G, BSS, and beyond
**CTA Primary**: Explore Solutions
**CTA Secondary**: Request Demo

## Introduction (The Challenge)
[300-400 words introducing the industry challenges and Alepo's position]

## Our Solutions (3-Column Grid)
### [Solution Category 1]
[150-200 words per solution category]
- Key benefit 1
- Key benefit 2
- Key benefit 3
[CTA: Explore [Category] Solutions →]

## Why Choose Alepo (Value Propositions)
[4-6 key differentiators with icons and brief descriptions]

## Success Stories
[2-3 featured case studies with metrics]

## Latest Insights
[3 recent blog posts or resources]

## Ready to Transform Your Network?
[Final CTA section with form or contact options]
```

### Product Page Structure
```markdown
# [Product Name]: [Primary Benefit Statement]

## Hero Section
[Image: Product hero visual | 1920x600 | product-showcase]

**Headline**: [Product Name] - [Key Value Proposition]
**Subheadline**: [Expanded benefit statement with key differentiator]
**CTA Primary**: Request Demo
**CTA Secondary**: Download Datasheet

## Product Overview
[400-500 words explaining what the product is, who it's for, and primary benefits]

### Key Capabilities
- **[Capability 1]**: [Brief description of benefit]
- **[Capability 2]**: [Brief description of benefit]
- **[Capability 3]**: [Brief description of benefit]

## Core Features
### [Feature Category 1]
[Image: Feature screenshot | 800x600 | shadow-box]
[200-250 words describing feature set and benefits]

### [Feature Category 2]
[Image: Feature screenshot | 800x600 | shadow-box]
[200-250 words describing feature set and benefits]

## Technical Specifications
[Table or structured list of technical details]

## How It Works
[3-5 step process with visuals]
1. **[Step 1]**: [Description]
2. **[Step 2]**: [Description]
3. **[Step 3]**: [Description]

## Integration & Deployment
[200-300 words on deployment options and integration capabilities]

## Customer Success
[1-2 case studies or testimonials specific to this product]

## Pricing & Packages
[Pricing information or CTA to contact sales]

## Get Started with [Product Name]
[Final CTA section with multiple action options]
```

### Solution Page Structure
```markdown
# [Solution Name]: [Outcome-Focused Headline]

## Hero Section
[Image: Solution concept visual | 1920x600 | abstract-illustration]

**Headline**: [Solution Name]
**Subheadline**: [Problem solved and primary benefit]
**CTA Primary**: Explore Our Approach
**CTA Secondary**: Download Solution Guide

## The Challenge
[300-400 words describing the industry challenge this solution addresses]

### Key Pain Points
- [Pain point 1 with brief description]
- [Pain point 2 with brief description]
- [Pain point 3 with brief description]

## Our Solution Approach
[400-500 words explaining Alepo's approach to solving this challenge]

### Solution Components
1. **[Component 1]**: [How it contributes to solution]
2. **[Component 2]**: [How it contributes to solution]
3. **[Component 3]**: [How it contributes to solution]

## Key Benefits
[Grid layout with 6 key benefits, each with icon and description]

## Implementation Process
[Visual timeline or process diagram]
1. **Assessment** (Week 1-2)
2. **Design** (Week 3-4)
3. **Implementation** (Week 5-8)
4. **Optimization** (Ongoing)

## Expected Outcomes
[Metrics and ROI information]
- [Metric 1]: [Expected improvement]
- [Metric 2]: [Expected improvement]
- [Metric 3]: [Expected improvement]

## Success Story
[Detailed case study related to this solution]

## Related Resources
- [White Paper]: [Title]
- [Webinar]: [Title]
- [Case Study]: [Title]

## Ready to [Desired Outcome]?
[Final CTA with form or contact options]
```

### Industry Page Structure
```markdown
# [Industry Name] Solutions: [Value Proposition for Industry]

## Hero Section
[Image: Industry-specific visual | 1920x600 | industry-overlay]

**Headline**: Telecom Solutions for [Industry]
**Subheadline**: [Industry-specific value proposition]
**CTA Primary**: See [Industry] Solutions
**CTA Secondary**: Talk to Industry Expert

## Industry Overview
[400-500 words on industry challenges and opportunities]

### Market Dynamics
- **Market Size**: [Value and growth rate]
- **Key Trends**: [2-3 major trends]
- **Challenges**: [Top challenges faced]

## Industry-Specific Challenges
### [Challenge 1]
[200-250 words on challenge and impact]

### [Challenge 2]
[200-250 words on challenge and impact]

### [Challenge 3]
[200-250 words on challenge and impact]

## Alepo Solutions for [Industry]
[Grid of 4-6 relevant solutions with descriptions]

## Why [Industry] Leaders Choose Alepo
[Industry-specific value propositions]

## Customer Success in [Industry]
[2-3 case studies from this industry]

### Featured Customer: [Name]
[Image: Customer logo | 200x80 | color]
[Case study summary with metrics]

## Industry Resources
- [Industry Report]: [Title]
- [Whitepaper]: [Title]
- [Webinar]: [Title]

## Partner with Alepo for [Industry] Success
[Final CTA section tailored to industry needs]
```

---

## SEO Content Requirements

### Keyword Placement Rules
1. **Primary Keyword**:
   - In page title (first 60 characters)
   - In H1 (exactly once)
   - In first paragraph (first 100 words)
   - In meta description
   - 2-3 times naturally in body content
   - In at least one H2
   - In image alt text

2. **Secondary Keywords**:
   - In H2/H3 subheadings
   - Naturally throughout content
   - In image alt text
   - In internal link anchor text

### Content Depth Requirements
- **Homepage**: 3,000+ words
- **Product Pages**: 1,500-2,000 words
- **Solution Pages**: 1,200-1,500 words
- **Industry Pages**: 1,000-1,500 words
- **Company Pages**: 800-1,200 words
- **Resource Pages**: 600-1,000 words

### Heading Hierarchy
```markdown
# H1: Page Title (one per page)
## H2: Major Section Headers (4-8 per page)
### H3: Subsection Headers (2-4 per H2)
#### H4: Detail Points (as needed)
##### H5: Sub-details (rarely used)
###### H6: Fine details (avoid if possible)
```

---

## CTA Patterns

### CTA Hierarchy by Page Type

#### Product Pages
1. **Primary**: "Request [Product] Demo" / "Get Pricing"
2. **Secondary**: "Download Datasheet" / "Watch Demo Video"
3. **Tertiary**: "Compare Products" / "Read Documentation"

#### Solution Pages
1. **Primary**: "Explore Solution" / "Schedule Consultation"
2. **Secondary**: "Download Solution Guide" / "View Case Study"
3. **Tertiary**: "Calculate ROI" / "See Implementation Timeline"

#### Industry Pages
1. **Primary**: "See [Industry] Solutions" / "Contact Industry Expert"
2. **Secondary**: "Download Industry Report" / "View Success Stories"
3. **Tertiary**: "Join Industry Webinar" / "Get Industry Newsletter"

### CTA Placement Rules
- **Hero Section**: Primary + Secondary
- **After Problem Statement**: Relevant secondary CTA
- **Mid-Page** (after main content): Primary CTA
- **After Benefits/Features**: Secondary or tertiary
- **End of Page**: Primary + Contact options

### CTA Copy Guidelines
- Use action verbs (Get, Request, Download, Explore)
- Include value proposition when possible
- Personalize with product/solution name
- Keep under 4 words for buttons
- Use urgency sparingly and authentically

---

## Image Placeholder Standards

### Placeholder Format
```
[Image: description | dimensions | style-modifier]
```

### Standard Dimensions
- **Hero Images**: 1920x1080 (homepage), 1920x600 (inner pages)
- **Feature Images**: 800x600
- **Screenshots**: 1200x800
- **Thumbnails**: 400x300
- **Icons**: 64x64
- **Logos**: 200x80
- **Diagrams**: 1200x900

### Style Modifiers
- `gradient-overlay`: Dark gradient for text overlay
- `shadow-box`: Drop shadow for depth
- `rounded`: Rounded corners (8px)
- `border`: Light border (1px #E0E0E0)
- `grayscale`: Grayscale filter
- `blur-bg`: Blurred background effect

### Alt Text Requirements
- Describe image content specifically
- Include primary keyword when relevant
- Keep under 125 characters
- Don't use "image of" or "picture of"
- Be descriptive for accessibility

---

## Internal Linking Rules

### Link Distribution
- **Minimum Links**: 3-5 per page
- **Maximum Links**: 10-12 per page
- **Link Types**:
  - Contextual content links (60%)
  - Related resources (25%)
  - Navigation/CTA links (15%)

### Anchor Text Guidelines
1. Use descriptive, keyword-rich anchor text
2. Vary anchor text for same destination
3. Avoid generic terms ("click here", "read more")
4. Keep anchor text under 6 words
5. Make link purpose clear from context

### Link Relevance Hierarchy
1. **Primary**: Direct product/solution relationships
2. **Secondary**: Related industry or challenge content
3. **Tertiary**: General company or resource pages

### Example Link Patterns
```markdown
Good: Learn how [legacy AAA replacement](/solutions/legacy-aaa-replacement) reduces operational costs
Bad: Click [here](/solutions/legacy-aaa-replacement) to learn more

Good: Our [5G-ready authentication solution](/products/aaa-authentication) supports modern networks
Bad: Our solution ([link](/products/aaa-authentication)) is 5G-ready
```

---

## Content Length Guidelines

### Word Count Targets by Section

#### Homepage Sections
- Hero: 50-75 words
- Introduction: 300-400 words
- Each solution block: 150-200 words
- Value propositions: 50-75 words each
- Case study summaries: 100-150 words each
- Final CTA: 75-100 words

#### Product Page Sections
- Hero: 75-100 words
- Overview: 400-500 words
- Each feature: 200-250 words
- Technical specs: 200-300 words
- How it works: 300-400 words
- Integration: 200-300 words

#### Solution Page Sections
- Hero: 75-100 words
- Challenge: 300-400 words
- Solution approach: 400-500 words
- Benefits: 50-75 words each
- Implementation: 200-300 words
- Outcomes: 150-200 words

### Content Quality Checklist
- [ ] Meets minimum word count
- [ ] Primary keyword in first 100 words
- [ ] Clear value proposition in hero
- [ ] Scannable with headers and bullets
- [ ] Includes relevant statistics/metrics
- [ ] Has clear CTAs at logical points
- [ ] Contains 3-5 internal links
- [ ] Includes image placeholders
- [ ] Follows brand voice guidelines
- [ ] Addresses user intent
- [ ] Provides unique value
- [ ] Mobile-friendly formatting

---

## Implementation Examples

### Example Hero Section
```markdown
## Hero Section
[Image: Modern telecom network visualization | 1920x600 | gradient-overlay]

### Transform Your Legacy AAA into a 5G-Ready Powerhouse

Modernize your authentication infrastructure with Alepo's cloud-native AAA solution. Support millions of subscribers, enable new 5G services, and reduce operational costs by 50%.

**[Request Demo]** **[Download Solution Guide]**
```

### Example Feature Section
```markdown
## Unified Policy Management

[Image: Policy management dashboard | 800x600 | shadow-box]

Simplify complex policy decisions with our intuitive policy engine. Create, test, and deploy subscriber policies across all network services from a single interface. Our visual policy builder eliminates coding requirements while providing the flexibility to handle your most complex use cases.

### Key Capabilities:
- **Visual Policy Builder**: Drag-and-drop interface for policy creation
- **Real-time Testing**: Validate policies before deployment
- **Version Control**: Track and rollback policy changes
- **Performance Analytics**: Monitor policy performance and impact

With support for both RADIUS and Diameter protocols, you can manage legacy and modern services through one platform, ensuring consistent policy enforcement across your entire network.
```

### Example CTA Section
```markdown
## Ready to Modernize Your Authentication Infrastructure?

Join leading service providers who trust Alepo to handle billions of authentication requests daily. Our team of experts will help you plan and execute a smooth migration from legacy systems to our future-ready platform.

### Take the Next Step:
- **[Schedule a Personalized Demo]** - See how Alepo AAA fits your needs
- **[Download ROI Calculator]** - Calculate your potential savings
- **[Talk to an Expert]** - Discuss your specific requirements

**Questions?** Our solution architects are available to help you evaluate your options and create a modernization roadmap tailored to your network.
```

---

This template ensures consistency across all content generation while maintaining flexibility for page-specific requirements. Use these structures as the foundation for creating compelling, SEO-optimized content that serves user needs and drives conversions.