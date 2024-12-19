<div class="post-item-1 <?php echo esc_attr(aai_option('blog_box_shadow', 1) ? 'box-shadow' : 'no-box-shadow'); ?> <?php echo esc_attr(aai_option('blog_box_shadow_hover', 1) ? 'box-shadow-hover' : 'no-box-shadow-hover'); ?>">
    <?php
    if (is_sticky()) {
        echo '<sup class="sticky-meta-featured"> <i class="fal fa-thumbtack"></i> '  . ' </sup>';
    }
    ?>
    <?php if (has_post_thumbnail()) : ?>
        <a href="<?php the_permalink(); ?>">
            <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt=" <?php the_title_attribute(); ?>">
        </a>
    <?php endif; ?>
    <div class="b-post-details">
        <?php aai_post_meta() ?>
        <h3><a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h3>
        <?php if (get_the_content() && aai_option('blog_excerpt', 1)) : ?>
            <?php aai_excerpt(aai_option('blog_excerpt_word', 30), null); ?>
        <?php endif; ?>
        <?php if (!is_single() && aai_option('blog_readmore', 1) == true) : ?>
            <a class="read-more" href="<?php echo esc_url(get_the_permalink()); ?>"> <?php echo esc_html(aai_option('blog_readmore_text', 'Read More')); ?> <i class="fa fa-arrow-right"></i></a>
        <?php endif; ?>
    </div>
</div>