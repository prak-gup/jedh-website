#!/usr/bin/env python3
import os
import re
import glob

def fix_links_in_file(file_path):
    """Fix absolute paths to relative paths in HTML files"""
    print(f"Processing: {file_path}")
    
    # Calculate relative path depth
    depth = file_path.count('/') - 1  # Subtract 1 for the leading ./
    prefix = '../' * depth if depth > 0 else ''
    
    with open(file_path, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # Fix href attributes
    # Replace absolute paths with relative paths
    content = re.sub(r'href="/', 'href="', content)
    content = re.sub(r'src="/', 'src="', content)
    
    # For files in subdirectories, add proper relative path prefix
    if depth > 0:
        # Fix links to root files
        content = re.sub(r'href="([^/][^"]*\.html)"', f'href="{prefix}\\1"', content)
        content = re.sub(r'src="([^/][^"]*)"', f'src="{prefix}\\1"', content)
        
        # Fix links to other subdirectories
        content = re.sub(r'href="([^/][^"]*\.html)"', f'href="{prefix}\\1"', content)
    
    with open(file_path, 'w', encoding='utf-8') as f:
        f.write(content)

def main():
    """Main function to fix all HTML files"""
    print("Fixing links in all HTML files for GitHub Pages compatibility...")
    
    # Find all HTML files
    html_files = glob.glob('**/*.html', recursive=True)
    
    for file_path in html_files:
        fix_links_in_file(file_path)
    
    print(f"Fixed links in {len(html_files)} HTML files!")
    print("All absolute paths have been converted to relative paths.")

if __name__ == "__main__":
    main()
