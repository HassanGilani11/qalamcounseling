<?php

/* post view count 
* function to display number of posts.
*/
// ::::::::::::::::::::::::::::
function aai_get_postview($postID)
{

   $count_key = 'aai_post_views_count';
   $count     = get_post_meta($postID, $count_key, true);

   if ($count == '') {
      return "0";
   }

   return $count;
}

function aai_google_fonts_url($font_families    = [])
{
   $fonts_url       = '';
   /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
    */
   if ($font_families && 'off' !== _x('on', 'Google font: on or off', 'aai')) {
      $query_args = array(
         'family' => urlencode(implode('|', $font_families))
      );

      $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
   }

   return esc_url_raw($fonts_url);
}

// function to count views.
function aai_set_postview($postID = null)
{

   if (is_null($postID)) {
      $postID = get_the_ID();
   }

   $count_key = 'aai_post_views_count';
   $count     = get_post_meta($postID, $count_key, true);

   if ($count == '') {

      $count = 0;
      delete_post_meta($postID, $count_key);
      add_post_meta($postID, $count_key, '0');
   } else {

      $count++;
      update_post_meta($postID, $count_key, $count);
   }
}

/* return the specific value from theme options  */
if (!function_exists('aai_option')) {

   function aai_option($option = '', $default = '', $parent = 'aai_settings')
   {

      if (class_exists('CSF')) {
         $options = get_option($parent);
         return (isset($options[$option])) ? $options[$option] : $default;
      }

      return $default;
   }
}

// return the specific value from metabox
// ----------------------------------------------------------------------------------------
if (!function_exists('aai_meta_option')) {

   function aai_meta_option($postid, $key, $default_value = '', $parent_key = '')
   {

      $post_key = 'aai_post_options';
      // page meta
      if (is_singular('page')) {
         $post_key = 'aai_page_options';
      }
      // post meta
      if (is_singular('post')) {
         $post_key = 'aai_post_options';
      }


      if ($parent_key != '') {
         $post_key = $parent_key;
      }


      if (class_exists('CSF')) {
         $options = get_post_meta($postid, $post_key, true);
         return (isset($options[$key])) ? $options[$key] : $default_value;
      }

      return $default_value;
   }
}


// return the specific value from term/ taxomony metabox
// ----------------------------------------------------------------------------------------
if (!function_exists('aai_term_option')) :

   function aai_term_option($termid, $key, $default_value = '', $taxomony = 'category')
   {

      if (defined('FW')) {
         $value = fw_get_db_term_option($termid, $taxomony, $key);
      }

      return (!isset($value) || $value == '') ? $default_value :  $value;
   }

endif;


// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function aai_kses($raw)
{

   $allowed_tags = array(
      'a'                         => array(
         'class'    => array(),
         'href'    => array(),
         'rel'    => array(),
         'title'    => array(),
         'target'    => array(),
      ),
      'option' => array(
         'value'    => array(),

      ),
      'abbr'                      => array(
         'title' => array(),
      ),
      'b'                         => array(),
      'blockquote'                => array(
         'cite' => array(),
      ),
      'cite'                      => array(
         'title' => array(),
      ),
      'code'                      => array(),
      'del'                      => array(
         'datetime'    => array(),
         'title'       => array(),
      ),
      'dd'                      => array(),
      'div'                      => array(
         'class'    => array(),
         'title'    => array(),
         'style'    => array(),
      ),
      'dl'                      => array(),
      'dt'                      => array(),
      'em'                      => array(),
      'h1'                      => array(),
      'h2'                      => array(),
      'h3'                      => array(),
      'h4'                      => array(),
      'h5'                      => array(),
      'h6'                      => array(),
      'i'                         => array(
         'class' => array(),
      ),
      'img'                      => array(
         'alt'    => array(),
         'class'    => array(),
         'height' => array(),
         'src'    => array(),
         'width'    => array(),
      ),
      'li'                      => array(
         'class' => array(),
      ),
      'ol'                      => array(
         'class' => array(),
      ),
      'p'                         => array(
         'class' => array(),
      ),
      'q'                         => array(
         'cite'    => array(),
         'title'    => array(),
      ),
      'span'                      => array(
         'class'    => array(),
         'title'    => array(),
         'style'    => array(),
      ),
      'iframe'                   => array(
         'width'          => array(),
         'height'       => array(),
         'scrolling'       => array(),
         'frameborder'    => array(),
         'allow'          => array(),
         'src'          => array(),
      ),
      'strike'                   => array(),
      'br'                      => array(),
      'strong'                   => array(),
      'data-wow-duration'             => array(),
      'data-wow-delay'             => array(),
      'data-wallpaper-options'       => array(),
      'data-stellar-background-ratio'    => array(),
      'ul'                      => array(
         'class' => array(),
      ),
   );

   if (function_exists('wp_kses')) { // WP is here
      $allowed = wp_kses($raw, $allowed_tags);
   } else {
      $allowed = $raw;
   }

   return $allowed;
}


function aai_get_excerpt($count = 100)
{

   $count = aai_desc_limit($count);

   $aai_blog_read_more_text = esc_html__('Readmore', 'aai');

   $excerpt = get_the_excerpt();
   $excerpt = esc_html($excerpt);
   $words   = str_word_count($excerpt, 2);
   $pos     = array_keys($words);

   if (count($words) > $count) {
      $excerpt = substr($excerpt, 0, $pos[$count]);
   }

   $excerpt = wp_kses_post($excerpt);

   return $excerpt;
}

function aai_desc_limit($default)
{

   if (!is_single() && !is_page()) {

      if (aai_option('aai_categry_post_desc_lenght')) {
         return aai_option('aai_categry_post_desc_lenght');
      } else {
         return $default;
      }
   } else {
      return $default;
   }
}

// related post by tags

function aai_related_posts_by_tags($post_id = '', $feature_image = false)
{

   try {

      if ($post_id == '') {
         $post_id = get_the_ID();
      }

      $related_count = aai_option('blog_related_post_number', 3);

      $tags      = wp_get_post_tags($post_id);
      $term_tags = wp_list_pluck($tags, 'term_id');
      $args = array(

         'tag__in'             => $term_tags,
         'post__not_in'        => array($post_id),
         'posts_per_page'      => $related_count,
         'ignore_sticky_posts' => 1,

      );

      if ($feature_image) {
         $args["meta_query"] = array(
            array(
               'key'     => '_thumbnail_id',
               'compare' => 'EXISTS'
            ),
         );
      }

      return new WP_Query($args);
   } catch (Exception $e) {

      return new WP_Query([]);
   }
}

function aai_related_posts_by_sticky()
{

   if (!is_category()) {
      return new WP_Query([]);
   }

   try {

      $term = get_queried_object();
      $args = [

         'post_type'           => 'post',
         'post__in'            => get_option('sticky_posts'),
         'posts_per_page'      => 10,
         'ignore_sticky_posts' => 1,
         'tax_query' => array(
            array(
               'taxonomy' => 'category',
               'field' => 'slug',
               'terms' => $term->slug,
            )
         ),

      ];


      return new WP_Query($args);
   } catch (Exception $e) {

      return new WP_Query([]);
   }
}

function aai_src($key, $default_value = '', $input_as_attachment = false)
{ // for src

   if ($input_as_attachment == true) {
      $attachment = $key;
   } else {
      $attachment = aai_option($key);
   }

   if (isset($attachment['url']) && !empty($attachment)) {
      return $attachment['url'];
   }

   return $default_value;
}

if (!function_exists('aai_ad')) :

   function aai_ad($key, $default)
   {

      $ad = aai_option($key, ['ad_link' => '', 'ad_html' => '']);

      if ($ad['ad_link'] != '' || $ad['ad_link'] != '' || isset($ad['ad_image']) || $ad['ad_html'] != '') {
         if ($ad['ad_html'] != '') {
            echo aai_return($ad['ad_html']);
         } else {
            if (isset($ad['ad_image'])) {

               $img_url = $ad['ad_image'];
               if (!isset($img_url['url'])) {
                  return;
               }
            }
?>
            <a href="<?php echo esc_url($ad['ad_link']); ?>" target="_blank">
               <img src="<?php echo esc_url($ad['ad_image']['url']); ?>" alt="<?php echo esc_attr('Aai ads', 'aai'); ?>">
            </a>
<?php
         }
      }
   }

endif;



if (!function_exists('aai_social_share_list')) :
   function aai_social_share_list()
   {

      $data = array(
         ''              => '---',
         'facebook'      => 'facebook',
         'twitter'       => 'twitter',
         'linkedin'      => 'linkedin',
         'pinterest'     => 'pinterest ',
         'digg'          => 'digg',
         'tumblr'        => 'tumblr',
         'blogger'       => 'blogger',
         'reddit'        => 'reddit',
         'delicious'     => 'delicious',
         'flipboard'     => 'flipboard',
         'vkontakte'     => 'vkontakte',
         'odnoklassniki' => 'odnoklassniki',
         'moimir'        => 'moimir',
         'livejournal'   => 'livejournal',
         'blogger'       => 'blogger',
         'evernote'      => 'evernote',
         'flipboard'     => 'flipboard',
         'mix'           => 'mix',
         'meneame'       => 'meneame',
         'pocket'        => 'pocket',
         'surfingbird'   => 'surfingbird ',
         'liveinternet'  => 'liveinternet',
         'buffer'        => 'buffer',
         'instapaper'    => 'instapaper',
         'xing'          => 'xing',
         'wordpres'      => 'wordpres',
         'baidu'         => 'baidu',
         'renren'        => 'renren',
         'weibo'         => 'weibo',


      );

      return $data;
   }
endif;


if (!function_exists('aai_get_fb_share_count')) :

   function aai_get_fb_share_count($post_id = null)
   {

      $cache_key    = 'aai_fb_share_' . $post_id;
      $url          = get_permalink($post_id);
      $access_token = aai_get_fb_secret_key();

      $api_url      = 'https://graph.facebook.com/v3.0/?id=' . urlencode($url) . '&fields=engagement&access_token=' . $access_token;
      $json_return  = wp_remote_get($api_url);
      $responseBody = wp_remote_retrieve_body($json_return);
      $result       = json_decode($responseBody);

      if (is_object($result) && !is_wp_error($result)) {

         if (isset($result->engagement)) {
            $fb_share = $result->engagement;
            if (isset($fb_share->share_count)) {
               return $fb_share;
            }
         }
      }

      return false;
   }

endif;

// get facebook api key
function aai_get_fb_secret_key()
{

   $facebook_api  = aai_option('facebook_api');

   if (isset($facebook_api['app_id']) && isset($facebook_api['secret_code'])) {
      if ($facebook_api['app_id'] != '' && $facebook_api['secret_code'] != '') {
         return $facebook_api['app_id'] . '|' . $facebook_api['secret_code'];
      }
   }
   // default key
   return '3190052791219248|8604c5a80339a8db79877944e852227b';
}


function aai_lessThanfewMonth($date, $valid = 30)
{
   $earlier = new DateTime($date);
   $later   = new DateTime();
   return $later->diff($earlier)->format("%a") > 30 ? esc_html__('Old Writter', 'aai') : esc_html__('New Writter', 'aai');
}


function aai_is_footer_widget_active()
{

   $footer_widget = false;

   if (
      is_active_sidebar('footer-one')
      || is_active_sidebar('footer-two')
      || is_active_sidebar('footer-three')
      || is_active_sidebar('footer-four')

   ) {

      $footer_widget = true;
   } else {
      $footer_widget = false;
   }

   return $footer_widget;
}



// ad allowed pages
if (!function_exists('aai_footer_allowed_pages')) {

   function aai_footer_allowed_pages($option = null)
   {
      // show in all over blog
      if (is_null($option)) {
         return true;
      }
      //filter
      $current_option = [];
      if (is_category()) {
         $current_option[] = 'category';
      }

      if (is_tag()) {
         $current_option[] = 'tags';
      }

      if (is_archive()) {
         $current_option[] = 'archive';
      }

      if (is_singular('post')) {
         $current_option[] = 'post';
      }

      if (is_author()) {
         $current_option[] = 'author';
      }

      if (is_search()) {
         $current_option[] = 'search';
      }

      if (is_404()) {
         $current_option[] = '404';
      }


      if (is_singular('page')) {

         $current_option[] = 'page';
      }

      if (is_main_query()) {
         $page_for_posts = get_option('page_for_posts');
         if (get_queried_object_id() == $page_for_posts) {
            $current_option[] = 'blog';
         }
      }

      $found = array_intersect($option, $current_option);

      if (is_array($found) && count($found)) {
         return true;
      }
      return false;
   }
}

// footer cta
if (!function_exists('aai_footer_cta_allowed_pages')) {

   function aai_footer_cta_allowed_pages($option = null)
   {

      // show in all over blog
      if (is_null($option) || !is_array($option)) {
         return true;
      }

      if (in_array('all', $option)) {
         return true;
      }
      //filter
      $current_option = [];


      if (is_singular('post')) {
         $current_option[] = 'post';
      }

      if (is_author() || is_search() || is_tag() || is_category() || is_archive()) {
         $current_option[] = 'blog';
      }

      if (is_singular('page')) {
         $call_to_action_enable = aai_meta_option(get_the_id(), 'newslatter_enable', 1);

         if ($call_to_action_enable) {
            $current_option[] = 'page';
         } else {
            $key = array_search('page', $current_option);
            if ($key !== false) {
               unset($current_option[$key]);
            }
         }
      }

      if (is_singular('quomodo-case')) {
         $current_option[] = 'case';
      }

      if (is_singular('lp_course')) {

         $current_option[] = 'lms';
      }

      if (function_exists('learn_press_is_course_archive') && learn_press_is_course_archive()) {
         $current_option[] = 'lms';
      }

      if (is_main_query()) {
         $page_for_posts = get_option('page_for_posts');
         if (get_queried_object_id() == $page_for_posts) {
            $current_option[] = 'blog';
         }
      }

      $found = array_intersect($option, $current_option);

      if (is_array($found) && count($found)) {
         return true;
      }
      return false;
   }
}
