<?php

/**
 * @package  aai-essential
 */

namespace AaiEssential\Base;


/**
 * 
 */
class Preloader
{

    public function register()
    {
        add_action('wp_body_open', [$this, 'push_html']);
    }

    public function push_html()
    {

        if (aai_option('enable_preloader', false)) {
            echo sprintf(
                '<div class="loader-wrap">
                    <div class="preloader"><div class="preloader-close %s">%s</div></div>
                    <div class="layer layer-one"><span class="overlay"></span></div>
                    <div class="layer layer-two"><span class="overlay"></span></div>        
                    <div class="layer layer-three"><span class="overlay"></span></div>        
                 </div>',
                aai_option('enable_close_preloader', true) == false ? 'd-none' : '',
                aai_option('preloader_close_text', 'close')
            );
        }
    }
}
