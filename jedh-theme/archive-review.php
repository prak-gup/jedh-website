<?php
/**
 * The template for displaying review archive pages
 *
 * @package JEDH
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <div class="content-area">
            <header class="page-header">
                <h1 class="page-title">Patient Reviews</h1>
                <p class="page-description">What our patients say about their experience</p>
            </header>

            <?php if (have_posts()) : ?>
                <div class="reviews-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="review-card">
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
                                
                                <h3 class="review-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                            </div>
                            
                            <div class="review-content">
                                <div class="review-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                            
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
                            
                            <div class="review-cta">
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline">Read Full Review</a>
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
                    <h2><?php _e('No Reviews Found', 'jedh'); ?></h2>
                    <p><?php _e('We are currently collecting patient reviews. Please check back soon.', 'jedh'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
