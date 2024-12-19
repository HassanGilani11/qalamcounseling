<?php 
namespace Element_Ready_Pro\Base\Sections;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Element_Ready_Pro\Base\Traits\Helper as Utility;
use Elementor\Group_Control_Border;
use Elementor\Element_Base;

class LiveCopy {
    use Utility;  
    public function register(){

        if( $this->element_ready_get_modules_option('live_copy') ) { 
           
            add_action( 'wp_head', [$this, 'inline_script']);
            add_action( 'elementor/element/before_section_start', [ $this, 'add_controls_section' ],15,3 );
            add_action( 'elementor/frontend/section/after_render', array($this, 'after_section_render'), 12, 2);
        }
       
    }
  
    public function add_controls_section(  $element, $section_id, $args ){
      

        if( 'section' === $element->get_name() && 'section_background' === $section_id ) {
           
        $element->start_controls_section(
            '_section_element_ready_live_copy',
            [
                'label' => __( 'Live Button', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

                $element->add_control(
                    'element_ready_pro_live_btn_enable',
                    [
                        'label'        => esc_html__( 'Live Button', 'element-ready-pro' ),
                        'type'         => \Elementor\Controls_Manager::SWITCHER,
                        'label_on'     => esc_html__( 'Show', 'element-ready-pro' ),
                        'label_off'    => esc_html__( 'Hide', 'element-ready-pro' ),
                        'return_value' => 'yes',
                        'default'      => '',
                    ]
                );

                $element->add_control(
                    'element_ready_pro_live_btn_text',
                    [
                        'label'       => esc_html__( 'Button Text', 'element-ready-pro' ),
                        'type'        => \Elementor\Controls_Manager::TEXT,
                        'default'     => esc_html__( 'Live Copy', 'element-ready-pro' ),
                        'placeholder' => esc_html__( 'Type your button title here', 'element-ready-pro' ),
                    ]
                );
                
                $element->add_control(
                    'element_ready_pro_live_link',
                    [
                        'label'         => esc_html__( 'Link', 'element-ready-pro' ),
                        'type'          => \Elementor\Controls_Manager::URL,
                        'placeholder'   => esc_html__( 'https://your-link.com', 'element-ready-pro' ),
                        'show_external' => true,
                        
                    ]
                );

             

                $element->start_controls_tabs(
                    'element_ready_pro_live_copy_style_tabs'
                );
        
                $element->start_controls_tab(
                    'element_ready_pro_live_link_wrapper_tab',
                    [
                        'label' => esc_html__( 'Btn Wrapper', 'element-ready-pro' ),
                    ]
                );
        
                $element->add_responsive_control(
                    'element_ready_pro_live_link_display',
                    [
                        'label' => esc_html__( 'Display', 'element-ready' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            'flex'         => esc_html__( 'Flex', 'element-ready-pro' ),
                            'inline-flex'  => esc_html__( 'Inline Flex', 'element-ready-pro' ),
                            'block'        => esc_html__( 'Block', 'element-ready-pro' ),
                            'inline-block' => esc_html__( 'Inline Block', 'element-ready-pro' ),
                            'grid'         => esc_html__( 'Grid', 'element-ready-pro' ),
                            'none'         => esc_html__( 'None', 'element-ready-pro' ),
                            ''             => esc_html__( 'Default', 'element-ready-pro' ),
                        ],
                        'selectors' => [
                            '{{ WRAPPER }} .element-ready-live-btn-wrp' => 'display: {{VALUE}};',
                        ],
                    ]
                );
                
                $element->add_responsive_control(
                    'element_ready_pro_live_position_type',
                    [
                        'label' => esc_html__( 'Position', 'element-ready-pro' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            'fixed'    => esc_html__('Fixed','element-ready-pro'),
                            'absolute' => esc_html__('Absolute','element-ready-pro'),
                            'relative' => esc_html__('Relative','element-ready-pro'),
                            'sticky'   => esc_html__('Sticky','element-ready-pro'),
                            'static'   => esc_html__('Static','element-ready-pro'),
                            'inherit'  => esc_html__('inherit','element-ready-pro'),
                            ''         => esc_html__('none','element-ready-pro'),
                        ],
                        'selectors' => [
                            '{{ WRAPPER }} .element-ready-live-btn-wrp' => 'position: {{VALUE}};',
                        
                        ],
                        
                    ]
                );

                $element->add_responsive_control(
                    'element_ready_pro_live_position_left',
                    [
                        'label' => esc_html__( 'Position Left', 'element-ready-pro' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'range' => [
                            'px' => [
                                'min' => -3000,
                                'max' => 3000,
                                'step' => 5,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                    
                        'selectors' => [
                            '{{ WRAPPER }} .element-ready-live-btn-wrp' => 'left: {{SIZE}}{{UNIT}};',
                        
                        ],
                    ]
                );

                $element->add_responsive_control(
                    'element_ready_pro_live_position_top',
                    [
                        'label' => esc_html__( 'Position Top', 'element-ready' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'range' => [
                            'px' => [
                                'min' => -3000,
                                'max' => 3000,
                                'step' => 5,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                    
                        'selectors' => [
                            '{{ WRAPPER }} .element-ready-live-btn-wrp' => 'top: {{SIZE}}{{UNIT}};',
                        
                        ],
                    ]
                );

                $element->add_responsive_control(
                    'element_ready_pro_live_position_bottom',
                    [
                        'label' => esc_html__( 'Position Bottom', 'element-ready-pro' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'range' => [
                            'px' => [
                                'min' => -2100,
                                'max' => 3000,
                                'step' => 5,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                    
                        'selectors' => [
                            '{{ WRAPPER }} .element-ready-live-btn-wrp' => 'bottom: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
        
                $element->end_controls_tab();
        
                $element->start_controls_tab(
                    'element_ready_style_button_tab',
                    [
                        'label' => __( 'Btn', 'element-ready-pro' ),
                    ]
                );
        
                $element->add_control(
                    'element_ready_button_text_color',
                    [
                        'label' => __( 'Color', 'element-ready-pro' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .element-ready-live-btn-wrp .element-ready-btn-link' => 'color: {{VALUE}}',
                        ],
                    ]
                );

        

                $element->add_group_control(
                    \Elementor\Group_Control_Background::get_type(),
                    [
                        'name' => 'element_ready_button_bg_color',
                        'label' => __( 'Background', 'element-ready-pro' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .element-ready-live-btn-wrp .element-ready-btn-link',
                    ]
                );

                $element->add_control(
                    'element_ready_button_border_radious',
                    [
                        'label' => __( 'Border Radious', 'element-ready-pro' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 200,
                                'step' => 5,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'unit' => '%',
                            'size' => 10,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .element-ready-live-btn-wrp .element-ready-btn-link' => 'border-radius: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

                $element->add_control(
                    'element_ready_live_button_margin',
                    [
                        'label' => __( 'Margin', 'element-ready-pro' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} .element-ready-live-btn-wrp .element-ready-btn-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $element->add_control(
                    'element_ready_live_button_padding',
                    [
                        'label' => __( 'Padding', 'element-ready-pro' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} .element-ready-live-btn-wrp .element-ready-btn-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $element->end_controls_tab();

                // hover
                        $element->start_controls_tab(
                            'element_ready_style_button_hover_tab',
                            [
                                'label' => __( 'Btn hover', 'element-ready-pro' ),
                            ]
                        );
                
                                $element->add_control(
                                    'element_ready_hover_button_text_color',
                                    [
                                        'label' => __( 'Color', 'element-ready-pro' ),
                                        'type' => \Elementor\Controls_Manager::COLOR,
                                        'scheme' => [
                                            'type' => \Elementor\Core\Schemes\Color::get_type(),
                                            'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                                        ],
                                        'selectors' => [
                                            '{{WRAPPER}} .element-ready-live-btn-wrp:hover .element-ready-btn-link' => 'color: {{VALUE}}',
                                        ],
                                    ]
                                );

                                $element->add_group_control(
                                    \Elementor\Group_Control_Background::get_type(),
                                    [
                                        'name' => 'element_ready_hover_button_bg_color',
                                        'label' => __( 'Background', 'element-ready-pro' ),
                                        'types' => [ 'classic', 'gradient' ],
                                        'selector' => '{{WRAPPER}} .element-ready-live-btn-wrp:hover .element-ready-btn-link',
                                    ]
                                );

                                $element->add_control(
                                    'element_ready_hover_button_border_radious',
                                    [
                                        'label' => __( 'Border Radious', 'element-ready-pro' ),
                                        'type' => Controls_Manager::SLIDER,
                                        'size_units' => [ 'px', '%' ],
                                        'range' => [
                                            'px' => [
                                                'min' => 0,
                                                'max' => 200,
                                                'step' => 5,
                                            ],
                                            '%' => [
                                                'min' => 0,
                                                'max' => 100,
                                            ],
                                        ],
                                        'default' => [
                                            'unit' => '%',
                                            'size' => 10,
                                        ],
                                        'selectors' => [
                                            '{{WRAPPER}} .element-ready-live-btn-wrp:hover .element-ready-btn-link' => 'border-radius: {{SIZE}}{{UNIT}};',
                                        ],
                                    ]
                                );

                                $element->add_control(
                                    'element_ready_hover_live_button_margin',
                                    [
                                        'label' => __( 'Margin', 'element-ready-pro' ),
                                        'type' => Controls_Manager::DIMENSIONS,
                                        'size_units' => [ 'px', '%', 'em' ],
                                        'selectors' => [
                                            '{{WRAPPER}} .element-ready-live-btn-wrp:hover .element-ready-btn-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                        ],
                                    ]
                                );

                                $element->add_control(
                                    'element_ready_hover_live_button_padding',
                                    [
                                        'label' => __( 'Padding', 'element-ready-pro' ),
                                        'type' => Controls_Manager::DIMENSIONS,
                                        'size_units' => [ 'px', '%', 'em' ],
                                        'selectors' => [
                                            '{{WRAPPER}} .element-ready-live-btn-wrp:hover .element-ready-btn-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                        ],
                                    ]
                                );

                        $element->end_controls_tab();
        
                $element->end_controls_tabs();

        $element->end_controls_section();

       }

    }
    
    public function after_section_render( Element_Base $element)
    {

        $data     = $element->get_data();
        $settings = $data['settings'];
  
        if( isset( $settings['element_ready_pro_live_btn_enable'] ) && $settings['element_ready_pro_live_btn_enable'] == 'yes' && isset($settings['element_ready_pro_live_btn_text']) && $settings['element_ready_pro_live_btn_text'] !='' ){
           
            echo "
            <script>
                window.element_ready_pro_section_live_button_data.section".$data['id']." = JSON.parse('".json_encode($settings)."');
            </script>
            ";

        }
       
    }
    public function inline_script(){
        echo '<style>
          .element-ready-live-btn-wrp{
            z-index:99999;
            position: absolute;  
            right: -20%;
            top: 30px;
            bottom: 185px;
            opacity: 0;
            width: 200px;
            height: 30px;
            transition: 0.2s;

          }
          .element-ready-live-btn-wrp a{
            background: #080501;
            color: #fff5f5;
            padding: 9px 35px;
            border: 0;
            border-radius: 21px;
           
          }
          .elementor-section:hover .element-ready-live-btn-wrp{
            opacity: 1;
            right: 0;
          }
          .element-ready-live-btn-wrp a{
            background: #00B0FA;
            border-radius: 30px !important; 
         } 
        </style>';
		echo '
            <script type="text/javascript">
            
				var element_ready_pro_section_live_button_data = {};
               
            </script>

            <script type="text/html" id="tmpl-element-ready-live-btn">
                <div class="element-ready-live-btn-wrp">
                    <# if ( data.link.is_external ) { #>

                            <# if ( data.link.url == "#" ) { #>
                                <a href="javascript:void(0)" class="element-ready-btn-link"> {{{data.text}}} </a>
                            <# } else { #>
                                <a target="_blank" class="element-ready-btn-link" href="{{{data.link.url}}}"> {{{data.text}}} </a>
                            <# } #>      
                       
                    <# } else { #>

                            <# if ( data.link.url == "#" ) { #>
                                <a href="javascript:void(0)" class="element-ready-btn-link"> {{{data.text}}} </a>
                            <# } else { #>
                                <a class="element-ready-btn-link" href="{{{data.link.url}}}"> {{{data.text}}} </a>
                            <# } #>  

                    <# } #>
                </div>
            </script>
         
		';
	}
}