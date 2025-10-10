<?php
/**
 * Pricing Preview Template Part
 *
 * @package JEDH
 */

// Get featured services for pricing preview
$featured_services = get_posts(array(
    'post_type' => 'service',
    'posts_per_page' => 4,
    'meta_query' => array(
        array(
            'key' => '_service_featured',
            'value' => 'yes',
            'compare' => '='
        )
    )
));

// If no featured services, get latest services
if (empty($featured_services)) {
    $featured_services = get_posts(array(
        'post_type' => 'service',
        'posts_per_page' => 4,
        'orderby' => 'date',
        'order' => 'DESC'
    ));
}
?>

<!-- Pricing Preview -->
<section class="pricing-preview">
    <div class="container">
        <div class="section-header text-center">
            <h2 data-en="Transparent Pricing" data-hi="पारदर्शी मूल्य निर्धारण">Transparent Pricing</h2>
            <p data-en="Clear cost ranges for all treatments" data-hi="सभी उपचारों के लिए स्पष्ट लागत सीमा">Clear cost ranges for all treatments</p>
        </div>

        <div class="pricing-cards">
            <?php if (!empty($featured_services)) : ?>
                <?php foreach ($featured_services as $service) : 
                    $price_from = jedh_get_service_meta($service->ID, 'price_from');
                    $price_to = jedh_get_service_meta($service->ID, 'price_to');
                    $duration = jedh_get_service_meta($service->ID, 'duration');
                    $features = jedh_get_service_meta($service->ID, 'features');
                    $category = jedh_get_service_meta($service->ID, 'category');
                    
                    // Set icon based on category
                    $icon = ($category === 'eye-care') ? 'fas fa-eye' : 'fas fa-tooth';
                ?>
                    <div class="pricing-card">
                        <div class="pricing-header">
                            <i class="<?php echo $icon; ?>"></i>
                            <h3><?php echo get_the_title($service->ID); ?></h3>
                        </div>
                        <div class="pricing-body">
                            <div class="price">
                                <?php if ($price_from && $price_to) : ?>
                                    ₹<?php echo number_format($price_from); ?> - ₹<?php echo number_format($price_to); ?>
                                <?php elseif ($price_from) : ?>
                                    From ₹<?php echo number_format($price_from); ?>
                                <?php else : ?>
                                    Contact for Pricing
                                <?php endif; ?>
                            </div>
                            <?php if ($duration) : ?>
                                <p class="price-note"><?php echo esc_html($duration); ?></p>
                            <?php endif; ?>
                            
                            <?php if ($features) : ?>
                                <ul class="pricing-features">
                                    <?php 
                                    $feature_list = explode("\n", $features);
                                    foreach (array_slice($feature_list, 0, 3) as $feature) : 
                                        if (trim($feature)) :
                                    ?>
                                        <li><i class="fas fa-check"></i> <?php echo esc_html(trim($feature)); ?></li>
                                    <?php 
                                        endif;
                                    endforeach; 
                                    ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                        <a href="<?php echo get_permalink($service->ID); ?>" class="btn btn-primary">View Details</a>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- Fallback static pricing cards -->
                <div class="pricing-card">
                    <div class="pricing-header">
                        <i class="fas fa-eye"></i>
                        <h3>Cataract Surgery</h3>
                    </div>
                    <div class="pricing-body">
                        <div class="price">₹18,000 - ₹1,25,000</div>
                        <p class="price-note">Per eye (lens dependent)</p>
                        <ul class="pricing-features">
                            <li><i class="fas fa-check"></i> Phaco/Femto procedure</li>
                            <li><i class="fas fa-check"></i> Multiple lens options</li>
                            <li><i class="fas fa-check"></i> 2-3 days recovery</li>
                        </ul>
                    </div>
                    <a href="<?php echo home_url('/services/cataract-surgery/'); ?>" class="btn btn-primary">View Details</a>
                </div>

                <div class="pricing-card">
                    <div class="pricing-header">
                        <i class="fas fa-glasses"></i>
                        <h3>LASIK/Contoura</h3>
                    </div>
                    <div class="pricing-body">
                        <div class="price">₹35,000 - ₹70,000</div>
                        <p class="price-note">Per eye</p>
                        <ul class="pricing-features">
                            <li><i class="fas fa-check"></i> Bladeless procedure</li>
                            <li><i class="fas fa-check"></i> 24-48 hrs recovery</li>
                            <li><i class="fas fa-check"></i> Free screening</li>
                        </ul>
                    </div>
                    <a href="<?php echo home_url('/services/lasik-prk/'); ?>" class="btn btn-primary">View Details</a>
                </div>

                <div class="pricing-card">
                    <div class="pricing-header">
                        <i class="fas fa-tooth"></i>
                        <h3>Dental Implants</h3>
                    </div>
                    <div class="pricing-body">
                        <div class="price">₹25,000 - ₹1,00,000</div>
                        <p class="price-note">Per tooth</p>
                        <ul class="pricing-features">
                            <li><i class="fas fa-check"></i> German systems</li>
                            <li><i class="fas fa-check"></i> 3D scanning</li>
                            <li><i class="fas fa-check"></i> Lifetime warranty options</li>
                        </ul>
                    </div>
                    <a href="<?php echo home_url('/services/dental-implants/'); ?>" class="btn btn-primary">View Details</a>
                </div>

                <div class="pricing-card">
                    <div class="pricing-header">
                        <i class="fas fa-smile"></i>
                        <h3>Invisalign</h3>
                    </div>
                    <div class="pricing-body">
                        <div class="price">₹75,000+</div>
                        <p class="price-note">Case dependent</p>
                        <ul class="pricing-features">
                            <li><i class="fas fa-check"></i> Digital smile simulation</li>
                            <li><i class="fas fa-check"></i> Discreet treatment</li>
                            <li><i class="fas fa-check"></i> Certified orthodontist</li>
                        </ul>
                    </div>
                    <a href="<?php echo home_url('/services/invisalign/'); ?>" class="btn btn-primary">View Details</a>
                </div>
            <?php endif; ?>
        </div>

        <div class="pricing-cta text-center">
            <a href="<?php echo home_url('/pricing/'); ?>" class="btn btn-secondary btn-lg">
                <span data-en="View All Pricing" data-hi="सभी मूल्य देखें">View All Pricing</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
