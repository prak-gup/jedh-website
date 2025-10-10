# JEDH Website

Modern, SEO-optimized website for Jaipur Eye & Dental Hospital.

## 🚀 Quick Start

1. Open `index.html` in your browser to view the homepage
2. All assets are in the `assets/` folder
3. No build process required - pure HTML, CSS, and JavaScript

## 📁 Project Structure

```
website/
├── index.html              # Homepage
├── css/
│   └── style.css          # Main stylesheet
├── js/
│   └── main.js            # JavaScript functionality
├── assets/
│   └── images/            # All images (logo, team photos, insurance logos)
└── README.md
```

## ✨ Features

### Homepage Includes:
- **Hero Section** with bilingual content (EN/HI)
- **Services Overview** for Eye Care and Dental Care
- **Why Choose JEDH** section with 6 key features
- **Insurance Partners** display
- **Transparent Pricing** cards for 4 main services
- **Video Section** placeholder
- **Patient Testimonials** slider
- **NRI Medical Tourism** section
- **Strategic CTAs** throughout (WhatsApp, Phone, Book)
- **Floating WhatsApp Button**
- **Responsive Design** (mobile, tablet, desktop)

### SEO Features:
- Complete meta tags (title, description, keywords)
- Open Graph tags for social sharing
- Structured data (Schema.org JSON-LD)
- Semantic HTML5 markup
- Optimized heading hierarchy
- XML sitemap ready

### UX Features:
- Bilingual content switcher (English/Hindi)
- Smooth scroll animations
- Mobile-friendly navigation
- Sticky header
- Lazy loading ready
- Performance optimized

## 🎨 Design System

### Colors:
- Primary Blue: `#0066CC`
- Secondary Green: `#00A86B`
- Eye Care Accent: `#4A90E2`
- Dental Care Accent: `#2ECC71`

### Typography:
- Headings: Poppins
- Body: Inter

### CTAs:
All CTAs are optimized for conversion with:
- Clear action words
- WhatsApp integration
- Phone call integration
- Bilingual support

## 📱 Responsive Breakpoints

- Desktop: 1200px+
- Tablet: 768px - 1024px
- Mobile: < 768px

## 🔧 Customization

### To add more insurance logos:
1. Add logo images to `assets/images/Cashless/`
2. Update the `loadInsuranceLogos()` function in `main.js`

### To add actual videos:
Replace the video placeholder in the Video Section with:
```html
<iframe src="YOUTUBE_EMBED_URL" frameborder="0" allowfullscreen></iframe>
```

### To update images:
Replace placeholder images in:
- Hero section: Update `src` in `.hero-img`
- Team photo: Update in `.nri-img`
- Hospital photos: Add to `assets/images/HOSPITAL PHOTO/`

## 📊 Analytics Integration

To add Google Analytics:
1. Uncomment the analytics code in `main.js`
2. Add your GA tracking ID
3. All CTA clicks are tracked automatically

## 🌐 Next Steps

### Additional Pages to Build:
1. `/eye` - Eye Care Services Overview
2. `/eye/cataract-surgery` - Cataract Surgery Detail
3. `/eye/lasik-prk` - LASIK/PRK Detail
4. `/eye/glaucoma` - Glaucoma Care Detail
5. `/eye/pediatric-myopia` - Pediatric Myopia Detail
6. `/dental` - Dental Care Services Overview
7. `/dental/implants` - Dental Implants Detail
8. `/dental/invisalign` - Invisalign Detail
9. `/dental/cosmetic` - Cosmetic Dentistry Detail
10. `/dental/preventive` - Preventive Care Detail
11. `/doctors` - Doctors Directory
12. `/pricing` - Complete Pricing Table
13. `/reviews` - Reviews & Testimonials
14. `/nri` - NRI Medical Tourism Hub
15. `/contact` - Contact & Location
16. `/book` - Appointment Booking Form

### Backend Integration:
- Booking form submission
- Contact form handling
- CRM integration
- Email notifications
- WhatsApp API integration

## 📞 Contact Information

**Phone:** +91 9602227267
**Email:** dramit.eye@gmail.com
**WhatsApp:** https://wa.me/919602227267
**Instagram:** @jaipureyedentalhospital
**YouTube:** @jedh

## 📝 Notes

- All pricing is accurate as of October 2025
- Update doctor profiles regularly
- Keep testimonials authentic and recent
- Update insurance partners list quarterly
- Refresh blog content weekly for SEO

---

Built with ❤️ for JEDH by following modern web standards and SEO best practices.
