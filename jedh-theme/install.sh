#!/bin/bash

# JEDH WordPress Theme Installation Script
# This script helps install the JEDH theme in WordPress

echo "🏥 JEDH WordPress Theme Installation"
echo "====================================="
echo ""

# Check if WordPress is installed
if [ ! -f "wp-config.php" ]; then
    echo "❌ WordPress not found in current directory"
    echo "Please run this script from your WordPress root directory"
    exit 1
fi

echo "✅ WordPress installation found"
echo ""

# Create theme directory if it doesn't exist
if [ ! -d "wp-content/themes" ]; then
    mkdir -p wp-content/themes
    echo "📁 Created themes directory"
fi

# Copy theme files
echo "📦 Installing JEDH theme..."
cp -r jedh-theme wp-content/themes/
echo "✅ Theme files copied successfully"
echo ""

# Set proper permissions
echo "🔐 Setting file permissions..."
chmod -R 755 wp-content/themes/jedh-theme/
echo "✅ Permissions set"
echo ""

# Create uploads directory if it doesn't exist
if [ ! -d "wp-content/uploads" ]; then
    mkdir -p wp-content/uploads
    chmod 755 wp-content/uploads
    echo "📁 Created uploads directory"
fi

echo ""
echo "🎉 Installation Complete!"
echo ""
echo "Next Steps:"
echo "1. Go to WordPress Admin → Appearance → Themes"
echo "2. Activate 'JEDH - Jaipur Eye & Dental Hospital' theme"
echo "3. Go to Appearance → Menus and create your navigation menu"
echo "4. Go to Appearance → Customize → Contact Information to update contact details"
echo "5. Start adding content: Doctors, Services, Reviews"
echo ""
echo "📞 Need help? Contact: +91 9602227267"
echo "📧 Email: dramit.eye@gmail.com"
echo ""
