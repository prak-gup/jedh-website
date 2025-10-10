<?php
/**
 * The template for displaying single review posts
 *
 * @package JEDH
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <div class="content-area">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('review-single'); ?>>
                    <div class="review-header">
                        <div class="review-rating">
                            <?php 
                            $rating = jedh_get_review_meta(get_the_ID(), 'rating');
                            $rating = $rating ? $rating : 5;
                            for ($i = 1; $i <= 5; $i++) : 
                            ?>
                                <i class="fas fa-star<?php echo ($i <= $rating) ? '' : '-o'; ?>"></i>
                            <?php endfor; ?>
                        </div>
                        
                        <h1 class="review-title"><?php the_title(); ?></h1>
                        
                        <div class="review-meta">
                            <?php 
                            $patient_name = jedh_get_review_meta(get_the_ID(), 'patient_name');
                            if ($patient_name) : ?>
                                <div class="review-author">
                                    <strong><?php echo esc_html($patient_name); ?></strong>
                                </div>
                            <?php endif; ?>
                            
                            <?php 
                            $service_type = jedh_get_review_meta(get_the_ID(), 'service_type');
                            if ($service_type) : ?>
                                <div class="review-service">
                                    <i class="fas fa-medical-bag"></i>
                                    <?php echo esc_html($service_type); ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php 
                            $date_of_service = jedh_get_review_meta(get_the_ID(), 'date_of_service');
                            if ($date_of_service) : ?>
                                <div class="review-date">
                                    <i class="fas fa-calendar"></i>
                                    <?php echo date('F j, Y', strtotime($date_of_service)); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="review-content">
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
                    
                    <div class="review-cta">
                        <p>Ready to experience the same quality care?</p>
                        <a href="https://wa.me/<?php echo jedh_get_option('whatsapp', '919602227267'); ?>" class="btn btn-primary">
                            <i class="fab fa-whatsapp"></i> Book Your Consultation
                        </a>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
