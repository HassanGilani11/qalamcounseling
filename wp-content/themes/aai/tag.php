<?php

/**
 * The main template file
 */

get_header();

get_template_part('template-parts/banner/content', 'banner-blog');

$blog_sidebar = aai_option('blog_sidebar', 3);

if ($blog_sidebar == 1 || !is_active_sidebar('sidebar-1')) {
	$column       = 'col-lg-12';
	$post_layout  = 'col-md-12 col-sm-12 col-xs-12';
} else {
	$column       =  'col-lg-8 col-md-12';
	$post_layout  = 'col-md-12 col-xs-12';
}

if (aai_option('blog_grid', 0)) {
	$post_layout  = 'col-lg-6';
}

?>

<main id="site-content" class="content-area section-padding blog" role="main">
	<div class="container">
		<div class="blog-posts-list">
			<div class="row blog-masonry blog__grid <?php echo esc_attr(aai_option('blog_grid', 0) ? 'aai__grid_blog' : '') ?>">

				<?php
				if ($blog_sidebar == 2) {
					get_sidebar();
				}
				?>

				<div class="<?php echo esc_attr($column); ?>">
					<div class="row">
						<?php if (have_posts()) : ?>

							<?php while (have_posts()) : the_post(); ?>
								<div class="<?php echo esc_attr($post_layout); ?>">
									<?php get_template_part('template-parts/blog/content', get_post_format()); ?>
								</div><!-- .column -->
							<?php endwhile; ?>
							<?php if (!aai_option('blog_grid', 0)) : ?>
								<div class="col-md-12">
									<?php get_template_part('template-parts/blog/paginations/pagination', 'style2'); ?>
								</div>
							<?php endif; ?>
						<?php else : ?>
							<div class="col-md-12">
								<?php get_template_part('template-parts/blog/content', 'none'); ?>
							</div>
						<?php endif; ?>
					</div><!-- .row -->
				</div><!-- .col-md-8 -->

				<?php
				if ($blog_sidebar == 3) {
					get_sidebar();
				}
				?>

			</div><!-- .row -->
			<?php if (aai_option('blog_grid', 0)) : ?>
				<div class="post-pagination">
					<?php aai_pagination(); ?>
				</div>
			<?php endif; ?>
		</div><!-- .blog-post-list -->
	</div><!-- .container -->
</main><!-- #main-content -->
<?php get_footer(); ?>