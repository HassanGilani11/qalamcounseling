<?php
namespace Element_Ready_Pro\Widgets\socials;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Custom_Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;


if ( ! defined( 'ABSPATH' ) ) exit;
require_once( ELEMENT_READY_DIR_PATH . '/inc/style_controls/common/common.php' );
require_once( ELEMENT_READY_DIR_PATH . '/inc/style_controls/position/position.php' );
require_once( ELEMENT_READY_DIR_PATH . '/inc/style_controls/box/box_style.php' );
require_once( ELEMENT_READY_DIR_PATH . '/inc/content_controls/common.php' );

class Social_Share extends Widget_Base {

    use \Elementor\Element_Ready_Common_Style;
    use \Elementor\Element_ready_common_content;
    use \Elementor\Element_Ready_Box_Style;
 
    public $base;

    public function get_name() {
        return 'Element_Ready_Social_Share_Widget';
    }
    
    public function get_title() {
        return __( 'ER Social Share', 'element-ready-pro' );
    }

    public function get_icon() {
        return 'eicon-social-icons';
    }

    public function get_categories() {
        return [ 'element-ready-pro' ];
    }

    public function get_keywords() {
        return [ 'Social', 'Social Profile', 'Social Share' ];
    }

    public function get_script_depends(){
         
        return [
           'goodshare',
           'element-ready-core',
        ];
    }

    public function get_style_depends(){
        wp_register_style( 'eready-social-share', ELEMENT_READY_ROOT_CSS .'social-share.min.css' );
        return [ 'eready-social-share' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_layouts_tab',
            [
                'label' => esc_html__('Layout', 'element-ready-pro'),
            ]
        );

                $this->add_control(
                    'block_style',
                    [
                        'label' => esc_html__( 'Style', 'element-ready-pro' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'default' => 'style2',
                        'options' => [
                            'style1'  => esc_html__( 'Style 1', 'element-ready-pro' ),
                            'style2' => esc_html__( 'Style 2', 'element-ready-pro' ),
                            'style3' => esc_html__( 'Style 3', 'element-ready-pro' ),
                            'style4' => esc_html__( 'Style 4', 'element-ready-pro' ),
                            'style5' => esc_html__( 'Style 5', 'element-ready-pro' ),
                            'style6' => esc_html__( 'Style 6', 'element-ready-pro' ),
                            'style7' => esc_html__( 'Style 7', 'element-ready-pro' ),
                            'style8' => esc_html__( 'Style 8', 'element-ready-pro' ),
                            'style9' => esc_html__( 'Style 9', 'element-ready-pro' ),
                            'style10' => esc_html__( 'Style 10', 'element-ready-pro' ),
                            'style11' => esc_html__( 'Style 11', 'element-ready-pro' ),
                            'style12' => esc_html__( 'Style 12', 'element-ready-pro' ),
                            'style13' => esc_html__( 'Style 13', 'element-ready-pro' ),
                            'style14' => esc_html__( 'Style 14', 'element-ready-pro' ),
                            'style15' => esc_html__( 'Style 15', 'element-ready-pro' ),
                            'style16' => esc_html__( 'Style 16', 'element-ready-pro' ),
                            'style17' => esc_html__( 'Style 17', 'element-ready-pro' ),
                          
                            
                        
                        ],
                    ]
                );

                $this->add_control(
                    'social_view',
                    [
                        'label'       => esc_html__( 'Social Icon Style', 'element-ready-pro' ),
                        'type'        => Controls_Manager::SELECT,
                        'label_block' => false,
                        'options'     => [
                            'icon'       => 'Icon',
                            'title'      => 'Title',
                            'icon-title' => 'Icon & Title',
                        ],
                        'default'      => 'icon',
                         'condition' => [
                             'block_style!' => ['style15','style16']
                         ]
                    ]
                );

       $this->end_controls_section();
        /*----------------------------
            CONTENT SECTION
        -----------------------------*/
        $this->start_controls_section(
            'social_media_sheres',
            [
                'label' => __( 'Social Share', 'element-ready-pro' ),
            ]
        );
           
            $repeater = new \Elementor\Repeater();
            $repeater->start_controls_tabs('social_content_area_tabs');

                $repeater->start_controls_tab(
                    'social_content_tab',
                    [
                        'label' => __( 'Content', 'element-ready-pro' ),
                    ]
                );
                    $repeater->add_control(
                        'element_ready_social_icon',
                        [
                            'label'   => esc_html__( 'Icon', 'element-ready-pro' ),
                            'type'    => \Elementor\Controls_Manager::ICONS,
                            'label_block' => true,
                        ]
                    );

                    $repeater->add_control(
                        'social_type',
                        [
                            'label' => esc_html__( 'Social Site', 'element-ready-pro' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'facebook',
                            'options' => element_ready_social_share_list()
                        ]
                    );

                    $repeater->add_control(
                        'element_ready_social_link',
                        [
                            'label'         => esc_html__( 'Url', 'element-ready-pro' ),
                            'type'          => \Elementor\Controls_Manager::URL,
                            'show_external' => true,
                            'default' => [
                                'url' => '#',
                            ],
                            'condition' => [
                                'social_type' => ''
                            ]
                        ]
                    );
                    
                    $repeater->add_control(
                        'element_ready_social_title',
                        [
                            'label'   => esc_html__( 'Title', 'element-ready-pro' ),
                            'type'    => Controls_Manager::TEXT,
                            'default' => esc_html__( 'Facebook', 'element-ready-pro' ),
                        ]
                    );
                    $repeater->add_control(
                        'meta_info',
                        [
                            'label'        => esc_html__( 'Show Meta', 'element-ready-pro' ),
                            'type'         => \Elementor\Controls_Manager::SWITCHER,
                            'label_on'     => esc_html__( 'Show', 'element-ready-pro' ),
                            'label_off'    => esc_html__( 'Hide', 'element-ready-pro' ),
                            'return_value' => 'yes',
                            'default'      => '',
                        ]
                    );
                    $repeater->add_control(
                        'element_ready_social_info',
                        [
                            'label'   => esc_html__( 'Meta Information', 'element-ready-pro' ),
                            'type'    => Controls_Manager::TEXT,
                             'condition'=> [
                              'meta_info' => ['yes']
                             ],
                            'default' => esc_html__( 'information', 'element-ready-pro' ),
                        ]
                    );
                $repeater->end_controls_tab();
                $repeater->start_controls_tab(
                    'social_rep_style',
                    [
                        'label' => __( 'Style', 'element-ready-pro' ),
                    ]
                );
                    $repeater->add_control(
                        'normal_style_heading',
                        [
                            'label'     => __( 'Normal Style', 'element-ready-pro' ),
                            'type'      => Controls_Manager::HEADING,
                            'separator' => 'before',
                        ]
                    );
                    $repeater->add_control(
                        'social_text_color',
                        [
                            'label'     => __( 'Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__socials__buttons {{CURRENT_ITEM}} a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .element__ready__socials__buttons {{CURRENT_ITEM}} .title' => 'color: {{VALUE}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $repeater->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'     => 'social_rep_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .element__ready__socials__buttons {{CURRENT_ITEM}} a',
                        ]
                    );
                    $repeater->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'social_rep_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .element__ready__socials__buttons {{CURRENT_ITEM}} a,{{WRAPPER}} .element__ready__socials__buttons {{CURRENT_ITEM}} a.social-wrapper',
                        ]
                    );
                    $repeater->add_control(
                        'social_oitem_back_shape_color',
                        [
                            'label' => __( 'Shape Color', 'element-ready-pro' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Core\Schemes\Color::get_type(),
                                'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__socials__buttons {{CURRENT_ITEM}} a:before' => 'background: {{VALUE}}',
                            ],
              
                            
                        ]
                    );
                    $repeater->add_control(
                        'hover_style_heading',
                        [
                            'label' => __( 'Hover Style', 'element-ready-pro' ),
                            'type'  => Controls_Manager::HEADING,
                            'separator' => 'before',
                        ]
                    );
                    $repeater->add_control(
                        'social_text_hover_color',
                        [
                            'label'     => __( 'Hover color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__socials__buttons {{CURRENT_ITEM}} a:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .element__ready__socials__buttons {{CURRENT_ITEM}} a:hover .title' => 'color: {{VALUE}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $repeater->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'     => 'social_rep_hover_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .element__ready__socials__buttons {{CURRENT_ITEM}} a:hover',
                        ]
                    );
                    $repeater->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'social_rep_hover_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .element__ready__socials__buttons {{CURRENT_ITEM}} a:hover',
                        ]
                    );
                    $repeater->add_control(
                        'social_hoveritem_back_shape_color',
                        [
                            'label' => __( 'Shape Color', 'element-ready-pro' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Core\Schemes\Color::get_type(),
                                'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__socials__buttons:hover {{CURRENT_ITEM}} a:before' => 'background: {{VALUE}}',
                            ],
              
                            
                        ]
                    );
                $repeater->end_controls_tab();
                $repeater->start_controls_tab(
                    'social_rep_icon_style',
                    [
                        'label' => __( 'Icon Style', 'element-ready-pro' ),
                    ]
                );
                    $repeater->add_control(
                        'normal_style_icon_heading',
                        [
                            'label'     => __( 'Normal Style', 'element-ready-pro' ),
                            'type'      => Controls_Manager::HEADING,
                            'separator' => 'before',
                        ]
                    );
                    $repeater->add_control(
                        'social_icon_color',
                        [
                            'label'     => __( 'Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__socials__buttons {{CURRENT_ITEM}} a i' => 'color: {{VALUE}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $repeater->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'     => 'social_rep_icon_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .element__ready__socials__buttons {{CURRENT_ITEM}} a i',
                        ]
                    );
                    $repeater->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'social_rep_icon_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .element__ready__socials__buttons {{CURRENT_ITEM}} a i',
                        ]
                    );
                    $repeater->add_control(
                        'border_shape_color',
                        [
                            'label' => __( 'Border Shape Color', 'element-ready-pro' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Core\Schemes\Color::get_type(),
                                'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}} .element-ready-social-icon i::after' => 'border-left-color: {{VALUE}}',
                                '{{WRAPPER}} .er-style9 {{CURRENT_ITEM}} .element-ready-social-icon i::after' => 'background: {{VALUE}}',
                            ],
                            
                        ]
                    );
                    $repeater->add_responsive_control(
                        'social_rep_icon_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__socials__buttons {{CURRENT_ITEM}} a i' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                    $repeater->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'social_shadowicon_bbox_shadow',
                            'label' => __( 'Box Shadow', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} i ,{{WRAPPER}} .element__ready__socials__buttons {{CURRENT_ITEM}} i,{{WRAPPER}} {{CURRENT_ITEM}} .element-ready-social-icon i',
                        ]
                    );
                    $repeater->add_control(
                        'hover_style_icon_heading',
                        [
                            'label' => __( 'Hover Style', 'element-ready-pro' ),
                            'type'  => Controls_Manager::HEADING,
                            'separator' =>'before',
                        ]
                    );
                    $repeater->add_control(
                        'social_icon_hover_color',
                        [
                            'label'     => __( 'Hover color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__socials__buttons {{CURRENT_ITEM}} a:hover i' => 'color: {{VALUE}};',
                            ],
                            'separator' =>'before',
                        ]
                    );
                    $repeater->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'     => 'social_rep_icon_hover_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .element__ready__socials__buttons {{CURRENT_ITEM}} a:hover i',
                        ]
                    );
                    $repeater->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'social_rep_icon_hover_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .element__ready__socials__buttons {{CURRENT_ITEM}} a:hover i',
                        ]
                    );
                    $repeater->add_control(
                        'border_hovershape_color',
                        [
                            'label' => __( 'Border Shape Color', 'element-ready-pro' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Core\Schemes\Color::get_type(),
                                'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}}:hover .element-ready-social-icon i::after' => 'border-left-color: {{VALUE}}',
                                '{{WRAPPER}} .er-style9 {{CURRENT_ITEM}}:hover .element-ready-social-icon i::after' => 'background: {{VALUE}}',
                            ],
                            
                        ]
                    );
                    $repeater->add_group_control(
                        \Elementor\Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'social_hovericon_bbox_shadow',
                            'label' => __( 'Box Shadow', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}:hover i ,{{WRAPPER}} .element__ready__socials__buttons {{CURRENT_ITEM}}:hover i,{{WRAPPER}} {{CURRENT_ITEM}}:hover .element-ready-social-icon i',
                        ]
                    );
                $repeater->end_controls_tab();
            $repeater->end_controls_tabs();
            $this->add_control(
                'element_ready_socialmedia_list',
                [
                    'type'    => \Elementor\Controls_Manager::REPEATER,
                    'fields'  =>  $repeater->get_controls() ,
                    'default' => [
                        [
                            'element_ready_social_icon'  => [
                                'value' => 'fa fa-twitter',
                            ],
                            'element_ready_social_title' => __( 'Twitter', 'element-ready-pro' ),
                        ],
                    ],
                    'title_field' => '{{{ element_ready_social_title }}}',
                ]
            );
            $this->add_responsive_control(
                'social_wrap_align',
                [
                    'label'   => __( 'Alignment', 'element-ready-pro' ),
                    'type'    => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'element-ready-pro' ),
                            'icon'  => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'element-ready-pro' ),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'element-ready-pro' ),
                            'icon'  => 'fa fa-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justify', 'element-ready-pro' ),
                            'icon'  => 'fa fa-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .element__ready__socials__buttons ul' => 'text-align: {{VALUE}};',
                      
                    ],
                    'condition' =>[
                        'block_style' => array( 'style1' ),
                    ]
                ]
            );

            $this->add_responsive_control(
                'social_wrap_align_flex',
                [
                    'label'   => __( 'Alignment', 'element-ready-pro' ),
                    'type'    => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start' => [
                            'title' => __( 'Left', 'element-ready-pro' ),
                            'icon'  => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'element-ready-pro' ),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'flex-end' => [
                            'title' => __( 'Right', 'element-ready-pro' ),
                            'icon'  => 'fa fa-align-right',
                        ],
                        'space-between' => [
                            'title' => __( 'Space-between', 'element-ready-pro' ),
                            'icon'  => 'fa fa-align-justify',
                        ],
                        'space-around' => [
                            'title' => __( 'Space-around', 'element-ready-pro' ),
                            'icon'  => 'fa fa-columns',
                        ],
                    ],
                    'selectors' => [
                       
                        '{{WRAPPER}} .element-ready-social-flex' => 'justify-content: {{VALUE}};',
                    ],
                    'condition' =>[
                        'block_style!' => array( 'style1' ),
                    ]
                ]
            );
        $this->end_controls_section();
        /*----------------------------
            CONTENT SECTION END
        -----------------------------*/

        /*----------------------------
            ICON STYLE
        -----------------------------*/
        $this->start_controls_section(
            'socialshere_icon_style_section',
            [
                'label'     => __( 'Icon', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' =>[
                    'social_view' => array( 'icon-title','icon'),
                ]
            ]
        );
            $this->add_responsive_control(
                'icon_fontsize',
                [
                    'label'      => __( 'Icon Font Size', 'element-ready-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 100,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 20,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .element__ready__socials__buttons ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .element__ready__socials__buttons .element-ready-social-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .element-ready-social i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'border_shape_color',
                [
                    'label' => __( 'Border Shape Color', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .element-ready-social-style-4 .element-ready-social-icon i::after' => 'border-left-color: {{VALUE}}',
                    ],
                    'condition' => [
                        'block_style' => ['style4']
                    ]
                ]
            );

            //

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name'     => 'social_icon_background',
                    'label'    => __( 'Background', 'element-ready-pro' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .element__ready__socials__buttons li i,{{WRAPPER}} .element__ready__socials__buttons .element-ready-social-icon i, {{WRAPPER}} .element-ready-social i',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'social_icon_border',
                    'label'    => __( 'Border', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .element-ready-social i ,{{WRAPPER}} .element__ready__socials__buttons li i,{{WRAPPER}} .element__ready__socials__buttons .element-ready-social-icon i',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'social_icon_bbox_shadow',
                    'label' => __( 'Box Shadow', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .element-ready-social i ,{{WRAPPER}} .element__ready__socials__buttons li i,{{WRAPPER}} .element-ready-social-icon i',
                ]
            );

            $this->add_responsive_control(
                'social_icon_radius',
                [
                    'label'     => esc_html__( 'Border Radius', 'element-ready-pro' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .element__ready__socials__buttons li i' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .element__ready__socials__buttons .element-ready-social-icon i' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .element-ready-social i' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_height',
                [
                    'label'      => __( 'Icon Height', 'element-ready-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 100,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .element__ready__socials__buttons ul li i' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .element__ready__socials__buttons .element-ready-social-icon i' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .element-ready-social i' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_width',
                [
                    'label'      => __( 'Icon Width', 'element-ready-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 100,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .element__ready__socials__buttons ul li i' => 'width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .element__ready__socials__buttons .element-ready-social-icon i' => 'width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .element-ready-social i' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            // Margin
            $this->add_responsive_control(
                'social_icon_margin',
                [
                    'label'      => __( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .element__ready__socials__buttons ul li a i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .element__ready__socials__buttons .element-ready-social-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .element-ready-social i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Padding
            $this->add_responsive_control(
                'social_icon_padding',
                [
                    'label'      => __( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .element__ready__socials__buttons ul li a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .element__ready__socials__buttons .element-ready-social-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .element-ready-social i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'social_icon_rotate',
                [
                    'label' => __( 'Rotate', 'element-ready-pro' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => -360,
                            'max' => 360,
                            'step' => 5,
                        ],
                       
                    ],
                    
                    'selectors' => [
                        '{{WRAPPER}} .element__ready__socials__buttons ul li a i' => 'transform: rotateY({{SIZE}}deg);',
                        '{{WRAPPER}} .element__ready__socials__buttons .element-ready-social-icon i' => 'transform: rotateY({{SIZE}}deg);',
                        '{{WRAPPER}} .element-ready-social i' => 'transform: rotateY({{SIZE}}deg);',
                    ],
                ]
            );

            $this->add_responsive_control(
                'social_icon_hv_rotate',
                [
                    'label' => __( 'Hover Rotate', 'element-ready-pro' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => -360,
                            'max' => 360,
                            'step' => 5,
                        ],
                       
                    ],
                    
                    'selectors' => [
                        '{{WRAPPER}} .element__ready__socials__buttons:hover ul li a i' => 'transform: rotateY({{SIZE}}deg);',
                        '{{WRAPPER}} .element__ready__socials__buttons:hover .element-ready-social-icon i' => 'transform: rotateY({{SIZE}}deg);',
                        '{{WRAPPER}} .element-ready-social i' => 'transform: rotateY({{SIZE}}deg);',
                    ],
                ]
            );


            $this->add_control(
                'icon-popover-toggle',
                [
                    'label' => __( 'Position', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                    'label_off' => __( 'Default', 'element-ready-pro' ),
                    'label_on' => __( 'Custom', 'element-ready-pro' ),
                    'return_value' => 'yes',
                    'condition' => [
                        'block_style!' => ['style1']
                    ]
                ]
            );
    
            $this->start_popover();

            $this->add_responsive_control(
                'social_icon_left_auto',
                [
                    'label' => esc_html__( 'Postion Left', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        'auto'  => esc_html__( 'Auto', 'element-ready-pro' ),
                        '' => esc_html__( 'Custom', 'element-ready-pro' ),
                    ],
                    'selectors'  => [

                        '{{WRAPPER}} .element__ready__socials__buttons .element-ready-social-icon' => 'left:{{VALUE}} ;',
                    ],
                ]
            );
    

            $this->add_responsive_control(
                'social_icon_padding_position_left',
                [
                    'label' => esc_html__( 'Position Left', 'element-ready-pro' ),
                    'type' => Controls_Manager::SLIDER,
                    'show_label'=> false,
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
                        '{{WRAPPER}} .element__ready__socials__buttons .element-ready-social-icon' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'social_icon_rightt_auto',
                [
                    'label' => esc_html__( 'Postion right', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        'auto'  => esc_html__( 'Auto', 'element-ready-pro' ),
                        '' => esc_html__( 'Custom', 'element-ready-pro' ),
                    ],
                    'selectors'  => [

                        '{{WRAPPER}} .element__ready__socials__buttons .element-ready-social-icon' => 'right:{{VALUE}} ;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'social_icon_padding_position_right',
                [
                    'label' => esc_html__( 'Position Right', 'element-ready-pro' ),
                    'type' => Controls_Manager::SLIDER,
                    'show_label'=> false,
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
                        '{{WRAPPER}} .element__ready__socials__buttons .element-ready-social-icon' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'social_icon_padding_position_top',
                [
                    'label' => esc_html__( 'Position top', 'element-ready-pro' ),
                    'type' => Controls_Manager::SLIDER,
                    'show_label'=> true,
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
                        '{{WRAPPER}} .element__ready__socials__buttons .element-ready-social-icon' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->end_popover();
        $this->end_controls_section();
        /*----------------------------
            ICON STYLE END
        -----------------------------*/
        /*----------------------------
            MEta information
        -----------------------------*/
        $this->text_wrapper_css(
            array(
                'title' => esc_html__('Social Meta','element-ready-pro'),
                'slug' => '_meta_box_style',
                'element_name' => 'meta_element_ready_',
                'selector' => '{{WRAPPER}} .element-ready-social-content .information,{{WRAPPER}} .element-ready-social .information',
                'hover_selector' => '{{WRAPPER}} .element-ready-social-content:hover .information ,{{WRAPPER}} .element-ready-social:hover .information',
            )
        ); 
        /*----------------------------
            ITEM STYLE
        -----------------------------*/
        $this->start_controls_section(
            'social_button_item_style_section',
            [
                'label' => __( 'Social Item', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs( 'social_button_tabs_style' );
                $this->start_controls_tab(
                    'social_button_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );

                    // Typgraphy
                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name'      => 'social_button_typography',
                            'selector'  => '{{WRAPPER}} .element__ready__socials__buttons ul li a, {{WRAPPER}} .element__ready__socials__buttons .title',
                        ]
                    );

                    // Icon Color
                    $this->add_control(
                        'social_button_color',
                        [
                            'label'     => __( 'Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__socials__buttons ul li a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .element__ready__socials__buttons .title' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    // Background
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'social_button_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .element__ready__socials__buttons ul li a:before, {{WRAPPER}} .element__ready__socials__buttons a',
                        ]
                    );

                    $this->add_control(
                        'social_item_back_shape_color',
                        [
                            'label' => __( 'Shape Color', 'element-ready-pro' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Core\Schemes\Color::get_type(),
                                'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__socials__buttons a:before' => 'background: {{VALUE}}',
                            ],
                            'condition' => [
                                'block_style' => ['style4']
                            ]
                            
                        ]
                    );

                    // Border
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'social_button_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .element__ready__socials__buttons ul li a,{{WRAPPER}} .element__ready__socials__buttons a',
                        ]
                    );

                    // Radius
                    $this->add_responsive_control(
                        'social_button_radius',
                        [
                            'label'      => __( 'Border Radius', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .element__ready__socials__buttons ul li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .element__ready__socials__buttons a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'social_outline_button_border',
                            'label'    => __( 'outline Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .element-ready-social-style-14::before',
                            'condition' => [
                                'block_style' => ['style14']
                            ]
                        ]
                    );
                    
                    // Shadow
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name'     => 'social_button_shadow',
                            'selector' => '{{WRAPPER}} .element__ready__socials__buttons ul li a,{{WRAPPER}} .element__ready__socials__buttons a',
                        ]
                    );
                    $this->add_responsive_control(
                        'social_button_display',
                        [
                            'label'   => __( 'Display', 'element-ready-pro' ),
                            'type'    => Controls_Manager::SELECT,          
                            'options' => [
                                'initial'      => __( 'Initial', 'element-ready-pro' ),
                                'block'        => __( 'Block', 'element-ready-pro' ),
                                'inline-block' => __( 'Inline Block', 'element-ready-pro' ),
                                'flex'         => __( 'Flex', 'element-ready-pro' ),
                                'inline-flex'  => __( 'Inline Flex', 'element-ready-pro' ),
                                'none'         => __( 'none', 'element-ready-pro' ),
                                ''         => __( 'Inherit', 'element-ready-pro' ),
                            ],
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__socials__buttons ul li' => 'display: {{VALUE}};',
                                '{{WRAPPER}} .element__ready__socials__buttons .element-ready-social' => 'display: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'social_button_link_display',
                        [
                            'label'   => __( 'Link Display', 'element-ready-pro' ),
                            'type'    => Controls_Manager::SELECT,          
                            'options' => [
                                'initial'      => __( 'Initial', 'element-ready-pro' ),
                                'block'        => __( 'Block', 'element-ready-pro' ),
                                'inline-block' => __( 'Inline Block', 'element-ready-pro' ),
                                'flex'         => __( 'Flex', 'element-ready-pro' ),
                                'inline-flex'  => __( 'Inline Flex', 'element-ready-pro' ),
                                'none'         => __( 'none', 'element-ready-pro' ),
                                ''         => __( 'inherit', 'element-ready-pro' ),
                            ],
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__socials__buttons ul li a' => 'display: {{VALUE}};',
                                '{{WRAPPER}} .element__ready__socials__buttons .element-ready-social a' => 'display: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'social_button_width',
                        [
                            'label'      => __( 'Width', 'element-ready-pro' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__socials__buttons ul li a' => 'width: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .element__ready__socials__buttons .element-ready-social a' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    // Height
                    $this->add_responsive_control(
                        'social_button_height',
                        [
                            'label'      => __( 'Height', 'element-ready-pro' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__socials__buttons ul li a' => 'height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .element__ready__socials__buttons .element-ready-social a' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    // Margin
                    $this->add_responsive_control(
                        'social_button_margin',
                        [
                            'label'      => __( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .element__ready__socials__buttons ul li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .element__ready__socials__buttons .element-ready-social a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    // Padding
                    $this->add_responsive_control(
                        'social_button_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .element__ready__socials__buttons ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .element__ready__socials__buttons .element-ready-social a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    // Transition
                    $this->add_control(
                        'social_button_transition',
                        [
                            'label'      => __( 'Transition', 'element-ready-pro' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0.1,
                                    'max'  => 3,
                                    'step' => 0.1,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 0.3,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__socials__buttons .element-ready-social a,{{WRAPPER}} .element__ready__socials__buttons ul li a,{{WRAPPER}} .element__ready__socials__buttons ul li a:before,{{WRAPPER}} .element__ready__socials__buttons ul li a:after' => 'transition: {{SIZE}}s;',
                            ],
                        ]
                    );


                    $this->add_responsive_control(
                        'social_button_align',
                        [
                            'label'   => __( 'Alignment', 'element-ready-pro' ),
                            'type'    => Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => __( 'Left', 'element-ready-pro' ),
                                    'icon'  => 'fa fa-align-left',
                                ],
                                'center' => [
                                    'title' => __( 'Center', 'element-ready-pro' ),
                                    'icon'  => 'fa fa-align-center',
                                ],
                                'right' => [
                                    'title' => __( 'Right', 'element-ready-pro' ),
                                    'icon'  => 'fa fa-align-right',
                                ],
                                'justify' => [
                                    'title' => __( 'Justify', 'element-ready-pro' ),
                                    'icon'  => 'fa fa-align-justify',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__socials__buttons ul li a' => 'text-align: {{VALUE}};',
                                '{{WRAPPER}} .element__ready__socials__buttons .element-ready-social a' => 'text-align: {{VALUE}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();

                $this->start_controls_tab(
                    'social_button_hover_tab',
                    [
                        'label' => __( 'Hover', 'element-ready-pro' ),
                    ]
                );

                    //Hover Color
                    $this->add_control(
                        'hover_social_button_color',
                        [
                            'label'     => __( 'Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .element__ready__socials__buttons ul li a:hover, {{WRAPPER}} .element__ready__socials__buttons ul li a:focus' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .element__ready__socials__buttons .element-ready-social a:hover .title, {{WRAPPER}} .element__ready__socials__buttons .element-ready-social a:focus .title' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    // Hover Background
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'hover_social_button_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .element__ready__socials__buttons ul li a:after,{{WRAPPER}} .element__ready__socials__buttons .element-ready-social a:hover',

                        ]
                    );

                    // Border
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'hover_social_button_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .element__ready__socials__buttons .element-ready-social a:hover,{{WRAPPER}} .element__ready__socials__buttons ul li a:hover,{{WRAPPER}}.element__ready__socials__buttons ul li a:focus',
                        ]
                    );

                    // Radius
                    $this->add_responsive_control(
                        'hover_social_button_radius',
                        [
                            'label'      => __( 'Border Radius', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .element__ready__socials__buttons ul li a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .element__ready__socials__buttons .element-ready-social a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    // Shadow
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'hover_social_button_shadow',
                            'selector' => '{{WRAPPER}} .element__ready__socials__buttons .element-ready-social a:hover,{{WRAPPER}} .element__ready__socials__buttons ul li a:hover',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*----------------------------
            ITEM STYLE END
        -----------------------------*/
        $this->box_css(
            array(
                'title' => esc_html__('Wrapper','element-ready-pro'),
                'slug' => 'wrapper_body_box_style',
                'element_name' => 'wrapper_body_element_ready_',
                'selector' => '{{WRAPPER}} .element-ready-social-flex',
            )
        );

    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'element_ready_socials_buttons_attr', 'class', 'element-ready-social-flex element__ready__socials__buttons' );
       

        if( 'icon-title' == $settings['social_view'] || 'title' == $settings['social_view'] ){
            $this->add_render_attribute( 'element_ready_socials_buttons_attr', 'class', 'element__ready__socials__view__'.$settings['social_view'] );
        }

        if($settings['block_style'] == 'style1'):
            $this->add_render_attribute( 'element_ready_socials_buttons_attr', 'class', 'socials__buttons__style__1' );
        ?>
                <div <?php echo $this->get_render_attribute_string( 'element_ready_socials_buttons_attr' ); ?> >
                    <ul>
                        <?php foreach ( $settings['element_ready_socialmedia_list'] as $socialmedia ) :?>
                            <?php 
                                $attribute = array();
                                $attribute[] = 'href="javascript:void(0)"';
                                if($socialmedia['social_type'] == ''):

                                      
                                        if ( ! empty( $socialmedia['element_ready_social_link']['url'] ) ) {
                                            $attribute[] = 'href="'.$socialmedia['element_ready_social_link']['url'].'"';
                                            if ( $socialmedia['element_ready_social_link']['is_external'] ) {
                                                $attribute[] = 'target="_blank"';
                                            }
                                            if ( $socialmedia['element_ready_social_link']['nofollow'] ) {
                                                $attribute[] = 'rel="nofollow"';
                                            }
                                        }

                                endif;  

                                if($socialmedia['social_type'] != ''):
                                
                                    $attribute[] = "data-social='{$socialmedia['social_type']}'";
                                
                                endif;  
                            ?>
                            <li class="elementor-repeater-item-<?php echo $socialmedia['_id']; ?>">
                                <a <?php echo implode(' ', $attribute ); $attribute = array();?>>
                                    <?php
                                        if( 'icon' == $settings['social_view'] ){
                                            \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] );
                                        }elseif( 'title' == $settings['social_view'] ){
                                            echo sprintf('<span>%1$s</span>', $socialmedia['element_ready_social_title'] );
                                        }else{
                                            ?>
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                                <span><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></span>
                                            <?php
                                        }
                                    ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
        <?php endif; ?>   

        <?php if($settings['block_style'] == 'style2'):
             $this->add_render_attribute( 'element_ready_socials_buttons_attr', 'class', $settings['block_style'] );
            ?> 
            <div <?php echo $this->get_render_attribute_string( 'element_ready_socials_buttons_attr' ); ?> >
              
                    <?php foreach ( $settings['element_ready_socialmedia_list'] as $socialmedia ) :?>
                                <?php 
                                    $attribute = array();
                                    $attribute[] = 'href="javascript:void(0)"';
                                    $attribute[] = 'class="social-wrapper"';
                                    if($socialmedia['social_type'] == ''):

                                           
                                            if ( ! empty( $socialmedia['element_ready_social_link']['url'] ) ) {
                                                $attribute[] = 'href="'.$socialmedia['element_ready_social_link']['url'].'"';
                                                if ( $socialmedia['element_ready_social_link']['is_external'] ) {
                                                    $attribute[] = 'target="_blank"';
                                                }
                                                if ( $socialmedia['element_ready_social_link']['nofollow'] ) {
                                                    $attribute[] = 'rel="nofollow"';
                                                }
                                            }

                                    endif;  

                                    if($socialmedia['social_type'] != ''):

                                        $attribute[] = "data-social='{$socialmedia['social_type']}'";

                                    endif;  

                                ?>

                                <div class="element-ready-social-style-1 element-ready-social elementor-repeater-item-<?php echo $socialmedia['_id']; ?>">
                                    <a <?php echo implode(' ', $attribute ); $attribute = array();?> >
                                        <?php  if( 'icon' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                        <?php }elseif('title' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-content">
                                                <span class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></span>
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php }else{ ?>

                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                            <div class="element-ready-social-content">
                                                <span class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></span>
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                            </div>

                                        <?php } ?>
                                    </a>
                                </div>
                              
                            
                        <?php endforeach; ?>    
                   
                </div>
        <?php endif; ?>   

        <?php if($settings['block_style'] == 'style3'):
             $this->add_render_attribute( 'element_ready_socials_buttons_attr', 'class', 'er-'.$settings['block_style'] );
            ?> 
            <div <?php echo $this->get_render_attribute_string( 'element_ready_socials_buttons_attr' ); ?> >
              
                    <?php foreach ( $settings['element_ready_socialmedia_list'] as $socialmedia ) :?>
                                <?php 
                                    $attribute = array();
                                    $attribute[] = 'href="javascript:void(0)"';
                                    $attribute[] = 'class="social-wrapper"';
                                    if($socialmedia['social_type'] == ''):

                                           
                                            if ( ! empty( $socialmedia['element_ready_social_link']['url'] ) ) {
                                                $attribute[] = 'href="'.$socialmedia['element_ready_social_link']['url'].'"';
                                                if ( $socialmedia['element_ready_social_link']['is_external'] ) {
                                                    $attribute[] = 'target="_blank"';
                                                }
                                                if ( $socialmedia['element_ready_social_link']['nofollow'] ) {
                                                    $attribute[] = 'rel="nofollow"';
                                                }
                                            }

                                    endif;  

                                    if($socialmedia['social_type'] != ''):

                                        $attribute[] = "data-social='{$socialmedia['social_type']}'";

                                    endif;  

                                ?>

                                <div class="element-ready-social-style-2 element-ready-social elementor-repeater-item-<?php echo $socialmedia['_id']; ?>">
                                    <a <?php echo implode(' ', $attribute ); $attribute = array();?> >
                                        <?php  if( 'icon' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                        <?php }elseif('title' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-content">
                                                <span class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></span>
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php }else{ ?>

                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                            <div class="element-ready-social-content">
                                                <span class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></span>
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                            </div>

                                        <?php } ?>
                                    </a>
                                </div>
                              
                            
                        <?php endforeach; ?>    
                   
                </div>
        <?php endif; ?>  

        <?php if($settings['block_style'] == 'style4'):
             $this->add_render_attribute( 'element_ready_socials_buttons_attr', 'class', 'er-'.$settings['block_style'] );
            ?> 
            <div <?php echo $this->get_render_attribute_string( 'element_ready_socials_buttons_attr' ); ?> >
              
                    <?php foreach ( $settings['element_ready_socialmedia_list'] as $socialmedia ) :?>
                                <?php 
                                    $attribute = array();
                                    $attribute[] = 'href="javascript:void(0)"';
                                    $attribute[] = 'class="social-wrapper"';
                                    if($socialmedia['social_type'] == ''):

                                           
                                            if ( ! empty( $socialmedia['element_ready_social_link']['url'] ) ) {
                                                $attribute[] = 'href="'.$socialmedia['element_ready_social_link']['url'].'"';
                                                if ( $socialmedia['element_ready_social_link']['is_external'] ) {
                                                    $attribute[] = 'target="_blank"';
                                                }
                                                if ( $socialmedia['element_ready_social_link']['nofollow'] ) {
                                                    $attribute[] = 'rel="nofollow"';
                                                }
                                            }

                                    endif;  

                                    if($socialmedia['social_type'] != ''):

                                        $attribute[] = "data-social='{$socialmedia['social_type']}'";

                                    endif;  

                                ?>

                                <div class="element-ready-social-style-4 element-ready-social elementor-repeater-item-<?php echo $socialmedia['_id']; ?>">
                                    <a <?php echo implode(' ', $attribute ); $attribute = array();?> >
                                        <?php  if( 'icon' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                        <?php }elseif('title' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-content">
                                                <span class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></span>
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php }else{ ?>

                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                            <div class="element-ready-social-content">
                                                <span class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></span>
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                            </div>

                                        <?php } ?>
                                    </a>
                                </div>
                              
                            
                        <?php endforeach; ?>    
                   
                </div>
        <?php endif; ?>  

        <?php if($settings['block_style'] == 'style5'):
             $this->add_render_attribute( 'element_ready_socials_buttons_attr', 'class', 'er-'.$settings['block_style'] );
            ?> 
            <div <?php echo $this->get_render_attribute_string( 'element_ready_socials_buttons_attr' ); ?> >
              
                    <?php foreach ( $settings['element_ready_socialmedia_list'] as $socialmedia ) :?>
                                <?php 
                                    $attribute = array();
                                    $attribute[] = 'href="javascript:void(0)"';
                                    $attribute[] = 'class="social-wrapper"';
                                    if($socialmedia['social_type'] == ''):

                                           
                                            if ( ! empty( $socialmedia['element_ready_social_link']['url'] ) ) {
                                                $attribute[] = 'href="'.$socialmedia['element_ready_social_link']['url'].'"';
                                                if ( $socialmedia['element_ready_social_link']['is_external'] ) {
                                                    $attribute[] = 'target="_blank"';
                                                }
                                                if ( $socialmedia['element_ready_social_link']['nofollow'] ) {
                                                    $attribute[] = 'rel="nofollow"';
                                                }
                                            }

                                    endif;  

                                    if($socialmedia['social_type'] != ''):

                                        $attribute[] = "data-social='{$socialmedia['social_type']}'";

                                    endif;  

                                ?>

                                <div class="element-ready-social-style-5 element-ready-social elementor-repeater-item-<?php echo $socialmedia['_id']; ?>">
                                    <a <?php echo implode(' ', $attribute ); $attribute = array();?> >
                                        <?php  if( 'icon' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                        <?php }elseif('title' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-content">
                                                <span class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></span>
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php }else{ ?>

                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                            <div class="element-ready-social-content">
                                                <span class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></span>
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                            </div>

                                        <?php } ?>
                                    </a>
                                </div>
                              
                            
                        <?php endforeach; ?>    
                   
                </div>
        <?php endif; ?>  

        <?php if($settings['block_style'] == 'style6'):
             $this->add_render_attribute( 'element_ready_socials_buttons_attr', 'class', 'er-'.$settings['block_style'] );
            ?> 
            <div <?php echo $this->get_render_attribute_string( 'element_ready_socials_buttons_attr' ); ?> >
              
                    <?php foreach ( $settings['element_ready_socialmedia_list'] as $socialmedia ) :?>
                                <?php 
                                    $attribute = array();
                                    $attribute[] = 'href="javascript:void(0)"';
                                    $attribute[] = 'class="social-wrapper"';
                                    if($socialmedia['social_type'] == ''):

                                           
                                            if ( ! empty( $socialmedia['element_ready_social_link']['url'] ) ) {
                                                $attribute[] = 'href="'.$socialmedia['element_ready_social_link']['url'].'"';
                                                if ( $socialmedia['element_ready_social_link']['is_external'] ) {
                                                    $attribute[] = 'target="_blank"';
                                                }
                                                if ( $socialmedia['element_ready_social_link']['nofollow'] ) {
                                                    $attribute[] = 'rel="nofollow"';
                                                }
                                            }

                                    endif;  

                                    if($socialmedia['social_type'] != ''):

                                        $attribute[] = "data-social='{$socialmedia['social_type']}'";

                                    endif;  

                                ?>

                                <div class="element-ready-social-style-6 element-ready-social elementor-repeater-item-<?php echo $socialmedia['_id']; ?>">
                                    <a <?php echo implode(' ', $attribute ); $attribute = array();?> >
                                        <?php  if( 'icon' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                        <?php }elseif('title' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-content">
                                                <span class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></span>
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php }else{ ?>

                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                            <div class="element-ready-social-content">
                                                <span class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></span>
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                            </div>

                                        <?php } ?>
                                    </a>
                                </div>
                              
                            
                        <?php endforeach; ?>    
                   
                </div>
        <?php endif; ?> 

        <?php if($settings['block_style'] == 'style7'):
             $this->add_render_attribute( 'element_ready_socials_buttons_attr', 'class', 'er-'.$settings['block_style'] );
            ?> 
            <div <?php echo $this->get_render_attribute_string( 'element_ready_socials_buttons_attr' ); ?> >
              
                    <?php foreach ( $settings['element_ready_socialmedia_list'] as $socialmedia ) :?>
                                <?php 
                                    $attribute = array();
                                    $attribute[] = 'href="javascript:void(0)"';
                                    $attribute[] = 'class="social-wrapper"';
                                    if($socialmedia['social_type'] == ''):

                                           
                                            if ( ! empty( $socialmedia['element_ready_social_link']['url'] ) ) {
                                                $attribute[] = 'href="'.$socialmedia['element_ready_social_link']['url'].'"';
                                                if ( $socialmedia['element_ready_social_link']['is_external'] ) {
                                                    $attribute[] = 'target="_blank"';
                                                }
                                                if ( $socialmedia['element_ready_social_link']['nofollow'] ) {
                                                    $attribute[] = 'rel="nofollow"';
                                                }
                                            }

                                    endif;  

                                    if($socialmedia['social_type'] != ''):

                                        $attribute[] = "data-social='{$socialmedia['social_type']}'";

                                    endif;  

                                ?>

                                <div class="element-ready-social-style-7 element-ready-social elementor-repeater-item-<?php echo $socialmedia['_id']; ?>">
                                    <a <?php echo implode(' ', $attribute ); $attribute = array();?> >
                                        <?php  if( 'icon' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                        <?php }elseif('title' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-content">
                                                <span class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></span>
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php }else{ ?>

                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                            <div class="element-ready-social-content">
                                                <span class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></span>
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                            </div>

                                        <?php } ?>
                                    </a>
                                </div>
                              
                            
                        <?php endforeach; ?>    
                   
                </div>
        <?php endif; ?> 
        <?php if($settings['block_style'] == 'style8'):
             $this->add_render_attribute( 'element_ready_socials_buttons_attr', 'class', 'er-'.$settings['block_style'] );
            ?> 
            <div <?php echo $this->get_render_attribute_string( 'element_ready_socials_buttons_attr' ); ?> >
              
                    <?php foreach ( $settings['element_ready_socialmedia_list'] as $socialmedia ) :?>
                                <?php 
                                    $attribute = array();
                                    $attribute[] = 'href="javascript:void(0)"';
                                    $attribute[] = 'class="social-wrapper"';
                                    if($socialmedia['social_type'] == ''):

                                           
                                            if ( ! empty( $socialmedia['element_ready_social_link']['url'] ) ) {
                                                $attribute[] = 'href="'.$socialmedia['element_ready_social_link']['url'].'"';
                                                if ( $socialmedia['element_ready_social_link']['is_external'] ) {
                                                    $attribute[] = 'target="_blank"';
                                                }
                                                if ( $socialmedia['element_ready_social_link']['nofollow'] ) {
                                                    $attribute[] = 'rel="nofollow"';
                                                }
                                            }

                                    endif;  

                                    if($socialmedia['social_type'] != ''):

                                        $attribute[] = "data-social='{$socialmedia['social_type']}'";

                                    endif;  

                                ?>

                                <div class="element-ready-social-style-7 element-ready-social-style-8 element-ready-social elementor-repeater-item-<?php echo $socialmedia['_id']; ?>">
                                    <a <?php echo implode(' ', $attribute ); $attribute = array();?> >
                                        <?php  if( 'icon' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                        <?php }elseif('title' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-content">
                                                <span class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></span>
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php }else{ ?>

                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                            <div class="element-ready-social-content">
                                                <span class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></span>
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                            </div>

                                        <?php } ?>
                                    </a>
                                </div>
                              
                            
                        <?php endforeach; ?>    
                   
                </div>
        <?php endif; ?>

        <?php if($settings['block_style'] == 'style9'):
             $this->add_render_attribute( 'element_ready_socials_buttons_attr', 'class', 'er-'.$settings['block_style'] );
            ?> 
            <div <?php echo $this->get_render_attribute_string( 'element_ready_socials_buttons_attr' ); ?> >
              
                    <?php foreach ( $settings['element_ready_socialmedia_list'] as $socialmedia ) :?>
                                <?php 
                                    $attribute = array();
                                    $attribute[] = 'href="javascript:void(0)"';
                                    $attribute[] = 'class="social-wrapper"';
                                    if($socialmedia['social_type'] == ''):

                                           
                                            if ( ! empty( $socialmedia['element_ready_social_link']['url'] ) ) {
                                                $attribute[] = 'href="'.$socialmedia['element_ready_social_link']['url'].'"';
                                                if ( $socialmedia['element_ready_social_link']['is_external'] ) {
                                                    $attribute[] = 'target="_blank"';
                                                }
                                                if ( $socialmedia['element_ready_social_link']['nofollow'] ) {
                                                    $attribute[] = 'rel="nofollow"';
                                                }
                                            }

                                    endif;  

                                    if($socialmedia['social_type'] != ''):

                                        $attribute[] = "data-social='{$socialmedia['social_type']}'";

                                    endif;  

                                ?>

                                <div class="element-ready-social-style-9 element-ready-social elementor-repeater-item-<?php echo $socialmedia['_id']; ?>">
                                    <a <?php echo implode(' ', $attribute ); $attribute = array();?> >
                                        <?php  if( 'icon' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                        <?php }elseif('title' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-content">
                                                <span class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></span>
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php }else{ ?>

                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                            <div class="element-ready-social-content">
                                                <span class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></span>
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                            </div>

                                        <?php } ?>
                                    </a>
                                </div>
                              
                            
                        <?php endforeach; ?>    
                   
                </div>
        <?php endif; ?>
        <?php if($settings['block_style'] == 'style10'):
             $this->add_render_attribute( 'element_ready_socials_buttons_attr', 'class', 'er-'.$settings['block_style'] );
            ?> 
            <div <?php echo $this->get_render_attribute_string( 'element_ready_socials_buttons_attr' ); ?> >
              
                    <?php foreach ( $settings['element_ready_socialmedia_list'] as $socialmedia ) :?>
                                <?php 
                                    $attribute = array();
                                    $attribute[] = 'href="javascript:void(0)"';
                                    $attribute[] = 'class="social-wrapper"';
                                    if($socialmedia['social_type'] == ''):

                                           
                                            if ( ! empty( $socialmedia['element_ready_social_link']['url'] ) ) {
                                                $attribute[] = 'href="'.$socialmedia['element_ready_social_link']['url'].'"';
                                                if ( $socialmedia['element_ready_social_link']['is_external'] ) {
                                                    $attribute[] = 'target="_blank"';
                                                }
                                                if ( $socialmedia['element_ready_social_link']['nofollow'] ) {
                                                    $attribute[] = 'rel="nofollow"';
                                                }
                                            }

                                    endif;  

                                    if($socialmedia['social_type'] != ''):

                                        $attribute[] = "data-social='{$socialmedia['social_type']}'";

                                    endif;  

                                ?>

                                <div class="element-ready-social-style-10 element-ready-social elementor-repeater-item-<?php echo $socialmedia['_id']; ?>">
                                    <a <?php echo implode(' ', $attribute ); $attribute = array();?> >
                                        <?php  if( 'icon' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                        <?php }elseif('title' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-content">
                                                <span class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></span>
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php }else{ ?>

                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                            <div class="element-ready-social-content">
                                                <span class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></span>
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                            </div>

                                        <?php } ?>
                                    </a>
                                </div>
                              
                            
                        <?php endforeach; ?>    
                   
                </div>
        <?php endif; ?>
        <?php if($settings['block_style'] == 'style11'):
             $this->add_render_attribute( 'element_ready_socials_buttons_attr', 'class', 'er-'.$settings['block_style'] );
            ?> 
            <div <?php echo $this->get_render_attribute_string( 'element_ready_socials_buttons_attr' ); ?> >
              
                    <?php foreach ( $settings['element_ready_socialmedia_list'] as $socialmedia ) :?>
                                <?php 
                                    $attribute = array();
                                    $attribute[] = 'href="javascript:void(0)"';
                                    $attribute[] = 'class="social-wrapper"';
                                    if($socialmedia['social_type'] == ''):

                                           
                                            if ( ! empty( $socialmedia['element_ready_social_link']['url'] ) ) {
                                                $attribute[] = 'href="'.$socialmedia['element_ready_social_link']['url'].'"';
                                                if ( $socialmedia['element_ready_social_link']['is_external'] ) {
                                                    $attribute[] = 'target="_blank"';
                                                }
                                                if ( $socialmedia['element_ready_social_link']['nofollow'] ) {
                                                    $attribute[] = 'rel="nofollow"';
                                                }
                                            }

                                    endif;  

                                    if($socialmedia['social_type'] != ''):

                                        $attribute[] = "data-social='{$socialmedia['social_type']}'";

                                    endif;  

                                ?>

                                <div class="element-ready-social-style-11 element-ready-social elementor-repeater-item-<?php echo $socialmedia['_id']; ?>">
                                    <a <?php echo implode(' ', $attribute ); $attribute = array();?> >
                                        <?php  if( 'icon' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                        <?php }elseif('title' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-content">
                                                <p class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></p>
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php }else{ ?>

                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                            <div class="element-ready-social-content">
                                                <p class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></p>
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                            </div>

                                        <?php } ?>
                                    </a>
                                </div>
                              
                            
                        <?php endforeach; ?>    
                   
                </div>
        <?php endif; ?>

        <?php if($settings['block_style'] == 'style12'):
             $this->add_render_attribute( 'element_ready_socials_buttons_attr', 'class', 'er-'.$settings['block_style'] );
            ?> 
            <div <?php echo $this->get_render_attribute_string( 'element_ready_socials_buttons_attr' ); ?> >
              
                    <?php foreach ( $settings['element_ready_socialmedia_list'] as $socialmedia ) :?>
                                <?php 
                                    $attribute = array();
                                    $attribute[] = 'href="javascript:void(0)"';
                                    $attribute[] = 'class="social-wrapper"';
                                    if($socialmedia['social_type'] == ''):

                                           
                                            if ( ! empty( $socialmedia['element_ready_social_link']['url'] ) ) {
                                                $attribute[] = 'href="'.$socialmedia['element_ready_social_link']['url'].'"';
                                                if ( $socialmedia['element_ready_social_link']['is_external'] ) {
                                                    $attribute[] = 'target="_blank"';
                                                }
                                                if ( $socialmedia['element_ready_social_link']['nofollow'] ) {
                                                    $attribute[] = 'rel="nofollow"';
                                                }
                                            }

                                    endif;  

                                    if($socialmedia['social_type'] != ''):

                                        $attribute[] = "data-social='{$socialmedia['social_type']}'";

                                    endif;  

                                ?>

                                <div class="element-ready-social-style-11 element-ready-social-style-12 element-ready-social elementor-repeater-item-<?php echo $socialmedia['_id']; ?>">
                                    <a <?php echo implode(' ', $attribute ); $attribute = array();?> >
                                        <?php  if( 'icon' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                        <?php }elseif('title' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-content">
                                             
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                                <p class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></p>
                                            </div>
                                        <?php }else{ ?>

                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                            <div class="element-ready-social-content">
                                               
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                                <p class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></p>
                                            </div>

                                        <?php } ?>
                                    </a>
                                </div>
                              
                            
                        <?php endforeach; ?>    
                   
                </div>
        <?php endif; ?>

        <?php if($settings['block_style'] == 'style13'):
             $this->add_render_attribute( 'element_ready_socials_buttons_attr', 'class', 'er-'.$settings['block_style'] );
            ?> 
            <div <?php echo $this->get_render_attribute_string( 'element_ready_socials_buttons_attr' ); ?> >
              
                    <?php foreach ( $settings['element_ready_socialmedia_list'] as $socialmedia ) :?>
                                <?php 
                                    $attribute = array();
                                    $attribute[] = 'href="javascript:void(0)"';
                                    $attribute[] = 'class="social-wrapper"';
                                    if($socialmedia['social_type'] == ''):

                                           
                                            if ( ! empty( $socialmedia['element_ready_social_link']['url'] ) ) {
                                                $attribute[] = 'href="'.$socialmedia['element_ready_social_link']['url'].'"';
                                                if ( $socialmedia['element_ready_social_link']['is_external'] ) {
                                                    $attribute[] = 'target="_blank"';
                                                }
                                                if ( $socialmedia['element_ready_social_link']['nofollow'] ) {
                                                    $attribute[] = 'rel="nofollow"';
                                                }
                                            }

                                    endif;  

                                    if($socialmedia['social_type'] != ''):

                                        $attribute[] = "data-social='{$socialmedia['social_type']}'";

                                    endif;  

                                ?>

                                <div class="element-ready-social-style-13 element-ready-social elementor-repeater-item-<?php echo $socialmedia['_id']; ?>">
                                    <a <?php echo implode(' ', $attribute ); $attribute = array();?> >
                                        <?php  if( 'icon' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                        <?php }elseif('title' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-content">
                                                <span class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></span>
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                               
                                            </div>
                                        <?php }else{ ?>

                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                            <div class="element-ready-social-content">
                                               <span class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></span>
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                              
                                            </div>

                                        <?php } ?>
                                    </a>
                                </div>
                              
                            
                        <?php endforeach; ?>    
                   
                </div>
        <?php endif; ?>
        <?php if($settings['block_style'] == 'style14'):
             $this->add_render_attribute( 'element_ready_socials_buttons_attr', 'class', 'er-'.$settings['block_style'] );
            ?> 
            <div <?php echo $this->get_render_attribute_string( 'element_ready_socials_buttons_attr' ); ?> >
              
                    <?php foreach ( $settings['element_ready_socialmedia_list'] as $socialmedia ) :?>
                                <?php 
                                    $attribute = array();
                                    $attribute[] = 'href="javascript:void(0)"';
                                    $attribute[] = 'class="social-wrapper"';
                                    if($socialmedia['social_type'] == ''):

                                           
                                            if ( ! empty( $socialmedia['element_ready_social_link']['url'] ) ) {
                                                $attribute[] = 'href="'.$socialmedia['element_ready_social_link']['url'].'"';
                                                if ( $socialmedia['element_ready_social_link']['is_external'] ) {
                                                    $attribute[] = 'target="_blank"';
                                                }
                                                if ( $socialmedia['element_ready_social_link']['nofollow'] ) {
                                                    $attribute[] = 'rel="nofollow"';
                                                }
                                            }

                                    endif;  

                                    if($socialmedia['social_type'] != ''):

                                        $attribute[] = "data-social='{$socialmedia['social_type']}'";

                                    endif;  

                                ?>

                                <div class="element-ready-social-style-14 element-ready-social elementor-repeater-item-<?php echo $socialmedia['_id']; ?>">
                                    <a <?php echo implode(' ', $attribute ); $attribute = array();?> >
                                        <?php  if( 'icon' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                        <?php }elseif('title' == $settings['social_view'] ){ ?>
                                            <div class="element-ready-social-content">
                                                <span class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></span>
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                               
                                            </div>
                                        <?php }else{ ?>

                                            <div class="element-ready-social-icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                            </div>
                                            <div class="element-ready-social-content">
                                               <span class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></span>
                                                <?php if( $socialmedia['meta_info'] =='yes' ): ?>
                                                    <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                                <?php endif; ?>
                                              
                                            </div>

                                        <?php } ?>
                                    </a>
                                </div>
                              
                            
                        <?php endforeach; ?>    
                   
                </div>
        <?php endif; ?>
        <?php if($settings['block_style'] == 'style15'):
             $this->add_render_attribute( 'element_ready_socials_buttons_attr', 'class', 'er-'.$settings['block_style'] );
            ?> 
               <div <?php echo $this->get_render_attribute_string( 'element_ready_socials_buttons_attr' ); ?> >
              
                    <?php foreach ( $settings['element_ready_socialmedia_list'] as $socialmedia ) :?>
                            <?php 
                                $attribute = array();
                                $attribute[] = 'href="javascript:void(0)"';
                                $attribute[] = 'class="social-wrapper"';
                                if($socialmedia['social_type'] == ''):

                                        
                                        if ( ! empty( $socialmedia['element_ready_social_link']['url'] ) ) {
                                            $attribute[] = 'href="'.$socialmedia['element_ready_social_link']['url'].'"';
                                            if ( $socialmedia['element_ready_social_link']['is_external'] ) {
                                                $attribute[] = 'target="_blank"';
                                            }
                                            if ( $socialmedia['element_ready_social_link']['nofollow'] ) {
                                                $attribute[] = 'rel="nofollow"';
                                            }
                                        }

                                endif;  

                                if($socialmedia['social_type'] != ''):

                                    $attribute[] = "data-social='{$socialmedia['social_type']}'";

                                endif;  

                            ?>

                            <div class="element-ready-social-icon-style-1 element-ready-social elementor-repeater-item-<?php echo $socialmedia['_id']; ?>">
                                <a <?php echo implode(' ', $attribute ); $attribute = array();?> >
                                        <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                </a>
                            </div>
                            
                        
                    <?php endforeach; ?>    
                   
                </div>
        <?php endif; ?>
        <?php if($settings['block_style'] == 'style16'):
             $this->add_render_attribute( 'element_ready_socials_buttons_attr', 'class', 'er-'.$settings['block_style'] );
            ?> 
               <div <?php echo $this->get_render_attribute_string( 'element_ready_socials_buttons_attr' ); ?> >
              
                    <?php foreach ( $settings['element_ready_socialmedia_list'] as $socialmedia ) :?>
                            <?php 
                                $attribute = array();
                                $attribute[] = 'href="javascript:void(0)"';
                                $attribute[] = 'class="social-wrapper"';
                                if($socialmedia['social_type'] == ''):

                                        
                                        if ( ! empty( $socialmedia['element_ready_social_link']['url'] ) ) {
                                            $attribute[] = 'href="'.$socialmedia['element_ready_social_link']['url'].'"';
                                            if ( $socialmedia['element_ready_social_link']['is_external'] ) {
                                                $attribute[] = 'target="_blank"';
                                            }
                                            if ( $socialmedia['element_ready_social_link']['nofollow'] ) {
                                                $attribute[] = 'rel="nofollow"';
                                            }
                                        }

                                endif;  

                                if($socialmedia['social_type'] != ''):

                                    $attribute[] = "data-social='{$socialmedia['social_type']}'";

                                endif;  

                            ?>

                            <div class="element-ready-social-icon-style-1 element-ready-social-icon-style-2 element-ready-social elementor-repeater-item-<?php echo $socialmedia['_id']; ?>">
                                <a <?php echo implode(' ', $attribute ); $attribute = array();?> >
                                        <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                </a>
                            </div>
                            
                        
                    <?php endforeach; ?>    
                   
                </div>
        <?php endif; ?>
        <?php if($settings['block_style'] == 'style17'):
             $this->add_render_attribute( 'element_ready_socials_buttons_attr', 'class', 'er-'.$settings['block_style'] );
            ?> 
               <div <?php echo $this->get_render_attribute_string( 'element_ready_socials_buttons_attr' ); ?> >
              
                    <?php foreach ( $settings['element_ready_socialmedia_list'] as $socialmedia ) :?>
                            <?php 
                                $attribute = array();
                                $attribute[] = 'href="javascript:void(0)"';
                                $attribute[] = 'class="social-wrapper"';
                                if($socialmedia['social_type'] == ''):

                                        
                                        if ( ! empty( $socialmedia['element_ready_social_link']['url'] ) ) {
                                            $attribute[] = 'href="'.$socialmedia['element_ready_social_link']['url'].'"';
                                            if ( $socialmedia['element_ready_social_link']['is_external'] ) {
                                                $attribute[] = 'target="_blank"';
                                            }
                                            if ( $socialmedia['element_ready_social_link']['nofollow'] ) {
                                                $attribute[] = 'rel="nofollow"';
                                            }
                                        }

                                endif;  

                                if($socialmedia['social_type'] != ''):

                                    $attribute[] = "data-social='{$socialmedia['social_type']}'";

                                endif;  

                            ?>

                            <div class="element-ready-social-icon-style-3 element-ready-social-icon-style-4 element-ready-social elementor-repeater-item-<?php echo $socialmedia['_id']; ?>">
                                <a <?php echo implode(' ', $attribute ); $attribute = array();?> >
                                       <?php  if( 'icon' == $settings['social_view'] ){ ?>
                                             <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                        <?php }elseif( 'title' == $settings['social_view'] ){ ?>
                                                <span class="title"><?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?></span>
                                       <?php }else{ ?> 
                                        <?php \Elementor\Icons_Manager::render_icon( $socialmedia['element_ready_social_icon'] ); ?>
                                        <span class="title"> <?php echo esc_html( $socialmedia['element_ready_social_title'] ); ?>
                                          <span class="information"><?php echo esc_html( $socialmedia['element_ready_social_info'] ); ?></span>
                                        </span>
                                      <?php } ?>
                                </a>
                            </div>
                            
                        
                    <?php endforeach; ?>    
                   
                </div>
                
        <?php endif; ?>

        
        <?php
    }
}