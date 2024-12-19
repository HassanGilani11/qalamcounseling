<?php

/**
 * the template for displaying all pages.
 */

get_header();

$blog_sidebar = aai_option('blog_sidebar', '3');
$column       = ($blog_sidebar == 1 || !is_active_sidebar('sidebar-1')) ? 'col-lg-12 mx-auto' : 'col-lg-8 col-md-12';

if (is_singular('page')) {
	get_template_part('template-parts/banner/content', 'banner-page');
}


?>
<main id="site-content" class="content-area section-padding blog-page" role="main">
	<div class="container">
		<div class="row">

			<?php if ($blog_sidebar == 2) {
				get_sidebar();
			}  ?>

			<div class="<?php echo esc_attr($column); ?>">
				<?php while (have_posts()) : the_post(); ?>
					<div class="quomodo-single-content">

						<?php get_template_part('template-parts/blog/content', 'page'); ?>

					</div>
					<?php if (comments_open() || get_comments_number()) : ?>
						<?php comments_template(); ?>
					<?php endif; ?>
				<?php endwhile; ?>
			</div> <!-- .col-md-8 -->

			<?php if ($blog_sidebar == 3) {
				get_sidebar();
			}  ?>

		</div> <!-- .row -->
	</div> <!-- .container -->
</main> <!--#main-content -->

<?php get_footer(); ?>