# JEDH WordPress Theme

A custom WordPress theme for Jaipur Eye & Dental Hospital (JEDH) - a professional medical website with eye care and dental services, bilingual support, and booking system.

## Features

- **Custom Post Types**: Doctors, Services, Reviews, Bookings
- **Bilingual Support**: English and Hindi language switching
- **Responsive Design**: Mobile-first approach
- **Booking System**: Integrated appointment booking with WhatsApp integration
- **SEO Optimized**: Schema markup and meta tags
- **Custom Fields**: Doctor profiles, service pricing, review ratings
- **Insurance Integration**: Cashless insurance provider logos
- **Modern UI**: Clean, professional medical website design

## Installation

### Method 1: Upload via WordPress Admin

1. **Zip the theme folder**:
   ```bash
   cd /path/to/your/website
   zip -r jedh-theme.zip jedh-theme/
   ```

2. **Upload to WordPress**:
   - Go to WordPress Admin → Appearance → Themes
   - Click "Add New" → "Upload Theme"
   - Choose the `jedh-theme.zip` file
   - Click "Install Now" → "Activate"

### Method 2: FTP Upload

1. **Upload via FTP**:
   - Upload the `jedh-theme` folder to `/wp-content/themes/`
   - Go to WordPress Admin → Appearance → Themes
   - Find "JEDH - Jaipur Eye & Dental Hospital" theme
   - Click "Activate"

## Configuration

### 1. Set Up Menus

1. Go to **Appearance → Menus**
2. Create a new menu called "Primary Menu"
3. Add pages and custom links:
   - Home
   - Eye Care (with submenu items)
   - Dental Care (with submenu items)
   - Our Doctors
   - Pricing
   - Reviews
   - Contact
4. Assign to "Primary Menu" location

### 2. Configure Contact Information

1. Go to **Appearance → Customize → Contact Information**
2. Update:
   - Phone Number: `+91 9602227267`
   - Email Address: `dramit.eye@gmail.com`
   - WhatsApp Number: `919602227267`
   - Working Hours: `Mon-Sat: 9:00 AM - 7:00 PM`

### 3. Add Content

#### Doctors
1. Go to **Doctors → Add New**
2. Add doctor information:
   - Name, specialty, experience
   - Qualifications, phone, email
   - Consultation fee
   - Featured image

#### Services
1. Go to **Services → Add New**
2. Add service details:
   - Title and description
   - Category (Eye Care/Dental Care)
   - Price range (from/to)
   - Duration and features
   - Featured image

#### Reviews
1. Go to **Reviews → Add New**
2. Add review information:
   - Patient name and rating (1-5)
   - Service type and date
   - Review content

### 4. Create Pages

Create these essential pages:

1. **Home** (set as homepage)
2. **Services** - List all services
3. **Doctors** - List all doctors
4. **Pricing** - Service pricing information
5. **Reviews** - Patient testimonials
6. **Contact** - Contact information and booking form
7. **NRI** - Information for international patients

### 5. Set Homepage

1. Go to **Settings → Reading**
2. Set "Your homepage displays" to "A static page"
3. Select your "Home" page as the homepage

## Customization

### Colors and Styling

The theme uses CSS custom properties for easy customization. Edit `css/style.css`:

```css
:root {
    --primary-color: #2563eb;
    --secondary-color: #64748b;
    --accent-color: #f59e0b;
    --text-color: #1f2937;
    --bg-color: #ffffff;
}
```

### Adding New Services

1. Go to **Services → Add New**
2. Fill in the service details
3. Set featured image
4. Add to appropriate category
5. Set pricing and features

### Managing Bookings

1. Go to **Bookings** in WordPress admin
2. View all booking requests
3. Update booking status
4. Contact patients as needed

## File Structure

```
jedh-theme/
├── style.css              # Theme stylesheet with header
├── index.php              # Main template
├── header.php             # Site header
├── footer.php             # Site footer
├── functions.php          # Theme functions
├── sidebar.php            # Sidebar template
├── searchform.php         # Search form
├── 404.php               # 404 error page
├── page.php              # Page template
├── single.php            # Single post template
├── archive.php           # Archive template
├── single-doctor.php     # Single doctor template
├── single-service.php    # Single service template
├── single-review.php     # Single review template
├── archive-doctor.php    # Doctor archive template
├── archive-service.php   # Service archive template
├── archive-review.php    # Review archive template
├── template-parts/       # Template parts
│   ├── homepage/         # Homepage sections
│   └── booking-form.php  # Booking form
├── css/                  # Stylesheets
│   ├── style.css
│   └── pages.css
├── js/                   # JavaScript files
│   └── main.js
├── assets/               # Images and media
│   └── images/
└── screenshot.png        # Theme screenshot
```

## Required Plugins

While the theme works without plugins, these are recommended:

1. **Contact Form 7** - For contact forms
2. **Yoast SEO** - For SEO optimization
3. **WP Rocket** - For performance optimization
4. **Polylang** - For proper bilingual support

## Support

For theme support and customization:

- **Email**: dramit.eye@gmail.com
- **Phone**: +91 9602227267
- **WhatsApp**: +91 9602227267

## Changelog

### Version 1.0.0
- Initial release
- Custom post types for Doctors, Services, Reviews
- Booking system integration
- Bilingual support (EN/HI)
- Responsive design
- SEO optimization
- Insurance provider integration

## License

This theme is licensed under GPL v2 or later.

---

**JEDH - Jaipur Eye & Dental Hospital**  
*Trusted eye and dental care in Jaipur since 2008*
