<?php
namespace Element_Ready_Pro\Widgets\blog;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Box_Shadow;

/**
 * Blog Post Title
 * @author quomodosoft.com
 */
class Element_Ready_Blog_Post_Content extends Widget_Base {

    public function get_name() {
        return 'element-ready-pro-blog-post-content';
    }
    public function get_keywords() {
		return ['blog content','post content'];
	}
    public function get_title() {
        return esc_html__( 'ER Post Content', 'element-ready-pro' );
    }

    public function get_icon() { 
        return 'eicon-post';
    }

    public function get_categories() {
        return [ 'element-ready-pro' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'layout_contents_section',
            [
                'label' => esc_html__( 'Layout Options', 'element-ready-pro' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'style',
            [
                'label'   => esc_html__( 'Layout', 'element-ready-pro' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__( 'Style1', 'element-ready-pro' )
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'wready_content_cart_section',
            [
                'label' => esc_html__( 'Settings', 'element-ready-pro' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'post_id',
			[
				'label' => esc_html__( 'Demo Post id', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => $this->get_latest_post(),
				'placeholder' => esc_html__( 'Type your post id here', 'element-ready-pro' ),
			]
		);
      
        $this->end_controls_section();
   
 
    }

    protected function render() {
 
       $settings = $this->get_settings();
       $post_id  = get_the_id();
    
    ?>

        <div <?php post_class(['er-post-detail-container']); ?>> 

            <?php

                if( \Elementor\Plugin::$instance->editor->is_edit_mode() ){

                    if( is_integer( $settings[ 'post_id' ] ) ){
                        $post_id = $settings['post_id'];
                    }

                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($post_id);
              
                }else{
              
                    echo the_content();
                  
                }

            ?>
           
        </div>

    <?php
    
    }

    public function get_latest_post(){

        $thumbs = array(
            'meta_query' => array( 
                array(
                    'key' => '_thumbnail_id'
                ) 
            )
         );
         $post_id = '';
         $query = new \WP_Query($thumbs);
         if( $query->have_posts() ) { 
            while( $query->have_posts() ) { 
                $query->the_post();
                $post_id = get_the_id();   
                break; 
            } 
        } 
        wp_reset_postdata();
        return $post_id;
    }

}