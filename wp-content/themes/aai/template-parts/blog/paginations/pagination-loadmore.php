<?php

if (!aai_option('blog_post_nav', 1)) {
    return;
}

global $wp_query;

// stop execution if there's only 1 page
if ($wp_query->max_num_pages <= 1) {
    return;
}

?>

<a href="<?php echo esc_url(get_next_posts_link()); ?>" class="btn load-btn"> <?php echo esc_html__('Load More', 'aai'); ?> <i class="icon_loading"></i></a>