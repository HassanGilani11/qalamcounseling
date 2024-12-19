<?php

/*************************************
/*******  Theme svg file support  ********
 **************************************/

if (!function_exists('aai_mime_types')) {

    function aai_mime_types($mimes)
    {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }
}

add_filter('upload_mimes', 'aai_mime_types');
/*************************************
/*******  Contact Form 7 Auto p  ********
 **************************************/
add_filter('wpcf7_autop_or_not', '__return_false');

function aai_essential_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'aai_essential_mime_types');

// Use a quality setting of 75 for WebP images.
function aai__webp__quality($quality, $mime_type)
{

    $qty = 75;

    if ('image/webp' === $mime_type) {
        return $qty;
    }
    return $quality;
}

add_filter('wp_editor_set_quality', 'aai__webp__quality', 10, 2);



add_filter('locale', function ($lang) {

    global $wp_locale;

    if (is_admin()) {
        return $lang;
    }

    $key = 'enable_rtl';
    if (class_exists('CSF')) {
        $options = get_post_meta(get_the_ID(), 'aai_page_options', true);
        $data = isset($options[$key]) ? $options[$key] : false;
        $rtl_language = isset($options['rtl_language']) ? $options['rtl_language'] : 'ar';
    }
    if ($data) {

        $wp_locale->text_direction = 'rtl';
        return $rtl_language == '' ? 'ar' : $rtl_language;
    }
    return $lang;
});
