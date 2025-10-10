<?php
/**
 * Search form template
 *
 * @package JEDH
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
        <span class="screen-reader-text"><?php echo _x('Search for:', 'label', 'jedh'); ?></span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search services, doctors, treatments...', 'placeholder', 'jedh'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    </label>
    <button type="submit" class="search-submit">
        <i class="fas fa-search"></i>
        <span class="screen-reader-text"><?php echo _x('Search', 'submit button', 'jedh'); ?></span>
    </button>
</form>
