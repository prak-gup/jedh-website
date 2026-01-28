#!/usr/bin/env python3
"""
Verify that design system tokens are being used consistently
"""

import re
from pathlib import Path
from collections import defaultdict

def check_file(file_path: Path) -> dict:
    """Check a single file for design system compliance"""
    issues = defaultdict(list)

    try:
        content = file_path.read_text(encoding='utf-8')

        # Check for hardcoded hex colors (excluding rgba values)
        hex_colors = re.findall(r':\s*(#[0-9A-Fa-f]{3,6})(?![0-9A-Fa-f])', content)
        if hex_colors:
            # Filter out colors in comments or valid contexts
            for color in hex_colors:
                if color.upper() not in ['#FFF', '#FFFFFF', '#000', '#000000']:
                    issues['hardcoded_colors'].append(color)

        # Check for legacy variable usage
        legacy_vars = re.findall(r'var\(--(primary-color|secondary-color|text-dark|text-medium|bg-white|bg-light|border-color)\)', content)
        if legacy_vars:
            issues['legacy_variables'].extend(set(legacy_vars))

        # Check for hardcoded z-index (excluding media queries)
        zindex = re.findall(r'z-index:\s*(\d{4})', content)
        if zindex:
            issues['hardcoded_zindex'].extend(set(zindex))

        # Check for :root definitions (should not exist in HTML files)
        if file_path.suffix == '.html' and ':root{' in content:
            issues['duplicate_root'].append('Has :root definition')

    except Exception as e:
        issues['errors'].append(str(e))

    return dict(issues)

def main():
    base_dir = Path(__file__).parent.parent
    print("🔍 Verifying Design System Compliance\n")
    print("=" * 60)

    # Check all HTML files
    html_files = list(base_dir.glob('**/*.html'))
    html_files = [f for f in html_files if 'test' not in f.name and 'docs' not in str(f)]

    # Check CSS files
    css_files = [
        base_dir / 'css/style.css',
        base_dir / 'css/pages.css',
        base_dir / 'css/fixes.css',
    ]

    all_issues = {}

    print("\n📄 Checking HTML Files...")
    for html_file in html_files:
        if html_file.exists():
            issues = check_file(html_file)
            if issues:
                all_issues[str(html_file.relative_to(base_dir))] = issues

    print(f"   Checked {len(html_files)} HTML files")

    print("\n🎨 Checking CSS Files...")
    for css_file in css_files:
        if css_file.exists():
            issues = check_file(css_file)
            if issues:
                all_issues[str(css_file.relative_to(base_dir))] = issues

    print(f"   Checked {len(css_files)} CSS files")

    print("\n" + "=" * 60)

    if not all_issues:
        print("\n✅ All files are compliant with the design system!")
        print("\n✨ No issues found:")
        print("   • No hardcoded hex colors")
        print("   • No legacy variable names")
        print("   • No duplicate :root definitions")
        print("   • Design system tokens used consistently")
    else:
        print("\n⚠️  Found some issues:\n")
        for file_path, issues in all_issues.items():
            print(f"📁 {file_path}")
            for issue_type, items in issues.items():
                print(f"   • {issue_type}: {len(items)} occurrences")
                if len(items) <= 5:
                    for item in items:
                        print(f"     - {item}")
            print()

    print("=" * 60)

if __name__ == "__main__":
    main()
