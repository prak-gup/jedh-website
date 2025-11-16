#!/usr/bin/env python3
"""
SEO Analyzer for HTML/CSS Websites
Analyzes HTML files for SEO issues and generates comprehensive reports.
"""

import os
import sys
import json
import argparse
from pathlib import Path
from bs4 import BeautifulSoup
from collections import defaultdict
from datetime import datetime

class SEOAnalyzer:
    def __init__(self):
        self.issues = defaultdict(list)
        self.warnings = defaultdict(list)
        self.good_practices = defaultdict(list)
        self.stats = {
            'total_files': 0,
            'files_with_issues': 0,
            'total_issues': 0,
            'total_warnings': 0
        }

    def analyze_file(self, file_path):
        """Analyze a single HTML file for SEO issues."""
        try:
            with open(file_path, 'r', encoding='utf-8') as f:
                content = f.read()
            
            soup = BeautifulSoup(content, 'html.parser')
            self.stats['total_files'] += 1
            
            file_issues = []
            file_warnings = []
            file_good = []
            
            # Check title tag
            title_tag = soup.find('title')
            if not title_tag:
                file_issues.append("Missing title tag")
            else:
                title_text = title_tag.get_text().strip()
                if not title_text:
                    file_issues.append("Empty title tag")
                elif len(title_text) < 30:
                    file_warnings.append(f"Title too short ({len(title_text)} chars, recommended: 50-60)")
                elif len(title_text) > 60:
                    file_warnings.append(f"Title too long ({len(title_text)} chars, recommended: 50-60)")
                else:
                    file_good.append(f"Title tag optimized ({len(title_text)} chars)")
            
            # Check meta description
            meta_desc = soup.find('meta', attrs={'name': 'description'})
            if not meta_desc:
                file_issues.append("Missing meta description")
            else:
                desc_content = meta_desc.get('content', '').strip()
                if not desc_content:
                    file_issues.append("Empty meta description")
                elif len(desc_content) < 120:
                    file_warnings.append(f"Meta description too short ({len(desc_content)} chars, recommended: 150-160)")
                elif len(desc_content) > 160:
                    file_warnings.append(f"Meta description too long ({len(desc_content)} chars, recommended: 150-160)")
                else:
                    file_good.append(f"Meta description optimized ({len(desc_content)} chars)")
            
            # Check HTML lang attribute
            html_tag = soup.find('html')
            if not html_tag or not html_tag.get('lang'):
                file_issues.append("Missing HTML lang attribute")
            else:
                file_good.append(f"HTML lang attribute present: {html_tag.get('lang')}")
            
            # Check charset
            charset = soup.find('meta', attrs={'charset': True})
            if not charset:
                charset = soup.find('meta', attrs={'http-equiv': 'Content-Type'})
            if not charset:
                file_issues.append("Missing charset declaration")
            else:
                file_good.append("Charset declaration present")
            
            # Check viewport
            viewport = soup.find('meta', attrs={'name': 'viewport'})
            if not viewport:
                file_warnings.append("Missing viewport meta tag (critical for mobile SEO)")
            else:
                file_good.append("Viewport meta tag present")
            
            # Check H1 tags
            h1_tags = soup.find_all('h1')
            if len(h1_tags) == 0:
                file_issues.append("Missing H1 heading")
            elif len(h1_tags) > 1:
                file_warnings.append(f"Multiple H1 tags found ({len(h1_tags)}), should have exactly one")
            else:
                file_good.append("Single H1 tag present")
            
            # Check heading hierarchy
            headings = soup.find_all(['h1', 'h2', 'h3', 'h4', 'h5', 'h6'])
            if headings:
                prev_level = 0
                hierarchy_issues = []
                for heading in headings:
                    level = int(heading.name[1])
                    if level > prev_level + 1 and prev_level > 0:
                        hierarchy_issues.append(f"Jump from H{prev_level} to H{level} (should be sequential)")
                    prev_level = level
                
                if hierarchy_issues:
                    file_warnings.extend(hierarchy_issues)
                else:
                    file_good.append("Proper heading hierarchy")
            
            # Check images for alt text
            images = soup.find_all('img')
            images_without_alt = []
            for img in images:
                if not img.get('alt'):
                    images_without_alt.append(img.get('src', 'unknown'))
            
            if images_without_alt:
                file_issues.append(f"Images without alt text: {len(images_without_alt)}")
            elif images:
                file_good.append(f"All {len(images)} images have alt text")
            
            # Check Open Graph tags
            og_tags = soup.find_all('meta', attrs={'property': lambda x: x and x.startswith('og:')})
            required_og = ['og:title', 'og:description', 'og:type', 'og:url']
            og_present = {tag.get('property'): tag.get('content') for tag in og_tags}
            missing_og = [tag for tag in required_og if tag not in og_present]
            
            if missing_og:
                file_warnings.append(f"Missing Open Graph tags: {', '.join(missing_og)}")
            else:
                file_good.append("All required Open Graph tags present")
            
            # Check Twitter Card tags
            twitter_tags = soup.find_all('meta', attrs={'name': lambda x: x and x.startswith('twitter:')})
            if not twitter_tags:
                file_warnings.append("Missing Twitter Card tags")
            else:
                file_good.append("Twitter Card tags present")
            
            # Check canonical URL
            canonical = soup.find('link', attrs={'rel': 'canonical'})
            if not canonical:
                file_warnings.append("Missing canonical URL")
            else:
                file_good.append("Canonical URL present")
            
            # Check schema markup
            schema_scripts = soup.find_all('script', attrs={'type': 'application/ld+json'})
            if not schema_scripts:
                file_warnings.append("Missing schema.org structured data")
            else:
                file_good.append(f"Schema markup present ({len(schema_scripts)} script(s))")
            
            # Check content length
            body = soup.find('body')
            if body:
                text_content = body.get_text()
                word_count = len(text_content.split())
                if word_count < 300:
                    file_warnings.append(f"Low content length ({word_count} words, recommended: 300+)")
                else:
                    file_good.append(f"Good content length ({word_count} words)")
            
            # Store results
            if file_issues:
                self.issues[str(file_path)] = file_issues
                self.stats['files_with_issues'] += 1
                self.stats['total_issues'] += len(file_issues)
            
            if file_warnings:
                self.warnings[str(file_path)] = file_warnings
                self.stats['total_warnings'] += len(file_warnings)
            
            if file_good:
                self.good_practices[str(file_path)] = file_good
                
        except Exception as e:
            print(f"Error analyzing {file_path}: {str(e)}", file=sys.stderr)

    def analyze_directory(self, directory):
        """Analyze all HTML files in a directory recursively."""
        directory_path = Path(directory)
        html_files = list(directory_path.rglob('*.html'))
        
        for html_file in html_files:
            self.analyze_file(html_file)

    def generate_report(self, output_format='text'):
        """Generate SEO analysis report."""
        if output_format == 'json':
            return json.dumps({
                'timestamp': datetime.now().isoformat(),
                'statistics': self.stats,
                'critical_issues': dict(self.issues),
                'warnings': dict(self.warnings),
                'good_practices': dict(self.good_practices)
            }, indent=2)
        
        # Text format
        report = []
        report.append("=" * 80)
        report.append("SEO ANALYSIS REPORT")
        report.append("=" * 80)
        report.append(f"Generated: {datetime.now().strftime('%Y-%m-%d %H:%M:%S')}")
        report.append(f"Files analyzed: {self.stats['total_files']}")
        report.append(f"Files with issues: {self.stats['files_with_issues']}")
        report.append(f"Total critical issues: {self.stats['total_issues']}")
        report.append(f"Total warnings: {self.stats['total_warnings']}")
        report.append("")
        
        # Critical Issues
        if self.issues:
            report.append("🔴 CRITICAL ISSUES (Fix Immediately)")
            report.append("-" * 80)
            for file_path, issues in sorted(self.issues.items()):
                report.append(f"\n{file_path}:")
                for issue in issues:
                    report.append(f"  • {issue}")
            report.append("")
        
        # Warnings
        if self.warnings:
            report.append("⚠️  WARNINGS (Fix Soon for Optimal SEO)")
            report.append("-" * 80)
            for file_path, warnings in sorted(self.warnings.items()):
                report.append(f"\n{file_path}:")
                for warning in warnings:
                    report.append(f"  • {warning}")
            report.append("")
        
        # Good Practices
        if self.good_practices:
            report.append("✅ GOOD PRACTICES (Already Optimized)")
            report.append("-" * 80)
            for file_path, practices in sorted(self.good_practices.items()):
                report.append(f"\n{file_path}:")
                for practice in practices[:5]:  # Limit to 5 per file
                    report.append(f"  ✓ {practice}")
            report.append("")
        
        report.append("=" * 80)
        report.append("END OF REPORT")
        report.append("=" * 80)
        
        return "\n".join(report)


def main():
    parser = argparse.ArgumentParser(description='Analyze HTML files for SEO issues')
    parser.add_argument('target', help='File or directory to analyze')
    parser.add_argument('--json', action='store_true', help='Output in JSON format')
    args = parser.parse_args()
    
    analyzer = SEOAnalyzer()
    target_path = Path(args.target)
    
    if target_path.is_file():
        analyzer.analyze_file(target_path)
    elif target_path.is_dir():
        analyzer.analyze_directory(target_path)
    else:
        print(f"Error: {args.target} is not a valid file or directory", file=sys.stderr)
        sys.exit(1)
    
    output_format = 'json' if args.json else 'text'
    report = analyzer.generate_report(output_format)
    print(report)


if __name__ == '__main__':
    main()

