    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-col">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/JEDH Logo.png" alt="<?php bloginfo('name'); ?>" class="footer-logo">
                    <?php endif; ?>
                    <p data-en="Trusted eye and dental care in Jaipur since 2017. Doctor-led, patient-focused healthcare." data-hi="2017 से जयपुर में विश्वसनीय नेत्र और दंत चिकित्सा देखभाल। डॉक्टर के नेतृत्व में, रोगी-केंद्रित स्वास्थ्य सेवा।">
                        <?php echo get_bloginfo('description'); ?>
                    </p>
                    <div class="social-links">
                        <a href="https://www.instagram.com/jaipureyedentalhospital" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.youtube.com/@jedh" target="_blank"><i class="fab fa-youtube"></i></a>
                        <a href="https://www.linkedin.com/in/dr-amit-gupta-1938985b/" target="_blank"><i class="fab fa-linkedin"></i></a>
                        <a href="https://wa.me/<?php echo jedh_get_option('whatsapp', '919602227267'); ?>" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Eye Care</h4>
                    <ul>
                        <li><a href="<?php echo home_url('/services/cataract-surgery/'); ?>">Cataract Surgery</a></li>
                        <li><a href="<?php echo home_url('/services/lasik-prk/'); ?>">LASIK/PRK</a></li>
                        <li><a href="<?php echo home_url('/services/glaucoma-care/'); ?>">Glaucoma Care</a></li>
                        <li><a href="<?php echo home_url('/services/pediatric-myopia/'); ?>">Pediatric Myopia</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Dental Care</h4>
                    <ul>
                        <li><a href="<?php echo home_url('/services/dental-implants/'); ?>">Dental Implants</a></li>
                        <li><a href="<?php echo home_url('/services/invisalign/'); ?>">Invisalign</a></li>
                        <li><a href="<?php echo home_url('/services/cosmetic-dentistry/'); ?>">Cosmetic Dentistry</a></li>
                        <li><a href="<?php echo home_url('/services/preventive-care/'); ?>">Preventive Care</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="<?php echo home_url('/doctors/'); ?>">Our Doctors</a></li>
                        <li><a href="<?php echo home_url('/pricing/'); ?>">Pricing</a></li>
                        <li><a href="<?php echo home_url('/nri/'); ?>">For NRIs</a></li>
                        <li><a href="<?php echo home_url('/blog/'); ?>">Blog</a></li>
                        <li><a href="<?php echo home_url('/contact/'); ?>">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Contact Us</h4>
                    <ul class="contact-info">
                        <li><i class="fas fa-phone"></i> <?php echo jedh_get_option('phone', '+91 9602227267'); ?></li>
                        <li><i class="fas fa-envelope"></i> <?php echo jedh_get_option('email', 'dramit.eye@gmail.com'); ?></li>
                        <li><i class="fas fa-map-marker-alt"></i> <?php echo jedh_get_option('address', 'Jaipur, Rajasthan'); ?></li>
                        <li><i class="fas fa-clock"></i> <?php echo jedh_get_option('working_hours', 'Mon-Sat: 10 AM - 7 PM'); ?></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
                <div class="footer-links">
                    <a href="<?php echo home_url('/privacy-policy/'); ?>">Privacy Policy</a>
                    <a href="<?php echo home_url('/terms-conditions/'); ?>">Terms & Conditions</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/<?php echo jedh_get_option('whatsapp', '919602227267'); ?>" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <?php wp_footer(); ?>
</body>
</html>
