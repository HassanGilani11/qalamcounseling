<?php


if (!function_exists('aai_return')) :

    function aai_return($str)
    {
        return $str;
    }

endif;

/**
 * 
 *
 * get widgets class list
 *
 * @since 1.0
 * @return array
 */
if (!function_exists('aai_widgets_class_list')) :
    function aai_widgets_class_list($dir)
    {
        $classes = [];
        foreach (glob("$dir/*.php") as $filename) {
            if (!is_null(basename($filename))) {
                $classes[] = strtok(basename($filename), '.');
            }
        }
        return $classes;
    }
endif;

if (!function_exists('aai_eseential_get_post_category')) {
    function aai_eseential_get_post_category($tax = 'category', $return_all = false)
    {

        $list = [];
        if (!count($list)) {

            $categories = get_terms($tax, array(
                'orderby'       => 'name',
                'order'         => 'DESC',
                'hide_empty'    => false,
                'number'        => 200

            ));

            if ($return_all) {

                return $categories;
            }
            print_r($categories);
            foreach ($categories as $category) {
                $list[$category->term_id] = $category->name;
            }
        }

        return $list;
    }
}

if (!function_exists('aai_get_post_tags')) {

    function aai_get_post_tags($tax = 'post_tag')
    {

        $list = [];

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

if (!function_exists('aai_get_post_author')) {

    function aai_get_post_author()
    {
        static $list = [];

        if (!count($list)) {
            $authors = get_users(
                array(
                    'fields' => array('display_name', 'ID')
                )
            );

            foreach ($authors as $author) {
                $list[$author->ID] = $author->display_name;
            }
        }

        return $list;
    }
}

if (!function_exists('aai_get_posts')) {

    function aai_get_posts($post_type = 'post')
    {
        $list = [];

        if (!count($list)) {
            $posts = get_posts(
                [
                    'numberposts' => -1,
                    'post_status' => 'publish',
                    'post_type' => $post_type
                ]
            );

            foreach ($posts as $post) {
                $list[$post->ID] = $post->post_title;
            }
        }

        return $list;
    }
}

function aai_current_theme_supported_post_format()
{

    static $list = [];

    if (!count($list)) {

        $post_formats = get_theme_support('post-formats');

        if (isset($post_formats[0])) {
            $post_formats = $post_formats[0];
        } else {
            return $list;
        }

        foreach ($post_formats as $format) {
            $list['post-format-' . $format] = $format;
        }
    }

    return $list;
}

// get all user created menu list
function aai_get_all_menus()
{

    $list = [];
    $menus = wp_get_nav_menus();

    foreach ($menus as $menu) {
        $list[$menu->slug] = $menu->name;
    }
    $list['empty'] = esc_html__('Empty', 'aai-essential');
    return $list;
}

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




if (!function_exists('aai_term_option')) :

    function aai_term_option($termid, $key, $default_value = '', $taxomony = 'category')
    {

        if (defined('FW')) {
            $value = fw_get_db_term_option($termid, $taxomony, $key);
        }

        return (!isset($value) || $value == '') ? $default_value :  $value;
    }

endif;


function aai_custom_date_format($index = null)
{

    $data = [];
    $data[0]    = esc_html__('Custom Date formt', 'aai-essential');
    $data[]    = 'F j, Y';
    $data[]    = 'M d, Y';
    $data[]    = 'M j, Y';
    $data[]    = 'Y-m-d';
    $data[]    = 'm/d/Y';
    $data[]    = 'd/m/Y';

    if (!is_null($index)) {

        return $data[$index];
    }

    return $data;
}
