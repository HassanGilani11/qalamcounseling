<?php

/**
 * @package  quomodo
 */

namespace AaiEssential\Base;

abstract class BaseWPWidget extends \WP_Widget
{
    /**
     * Register loader with init class.
     *
     * @return void
     */
    function register()
    {
        add_action('widgets_init', [$this, 'register_widgets']);
    }

    function register_widgets()
    {
        register_widget(get_called_class());
    }
}
