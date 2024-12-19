<?php
/**
 * Post Search
 * Category Search
 * Layout Two
 * @since 1.0
 */

    
$cur_page_url  = get_home_url('/');
   
?>

<div class="element-ready_search_layout_2">
    <form role="search" method="get" action="<?php echo esc_url( $cur_page_url ); ?>">
        <div class="wooready_input_wrapper ">
            <div class="wooready_input_box flex-basis:80 position:relative">
                <input type="text" autocomplete="off" placeholder="<?php echo esc_html($settings['search_palceholder']); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'shopready-elementor-addon' ); ?>" />
                <input type="hidden" name="post_type" value="product" />
                <div class="wooready_nice_select display:flex <?php echo esc_attr($button_inline); ?>">
                    <?php if ( $settings['category'] == 'yes' ) {?>
                        <?php wp_dropdown_categories($defaults) ?>
                    <?php } ?>
                    <button ><?php echo wp_kses_post($search_icon); ?> <?php echo esc_html($settings['search_button_label']); ?></button>
                </div>
            </div> 
        </div>
    </form>

</div>