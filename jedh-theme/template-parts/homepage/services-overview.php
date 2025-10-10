<?php
/**
 * Services Overview Template Part
 *
 * @package JEDH
 */
?>

<!-- Services Overview -->
<section class="services-overview">
    <div class="container">
        <div class="section-header text-center">
            <h2 data-en="Our Specialties" data-hi="हमारी विशेषताएं">Our Specialties</h2>
            <p data-en="Comprehensive eye and dental care under one roof" data-hi="एक छत के नीचे व्यापक नेत्र और दंत चिकित्सा देखभाल">Comprehensive eye and dental care under one roof</p>
        </div>

        <div class="services-cards">
            <!-- Eye Care Card -->
            <div class="service-card eye-care">
                <div class="service-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <h3 data-en="Eye Care Services" data-hi="नेत्र देखभाल सेवाएं">Eye Care Services</h3>
                <ul class="service-list">
                    <li><i class="fas fa-check-circle"></i> Cataract Surgery (from ₹18,000)</li>
                    <li><i class="fas fa-check-circle"></i> LASIK & Contoura Vision</li>
                    <li><i class="fas fa-check-circle"></i> Glaucoma Treatment</li>
                    <li><i class="fas fa-check-circle"></i> Pediatric Eye Care</li>
                    <li><i class="fas fa-check-circle"></i> Retina & Cornea Care</li>
                </ul>
                <a href="<?php echo home_url('/services/'); ?>" class="btn btn-outline">
                    <span data-en="Explore Eye Services" data-hi="नेत्र सेवाएँ देखें">Explore Eye Services</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <!-- Dental Care Card -->
            <div class="service-card dental-care">
                <div class="service-icon">
                    <i class="fas fa-tooth"></i>
                </div>
                <h3 data-en="Dental Care Services" data-hi="दंत चिकित्सा सेवाएं">Dental Care Services</h3>
                <ul class="service-list">
                    <li><i class="fas fa-check-circle"></i> Dental Implants (from ₹25,000)</li>
                    <li><i class="fas fa-check-circle"></i> Invisalign & Braces</li>
                    <li><i class="fas fa-check-circle"></i> Cosmetic Dentistry</li>
                    <li><i class="fas fa-check-circle"></i> Root Canal Treatment</li>
                    <li><i class="fas fa-check-circle"></i> Smile Makeover</li>
                </ul>
                <a href="<?php echo home_url('/services/'); ?>" class="btn btn-outline">
                    <span data-en="Explore Dental Services" data-hi="दंत सेवाएँ देखें">Explore Dental Services</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>
