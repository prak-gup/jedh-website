<?php
/**
 * The template for displaying doctor archive pages
 *
 * @package JEDH
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <div class="content-area">
            <header class="page-header">
                <h1 class="page-title">Our Doctors</h1>
                <p class="page-description">Meet our experienced team of specialists</p>
            </header>

            <?php if (have_posts()) : ?>
                <div class="doctors-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="doctor-card">
                            <div class="doctor-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('doctor-thumbnail'); ?>
                                    <?php else : ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/doctor-placeholder.jpg" alt="<?php the_title(); ?>">
                                    <?php endif; ?>
                                </a>
                            </div>
                            
                            <div class="doctor-info">
                                <h3 class="doctor-name">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                
                                <?php 
                                $specialty = jedh_get_doctor_meta(get_the_ID(), 'specialty');
                                if ($specialty) : ?>
                                    <p class="doctor-specialty"><?php echo esc_html($specialty); ?></p>
                                <?php endif; ?>
                                
                                <?php 
                                $experience = jedh_get_doctor_meta(get_the_ID(), 'experience');
                                if ($experience) : ?>
                                    <p class="doctor-experience">
                                        <i class="fas fa-calendar-alt"></i>
                                        <?php echo esc_html($experience); ?>+ Years Experience
                                    </p>
                                <?php endif; ?>
                                
                                <?php 
                                $qualifications = jedh_get_doctor_meta(get_the_ID(), 'qualifications');
                                if ($qualifications) : ?>
                                    <p class="doctor-qualifications">
                                        <i class="fas fa-graduation-cap"></i>
                                        <?php echo esc_html($qualifications); ?>
                                    </p>
                                <?php endif; ?>
                                
                                <div class="doctor-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <div class="doctor-cta">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-outline">View Profile</a>
                                    <a href="https://wa.me/<?php echo jedh_get_option('whatsapp', '919602227267'); ?>?text=Hi, I would like to book a consultation with <?php echo urlencode(get_the_title()); ?>" class="btn btn-primary">
                                        <i class="fab fa-whatsapp"></i> Book
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <?php
                // Pagination
                the_posts_pagination(array(
                    'prev_text' => '<i class="fas fa-chevron-left"></i> Previous',
                    'next_text' => 'Next <i class="fas fa-chevron-right"></i>',
                ));
                ?>

            <?php else : ?>
                <div class="no-posts">
                    <h2><?php _e('No Doctors Found', 'jedh'); ?></h2>
                    <p><?php _e('We are currently updating our doctor profiles. Please check back soon.', 'jedh'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
