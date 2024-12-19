<?php 
namespace Element_Ready_Pro\Base\Sections;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Element_Base;
use \Element_Ready_Pro\Base\Traits\Helper;
class Widget_Wrapper {
     use Helper;
    public function register(){
       
        add_action( 'elementor/element/common/_section_style/after_section_end', [ $this, 'add_controls_section' ], 1 );
     
        add_action( 'elementor/frontend/widget/before_render', [ $this, 'before_render' ],19 );
        add_action( 'elementor/frontend/widget/after_render', [ $this, 'after_render' ],19 );

       
    }

   

    public function add_controls_section( Element_Base $element ){
        
        $element->start_controls_section(
            'element_ready_widget_wrapper_link_section',
            [
                
                'label' => esc_html__( 'Wrapper Link', 'element-ready' ),
            ]
          );

              $element->add_control(
                  'element_ready_pro_widget_wrapper_tag_active',
                  [
                      'label'        => esc_html__('Enable', 'element-ready'),
                      'type'         => Controls_Manager::SWITCHER,
                      'default'      => '',
                      'return_value' => 'yes',
                  
                  ]
              );

            $element->add_control(
                'element_ready_pro_widget_wrapper_link',
                [
                    'label'         => esc_html__( 'Link', 'element-ready' ),
                    'type'          => \Elementor\Controls_Manager::URL,
                    'placeholder'   => esc_html__( 'https://your-link.com', 'element-ready' ),
                    'show_external' => true,
                   
                ]
            );

        
        $element->end_controls_section();
    }

    public function before_render($element){
      
        $settings   = $element->get_settings_for_display();
        $active     = $settings['element_ready_pro_widget_wrapper_tag_active'];
 
        if($active){
            $target = $settings['element_ready_pro_widget_wrapper_link']['is_external'] ? ' target="_blank"' : '';
            $nofollow = $settings['element_ready_pro_widget_wrapper_link']['nofollow'] ? ' rel="nofollow"' : '';
            echo '<a class="element-ready-pro-widget-wrapper-link" href="' . $settings['element_ready_pro_widget_wrapper_link']['url'] . '"' . $target . $nofollow . '>';
          
        }
        
    }
    public function after_render($element){

        $settings   = $element->get_settings_for_display();
        $active     = $settings['element_ready_pro_widget_wrapper_tag_active'];

        if($active){
            echo '</a>';  
        }
    }
}