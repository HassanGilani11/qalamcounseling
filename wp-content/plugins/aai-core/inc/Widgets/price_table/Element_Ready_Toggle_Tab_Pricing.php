<?php
namespace Element_Ready_Pro\Widgets\price_table;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

use Elementor\Group_Control_Border;
require_once( ELEMENT_READY_DIR_PATH . '/inc/style_controls/box/box_style.php' );
if ( ! defined( 'ABSPATH' ) ) exit;


class Element_Ready_Toggle_Tab_Pricing extends Widget_Base {

    use \Elementor\Element_Ready_Box_Style;
    public $base;

    public function get_name() {
        return 'element-ready-toggle-pricing-tab';
    }

    public function get_title() {
        return esc_html__( 'ER Toggle Pricing tab', 'element-ready-pro' );
    }

    public function get_icon() { 
        return 'eicon-price-list';
    }

    public function get_categories() {
        return [ 'element-ready-pro' ];
    }

    public function get_script_depends() {
        
        return [
            'element-ready-core',
        ];
    }
   
    public function get_style_depends() {
 
        wp_register_style( 'eready-toggle-price-tab' , ELEMENT_READY_ROOT_CSS. 'widgets/toggle-price.css' );
        wp_register_style( 'eready-tab' , ELEMENT_READY_ROOT_CSS. 'widgets/tab.css' );
        return ['eready-toggle-price-tab','eready-tab' ];
    }

    /**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'price', 'tab', 'price tab', 'Toggle' ];
	}
 /*
     * Elementor Templates List
     * return array
     */
    public function elementor_template() {
        $templates = \Elementor\Plugin::instance()->templates_manager->get_source( 'local' )->get_items();
        $types     = array();
        if ( empty( $templates ) ) {
            $template_lists = [ '0' => __( 'Do not Saved Templates.', 'element-ready-pro' ) ];
        } else {
            $template_lists = [ '0' => __( 'Select Template', 'element-ready-pro' ) ];
            foreach ( $templates as $template ) {
                $template_lists[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
            }
        }
        return $template_lists;
    }
    protected function register_controls() {

        $this->start_controls_section(
            'section_layout_tab',
            [
                'label' => esc_html__('Layout', 'element-ready-pro'),
            ]
        );
            $this->add_control(
                'style',
                [
                    'label' => esc_html__( 'Layout Style', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'style2',
                    'options' => [
                       
                        'style2' => esc_html__( 'Style 1', 'element-ready-pro' ),
                        //'style3' => esc_html__( 'Style 2', 'element-ready-pro' ),
                      
                    ],
                ]
            );
        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_heading_tab',
            [
                'label' => esc_html__('Tab Menu', 'element-ready-pro'),
                
            ]
        );
      
                $this->add_control(
                    'tab_enable',
                    [
                        'label'        => esc_html__( 'Enable tab', 'element-ready-pro' ),
                        'type'         => \Elementor\Controls_Manager::SWITCHER,
                        'label_on'     => esc_html__( 'Enable', 'element-ready-pro' ),
                        'label_off'    => esc_html__( 'Disable', 'element-ready-pro' ),
                        'return_value' => 'yes',
                        'default'      => 'yes',
                    ]
                );

                $this->add_control(
                    'tab1', [
                        'label'       => esc_html__( 'Tab 1', 'element-ready-pro' ),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true,
                        'placeholder' => esc_html__( 'Tab menu name', 'element-ready-pro' ),
                        'default'     => esc_html__( 'Monthly', 'element-ready-pro' ),
                    
                        
                    ]
                );

                $this->add_control(
                    'tab2', [
                        'label'       => esc_html__( 'Tab 2', 'element-ready-pro' ),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true,
                        'placeholder' => esc_html__( 'Tab Name 2', 'element-ready-pro' ),
                        'default'     => esc_html__( 'Yearly', 'element-ready-pro' ),
                    
                        
                    ]
                );

                $this->add_responsive_control(
                    'tab_switch_margin',
                        [
                            'label'      => esc_html__( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px','%'],
                            'selectors'  => [
                                '{{WRAPPER}} .pricing-area .section-title .nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                
                            ],
                        ]
               );

        $this->end_controls_section();
  
        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Pricing Content', 'element-ready-pro'),
            ]
        );
 

            $this->add_control(
                'template_id',
                [
                    'label'     => esc_html__( 'Tab Content 1', 'element-ready-pro' ),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => '0',
                    'options'   => $this->elementor_template(),
                    'description' => esc_html__( 'Please select elementor templete from here, if not create elementor template from menu', 'element-ready-pro' )
                
                ]
            );

      
            $this->add_control(
                'template_id_2',
                [
                    'label'     => esc_html__( 'Tab Content 2', 'element-ready-pro' ),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => '0',
                    'options'   => $this->elementor_template(),
                
                    'description' => esc_html__( 'Please select elementor templete from here, if not create elementor template from menu', 'element-ready-pro' )
                ]
            );

             
        $this->end_controls_section();
 
        $this->box_css(
            array(
               'title' => esc_html__('Tab Wrapper','element-ready-pro'),
               'slug' => 'item_tab_wrapper_box_style',
               'element_name' => 'item_wrapper_element_ready_',
               'selector' => '{{WRAPPER}} .element-ready-pricing-7-area ul.switch-toggler-list',
               
            )
        );

        $this->start_controls_section('host_tab_menu_one_section',
                [
                'label' => esc_html__( 'Tab menu one', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
              
                ]
        );

                $this->add_control('tab_menu_title_color',
                [
                    'label'     => esc_html__( 'Title color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .tab-menu-one' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .element-ready-pricing-7-area ul.switch-toggler-list li.one a' => 'color: {{VALUE}};',
                    
                    ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Typography:: get_type(),
                    [
                        'name'   => 'tab_menu_title_typography',
                        'label'  => esc_html__( 'Title Typhography', 'element-ready-pro' ),
                    
                        'selector' => '{{WRAPPER}} .tab-menu-one,{{WRAPPER}} .element-ready-pricing-7-area ul.switch-toggler-list li.one a',
                    ]
                );

                $this->add_responsive_control(
                'tab_menu_box_margin',
                    [
                        'label'      => esc_html__( 'Margin', 'element-ready-pro' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px','%'],
                        'selectors'  => [
                            '{{WRAPPER}} .tab-menu-one' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            '{{WRAPPER}} .element-ready-pricing-7-area ul.switch-toggler-list li.one a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            
                        ],
                    ]
                );

                $this->add_responsive_control(
                'tab_menu_box_padding_',
                    [
                        'label'      => esc_html__( 'Paddding', 'element-ready-pro' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px','%'],
                        'selectors'  => [
                            '{{WRAPPER}} .tab-menu-one' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            '{{WRAPPER}} .element-ready-pricing-7-area ul.switch-toggler-list li.one a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            
                        ],
                    ]
                ); 

                $this->add_control('tab_menu_one_switch_bgcolor',
                [
                    'label'     => esc_html__( 'Background Color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .tab-menu-one' => 'background: {{VALUE}};',
                        '{{WRAPPER}} .element-ready-pricing-7-area ul.switch-toggler-list li.one a' => 'background: {{VALUE}};',
                    
                    ],
                    ]
                );

        $this->end_controls_section();

        $this->start_controls_section('ahost_tab_menu_two_section',
                [
                'label' => esc_html__( 'Tab menu two', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
               
                ]
            );

                    $this->add_control('tab_menu_title2_color',
                    [
                        'label'     => esc_html__( 'Title color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tab-menu-two' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .element-ready-pricing-7-area ul.switch-toggler-list li.two a' => 'color: {{VALUE}};',
                        
                        ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'   => 'tab_menu_title2_typography',
                            'label'  => esc_html__( 'Title Typhography', 'element-ready-pro' ),
                           
                            'selector' => '{{WRAPPER}} .tab-menu-two,{{WRAPPER}} .element-ready-pricing-7-area ul.switch-toggler-list li.two a',
                        ]
                    );
                    
                    $this->add_responsive_control(
                        'tab_menu_box2_margin',
                            [
                                'label'      => esc_html__( 'Margin', 'element-ready-pro' ),
                                'type'       => Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px','%'],
                                'selectors'  => [
                                    '{{WRAPPER}} .tab-menu-two' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                    '{{WRAPPER}} .element-ready-pricing-7-area ul.switch-toggler-list li.two a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                    
                                ],
                            ]
                );

                $this->add_responsive_control(
                    'tab_menu_box_2_padding_',
                        [
                            'label'      => esc_html__( 'Paddding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px','%'],
                            'selectors'  => [

                                '{{WRAPPER}} .tab-menu-two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .element-ready-pricing-7-area ul.switch-toggler-list li.two a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                
                            ],
                        ]
                    ); 

                    $this->add_control('tab_menu_2_switch_bgscolor',
                    [
                        'label'     => esc_html__( 'Background Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tab-menu-two' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .element-ready-pricing-7-area ul.switch-toggler-list li.two a' => 'background: {{VALUE}};',
                        
                        ],
                        ]
                    );

        $this->end_controls_section();
        $this->start_controls_section('appscred__tab_menu_switch_section',
                [
                'label' => esc_html__( 'Tab switch / Active', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                
                ]
            );
            $this->add_control('tab_menu_switch_color',
            [
                'label'     => esc_html__( 'Switch Background Color', 'element-ready-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nav-link.active::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .element-ready-pricing-7-area .slider' => 'background: {{VALUE}};',
                
                ],
                ]
            );

            $this->add_control('tab_menu_switch_text_active_color',
            [
                'label'     => esc_html__( 'Text Color', 'element-ready-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #switch-toggle-tab .month.active.one a' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} #switch-toggle-tab .year.two.active a' => 'color: {{VALUE}} !important;',
                    ],
                ]
            );


            $this->add_control('tab_menu_switch_active_color',
                    [
                        'label'     => esc_html__( 'switch Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .nav-link.active' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .element-ready-pricing-7-area .slider:before' => 'background-color: {{VALUE}};',
                           ],
                        ]
                    );

            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'   => 'tab_menu_switch_active_typography',
                    'label'  => esc_html__( 'Typhography', 'element-ready-pro' ),
                    
                    'condition' => [ 'style' => ['style1'] ],
                    'selector' => '{{WRAPPER}} .nav-link.active',
                ]
            );

            $this->add_control(
                'tab_swicth_border_radius',
                    [
                        'label' => esc_html__( 'Border radius', 'element-ready-pro' ),
                        'type'  => \Elementor\Controls_Manager::NUMBER,
                        'min'   => 0,
                        'max'   => 200,
                        'step'  => 1,
                        'condition' => [ 'style' => ['style2'] ],
                        'selectors' => [
                            '{{WRAPPER}} .element-ready-pricing-7-area .slider' => 'border-radius: {{VALUE}}px;',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'tab_swicth_border',
                    'label' => esc_html__( 'Border', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .nav-link.active, {{WRAPPER}} .element-ready-pricing-7-area .slider',
                ]
            );

       
      
        $this->end_controls_section();
    

    } //Register control end

    protected function render( ) { 
     
        $settings       = $this->get_settings();
        $id = $this->get_id();
        ?>  

        <?php if($settings['style'] =='style2'): ?>
            <div class="element-ready-pricing-7-area element-ready-er-main-section">
           
                   <?php if($settings['tab_enable'] == 'yes'): ?>
                        
                        <ul class="list-inline text-center switch-toggler-list" role="tablist" id="switch-toggle-tab">
                            <li class="month active one">
                                <a href="#"><?php echo esc_html($settings['tab1']); ?></a></li>
                            <li>
                                <!-- Rounded switch -->
                                <label class="switch on">
                                    <span class="slider round"></span>
                                </label>
                            </li>
                            <li class="year two">
                                <a href="#"><?php echo esc_html($settings['tab2']); ?></a>
                            </li>
                        </ul><!-- /.list-inline -->
                        
                    <?php endif; ?>
                    <div class="tabed-content">
                        <div id="month">
                            <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $settings['template_id'] ); ?>
                        </div>
                        <div id="year">
                           <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $settings['template_id_2'] ); ?>
                        </div>
                    </div>
              
            </div>
        <?php endif; ?>
    
    <?php  
    }
    protected function content_template() { }
}