    <?php
    $show = aai_option('blog_single_banner_show', 1);
    ?>
    <div class="single-post-area">
        <?php if (has_post_thumbnail() && !post_password_required() && aai_option('single_post_thumnnail', 1)) : ?>
            <div class="post-thumb">
                <img src="<?php echo get_the_post_thumbnail_url(null, 'full'); ?>" alt=" <?php the_title_attribute(); ?>">
            </div>
        <?php endif; ?>
        <div class="blog-content">
            <?php if (!$show) : ?>
                <?php aai_post_meta(); ?>
            <?php endif; ?>
            <?php if (!$show) : ?>
                <h4 class="article-title quomodo-entry-title"><?php the_title(); ?></h4>
            <?php endif; ?>
            <?php
            if (is_search()) {
                the_excerpt();
            } else {
                the_content(esc_html__('Continue reading &rarr;', 'aai'));
                aai_link_pages();
            }
            ?>
        </div>
        <?php get_template_part('template-parts/blog/blog-parts/part', 'tags'); ?>
        <?php get_template_part('template-parts/blog/blog-parts/part', 'social'); ?>
        <?php get_template_part('template-parts/blog/blog-parts/part', 'author'); ?>
    </div>