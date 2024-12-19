<?php

/**
 * @package  aai-essential
 */

namespace AaiEssential\Base\Custom_Post_Type;

use AaiEssential\Api\Callbacks\Custom_Post;

class Team extends Custom_Post
{

    public $name         = 'teams';
    public $menu         = 'Team';
    public $textdomain   = '';
    public $posts        = array();
    public $public_quary = false;
    public $slug         = 'team';
    public $search       = true;

    public function register()
    {

        $this->textdomain = 'aai-essential';
        $this->posts      = array();

        add_action('init', array($this, 'create_post_type'));
    }

    public function create_post_type()
    {

        $this->init(
            'aai-team',
            $this->name,
            $this->menu,
            array(
                'menu_icon' => 'dashicons-admin-users',
                'supports'            => array('title', 'thumbnail'),
                'rewrite'             => array('slug' => $this->slug),
                'exclude_from_search' => $this->search,
                'has_archive'         => false,                                            // Set to false hides Archive Pages
                'publicly_queryable'  => $this->public_quary,
            )

        );

        $this->register_custom_post();
    }
}
