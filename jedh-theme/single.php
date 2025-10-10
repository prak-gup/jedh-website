<?php
/**
 * The template for displaying all single posts
 *
 * @package JEDH
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <div class="content-area">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        
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
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . __('Pages:', 'jedh'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>

                    <footer class="entry-footer">
                        <div class="entry-meta">
                            <?php
                            $categories_list = get_the_category_list(', ');
                            if ($categories_list) {
                                printf('<span class="cat-links"><i class="fas fa-folder"></i> %s</span>', $categories_list);
                            }

                            $tags_list = get_the_tag_list('', ', ');
                            if ($tags_list) {
                                printf('<span class="tags-links"><i class="fas fa-tags"></i> %s</span>', $tags_list);
                            }
                            ?>
                        </div>
                    </footer>
                </article>

                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>

            <?php endwhile; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
