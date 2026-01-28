#!/usr/bin/env python3
"""
Script to batch optimize remaining HTML pages with mobile SEO improvements.
Applies the same optimizations pattern to all remaining HTML files.
"""

import os
import re
from pathlib import Path

# Critical CSS template (minified)
CRITICAL_CSS = """*{margin:0;padding:0;box-sizing:border-box}
:root{--primary-color:#0066CC;--primary-dark:#004C99;--secondary-color:#00A86B;--text-dark:#1A1A1A;--text-medium:#4A4A4A;--bg-white:#FFFFFF;--bg-light:#F8F9FA;--border-color:#E0E0E0;--spacing-xs:0.5rem;--spacing-sm:1rem;--spacing-md:1.5rem;--spacing-lg:2rem;--spacing-xl:3rem;--spacing-2xl:4rem;--radius-sm:4px;--radius-md:8px;--radius-lg:12px;--radius-full:9999px;--shadow-sm:0 2px 4px rgba(0,0,0,0.05);--font-primary:'Inter',-apple-system,BlinkMacSystemFont,sans-serif;--font-heading:'Poppins',sans-serif}
html{scroll-behavior:smooth}
body{font-family:var(--font-primary);font-size:16px;line-height:1.6;color:var(--text-dark);background:var(--bg-white);overflow-x:hidden}
.container{max-width:1200px;margin:0 auto;padding:0 var(--spacing-md)}
h1,h2,h3,h4,h5,h6{font-family:var(--font-heading);font-weight:600;line-height:1.2;margin-bottom:var(--spacing-sm)}
h1{font-size:clamp(2rem,5vw,3.5rem)}
h2{font-size:clamp(1.75rem,4vw,2.5rem)}
img{max-width:100%;height:auto;display:block}
.top-bar{background:var(--text-dark);color:#fff;padding:var(--spacing-xs) 0;font-size:0.875rem}
.top-bar-content{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:var(--spacing-sm)}
.navbar{background:#fff;box-shadow:var(--shadow-sm);position:sticky;top:0;z-index:1000}
.nav-wrapper{display:flex;align-items:center;justify-content:space-between;padding:var(--spacing-sm) 0}
.logo-img{height:60px;width:auto}
.mobile-menu-toggle{display:none;flex-direction:column;gap:5px;background:transparent;border:none;cursor:pointer;padding:0.75rem;min-width:44px;min-height:44px;justify-content:center;align-items:center;z-index:1001;position:relative}
.page-hero{padding:var(--spacing-2xl) 0;background:linear-gradient(135deg,#4A5568 0%,#2D3748 30%,#1A202C 60%,#0066CC 100%);position:relative;overflow:hidden}
.btn{display:inline-flex;align-items:center;gap:var(--spacing-xs);padding:0.75rem 1.5rem;font-size:1rem;font-weight:500;border-radius:var(--radius-md);border:none;cursor:pointer;transition:all 0.3s ease;text-align:center;white-space:nowrap;text-decoration:none}
.btn-primary{background:var(--primary-color);color:#fff}
.btn-lg{padding:1rem 2rem;font-size:1.125rem}
.sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border-width:0}
@media(max-width:768px){.mobile-menu-toggle{display:flex}}"""

# Files already optimized
OPTIMIZED_FILES = {
    'index.html',
    'contact.html',
    'reviews.html',
    'pricing.html',
    'eye/cataract-surgery.html',
    'eye/lasik-prk.html',
    'dental/implants.html',
    'doctors.html'
}

def get_css_path(file_path):
    """Determine CSS path based on file location"""
    if 'eye/' in file_path or 'dental/' in file_path or 'blog/' in file_path or 'nri/' in file_path:
        return '../css/'
    return 'css/'

def optimize_file(file_path):
    """Apply optimizations to a single HTML file"""
    print(f"Optimizing {file_path}...")
    
    with open(file_path, 'r', encoding='utf-8') as f:
        content = f.read()
    
    css_path = get_css_path(file_path)
    original_content = content
    
    # 1. Replace Google Analytics
    analytics_pattern = r'<!-- Google tag \(gtag\.js\) -->\s*<script async src="https://www\.googletagmanager\.com/gtag/js\?id=G-2MXQX23SCV"></script>\s*<script>\s*window\.dataLayer = window\.dataLayer \|\| \[\];\s*function gtag\(\)\{dataLayer\.push\(arguments\);\}\s*gtag\('js', new Date\(\)\);\s*gtag\('config', 'G-2MXQX23SCV'\);\s*</script>'
    analytics_replacement = '''<!-- Google tag (gtag.js) - Deferred -->
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-2MXQX23SCV');
    </script>
    <script async defer src="https://www.googletagmanager.com/gtag/js?id=G-2MXQX23SCV"></script>'''
    content = re.sub(analytics_pattern, analytics_replacement, content, flags=re.DOTALL)
    
    # 2. Add resource hints and optimize CSS/fonts (if not already done)
    if 'dns-prefetch' not in content or 'Critical CSS Inline' not in content:
        # Find the title tag and add optimizations after it
        title_match = re.search(r'(<title>.*?</title>\s*<link rel="canonical")', content, re.DOTALL)
        if title_match:
            before_title = content[:title_match.start()]
            title_part = title_match.group(1)
            after_canonical = content[title_match.end():]
            
            # Extract existing stylesheet links
            stylesheet_pattern = r'<link rel="stylesheet" href="([^"]+)"[^>]*>'
            stylesheets = re.findall(stylesheet_pattern, content)
            
            # Build optimized head section
            optimized_head = f'''{before_title}{title_part}
    
    <!-- Resource Hints -->
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://www.googletagmanager.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Critical CSS Inline -->
    <style>
    {CRITICAL_CSS}
    </style>
    
    <!-- Preload critical CSS -->
    <link rel="preload" href="{css_path}style.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{css_path}style.css"></noscript>
    
    <!-- Defer non-critical CSS -->
    <link rel="preload" href="{css_path}pages.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{css_path}pages.css"></noscript>
    
    <!-- Load fonts asynchronously -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"></noscript>
    
    <!-- Defer Font Awesome -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></noscript>
{after_canonical}'''
            
            # Remove old stylesheet links if they exist
            optimized_head = re.sub(r'<link rel="stylesheet" href="[^"]*style\.css"[^>]*>\s*', '', optimized_head)
            optimized_head = re.sub(r'<link rel="stylesheet" href="[^"]*pages\.css"[^>]*>\s*', '', optimized_head)
            optimized_head = re.sub(r'<link rel="preconnect" href="https://fonts\.googleapis\.com"[^>]*>\s*', '', optimized_head)
            optimized_head = re.sub(r'<link rel="preconnect" href="https://fonts\.gstatic\.com"[^>]*>\s*', '', optimized_head)
            optimized_head = re.sub(r'<link href="https://fonts\.googleapis\.com[^"]*"[^>]*>\s*', '', optimized_head)
            optimized_head = re.sub(r'<link rel="stylesheet" href="https://cdnjs\.cloudflare\.com[^"]*"[^>]*>\s*', '', optimized_head)
            
            content = optimized_head
    
    # 3. Optimize images
    content = re.sub(r'(<img src="[^"]*JEDH Logo\.png"[^>]*class="logo-img"[^>]*>)', r'\1 width="200" height="60" fetchpriority="high" loading="eager"', content)
    content = re.sub(r'(<img src="[^"]*JEDH Logo\.png"[^>]*class="footer-logo"[^>]*>)', r'\1 width="200" height="60" loading="lazy"', content)
    
    # 4. Add accessibility attributes
    content = re.sub(r'(<button class="mobile-menu-toggle">)', r'<button class="mobile-menu-toggle" aria-label="Toggle mobile menu" aria-expanded="false">', content)
    content = re.sub(r'(<a href="https://wa\.me/[^"]*"[^>]*class="whatsapp-float"[^>]*>)', r'\1 aria-label="Chat with us on WhatsApp"', content)
    content = re.sub(r'(<i class="fab fa-whatsapp"></i>)', r'<i class="fab fa-whatsapp" aria-hidden="true"></i>', content)
    content = re.sub(r'(<i class="fab fa-instagram"></i>)', r'<i class="fab fa-instagram" aria-hidden="true"></i>', content)
    content = re.sub(r'(<i class="fab fa-youtube"></i>)', r'<i class="fab fa-youtube" aria-hidden="true"></i>', content)
    content = re.sub(r'(<i class="fab fa-linkedin"></i>)', r'<i class="fab fa-linkedin" aria-hidden="true"></i>', content)
    
    # 5. Defer JavaScript
    content = re.sub(r'(<script src="[^"]*main\.js"></script>)', r'<script src="\1" defer></script>', content)
    content = re.sub(r'(<script src="\.\./js/main\.js"></script>)', r'<script src="../js/main.js" defer></script>', content)
    
    if content != original_content:
        with open(file_path, 'w', encoding='utf-8') as f:
            f.write(content)
        print(f"  ✓ Optimized {file_path}")
        return True
    else:
        print(f"  - No changes needed for {file_path}")
        return False

def main():
    """Main function to optimize all remaining HTML files"""
    base_dir = Path(__file__).parent.parent
    
    html_files = []
    for pattern in ['*.html', 'eye/*.html', 'dental/*.html', 'nri/*.html', 'blog/*.html']:
        html_files.extend(base_dir.glob(pattern))
    
    optimized_count = 0
    for html_file in html_files:
        rel_path = str(html_file.relative_to(base_dir))
        if rel_path not in OPTIMIZED_FILES:
            if optimize_file(str(html_file)):
                optimized_count += 1
    
    print(f"\n✓ Optimized {optimized_count} files")

if __name__ == '__main__':
    main()

