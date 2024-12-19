<?php
namespace Element_Ready_Pro\Modules\Blog\Settings;
use Element_Ready_Pro\Modules\Blog\Custom_Post_Type\Option_Html;
/**
 *  Error page Template
 *
 * @since 1.0
 */
class Meta {
	use Option_Html;
    /**
     * ajax save 
     * @varsion 1.1
     */
	public function register() {

        add_action('wp_ajax_er_blog_template_options_store', [$this,'store'] );
        add_action( 'add_meta_boxes', [$this, 'register_meta_boxes'] );
        $this->settype();
	}

    public function register_meta_boxes(){

        add_meta_box(
            'er-blog-template-meta-box',
            esc_html__( 'Settings', 'element-ready' ),
            array( $this, 'render_metabox' ),
            'er-blog-tpl',
            'side',
            'default'
        );

    }

    public function render_metabox($post){

        $active = get_post_meta( $post->ID , 'er_blog_tpl_active' , true ) == 'active' ? 'checked' : false ;
        echo '<div class="er-blog-tpl-switch-wrapper"> <p> Active </p>'; 
            
            echo sprintf('<label class="er-blog-tpl-switch">
            <input data-post_id="%s" type="checkbox" %s>
            <span class="er-blog-tpl-slider er-blog-tpl-round"></span>
            </label>', esc_attr($post->ID), $active );
        echo '</div>';

        $_cur_tpl_type = get_post_meta( $post->ID , 'er_blog_tpl_type' , true ); 

        echo '<div class="er-blog-tpl-page-layout-wrapper"> <p> Template Type </p>';        
        echo sprintf('<div class="er-template-type-select-fld">
            <select name="er-template-type-page" data-post_id="%s" >
                %s
            </select>
        </div>',  esc_attr( $post->ID ), $this->option_html( $_cur_tpl_type ) );
        echo '</div>';
    }

    public function store(){
       
        if( !isset($_POST['er_post_id']) || !isset( $_POST['er_blog_tpl_key'] ) ){

            wp_send_json_error( ['msg' => esc_html__('Missing post','element-ready')] );
            return;   
        }
       
        $post_id         = sanitize_text_field( $_POST['er_post_id'] );
        $er_blog_tpl_key = sanitize_text_field( $_POST['er_blog_tpl_key'] );
        $er_blog_tpl_value = sanitize_text_field( $_POST['er_blog_tpl_value'] );
    
        update_post_meta( $post_id ,$er_blog_tpl_key, $er_blog_tpl_value);
        wp_send_json_success( ['msg' => esc_html__( $er_blog_tpl_value.' save','element-ready')] );
    }
}