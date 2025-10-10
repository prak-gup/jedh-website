<?php
/**
 * Testimonials Template Part
 *
 * @package JEDH
 */

// Get featured reviews
$featured_reviews = get_posts(array(
    'post_type' => 'review',
    'posts_per_page' => 3,
    'meta_query' => array(
        array(
            'key' => '_review_featured',
            'value' => 'yes',
            'compare' => '='
        )
    )
));

// If no featured reviews, get latest reviews
if (empty($featured_reviews)) {
    $featured_reviews = get_posts(array(
        'post_type' => 'review',
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC'
    ));
}
?>

<!-- Testimonials -->
<section class="testimonials">
    <div class="container">
        <div class="section-header text-center">
            <h2 data-en="What Our Patients Say" data-hi="हमारे मरीज क्या कहते हैं">What Our Patients Say</h2>
            <p data-en="Real stories from 10,000+ satisfied patients" data-hi="10,000+ संतुष्ट रोगियों की वास्तविक कहानियाँ">Real stories from 10,000+ satisfied patients</p>
        </div>

        <div class="testimonial-slider">
            <?php if (!empty($featured_reviews)) : ?>
                <?php foreach ($featured_reviews as $review) : 
                    $rating = jedh_get_review_meta($review->ID, 'rating');
                    $patient_name = jedh_get_review_meta($review->ID, 'patient_name');
                    $service_type = jedh_get_review_meta($review->ID, 'service_type');
                ?>
                    <div class="testimonial-card">
                        <div class="stars">
                            <?php 
                            $rating = $rating ? $rating : 5;
                            for ($i = 1; $i <= 5; $i++) : 
                            ?>
                                <i class="fas fa-star<?php echo ($i <= $rating) ? '' : '-o'; ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <p class="testimonial-text">"<?php echo wp_trim_words(get_the_content($review->ID), 25, '...'); ?>"</p>
                        <div class="testimonial-author">
                            <strong><?php echo $patient_name ? esc_html($patient_name) : 'Anonymous'; ?></strong>
                            <span><?php echo $service_type ? esc_html($service_type) : 'Patient'; ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- Fallback static testimonials -->
                <div class="testimonial-card">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"Dr. Amit Gupta performed my cataract surgery. The entire process was painless and I could see clearly within 2 days. Excellent care and transparent pricing."</p>
                    <div class="testimonial-author">
                        <strong>Mrs. Sharma</strong>
                        <span>Cataract Surgery Patient</span>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"Got my dental implants done by Dr. Nehal Gupta. The German implants and painless procedure exceeded my expectations. Highly recommend JEDH."</p>
                    <div class="testimonial-author">
                        <strong>Mr. Rajesh Kumar</strong>
                        <span>Dental Implant Patient</span>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"As an NRI from USA, JEDH made everything easy. From WhatsApp consultation to post-surgery follow-up, the experience was seamless. Thank you!"</p>
                    <div class="testimonial-author">
                        <strong>Priya Patel</strong>
                        <span>NRI Patient - USA</span>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="text-center testimonial-cta">
            <a href="<?php echo home_url('/reviews/'); ?>" class="btn btn-secondary">
                <span data-en="Read More Reviews" data-hi="और समीक्षाएँ पढ़ें">Read More Reviews</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
