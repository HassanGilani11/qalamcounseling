<?php

if (!class_exists('WooCommerce')) {
	return;
}

/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package aai
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function aai_woocommerce_setup()
{
	add_theme_support('woocommerce');
	add_theme_support('wc-product-gallery-zoom');
	add_theme_support('wc-product-gallery-lightbox');
	add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'aai_woocommerce_setup');

function aai_show_widgets_init()
{
	register_sidebar(array(
		'name'          => esc_html__('Shop Sidebar', 'aai'),
		'id'            => 'shop-sidebar',
		'description'   => esc_html__('Add widgets here. This widgets will be appear in shop page and when the wocommerce plugin are installed.', 'aai'),
		'before_widget' => '<div id="%1$s" class="single-widgets %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
	));
}
add_action('widgets_init', 'aai_show_widgets_init');


/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function aai_woocommerce_scripts()
{

	wp_enqueue_style('aai-woocommerce-style', AAI_THEME_URI . '/woocommerce/assets/woocommerce.css');

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}
	';

	wp_add_inline_style('aai-woocommerce-style', $inline_font);
}
add_action('wp_enqueue_scripts', 'aai_woocommerce_scripts');

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function aai_woocommerce_active_body_class($classes)
{
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter('body_class', 'aai_woocommerce_active_body_class');

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function aai_woocommerce_products_per_page()
{
	return 12;
}
add_filter('loop_shop_per_page', 'aai_woocommerce_products_per_page');

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function aai_woocommerce_thumbnail_columns()
{
	return 4;
}
add_filter('woocommerce_product_thumbnails_columns', 'aai_woocommerce_thumbnail_columns');

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function aai_woocommerce_loop_columns()
{

	if (is_active_sidebar('shop-sidebar')) {
		return aai_option('shop_product_columns', 3);
	} else {
		return aai_option('shop_product_columns', 3);
	}
}
add_filter('loop_shop_columns', 'aai_woocommerce_loop_columns');

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function aai_woocommerce_related_products_args($args)
{
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args($defaults, $args);

	return $args;
}
add_filter('woocommerce_output_related_products_args', 'aai_woocommerce_related_products_args');

if (!function_exists('aai_woocommerce_product_columns_wrapper')) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function aai_woocommerce_product_columns_wrapper()
	{
		$columns = aai_woocommerce_loop_columns();
		echo '<div class="columns-' . absint($columns) . '">';
	}
}
add_action('woocommerce_before_shop_loop', 'aai_woocommerce_product_columns_wrapper', 40);

if (!function_exists('aai_woocommerce_product_columns_wrapper_close')) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function aai_woocommerce_product_columns_wrapper_close()
	{
		echo '</div>';
	}
}
add_action('woocommerce_after_shop_loop', 'aai_woocommerce_product_columns_wrapper_close', 40);

/**
 * Remove default WooCommerce wrapper.
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

if (!function_exists('aai_woocommerce_wrapper_before')) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function aai_woocommerce_wrapper_before()
	{
?>
		<div id="content" class="site-content">
		<?php
	}
}
add_action('woocommerce_before_main_content', 'aai_woocommerce_wrapper_before');

if (!function_exists('aai_woocommerce_wrapper_after')) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function aai_woocommerce_wrapper_after()
	{
		?>
		</div><!-- #primary -->
	<?php
	}
}
add_action('woocommerce_after_main_content', 'aai_woocommerce_wrapper_after');

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'aai_woocommerce_header_cart' ) ) {
			aai_woocommerce_header_cart();
		}
	?>
 */

if (!function_exists('aai_woocommerce_cart_link_fragment')) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function aai_woocommerce_cart_link_fragment($fragments)
	{
		ob_start();
		aai_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter('woocommerce_add_to_cart_fragments', 'aai_woocommerce_cart_link_fragment');

if (!function_exists('aai_woocommerce_cart_link')) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function aai_woocommerce_cart_link()
	{
	?>
		<a class="cart-contents cart-button" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'aai'); ?>"><i class="ti-shopping-cart"></i><span class="cart-count"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span>
		</a>
	<?php
	}
}

if (!function_exists('aai_woocommerce_header_cart')) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function aai_woocommerce_header_cart()
	{
	?>
		<div class="cart-button-and-item">
			<?php aai_woocommerce_cart_link(); ?>
			<?php if (!is_cart() && !is_checkout()) : ?>
				<div id="site-header-cart" class="site-header-cart">
					<?php
					$instance = array(
						'title' => ' ',
					);

					the_widget('WC_Widget_Cart', $instance);
					?>
				</div>
			<?php endif; ?>
		</div>
	<?php
	}
}
add_filter('woocommerce_show_page_title', '__return_false');
/**
 * Remove single produt related products output
 */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

/**
 * Remove Result Count and catelog ordering and breadcrumb from shop page
 */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

/**
 * Add Custom Plus and Minus Button On WooCommerce Quantity.
 */
if (!function_exists('aai_quantity_fields_script')) {
	function aai_quantity_fields_script()
	{
	?>
		<script type='text/javascript'>
			jQuery(function($) {
				if (!String.prototype.getDecimals) {
					String.prototype.getDecimals = function() {
						var num = this,
							match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
						if (!match) {
							return 0;
						}
						return Math.max(0, (match[1] ? match[1].length : 0) - (match[2] ? +match[2] : 0));
					}
				}
				// Quantity "plus" and "minus" buttons
				$(document.body).on('click', '.plus, .minus', function() {
					var $qty = $(this).closest('.quantity').find('.qty'),
						currentVal = parseFloat($qty.val()),
						max = parseFloat($qty.attr('max')),
						min = parseFloat($qty.attr('min')),
						step = $qty.attr('step');

					// Format values
					if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
					if (max === '' || max === 'NaN') max = '';
					if (min === '' || min === 'NaN') min = 0;
					if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

					// Change the value
					if ($(this).is('.plus')) {
						if (max && (currentVal >= max)) {
							$qty.val(max);
						} else {
							$qty.val((currentVal + parseFloat(step)).toFixed(step.getDecimals()));
						}
					} else {
						if (min && (currentVal <= min)) {
							$qty.val(min);
						} else if (currentVal > 0) {
							$qty.val((currentVal - parseFloat(step)).toFixed(step.getDecimals()));
						}
					}

					// Trigger change event
					$qty.trigger('change');

					return false;
				});
			});
		</script>
<?php
	}
}
add_action('wp_footer', 'aai_quantity_fields_script');
