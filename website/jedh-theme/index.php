<?php
/**
 * The main template file
 *
 * @package JEDH
 */

get_header(); ?>

<main id="main" class="site-main">
    <?php if (is_front_page()) : ?>
        <!-- Homepage Content -->
        <?php get_template_part('template-parts/homepage/hero'); ?>
        <?php get_template_part('template-parts/homepage/services-overview'); ?>
        <?php get_template_part('template-parts/homepage/why-choose'); ?>
        <?php get_template_part('template-parts/homepage/insurance'); ?>
        <?php get_template_part('template-parts/homepage/pricing-preview'); ?>
        <?php get_template_part('template-parts/homepage/video-section'); ?>
        <?php get_template_part('template-parts/homepage/testimonials'); ?>
        <?php get_template_part('template-parts/homepage/nri-section'); ?>
        <?php get_template_part('template-parts/homepage/cta-banner'); ?>
    <?php else : ?>
        <!-- Default Content -->
        <div class="container">
            <div class="content-area">
                <?php if (have_posts()) : ?>
                    <div class="posts-container">
                        <?php while (have_posts()) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <header class="entry-header">
                                    <?php if (is_singular()) : ?>
                                        <h1 class="entry-title"><?php the_title(); ?></h1>
                                    <?php else : ?>
                                        <h2 class="entry-title">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                                        </h2>
                                    <?php endif; ?>
                                    
                                    <?php if ('post' === get_post_type()) : ?>
                                        <div class="entry-meta">
                                            <span class="posted-on">
                                                <i class="fas fa-calendar"></i>
                                                <time class="entry-date published" datetime="<?php echo get_the_date('c'); ?>">
                                                    <?php echo get_the_date(); ?>
                                                </time>
                                            </span>
                                            <span class="byline">
                                                <i class="fas fa-user"></i>
                                                <span class="author vcard">
                                                    <a class="url fn n" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                                        <?php echo get_the_author(); ?>
                                                    </a>
                                                </span>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                </header>

                                <?php if (has_post_thumbnail() && !is_singular()) : ?>
                                    <div class="post-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('blog-thumbnail'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div class="entry-content">
                                    <?php
                                    if (is_singular()) {
                                        the_content();
                                        
                                        wp_link_pages(array(
                                            'before' => '<div class="page-links">' . __('Pages:', 'jedh'),
                                            'after'  => '</div>',
                                        ));
                                    } else {
                                        the_excerpt();
                                        echo '<a href="' . get_permalink() . '" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>';
                                    }
                                    ?>
                                </div>

                                <?php if (is_singular() && (comments_open() || get_comments_number())) : ?>
                                    <div class="comments-section">
                                        <?php comments_template(); ?>
                                    </div>
                                <?php endif; ?>
                            </article>
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
                        <h2><?php _e('Nothing Found', 'jedh'); ?></h2>
                        <p><?php _e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'jedh'); ?></p>
                        <?php get_search_form(); ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (!is_front_page()) : ?>
                <aside class="sidebar">
                    <?php get_sidebar(); ?>
                </aside>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
