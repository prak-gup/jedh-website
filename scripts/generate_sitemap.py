#!/usr/bin/env python3
"""
Sitemap Generator for HTML/CSS Websites
Generates XML sitemap from HTML files in a directory.
"""

import os
import sys
import argparse
from pathlib import Path
from datetime import datetime
from urllib.parse import urljoin, urlparse

def generate_sitemap(directory, base_url, output_file=None):
    """Generate XML sitemap from HTML files."""
    directory_path = Path(directory)
    base_url = base_url.rstrip('/')
    
    # Find all HTML files
    html_files = []
    for html_file in directory_path.rglob('*.html'):
        # Skip test files and jedh-theme directory
        if 'test' in str(html_file) or 'jedh-theme' in str(html_file):
            continue
        html_files.append(html_file)
    
    # Sort files (homepage first, then alphabetically)
    html_files.sort(key=lambda x: (x.name != 'index.html', str(x)))
    
    # Generate URLs
    urls = []
    for html_file in html_files:
        # Get relative path from directory
        rel_path = html_file.relative_to(directory_path)
        
        # Convert to URL path
        url_path = str(rel_path).replace('\\', '/')
        if url_path == 'index.html':
            url = base_url + '/'
        else:
            url = base_url + '/' + url_path.replace('index.html', '').rstrip('/')
        
        # Get file modification time
        mod_time = datetime.fromtimestamp(html_file.stat().st_mtime)
        lastmod = mod_time.strftime('%Y-%m-%d')
        
        # Estimate priority and changefreq
        priority = '1.0' if url == base_url + '/' else '0.8'
        if 'index.html' in url_path or url == base_url + '/':
            priority = '1.0'
            changefreq = 'weekly'
        elif 'blog' in url_path:
            changefreq = 'monthly'
            priority = '0.7'
        else:
            changefreq = 'monthly'
            priority = '0.8'
        
        urls.append({
            'loc': url,
            'lastmod': lastmod,
            'changefreq': changefreq,
            'priority': priority
        })
    
    # Generate XML
    xml_lines = [
        '<?xml version="1.0" encoding="UTF-8"?>',
        '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'
    ]
    
    for url_data in urls:
        xml_lines.append('  <url>')
        xml_lines.append(f'    <loc>{url_data["loc"]}</loc>')
        xml_lines.append(f'    <lastmod>{url_data["lastmod"]}</lastmod>')
        xml_lines.append(f'    <changefreq>{url_data["changefreq"]}</changefreq>')
        xml_lines.append(f'    <priority>{url_data["priority"]}</priority>')
        xml_lines.append('  </url>')
    
    xml_lines.append('</urlset>')
    
    xml_content = '\n'.join(xml_lines)
    
    # Write to file or stdout
    if output_file:
        output_path = Path(output_file)
        output_path.parent.mkdir(parents=True, exist_ok=True)
        with open(output_path, 'w', encoding='utf-8') as f:
            f.write(xml_content)
        print(f"Sitemap generated: {output_file}")
        print(f"Total URLs: {len(urls)}")
    else:
        print(xml_content)
    
    return len(urls)


def main():
    parser = argparse.ArgumentParser(description='Generate XML sitemap from HTML files')
    parser.add_argument('directory', help='Directory containing HTML files')
    parser.add_argument('base_url', help='Base URL for the website (e.g., https://example.com)')
    parser.add_argument('output', nargs='?', help='Output file path (default: sitemap.xml in directory)')
    args = parser.parse_args()
    
    directory = Path(args.directory)
    if not directory.exists():
        print(f"Error: Directory {directory} does not exist", file=sys.stderr)
        sys.exit(1)
    
    output_file = args.output or str(directory / 'sitemap.xml')
    generate_sitemap(directory, args.base_url, output_file)


if __name__ == '__main__':
    main()

