<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Q_ELement Rady
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

use Element_Ready_Pro\Base\Post\Comments_Walker as ER_Comments_Walker;

?>

<div class="qs__blog__comments__container"> <!-- Comments Container Start -->

	<div id="qs__blog__comments" class="qs__blog__comments__area"> <!-- Comments Area Start -->

		<?php if ( get_comments_number() && $settings['show_er_comment_lists'] == 'yes' ) : // Check for have_comments(). ?>
			<?php if($settings['comment_list_heading_enable'] == 'yes'): ?>
				<div class="qs__blog__comments__header"><!-- Comments Header -->
					<h3 class="qs__blog__comments__title">
						<?php

							$comment_count = get_comments_number();
							if ( '1' === $comment_count ) {
								printf(
									esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'element-ready-pro' ),
									'<span>' . wp_kses_post( get_the_title() ) . '</span>'
								);
							} else {
								printf(
									esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'element-ready-pro' ) ),
									number_format_i18n( $comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'<span>' . wp_kses_post( get_the_title() ) . '</span>'
								);
							}

						?>
					</h3>
				</div><!-- Comments Header End -->
			<?php endif; ?>
			<?php if($settings['comment_pagination_enable'] == 'yes'): ?>
				<div class="qs__blog__comments__pagination er-top-cpage">
					<?php $this->_comments_pagination(); ?>
				</div>
            <?php endif; ?>   
			<div class="qs__blog__comments__lists__area"><!-- Comments list Area Start -->
				<div class="qs__blog__comments__list"><!-- Comments list Start -->
					<?php

						$comments = get_comments(array(
							'post_id' => $post_id,
							'status' => 'approve' //Change this to the type of comments to be displayed
						));

						wp_list_comments(
							array(
								'style'      => 'div',
								'short_ping' => true,
								'walker'     => new ER_Comments_Walker(),
							),
							$comments
						);
					?>
				</div><!-- Comments list End -->
			</div><!-- Comments list Area End -->
			<?php if($settings['comment_pagination_bottom_enable'] == 'yes'): ?>
				<div class="qs__blog__comments__pagination er-bottom-cpage">
					<?php $this->_comments_pagination(); ?>
				</div>
			<?php endif; ?>  
		<?php endif; // Check for have_comments(). ?>
		
        <div class="qs__blog__comment__form">
            <?php $this->_comment_form() ?>
        </div>
		
		
	</div> <!-- Comments Area Start -->
</div> <!-- Comments Container Start -->