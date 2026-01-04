<?php
/**
 * CTA Banner Template Part
 *
 * @package JEDH
 */
?>

<!-- CTA Banner -->
<section class="cta-banner">
    <div class="container">
        <div class="cta-content">
            <div class="cta-text">
                <h2 data-en="Ready to Get Started?" data-hi="शुरू करने के लिए तैयार?">Ready to Get Started?</h2>
                <p data-en="Book your consultation today and experience world-class eye and dental care" data-hi="आज अपना परामर्श बुक करें और विश्व स्तरीय नेत्र और दंत चिकित्सा का अनुभव करें">Book your consultation today and experience world-class eye and dental care</p>
            </div>
            <div class="cta-buttons">
                <a href="https://wa.me/<?php echo jedh_get_option('whatsapp', '917976551251'); ?>" class="btn btn-white btn-lg">
                    <i class="fab fa-whatsapp"></i>
                    <span data-en="WhatsApp Us" data-hi="व्हाट्सएप करें">WhatsApp Us</span>
                </a>
                <a href="tel:<?php echo jedh_get_option('phone', '+917976551251'); ?>" class="btn btn-outline-white btn-lg">
                    <i class="fas fa-phone"></i>
                    <span data-en="Call <?php echo jedh_get_option('phone', '+91 7976551251'); ?>" data-hi="<?php echo jedh_get_option('phone', '+91 7976551251'); ?> पर कॉल करें">Call <?php echo jedh_get_option('phone', '+91 7976551251'); ?></span>
                </a>
            </div>
        </div>
    </div>
</section>
