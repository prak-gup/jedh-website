<?php
/**
 * NRI Section Template Part
 *
 * @package JEDH
 */
?>

<!-- NRI Section -->
<section class="nri-section">
    <div class="container">
        <div class="nri-content">
            <div class="nri-text">
                <span class="section-badge">For International Patients</span>
                <h2 data-en="NRI & Medical Tourism Packages" data-hi="NRI और मेडिकल टूरिज्म पैकेज">NRI & Medical Tourism Packages</h2>
                <p data-en="We welcome patients from USA, UK, Middle East and worldwide. Combined eye + dental packages, hotel assistance, airport transfers, and remote follow-ups available." data-hi="हम USA, UK, मध्य पूर्व और दुनिया भर के रोगियों का स्वागत करते हैं। संयुक्त नेत्र + दंत पैकेज, होटल सहायता, हवाई अड्डा स्थानांतरण, और दूरस्थ फॉलो-अप उपलब्ध।">We welcome patients from USA, UK, Middle East and worldwide. Combined eye + dental packages, hotel assistance, airport transfers, and remote follow-ups available.</p>

                <ul class="nri-features">
                    <li><i class="fas fa-check-circle"></i> Pre-arrival WhatsApp consultations</li>
                    <li><i class="fas fa-check-circle"></i> Coordinated treatment scheduling</li>
                    <li><i class="fas fa-check-circle"></i> Hotel and transport arrangements</li>
                    <li><i class="fas fa-check-circle"></i> Post-treatment remote monitoring</li>
                </ul>

                <div class="nri-ctas">
                    <a href="<?php echo home_url('/nri/'); ?>" class="btn btn-primary">
                        <span data-en="Explore NRI Packages" data-hi="NRI पैकेज देखें">Explore NRI Packages</span>
                    </a>
                    <a href="https://wa.me/<?php echo jedh_get_option('whatsapp', '919602227267'); ?>" class="btn btn-outline">
                        <i class="fab fa-whatsapp"></i>
                        <span data-en="Plan on WhatsApp" data-hi="व्हाट्सएप पर योजना बनाएं">Plan on WhatsApp</span>
                    </a>
                </div>
            </div>
            <div class="nri-image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/JEDH Team Blue.jpeg" alt="JEDH Medical Team" class="nri-img">
            </div>
        </div>
    </div>
</section>
