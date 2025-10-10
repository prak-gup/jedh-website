<?php
/**
 * The template for displaying single service posts
 *
 * @package JEDH
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <div class="content-area">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('service-single'); ?>>
                    <div class="service-header">
                        <div class="service-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('service-thumbnail'); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/service-placeholder.jpg" alt="<?php the_title(); ?>">
                            <?php endif; ?>
                        </div>
                        
                        <div class="service-info">
                            <h1 class="service-title"><?php the_title(); ?></h1>
                            
                            <?php 
                            $category = jedh_get_service_meta(get_the_ID(), 'category');
                            if ($category) : ?>
                                <p class="service-category">
                                    <i class="fas fa-<?php echo ($category === 'eye-care') ? 'eye' : 'tooth'; ?>"></i>
                                    <?php echo ucfirst(str_replace('-', ' ', $category)); ?>
                                </p>
                            <?php endif; ?>
                            
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
                                <a href="https://wa.me/<?php echo jedh_get_option('whatsapp', '919602227267'); ?>?text=Hi, I am interested in <?php echo urlencode(get_the_title()); ?>" class="btn btn-primary">
                                    <i class="fab fa-whatsapp"></i> Get Quote
                                </a>
                                <a href="tel:<?php echo jedh_get_option('phone', '+919602227267'); ?>" class="btn btn-secondary">
                                    <i class="fas fa-phone"></i> Call for Details
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="service-content">
                        <div class="entry-content">
                            <?php
                            the_content();

                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . __('Pages:', 'jedh'),
                                'after'  => '</div>',
                            ));
                            ?>
                        </div>
                        
                        <?php 
                        $features = jedh_get_service_meta(get_the_ID(), 'features');
                        if ($features) : ?>
                            <div class="service-features">
                                <h3>Key Features</h3>
                                <ul class="features-list">
                                    <?php 
                                    $feature_list = explode("\n", $features);
                                    foreach ($feature_list as $feature) : 
                                        if (trim($feature)) :
                                    ?>
                                        <li><i class="fas fa-check-circle"></i> <?php echo esc_html(trim($feature)); ?></li>
                                    <?php 
                                        endif;
                                    endforeach; 
                                    ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
