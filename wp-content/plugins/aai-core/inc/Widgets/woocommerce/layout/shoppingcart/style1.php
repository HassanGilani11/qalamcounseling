<!--====== SHOPPING CART PART START ======-->
<div class="element-ready-shopping-cart">
    <a class="element-ready-shopping-cart-open" href="javascript:void(0);">
        
        <?php \Elementor\Icons_Manager::render_icon( $settings['interface_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        
        <?php if($settings['interface_text'] !=''): ?>
            <?php echo esc_html($settings['interface_text']); ?> 
        <?php endif; ?>

        <?php
           
            if($settings['cart_count_show'] =='yes'):
                if( \Elementor\Plugin::$instance->editor->is_edit_mode() ) { 
                    echo '<span class="element-ready-interface-cart-count">'.sprintf( '%s %s', 0, $settings['cart_count_text'] ).'</span>';   
                }else{
                    global $woocommerce;
                    $cart_count = $woocommerce->cart->cart_contents_count; 
                    $cart_count_text = $settings['cart_count_text'];
                    $cart_counts_text = $settings['cart_counts_text'];
                    if($cart_count > 1){
                        echo '<span class="element-ready-interface-cart-count">'.sprintf( '<span> %s </span> %s', $cart_count, $cart_counts_text ).'</span>'; 
                    }else{
                        echo '<span class="element-ready-interface-cart-count">'.sprintf( '<span> %s </span> %s', $cart_count, $cart_count_text ).'</span>';  
                    }
                  
                }
                
            endif;
        ?>
    </a>
</div>
<div class="element-ready-shopping-cart-wrapper">
    <div class="element-ready-shopping-cart-canvas <?php echo esc_attr($settings['offcanvas_container_direction']!='yes'?'element-ready-shopping-cart-leftbar':''); ?>">
        <div class="element-ready-shopping_cart">
            <div class="element-ready-shopping_cart-top-bar">
                <h6 class=""> <?php echo esc_html($settings['modal_heading_text']); ?> </h6>
                <button class="element-ready-shopping-cart-close">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['popup_close_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </button>
            </div><!-- shopping cart top bar -->
            <div class="element-ready-shopping_cart-list-items">
                <?php
                    $cart = WC()->cart;
                    if( !\Elementor\Plugin::$instance->editor->is_edit_mode() ):
                ?>
                        <ul>
                            <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ): ?>
                                <?php
                                    
                                    $product = $cart_item['data'];
                                    
                                    $product_id     = $cart_item['product_id'];
                                    $quantity       = $cart_item['quantity'];
                                    $price          = WC()->cart->get_product_price( $product );
                                    $subtotal       = WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] );
                                    $link           = $product->get_permalink( $cart_item );
                                    $name           = $product->get_name( $cart_item );
                                    $image_url      = wp_get_attachment_url( $product->get_image_id() );
                                  
                              
                                ?>
                                    <li>
                                        <div class="element-ready-single-shopping-cart media">
                                            <?php if($image_url !=''): ?>
                                                <div class="cart-image element-ready-cart-image">
                                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($name); ?>">
                                                </div>
                                            <?php endif; ?>
                                            <div class="cart-content media-body">

                                                <h6><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($name); ?></a></h6>
                                                <span class="quality"> <?php echo esc_html__('QTY: ','element-ready-pro'); ?> <?php echo esc_html($quantity); ?></span>
                                               
                                                <?php echo wp_kses_post($price); ?>
                                                
                                                <a data-product="<?php echo esc_attr($cart_item_key); ?>" class="element-ready-cart-item-remove" href="javascript:void(0);">
                                                    <i class="fa fa-times"></i>
                                                </a>

                                            </div>
                                        </div> <!-- single shopping cart -->
                                    </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
            </div> <!-- shopping_cart list items -->
            <div class="element-ready-shopping_cart-btn">
                <div class="total">
                    <h5 class="element-ready-sub-total"> <?php echo esc_html($settings['sub_total_text']); ?> </h5>
                    <p class="element-ready-sub-total-amount">
                        <?php if($settings['currency_after'] !='yes'): ?>
                            <span class="element-ready-wc-currency"><?php echo esc_html(get_woocommerce_currency_symbol()); ?> </span>
                        <?php endif; ?>
                         <span class="element-ready-wc-shopping-total-amount">
                            <?php

                             if( \Elementor\Plugin::$instance->editor->is_edit_mode() ) { 
                                echo esc_html__("0",'element-ready-pro');
                              }else{
                                echo esc_html(WC()->cart->total);
                              }
                         
                           ?>
                        </span>
                        <?php if($settings['currency_after'] =='yes'): ?>
                            <span class="element-ready-wc-currency"><?php echo esc_html(get_woocommerce_currency_symbol()); ?> </span>
                        <?php endif; ?>
                    </p>
                </div>
                <div class="cart-btn">
                      
                    <a class="main-btn element-ready-cart-btn" href="<?php echo esc_url(wc_get_cart_url()); ?>"> <?php echo esc_html($settings['view_cart_text']); ?> </a>
                    <a class="main-btn main-btn-2 element-ready-checkout-btn" href="<?php echo esc_url(wc_get_checkout_url()); ?>"> <?php echo esc_html($settings['checkout_text']); ?> </a>
                </div>
            </div>
        </div> <!-- shopping_cart -->
    </div>
    <div class="overlay"></div>
</div>
    <!--====== SHOPPING CART PART ENDS ======-->