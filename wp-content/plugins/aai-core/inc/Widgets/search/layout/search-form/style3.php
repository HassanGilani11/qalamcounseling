<?php
/**
 * Post Search
 * Category Search
 * Layout Three
 * @since 1.0
 */

    $cur_page_url  = get_home_url('/');
    $flex_basis = ( $settings['category'] == 'yes' ) ? 80 : 100 ;
 
?>

<div class="element-ready_search_layout_3">
    <form role="search" method="get" action="<?php echo esc_url( $cur_page_url ); ?>">
        <div class="wooready_input_wrapper display:flex">
            <?php if ( $settings['category'] == 'yes' ) {?>
                <div class="wooready_nice_select flex-basis:20">
                    <?php wp_dropdown_categories($defaults) ?>
                </div>
            <?php } ?>
            <div class="wooready_input_box flex-basis:<?php echo esc_attr($flex_basis);?> position:relative">
                <input type="text" autocomplete="off" placeholder="<?php echo esc_html($settings['search_palceholder']); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'shopready-elementor-addon' ); ?>" />
                <button class="<?php echo esc_attr($button_inline); ?>"><?php echo wp_kses_post($search_icon); ?> <?php echo esc_html($settings['search_button_label']); ?></button>
            </div> 
        </div>
    </form>
 
</div>
