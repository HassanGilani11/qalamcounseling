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
 * Blog Post Comment Form and Comments
 * @author quomodosoft.com
 */
class Element_Ready_Blog_Post_Comment extends Widget_Base {

    public function get_name() {
        return 'element-ready-pro-blog-post-comments-form';
    }
    public function get_keywords() {
		return ['er comment','post comments','comments','form'];
	}
    public function get_title() {
        return esc_html__( 'ER Post Comments', 'element-ready-pro' );
    }

    public function get_icon() { 
        return 'eicon-form-horizontal';
    }

    public function get_categories() {
        return [ 'element-ready-pro' ];
    }

    public function get_style_depends() {
  
        return [
           'er-blog-post-comment'
        ];
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
            'wready_content_settings_section',
            [
                'label' => esc_html__( 'General Settings', 'element-ready-pro' ),
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

        $this->add_control(
			'show_er_comment_lists',
			[
				'label' => esc_html__( 'Show Comment List', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'element-ready-pro' ),
				'label_off' => esc_html__( 'Hide', 'element-ready-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        
        $this->add_control(
			'comment_list_heading_enable',
			[
				'label' => esc_html__( 'Comment List Heading', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'element-ready-pro' ),
				'label_off' => esc_html__( 'Hide', 'element-ready-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
			'comment_form_heading_enable',
			[
				'label' => esc_html__( 'Comment Form Heading', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'element-ready-pro' ),
				'label_off' => esc_html__( 'Hide', 'element-ready-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
            'comment_form_heading_text',
            [
                'label' => esc_html__( 'Comment Form Heading', 'element-ready-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Leave a Message',
                'placeholder' => esc_html__( 'Type your heading', 'element-ready-pro' ),
                'condition' => [
                    'comment_form_heading_enable' => ['yes']
                ]
            ]
        );

        $this->add_control(
			'comment_pagination_enable',
			[
				'label' => esc_html__( 'Comment Top Pagination', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'element-ready-pro' ),
				'label_off' => esc_html__( 'Hide', 'element-ready-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
			'comment_pagination_bottom_enable',
			[
				'label' => esc_html__( 'Comment Bottom Pagination', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'element-ready-pro' ),
				'label_off' => esc_html__( 'Hide', 'element-ready-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);


        $this->end_controls_section();
        $this->start_controls_section(
            'comment_form_fld_content_settings_section',
            [
                'label' => esc_html__( 'Comment Form Fields', 'element-ready-pro' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

  
        $this->add_control(
			'comment_url',
			[
				'label' => esc_html__( 'Comment URL', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'element-ready-pro' ),
				'label_off' => esc_html__( 'Hide', 'element-ready-pro' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_control(
			'comment_cookie',
			[
				'label' => esc_html__( 'Comment Cookie', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'element-ready-pro' ),
				'label_off' => esc_html__( 'Hide', 'element-ready-pro' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_control(
            'comment_cookies_1',
            [
                'label' => esc_html__( 'Comment Cookie Desc', 'element-ready-pro' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Cookie line 1',
                'placeholder' => esc_html__( 'Type your cookie text', 'element-ready-pro' ),
                'condition' => [
                    'comment_cookie' => ['yes']
                ]
            ]
        );

        $this->add_control(
            'comment_cookies_2',
            [
                'label' => esc_html__( 'Cookie Privacy', 'element-ready-pro' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'privacy',
                'placeholder' => esc_html__( 'Type your cookie text', 'element-ready-pro' ),
                'condition' => [
                    'comment_cookie' => ['yes']
                ]
            ]
        );

        $this->add_control(
			'comment_before_note',
			[
				'label' => esc_html__( 'Comment Before Note', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'element-ready-pro' ),
				'label_off' => esc_html__( 'Hide', 'element-ready-pro' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_control(
            'comment_before_text',
            [
                'label' => esc_html__( 'Comment Before', 'element-ready-pro' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Registration not required',
                'placeholder' => esc_html__( 'Type your comment before text', 'element-ready-pro' ),
                'condition' => [
                    'comment_before_note' => ['yes']
                ]
            ]
        );
        
        $this->add_control(
			'comment_after_note',
			[
				'label' => esc_html__( 'Comment After Note', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'element-ready-pro' ),
				'label_off' => esc_html__( 'Hide', 'element-ready-pro' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_control(
            'comment_after_text',
            [
                'label' => esc_html__( 'Comment After Text', 'element-ready-pro' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Do not Spam',
                'placeholder' => esc_html__( 'Type your comment after text', 'element-ready-pro' ),
                'condition' => [
                    'comment_after_note' => ['yes']
                ]
            ]
        );

        $this->add_control(
			'submit_button_icon',
			[
				'label' => esc_html__( 'Icon', 'element-ready-pro' ),
				'type' => \Elementor\Controls_Manager::ICONS,
		
           ]
		);

        $this->add_control(
            'submit_button_text',
            [
                'label' => esc_html__( 'Submit button Text', 'element-ready-pro' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Submit',
                'placeholder' => esc_html__( 'Type your submit text', 'element-ready-pro' ),
                'condition' => [
                    'comment_after_note' => ['yes']
                ]
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'wready_content_form_field_section',
            [
                'label' => esc_html__( 'Form Field Order', 'element-ready-pro' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'comment_form_fld_textarea_order',
            [
                'label'      => __( 'Textarea Order', 'element-ready-pro' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min' => -50,
                        'max' => 50,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .qs__blog__comment_form_action .er-comment-area' => 'order: {{SIZE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'comment_form_fld_author_order',
            [
                'label'      => __( 'Email and Name Order', 'element-ready-pro' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min' => -50,
                        'max' => 50,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .qs__blog__comment_form_action .er-author-fld' => 'order: {{SIZE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'comment_form_fld_privacy_order',
            [
                'label'      => __( 'Cookie & Privacy Order', 'element-ready-pro' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min' => -50,
                        'max' => 50,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .qs__blog__comment_form_action .er-comment-cookie-privacy' => 'order: {{SIZE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'comment_form_fld_website_order',
            [
                'label'      => __( 'Website URL Order', 'element-ready-pro' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min' => -50,
                        'max' => 50,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .qs__blog__comment_form_action .er-comment-website' => 'order: {{SIZE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'comment_form_fld_button_order',
            [
                'label'      => __( 'Button', 'element-ready-pro' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min' => -50,
                        'max' => 50,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .qs__blog__comment_form_action .er-submit-button-area' => 'order: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'wready_content_cart_section',
            [
                'label' => esc_html__( 'Section Order', 'element-ready-pro' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

    


        $this->add_responsive_control(
            'order_comment_form',
            [
                'label'      => __( 'Comment Form Order', 'element-ready-pro' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min' => -50,
                        'max' => 50,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .qs__blog__comment__form' => 'order: {{SIZE}};',
                ],
            ]
        );

            $this->add_responsive_control(
                'order_comment_list',
                [
                    'label'      => __( 'Comment List Order', 'element-ready-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => -50,
                            'max' => 50,
                        ],
                    ],
                
                    'selectors' => [
                        '{{WRAPPER}} .qs__blog__comments__lists__area' => 'order: {{SIZE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'order_comment_header',
                [
                    'label'      => __( 'Comment Header Order', 'element-ready-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => -50,
                            'max' => 50,
                        ],
                    ],
                
                    'selectors' => [
                        '{{WRAPPER}} .qs__blog__comments__header' => 'order: {{SIZE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'order_comment_top_pagination',
                [
                    'label'      => __( 'Comment Top Pagination Order', 'element-ready-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => -50,
                            'max' => 50,
                        ],
                    ],
                
                    'selectors' => [
                        '{{WRAPPER}} .qs__blog__comments__pagination.er-top-cpage' => 'order: {{SIZE}};',
                    ],
                ]
            );

            
            $this->add_responsive_control(
                'order_comment_bottom_pagination',
                [
                    'label'      => __( 'Comment Bottom Pagination Order', 'element-ready-pro' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => -50,
                            'max' => 50,
                        ],
                    ],
                
                    'selectors' => [
                        '{{WRAPPER}} .qs__blog__comments__pagination.er-bottom-cpage' => 'order: {{SIZE}};',
                    ],
                ]
            );


        $this->end_controls_section();
        $this->start_controls_section(
            'element_ready_comment_list_style_section',
            [
                'label' => __( 'Comment List Container', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_er_comment_lists' => ['yes']
                ]
            ]
        );

            $this->add_responsive_control(
                'comment_list_box_padding',
                [
                    'label'      => __( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .qs__blog__comments__lists__area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'comment_list_nameas_box_margin',
                [
                    'label'      => __( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .qs__blog__comments__lists__area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name'     => 'comment_luishovber_content_box_background',
                    'label'    => __( 'Background', 'element-ready-pro' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '
                        {{WRAPPER}} .qs__blog__comments__lists__area
                    
                    ',
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'cpmment__box_shadow',
                    'selector' => '
                        {{WRAPPER}} .qs__blog__comments__lists__area
                    ',
                ]
            );


        $this->end_controls_section();

        $this->start_controls_section(
            'element_ready_comment_item_style_section',
            [
                'label' => __( 'Comment Item', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_er_comment_lists' => ['yes']
                ]
            ]
        );

      
        $this->add_responsive_control(
            'comment_itemnameas_box_padding',
            [
                'label'      => __( 'Padding', 'element-ready-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .qs__blog__comments__list .qs__post__comment__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'comment_item_nameas_box_margin',
            [
                'label'      => __( 'Margin', 'element-ready-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .qs__blog__comments__list .qs__post__comment__item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background:: get_type(),
            [
                'name'     => 'comment_item_box_background',
                'label'    => __( 'Background', 'element-ready-pro' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '
                    {{WRAPPER}} .qs__blog__comments__list .qs__post__comment__item
                
                ',
            ]
        );

  
        $this->add_group_control(
            Group_Control_Border:: get_type(),
            [
                'name'     => 'comment_item_box_border',
                'label'    => __( 'Border', 'element-ready-pro' ),
                'selector' => '
                    {{WRAPPER}} .qs__blog__comments__list .qs__post__comment__item
                  
                ',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'comment_item_box_border_radius',
            [
                'label'     => __( 'Border Radius', 'element-ready-pro' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .qs__blog__comments__list .qs__post__comment__item'   => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow:: get_type(),
            [
                'name'     => 'comment_item_box_shadow',
                'selector' => '
                    {{WRAPPER}} .qs__blog__comments__list .qs__post__comment__item

                ',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'element_ready_form_comment_listheading_style_section',
            [
                'label' => __( 'Comment List Heading', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'comment_list_heading_enable' => ['yes'],
                    'show_er_comment_lists' => ['yes']
                ]
            ]
        );

          

            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'comment_listehading_as_box_typography',
                    'selector' => '{{WRAPPER}} .qs__blog__comments__title',
                ]
            );

            $this->add_control(
                'comment_listheading_as_box_text_color',
                [
                    'label'     => __( 'Text Color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .qs__blog__comments__title' => 'color: {{VALUE}};',
                       
                    ],
                ]
            );

            $this->add_responsive_control(
                'comment_listheading_as_box_padding',
                [
                    'label'      => __( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .qs__blog__comments__header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'comment_listheading_as_box_margin',
                [
                    'label'      => __( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .qs__blog__comments__header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'element_ready_comment_author_lists_style_section',
            [
                'label' => __( 'Author name', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography:: get_type(),
            [
                'name'     => 'author_name_as_box_typography',
                'selector' => '{{WRAPPER}} .qs__post__comment__author__name',
                'label'     => __( 'Author Font', 'element-ready-pro' ),
            ]
        );

        $this->add_control(
            'author_name_box_text_color',
            [
                'label'     => __( 'Author Color', 'element-ready-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .qs__post__comment__author__name' => 'color: {{VALUE}};',
                   
                ],
            ]
        );
        
        $this->add_control(
            'author_name_label_box_text_color',
            [
                'label'     => __( 'Label Color', 'element-ready-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .qs__post__comment__screen__reader__text' => 'color: {{VALUE}};',
                   
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography:: get_type(),
            [
                'name'     => 'author_name_label_as_box_typography',
                'selector' => '{{WRAPPER}} .qs__post__comment__screen__reader__text',
                'label'     => __( 'Label Font', 'element-ready-pro' ),
            ]
        );

        $this->add_control(
            'author_name_box_hover_text_color',
            [
                'label'     => __( 'Hover Color', 'element-ready-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .qs__post__comment__author__name:hover' => 'color: {{VALUE}};',
                   
                ],
            ]
        );

        $this->add_responsive_control(
            'comment_author_nameas_box_padding',
            [
                'label'      => __( 'Padding', 'element-ready-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .qs__post__comment__author__name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'element_ready_comment_date_style_section',
            [
                'label' => __( 'Date', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography:: get_type(),
            [
                'name'     => 'author_date_as_box_typography',
                'selector' => '{{WRAPPER}} .qs__post__comment__meta__date a',
                'label'     => __( 'Font', 'element-ready-pro' ),
            ]
        );

        $this->add_control(
            'author_date_box_text_color',
            [
                'label'     => __( 'Author Color', 'element-ready-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .qs__post__comment__meta__date a' => 'color: {{VALUE}};',
                   
                ],
            ]
        );
    
        $this->add_control(
            'author_datebox_hover_text_color',
            [
                'label'     => __( 'Hover Color', 'element-ready-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .qs__post__comment__meta__date a:hover' => 'color: {{VALUE}};',
                   
                ],
            ]
        );

        $this->add_responsive_control(
            'comment_date_nameas_box_padding',
            [
                'label'      => __( 'Padding', 'element-ready-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .qs__post__comment__meta__date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'element_ready_comment_text_style_section',
            [
                'label' => __( 'Comment Text', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography:: get_type(),
            [
                'name'     => 'acomment_text_as_box_typography',
                'selector' => '{{WRAPPER}} .qs__post__comment__content p,{{WRAPPER}} .qs__post__comment__content',
                'label'     => __( 'Font', 'element-ready-pro' ),
            ]
        );

        $this->add_control(
            'comment_text_box_text_color',
            [
                'label'     => __( 'Color', 'element-ready-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .qs__post__comment__content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .qs__post__comment__content' => 'color: {{VALUE}};',
                   
                ],
            ]
        );
    
       
        $this->add_responsive_control(
            'comment_text_nameas_box_padding',
            [
                'label'      => __( 'Padding', 'element-ready-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .qs__post__comment__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'comment_text_nameas_box_margin',
            [
                'label'      => __( 'Margin', 'element-ready-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .qs__post__comment__content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'element_ready_comment_reply_style_section',
            [
                'label' => __( 'Comment Reply', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography:: get_type(),
            [
                'name'     => 'acomment_reply_as_box_typography',
                'selector' => '{{WRAPPER}} .qs__post__comment__reply a',
                'label'     => __( 'Font', 'element-ready-pro' ),
            ]
        );

        $this->add_control(
            'comment_reply_box_text_color',
            [
                'label'     => __( 'Color', 'element-ready-pro' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .qs__post__comment__reply a' => 'color: {{VALUE}};',
                   
                   
                ],
            ]
        );
    
       
        $this->add_responsive_control(
            'comment_reply_nameas_box_padding',
            [
                'label'      => __( 'Padding', 'element-ready-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .qs__post__comment__reply a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'comment_reply_nameas_box_margin',
            [
                'label'      => __( 'Margin', 'element-ready-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .qs__post__comment__reply' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'element_ready_form_heading_style_section',
            [
                'label' => __( 'Form Heading', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'ehading_as_box_typography',
                    'selector' => '{{WRAPPER}} .qs__blog__comment__comment__reply__title',
                ]
            );

            $this->add_control(
                'heading_as_box_text_color',
                [
                    'label'     => __( 'Text Color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .qs__blog__comment__comment__reply__title' => 'color: {{VALUE}};',
                       
                    ],
                ]
            );

            $this->add_control(
                'heading_as_box_hover_text_color',
                [
                    'label'     => __( 'Hover Color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .qs__blog__comment__comment__reply__title:hover' => 'color: {{VALUE}};',
                       
                    ],
                ]
            );

            $this->add_responsive_control(
                'heading_as_box_padding',
                [
                    'label'      => __( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .qs__blog__comment__comment__reply__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'heading_as_box_margin',
                [
                    'label'      => __( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .qs__blog__comment__form__title__header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

        $this->end_controls_section();


        $this->start_controls_section(
            'element_ready_form_login_as_style_section',
            [
                'label' => __( 'Login as', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'login_as_box_typography',
                    'selector' => '{{WRAPPER}} .qs__blog__comment__logged__in__as a',
                ]
            );

            $this->add_control(
                'login_as_box_text_color',
                [
                    'label'     => __( 'Text Color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .qs__blog__comment__logged__in__as a' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .qs__blog__comment__logged__in__as' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'login_as_box_hover_text_color',
                [
                    'label'     => __( 'Hover Color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .qs__blog__comment__logged__in__as a:hover' => 'color: {{VALUE}};',
                       
                    ],
                ]
            );

            $this->add_responsive_control(
                'login_as_box_padding',
                [
                    'label'      => __( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .qs__blog__comment__logged__in__as a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'login_as_box_margin',
                [
                    'label'      => __( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .qs__blog__comment__logged__in__as' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

        $this->end_controls_section();

   
        $this->start_controls_section(
            'element_ready_form_textarea_style_section',
            [
                'label' => __( 'Textarea', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'textarea_box_tabs' );
            $this->start_controls_tab(
                'textarea_box_normal_tab',
                [
                    'label' => __( 'Normal', 'element-ready-pro' ),
                ]
            );
                $this->add_responsive_control(
                    'textarea_box_height',
                    [
                        'label'      => __( 'Height', 'element-ready-pro' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => [ 'px' ],
                        'range'      => [
                            'px' => [
                                'max' => 500,
                            ],
                        ],
                        'default' => [
                            'size' => 150,
                        ],

                        'selectors' => [
                            '{{WRAPPER}} .qs__blog__comment__form__comment textarea' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'textarea_box_width',
                    [
                        'label'      => __( 'Width', 'element-ready-pro' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'range'      => [
                            'px' => [
                                'max' => 500,
                            ],
                            '%' => [
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .qs__blog__comment__form__comment textarea' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Typography:: get_type(),
                    [
                        'name'     => 'textarea_box_typography',
                        'selector' => '{{WRAPPER}} .qs__blog__comment__form__comment textarea',
                    ]
                );
                $this->add_control(
                    'textarea_box_text_color',
                    [
                        'label'     => __( 'Text Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .qs__blog__comment__form__comment textarea' => 'color: {{VALUE}};',
                        ],
                    ]
                );
                
                $this->add_control(
                    'textarea_box_placeholder_color',
                    [
                        'label'     => __( 'Placeholder Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .qs__blog__comment__form__comment textarea::-webkit-input-placeholder' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .qs__blog__comment__form__comment textarea::-moz-placeholder'          => 'color: {{VALUE}};',
                            '{{WRAPPER}} .qs__blog__comment__form__comment textarea:-ms-input-placeholder'      => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'     => 'textarea_box_background',
                        'label'    => __( 'Background', 'element-ready-pro' ),
                        'types'    => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .qs__blog__comment__form__comment textarea',
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border:: get_type(),
                    [
                        'name'     => 'textarea_box_border',
                        'label'    => __( 'Border', 'element-ready-pro' ),
                        'selector' => '{{WRAPPER}} .qs__blog__comment__form__comment textarea',
                    ]
                );
                $this->add_responsive_control(
                    'textarea_box_border_radius',
                    [
                        'label'     => __( 'Border Radius', 'element-ready-pro' ),
                        'type'      => Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            '{{WRAPPER}} .qs__blog__comment__form__comment textarea' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        ],
                        'separator' => 'before',
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow:: get_type(),
                    [
                        'name'     => 'textarea_box_shadow',
                        'selector' => '{{WRAPPER}} .qs__blog__comment__form__comment textarea',
                    ]
                );

                $this->add_responsive_control(
                    'textarea_box_padding',
                    [
                        'label'      => __( 'Padding', 'element-ready-pro' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors'  => [
                            '{{WRAPPER}} .qs__blog__comment__form__comment textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'separator' => 'before',
                    ]
                );

                $this->add_responsive_control(
                    'textarea_box_margin',
                    [
                        'label'      => __( 'Margin', 'element-ready-pro' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors'  => [
                            '{{WRAPPER}} .qs__blog__comment__form__comment textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'separator' => 'before',
                    ]
                );
                $this->add_control(
                    'textarea_box_transition',
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
                            '{{WRAPPER}} .qs__blog__comment__form__comment textarea' => 'transition: {{SIZE}}s;',
                        ],
                    ]
                );
            $this->end_controls_tab();
            $this->start_controls_tab(
                'textarea_box_hover_tabs',
                [
                    'label' => __( 'Focus', 'element-ready-pro' ),
                ]
            );
                $this->add_control(
                    'textarea_box_hover_color',
                    [
                        'label'     => __( 'Text Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .qs__blog__comment__form__comment textarea:focus' => 'color:{{VALUE}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'     => 'textarea_box_hover_backkground',
                        'label'    => __( 'Focus Background', 'element-ready-pro' ),
                        'types'    => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .qs__blog__comment__form__comment textarea:focus',
                    ]
                );
                $this->add_control(
                    'textarea_box_hover_border_color',
                    [
                        'label'     => __( 'Border Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .qs__blog__comment__form__comment textarea:focus' => 'border-color:{{VALUE}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow:: get_type(),
                    [
                        'name'     => 'textarea_box_hover_shadow',
                        'selector' => '{{WRAPPER}} .qs__blog__comment__form__comment textarea:focus',
                    ]
                );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*----------------------------
            TEXTAREA STYLE END
        -----------------------------*/
        
         /*---------------------------
            INPUT STYLE START
        ----------------------------*/
        $this->start_controls_section(
            'element_ready_form_input_style_section',
            [
                'label' => __( 'Button', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'button_input_box_tabs' );


                $this->start_controls_tab(
                    'input_box_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'input_box_typography',
                            'selector' => '
                                {{WRAPPER}} .qs__blog__comment__submit
                              
                            ',
                        ]
                    );

                    $this->add_control(
                        'input_box_text_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .qs__blog__comment__submit'   => 'color:{{VALUE}};',
                            
                            ],
                        ]
                    );

                    $this->add_control(
                        'submitin_box_icon_color',
                        [
                            'label'     => __( 'Icon Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .qs__blog__comment__submit i'   => 'color:{{VALUE}};',
                                '{{WRAPPER}} .qs__blog__comment__submit svg path'   => 'fill:{{VALUE}};',
                            
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'icon_padding_box_padding',
                        [
                            'label'      => __( 'Icon Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .qs__blog__comment__submit i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .qs__blog__comment__submit svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'input_box_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '
                                {{WRAPPER}} .qs__blog__comment__submit
                            
                            ',
                        ]
                    );
  
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'input_box_shadow',
                            'selector' => '
                                {{WRAPPER}} .qs__blog__comment__submit

                            ',
                        ]
                    );

                    
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'input_box_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '
                                {{WRAPPER}} .qs__blog__comment__submit
                              
                            ',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'input_box_border_radius',
                        [
                            'label'     => __( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .qs__blog__comment__submit'   => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_control(
                        'input_box_transition',
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
                                'size' => 0.6,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .qs__blog__comment__submit'   => 'transition: {{SIZE}}s;',
                               
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'submit_button_padding_box_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .qs__blog__comment__submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'submit_button_margin_box_margin',
                        [
                            'label'      => __( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .qs__blog__comment__submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                
                            ],
                            'separator' => 'before',
                        ]
                    );


                $this->end_controls_tab();
    
                $this->start_controls_tab(
                    'input_box_hover_tabs',
                    [
                        'label' => __( 'Hover', 'element-ready-pro' ),
                    ]
                );

                    $this->add_control(
                        'input_box_hover_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .qs__blog__comment__submit:hover'   => 'color:{{VALUE}};',
                            
                            ],
                        ]
                    );

                    $this->add_control(
                        'input_box_icon_hover_color',
                        [
                            'label'     => __( 'Icon Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .qs__blog__comment__submit:hover i'   => 'color:{{VALUE}};',
                                '{{WRAPPER}} .qs__blog__comment__submit:hover svg path'   => 'fill:{{VALUE}};',
                            
                            ],
                        ]
                    );
                    
                    
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'input_box_hover_backkground',
                            'label'    => __( 'Focus Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '
                                {{WRAPPER}} .qs__blog__comment__submit:hover
                            
                            ',
                        ]
                    );

                    $this->add_control(
                        'input_box_hover_border_color',
                        [
                            'label'     => __( 'Border Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .qs__blog__comment__submit:hover'   => 'border-color:{{VALUE}};',
                            
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name'     => 'input_box_hover_shadow',
                            'selector' => '
                                {{WRAPPER}} .qs__blog__comment__submit:hover,
                        
                            ',
                        ]
                    );

                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*-----------------------------
            INPUT STYLE END
        -------------------------------*/

         /*---------------------------
            INPUT CHECKBOX / RADIO STYLE 
        ----------------------------*/
        $this->start_controls_section(
            'element_ready_form_input_readio_style_section',
            [
                'label' => __( 'Input Radio / Checkbox', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'comment_cookie' => ['yes']
                ]
            ]
        );
            $this->start_controls_tabs( 'input_radio_checkbox_tabs' );
                $this->start_controls_tab(
                    'input_radio_checkbox_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );

                    $this->add_responsive_control(
                        'input_radio_checkbox__display',
                        [
                            'label'   => __( 'Display', 'element-ready-pro' ),
                            'type'    => Controls_Manager::SELECT,
                            'default' => 'inline-block',
                            
                            'options' => [
                                'initial'      => __( 'Initial', 'element-ready-pro' ),
                                'block'        => __( 'Block', 'element-ready-pro' ),
                                'inline-block' => __( 'Inline Block', 'element-ready-pro' ),
                                'flex'         => __( 'Flex', 'element-ready-pro' ),
                                'inline-flex'  => __( 'Inline Flex', 'element-ready-pro' ),
                                'none'         => __( 'none', 'element-ready-pro' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .qs-privacy_cookie_wrapper' => 'display: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'input_radio_checkbox_typography',
                            'selector' => '
                                {{WRAPPER}}.qs-privacy_cookie_wrapper a,
                                {{WRAPPER}} .qs-privacy_cookie_wrapper span
                            ',
                        ]
                    );
                    
                    $this->add_control(
                        'input_radio_checkbox_text_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .qs-privacy_cookie_wrapper' => 'color:{{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'input_radio_checkbox_link_color',
                        [
                            'label'     => __( 'Link Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .qs-privacy_cookie_wrapper a' => 'color:{{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'input_radio_checkbox_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '
                                {{WRAPPER}} .qs-privacy_cookie_wrapper .qs__blog__comment_cookies
                            ',
                        ]
                    );
                    $this->add_responsive_control(
                        'input_radio_checkbox_height',
                        [
                            'label'      => __( 'Height', 'element-ready-pro' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'max' => 150,
                                ],
                            ],
                            'default' => [
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .qs-privacy_cookie_wrapper .qs__blog__comment_cookies' => 'height:{{SIZE}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'input_radio_checkbox_width',
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
                                'unit' => '%',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .qs-privacy_cookie_wrapper .qs__blog__comment_cookies' => 'width:{{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'input_radio_checkbox_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '
                                {{WRAPPER}} .qs-privacy_cookie_wrapper .qs__blog__comment_cookies
                            ',
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'input_radio_checkbox_border_radius',
                        [
                            'label'     => __( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .qs-privacy_cookie_wrapper .qs__blog__comment_cookies' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'input_radio_checkbox_shadow',
                            'selector' => '
                                {{WRAPPER}} .qs-privacy_cookie_wrapper .qs__blog__comment_cookies
                            ',
                        ]
                    );
                    $this->add_responsive_control(
                        'input_radio_checkbox_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .qs-privacy_cookie_wrapper .qs__blog__comment_cookies' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'input_radio_checkbox_margin',
                        [
                            'label'      => __( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .qs-privacy_cookie_wrapper .qs__blog__comment_cookies' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_control(
                        'input_radio_checkbox_transition',
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
                                '{{WRAPPER}} .qs-privacy_cookie_wrapper .qs__blog__comment_cookies' => 'transition: {{SIZE}}s;',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'input_radio_checkbox_hover_tabs',
                    [
                        'label' => __( 'Focus', 'element-ready-pro' ),
                    ]
                );
                $this->add_control(
                    'input_radio_checkbox_hover_color',
                    [
                        'label'     => __( 'Text Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .qs-privacy_cookie_wrapper .qs__blog__comment_cookies:focus' => 'color:{{VALUE}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'     => 'input_radio_checkbox_hover_backkground',
                        'label'    => __( 'Focus Background', 'element-ready-pro' ),
                        'types'    => [ 'classic', 'gradient' ],
                        'selector' => '
                            {{WRAPPER}} .qs-privacy_cookie_wrapper .qs__blog__comment_cookies:focus
                        ',
                    ]
                );
                $this->add_control(
                    'input_radio_checkbox_hover_border_color',
                    [
                        'label'     => __( 'Border Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .qs-privacy_cookie_wrapper .qs__blog__comment_cookies:focus' => 'border-color:{{VALUE}};'
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow:: get_type(),
                    [
                        'name'     => 'input_radio_checkbox_hover_shadow',
                        'selector' => '
                            {{WRAPPER}} .qs-privacy_cookie_wrapper .qs__blog__comment_cookies:focus
                        ',
                    ]
                );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*-----------------------------
            INPUT CHECKBOX / RADIO STYLE  END
        -------------------------------*/
        /*---------------------------
           Author name INPUT STYLE START
        ----------------------------*/
        $this->start_controls_section(
            'element_ready_form_auth_name_input_style_section',
            [
                'label' => __( 'Author Name Input', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'name_input_box_tabs' );
                $this->start_controls_tab(
                    'form__authorinput_box_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'form__authorinput_box_typography',
                            'selector' => '
                                {{WRAPPER}} .qs__blog__comment__comment__form__author input
                              
                            ',
                        ]
                    );
                    $this->add_control(
                        'form__authorinput_box_text_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .qs__blog__comment__comment__form__author input'   => 'color:{{VALUE}};',

                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'form__authorinput_box_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '
                                {{WRAPPER}} .qs__blog__comment__comment__form__author input

                            ',
                        ]
                    );
                    $this->add_control(
                        'form__authorinput_box_placeholder_color',
                        [
                            'label'     => __( 'Placeholder Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .qs__blog__comment__comment__form__author input::-webkit-input-placeholder'   => 'color: {{VALUE}};',
                             
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'form__authorinput_box_height',
                        [
                            'label'      => __( 'Height', 'element-ready-pro' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'max' => 150,
                                ],
                            ],
                            'default' => [
                                'size' => 55,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .qs__blog__comment__comment__form__author input'   => 'height:{{SIZE}}{{UNIT}};',
                               
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'form__authorinput_box_width',
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
                                'unit' => '%',
                                'size' => 100,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .qs__blog__comment__comment__form__author input'   => 'width:{{SIZE}}{{UNIT}};',
                                
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'form__authorinput_box_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '
                                {{WRAPPER}} .qs__blog__comment__comment__form__author input
                           
                            ',
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'form__authorinput_box_border_radius',
                        [
                            'label'     => __( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .qs__blog__comment__comment__form__author input'   => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;'
                               
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'form__authorinput_box_shadow',
                            'selector' => '
                                {{WRAPPER}} .qs__blog__comment__comment__form__author input
                             
                            ',
                        ]
                    );
                    $this->add_responsive_control(
                        'form__authorinput_box_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .qs__blog__comment__comment__form__author input'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                             
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'form__authorinput_box_margin',
                        [
                            'label'      => __( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .qs__blog__comment__comment__form__author input'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                               
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_control(
                        'form__authorinput_box_transition',
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
                                '{{WRAPPER}} .qs__blog__comment__comment__form__author input'   => 'transition: {{SIZE}}s;',
                               
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'form__authorinput_box_hover_tabs',
                    [
                        'label' => __( 'Focus', 'element-ready-pro' ),
                    ]
                );
                $this->add_control(
                    'form__authorinput_box_hover_color',
                    [
                        'label'     => __( 'Text Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                           
                            '{{WRAPPER}} .qs__blog__comment__comment__form__author input:focus'   => 'color:{{VALUE}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'     => 'form__authorinput_box_hover_backkground',
                        'label'    => __( 'Focus Background', 'element-ready-pro' ),
                        'types'    => [ 'classic', 'gradient' ],
                        'selector' => '
                        {{WRAPPER}} .qs__blog__comment__comment__form__author input:focus
                         
                        ',
                    ]
                );
                $this->add_control(
                    'form__authorinput_box_hover_border_color',
                    [
                        'label'     => __( 'Border Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .qs__blog__comment__comment__form__author input:focus'   => 'border-color:{{VALUE}};',

                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow:: get_type(),
                    [
                        'name'     => 'form__authorinput_box_hover_shadow',
                        'selector' => '
                            {{WRAPPER}} .qs__blog__comment__comment__form__author input:focus
                           
                        ',
                    ]
                );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*-----------------------------
            INPUT STYLE END
        -------------------------------*/

          /*---------------------------
           Author name INPUT STYLE START
        ----------------------------*/
        $this->start_controls_section(
            'element_ready_form_auth_email_input_style_section',
            [
                'label' => __( 'Author Email Input', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'email_input_box_tabs' );
                $this->start_controls_tab(
                    'email_input_box_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'email_input_box_typography',
                            'selector' => '
                                {{WRAPPER}} .qs__blog__comment__comment__form__email input
                              
                            ',
                        ]
                    );
                    $this->add_control(
                        'email_input_box_text_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .qs__blog__comment__comment__form__email input'   => 'color:{{VALUE}};',

                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'email_input_box_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '
                                {{WRAPPER}} .qs__blog__comment__comment__form__email input

                            ',
                        ]
                    );
                    $this->add_control(
                        'email_input_box_placeholder_color',
                        [
                            'label'     => __( 'Placeholder Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .qs__blog__comment__comment__form__email input::-webkit-input-placeholder'   => 'color: {{VALUE}};',
                             
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'email_input_box_height',
                        [
                            'label'      => __( 'Height', 'element-ready-pro' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'max' => 150,
                                ],
                            ],
                            'default' => [
                                'size' => 55,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .qs__blog__comment__comment__form__email input'   => 'height:{{SIZE}}{{UNIT}};',
                               
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'email_input_box_width',
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
                                'unit' => '%',
                                'size' => 100,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .qs__blog__comment__comment__form__email input'   => 'width:{{SIZE}}{{UNIT}};',
                                
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'email_input_box_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '
                                {{WRAPPER}} .qs__blog__comment__comment__form__email input
                           
                            ',
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'email_input_box_border_radius',
                        [
                            'label'     => __( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .qs__blog__comment__comment__form__email input'   => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;'
                               
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'email_input_box_shadow',
                            'selector' => '
                                {{WRAPPER}} .qs__blog__comment__comment__form__email input
                             
                            ',
                        ]
                    );
                    $this->add_responsive_control(
                        'email_input_box_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .qs__blog__comment__comment__form__email input'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                             
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'email_input_box_margin',
                        [
                            'label'      => __( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .qs__blog__comment__comment__form__email input'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                               
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_control(
                        'email_input_box_transition',
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
                                '{{WRAPPER}} .qs__blog__comment__comment__form__email input'   => 'transition: {{SIZE}}s;',
                               
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'email_input_box_hover_tabs',
                    [
                        'label' => __( 'Focus', 'element-ready-pro' ),
                    ]
                );
                $this->add_control(
                    'email_input_box_hover_color',
                    [
                        'label'     => __( 'Text Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                           
                            '{{WRAPPER}} .qs__blog__comment__comment__form__email input:focus'   => 'color:{{VALUE}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'     => 'email_input_box_hover_backkground',
                        'label'    => __( 'Focus Background', 'element-ready-pro' ),
                        'types'    => [ 'classic', 'gradient' ],
                        'selector' => '
                        {{WRAPPER}} .qs__blog__comment__comment__form__email input:focus
                         
                        ',
                    ]
                );

                $this->add_control(
                    'email_input_box_hover_border_color',
                    [
                        'label'     => __( 'Border Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .qs__blog__comment__comment__form__email input:focus'   => 'border-color:{{VALUE}};',

                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow:: get_type(),
                    [
                        'name'     => 'email_input_box_hover_shadow',
                        'selector' => '
                            {{WRAPPER}} .qs__blog__comment__comment__form__email input:focus
                           
                        ',
                    ]
                );

                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*-----------------------------
            INPUT STYLE END
        -------------------------------*/

              /*---------------------------
           Author name INPUT STYLE START
        ----------------------------*/
        $this->start_controls_section(
            'element_ready_form_auth_website_input_style_section',
            [
                'label' => __( 'Website Input', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'comment_url' => ['yes']
                ]
            ]
        );
            $this->start_controls_tabs( 'website_input_box_tabs' );
                $this->start_controls_tab(
                    'website_input_box_normal_tab',
                    [
                        'label' => __( 'Normal', 'element-ready-pro' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'website_input_box_typography',
                            'selector' => '
                                {{WRAPPER}} .qs__blog__comment__comment__form__url input
                              
                            ',
                        ]
                    );
                    $this->add_control(
                        'website_input_box_text_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .qs__blog__comment__comment__form__url input'   => 'color:{{VALUE}};',

                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'website_input_box_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '
                                {{WRAPPER}} .qs__blog__comment__comment__form__url input

                            ',
                        ]
                    );
                    $this->add_control(
                        'website_input_box_placeholder_color',
                        [
                            'label'     => __( 'Placeholder Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .qs__blog__comment__comment__form__url input::-webkit-input-placeholder'   => 'color: {{VALUE}};',
                             
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'website_input_box_height',
                        [
                            'label'      => __( 'Height', 'element-ready-pro' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'max' => 150,
                                ],
                            ],
                            'default' => [
                                'size' => 55,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .qs__blog__comment__comment__form__url input'   => 'height:{{SIZE}}{{UNIT}};',
                               
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'website_input_box_width',
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
                                'unit' => '%',
                                'size' => 100,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .qs__blog__comment__comment__form__url input'   => 'width:{{SIZE}}{{UNIT}};',
                                
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'website_input_box_border',
                            'label'    => __( 'Border', 'element-ready-pro' ),
                            'selector' => '
                                {{WRAPPER}} .qs__blog__comment__comment__form__url input
                           
                            ',
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'website_input_box_border_radius',
                        [
                            'label'     => __( 'Border Radius', 'element-ready-pro' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .qs__blog__comment__comment__form__url input'   => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;'
                               
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'website_input_box_shadow',
                            'selector' => '
                                {{WRAPPER}} .qs__blog__comment__comment__form__url input
                             
                            ',
                        ]
                    );
                    $this->add_responsive_control(
                        'website_input_box_padding',
                        [
                            'label'      => __( 'Padding', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .qs__blog__comment__comment__form__url input'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                             
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'website_input_box_margin',
                        [
                            'label'      => __( 'Margin', 'element-ready-pro' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .qs__blog__comment__comment__form__url input'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                               
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_control(
                        'website_input_box_transition',
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
                                '{{WRAPPER}} .qs__blog__comment__comment__form__url input'   => 'transition: {{SIZE}}s;',
                               
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'website_input_box_hover_tabs',
                    [
                        'label' => __( 'Focus', 'element-ready-pro' ),
                    ]
                );
                $this->add_control(
                    'website_input_box_hover_color',
                    [
                        'label'     => __( 'Text Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                           
                            '{{WRAPPER}} .qs__blog__comment__comment__form__url input:focus'   => 'color:{{VALUE}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'     => 'website_input_box_hover_backkground',
                        'label'    => __( 'Focus Background', 'element-ready-pro' ),
                        'types'    => [ 'classic', 'gradient' ],
                        'selector' => '
                        {{WRAPPER}} .qs__blog__comment__comment__form__url input:focus
                         
                        ',
                    ]
                );

                $this->add_control(
                    'website_input_box_hover_border_color',
                    [
                        'label'     => __( 'Border Color', 'element-ready-pro' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .qs__blog__comment__comment__form__url input:focus'   => 'border-color:{{VALUE}};',

                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow:: get_type(),
                    [
                        'name'     => 'website_input_box_hover_shadow',
                        'selector' => '
                            {{WRAPPER}} .qs__blog__comment__comment__form__url input:focus
                           
                        ',
                    ]
                );

                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();




    }

    protected function render() {
 
       $settings       = $this->get_settings();
       $post_id = get_the_id();
       if(\Elementor\Plugin::$instance->editor->is_edit_mode()){
        $post_id = $settings['post_id'];
        $GLOBALS['post'] = get_post($post_id);
       }
 
       if ( file_exists( dirname( __FILE__ ) . '/template-parts/comments/' . $settings['style'] . '.php' ) ) {

        include('template-parts/comments/'.$settings['style'] . '.php');  

        } else {

            include('template-parts/comments/style1.php');  

        }
    
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

    function _comments_pagination(){

        the_comments_pagination(array(
            'screen_reader_text' => ' ',
            'prev_text'          => '<i class="fas fa-chevron-left"></i>',
            'next_text'          => '<i class="fas fa-chevron-right"></i>',
            'type'               => 'list',
            'mid_size'           => 1,
            'class' => 'qs__blog__comments__pagination',
        ));

    }

    function _comment_form(){

        $settings       = $this->get_settings();
       
        // theme option panel 
        $comment_fld_cookie     = $settings['comment_cookie'] == 'yes' ? true : false;
        $comment_fld_url        = $settings['comment_url'] == 'yes' ? true : false;
        $comment_arg_be_note    = $settings['comment_before_note'] == 'yes' ? true : false;
        $comment_arg_after_note = $settings['comment_after_note'] == 'yes' ? true : false;
         
            //Declare Vars
        $comment_send      = $settings['submit_button_text'];
        $comment_reply     = $settings['comment_form_heading_text'];
        $comment_reply_to  = esc_html__('Reply','element-ready-pro');
        $comment_author    = esc_html__('Name','element-ready-pro');
        $comment_email     = esc_html__('E-Mail','element-ready-pro');
        $comment_body      = esc_html__('Comment','element-ready-pro');
        $comment_url       = esc_html__('Website','element-ready-pro');
        $comment_cookies_1 = $settings['comment_cookies_1'];
        $comment_cookies_2 = $settings['comment_cookies_2'];
        $comment_before    = $settings['comment_before_text'];
        $comment_after     = $settings['comment_after_text'];
        $comment_cancel    = esc_html__('Cancel Reply','element-ready-pro');
        $name_submit       = 'submit';
        
        //Array
        $comments_args = array(
            //Define Fields
            'fields' => array(
                //Author field
                'author' => '<div class="qs-comment-row row er-author-fld"><div class="qs-comment-col-6 col-6"> <div class="qs__blog__comment__comment__form__author"><input id="author" name="author" aria-required="true" placeholder="' . $comment_author .'"></input></div></div>',
                //Email Field
                'email' => '<div class="qs-comment-col-6 col-6"><div class="qs__blog__comment__comment__form__email"><input id="email" name="email" placeholder="' . $comment_email .'"></input></div></div></div>',
                
            ),
            // Change the title of send button
            'label_submit' => $comment_send,
            // Change the title of the reply section
            'title_reply'        => $comment_reply,
            'title_reply_before' => '<div class="qs__blog__comment__form__title__header"><h3 id="qs__blog__comment__comment__reply__title" class="qs__blog__comment__comment__reply__title">',
            'title_reply_after'  => '</h3></div>',
            // Change the title of the reply section
            'title_reply_to' => $comment_reply_to,
            //Cancel Reply Text
            'cancel_reply_link' => $comment_cancel,
            // Redefine your own textarea (the comment body).
            'comment_field' => '<div class="qs-comment-row row er-comment-area"><div class="qs-comment-col-12 col-12"><div class="qs__blog__comment__form__comment"><textarea rows="12" id="qs__blog__comment_textarea" name="comment" aria-required="true" placeholder="' . $comment_body .'"></textarea></div></div></div>',
            //Message Before Comment
            'comment_notes_before' => $comment_before,
            // Remove "Text or HTML to be displayed after the set of comment fields".
            'comment_notes_after' => $comment_after,
            //Submit Button ID
            'id_submit'       => 'qs__blog__comment__submit',
            'class_submit'    => 'qs__blog__comment__submit',
            'name_submit'     => $name_submit,
            'submit_button'   => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s' .element_ready_render_icons($settings['submit_button_icon'], 'submit-button-icon'). '</button>',
            'submit_field'    => '<div class="qs-comment-row row er-submit-button-area"><div class="qs-comment-col-12 col-12"><div class="qs__blog__comment__form__submit">%1$s %2$s</div></div></div>',
            'class_container' => 'qs__blog__comment_form_responds',
            'class_form'      => 'qs__blog__comment_form_action',
            'format'          => 'html5',
            
            
        );

        if($settings['comment_form_heading_enable'] !== 'yes'){
           
            $comments_args['title_reply'] = '';
            $comments_args['title_reply_before'] = false;
            $comments_args['title_reply_after']  = false;

        }
      
        if( is_user_logged_in() ){
            $user              = wp_get_current_user();
            $user_identity     = $user->exists() ? $user->display_name : '';
            $comments_args['logged_in_as'] = sprintf(
                '<div class="qs__blog__comment__logged__in__as">%s</div>',
                sprintf(
                    /* translators: 1: Edit user link, 2: Accessibility text, 3: User name, 4: Logout URL. */
                    __( '<a href="%1$s" aria-label="%2$s">Logged in as %3$s</a>. <a href="%4$s">Log out?</a>','element-ready-pro' ),
                    get_edit_user_link(),
                    /* translators: %s: User name. */
                    esc_attr( sprintf( __( 'Logged in as %s. Edit your profile.','element-ready-pro' ), $user_identity ) ),
                    $user_identity,
                    /** This filter is documented in wp-includes/link-template.php */
                    wp_logout_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ), get_the_ID() ) )
                )
                );
            
        }
    
        if( $comment_fld_cookie ){
             //Cookies
           $comments_args['fields']['cookies'] =  '<div class="qs-comment-row row er-comment-cookie-privacy"><div class="qs-comment-col-12 col-12"><div class="qs-privacy_cookie_wrapper"> <input class="qs__blog__comment_cookies" type="checkbox" required> <span>' . $comment_cookies_1 . '</span><a href="' . get_privacy_policy_url() . '">' . $comment_cookies_2 . '</a></div></div></div>';	
        }else{
            remove_action( 'set_comment_cookies', 'wp_set_comment_cookies' );
        }
        
        $comments_args['fields']['url'] = '<div class="qs-comment-row row er-comment-website"><div class="qs-comment-col-12 col-12"><div class="qs__blog__comment__comment__form__url"><input id="url" name="url" placeholder="' . $comment_url .'"></input></div></div></div>';	
        if( !$comment_fld_url ){
            $comments_args['fields']['url'] = '';	
        }
    
        if( !$comment_arg_be_note ){
            $comments_args['comment_notes_before'] = '';
        }
        if(!$comment_arg_after_note){
            $comments_args['comment_notes_after'] = '';
        }

      
        comment_form( $comments_args );
    }

 

}