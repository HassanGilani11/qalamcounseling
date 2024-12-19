<?php

/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

get_header('shop');
get_template_part('template-parts/banner/content', 'banner-blog-single');
$shop_product_sidebar_enable  = aai_option('shop_product_sidebar_enable', 'no');
?>
<?php
if (function_exists('aai_title')) {
	aai_title();
}
?>
<div class="content-area section-padding single-product-page">
	<div class="container">
		<div class="row">
			<?php if (is_active_sidebar('shop-sidebar') && aai_option('shop_sidebar') == 'left' && $shop_product_sidebar_enable == 1) : ?>
				<div class="col-md-3 col-xs-12">
					<div class="widget-area sm-mt50 xs-mt30">
						<?php dynamic_sidebar('shop-sidebar');  ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if (is_active_sidebar('shop-sidebar') && $shop_product_sidebar_enable == 1) : ?>
				<div class="col-md-9">
				<?php else : ?>
					<div class="col-md-12">
					<?php endif; ?>

					<?php
					/**
					 * woocommerce_before_main_content hook.
					 *
					 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
					 * @hooked woocommerce_breadcrumb - 20
					 */
					do_action('woocommerce_before_main_content');
					?>

					<?php while (have_posts()) : the_post(); ?>

						<?php wc_get_template_part('content', 'single-product'); ?>

					<?php endwhile; // end of the loop. 
					?>

					<?php
					/**
					 * woocommerce_after_main_content hook.
					 *
					 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
					 */
					do_action('woocommerce_after_main_content');
					?>
					</div>
					<?php if (is_active_sidebar('shop-sidebar') && aai_option('shop_sidebar') == 'right' && $shop_product_sidebar_enable == 1) : ?>
						<div class="col-md-3 col-xs-12">
							<div class=" widget-area sm-mt50 xs-mt30">
								<?php dynamic_sidebar('shop-sidebar');  ?>
							</div>
						</div>
					<?php endif;  ?>
				</div>
		</div>
	</div>
	<?php get_footer('shop');
