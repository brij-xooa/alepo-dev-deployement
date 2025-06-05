#!/bin/bash
# Script to fix WP Engine deployment structure

echo "🔧 Fixing repository structure for WP Engine..."

# Create temporary directory
mkdir -p temp-fix

# Move wp-content to root level
cp -r wp-content temp-fix/
cp README.md DEPLOYMENT.md .gitignore temp-fix/

# Remove old structure
git rm -r *
git rm .gitignore .github -r

# Move files back to correct location
mv temp-fix/* .
mv temp-fix/.gitignore .
rmdir temp-fix

# Commit the restructure
git add .
git commit -m "Fix: Restructure repository for WP Engine deployment"

echo "✅ Structure fixed! Now push to remotes:"
echo "   git push origin main"
echo "   git push wpengine main"