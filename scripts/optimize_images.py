#!/usr/bin/env python3
"""
Image Optimization Script for JEDH Website
Optimizes Pexels images for web use with WebP conversion and responsive sizes
"""

import os
import sys
from pathlib import Path
from PIL import Image
import subprocess

# Configuration
PEXELS_DIR = Path("assets/images/pexels")
QUALITY_JPG = 85
QUALITY_WEBP = 80

# Responsive sizes
SIZES = {
    "hero": {
        "desktop": (1920, 1280),
        "tablet": (1280, 853),
        "mobile": (800, 533)
    },
    "service": {
        "large": (800, 600),
        "medium": (640, 480),
        "small": (400, 300)
    },
    "avatar": {
        "standard": (200, 200)
    }
}

def optimize_image(input_path, output_path, size=None, quality=85):
    """Optimize a single image"""
    try:
        with Image.open(input_path) as img:
            # Convert RGBA to RGB if needed
            if img.mode == 'RGBA':
                img = img.convert('RGB')

            # Resize if size specified
            if size:
                img = img.resize(size, Image.Resampling.LANCZOS)

            # Save optimized image
            img.save(output_path, quality=quality, optimize=True)

            # Get file sizes
            original_size = os.path.getsize(input_path) / 1024
            new_size = os.path.getsize(output_path) / 1024
            savings = ((original_size - new_size) / original_size) * 100

            print(f"✓ {output_path.name}: {original_size:.1f}KB → {new_size:.1f}KB ({savings:.1f}% smaller)")
            return True
    except Exception as e:
        print(f"✗ Error optimizing {input_path.name}: {e}")
        return False

def convert_to_webp(input_path, output_path, quality=80):
    """Convert image to WebP format"""
    try:
        with Image.open(input_path) as img:
            # Convert RGBA to RGB if needed
            if img.mode == 'RGBA':
                img = img.convert('RGB')

            # Save as WebP
            img.save(output_path, 'WEBP', quality=quality, method=6)

            jpg_size = os.path.getsize(input_path) / 1024
            webp_size = os.path.getsize(output_path) / 1024
            savings = ((jpg_size - webp_size) / jpg_size) * 100

            print(f"✓ {output_path.name}: {webp_size:.1f}KB ({savings:.1f}% smaller than JPG)")
            return True
    except Exception as e:
        print(f"✗ Error converting {input_path.name} to WebP: {e}")
        return False

def create_responsive_versions(image_path, category):
    """Create responsive versions of an image"""
    if category not in SIZES:
        print(f"✗ Unknown category: {category}")
        return

    base_name = image_path.stem
    output_dir = image_path.parent

    print(f"\n📐 Creating responsive versions for: {image_path.name}")

    for size_name, dimensions in SIZES[category].items():
        # Create JPG version
        output_jpg = output_dir / f"{base_name}-{size_name}.jpg"
        optimize_image(image_path, output_jpg, size=dimensions, quality=QUALITY_JPG)

        # Create WebP version
        output_webp = output_dir / f"{base_name}-{size_name}.webp"
        convert_to_webp(output_jpg, output_webp, quality=QUALITY_WEBP)

def process_directory(directory, category):
    """Process all images in a directory"""
    image_dir = PEXELS_DIR / directory

    if not image_dir.exists():
        print(f"✗ Directory not found: {image_dir}")
        return

    print(f"\n{'='*60}")
    print(f"Processing {directory}/ images (category: {category})")
    print(f"{'='*60}")

    # Find all JPG files
    images = list(image_dir.glob("*.jpg")) + list(image_dir.glob("*.jpeg"))

    if not images:
        print(f"⚠️  No images found in {directory}/")
        return

    for image_path in images:
        # Skip already processed images (with size suffixes)
        if any(suffix in image_path.stem for suffix in ['-desktop', '-tablet', '-mobile', '-large', '-medium', '-small', '-standard']):
            continue

        print(f"\n🖼️  Processing: {image_path.name}")

        # Create responsive versions
        create_responsive_versions(image_path, category)

        # Also create WebP of original
        webp_path = image_path.with_suffix('.webp')
        convert_to_webp(image_path, webp_path, quality=QUALITY_WEBP)

def main():
    """Main function"""
    print("="*60)
    print("JEDH Website Image Optimizer")
    print("="*60)

    # Check if PIL is available
    try:
        from PIL import Image
    except ImportError:
        print("✗ Error: Pillow library not found")
        print("Install with: pip install Pillow")
        sys.exit(1)

    # Check if Pexels directory exists
    if not PEXELS_DIR.exists():
        print(f"✗ Error: Pexels directory not found: {PEXELS_DIR}")
        print(f"Please download images first according to docs/PEXELS_IMAGE_GUIDE.md")
        sys.exit(1)

    # Process each category
    categories = {
        "hero": "hero",
        "services": "service",
        "testimonials": "avatar",
        "doctors": "avatar",
        "nri": "hero"
    }

    total_processed = 0

    for directory, category in categories.items():
        if (PEXELS_DIR / directory).exists():
            process_directory(directory, category)
            total_processed += 1

    print(f"\n{'='*60}")
    print(f"✓ Optimization complete!")
    print(f"Processed {total_processed} directories")
    print(f"{'='*60}")
    print("\nNext steps:")
    print("1. Check assets/images/pexels/ for optimized images")
    print("2. Update HTML files with responsive image markup")
    print("3. Test images on different screen sizes")

if __name__ == "__main__":
    main()
