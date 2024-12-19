<?php if($settings['show_content']): ?>
    <p class="text element-ready-content element-ready-text">
        <?php echo esc_html(wp_trim_words( get_the_excerpt(), $settings['post_content_crop'],'' )); ?>
    </p>
<?php endif; ?>