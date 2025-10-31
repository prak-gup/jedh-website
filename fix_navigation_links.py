#!/usr/bin/env python3
import os
import re
import glob

def fix_navigation_links():
    """Fix navigation links in all HTML files for proper GitHub Pages compatibility"""
    
    # Define the correct link mappings for different directory levels
    link_mappings = {
        # Root level files (index.html, contact.html, etc.)
        'root': {
            'index.html': 'index.html',
            'contact.html': 'contact.html',
            'doctors.html': 'doctors.html',
            'pricing.html': 'pricing.html',
            'reviews.html': 'reviews.html',
            'eye/index.html': 'eye/index.html',
            'dental/index.html': 'dental/index.html',
            'nri/index.html': 'nri/index.html',
            'blog/index.html': 'blog/index.html'
        },
        # Eye subdirectory files
        'eye': {
            'index.html': '../index.html',
            'contact.html': '../contact.html',
            'doctors.html': '../doctors.html',
            'pricing.html': '../pricing.html',
            'reviews.html': '../reviews.html',
            'eye/index.html': 'index.html',
            'eye/cataract-surgery.html': 'cataract-surgery.html',
            'eye/lasik-prk.html': 'lasik-prk.html',
            'eye/glaucoma.html': 'glaucoma.html',
            'eye/pediatric-myopia.html': 'pediatric-myopia.html',
            'dental/index.html': '../dental/index.html',
            'nri/index.html': '../nri/index.html',
            'blog/index.html': '../blog/index.html'
        },
        # Dental subdirectory files
        'dental': {
            'index.html': '../index.html',
            'contact.html': '../contact.html',
            'doctors.html': '../doctors.html',
            'pricing.html': '../pricing.html',
            'reviews.html': '../reviews.html',
            'eye/index.html': '../eye/index.html',
            'dental/index.html': 'index.html',
            'dental/implants.html': 'implants.html',
            'dental/invisalign.html': 'invisalign.html',
            'dental/cosmetic.html': 'cosmetic.html',
            'dental/preventive.html': 'preventive.html',
            'nri/index.html': '../nri/index.html',
            'blog/index.html': '../blog/index.html'
        },
        # NRI subdirectory files
        'nri': {
            'index.html': '../index.html',
            'contact.html': '../contact.html',
            'doctors.html': '../doctors.html',
            'pricing.html': '../pricing.html',
            'reviews.html': '../reviews.html',
            'eye/index.html': '../eye/index.html',
            'dental/index.html': '../dental/index.html',
            'nri/index.html': 'index.html',
            'nri/usa.html': 'usa.html',
            'nri/uk.html': 'uk.html',
            'nri/middle-east.html': 'middle-east.html',
            'blog/index.html': '../blog/index.html'
        },
        # Blog subdirectory files
        'blog': {
            'index.html': '../index.html',
            'contact.html': '../contact.html',
            'doctors.html': '../doctors.html',
            'pricing.html': '../pricing.html',
            'reviews.html': '../reviews.html',
            'eye/index.html': '../eye/index.html',
            'dental/index.html': '../dental/index.html',
            'nri/index.html': '../nri/index.html',
            'blog/index.html': 'index.html'
        }
    }
    
    def get_directory_type(file_path):
        """Determine which directory type the file is in"""
        if file_path == 'index.html' or file_path in ['contact.html', 'doctors.html', 'pricing.html', 'reviews.html']:
            return 'root'
        elif file_path.startswith('eye/'):
            return 'eye'
        elif file_path.startswith('dental/'):
            return 'dental'
        elif file_path.startswith('nri/'):
            return 'nri'
        elif file_path.startswith('blog/'):
            return 'blog'
        return 'root'
    
    def fix_file_links(file_path):
        """Fix links in a specific file"""
        print(f"Processing: {file_path}")
        
        dir_type = get_directory_type(file_path)
        mappings = link_mappings.get(dir_type, link_mappings['root'])
        
        with open(file_path, 'r', encoding='utf-8') as f:
            content = f.read()
        
        # Fix each link mapping
        for old_link, new_link in mappings.items():
            # Fix href attributes
            content = re.sub(f'href="{re.escape(old_link)}"', f'href="{new_link}"', content)
        
        with open(file_path, 'w', encoding='utf-8') as f:
            f.write(content)
    
    # Process all HTML files
    html_files = glob.glob('**/*.html', recursive=True)
    
    for file_path in html_files:
        fix_file_links(file_path)
    
    print(f"Fixed navigation links in {len(html_files)} HTML files!")

if __name__ == "__main__":
    fix_navigation_links()
