  <?php
  $testimonial = aai_meta_option(get_the_id(), 'testimonial', get_the_title());

  ?>
  <div class="post-item-1 <?php echo esc_attr(aai_option('blog_box_shadow', 1) ? 'box-shadow' : 'no-box-shadow'); ?> <?php echo esc_attr(aai_option('blog_box_shadow_hover', 1) ? 'box-shadow-hover' : 'no-box-shadow-hover'); ?>">
    <div class="b-post-details quote">
      <blockquote>
        <h3><a href="<?php the_permalink(); ?>"> <?php echo esc_html($testimonial); ?> </a></h3>
      </blockquote>
    </div>
  </div>