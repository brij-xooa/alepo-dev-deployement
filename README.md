# Alepo WordPress Theme - WP Engine Deployment

## Overview
Complete WordPress theme for Alepo website with advanced features, ACF integration, and automated page creation.

## Theme Features
- 🎨 Modern responsive design with mega menu
- 📱 Mobile-first navigation
- ⚡ Smooth animations and interactions
- 🏗️ ACF Page Builder with 7 flexible layouts
- 📄 47 pre-configured pages
- 🔍 SEO optimized
- 🌐 Multi-template support

## Deployment to WP Engine

### Prerequisites
- WP Engine development environment
- Git Push enabled on WP Engine
- Advanced Custom Fields Pro plugin

### Deployment Steps

1. **Clone this repository:**
   ```bash
   git clone [your-repo-url]
   cd alepo-dryrun
   ```

2. **Configure WP Engine Git Push:**
   - Go to WP Engine User Portal
   - Navigate to your development environment
   - Enable Git Push
   - Add your SSH key
   - Copy the Git remote URL

3. **Add WP Engine remote:**
   ```bash
   git remote add wpengine [your-wpengine-git-url]
   ```

4. **Deploy to WP Engine:**
   ```bash
   git push wpengine main
   ```

### Post-Deployment Setup

1. **Install Required Plugin:**
   - Install Advanced Custom Fields Pro in WP Admin

2. **Run Page Creation Script:**
   
   **Option A - Via WP-CLI (Recommended):**
   ```bash
   wp eval-file wp-content/themes/alepo-theme/create-pages-wp-cli.php
   ```
   
   **Option B - Via WordPress Admin:**
   - Navigate to: `yoursite.wpengine.com/wp-content/themes/alepo-theme/create-pages.php`
   - Ensure you're logged in as admin

3. **Configure Menus:**
   - Go to Appearance → Menus
   - Assign "Primary Menu" to "Primary Menu" location

4. **Activate Theme:**
   - Go to Appearance → Themes
   - Activate "Alepo Theme"

## Theme Structure

```
wp-content/themes/alepo-theme/
├── style.css              # Main theme styles
├── functions.php           # Theme setup & ACF fields
├── header.php             # Header with mega menu
├── footer.php             # Footer with 5 columns
├── page.php               # Main page template
├── create-pages.php       # Page creation script (web)
├── create-pages-wp-cli.php # Page creation script (CLI)
├── js/
│   ├── navigation.js      # Menu interactions
│   └── animations.js      # Scroll animations
└── page-templates/        # Custom page templates
    ├── page-solution.php
    ├── page-product.php
    ├── page-industry.php
    └── page-company.php
```

## Page Creation Details

### Created Pages (47 total)
- **1 Homepage** with hero sections
- **15 Solution pages** with specialized content
- **5 Product pages** with features and metrics
- **6 Industry pages** with market data
- **4 Customer pages** with testimonials
- **4 Company pages** with team info
- **3 Resource pages** with blog/events
- **3 Support pages** with documentation
- **3 Legal pages** for compliance
- **3 Additional pages** (contact, demo, pricing)

### ACF Field Groups
- Page Hero (headlines, CTAs, images)
- Product Details (features, metrics, specs)
- Solution Components (ROI, benefits, challenges)
- Industry Details (market size, challenges)
- Company Information (team, overview)
- Page Builder (7 flexible layouts)

## Development Workflow

1. **Make changes locally**
2. **Commit to GitHub:**
   ```bash
   git add .
   git commit -m "Update theme features"
   git push origin main
   ```
3. **Deploy to WP Engine:**
   ```bash
   git push wpengine main
   ```

## Troubleshooting

### Common Issues
1. **ACF fields not showing:** Ensure ACF Pro is installed and activated
2. **Pages not created:** Check file permissions and run script as admin
3. **Menu not working:** Assign menu in Appearance → Menus
4. **Styles not loading:** Clear WP Engine cache

### Support
- Check WP Engine deployment logs
- Verify file permissions
- Test in staging before production

## Security Notes
- Page creation scripts include permission checks
- Test files are excluded via .gitignore
- Follow WP Engine security best practices