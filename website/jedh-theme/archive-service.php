<?php
/**
 * The template for displaying service archive pages
 *
 * @package JEDH
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <div class="content-area">
            <header class="page-header">
                <h1 class="page-title">Our Services</h1>
                <p class="page-description">Comprehensive eye and dental care services</p>
            </header>

            <?php if (have_posts()) : ?>
                <div class="services-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="service-card">
                            <div class="service-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('service-thumbnail'); ?>
                                    <?php else : ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/service-placeholder.jpg" alt="<?php the_title(); ?>">
                                    <?php endif; ?>
                                </a>
                                
                                <?php 
                                $category = jedh_get_service_meta(get_the_ID(), 'category');
                                if ($category) : ?>
                                    <div class="service-category-badge">
                                        <i class="fas fa-<?php echo ($category === 'eye-care') ? 'eye' : 'tooth'; ?>"></i>
                                        <?php echo ucfirst(str_replace('-', ' ', $category)); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="service-info">
                                <h3 class="service-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                
                                <div class="service-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <div class="service-pricing">
                                    <?php 
                                    $price_from = jedh_get_service_meta(get_the_ID(), 'price_from');
                                    $price_to = jedh_get_service_meta(get_the_ID(), 'price_to');
                                    if ($price_from && $price_to) : ?>
                                        <div class="price-range">
                                            <span class="price">₹<?php echo number_format($price_from); ?> - ₹<?php echo number_format($price_to); ?></span>
                                        </div>
                                    <?php elseif ($price_from) : ?>
                                        <div class="price-range">
                                            <span class="price">From ₹<?php echo number_format($price_from); ?></span>
                                        </div>
                                    <?php else : ?>
                                        <div class="price-range">
                                            <span class="price">Contact for Pricing</span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php 
                                    $duration = jedh_get_service_meta(get_the_ID(), 'duration');
                                    if ($duration) : ?>
                                        <p class="duration">
                                            <i class="fas fa-clock"></i>
                                            <?php echo esc_html($duration); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="service-cta">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-outline">View Details</a>
                                    <a href="https://wa.me/<?php echo jedh_get_option('whatsapp', '919602227267'); ?>?text=Hi, I am interested in <?php echo urlencode(get_the_title()); ?>" class="btn btn-primary">
                                        <i class="fab fa-whatsapp"></i> Get Quote
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
                    <h2><?php _e('No Services Found', 'jedh'); ?></h2>
                    <p><?php _e('We are currently updating our service information. Please check back soon.', 'jedh'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
