# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This repository contains planning and content documentation for the Jaipur Eye & Dental Hospital (JEDH) website redesign. JEDH is a dual-specialty medical facility offering comprehensive eye care and dental services in Jaipur, Rajasthan, with a significant NRI patient base.

**Current Site**: https://jaipureyedental.com/ (WordPress 6.8.3)

## Repository Structure

This is a **documentation-only repository** with no code artifacts. All files are planning documents for website content, structure, and SEO strategy:

- [README.md](README.md) - Complete site content crawl including all pages, services, doctor profiles, pricing, and FAQs from the existing website
- [jedh_site_ia_wireframes.md](jedh_site_ia_wireframes.md) - Site navigation hierarchy, URL structure, and wireframe notes for key pages
- [jedh_week2_copy_and_seo.md](jedh_week2_copy_and_seo.md) - Page-by-page copy sections with bilingual (English/Hindi) headlines and CTAs, plus keyword mapping
- [jedh_seo_keyword_mapping.md](jedh_seo_keyword_mapping.md) - Detailed keyword cluster mapping per page with search intent and schema markup recommendations
- `Brand overview.docx` - Brand positioning and messaging guidelines
- `customer persona.docx` - Target audience research and personas
- `Images/` - Brand assets (logo, team photos, empanelment certificates, hospital photos)

## Content Architecture

### Service Categories

**Eye Care Services:**
- Cataract Surgery (/eye/cataract-surgery)
- LASIK/PRK (/eye/lasik-prk)
- Glaucoma Care (/eye/glaucoma)
- Pediatric Myopia (/eye/pediatric-myopia)

**Dental Care Services:**
- Dental Implants (/dental/implants)
- Invisalign (/dental/invisalign)
- Cosmetic Dentistry (/dental/cosmetic)
- Preventive Care (/dental/preventive)

**NRI-Specific Pages:**
- USA Patients (/nri/usa)
- UK Patients (/nri/uk)
- Middle East Patients (/nri/middle-east)

### Bilingual Content Strategy

All patient-facing content requires:
- **Primary language**: English
- **Secondary language**: Hindi (Devanagari script)
- Both languages for all CTAs, headlines, and key messaging
- Format: `[EN] English text. [HI] हिंदी पाठ।`

### SEO Strategy

**Primary target**: Local Jaipur search intent
- Eye care: "cataract surgery Jaipur", "LASIK Jaipur", "glaucoma specialist Jaipur"
- Dental care: "dental implants Jaipur", "Invisalign Jaipur", "cosmetic dentist Jaipur"

**Secondary target**: NRI medical tourism
- "eye surgery India for NRIs", "dental implants India NRI"

**Schema Markup Requirements**:
- Organization, MedicalBusiness, LocalBusiness (site-wide)
- MedicalProcedure, Physician, FAQPage (service pages)
- Review, AggregateRating (reviews page)
- Offer, PriceSpecification (pricing page)

### Doctor Profiles

**Eye Specialists:**
- Dr. Amit Gupta (Eye Surgeon - Cataract/Glaucoma/LASIK)
- Dr. Manju Meena (Oculoplastic Surgeon)
- Dr. Kapil Bhatia (Retina Specialist)
- Dr. Deepak Goyal (Pediatric Ophthalmologist)
- Dr. Piyush Gupta (Cornea Specialist)

**Dental Specialists:**
- Dr. Nehal Gupta (Senior Dental Surgeon - Smile Design/Implants)
- Dr. Neha Agarwal (Oral & Maxillofacial Surgeon)
- Dr. Siddharth Mehta (Orthodontist - Invisalign)
- Dr. Nilisha Shukla (Oral and Maxillofacial Prosthodontist)
- Dr. Shrestha Singhania (Prosthodontist - Implants)
- Dr. Manojit Mahato (Pedodontist)
- Dr. Bhawna Jethan (Endodontist - Microscopic RCT)

## Key Messaging Pillars

1. **Trust**: Doctor-led since 2008, 10k+ patients, 4.8★ rating
2. **Transparency**: Clear pricing ranges, bilingual communication
3. **Technology**: Modern equipment (Phaco/Femto cataract, Contoura Vision, CAD-CAM crowns, Digital Smile Design)
4. **Accessibility**: Painless procedures, same-week consultations, WhatsApp booking
5. **Insurance**: Cashless facilities for RGHS, CGHS, major insurers
6. **NRI-Friendly**: Combined eye+dental packages, hotel tie-ups, remote follow-ups

## Pricing Transparency

All service pages must include transparent pricing ranges (from README.md):

**Eye Care:**
- Cataract: ₹18,000/eye (monofocal) to ₹125,000/eye (premium multifocal)
- LASIK/Contoura: ₹35,000–₹70,000/eye

**Dental Care:**
- Implants: ₹25,000–₹100,000/tooth
- Root Canal: ₹4,000–₹8,000/tooth
- Invisalign: ₹75,000+ (case dependent)
- Crowns: ₹5,000–₹18,000 (by material)

## Primary CTAs

All pages require strategically placed CTAs:
- Top (hero section)
- Mid-page (after key content)
- Footer

**Standard CTA patterns:**
- Book consultation/appointment
- WhatsApp chat
- Get personalized quote
- Book specific service (3D scan, screening, evaluation)

## Contact Information

- **Phone**: +91 9602227267
- **Email**: dramit.eye@gmail.com
- **WhatsApp**: https://wa.me/919602227267
- **Instagram**: @jaipureyedentalhospital
- **YouTube**: @jedh

## Working with This Repository

### When Writing New Content

1. Check existing copy structure in [jedh_week2_copy_and_seo.md](jedh_week2_copy_and_seo.md)
2. Include both English and Hindi versions
3. Verify pricing ranges against [README.md](README.md)
4. Use appropriate primary/secondary keywords from [jedh_seo_keyword_mapping.md](jedh_seo_keyword_mapping.md)
5. Include schema markup recommendations

### When Updating Site Structure

1. Review navigation hierarchy in [jedh_site_ia_wireframes.md](jedh_site_ia_wireframes.md)
2. Maintain URL slug consistency (/eye/*, /dental/*, /nri/*)
3. Ensure all pages have defined Primary CTA

### When Adding Doctor Profiles

1. Include all credentials (MBBS, MS, MDS, Fellowships)
2. List specialties and experience years
3. Add contact information if senior doctor
4. Reference existing profiles in [README.md](README.md) for format

### When Working with Images

All brand assets are in `Images/` directory:
- Logo: JEDH Logo.png
- Team photos: JEDH Team Blue.jpeg, JEDH Team_1.jpeg, JEDH Team_2.jpeg
- Doctor panel: JEDH Dental Doctor Panel.jpeg
- Empanelment proofs: Empanelment_1.jpeg, Empanelment_2.jpeg
- Hospital photos: HOSPITAL PHOTO/
- Insurance logos: Cashless/

## Important Notes

- This is a **planning repository only** - no live website code exists here
- The actual website runs on WordPress 6.8.3 with Elementor
- All content must support both local Jaipur and NRI international audiences
- Maintain medical accuracy and transparency in all claims
- Emphasize painless procedures and patient comfort throughout messaging
