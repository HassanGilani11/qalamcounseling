

<?php 
    $tranding = get_post_meta(get_the_id(),'_element_ready_trending',true);
    $tranding = 'yes'; 
?>

<?php if($tranding == 'yes' && $settings['show_tranding_icon'] == 'yes'): ?>
        <div class="icon element-ready-icon">
            <a href="<?php the_permalink() ?>">
                <?php \Elementor\Icons_Manager::render_icon( $settings['trending_icon'], [ 'aria-hidden' => 'true' ] ); ?>
            </a>
        </div>
<?php endif; ?>