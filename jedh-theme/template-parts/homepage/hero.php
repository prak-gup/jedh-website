<?php
/**
 * Hero Section Template Part
 *
 * @package JEDH
 */
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <span class="hero-badge" data-en="Since 2017 | 10,000+ Patients Treated" data-hi="2017 से | 10,000+ रोगियों का इलाज">Since 2017 | 10,000+ Patients Treated</span>
                <h1 class="hero-title" data-en="Trusted Eye and Dental Care in Jaipur" data-hi="जयपुर में विश्वसनीय नेत्र और दंत चिकित्सा">Trusted Eye and Dental Care in Jaipur</h1>
                <p class="hero-subtitle" data-en="Doctor-led. Bilingual support. Modern equipment. Transparent pricing." data-hi="डॉक्टर के नेतृत्व में। द्विभाषी सहायता। आधुनिक उपकरण। पारदर्शी मूल्य निर्धारण।">Doctor-led. Bilingual support. Modern equipment. Transparent pricing.</p>

                <!-- Trust Badges -->
                <div class="trust-badges">
                    <div class="badge-item">
                        <i class="fas fa-star"></i>
                        <span>4.8★ Rating</span>
                    </div>
                    <div class="badge-item">
                        <i class="fas fa-users"></i>
                        <span>10k+ Patients</span>
                    </div>
                    <div class="badge-item">
                        <i class="fas fa-award"></i>
                        <span>7+ Years</span>
                    </div>
                </div>

                <!-- Hero CTAs -->
                <div class="hero-ctas">
                    <a href="https://wa.me/<?php echo jedh_get_option('whatsapp', '919602227267'); ?>" class="btn btn-primary btn-lg">
                        <i class="fab fa-whatsapp"></i>
                        <span data-en="Book Same-Week Consultation" data-hi="इस सप्ताह परामर्श बुक करें">Book Same-Week Consultation</span>
                    </a>
                    <a href="tel:<?php echo jedh_get_option('phone', '+919602227267'); ?>" class="btn btn-secondary btn-lg">
                        <i class="fas fa-phone"></i>
                        <span data-en="Call Now" data-hi="अभी कॉल करें">Call Now</span>
                    </a>
                </div>
            </div>
            <div class="hero-visual">
                <div class="hero-icon-card">
                    <i class="fas fa-eye"></i>
                    <span>Advanced Eye Care</span>
                </div>
                <div class="hero-icon-card">
                    <i class="fas fa-tooth"></i>
                    <span>Modern Dentistry</span>
                </div>
                <div class="hero-icon-card">
                    <i class="fas fa-user-md"></i>
                    <span>Expert Doctors</span>
                </div>
            </div>
        </div>
    </div>
</section>
