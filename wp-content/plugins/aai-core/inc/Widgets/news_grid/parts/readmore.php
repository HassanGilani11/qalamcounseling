<?php if($settings['show_readmore']): ?>
    <a class="element-ready-news-btn" href="<?php the_permalink() ?>"> 
        <?php echo esc_html($settings['readmore_text']);
        \Elementor\Icons_Manager::render_icon( $settings['readmore_icon'], [ 'aria-hidden' => 'true' ] );
     ?> </a>
<?php endif; ?>