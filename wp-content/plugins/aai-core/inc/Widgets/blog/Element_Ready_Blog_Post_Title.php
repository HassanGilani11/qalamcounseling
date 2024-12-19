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
class Element_Ready_Blog_Post_Title extends Widget_Base {

    public function get_name() {
        return 'element-ready-pro-blog-post-title';
    }
    public function get_keywords() {
		return ['post name','post title'];
	}
    public function get_title() {
        return esc_html__( 'ER Post Title', 'element-ready-pro' );
    }

    public function get_icon() { 
        return 'eicon-editor-h3';
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
      
        $this->add_control(
        'heading_type',
            [
                'label'   => esc_html__( 'Heading type', 'newsprk-essential' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'h5',
                'options' => [
                    'h1' => esc_html__( 'H1', 'newsprk-essential' ),
                    'h2' => esc_html__( 'H2', 'newsprk-essential' ),
                    'h3' => esc_html__( 'H3', 'newsprk-essential' ),
                    'h4' => esc_html__( 'H4', 'newsprk-essential' ),
                    'h5' => esc_html__( 'H5', 'newsprk-essential' ),
                    'h6' => esc_html__( 'H6', 'newsprk-essential' ),
                    'p'  => esc_html__( 'P', 'newsprk-essential' ),
                ],
            ]
        );
     
        $this->add_responsive_control(
			'title_align', [
				'label'   => esc_html__( 'Alignment', 'newsprk-essential' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [

               'left'		 => [
                  
                  'title' => esc_html__( 'Left', 'newsprk-essential' ),
                  'icon'  => 'eicon-text-align-left',
               
               ],
				'center'	     => [
                  
                  'title' => esc_html__( 'Center', 'newsprk-essential' ),
                  'icon'  => 'eicon-text-align-center',
               
               ],
			   'right'	 => [

						'title' => esc_html__( 'Right', 'newsprk-essential' ),
						'icon'  => 'eicon-text-align-right',
                  
					],
				'justify'	 => [

						'title' => esc_html__( 'Justified', 'newsprk-essential' ),
						'icon'  => 'eicon-text-align-justify',
                  
					],
				],
               'default' => 'left',
            
                'selectors' => [
                     '{{WRAPPER}} .er-post-header' => 'text-align: {{VALUE}};',

				],
			]
        );//Responsive control end

        $this->end_controls_section();
   
        
         /*---------------------------
            INPUT STYLE START
        ----------------------------*/
        $this->start_controls_section(
            'element_ready_form_input_style_section',
            [
                'label' => __( 'Title', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'input_box_tabs' );

           

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
                                {{WRAPPER}} .er-post-header .er-title
                              
                            ',
                        ]
                    );
                    $this->add_control(
                        'input_box_text_color',
                        [
                            'label'     => __( 'Text Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .er-post-header .er-title'   => 'color:{{VALUE}};',
                            
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'input_box_background',
                            'label'    => __( 'Background', 'element-ready-pro' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '
                                {{WRAPPER}} .er-post-header .er-title
                            
                            ',
                        ]
                    );
  
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'input_box_shadow',
                            'selector' => '
                                {{WRAPPER}} .er-post-header .er-title

                            ',
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
                                'size' => 0.3,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .er-post-header .er-title'   => 'transition: {{SIZE}}s;',
                               
                            ],
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
                                '{{WRAPPER}} .er-post-header .er-title:hover'   => 'color:{{VALUE}};',
                            
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
                                {{WRAPPER}} .er-post-header .er-title:hover
                            
                            ',
                        ]
                    );

                    $this->add_control(
                        'input_box_hover_border_color',
                        [
                            'label'     => __( 'Border Color', 'element-ready-pro' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .er-post-header .er-title:hover'   => 'border-color:{{VALUE}};',
                            
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name'     => 'input_box_hover_shadow',
                            'selector' => '
                                {{WRAPPER}} .er-post-header .er-title:hover,
                        
                            ',
                        ]
                    );

                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*-----------------------------
            INPUT STYLE END
        -------------------------------*/

    }

    protected function render() {
 
       $settings       = $this->get_settings();
       $heading_type = $settings['heading_type'];

       if(\Elementor\Plugin::$instance->editor->is_edit_mode()){
        $post_id = $settings['post_id'];
        $GLOBALS['post'] = get_post($post_id);
       }
    ?>
    <div class="er-post-header"> 
      <<?php echo $heading_type; ?> class="er-title"><?php echo wp_kses_post( get_the_title() ); ?> </<?php echo $heading_type; ?>>
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