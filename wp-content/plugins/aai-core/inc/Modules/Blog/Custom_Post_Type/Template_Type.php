<?php

namespace Element_Ready_Pro\Modules\Blog\Custom_Post_Type;

use Elementor\Plugin;
use Element_Ready\Api\Callbacks\Custom_Post;
use Element_Ready_Pro\Modules\Blog\Custom_Post_Type\Option_Html;

class Template_Type extends Custom_Post
{
    use Option_Html;
    /*
    * plublic_query true for 
    * elementor support 
    */
    public $name         = 'Blog Template';
    public $menu         = 'Blog Template';
    public $textdomain   = '';
    public $posts        = array();


    public $public_quary = true;
    public $slug         = 'er-blog-tpl';
    public $search       = true;

    public function register()
    {

        $this->posts      = array();

        add_action('init', array($this, 'create_post_type'));
        add_action('admin_menu', [$this, 'add_cpt_page'], 12);

        add_filter('manage_' . $this->slug . '_posts_columns', [$this, 'set_custom_edit_template_columns']);
        add_action('manage_' . $this->slug . '_posts_custom_column', [$this, 'custom_template_column'], 10, 2);
        add_action('admin_enqueue_scripts', [$this, 'push_asset'], 10);
        add_action('admin_footer', [$this, 'push_html'], 10);

        $this->settype();
    }



    public function push_asset($handle)
    {

        $screen = get_current_screen();

        if (isset($screen->id) && in_array($screen->id, ['edit-er-blog-tpl', 'er-blog-tpl'])) {

            wp_register_style('nifty', ELEMENT_READY_ROOT_CSS . 'nifty.css');
            wp_register_script('nifty', ELEMENT_READY_ROOT_JS . 'nifty.js', array('jquery'), ELEMENT_READY_VERSION, true);
            wp_enqueue_style($this->slug, ELEMENT_READY_BLOG_MODULE_URL . 'assets/css/blog-template.css', ['nifty'], time());
            wp_enqueue_script($this->slug, ELEMENT_READY_BLOG_MODULE_URL . 'assets/js/blog-template.js', ['nifty', 'wp-util'], time());
        }
    }

    public function custom_template_column($column, $post_id)
    {

        switch ($column) {

            case 'template_type':
                $_cur_tpl_type = get_post_meta($post_id, 'er_blog_tpl_type', true);

                echo sprintf('<div class="er-template-type-select-fld">
                    <select name="er-template-type-page" data-post_id="%s" >
                     %s
                    </select>
                </div>',  esc_attr($post_id), $this->option_html($_cur_tpl_type));

                break;

            case 'active':

                $active = get_post_meta($post_id, 'er_blog_tpl_active', true) == 'active' ? 'checked' : false;
                echo sprintf('<label class="er-blog-tpl-switch">
                <input data-post_id="%s" type="checkbox" %s>
                <span class="er-blog-tpl-slider er-blog-tpl-round"></span>
                </label>', esc_attr($post_id), $active);
                break;
            case 'content_edit':
                $document = Plugin::$instance->documents->get($post_id);

                echo sprintf('<a class="er-blog-tpl-edit-button" href="%s">%s</a>', esc_url($document->get_edit_url()), esc_html__('Edit with Elementor', 'element-ready-pro'));

                break;
        }
    }

    public function set_custom_edit_template_columns($columns)
    {
        unset($columns['date']);
        $columns['active']        = __('Active', 'element-ready-pro');
        $columns['template_type'] = __('Template Type', 'element-ready-pro');
        $columns['content_edit']  = __('Editor', 'element-ready-pro');
        return $columns;
    }

    public function add_cpt_page()
    {

        add_submenu_page(
            'element_ready_elements_dashboard_page',
            'Blog Templates',
            'Blog Templates',
            'manage_options',
            'edit.php?post_type=' . $this->slug
        );
    }

    public function create_post_type()
    {

        $this->init(
            $this->slug,
            $this->name,
            $this->menu,
            array(
                'menu_icon' => 'dashicons-text-page',
                'supports'            => array('title', 'editor', 'page-attributes', 'post-formats'),
                'rewrite'             => array('slug' => $this->slug),
                'exclude_from_search' => $this->search,
                'has_archive'         => false,                            // Set to false hides Archive Pages
                'publicly_queryable'  => $this->public_quary,
                'hierarchical'        => false,
                'show_in_menu'        => false
            )

        );

        $this->register_custom_post();
        $this->add_elementor_editor_support();
    }
    /* keep public_query true
    * @return void
    */
    public function add_elementor_editor_support()
    {

        add_post_type_support($this->slug, 'elementor');
    }

    public function push_html()
    {
?>

        <div class="nifty-modal er-blog-tpl-nifty-modal-modofier" id="er-blog-tpl-nifty-modal">
            <div class="wready-md-content er-blog-tpl-content">
                <img class="wready-md-close" src="<?php echo esc_url(ELEMENT_READY_ROOT_IMG . 'close.svg'); ?> " />
                <div class='wready-md-body'>

                </div>
            </div>
        </div>
        <div class='wready-md-overlay'></div>

        <div class="er-blog-tpl-js-notice" id="er-blog-tpl-js-notice"></div>

<?php

    }
}
