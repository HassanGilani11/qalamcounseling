<?php

$single_post_tags = aai_option('single_post_tags', '1');

if (!$single_post_tags) {
   return;
}

$tag_list = get_the_tag_list();

if (!$tag_list) {
   return;
}

?>
<div class="post-footer-tags clearfix">
   <div class="post-tags">
      <h5> <?php echo  esc_html__('Tags', 'aai') . ':'; ?> </h5>
      <?php echo aai_kses($tag_list); ?>
   </div>
</div>