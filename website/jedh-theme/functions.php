<?php
/**
 * JEDH Theme Functions
 * 
 * @package JEDH
 * @version 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function jedh_theme_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('responsive-embeds');

    // Register navigation menus
    register_nav_menus(array(
        'primary-menu' => __('Primary Menu', 'jedh'),
        'footer-menu' => __('Footer Menu', 'jedh'),
    ));

    // Add image sizes
    add_image_size('doctor-thumbnail', 300, 300, true);
    add_image_size('service-thumbnail', 400, 250, true);
    add_image_size('blog-thumbnail', 600, 400, true);
}
add_action('after_setup_theme', 'jedh_theme_setup');

/**
 * Enqueue styles and scripts
 */
function jedh_enqueue_assets() {
    // Styles
    wp_enqueue_style('jedh-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_style('jedh-main', get_template_directory_uri() . '/css/style.css', array(), '1.0.0');
    wp_enqueue_style('jedh-pages', get_template_directory_uri() . '/css/pages.css', array(), '1.0.0');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap', array(), null);

    // Scripts
    wp_enqueue_script('jedh-main', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);
    
    // Localize script for AJAX
    wp_localize_script('jedh-main', 'jedh_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('jedh_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'jedh_enqueue_assets');

/**
 * Register custom post types
 */
function jedh_register_post_types() {
    // Doctors
    register_post_type('doctor', array(
        'labels' => array(
            'name' => __('Doctors', 'jedh'),
            'singular_name' => __('Doctor', 'jedh'),
            'add_new' => __('Add New Doctor', 'jedh'),
            'add_new_item' => __('Add New Doctor', 'jedh'),
            'edit_item' => __('Edit Doctor', 'jedh'),
            'new_item' => __('New Doctor', 'jedh'),
            'view_item' => __('View Doctor', 'jedh'),
            'search_items' => __('Search Doctors', 'jedh'),
            'not_found' => __('No doctors found', 'jedh'),
            'not_found_in_trash' => __('No doctors found in trash', 'jedh'),
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'doctors'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-admin-users',
        'show_in_rest' => true,
    ));

    // Services
    register_post_type('service', array(
        'labels' => array(
            'name' => __('Services', 'jedh'),
            'singular_name' => __('Service', 'jedh'),
            'add_new' => __('Add New Service', 'jedh'),
            'add_new_item' => __('Add New Service', 'jedh'),
            'edit_item' => __('Edit Service', 'jedh'),
            'new_item' => __('New Service', 'jedh'),
            'view_item' => __('View Service', 'jedh'),
            'search_items' => __('Search Services', 'jedh'),
            'not_found' => __('No services found', 'jedh'),
            'not_found_in_trash' => __('No services found in trash', 'jedh'),
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'services'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-heart',
        'show_in_rest' => true,
    ));

    // Reviews
    register_post_type('review', array(
        'labels' => array(
            'name' => __('Reviews', 'jedh'),
            'singular_name' => __('Review', 'jedh'),
            'add_new' => __('Add New Review', 'jedh'),
            'add_new_item' => __('Add New Review', 'jedh'),
            'edit_item' => __('Edit Review', 'jedh'),
            'new_item' => __('New Review', 'jedh'),
            'view_item' => __('View Review', 'jedh'),
            'search_items' => __('Search Reviews', 'jedh'),
            'not_found' => __('No reviews found', 'jedh'),
            'not_found_in_trash' => __('No reviews found in trash', 'jedh'),
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'reviews'),
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-star-filled',
        'show_in_rest' => true,
    ));

    // Bookings
    register_post_type('booking', array(
        'labels' => array(
            'name' => __('Bookings', 'jedh'),
            'singular_name' => __('Booking', 'jedh'),
            'add_new' => __('Add New Booking', 'jedh'),
            'add_new_item' => __('Add New Booking', 'jedh'),
            'edit_item' => __('Edit Booking', 'jedh'),
            'new_item' => __('New Booking', 'jedh'),
            'view_item' => __('View Booking', 'jedh'),
            'search_items' => __('Search Bookings', 'jedh'),
            'not_found' => __('No bookings found', 'jedh'),
            'not_found_in_trash' => __('No bookings found in trash', 'jedh'),
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'supports' => array('title', 'editor'),
        'menu_icon' => 'dashicons-calendar-alt',
        'capability_type' => 'post',
    ));
}
add_action('init', 'jedh_register_post_types');

/**
 * Register custom taxonomies
 */
function jedh_register_taxonomies() {
    // Service Categories
    register_taxonomy('service_category', 'service', array(
        'labels' => array(
            'name' => __('Service Categories', 'jedh'),
            'singular_name' => __('Service Category', 'jedh'),
        ),
        'hierarchical' => true,
        'public' => true,
        'rewrite' => array('slug' => 'service-category'),
        'show_in_rest' => true,
    ));

    // Doctor Specialties
    register_taxonomy('doctor_specialty', 'doctor', array(
        'labels' => array(
            'name' => __('Doctor Specialties', 'jedh'),
            'singular_name' => __('Doctor Specialty', 'jedh'),
        ),
        'hierarchical' => true,
        'public' => true,
        'rewrite' => array('slug' => 'doctor-specialty'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'jedh_register_taxonomies');

/**
 * Add custom meta boxes
 */
function jedh_add_meta_boxes() {
    // Doctor meta box
    add_meta_box(
        'doctor_details',
        __('Doctor Details', 'jedh'),
        'jedh_doctor_meta_box_callback',
        'doctor',
        'normal',
        'high'
    );

    // Service meta box
    add_meta_box(
        'service_details',
        __('Service Details', 'jedh'),
        'jedh_service_meta_box_callback',
        'service',
        'normal',
        'high'
    );

    // Review meta box
    add_meta_box(
        'review_details',
        __('Review Details', 'jedh'),
        'jedh_review_meta_box_callback',
        'review',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'jedh_add_meta_boxes');

/**
 * Doctor meta box callback
 */
function jedh_doctor_meta_box_callback($post) {
    wp_nonce_field('jedh_doctor_meta_box', 'jedh_doctor_meta_box_nonce');
    
    $specialty = get_post_meta($post->ID, '_doctor_specialty', true);
    $experience = get_post_meta($post->ID, '_doctor_experience', true);
    $qualifications = get_post_meta($post->ID, '_doctor_qualifications', true);
    $phone = get_post_meta($post->ID, '_doctor_phone', true);
    $email = get_post_meta($post->ID, '_doctor_email', true);
    $consultation_fee = get_post_meta($post->ID, '_doctor_consultation_fee', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="doctor_specialty"><?php _e('Specialty', 'jedh'); ?></label></th>
            <td><input type="text" id="doctor_specialty" name="doctor_specialty" value="<?php echo esc_attr($specialty); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="doctor_experience"><?php _e('Experience (Years)', 'jedh'); ?></label></th>
            <td><input type="number" id="doctor_experience" name="doctor_experience" value="<?php echo esc_attr($experience); ?>" class="small-text" /></td>
        </tr>
        <tr>
            <th><label for="doctor_qualifications"><?php _e('Qualifications', 'jedh'); ?></label></th>
            <td><textarea id="doctor_qualifications" name="doctor_qualifications" rows="3" class="large-text"><?php echo esc_textarea($qualifications); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="doctor_phone"><?php _e('Phone', 'jedh'); ?></label></th>
            <td><input type="tel" id="doctor_phone" name="doctor_phone" value="<?php echo esc_attr($phone); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="doctor_email"><?php _e('Email', 'jedh'); ?></label></th>
            <td><input type="email" id="doctor_email" name="doctor_email" value="<?php echo esc_attr($email); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="doctor_consultation_fee"><?php _e('Consultation Fee (₹)', 'jedh'); ?></label></th>
            <td><input type="number" id="doctor_consultation_fee" name="doctor_consultation_fee" value="<?php echo esc_attr($consultation_fee); ?>" class="small-text" /></td>
        </tr>
    </table>
    <?php
}

/**
 * Service meta box callback
 */
function jedh_service_meta_box_callback($post) {
    wp_nonce_field('jedh_service_meta_box', 'jedh_service_meta_box_nonce');
    
    $price_from = get_post_meta($post->ID, '_service_price_from', true);
    $price_to = get_post_meta($post->ID, '_service_price_to', true);
    $duration = get_post_meta($post->ID, '_service_duration', true);
    $features = get_post_meta($post->ID, '_service_features', true);
    $category = get_post_meta($post->ID, '_service_category', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="service_category"><?php _e('Category', 'jedh'); ?></label></th>
            <td>
                <select id="service_category" name="service_category">
                    <option value="eye-care" <?php selected($category, 'eye-care'); ?>><?php _e('Eye Care', 'jedh'); ?></option>
                    <option value="dental-care" <?php selected($category, 'dental-care'); ?>><?php _e('Dental Care', 'jedh'); ?></option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="service_price_from"><?php _e('Price From (₹)', 'jedh'); ?></label></th>
            <td><input type="number" id="service_price_from" name="service_price_from" value="<?php echo esc_attr($price_from); ?>" class="small-text" /></td>
        </tr>
        <tr>
            <th><label for="service_price_to"><?php _e('Price To (₹)', 'jedh'); ?></label></th>
            <td><input type="number" id="service_price_to" name="service_price_to" value="<?php echo esc_attr($price_to); ?>" class="small-text" /></td>
        </tr>
        <tr>
            <th><label for="service_duration"><?php _e('Duration', 'jedh'); ?></label></th>
            <td><input type="text" id="service_duration" name="service_duration" value="<?php echo esc_attr($duration); ?>" class="regular-text" placeholder="e.g., 2-3 days recovery" /></td>
        </tr>
        <tr>
            <th><label for="service_features"><?php _e('Features (one per line)', 'jedh'); ?></label></th>
            <td><textarea id="service_features" name="service_features" rows="5" class="large-text"><?php echo esc_textarea($features); ?></textarea></td>
        </tr>
    </table>
    <?php
}

/**
 * Review meta box callback
 */
function jedh_review_meta_box_callback($post) {
    wp_nonce_field('jedh_review_meta_box', 'jedh_review_meta_box_nonce');
    
    $rating = get_post_meta($post->ID, '_review_rating', true);
    $patient_name = get_post_meta($post->ID, '_review_patient_name', true);
    $service_type = get_post_meta($post->ID, '_review_service_type', true);
    $date_of_service = get_post_meta($post->ID, '_review_date_of_service', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="review_rating"><?php _e('Rating (1-5)', 'jedh'); ?></label></th>
            <td><input type="number" id="review_rating" name="review_rating" value="<?php echo esc_attr($rating); ?>" min="1" max="5" class="small-text" /></td>
        </tr>
        <tr>
            <th><label for="review_patient_name"><?php _e('Patient Name', 'jedh'); ?></label></th>
            <td><input type="text" id="review_patient_name" name="review_patient_name" value="<?php echo esc_attr($patient_name); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="review_service_type"><?php _e('Service Type', 'jedh'); ?></label></th>
            <td><input type="text" id="review_service_type" name="review_service_type" value="<?php echo esc_attr($service_type); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="review_date_of_service"><?php _e('Date of Service', 'jedh'); ?></label></th>
            <td><input type="date" id="review_date_of_service" name="review_date_of_service" value="<?php echo esc_attr($date_of_service); ?>" class="regular-text" /></td>
        </tr>
    </table>
    <?php
}

/**
 * Save meta box data
 */
function jedh_save_meta_box_data($post_id) {
    // Doctor meta box
    if (isset($_POST['jedh_doctor_meta_box_nonce']) && wp_verify_nonce($_POST['jedh_doctor_meta_box_nonce'], 'jedh_doctor_meta_box')) {
        $fields = array('doctor_specialty', 'doctor_experience', 'doctor_qualifications', 'doctor_phone', 'doctor_email', 'doctor_consultation_fee');
        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
            }
        }
    }

    // Service meta box
    if (isset($_POST['jedh_service_meta_box_nonce']) && wp_verify_nonce($_POST['jedh_service_meta_box_nonce'], 'jedh_service_meta_box')) {
        $fields = array('service_category', 'service_price_from', 'service_price_to', 'service_duration', 'service_features');
        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                if ($field === 'service_features') {
                    update_post_meta($post_id, '_' . $field, sanitize_textarea_field($_POST[$field]));
                } else {
                    update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
                }
            }
        }
    }

    // Review meta box
    if (isset($_POST['jedh_review_meta_box_nonce']) && wp_verify_nonce($_POST['jedh_review_meta_box_nonce'], 'jedh_review_meta_box')) {
        $fields = array('review_rating', 'review_patient_name', 'review_service_type', 'review_date_of_service');
        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
            }
        }
    }
}
add_action('save_post', 'jedh_save_meta_box_data');

/**
 * Booking form handler
 */
function jedh_handle_booking() {
    if (isset($_POST['jedh_booking_submit']) && wp_verify_nonce($_POST['jedh_booking_nonce'], 'jedh_booking_action')) {
        $name = sanitize_text_field($_POST['name']);
        $phone = sanitize_text_field($_POST['phone']);
        $email = sanitize_email($_POST['email']);
        $service = sanitize_text_field($_POST['service']);
        $date = sanitize_text_field($_POST['date']);
        $message = sanitize_textarea_field($_POST['message']);

        // Create booking post
        $booking_data = array(
            'post_title' => 'Booking: ' . $name . ' - ' . $service,
            'post_content' => $message,
            'post_status' => 'publish',
            'post_type' => 'booking',
        );

        $booking_id = wp_insert_post($booking_data);

        if ($booking_id) {
            // Add meta data
            update_post_meta($booking_id, '_booking_name', $name);
            update_post_meta($booking_id, '_booking_phone', $phone);
            update_post_meta($booking_id, '_booking_email', $email);
            update_post_meta($booking_id, '_booking_service', $service);
            update_post_meta($booking_id, '_booking_date', $date);
            update_post_meta($booking_id, '_booking_status', 'pending');

            // Send email notification
            $to = get_option('admin_email');
            $subject = 'New Booking Request - JEDH';
            $email_message = "New booking request received:\n\n";
            $email_message .= "Name: $name\n";
            $email_message .= "Phone: $phone\n";
            $email_message .= "Email: $email\n";
            $email_message .= "Service: $service\n";
            $email_message .= "Preferred Date: $date\n";
            $email_message .= "Message: $message\n";

            wp_mail($to, $subject, $email_message);

            // Redirect with success message
            wp_redirect(add_query_arg('booking', 'success', $_POST['_wp_http_referer']));
            exit;
        }
    }
}
add_action('template_redirect', 'jedh_handle_booking');

/**
 * AJAX handler for booking form
 */
function jedh_ajax_booking_handler() {
    check_ajax_referer('jedh_nonce', 'nonce');

    $name = sanitize_text_field($_POST['name']);
    $phone = sanitize_text_field($_POST['phone']);
    $email = sanitize_email($_POST['email']);
    $service = sanitize_text_field($_POST['service']);
    $date = sanitize_text_field($_POST['date']);
    $message = sanitize_textarea_field($_POST['message']);

    // Create booking post
    $booking_data = array(
        'post_title' => 'Booking: ' . $name . ' - ' . $service,
        'post_content' => $message,
        'post_status' => 'publish',
        'post_type' => 'booking',
    );

    $booking_id = wp_insert_post($booking_data);

    if ($booking_id) {
        // Add meta data
        update_post_meta($booking_id, '_booking_name', $name);
        update_post_meta($booking_id, '_booking_phone', $phone);
        update_post_meta($booking_id, '_booking_email', $email);
        update_post_meta($booking_id, '_booking_service', $service);
        update_post_meta($booking_id, '_booking_date', $date);
        update_post_meta($booking_id, '_booking_status', 'pending');

        wp_send_json_success('Booking submitted successfully!');
    } else {
        wp_send_json_error('Failed to submit booking. Please try again.');
    }
}
add_action('wp_ajax_jedh_booking', 'jedh_ajax_booking_handler');
add_action('wp_ajax_nopriv_jedh_booking', 'jedh_ajax_booking_handler');

/**
 * Theme options
 */
function jedh_theme_options() {
    add_option('jedh_phone', '+91 9602227267');
    add_option('jedh_email', 'dramit.eye@gmail.com');
    add_option('jedh_address', 'Jaipur, Rajasthan');
    add_option('jedh_whatsapp', '919602227267');
    add_option('jedh_working_hours', 'Mon-Sat: 9:00 AM - 7:00 PM');
}
add_action('admin_init', 'jedh_theme_options');

/**
 * Customizer settings
 */
function jedh_customize_register($wp_customize) {
    // Contact Information Section
    $wp_customize->add_section('jedh_contact', array(
        'title' => __('Contact Information', 'jedh'),
        'priority' => 30,
    ));

    // Phone
    $wp_customize->add_setting('jedh_phone', array(
        'default' => '+91 9602227267',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('jedh_phone', array(
        'label' => __('Phone Number', 'jedh'),
        'section' => 'jedh_contact',
        'type' => 'text',
    ));

    // Email
    $wp_customize->add_setting('jedh_email', array(
        'default' => 'dramit.eye@gmail.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('jedh_email', array(
        'label' => __('Email Address', 'jedh'),
        'section' => 'jedh_contact',
        'type' => 'email',
    ));

    // WhatsApp
    $wp_customize->add_setting('jedh_whatsapp', array(
        'default' => '919602227267',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('jedh_whatsapp', array(
        'label' => __('WhatsApp Number', 'jedh'),
        'section' => 'jedh_contact',
        'type' => 'text',
    ));

    // Working Hours
    $wp_customize->add_setting('jedh_working_hours', array(
        'default' => 'Mon-Sat: 9:00 AM - 7:00 PM',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('jedh_working_hours', array(
        'label' => __('Working Hours', 'jedh'),
        'section' => 'jedh_contact',
        'type' => 'text',
    ));
}
add_action('customize_register', 'jedh_customize_register');

/**
 * Widget areas
 */
function jedh_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'jedh'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here.', 'jedh'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => __('Footer 1', 'jedh'),
        'id' => 'footer-1',
        'description' => __('Add widgets here.', 'jedh'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => __('Footer 2', 'jedh'),
        'id' => 'footer-2',
        'description' => __('Add widgets here.', 'jedh'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => __('Footer 3', 'jedh'),
        'id' => 'footer-3',
        'description' => __('Add widgets here.', 'jedh'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
}
add_action('widgets_init', 'jedh_widgets_init');

/**
 * Helper function to get doctor meta
 */
function jedh_get_doctor_meta($post_id, $meta_key) {
    return get_post_meta($post_id, '_doctor_' . $meta_key, true);
}

/**
 * Helper function to get service meta
 */
function jedh_get_service_meta($post_id, $meta_key) {
    return get_post_meta($post_id, '_service_' . $meta_key, true);
}

/**
 * Helper function to get review meta
 */
function jedh_get_review_meta($post_id, $meta_key) {
    return get_post_meta($post_id, '_review_' . $meta_key, true);
}

/**
 * Get theme option
 */
function jedh_get_option($option_name, $default = '') {
    return get_option('jedh_' . $option_name, $default);
}

/**
 * Custom excerpt length
 */
function jedh_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'jedh_excerpt_length');

/**
 * Custom excerpt more
 */
function jedh_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'jedh_excerpt_more');

/**
 * Add schema markup
 */
function jedh_add_schema_markup() {
    if (is_front_page()) {
        ?>
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": ["MedicalBusiness", "LocalBusiness"],
          "name": "Jaipur Eye & Dental Hospital",
          "alternateName": "JEDH",
          "description": "Comprehensive eye and dental care in Jaipur since 2008",
          "url": "<?php echo home_url(); ?>",
          "telephone": "<?php echo jedh_get_option('phone'); ?>",
          "email": "<?php echo jedh_get_option('email'); ?>",
          "address": {
            "@type": "PostalAddress",
            "addressLocality": "Jaipur",
            "addressRegion": "Rajasthan",
            "addressCountry": "IN"
          },
          "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.8",
            "reviewCount": "10000"
          },
          "medicalSpecialty": ["Ophthalmology", "Dentistry"],
          "priceRange": "₹₹",
          "sameAs": [
            "https://www.instagram.com/jaipureyedentalhospital",
            "https://www.youtube.com/@jedh",
            "https://www.linkedin.com/in/dr-amit-gupta-1938985b/"
          ]
        }
        </script>
        <?php
    }
}
add_action('wp_head', 'jedh_add_schema_markup');
?>
