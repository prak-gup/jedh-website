# Navigation Fix Guide

## Problem
Navigation links use root-relative paths (`/page.html`) which don't work when opening HTML files directly in browser.

## Solution Options

### Option 1: Use a Local Web Server (RECOMMENDED)
This preserves the correct structure for production:

```bash
# Navigate to website folder
cd "/Users/prakhar/Desktop/Meegrow/JEDH 4/website"

# Start Python server
python3 -m http.server 8000

# Open in browser
# Visit: http://localhost:8000
```

Now ALL navigation will work perfectly!

### Option 2: Convert to Relative Paths
Replace all navigation links:

**Current (root-relative):**
```html
<a href="/eye/cataract-surgery">Cataract Surgery</a>
<a href="/doctors">Doctors</a>
```

**Change to (relative):**
```html
<!-- From homepage (index.html) -->
<a href="eye/cataract-surgery.html">Cataract Surgery</a>
<a href="doctors.html">Doctors</a>

<!-- From eye/cataract-surgery.html -->
<a href="../index.html">Home</a>
<a href="../doctors.html">Doctors</a>
<a href="lasik-prk.html">LASIK/PRK</a>

<!-- From nri/usa.html -->
<a href="../index.html">Home</a>
<a href="../doctors.html">Doctors</a>
<a href="index.html">NRI Overview</a>
```

**Pattern:**
- Same folder: `page.html`
- Parent folder: `../page.html`
- Child folder: `folder/page.html`

### Option 3: Use .htaccess (For Production)
When deploying, this lets you use clean URLs without `.html`:

```apache
# .htaccess file
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^([^\.]+)$ $1.html [NC,L]
```

---

## Quick Navigation Map

### Homepage → Other Pages
```
index.html
├── eye/cataract-surgery.html
├── eye/lasik-prk.html
├── eye/index.html
├── dental/implants.html
├── dental/invisalign.html
├── dental/index.html
├── doctors.html
├── pricing.html
├── reviews.html
├── contact.html
├── book.html
├── nri/index.html
├── nri/usa.html
├── nri/uk.html
├── nri/middle-east.html
└── blog/index.html
```

### Service Pages → Homepage
```
eye/cataract-surgery.html → ../index.html
dental/implants.html → ../index.html
nri/usa.html → ../index.html
```

### Between Service Pages (Same Folder)
```
eye/cataract-surgery.html → lasik-prk.html (same folder)
eye/cataract-surgery.html → index.html (eye overview)
```

---

## For Testing Now

**Easiest way to test everything:**

1. Open Terminal
2. Run:
```bash
cd "/Users/prakhar/Desktop/Meegrow/JEDH 4/website"
python3 -m http.server 8000
```
3. Open browser to: `http://localhost:8000`
4. All navigation will work!

**Why this works:**
- Python server treats the folder as a website root
- `/page` resolves correctly to `/page.html`
- All links function as intended
