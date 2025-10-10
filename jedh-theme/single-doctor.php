<?php
/**
 * The template for displaying single doctor posts
 *
 * @package JEDH
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <div class="content-area">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('doctor-single'); ?>>
                    <div class="doctor-header">
                        <div class="doctor-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('doctor-thumbnail'); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/doctor-placeholder.jpg" alt="<?php the_title(); ?>">
                            <?php endif; ?>
                        </div>
                        
                        <div class="doctor-info">
                            <h1 class="doctor-name"><?php the_title(); ?></h1>
                            
                            <?php 
                            $specialty = jedh_get_doctor_meta(get_the_ID(), 'specialty');
                            if ($specialty) : ?>
                                <p class="doctor-specialty"><?php echo esc_html($specialty); ?></p>
                            <?php endif; ?>
                            
                            <div class="doctor-details">
                                <?php 
                                $experience = jedh_get_doctor_meta(get_the_ID(), 'experience');
                                if ($experience) : ?>
                                    <div class="detail-item">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span><?php echo esc_html($experience); ?>+ Years Experience</span>
                                    </div>
                                <?php endif; ?>
                                
                                <?php 
                                $qualifications = jedh_get_doctor_meta(get_the_ID(), 'qualifications');
                                if ($qualifications) : ?>
                                    <div class="detail-item">
                                        <i class="fas fa-graduation-cap"></i>
                                        <span><?php echo esc_html($qualifications); ?></span>
                                    </div>
                                <?php endif; ?>
                                
                                <?php 
                                $phone = jedh_get_doctor_meta(get_the_ID(), 'phone');
                                if ($phone) : ?>
                                    <div class="detail-item">
                                        <i class="fas fa-phone"></i>
                                        <a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a>
                                    </div>
                                <?php endif; ?>
                                
                                <?php 
                                $email = jedh_get_doctor_meta(get_the_ID(), 'email');
                                if ($email) : ?>
                                    <div class="detail-item">
                                        <i class="fas fa-envelope"></i>
                                        <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                                    </div>
                                <?php endif; ?>
                                
                                <?php 
                                $consultation_fee = jedh_get_doctor_meta(get_the_ID(), 'consultation_fee');
                                if ($consultation_fee) : ?>
                                    <div class="detail-item">
                                        <i class="fas fa-rupee-sign"></i>
                                        <span>Consultation Fee: ₹<?php echo esc_html($consultation_fee); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="doctor-cta">
                                <a href="https://wa.me/<?php echo jedh_get_option('whatsapp', '919602227267'); ?>?text=Hi, I would like to book a consultation with <?php echo urlencode(get_the_title()); ?>" class="btn btn-primary">
                                    <i class="fab fa-whatsapp"></i> Book Consultation
                                </a>
                                <a href="tel:<?php echo jedh_get_option('phone', '+919602227267'); ?>" class="btn btn-secondary">
                                    <i class="fas fa-phone"></i> Call Now
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="doctor-content">
                        <div class="entry-content">
                            <?php
                            the_content();

                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . __('Pages:', 'jedh'),
                                'after'  => '</div>',
                            ));
                            ?>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
