<?php 
namespace Element_Ready_Pro\Base\Sections;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Element_Base;
use \Element_Ready\Controls\Custom_Controls_Manager;


class Image_Masking {

    use \Element_Ready_Pro\Base\Traits\Helper;
    public function register(){
        
        
        if( $this->element_ready_get_modules_option('image_masking') ) { 

            add_action( 'elementor/element/Element_Ready_Flip_Box_Widget/content_section/after_section_end', [ $this, 'add_controls_section' ] ,12, 2);
            add_action( 'elementor/element/Element_Ready_Teams_Widget/content_section/after_section_end', [ $this, 'add_controls_section' ] ,12, 2);
            add_action( 'elementor/element/image/section_image/after_section_end', [ $this, 'add_controls_section' ] ,12, 2);
            add_action( 'elementor/element/image-box/section_image/after_section_end', [ $this, 'add_controls_section' ] ,12, 2);
            add_action( 'elementor/element/Element_Ready_Testmonial_Widget/content_section/after_section_end', [ $this, 'add_controls_section' ] ,12, 2);
            add_action( 'elementor/element/Element_Ready_Box_Widget/content_section/after_section_end', [ $this, 'add_controls_section' ] ,12, 2);
            add_action( 'elementor/element/element-ready-grid-post/element-ready-grid-post_MetaIconsContent_content_section/after_section_end', [ $this, 'add_controls_section' ] ,12, 2);
            add_action( 'elementor/element/Element_Ready_Portfolio/post_content_option/after_section_end', [ $this, 'add_controls_section' ] ,12, 2);
            add_action( 'elementor/element/element-ready-lp-course-category/section_tab/after_section_end', [ $this, 'add_controls_section' ] ,12, 2);
            add_action( 'elementor/element/element-ready-grid-course/tab-options/after_section_end', [ $this, 'add_controls_section' ] ,12, 2);
            add_action( 'elementor/element/Element_Ready_Give_Campains_Widget/post_carousel_content/after_section_end', [ $this, 'add_controls_section' ] ,12, 2);
            add_action( 'elementor/element/Element_Ready_Multi_Gallery_Widget/content_section/after_section_end', [ $this, 'add_controls_section' ] ,12, 2);
            
       }
    }

   

    public function add_controls_section( $element, $args ){
      
      
        $element->start_controls_section(
            'element_ready_widget_image_masking_section',
            [
                
                'label' => esc_html__( 'Image Masking', 'element-ready-pro' ),
            ]
          );

              $element->add_control(
                  'element_ready_pro_image_masking_active',
                  [
                      'label'        => esc_html__('Enable', 'element-ready-pro'),
                      'type'         => Controls_Manager::SWITCHER,
                      'default'      => '',
                      'return_value' => 'yes',
                  
                  ]
              );

              $element->add_control(
                'mask_shape',
                [
                    'label' => esc_html__( 'Shapes', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'default',
                    'options' => [
                        'default' => esc_html__( 'Default', 'element-ready-pro' ),
                        'custom'  => esc_html__( 'custom', 'element-ready-pro' ),
                    ],
                    'condition'    => [
                        'element_ready_pro_image_masking_active' => ['yes']
                    ]
                ]
            );
            
            $element->add_control(
                'mask_shape_default',
                [
                    'label' => esc_html__( 'Default Shapes', 'element-ready-pro' ),
                    'type' => Custom_Controls_Manager::RADIOIMAGE,
                    'default' => '',
                    'options' => $this->masking_image_shapes(),
                    'selectors' => [
                        '{{WRAPPER}}.elementor-widget-image .elementor-widget-container > img' => '-webkit-mask-image: url({{VALUE}}); mask-image: url({{VALUE}});',
                        '{{WRAPPER}} .elementor-image-box-img' => '-webkit-mask-image: url({{VALUE}}); mask-image: url({{VALUE}});',
                        '{{WRAPPER}} .elementor-image' => '-webkit-mask-image: url({{VALUE}}); mask-image: url({{VALUE}});',
                        '{{WRAPPER}} .elementor-widget-image .elementor-widget-container' => '-webkit-mask-image: url({{VALUE}}); mask-image: url({{VALUE}});',
                        '{{WRAPPER}} .member__thumb' => '-webkit-mask-image: url({{VALUE}}); mask-image: url({{VALUE}});',
                        '{{WRAPPER}} .author__thumb' => '-webkit-mask-image: url({{VALUE}}); mask-image: url({{VALUE}});',
                        '{{WRAPPER}} .box__big__thumb' => '-webkit-mask-image: url({{VALUE}}); mask-image: url({{VALUE.}});',
                        '{{WRAPPER}} .flip__front__big__thumb' => '-webkit-mask-image: url({{VALUE}}); mask-image: url({{VALUE}});',
                        '{{WRAPPER}} .element-ready-trending-news-thumb' => '-webkit-mask-image: url({{VALUE}}); mask-image: url({{VALUE}});',
                        '{{WRAPPER}} .portfolio__thumb' => '-webkit-mask-image: url({{VALUE}}); mask-image: url({{VALUE}});',
                        '{{WRAPPER}} .element-ready-lp-course-thumb' => '-webkit-mask-image: url({{VALUE}}); mask-image: url({{VALUE}});',
                        '{{WRAPPER}} .front .fcf-thumb' => '-webkit-mask-image: url({{VALUE}}); mask-image: url({{VALUE}});',
                        '{{WRAPPER}} .sldier-content-area .post__thumb' => '-webkit-mask-image: url({{VALUE}}); mask-image: url({{VALUE}});',
                        '{{WRAPPER}} .gallery__item__thumbnail' => '-webkit-mask-image: url({{VALUE}}); mask-image: url({{VALUE}});',
                    ],
                    'condition'    => [
                        'element_ready_pro_image_masking_active' => ['yes'],
                        'mask_shape' => 'default',
                    ]
                ]
            );
        
    
            $element->add_control(
                'mask_shape_custom',
                [
                    'label' => esc_html__( 'Choose Shape', 'element-ready-pro' ),
                    'type' => Controls_Manager::MEDIA,
                    'show_label' => false,
                    'selectors' => [
                        '{{WRAPPER}}.elementor-widget-image .elementor-widget-container > img' => '-webkit-mask-image: url({{URL}}); mask-image: url({{URL}});',
                        '{{WRAPPER}} .elementor-image-box-img' => '-webkit-mask-image: url({{URL}}); mask-image: url({{URL}});',
                        '{{WRAPPER}} .elementor-image' => '-webkit-mask-image: url({{URL}}); mask-image: url({{URL}});',
                        '{{WRAPPER}} .elementor-widget-image .elementor-widget-container' => '-webkit-mask-image: url({{URL}}); mask-image: url({{URL}});',
                        '{{WRAPPER}} .member__thumb' => '-webkit-mask-image: url({{URL}}); mask-image: url({{URL}});',
                        '{{WRAPPER}} .author__thumb' => '-webkit-mask-image: url({{URL}}); mask-image: url({{URL}});',
                        '{{WRAPPER}} .box__big__thumb' => '-webkit-mask-image: url({{URL}}); mask-image: url({{URL}});',
                        '{{WRAPPER}} .flip__front__big__thumb' => '-webkit-mask-image: url({{URL}}); mask-image: url({{URL}});',
                        '{{WRAPPER}} .element-ready-trending-news-thumb' => '-webkit-mask-image: url({{URL}}); mask-image: url({{URL}});',
                        '{{WRAPPER}} .portfolio__thumb' => '-webkit-mask-image: url({{URL}}); mask-image: url({{URL}});',
                        '{{WRAPPER}} .element-ready-lp-course-thumb' => '-webkit-mask-image: url({{URL}}); mask-image: url({{URL}});',
                        '{{WRAPPER}} .front .fcf-thumb' => '-webkit-mask-image: url({{URL}}); mask-image: url({{URL}});',
                        '{{WRAPPER}} .sldier-content-area .post__thumb' => '-webkit-mask-image: url({{URL}}); mask-image: url({{URL}});',
                        '{{WRAPPER}} .gallery__item__thumbnail' => '-webkit-mask-image: url({{URL}}); mask-image: url({{URL}});',
                    ],
                    'condition' => [
                        'mask_shape' => 'custom',
                       
                    ],
                   
                    
                ]
            );
         
    
         
            $element->add_control(
                'mask_position',
                [
                    'label' => esc_html__( 'Position', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'default',
                    'options' => [
                        'center'        => esc_html__( 'Center', 'element-ready-pro' ),
				   		'center center' => esc_html__( 'Center Center', 'element-ready-pro' ),
				   		'center left'   => esc_html__( 'Center Left', 'element-ready-pro' ),
				   		'center right'  => esc_html__( 'Center Right', 'element-ready-pro' ),
				   		'right'         => esc_html__( 'Right', 'element-ready-pro' ),
				   		'top'           => esc_html__( 'Top', 'element-ready-pro' ),
				   		'top center'    => esc_html__( 'Top Center', 'element-ready-pro' ),
				   		'top left'      => esc_html__( 'Top Left', 'element-ready-pro' ),
				   		'top right'     => esc_html__( 'Top Right', 'element-ready-pro' ),
				   		'bottom'        => esc_html__( 'Bottom', 'element-ready-pro' ),
				   		'bottom center' => esc_html__( 'Bottom Center', 'element-ready-pro' ),
				   		'bottom left'   => esc_html__( 'Bottom Left', 'element-ready-pro' ),
				   		'left'          => esc_html__( 'Left', 'element-ready-pro' ),
				   		'bottom right'  => esc_html__( 'Bottom Right', 'element-ready-pro' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}}.elementor-widget-image .elementor-widget-container > img' => ' -webkit-mask-position: {{VALUE}}; mask-position: {{VALUE}};',
                        '{{WRAPPER}} .elementor-image-box-img' => ' -webkit-mask-position: {{VALUE}}; mask-position: {{VALUE}};',
                        '{{WRAPPER}} .elementor-image' => ' -webkit-mask-position: {{VALUE}}; mask-position: {{VALUE}};',
                        '{{WRAPPER}} .elementor-widget-image .elementor-widget-container' => ' -webkit-mask-position: {{VALUE}}; mask-position: {{VALUE}};',
                        '{{WRAPPER}} .member__thumb' => ' -webkit-mask-position: {{VALUE}}; mask-position: {{VALUE}};',
                        '{{WRAPPER}} .author__thumb' => ' -webkit-mask-position: {{VALUE}}; mask-position: {{VALUE}};',
                        '{{WRAPPER}} .box__big__thumb' => ' -webkit-mask-position: {{VALUE}}; mask-position: {{VALUE}};',
                        '{{WRAPPER}} .flip__front__big__thumb' => ' -webkit-mask-position: {{VALUE}}; mask-position: {{VALUE}};',
                        '{{WRAPPER}} .element-ready-trending-news-thumb' => ' -webkit-mask-position: {{VALUE}}; mask-position: {{VALUE}};',
                        '{{WRAPPER}} .portfolio__thumb' => ' -webkit-mask-position: {{VALUE}}; mask-position: {{VALUE}};',
                        '{{WRAPPER}} .element-ready-lp-course-thumb' => ' -webkit-mask-position: {{VALUE}}; mask-position: {{VALUE}};',
                        '{{WRAPPER}} .front .fcf-thumb' => ' -webkit-mask-position: {{VALUE}}; mask-position: {{VALUE}};',
                        '{{WRAPPER}} .sldier-content-area .post__thumb' => ' -webkit-mask-position: {{VALUE}}; mask-position: {{VALUE}};',
                        '{{WRAPPER}} .gallery__item__thumbnail' => ' -webkit-mask-position: {{VALUE}}; mask-position: {{VALUE}};',
                    ],
                    'condition'    => [
                        'element_ready_pro_image_masking_active' => ['yes']
                    ]
                ]
            );
    
            $element->add_control(
                'mask_size',
                [
                    'label' => esc_html__( 'Size', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'default',
                    'options' => [
                        'auto'    => esc_html__( 'Auto',  'element-ready-pro' ),
                        'cover'   => esc_html__( 'Cover',  'element-ready-pro' ),
                        'contain' => esc_html__( 'Contain', 'element-ready-pro' ),
                        'initial' => esc_html__( 'Custom',  'element-ready-pro' ),
                    ],
                    
                    'selectors' => [
                        '{{WRAPPER}}.elementor-widget-image .elementor-widget-container > img' => '-webkit-mask-size: {{VALUE}}; mask-size: {{VALUE}};',
                        '{{WRAPPER}} .elementor-image-box-img' => '-webkit-mask-size: {{VALUE}}; mask-size: {{VALUE}};',
                        '{{WRAPPER}} .elementor-image' => '-webkit-mask-size: {{VALUE}}; mask-size: {{VALUE}};',
                        '{{WRAPPER}} .elementor-widget-image .elementor-widget-container' => '-webkit-mask-size: {{VALUE}}; mask-size: {{VALUE}};',
                        '{{WRAPPER}} .member__thumb' => '-webkit-mask-size: {{VALUE}}; mask-size: {{VALUE}};',
                        '{{WRAPPER}} .author__thumb' => '-webkit-mask-size: {{VALUE}}; mask-size: {{VALUE}};',
                        '{{WRAPPER}} .box__big__thumb' => '-webkit-mask-size: {{VALUE}}; mask-size: {{VALUE}};',
                        '{{WRAPPER}} .flip__front__big__thumb' => '-webkit-mask-size: {{VALUE}}; mask-size: {{VALUE}};',
                        '{{WRAPPER}} .element-ready-trending-news-thumb' => '-webkit-mask-size: {{VALUE}}; mask-size: {{VALUE}};',
                        '{{WRAPPER}} .portfolio__thumb' => '-webkit-mask-size: {{VALUE}}; mask-size: {{VALUE}};',
                        '{{WRAPPER}} .element-ready-lp-course-thumb' => '-webkit-mask-size: {{VALUE}}; mask-size: {{VALUE}};',
                        '{{WRAPPER}} .front .fcf-thumb' => '-webkit-mask-size: {{VALUE}}; mask-size: {{VALUE}};',
                        '{{WRAPPER}} .sldier-content-area .post__thumb' => '-webkit-mask-size: {{VALUE}}; mask-size: {{VALUE}};',
                        '{{WRAPPER}} .gallery__item__thumbnail' => '-webkit-mask-size: {{VALUE}}; mask-size: {{VALUE}};',
                    ],
                    'condition'    => [
                        'element_ready_pro_image_masking_active' => ['yes']
                    ]
                ]
            );
    
            $element->add_responsive_control(
                'mask_custom_size',
                [
                    'label' => esc_html__( 'Custom Size', 'element-ready-pro' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', 'em', '%', 'vw' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                        'em' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'vw' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'size' => 100,
                        'unit' => '%',
                    ],
                    'required' => true,
                    'selectors' => [
                        '{{WRAPPER}}.elementor-widget-image .elementor-widget-container > img' => '-webkit-mask-size: {{SIZE}}{{UNIT}}; mask-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .elementor-image-box-img' => '-webkit-mask-size: {{SIZE}}{{UNIT}}; mask-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .elementor-image' => '-webkit-mask-size: {{SIZE}}{{UNIT}}; mask-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .elementor-widget-image .elementor-widget-container' => '-webkit-mask-size: {{SIZE}}{{UNIT}}; mask-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .member__thumb' => '-webkit-mask-size: {{SIZE}}{{UNIT}}; mask-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .author__thumb' => '-webkit-mask-size: {{SIZE}}{{UNIT}}; mask-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .box__big__thumb' => '-webkit-mask-size: {{SIZE}}{{UNIT}}; mask-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .flip__front__big__thumb' => '-webkit-mask-size: {{SIZE}}{{UNIT}}; mask-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .element-ready-trending-news-thumb' => '-webkit-mask-size: {{SIZE}}{{UNIT}}; mask-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .portfolio__thumb' => '-webkit-mask-size: {{SIZE}}{{UNIT}}; mask-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .element-ready-lp-course-thumb' => '-webkit-mask-size: {{SIZE}}{{UNIT}}; mask-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .front .fcf-thumb' => '-webkit-mask-size: {{SIZE}}{{UNIT}}; mask-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .sldier-content-area .post__thumb' => '-webkit-mask-size: {{SIZE}}{{UNIT}}; mask-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .gallery__item__thumbnail' => '-webkit-mask-size: {{SIZE}}{{UNIT}}; mask-size: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'mask_size' => 'initial',
                    ],
                ]
            );
    
            $element->add_control(
                'mask_repeat',
                [
                    'label' => esc_html__( 'Repeat', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'default',
                    'options' => [
                        'repeat'          => esc_html__( 'Repeat', 'element-ready-pro' ),
                        'repeat-x'        => esc_html__( 'Repeat-x', 'element-ready-pro' ),
                        'repeat-y'        => esc_html__( 'Repeat-y', 'element-ready-pro' ),
                        'space'           => esc_html__( 'Space', 'element-ready-pro' ),
                        'round'           => esc_html__( 'Round',  'element-ready-pro' ),
                        'no-repeat'       => esc_html__( 'No-repeat', 'element-ready-pro' ),
                        'repeat-space'    => esc_html__( 'Repeat Space',  'element-ready-pro' ),
                        'round-space'     => esc_html__( 'Round Space',  'element-ready-pro' ),
                        'no-repeat-round' => esc_html__( 'No-repeat Round', 'element-ready-pro' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}}.elementor-widget-image .elementor-widget-container > img' => '-webkit-mask-repeat: {{VALUE}}; mask-repeat: {{VALUE}};',
                        '{{WRAPPER}} .elementor-image-box-img' => '-webkit-mask-repeat: {{VALUE}}; mask-repeat: {{VALUE}};',
                        '{{WRAPPER}} .elementor-image' => '-webkit-mask-repeat: {{VALUE}}; mask-repeat: {{VALUE}};',
                        '{{WRAPPER}} .elementor-widget-image .elementor-widget-container' => '-webkit-mask-repeat: {{VALUE}}; mask-repeat: {{VALUE}};',
                        '{{WRAPPER}} .member__thumb' => '-webkit-mask-repeat: {{VALUE}}; mask-repeat: {{VALUE}};',
                        '{{WRAPPER}} .author__thumb' => '-webkit-mask-repeat: {{VALUE}}; mask-repeat: {{VALUE}};',
                        '{{WRAPPER}} .box__big__thumb' => '-webkit-mask-repeat: {{VALUE}}; mask-repeat: {{VALUE}};',
                        '{{WRAPPER}} .flip__front__big__thumb' => '-webkit-mask-repeat: {{VALUE}}; mask-repeat: {{VALUE}};',
                        '{{WRAPPER}} .element-ready-trending-news-thumb' => '-webkit-mask-repeat: {{VALUE}}; mask-repeat: {{VALUE}};',
                        '{{WRAPPER}} .portfolio__thumb' => '-webkit-mask-repeat: {{VALUE}}; mask-repeat: {{VALUE}};',
                        '{{WRAPPER}} .element-ready-lp-course-thumb' => '-webkit-mask-repeat: {{VALUE}}; mask-repeat: {{VALUE}};',
                        '{{WRAPPER}} .front .fcf-thumb' => '-webkit-mask-repeat: {{VALUE}}; mask-repeat: {{VALUE}};',
                        '{{WRAPPER}} .sldier-content-area .post__thumb' => '-webkit-mask-repeat: {{VALUE}}; mask-repeat: {{VALUE}};',
                        '{{WRAPPER}} .gallery__item__thumbnail' => '-webkit-mask-repeat: {{VALUE}}; mask-repeat: {{VALUE}};',
                    ],
                    'condition'    => [
                        'element_ready_pro_image_masking_active' => ['yes']
                    ]
                ]
            );
        

        
        $element->end_controls_section();
    }

 
   
}