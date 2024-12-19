<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if (has_post_thumbnail() && !post_password_required()) : ?>
		<figure class="qomodo-entry-thumbnail">
			<?php the_post_thumbnail('full'); ?>
		</figure>
	<?php endif; ?>


	<?php if (!aai_option('page_banner_show', 1)) : ?>
		<header class="quomodo-entry-header">
			<h2 class="quomodo-title">
				<?php the_title(); ?>
			</h2>
		</header> <!-- .entry-header -->
	<?php endif; ?>

	<div class="qomodo-post-body clearfix">
		<!-- Article content -->
		<div class="qomodo-entry-content clearfix">
			<?php
			if (is_search()) {
				the_excerpt();
			} else {
				the_content(esc_html__('Continue reading &rarr;', 'aai'));
			}
			?>
		</div>
		<?php
		aai_link_pages();
		?>
		<!-- end entry-content -->
	</div>
	<!-- end post-body -->

</article>