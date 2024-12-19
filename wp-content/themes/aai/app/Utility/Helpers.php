<?php

/**
 * Helpers methods
 * List all your static functions you wish to use globally on your theme
 */

use Elementor\Core\Settings\Manager as SettingsManager;

if (!function_exists('aai_header_style')) :
   function aai_header_style()
   {
      $header_text_color = get_header_textcolor();

      if (get_theme_support('custom-header', 'default-text-color') === $header_text_color) {
         return;
      }
   }
endif;

/*----------------------------
    GET SVG LOGO
------------------------------*/
if (!function_exists('aai_get_logo_type_tag')) {
   function aai_get_logo_type_tag($url = '', $tag_class = '')
   {

      if ($tag_class) {
         $tag_class = 'class="' . esc_attr($tag_class) . '"';
      } else {
         $tag_class = '';
      }
      return '<img ' . $tag_class . ' src="' . esc_url($url) . '" alt="' . get_bloginfo('name') . '">';
   }
}


if (!function_exists('aai_starts_with')) {
   /**
    * Determine if a given string starts with a given substring.
    *
    * @param  string  $haystack
    * @param  string|array  $needles
    * @return bool
    */
   function aai_starts_with($haystack, $needles)
   {
      foreach ((array) $needles as $needle) {
         if ($needle != '' && substr($haystack, 0, strlen($needle)) === (string) $needle) {
            return true;
         }
      }
      return false;
   }
}

/*-------------------------------
    DAY LINK TO ARCHIVE PAGE
---------------------------------*/
if (!function_exists('aai_day_link')) {
   /**
    * aai_day_link() archive link
    * @return string return sting url for post.
    */
   function aai_day_link()
   {
      $archive_year   = get_the_time('Y');
      $archive_month  = get_the_time('m');
      $archive_day    = get_the_time('d');
      echo get_day_link($archive_year, $archive_month, $archive_day);
   }
}


if (!function_exists('aai_get_post_category')) {
   function aai_get_post_category($tax = 'category', $return_all = false)
   {

      $list = [];
      if (!count($list)) {

         $categories = get_terms($tax, array(
            'orderby'    => 'name',
            'order'      => 'DESC',
            'hide_empty' => false,
            'number'     => 200
         ));

         if ($return_all) {
            return $categories;
         }

         foreach ($categories as $category) {

            if (isset($category->term_id)) {
               $list[$category->term_id] = $category->name;
            }
         }
      }

      return $list;
   }
}




if (!function_exists('aai_get_post_tags')) {

   function aai_get_post_tags($tax = 'post_tag')
   {

      static $list = [];
      if (!count($list)) {
         $categories = get_terms($tax, array(
            'orderby'       => 'name',
            'order'         => 'DESC',
            'hide_empty'    => false,
            'number'        => 200

         ));

         foreach ($categories as $category) {
            $list[$category->term_id] = $category->name;
         }
      }

      return $list;
   }
}


function aai_child_category_meta()
{
   $post_child_cat = aai_option('blog_child_cat_show', 1);
   if ($post_child_cat) {
      return;
   }

   $aai_cat_term     = get_queried_object();
   $aai_cat_children = get_terms($aai_cat_term->taxonomy, array(
      'parent'     => $aai_cat_term->term_id,
      'hide_empty' => false
   ));

   if (!$aai_cat_children) {
      return;
   }

   if ($aai_cat_children) {

      echo '<div class="sub-category-list">';
      foreach ($aai_cat_children as $aai_subcat) {
         echo '<a class="post-cat" href="' . esc_url(get_term_link($aai_subcat, esc_html($aai_subcat->taxonomy))) . '" >' .
            esc_html($aai_subcat->name) .
            '</a>';
      }
      echo '</div>';
   }
}

function aai_category_meta()
{

   $blog_cat_show   = aai_option('blog_category', 'yes');
   $blog_cat_single = aai_option('blog_category_single', 'no');


   if ($blog_cat_show != 'yes') {
      return;
   }

   echo '<span class="category">';

   $cat = get_the_category();
   if ($blog_cat_single == 'yes') {

      shuffle($cat);

      if (isset($cat[0])) {

         echo  '<a 
                        class="post-cat" 
                        href="' . esc_url(get_category_link($cat[0]->term_id)) . '"
                        
                        >' . '<span class="before"></span>' .

            esc_html(get_cat_name($cat[0]->term_id)) .
            '<span class="after"></span> ' .
            '</a>';
      }

      return;
   }

   if ($cat) {

      foreach ($cat as $value) :

         echo  '<a 
                              class="post-cat" 
                              href="' . esc_url(get_category_link($value->term_id)) . '"
                              >' .
            esc_html(get_cat_name($value->term_id)) .
            '</a>';

      endforeach;
   }
   echo '</span>';
}

function aai_single_category_meta()
{

   $blog_cat_show   = aai_option('blog_single_category', 'yes');
   $blog_cat_single = aai_option('blog_category_single', 'no');


   if ($blog_cat_show != 'yes') {
      return;
   }

   echo '<div class="page_category">';

   $cat = get_the_category();
   if ($blog_cat_single == 'yes') {

      shuffle($cat);

      if (isset($cat[0])) {

         echo  '<a 
                        class="post-cat" 
                        href="' . esc_url(get_category_link($cat[0]->term_id)) . '"
                        
                        >' . '<span class="before"></span>' .

            esc_html(get_cat_name($cat[0]->term_id)) .
            '<span class="after"></span> ' .
            '</a>';
      }

      return;
   }

   if ($cat) {

      foreach ($cat as $value) :

         echo  '<a 
                              class="post-cat" 
                              href="' . esc_url(get_category_link($value->term_id)) . '"
                              >' .
            esc_html(get_cat_name($value->term_id)) .
            '</a>';

      endforeach;
   }
   echo '</div>';
}



/*------------------------------------------------------
   DISPLAY META INFORMATION FOR A SPECIFIC POST
-------------------------------------------------------*/
if (!function_exists('aai_post_meta')) :
   // post and post meta
   function aai_post_meta()
   {
?>
      <div class="bp-meta <?php echo esc_attr(aai_option('blog_author_image', 0) ? 'meta-author-image' : ''); ?>">

         <?php

         if (aai_option('blog_author', 1)) :
            $post_author_id = get_post_field('post_author', get_the_id());
            if (aai_option('blog_author_image', 0)) :

               printf(
                  '<a href="%2$s">%1$s %3$s</a>',
                  get_avatar(get_the_author_meta('ID'), 55),
                  esc_url(get_author_posts_url(get_the_author_meta('ID'))),
                  get_the_author_meta('display_name', $post_author_id)
               );

            else :

               if (is_singular('post')) {


                  printf(
                     '<a href="%1$s"><i class="fal fa-user"></i>%2$s</a>',
                     esc_url(get_author_posts_url($post_author_id)),
                     get_the_author_meta('display_name', $post_author_id)
                  );
               } else {

                  printf(
                     '<a href="%1$s"><i class="fal fa-user"></i>%2$s</a>',
                     esc_url(get_author_posts_url(get_the_author_meta('ID'))),
                     get_the_author()
                  );
               }

            endif;

         endif;


         if (get_post_type() === 'post' && aai_option('blog_date', 1)) {
            echo sprintf('<a href="%1$s"><i class="fal fa-clock"></i>%2$s</a>', get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d')), get_the_date(get_option('date_format')));
         }


         if (aai_option('blog_comment', 0)) :
            printf(
               '<a href="#" class="comments-link"><i class="fal fa-comments"></i>%1$s</a>',
               esc_html(get_comments_number(get_the_ID()))
            );
         endif;

         aai_random_category_retrip();


         ?>
      </div>
   <?php }
endif;

if (!function_exists('aai_content_estimated_reading_time')) {

   function aai_content_estimated_reading_time($content = '', $wpm = 200)
   {

      if ($content == '') {
         $content = get_the_content();
      }

      $clean_content = esc_html($content);
      $word_count    = str_word_count($clean_content);
      $time          = ceil($word_count / $wpm);

      if ($time <= 1) {
         $time .= esc_html__(' minute read', 'aai');
      } else {
         $time .= esc_html__(' minutes read', 'aai');
      }

      return $time;
   }
}
if (!function_exists('aai_link_pages')) :

   function aai_link_pages()
   {

      $args = array(
         'before'             => '<div class="page-links"><span class="page-link-text">' . esc_html__('More pages: ', 'aai') . '</span>',
         'after'             => '</div>',
         'link_before'       => '<span class="page-link">',
         'link_after'       => '</span>',
         'next_or_number'    => 'number',
         'separator'          => '  ',
         'nextpagelink'       => esc_html__('Next ', 'aai') . '<i class="fas fa-angle-right"></i>',
         'previouspagelink' => '<i class="fas fa-angle-left"></i>' . esc_html__(' Previous', 'aai'),
      );

      wp_link_pages($args);
   }

endif;

function aai_title_limit($title, $limit = 20)
{

   $title  =  wp_trim_words($title, $limit, '');
   echo esc_html($title);
}

/*----------------------------------------
   CUSTOM COMMENNS WALKER
-------------------------------------------*/
if (!function_exists('aai_comment_style')) :

   function aai_comment_style($comment, $args, $depth)
   {
      if ('div' === $args['style']) {
         $tag       = 'div';
         $add_below    = 'comment';
      } else {
         $tag       = 'li ';
         $add_below    = 'div-comment';
      }
   ?>
      <?php
      if ($args['avatar_size'] != 0) {
         echo get_avatar($comment, $args['avatar_size'], '', '', array('class' => 'comment-avatar float-left'));
      }
      ?>
      <<?php
         echo aai_kses($tag);
         comment_class(empty($args['has_children']) ? '' : 'parent');
         ?> id="comment-<?php comment_ID() ?>"><?php if ('div' != $args['style']) { ?>
            <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php }
                                                                              ?>
            <div class="meta-data">

               <div class="float-right reply"><?php
                                                comment_reply_link(
                                                   array_merge(
                                                      $args,
                                                      array(
                                                         'add_below'    => $add_below,
                                                         'depth'       => $depth,
                                                         'max_depth'    => $args['max_depth']
                                                      )
                                                   )
                                                );
                                                ?>
               </div>


               <span class="comment-author vcard"><?php
                                                   printf(aai_kses('<cite class="fn">%s</cite> <span class="says">%s</span>', 'aai'), get_comment_author_link(), esc_html__('says:', 'aai'));
                                                   ?>
               </span>
               <?php if ($comment->comment_approved == '0') { ?>
                  <em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'aai'); ?></em><br /><?php }
                                                                                                                                          ?>

               <div class="comment-meta commentmetadata comment-date">
                  <?php
                  // translators: 1: date, 2: time
                  printf(
                     esc_html__('%1$s', 'aai'),
                     get_comment_date()
                  );
                  ?>
                  <?php edit_comment_link(esc_html__('(Edit)', 'aai'), '  ', ''); ?>
               </div>
            </div>
            <div class="comment-content">
               <?php comment_text(); ?>
            </div>
            <?php if ('div' != $args['style']) : ?>
            </div><?php
               endif;
            }
         endif;

         /*---------------------------------------
   EXCERPT CUSTOM WORD COUNT
-----------------------------------------*/
         function aai_excerpt($words = 40, $more = '')
         {

            if ($more == 'button') {
               $more = '<a class="btn btn-primary">' . esc_html__('read more', 'aai') . '</a>';
            }

            $excerpt         = get_the_excerpt();
            $trimmed_content = wp_trim_words($excerpt, $words, $more);

            echo wpautop(wp_kses_post($trimmed_content));
         }

         /*--------------------------------------
   SINGLE POST NAVIGATION
---------------------------------------*/
         if (!function_exists('aai_post_nav')) :

            // display navigation to the next/previous set of posts
            // ----------------------------------------------------------------------------------------
            function aai_post_nav()
            {
               // Don't print empty markup if there's nowhere to navigate.

               if (!aai_option('blog_post_nav', '1')) {
                  return;
               }

               $next_post    = get_next_post();
               $pre_post    = get_previous_post();
               if (!$next_post && !$pre_post) {
                  return;
               }
                  ?>
         <nav class="qomodo-post-navigation clearfix">
            <div class="post-previous">
               <?php if (!empty($pre_post)) : ?>
                  <a href="<?php echo get_the_permalink($pre_post->ID); ?>">
                     <h3><?php echo get_the_title($pre_post->ID) ?></h3>
                     <span><i class="far fa-angle-left"></i><?php esc_html_e('Previous post', 'aai') ?></span>
                  </a>
               <?php endif; ?>
            </div>
            <div class="post-next">
               <?php if (!empty($next_post)) : ?>
                  <a href="<?php echo get_the_permalink($next_post->ID); ?>">
                     <h3><?php echo get_the_title($next_post->ID) ?></h3>

                     <span><?php esc_html_e('Next post', 'aai') ?> <i class="far fa-angle-right"></i></span>
                  </a>
               <?php endif; ?>
            </div>
         </nav>
      <?php }
         endif;

         function aai_get_top_post()
         {
            $blog_top_post = aai_option('blog_top_post');

            if ($blog_top_post == 'no') {
               return new \WP_Query();
            }

            $blog_top_post_settings = aai_option('blog_top_post_settings');

            if (!isset($blog_top_post_settings['yes'])) {
               return new \WP_Query();
            }

            $settings = $blog_top_post_settings['yes'];
            $arg = [
               'post_type'        => 'post',
               'post_status'      => 'publish',
               'order'            => $settings['order'],
               'posts_per_page'   => $settings['count'],
               'category__in'     => $settings['category'],
               'tag__in'          => $settings['tags'],
               'suppress_filters' => false,
            ];

            if ($settings['skip_post'] > 0) {
               $arg['offset'] = $settings['skip_post'];
            }

            return  new \WP_Query($arg);
         }

         //date 
         function aai_post_time_ago_function()
         {
            return sprintf(esc_html__('%s ago', 'aai'), human_time_diff(get_the_time('U'), current_time('timestamp')));
         }

         function aai_get_current_date()
         {

            return date_i18n(get_option('date_format'));
         }



         /*
* get images sizes
* @return bool
*/
         function aai_get_all_image_sizes()
         {
            global $_wp_additional_image_sizes;

            $default_image_sizes = array('thumbnail', 'medium', 'large');

            foreach ($default_image_sizes as $size) {
               $image_sizes[$size]['width']   = intval(get_option("{$size}_size_w"));
               $image_sizes[$size]['height'] = intval(get_option("{$size}_size_h"));
               $image_sizes[$size]['crop']   = get_option("{$size}_crop") ? get_option("{$size}_crop") : false;
            }

            if (isset($_wp_additional_image_sizes) && count($_wp_additional_image_sizes))
               $image_sizes = array_merge($image_sizes, $_wp_additional_image_sizes);

            return $image_sizes;
         }


         function aai_str_snake_case($str, array $noStrip = [])
         {
            // non-alpha and non-numeric characters become spaces
            $str = preg_replace('/[^a-z0-9' . implode("", $noStrip) . ']+/i', ' ', $str);
            $str = trim($str);
            $str = str_replace(" ", "_", $str);
            $str = strtolower($str);

            return $str;
         }


         function aai_get_contact_forms_seven_list()
         {
            $forms_list = array();
            $forms_args = array('posts_per_page' => -1, 'post_type' => 'wpcf7_contact_form');
            $forms      = get_posts($forms_args);

            if ($forms) {
               foreach ($forms as $form) {
                  $forms_list[$form->ID] = $form->post_title;
               }
            } else {
               $forms_list[esc_html__('No contact form found', 'aai')] = 0;
            }
            return $forms_list;
         }

         function aai_social_share()
         {
            // option blog-details.php 
            $post_social_share_show = aai_option('post_social_share_show', 'no');

            if ($post_social_share_show == 'no') {
               return;
            }

            $general_social_share = aai_option('general_social_share', []);

            if (!is_array($general_social_share)) {
               return;
            }
      ?>
      <div class="author_social inline text-right">
         <ul>
            <?php
            foreach ($general_social_share as $share) {
               if (isset($share['social'])) {

            ?>
                  <li> <a href="<?php echo esc_url(get_the_permalink()); ?>" data-social="<?php echo esc_attr($share['social']); ?>"><i class="<?php echo esc_attr($share['icon_class']); ?>"></i></a> </li>
            <?php
               }
            }
            ?>

         </ul>
      </div>
   <?php


         }


         if (!function_exists('aai_fontawesome_icons')) {

            function aai_fontawesome_icons($prefix = 'fab')
            {
               $prefix = apply_filters('aai_social_icons_prefix', $prefix);
               $social_icons = array(
                  "$prefix fa-facebook"           => 'facebook',
                  "$prefix fa-facebook-f"         => 'facebook-f',
                  "$prefix fa-facebook-messenger" => 'facebook-messenger',
                  "$prefix fa-facebook-square"    => 'facebook-square',
                  "$prefix fa-linkedin"           => 'linkedin',
                  "$prefix fa-linkedin-in"        => 'linkedin-in',
                  "$prefix fa-twitter"            => 'twitter',
                  "$prefix fa-twitter-square"     => 'twitter-square',
                  "$prefix fa-uber"               => 'uber',
                  "$prefix fa-google"             => 'google',
                  "$prefix fa-google-drive"       => 'google-drive',
                  "$prefix fa-google-play"        => 'google-play',
                  "$prefix fa-google-wallet"      => 'google-wallet',
                  "$prefix fa-linkedin"           => 'linkedin',
                  "$prefix fa-linkedin-in"        => 'linkedin-in',
                  "$prefix fa-whatsapp"           => 'whatsapp',
                  "$prefix fa-whatsapp-square"    => 'whatsapp-square',
                  "$prefix fa-wordpress"          => 'wordpress',
                  "$prefix fa-wordpress-simple"   => 'wordpress-simple',
                  "$prefix fa-youtube"            => 'youtube',
                  "$prefix fa-youtube-square"     => 'youtube-square',
                  "$prefix fa-xbox"               => 'xbox',
                  "$prefix fa-vk"                 => 'vk',
                  "$prefix fa-vnv"                => 'vnv',
                  "$prefix fa-instagram"          => 'instagram',
                  "$prefix fa-reddit"             => 'reddit',
                  "$prefix fa-reddit-alien"       => 'reddit-alien',
                  "$prefix fa-reddit-square"      => 'reddit-square',
                  "$prefix fa-pinterest"          => 'pinterest',
                  "$prefix fa-pinterest-p"        => 'pinterest-p',
                  "$prefix fa-pinterest-square"   => 'pinterest-square',
                  "$prefix fa-tumblr"             => 'tumblr',
                  "$prefix fa-tumblr-square"      => 'tumblr-square',
                  "$prefix fa-flickr"             => 'flickr',
                  "$prefix fa-meetup"             => 'meetup',
                  "$prefix fa-share"              => 'share',
                  "$prefix fa-vimeo-v"            => 'vimeo',
                  "$prefix fa-weixin"             => 'Wechat',

               );

               return apply_filters('aai_social_icons', $social_icons);
            }
         }
