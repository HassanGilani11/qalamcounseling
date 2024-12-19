<?php 
namespace Element_Ready_Pro\Base\Sections;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Element_Base;
use \Element_Ready\Controls\Custom_Controls_Manager;


class Post_Widget_Extends {

    use \Element_Ready_Pro\Base\Traits\Helper;

    public function register(){
         // not used anywhere
        add_action( 'elementor/element/element-ready-grid-post', [ $this, 'add_controls_section' ] ,12, 2);
        
    }

   

    public function add_controls_section( $element, $args ){

        $element->start_controls_section(
            'element_ready_widget_sort_item_section',
            [
                
                'label' => esc_html__( 'Sort Content', 'element-ready' ),
            ]
          );

          $element->add_control(
            'er_meta_order',
            [
              'label'   => esc_html__( 'Meta', 'element-ready' ),
              'type'    => Controls_Manager::NUMBER,
              'default' => 1,
              'min'     => 1,
              'step'    => 1,
              'selectors'	 => [
                '{{WRAPPER}} .element-ready-post-meta' => 'order: {{VALUE}};',
             
              ],
            ]
          );

          $element->add_control(
            'er_title_order',
            [
              'label'   => esc_html__( 'Title', 'element-ready' ),
              'type'    => Controls_Manager::NUMBER,
              'default' => 1,
              'min'     => 1,
              'step'    => 1,
              'selectors'	 => [
                '{{WRAPPER}} .title element-ready-title' => 'order: {{VALUE}};',
             
              ],
            ]
          );

          $element->add_control(
            'er_content_order',
            [
              'label'   => esc_html__( 'Content', 'element-ready' ),
              'type'    => Controls_Manager::NUMBER,
              'default' => 1,
              'min'     => 1,
              'step'    => 1,
              'selectors'	 => [
                '{{WRAPPER}} .element-ready-content' => 'order: {{VALUE}};',
             
              ],
            ]
          );

        $element->end_controls_section();
    }

 
   
}