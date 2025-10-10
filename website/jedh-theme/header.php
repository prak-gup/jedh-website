<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo get_bloginfo('description'); ?>">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>">
    <meta property="og:description" content="<?php echo get_bloginfo('description'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo home_url(); ?>">
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/JEDH Logo.png">
    
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
    
    <link rel="canonical" href="<?php echo home_url(); ?>">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-content">
                <div class="top-bar-left">
                    <span><i class="fas fa-phone"></i> <?php echo jedh_get_option('phone', '+91 9602227267'); ?></span>
                    <span><i class="fas fa-envelope"></i> <?php echo jedh_get_option('email', 'dramit.eye@gmail.com'); ?></span>
                </div>
                <div class="top-bar-right">
                    <span><i class="fas fa-clock"></i> <?php echo jedh_get_option('working_hours', 'Mon-Sat: 9:00 AM - 7:00 PM'); ?></span>
                    <div class="language-switch">
                        <button class="lang-btn active" data-lang="en">EN</button>
                        <button class="lang-btn" data-lang="hi">हिं</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-wrapper">
                <div class="logo">
                    <a href="<?php echo home_url(); ?>">
                        <?php if (has_custom_logo()) : ?>
                            <?php the_custom_logo(); ?>
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/JEDH Logo.png" alt="<?php bloginfo('name'); ?>" class="logo-img">
                        <?php endif; ?>
                    </a>
                </div>
                
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary-menu',
                    'menu_class' => 'nav-menu',
                    'container' => false,
                    'fallback_cb' => 'jedh_fallback_menu',
                ));
                ?>
                
                <div class="nav-cta">
                    <a href="https://wa.me/<?php echo jedh_get_option('whatsapp', '919602227267'); ?>" class="btn btn-primary">
                        <i class="fab fa-whatsapp"></i> 
                        <span data-en="Book on WhatsApp" data-hi="व्हाट्सएप पर बुक करें">Book on WhatsApp</span>
                    </a>
                </div>
                
                <button class="mobile-menu-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </nav>

    <!-- Fallback menu function -->
    <?php
    function jedh_fallback_menu() {
        echo '<ul class="nav-menu">';
        echo '<li><a href="' . home_url() . '" class="active">Home</a></li>';
        echo '<li class="dropdown">';
        echo '<a href="' . home_url('/eye-care/') . '">Eye Care <i class="fas fa-chevron-down"></i></a>';
        echo '<ul class="dropdown-menu">';
        echo '<li><a href="' . home_url('/services/cataract-surgery/') . '">Cataract Surgery</a></li>';
        echo '<li><a href="' . home_url('/services/lasik-prk/') . '">LASIK/PRK</a></li>';
        echo '<li><a href="' . home_url('/services/glaucoma-care/') . '">Glaucoma Care</a></li>';
        echo '<li><a href="' . home_url('/services/pediatric-myopia/') . '">Pediatric Myopia</a></li>';
        echo '</ul>';
        echo '</li>';
        echo '<li class="dropdown">';
        echo '<a href="' . home_url('/dental-care/') . '">Dental Care <i class="fas fa-chevron-down"></i></a>';
        echo '<ul class="dropdown-menu">';
        echo '<li><a href="' . home_url('/services/dental-implants/') . '">Dental Implants</a></li>';
        echo '<li><a href="' . home_url('/services/invisalign/') . '">Invisalign</a></li>';
        echo '<li><a href="' . home_url('/services/cosmetic-dentistry/') . '">Cosmetic Dentistry</a></li>';
        echo '<li><a href="' . home_url('/services/preventive-care/') . '">Preventive Care</a></li>';
        echo '</ul>';
        echo '</li>';
        echo '<li><a href="' . home_url('/doctors/') . '">Our Doctors</a></li>';
        echo '<li><a href="' . home_url('/pricing/') . '">Pricing</a></li>';
        echo '<li><a href="' . home_url('/reviews/') . '">Reviews</a></li>';
        echo '<li><a href="' . home_url('/contact/') . '">Contact</a></li>';
        echo '</ul>';
    }
    ?>
