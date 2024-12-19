<?php

$blog_author = aai_option('blog_single_author_box', 0);
$user_id     = get_the_author_meta('ID');
$designation = get_user_meta(get_the_author_meta('ID'), 'designation', true);

?>
<?php if ($blog_author) : ?>

    <div class="post-admin">
        <?php echo get_avatar(get_the_author_meta('ID'), 70); ?>
        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"> <?php echo esc_html(get_the_author()); ?> </a>
        <?php if ($designation != '') : ?>
            <span> <?php echo esc_html($designation); ?> </span>
        <?php endif; ?>
        <?php echo wpautop(get_the_author_meta('user_description')); ?>
    </div>

<?php endif; ?>