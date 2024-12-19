<?php 
namespace Element_Ready_Pro\Base\Sections;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Element_Base;
use \Element_Ready\Controls\Custom_Controls_Manager;


class Heading {

    use \Element_Ready_Pro\Base\Traits\Helper;
    public function register(){
    
        add_action( 'elementor/element/heading/section_title_style/after_section_end', [ $this, 'add_controls_section' ] ,12, 2);
        add_action( 'elementor/element/Element_Ready_Area_Title_Widget/title_style_section/after_section_end', [ $this, 'add_controls_section' ] ,12, 2);
        add_action( 'elementor/element/Element_Ready_Box_Widget/title_style_section/after_section_end', [ $this, 'add_controls_section' ] ,12, 2);
        add_action( 'elementor/element/Element_Ready_Infotext_Box_Widget/infob_box_content_section/after_section_end', [ $this, 'add_controls_section' ] ,12, 2);
       
    }

    public function add_controls_section( $element, $args ){
     
        $element->start_controls_section(
            'element_ready_widget_gradient_section',
            [
                
                'label' => esc_html__( 'Title Gradient', 'element-ready-pro' ),
            ]
          );

          $element->add_control(
			'element_ready_widget_gradient_show',
			[
				'label' => esc_html__( 'Enable', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'element-ready-pro' ),
				'label_off' => esc_html__( 'No', 'element-ready-pro' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
             
          $element->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'element_ready_widget_gradient__background',
				'label' => esc_html__( 'Background', 'element-ready-pro' ),
				'types' => [ 'gradient'],
				'selector' => '{{WRAPPER}} .infotext__header__title h3,{{WRAPPER}} .elementor-heading-title,{{WRAPPER}} .area__title p,{{WRAPPER}} .single__box .box__title',
                'condition' => [
                    'element_ready_widget_gradient_show' => ['yes']
                ]
			]
		);

        $element->add_control(
			'element_ready_widget_gradient_color',
			[
				'label' => esc_html__( 'Transparent', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'color: transparent; -webkit-background-clip: text',
				'options' => [
					'color: transparent; -webkit-background-clip: text'  => esc_html__( 'Transparent', 'element-ready-pro' ),
				
				],
                'condition' => [
                    'element_ready_widget_gradient_show' => ['yes']
                ],
                'selectors' => [
					'{{WRAPPER}} .elementor-heading-title' => 'color: transparent; -webkit-background-clip: text',
					'{{WRAPPER}} .area__title p' => 'color: transparent; -webkit-background-clip: text',
					'{{WRAPPER}} .single__box .box__title' => 'color: transparent; -webkit-background-clip: text',
					'{{WRAPPER}} .infotext__header__title h3' => 'color: transparent; -webkit-background-clip: text',
				],
			]
		);

       
        $element->end_controls_section();
    }

 
   
}