# WP Engine Git Push Deployment Guide

## 🚀 Quick Start Deployment

### 1. Initialize Git Repository
```bash
cd "/mnt/d/Website Works/alepo-dryrun"
git init
git add .
git commit -m "Initial Alepo theme commit"
```

### 2. Create GitHub Repository
1. Go to GitHub.com
2. Create new repository: `alepo-theme-deployment`
3. **Don't** initialize with README (we already have one)
4. Copy the repository URL

### 3. Connect to GitHub
```bash
git remote add origin https://github.com/yourusername/alepo-theme-deployment.git
git branch -M main
git push -u origin main
```

### 4. Configure WP Engine Git Push

**In WP Engine User Portal:**
1. Go to your development environment
2. Navigate to "Git Push" section
3. Click "Enable Git Push"
4. Add your SSH public key
5. Copy the Git remote URL (looks like: `git@git.wpengine.com:production/yoursitename.git`)

### 5. Add WP Engine Remote
```bash
git remote add wpengine git@git.wpengine.com:production/yourdevsite.git
```

### 6. Deploy to WP Engine
```bash
git push wpengine main
```

## 📋 Post-Deployment Checklist

### Immediate Steps (Required)
- [ ] **Install ACF Pro Plugin** in WordPress Admin
- [ ] **Run Page Creation Script** (see options below)
- [ ] **Activate Alepo Theme** in Appearance → Themes
- [ ] **Configure Primary Menu** in Appearance → Menus

### Page Creation Options

**Option A: WP-CLI (Recommended)**
```bash
# SSH into WP Engine or use their CLI
wp eval-file wp-content/themes/alepo-theme/create-pages-wp-cli.php
```

**Option B: Browser Method**
1. Go to: `https://yoursite.wpengine.com/wp-content/themes/alepo-theme/create-pages.php`
2. Ensure you're logged in as admin
3. The script will create all 47 pages automatically

### Verification Steps
- [ ] **Homepage loads** with hero section
- [ ] **Navigation menu** works with mega menus
- [ ] **ACF fields** display correctly in page editor
- [ ] **All 47 pages** are created and accessible
- [ ] **Mobile navigation** functions properly
- [ ] **Animations** work on scroll

## 🔄 Ongoing Development Workflow

### Making Changes
1. **Edit files locally**
2. **Test changes** in local environment
3. **Commit to GitHub:**
   ```bash
   git add .
   git commit -m "Description of changes"
   git push origin main
   ```
4. **Deploy to WP Engine:**
   ```bash
   git push wpengine main
   ```

### Branch Strategy (Recommended)
```bash
# Create feature branch
git checkout -b feature/new-functionality
# Make changes...
git add .
git commit -m "Add new functionality"
git push origin feature/new-functionality

# Merge to main via pull request
# Then deploy:
git checkout main
git pull origin main
git push wpengine main
```

## 🛠️ Troubleshooting

### Common Deployment Issues

**1. Permission Denied (SSH)**
- Check SSH key is added to WP Engine
- Verify key format (should be RSA or Ed25519)
- Test SSH connection: `ssh -T git@git.wpengine.com`

**2. Pages Not Created**
- Check WordPress admin user permissions
- Verify ACF Pro is installed and activated
- Try running script via WP-CLI instead of browser

**3. Theme Not Activating**
- Check `style.css` has proper theme header
- Verify all PHP files have no syntax errors
- Check WP Engine error logs

**4. ACF Fields Not Showing**
- Ensure ACF Pro plugin is activated
- Check that `functions.php` loaded without errors
- Verify field group registration in ACF admin

### WP Engine Specific Notes

**File Permissions:**
- WP Engine manages file permissions automatically
- Page creation scripts include proper permission checks

**Cache Clearing:**
- WP Engine auto-clears cache on Git deployment
- Manual cache clear: WP Engine User Portal → Utilities → Cache

**Environment Variables:**
- Use WP Engine environment detection if needed
- Check `WPE_APIKEY` for environment identification

## 📊 Deployment Status

### What Gets Deployed
✅ **Theme Files:** All PHP, CSS, JS files  
✅ **Documentation:** README and deployment guides  
✅ **Page Scripts:** Automated page creation tools  
✅ **Assets:** JavaScript animations and navigation  

### What Doesn't Get Deployed
❌ **Test Files:** Local testing scripts (gitignored)  
❌ **Generated Pages:** HTML test output (gitignored)  
❌ **WordPress Core:** Managed by WP Engine  
❌ **Plugins:** Managed separately (except theme dependencies)  

## 🎯 Success Criteria

**Deployment Successful When:**
- [ ] Git push completes without errors
- [ ] Theme activates in WordPress admin
- [ ] All 47 pages are created successfully
- [ ] ACF fields are accessible in page editor
- [ ] Navigation menus function properly
- [ ] Animations and interactions work
- [ ] Mobile responsiveness functions correctly

**Ready for Production When:**
- [ ] All functionality tested in development
- [ ] Content reviewed and approved
- [ ] Performance optimized
- [ ] SEO metadata configured
- [ ] Security review completed