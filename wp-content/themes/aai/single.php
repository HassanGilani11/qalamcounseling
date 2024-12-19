<?php

/**
 * the template for displaying all posts.
 */

get_header();
get_template_part('template-parts/banner/content', 'banner-blog-single');
$blog_sidebar    = aai_option('blog_sidebar', 1);
$blog_two_column = aai_option('blog_two_column', 0);

$column  = ($blog_sidebar == 1 || !is_active_sidebar('sidebar-1')) ? 'col-lg-12' : 'col-lg-8 col-md-12';

?>

<main id="site-content" class="content-area section-padding" role="main">
  <div class="container">
    <div class="row">

      <?php
      if ($blog_sidebar == 2) {
        get_sidebar();
      }
      ?>

      <div class="<?php echo esc_attr($column); ?>">
        <?php while (have_posts()) : the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class(["quomodo-post-content", "post-single"]); ?>>
            <?php get_template_part('template-parts/blog/content', 'single'); ?>
          </article>
          <?php

          if (wp_count_posts('post')->publish > 1) {
            aai_post_navigation();
          }

          if (comments_open() || get_comments_number()) :
            comments_template();
          endif;

          aai_set_postview();

          ?>
        <?php endwhile; ?>
      </div> <!-- .col-md-8 -->

      <?php

      if ($blog_sidebar == 3) {
        get_sidebar();
      }
      ?>
    </div> <!-- .row -->
  </div> <!-- .container -->
</main> <!--#main-content -->
<?php get_footer(); ?>