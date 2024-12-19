<?php
/*
 * This is the child theme for Aai theme.
 *
 * (Please see https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 */
add_action('wp_enqueue_scripts', 'aai_child_enqueue_styles');
function aai_child_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style(
        'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}
/*
 * Your code goes below
 */

// To change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 
function woocommerce_custom_single_add_to_cart_text() {
    return __( 'Add Subscription to Cart', 'woocommerce' ); 
}

// To change add to cart text on product archives(Collection) page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text' );  
function woocommerce_custom_product_add_to_cart_text() {
    return __( 'Add Subscription to Cart', 'woocommerce' );
}
add_filter( 'woocommerce_cart_item_permalink', '__return_false' );

add_filter( 'woocommerce_cart_item_thumbnail', '__return_false' ); 
add_filter( 'woocommerce_checkout_cart_item_thumbnail', '__return_false' );


function custom_woocommerce_cart_table_labels() {
    echo '<style>
        .woocommerce-cart-form th.product-name { width: 40%; }
        .woocommerce-cart-form th.product-price { width: 15%; }
        .woocommerce-cart-form th.product-quantity { width: 15%; }
        .woocommerce-cart-form th.product-subtotal { width: 15%; }
        .woocommerce-cart-form th.product-remove { width: 5%; }
    </style>';

    // Change the labels
    echo '<script>
        jQuery(document).ready(function($){
            $(".woocommerce-cart-form th.product-name").text("Membership Plan");
            $(".woocommerce-cart-form th.product-price").text("Price");
            $(".woocommerce-cart-form th.product-quantity").text("Qty");
            $(".woocommerce-cart-form th.product-subtotal").text("Subtotal");
        });
    </script>';
}

add_action('woocommerce_before_cart_table', 'custom_woocommerce_cart_table_labels');

function disable_checkout_product_links_script() {
    // Check if we are on the checkout page
    if ( is_checkout() ) {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($){
                // Disable product links on the checkout page
                $('td.product-name a').removeAttr('href');
            });
        </script>
        <?php
    }
}

add_action('wp_footer', 'disable_checkout_product_links_script');


function disable_my_account_order_links_script() {
    // Check if we are on the My Account page
    if ( is_account_page() ) {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($){
                // Disable product links on the My Account page in the order table
                $('tr.woocommerce-table__line-item td.product-name a').removeAttr('href');
            });
        </script>
        <?php
    }
}

add_action('wp_footer', 'disable_my_account_order_links_script');

function custom_logout_redirect() {
    wp_redirect(home_url('/my-account'));
    exit;
}
add_action('wp_logout', 'custom_logout_redirect');



