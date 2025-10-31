#!/bin/bash

# Script to fix absolute paths to relative paths for GitHub Pages compatibility

echo "Fixing links in all HTML files for GitHub Pages compatibility..."

# Find all HTML files and fix the links
find . -name "*.html" -type f | while read file; do
    echo "Processing: $file"
    
    # Replace absolute paths with relative paths
    sed -i '' 's|href="/|href="|g' "$file"
    sed -i '' 's|src="/|src="|g' "$file"
    
    # Fix specific patterns that might cause issues
    sed -i '' 's|href="index.html"|href="../index.html"|g' "$file"
    
    # For files in subdirectories, we need to adjust relative paths
    if [[ "$file" == *"/"* ]]; then
        # Count directory depth
        depth=$(echo "$file" | tr -cd '/' | wc -c)
        
        # Create relative path prefix
        if [ $depth -gt 1 ]; then
            prefix=$(printf '../%.0s' $(seq 1 $((depth-1))))
            # Fix links to go back to root
            sed -i '' "s|href=\"\([^/][^\"]*\.html\)\"|href=\"$prefix\1\"|g" "$file"
            sed -i '' "s|src=\"\([^/][^\"]*\)\"|src=\"$prefix\1\"|g" "$file"
        fi
    fi
done

echo "Link fixing completed!"
echo "All absolute paths have been converted to relative paths."
