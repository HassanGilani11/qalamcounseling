<?php
namespace Element_Ready_Pro\Widgets\icon_listing;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Element_Ready_Icon_List_Widget extends Widget_Base {

    public function get_name() {
        return 'Element_Ready_Icon_List_Widget';
    }
    
    public function get_title() {
        return __( 'ER Icon Listing', 'element-ready-pro' );
    }

    public function get_icon() {
        return 'eicon-bullet-list';
    }

    public function get_categories() {
        return [ 'element-ready-pro' ];
    }

    public function get_keywords() {
        return [ 'List', 'Icon List', 'Mega Listing' ];
    }

    public function get_style_depends() {

        wp_register_style( 'eready-icon-listing' , ELEMENT_READY_ROOT_CSS. 'widgets/icon-listing.css' );
        return [ 'eready-icon-listing' ];
    }

    public function element_ready_infobox_style(){
        return [
            'icon__list__style__1' => __( 'Style One', 'element-ready-pro' ),
            'icon__list__style__2' => __( 'Style Two', 'element-ready-pro' ),
            'icon__list__style__3' => __( 'Style Three', 'element-ready-pro' ),
            'custom'               => __( 'Custom Style', 'element-ready-pro' ),
        ];
    }

    protected function register_controls() {
        /*--------------------------
            CONTENT SECTION
        ---------------------------*/
        $this->start_controls_section(
            'listing_content_section',
            [
                'label' => __( 'Icon list Content Style', 'element-ready-pro' ),
            ]
        );
            $this->add_control(
                'icon_listing_style',
                [
                    'label'   => __( 'Icon List Style', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'icon__list__style__1',
                    'options' => $this->element_ready_infobox_style(),
                    'separator'   => 'before',
                ]
            );
            $this->add_control(
                'title', [
                    'label'       => __( 'Header Title', 'element-ready-pro' ),
                    'type'        => Controls_Manager::TEXT,
                    'label_block' => true,
                    'separator'   => 'before',
                ]
            );
            $this->add_control(
                'description', [
                    'label'       => __( 'Header Description', 'element-ready-pro' ),
                    'type'        => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'separator'   => 'before',
                ]
            );
            $repeater = new Repeater();
            $repeater->start_controls_tabs(
                'element_ready_list_tabs'
            );
            $repeater->start_controls_tab(
                'list_content_tab',
                [
                    'label' => __( 'Content', 'element-ready-pro' ),
                ]
            );
                $repeater->add_control(
                    'show_icon',
                    [
                        'label'        => __( 'Show Icon', 'element-ready-pro' ),
                        'type'         => Controls_Manager::SWITCHER,
                        'label_on'     => __( 'Show', 'element-ready-pro' ),
                        'label_off'    => __( 'Hide', 'element-ready-pro' ),
                        'return_value' => 'yes',
                        'default'      => 'yes',
                        'separator'    => 'before',
                    ]
                );
                $repeater->add_control(
                    'list_icon',
                    [
                        'label'     => __( 'Icon', 'element-ready-pro' ),
                        'type'      => Controls_Manager::ICONS,
                        'label_block' => true,
                        'default'   => [
                            'default' => 'fa fa-check',
                            'library' => 'solid',
                        ],
                        'condition' => [
                            'show_icon' => 'yes',
                        ],
                    ]
                );
                $repeater->add_control(
                    'list_title', [
                        'label'       => __( 'List Title', 'element-ready-pro' ),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true,
                        'separator'   => 'before',
                    ]
                );
                $repeater->add_control(
                    'list_content', [
                        'label'      => __( 'List Content', 'element-ready-pro' ),
                        'type'       => Controls_Manager::WYSIWYG,
                        'label_block' => true,
                        'separator'   => 'before',
                    ]
                );
            $repeater->end_controls_tab();
            $repeater->start_controls_tab(
                'list_style_tab',
                [
                    'label' => __( 'Style', 'element-ready-pro' ),
                ]
            );
                $repeater->add_control(
                    'current_item_icon_heading',
                    [
                        'label' => __( 'Current Item Icon Style', 'element-ready-pro' ),
                        'type'  => Controls_Manager::HEADING,
                    ]
                );
                $repeater->add_control(
                    'current_item_icon_color',
                    [
                        'label'     => __( 'Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'separator' => 'before',
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}} .icon__list__icon' => 'color: {{VALUE}}'
                        ],
                    ]
                );
                $repeater->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'      => 'current_item_icon_background',
                        'label'     => __( 'Background', 'element-ready-pro' ),
                        'types'     => [ 'classic', 'gradient' ],
                        'separator' => 'before',
                        'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}} .icon__list__icon',
                    ]
                );
                $repeater->add_control(
                    'current_item_heading',
                    [
                        'label'     => __( 'Current Item Style', 'element-ready-pro' ),
                        'type'      => Controls_Manager::HEADING,
                        'separator' => 'before',
                    ]
                );
                $repeater->add_control(
                    'current_item_title_color',
                    [
                        'label'     => __( 'Title Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'separator' => 'before',
                        'selectors' => [
                            '{{WRAPPER}} .single__icon__list{{CURRENT_ITEM}} .icon__list__title' => 'color: {{VALUE}}'
                        ],
                    ]
                );
                $repeater->add_control(
                    'current_item_color',
                    [
                        'label'     => __( 'Description Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'separator' => 'before',
                        'selectors' => [
                            '{{WRAPPER}} .single__icon__list{{CURRENT_ITEM}} .icon__list__details' => 'color: {{VALUE}}'
                        ],
                    ]
                );
                $repeater->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'      => 'current_item_background',
                        'label'     => __( 'Background', 'element-ready-pro' ),
                        'types'     => [ 'classic', 'gradient' ],
                        'separator' => 'before',
                        'selector'  => '{{WRAPPER}} .single__icon__list{{CURRENT_ITEM}}',
                    ]
                );
                $repeater->add_group_control(
                    Group_Control_Border:: get_type(),
                    [
                        'name'      => 'current_item_border',
                        'label'     => __( 'Border', 'element-ready-pro' ),
                        'separator' => 'before',
                        'selector'  => '{{WRAPPER}} .single__icon__list{{CURRENT_ITEM}}',
                    ]
                );
                $repeater->add_responsive_control(
                    'wrapper_padding',
                    [
                        'label'      => __( 'Padding', 'element-ready-pro' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors'  => [
                            '{{WRAPPER}} .single__icon__list{{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $repeater->add_responsive_control(
                    'wrapper_margin',
                    [
                        'label'      => __( 'Margin', 'element-ready-pro' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors'  => [
                            '{{WRAPPER}} .single__icon__list{{CURRENT_ITEM}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
            $repeater->end_controls_tab();
            $repeater->start_controls_tab(
                'list_style_hover_tab',
                [
                    'label' => __( 'Hover', 'element-ready-pro' ),
                ]
            );
                $repeater->add_control(
                    'current_item_hover_icon_heading',
                    [
                        'label' => __( 'Current Item Hover Icon Style', 'element-ready-pro' ),
                        'type'  => Controls_Manager::HEADING,
                    ]
                );
                $repeater->add_control(
                    'current_item_hover_icon_color',
                    [
                        'label'     => __( 'Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'separator' => 'before',
                        'selectors' => [
                            '{{WRAPPER}} .single__icon__list{{CURRENT_ITEM}}:hover .icon__list__icon' => 'color: {{VALUE}}'
                        ],
                    ]
                );
                $repeater->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'      => 'current_item_hover_icon_background',
                        'label'     => __( 'Background', 'element-ready-pro' ),
                        'types'     => [ 'classic', 'gradient' ],
                        'separator' => 'before',
                        'selector'  => '{{WRAPPER}} .single__icon__list{{CURRENT_ITEM}}:hover .icon__list__icon',
                    ]
                );
                $repeater->add_control(
                    'current_item_hover_heading',
                    [
                        'label'     => __( 'Current Item Hover Style', 'element-ready-pro' ),
                        'type'      => Controls_Manager::HEADING,
                        'separator' => 'before',
                    ]
                );
                $repeater->add_control(
                    'current_item_hover_title_color',
                    [
                        'label'     => __( 'Title Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'separator' => 'before',
                        'selectors' => [
                            '{{WRAPPER}} .single__icon__list{{CURRENT_ITEM}}:hover .icon__list__title' => 'color: {{VALUE}}'
                        ],
                    ]
                );
                $repeater->add_control(
                    'current_item_hover_color',
                    [
                        'label'     => __( 'Description Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'separator' => 'before',
                        'selectors' => [
                            '{{WRAPPER}} .single__icon__list{{CURRENT_ITEM}}:hover .icon__list__details' => 'color: {{VALUE}}'
                        ],
                    ]
                );
                $repeater->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'      => 'current_item_hover_background',
                        'label'     => __( 'Background', 'element-ready-pro' ),
                        'types'     => [ 'classic', 'gradient' ],
                        'separator' => 'before',
                        'selector'  => '{{WRAPPER}} .single__icon__list{{CURRENT_ITEM}}:hover',
                    ]
                );
                $repeater->add_group_control(
                    Group_Control_Border:: get_type(),
                    [
                        'name'      => 'current_item_hover_border',
                        'label'     => __( 'Border', 'element-ready-pro' ),
                        'separator' => 'before',
                        'selector'  => '{{WRAPPER}} .single__icon__list{{CURRENT_ITEM}}:hover',
                    ]
                );
            $repeater->end_controls_tab();
            $repeater->end_controls_tabs();
            $this->add_control(
                'list_content',
                [
                    'label'   => __( 'Add Info Boxes', 'element-ready-pro' ),
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'default' => [
                        [
                            'list_icon'   => [
                                'value' => 'fas fa-check',
                                'library' => 'fa-solid',
                            ],
                            'list_title' => __( 'List Item #1', 'element-ready-pro' ),
                        ],
                        [
                            'list_icon'   => [
                                'value' => 'fas fa-check',
                                'library' => 'fa-solid',
                            ],
                            'list_title' => __( 'List Item #2', 'element-ready-pro' ),
                        ],
                        [
                            'list_icon'   => [
                                'value' => 'fas fa-check',
                                'library' => 'fa-solid',
                            ],
                            'list_title' => __( 'List Item #3', 'element-ready-pro' ),
                        ],
                    ],
                    'title_field' => '{{{ list_title }}}',
                    'separator'   => 'before',
                ]
            );
        $this->end_controls_section();
        /*--------------------------
            CONTENT SECTION END
        ---------------------------*/

        /*--------------------------
            AREA STYLE
        ---------------------------*/
        $this->start_controls_section(
            'wrapper_style_section',
            [
                'label' => __( 'Infobox Wrapper', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'wrapper_background',
                    'label'    => __( 'Background', 'element-ready-pro' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .element__ready__icon__listing__wrap',
                ]
            );
            $this->add_responsive_control(
                'wrapper_align',
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
                        '{{WRAPPER}} .element__ready__icon__listing__wrap' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'wrapper_border',
                    'label'    => __( 'Border', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .element__ready__icon__listing__wrap',
                ]
            );
            $this->add_responsive_control(
                'wrapper_radius',
                [
                    'label'      => __( 'Border Radius', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .element__ready__icon__listing__wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'wrapper_shadow',
                    'selector' => '{{WRAPPER}} .element__ready__icon__listing__wrap',
                ]
            );

            $this->add_responsive_control(
                'wrapper_padding',
                [
                    'label'      => __( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .element__ready__icon__listing__wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'wrapper_margin',
                [
                    'label'      => __( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .element__ready__icon__listing__wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        /*----------------------------
            AREA STYLE END
        -----------------------------*/

        /*----------------------------
            HEADER TITLE
        -----------------------------*/
        $this->start_controls_section(
            'header_title_style_section',
            [
                'label'     => __( 'Header Title', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'title!' => '',
                ],
            ]
        );
            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'header_title_typography',
                    'selector' => '{{WRAPPER}} .icon__list__header__title h3',
                ]
            );
            $this->add_control(
                'header_title_color',
                [
                    'label'     => __( 'Color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .icon__list__header__title h3' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'header_title_background',
                    'label'    => __( 'Background', 'element-ready-pro' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .icon__list__header__title h3',
                ]
            );
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'header_title_border',
                    'label'    => __( 'Border', 'element-ready-pro' ),
                    'selector' => '{{WRAPPER}} .icon__list__header__title h3',
                ]
            );
            $this->add_responsive_control(
                'header_title_radius',
                [
                    'label'      => __( 'Border Radius', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .icon__list__header__title h3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'header_title_shadow',
                    'selector' => '{{WRAPPER}} .icon__list__header__title h3',
                ]
            );
            $this->add_responsive_control(
                'header_title_margin',
                [
                    'label'      => __( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .icon__list__header__title h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'header_title_padding',
                [
                    'label'      => __( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .icon__list__header__title h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'header_title_align',
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
                        '{{WRAPPER}} .icon__list__header__title h3' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
        $this->end_controls_section();
        /*----------------------------
            HEADER TITLE END
        -----------------------------*/

        /*----------------------------
            HEADER DESCRIPTION STYLE
        -----------------------------*/
        $this->start_controls_section(
            'header_desc_style_section',
            [
                'label' => __( 'Header Description', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'description!' => '',
                ],
            ]
        );
            $this->start_controls_tabs( 'header_desc_tabs_style' );
                $this->start_controls_tab(
                    'header_desc_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'header_desc_typography',
                            'selector' => '{{WRAPPER}} .icon__list__header__desc',
                        ]
                    );
                    $this->add_control(
                        'header_desc_color',
                        [
                            'label'     => __( 'Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .icon__list__header__desc' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'header_desc_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .icon__list__header__desc',
                        ]
                    );
                    $this->add_responsive_control(
                        'header_desc_margin',
                        [
                            'label'      => __( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .icon__list__header__desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'header_desc_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .icon__list__header__desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'header_desc_hover_tab',
                    [
                        'label' => __( 'Hover', 'element-ready-pro' ),
                    ]
                );
                    $this->add_control(
                        'hover_header_desc_color',
                        [
                            'label'     => __( 'Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}}:hover .icon__list__header__desc' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'hover_header_desc_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}}:hover .icon__list__header__desc',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*----------------------------
            HEADER DESCRIPTION STYLE END
        -----------------------------*/

        /*----------------------------
            IOCN STYLE
        -----------------------------*/
        $this->start_controls_section(
            'icon_style_section',
            [
                'label' => __( 'Icon', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'icon_tabs_style' );
                $this->start_controls_tab(
                    'icon_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );
                    $this->add_responsive_control(
                        'icon_width',
                        [
                            'label'      => __( 'Icon Wrap Width', 'element-ready-pro' ),
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
                                '{{WRAPPER}} .icon__list__icon' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'icon_height',
                        [
                            'label'      => __( 'Icon Wrap Height', 'element-ready-pro' ),
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
                                '{{WRAPPER}} .icon__list__icon' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                            'separator' => 'after',
                        ]
                    );
                    $this->add_responsive_control(
                        'icon_size',
                        [
                            'label'      => __( 'Icon Size', 'element-ready-pro' ),
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
                                'size' => '17',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .icon__list__icon' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .icon__list__icon svg' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                            'separator' => 'after',
                        ]
                    );
                    $this->add_control(
                        'icon_color',
                        [
                            'label'     => __( 'Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .icon__list__icon' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'icon_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .icon__list__icon',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'icon_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .icon__list__icon',
                        ]
                    );
                    $this->add_responsive_control(
                        'icon_radius',
                        [
                            'label'      => __( 'Border Radius', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .icon__list__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'icon_shadow',
                            'selector' => '{{WRAPPER}} .icon__list__icon',
                        ]
                    );
                    $this->add_responsive_control(
                        'icon_align',
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
                                '{{WRAPPER}} .icon__list__icon' => 'text-align: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'icon_display',
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
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .icon__list__icon' => 'display: {{VALUE}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'icon_position',
                        [
                            'label'   => __( 'Position', 'element-ready-pro' ),
                            'type'    => Controls_Manager::SELECT,
                            'options' => [
                                'initial'  => __( 'Initial', 'element-ready-pro' ),
                                'absolute' => __( 'Absulute', 'element-ready-pro' ),
                                'relative' => __( 'Relative', 'element-ready-pro' ),
                                'static'   => __( 'Static', 'element-ready-pro' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .icon__list__icon' => 'position: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'icon_position_from_left',
                        [
                            'label'      => __( 'From Left', 'element-ready-pro' ),
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
                                '{{WRAPPER}} .icon__list__icon' => 'left: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'icon_position' => ['absolute','relative']
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'icon_position_from_right',
                        [
                            'label'      => __( 'From Right', 'element-ready-pro' ),
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
                                '{{WRAPPER}} .icon__list__icon' => 'right: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'icon_position' => ['absolute','relative']
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'icon_position_from_top',
                        [
                            'label'      => __( 'From Top', 'element-ready-pro' ),
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
                                '{{WRAPPER}} .icon__list__icon' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'icon_position' => ['absolute','relative']
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'icon_position_from_bottom',
                        [
                            'label'      => __( 'From Bottom', 'element-ready-pro' ),
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
                                '{{WRAPPER}} .icon__list__icon' => 'bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'icon_position' => ['absolute','relative']
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'icon_margin',
                        [
                            'label'      => __( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .icon__list__icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'icon_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .icon__list__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'icon_transition',
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
                                '{{WRAPPER}} .icon__list__icon' => 'transition: {{SIZE}}s;',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'icon_hover_tab',
                    [
                        'label' => __( 'Hover', 'element-ready-pro' ),
                    ]
                );
                    $this->add_control(
                        'hover_icon_color',
                        [
                            'label'     => __( 'Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .single__icon__list:hover .icon__list__icon' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'hover_icon_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single__icon__list:hover .icon__list__icon',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'hover_icon_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .single__icon__list:hover .icon__list__icon',
                        ]
                    );
                    $this->add_responsive_control(
                        'hover_icon_radius',
                        [
                            'label'      => __( 'Border Radius', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__icon__list:hover .icon__list__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'hover_icon_shadow',
                            'selector' => '{{WRAPPER}} .single__icon__list:hover .icon__list__icon',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*----------------------------
            IOCN STYLE END
        -----------------------------*/

        /*----------------------------
            TITLE STYLE
        -----------------------------*/
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => __( 'Title', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'title_tabs_style' );
                $this->start_controls_tab(
                    'title_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'title_typography',
                            'selector' => '{{WRAPPER}} .single__icon__list .icon__list__title',
                        ]
                    );
                    $this->add_control(
                        'title_color',
                        [
                            'label'     => __( 'Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .single__icon__list .icon__list__title' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'title_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .single__icon__list .icon__list__title',
                        ]
                    );
                    $this->add_responsive_control(
                        'title_margin',
                        [
                            'label'      => __( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__icon__list .icon__list__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'title_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__icon__list .icon__list__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'title_hover_tab',
                    [
                        'label' => __( 'Hover', 'element-ready-pro' ),
                    ]
                );
                    $this->add_control(
                        'hover_title_color',
                        [
                            'label'     => __( 'Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .single__icon__list:hover .icon__list__title' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'hover_title_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .single__icon__list:hover .icon__list__title',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*----------------------------
            TITLE STYLE END
        -----------------------------*/


        /*------------------------
			BOX STYLE
        -------------------------*/
        $this->start_controls_section(
            'box_style_section',
            [
                'label' => __( 'Single Info Box', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'box_style_tabs' );
                $this->start_controls_tab(
                    'box_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'box_typography',
                            'selector' => '{{WRAPPER}} .single__icon__list .icon__list__details',
                        ]
                    );
                    $this->add_control(
                        'box_color',
                        [
                            'label'     => __( 'Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .single__icon__list .icon__list__details' => 'color: {{VALUE}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'box_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single__icon__list',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'box_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .single__icon__list',
                        ]
                    );
                    $this->add_responsive_control(
                        'box_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .single__icon__list' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' => 'after',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'      => 'box_box_shadow',
                            'label'     => __( 'Box Shadow', 'element-ready-pro' ),
                            'selector'  => '{{WRAPPER}} .single__icon__list',
                            'separator' => 'before',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Text_Shadow:: get_type(),
                        [
                            'name'     => 'box_text_shadow',
                            'label'    => __( 'Text Shadow', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .single__icon__list',
                        ]
                    );
                    $this->add_responsive_control(
                        'box_width',
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
                                '{{WRAPPER}} .single__icon__list' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'box_height',
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
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__icon__list' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'box_position',
                        [
                            'label'   => __( 'Position', 'element-ready-pro' ),
                            'type'    => Controls_Manager::SELECT,
                            'options' => [
                                'initial'  => __( 'Initial', 'element-ready-pro' ),
                                'absolute' => __( 'Absulute', 'element-ready-pro' ),
                                'relative' => __( 'Relative', 'element-ready-pro' ),
                                'static'   => __( 'Static', 'element-ready-pro' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__icon__list' => 'position: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'box_margin',
                        [
                            'label'      => __( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__icon__list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'box_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__icon__list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'box_transition',
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
                                '{{WRAPPER}} .single__icon__list' => 'transition: {{SIZE}}s;',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'box_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'element-ready-pro' ),
                    ]
                );
                    $this->add_control(
                        'box_hover_color',
                        [
                            'label'     => __( 'Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .single__icon__list:hover' => 'color: {{VALUE}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'box_hover_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single__icon__list:hover',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'box_hover_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '{{WRAPPER}} .single__icon__list:hover',
                        ]
                    );
                    $this->add_responsive_control(
                        'box_hover_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .single__icon__list:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' => 'after',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*-------------------------
			BOX STYLE END
        --------------------------*/
    }

    protected function render( $instance = [] ) {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'element_ready_icon_listing_attr', 'class', 'element__ready__icon__listing__wrap' );
        $this->add_render_attribute( 'element_ready_icon_listing_attr', 'class', $settings['icon_listing_style'] );

        ?>
            <div <?php echo $this->get_render_attribute_string('element_ready_icon_listing_attr'); ?> >

                <?php if( !empty( $settings['title'] ) ): ?>
                    <div class = "icon__list__header__title">
                        <h3><?php echo esc_html( $settings['title'] ); ?></h3>
                    </div>
                <?php endif; ?>

                <?php if( !empty( $settings['description'] ) ): ?>
                    <div class = "icon__list__header__desc">
                        <p><?php echo esc_html( $settings['description'] ); ?></p>
                    </div>
                <?php endif; ?>

                <?php if( !empty( $settings['list_content'] ) ): ?>
                    <?php foreach ( $settings['list_content'] as $content ): ?>
                        <?php
                            $icon = $list_title = $list_content = '';
                            if ( !empty( $content['list_title'] ) ) {
                                $list_title = $content['list_title'];
                            }
                            if ( !empty( $content['list_content'] ) ) {
                                $list_content = $content['list_content'];
                            }
                        ?>
                        <div class="single__icon__list elementor-repeater-item-<?php echo $content['_id']; ?>">

                            <?php if( !empty( $content['list_icon'] ) && $content['show_icon'] == true ): ?>
                                <div class="icon__list__icon">
                                    <?php Icons_Manager::render_icon( $content['list_icon'] ); ?>
                                </div>
                            <?php endif; ?>

                            <?php if( !empty( $list_title ) ) : ?>
                                <div class="icon__list__title"><?php echo esc_html( $list_title ); ?></div>
                            <?php endif; ?>

                            <?php if( !empty( $list_content ) ) : ?>
                                <div class="icon__list__details"><?php echo wpautop( $list_content ); ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php
    }
}