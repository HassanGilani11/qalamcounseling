<?php

namespace Aai\Core;

/**
 * Sidebar.
 */
class Sidebar
{
    /**
     * register default hooks and actions for WordPress
     * @return
     */
    public function register()
    {
        add_action('widgets_init', array($this, 'widgets_init'));
    }

    /*
        Define the sidebar
    */
    public function widgets_init()
    {

        register_sidebar(array(
            'name'          => esc_html__('Blog widget area', 'aai'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Appears on posts.', 'aai'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
    }
}
