<?php
namespace Element_Ready_Pro\Widgets\news_grid;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Custom_Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Element_Ready\Base\Repository\Base_Modal;


if ( ! defined( 'ABSPATH' ) ) exit;

class Post_grid_Overlay extends Widget_Base {

  
  public $base;

    public function get_name() {
        return 'element-ready-pro-overlay-grid-post';
    }

    public function get_title() {
        return esc_html__( 'ER Post Overlay Grid', 'element-ready-pro' );
    }
    public function get_style_depends(){
    
        return [
           'element-ready-news-grid',
           'element-ready-grid'
        ];
    }

    public function get_icon() { 
        return "fas fa-sticky-note";
    }

    public function get_categories() {
       return [ 'element-ready-pro' ];
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
				'default' => 'style1',
				'options' => [
					'style1'  => esc_html__( 'Style 1', 'element-ready-pro' ),
				],
			]
		);

       $this->end_controls_section();
       
       do_action( 'er_section_general_grid_tab_overlay', $this, $this->get_name() );
       do_action( 'element_ready_section_data_exclude_tab', $this , $this->get_name() );  
       do_action( 'element_ready_section_date_filter_tab', $this , $this->get_name());  
       do_action( 'element_ready_section_taxonomy_filter_tab', $this , $this->get_name());  
       do_action( 'element_ready_section_sort_tab', $this , $this->get_name());  
       do_action( 'element_ready_section_sticky_tab', $this , $this->get_name());  
      

       $this->text_wrapper_css(
            array(
                'title' => esc_html__('Title wrapper','element-ready-pro'),
                'slug' => '_title_wrapper_style',
                'element_name' => '_title_wrapper_element_ready_',
                'selector' => '{{WRAPPER}} .er-news-title',
            
            )
        );
        
      $this->text_wrapper_css(
         array(
             'title' => esc_html__('Title','element-ready-pro'),
             'slug' => '_title__style',
             'element_name' => '_title_apper_element_ready_',
             'selector' => '{{WRAPPER}} .er-news-title a',
            
         )
      );

      $this->text_wrapper_css(
         array(
             'title' => esc_html__('Content','element-ready-pro'),
             'slug' => '_content_box_style',
             'element_name' => '_content_wrapper_element_ready_',
             'selector' => '{{WRAPPER}} .er-news-content',
         )
      );

      $this->text_wrapper_css(
         array(
             'title' => esc_html__('Category Wrapper','element-ready-pro'),
             'slug' => '_cast__swr_box_style',
             'element_name' => '_cat_wreessapper_element_ready_',
             'selector' => '{{WRAPPER}} .post-meta',
         )
      );

      $this->text_wrapper_css(
        array(
            'title' => esc_html__('Category','element-ready-pro'),
            'slug' => '_cat_box_style',
            'element_name' => '_cat_wer_element_ready_',
            'selector' => '{{WRAPPER}} .post-meta span',
        )
     );

      $this->start_controls_section('newsprk_image_section',
      [
          'label' => esc_html__( 'Image ', 'element-ready-pro' ),
          'tab'   => Controls_Manager::TAB_STYLE,
      ]
  );
 $this->add_responsive_control(
    'image_margin',
    [
       'label'      => esc_html__( ' Margin', 'element-ready-pro' ),
       'type'       => Controls_Manager::DIMENSIONS,
       'size_units' => [ 'px','%'],
       'selectors'  => [
          '{{WRAPPER}} .post-item-thumb img'     => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        
       ],
    ]
    );
    $this->add_responsive_control(
       'box_image_height',
       [
          'label'      => esc_html__( 'Image height', 'element-ready-pro' ),
          'type'       => Controls_Manager::SLIDER,
          'size_units' => [ 'px','%' ],
          'range'      => [
             'px' => [
                'min'  => 0,
                'max'  => 800,
                'step' => 1,
             ],
           
          ],
         
          'selectors' => [
             '{{WRAPPER}} .post-item-thumb img'     => 'height: {{SIZE}}{{UNIT}};',
         
          ],
          
       ]
    );
    
    $this->add_responsive_control(
       'box_image_width',
       [
          'label'      => esc_html__( 'Image width', 'element-ready-pro' ),
          'type'       => Controls_Manager::SLIDER,
          'size_units' => [ 'px','%' ],
          'range'      => [
             'px' => [
                'min'  => 0,
                'max'  => 800,
                'step' => 1,
             ],
           
          ],
          'selectors' => [
             '{{WRAPPER}} .post-item-thumb img'     => 'width: {{SIZE}}{{UNIT}};',
            
          ],
         
       ]
    ); 

    $this->add_responsive_control(
      'box_image_amax_width',
      [
         'label'      => esc_html__( 'Max width', 'element-ready-pro' ),
         'type'       => Controls_Manager::SLIDER,
         'size_units' => [ 'px','%' ],
         'range'      => [
            'px' => [
               'min'  => 0,
               'max'  => 800,
               'step' => 1,
            ],
          
         ],
         'selectors' => [
            '{{WRAPPER}} .post-item-thumb img'     => 'max-width: {{SIZE}}{{UNIT}};',
           
         ],
        
      ]
   ); 

    $this->add_responsive_control(
       'img_borders__radius',
       [
          'label'      => esc_html__( 'Image Border radius', 'element-ready-pro' ),
          'type'       => Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px'],
          'selectors'  => [
             
             '{{WRAPPER}} .post-item-thumb img'      => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
          
             
          ],
       ]
    );

 $this->end_controls_section();
      
      $this->text_wrapper_css(
         array(
             'title' => esc_html__('Readmore','element-ready-pro'),
             'slug' => '_readmore_box_style',
             'element_name' => '_readmore_wrapper_element_ready_',
             'selector' => '{{WRAPPER}} .more-btn  .er-readmore',
         )
      ); 

      $this->text_wrapper_css(
         array(

             'title' => esc_html__('Readmore icon','element-ready-pro'),
             'slug' => '_readmore_icon_box_style',
             'element_name' => '_readmore_icon_wrapper_element_ready_',
             'selector' => '{{WRAPPER}} .more-btn .er-readmore i',
         )
      ); 
      
      $this->box_css(
         array(

             'title' => esc_html__('Social item','element-ready-pro'),
             'slug' => '_social_wr_box_style',
             'element_name' => '_social_wer_wrapper_element_ready_',
             'selector' => '{{WRAPPER}} .er-news-social ul li',
         )
      ); 
      
      

      $this->text_wrapper_css(
         array(

             'title' => esc_html__('Social icon','element-ready-pro'),
             'slug' => '_social_icon_box_style',
             'element_name' => '_social_icon_wrapper_element_ready_',
             'selector' => '{{WRAPPER}} .er-news-social ul li a',
         )
      );

      $this->box_css(
        array(

            'title' => esc_html__('Box','element-ready-pro'),
            'slug' => '_box_verwr_box_style',
            'element_name' => '_box_ver_wer_wrapper_element_ready_',
            'selector' => '{{WRAPPER}} .qs_newsp_post-item-5',
           
        )
     ); 
      
      $this->box_css(
         array(

             'title' => esc_html__('Content Conntainer','element-ready-pro'),
             'slug' => '_contnt_verwr_box_style',
             'element_name' => '_content_ver_wer_wrapper_element_ready_',
             'selector' => '{{WRAPPER}} .qs_newsp_post-item-5 .post-item-content',
            
         )
      ); 

      $this->box_css(
         array(

             'title' => esc_html__('Hover Content Conntainer','element-ready-pro'),
             'slug' => '_contnt_hoverwr_box_style',
             'element_name' => '_content_hover_wer_wrapper_element_ready_',
             'selector' => '{{WRAPPER}} .qs_newsp_post-item-5 .post-item-content::before',
         )
      ); 
      

    }

    protected function render( ) { 

        $settings        = $this->get_settings();
        $post_title_crop = $settings['post_title_crop'];
       
        if(is_search() || element_ready_lite_is_blog()){
            global $wp_query;
            $query = $wp_query;
              
        }else{
            $data  = new Base_Modal($settings);
            $query = $data->get();
        }
        
        if(!$query){
          return;  
        }

        ?>
       
        <div class="quomodo-container">  
            <div class="quomodo-row">
               <?php while ($query->have_posts()) : $query->the_post(); ?>
                 <?php if( has_post_thumbnail() ): ?>
                  <div class="quomodo-col-lg-4 quomodo-col-md-6">
                     <div class="qs_newsp_post-item-5 mb-30">
                           <div class="post-item-thumb">
                                
                                    <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php the_title_attribute(); ?>">
                                
                                    <?php
                                        $categories = get_the_category();
                                        if ( ! empty( $categories) && $settings['show_cat'] == 'yes' ) {
                                            echo '<div class="post-meta"><span>' . esc_html( $categories[0]->name ) . '</span></div>';
                                    }

                                 ?>
                             
                              <div class="post-item-content">
                                 <h3 class="title er-news-title">
                                     <a href="<?php the_permalink() ?>">
                                      <?php echo esc_html(wp_trim_words( get_the_title(),$settings['post_title_crop'], '' )); ?>
                                    </a>
                                    </h3>
                                 <?php if($settings['show_content'] == 'yes'): ?>
                                    <p class="er-news-content"> <?php echo esc_html(wp_trim_words( get_the_excerpt(), $settings['post_content_crop'],'' )); ?> </p>
                                 <?php endif; ?>
                                 <div class="post-link d-flex justify-content-between align-items-center">
                                       <?php if( $settings['show_readmore'] == 'yes' ): ?>
                                            <div class="more-btn ">
                                                <a class="er-readmore" href="<?php the_permalink() ?>"> <?php echo esc_html($settings['readmore_text']); ?>  <?php \Elementor\Icons_Manager::render_icon( $settings['readmore_icon'], [ 'aria-hidden' => 'true' ] ); ?> </a>
                                            </div>
                                       <?php endif; ?>
                                       <?php if($settings['show_social'] == 'yes'): ?>
                                             <div class="social er-news-social">
                                                <ul>
                                                   <?php foreach( $settings['social_list'] as $item ): ?>
                                                      <li><a href="<?php the_permalink() ?>" data-social="<?php echo esc_attr($item['type']); ?>" href="#"><?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?></a></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                             </div>
                                       <?php endif; ?>
                                 </div>
                              </div>
                           </div>
                     </div>
                  </div>
                  <?php endif; ?>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
           
      <?php  
    }

    public function box_css($atts) {
        
      $atts_variable = shortcode_atts(
          array(
              'title'        => esc_html__('Box Style','element-ready-pro'),
              'slug'         => '_box_style',
              'element_name' => '_element_ready_',
              'selector'     => '{{WRAPPER}} ',
              'condition'    => '',
          ), $atts );

      extract($atts_variable);    

      $widget = $this->get_name().'_'.element_ready_heading_camelize($slug);

      $tab_start_section_args =  [
          'label' => $title,
          'tab'   => Controls_Manager::TAB_STYLE,
      ];
      
      if(is_array($condition)){
          $tab_start_section_args['condition'] = $condition;
      }
      /*----------------------------
          ELEMENT__STYLE
      -----------------------------*/
      $this->start_controls_section(
          $widget.'_style_section',
          $tab_start_section_args
      );

          $this->start_controls_tabs( $widget.'_tabs_style' );
              $this->start_controls_tab(
                  $widget.'_normal_tab',
                  [
                      'label' => esc_html__( 'Normal', 'element-ready-pro' ),
                  ]
              );


                  // Background
                  $this->add_group_control(
                      \Elementor\Group_Control_Background::get_type(),
                      [
                          'name'     => $widget.'_background',
                          'label'    => esc_html__( 'Background', 'element-ready-pro' ),
                          'types'    => [ 'classic', 'gradient' ],
                          'selector' => $selector,
                      ]
                  );

                  // Border
                  $this->add_group_control(
                     \Elementor\Group_Control_Border:: get_type(),
                      [
                          'name'     => $widget.'_border',
                          'label'    => esc_html__( 'Border', 'element-ready-pro' ),
                          'selector' => $selector,
                      ]
                  );

                  // Radius
                  $this->add_responsive_control(
                      $widget.'_radius',
                      [
                          'label'      => esc_html__( 'Border Radius', 'element-ready-pro' ),
                          'type'       => Controls_Manager::DIMENSIONS,
                          'size_units' => [ 'px', '%', 'em' ],
                          'selectors'  => [
                              $selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                             
                          ],
                      ]
                  );
                  
                  // Shadow
                  $this->add_group_control(
                     \Elementor\Group_Control_Box_Shadow::get_type(),
                      [
                          'name'     => $widget.'_shadow',
                          'selector' => $selector,
                      ]
                  );

                  // Margin
                  $this->add_responsive_control(
                      $widget.'_margin',
                      [
                          'label'      => esc_html__( 'Margin', 'element-ready-pro' ),
                          'type'       => Controls_Manager::DIMENSIONS,
                          'size_units' => [ 'px', '%', 'em' ],
                          'selectors'  => [
                              
                              $selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                          ],
                      ]
                  );

                  // Padding
                  $this->add_responsive_control(
                      $widget.'_padding',
                      [
                          'label'      => esc_html__( 'Padding', 'element-ready-pro' ),
                          'type'       => Controls_Manager::DIMENSIONS,
                          'size_units' => [ 'px', '%', 'em' ],
                          'selectors'  => [
                              $selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                             
                          ],
                      ]
                  );

                  
                  $this->add_responsive_control(
                      $widget.'main_section_element_ready_yu_custom_css',
                      [
                          'label'     => esc_html__( 'Custom CSS', 'element-ready-pro' ),
                          'type'      => Controls_Manager::CODE,
                          'rows'      => 20,
                          'language'  => 'css',
                          'selectors' => [
                              $selector => '{{VALUE}};',
                            
                          ],
                          'separator' => 'before',
                      ]
                  );

              $this->end_controls_tab();

     
          $this->end_controls_tabs();

          $this->add_responsive_control(
              $widget.'_section___section_show_hide_'.$element_name.'_display',
              [
                  'label' => esc_html__( 'Display', 'element-ready-pro' ),
                  'type' => \Elementor\Controls_Manager::SELECT,
                  'default' => '',
                  'options' => [
                      'flex'         => esc_html__( 'Flex', 'element-ready-pro' ),
                      'inline-flex'         => esc_html__( 'Inline Flex', 'element-ready-pro' ),
                      'block'        => esc_html__( 'Block', 'element-ready-pro' ),
                      'inline-block' => esc_html__( 'Inline Block', 'element-ready-pro' ),
                      'grid'         => esc_html__( 'Grid', 'element-ready-pro' ),
                      'none'         => esc_html__( 'None', 'element-ready-pro' ),
                      ''             => esc_html__( 'inherit', 'element-ready-pro' ),
                  ],
                  'selectors' => [
                      $selector => 'display: {{VALUE}};'
                ],
              ]
              
          );

          $this->add_responsive_control(
              $widget.'_section___section_flex_direction_'.$element_name.'_display',
              [
                  'label' => esc_html__( 'Flex Direction', 'element-ready-pro' ),
                  'type' => \Elementor\Controls_Manager::SELECT,
                  'default' => '',
                  'options' => [
                      'column'         => esc_html__( 'Column', 'element-ready-pro' ),
                      'row'            => esc_html__( 'Row', 'element-ready-pro' ),
                      'column-reverse' => esc_html__( 'Column Reverse', 'element-ready-pro' ),
                      'row-reverse'    => esc_html__( 'Row Reverse', 'element-ready-pro' ),
                      'revert'         => esc_html__( 'Revert', 'element-ready-pro' ),
                      'none'           => esc_html__( 'None', 'element-ready-pro' ),
                      ''               => esc_html__( 'inherit', 'element-ready-pro' ),
                  ],
                  'selectors' => [
                      $selector => 'flex-direction: {{VALUE}};'
                  ],
                  'condition' => [ $widget.'_section___section_show_hide_'.$element_name.'_display' => ['flex','inline-flex'] ]
              ]
              
          );

          $this->add_responsive_control(
              $widget.'_section___section_flex_wrap_'.$element_name.'_display',
              [
                  'label' => esc_html__( 'Flex Wrap', 'element-ready-pro' ),
                  'type' => \Elementor\Controls_Manager::SELECT,
                  'default' => '',
                  'options' => [
                      'wrap'         => esc_html__( 'Wrap', 'element-ready-pro' ),
                      'wrap-reverse' => esc_html__( 'Wrap Reverse', 'element-ready-pro' ),
                      'nowrap'    => esc_html__( 'No Wrap', 'element-ready-pro' ),
                      'unset'         => esc_html__( 'Unset', 'element-ready-pro' ),
                      'normal'           => esc_html__( 'None', 'element-ready-pro' ),
                      'inherit'               => esc_html__( 'inherit', 'element-ready-pro' ),
                  ],
                  'selectors' => [
                      $selector => 'flex-wrap: {{VALUE}};'
                  ],
                  'condition' => [ $widget.'_section___section_show_hide_'.$element_name.'_display' => ['flex','inline-flex'] ]
              ]
              
          );

          $this->add_responsive_control(
              $widget.'_section_align_section_e_'.$element_name.'_flex_align',
              [
                  'label' => esc_html__( 'Alignment', 'element-ready-pro' ),
                  'type' => \Elementor\Controls_Manager::SELECT,
                  'default' => '',
                  'options' => [
                      'flex-start'    => esc_html__( 'Left', 'element-ready-pro' ),
                      'flex-end'      => esc_html__( 'Right', 'element-ready-pro' ),
                      'center'        => esc_html__( 'Center', 'element-ready-pro' ),
                      'space-around'  => esc_html__( 'Space Around', 'element-ready-pro' ),
                      'space-between' => esc_html__( 'Space Between', 'element-ready-pro' ),
                      'space-evenly'  => esc_html__( 'Space Evenly', 'element-ready-pro' ),
                      ''              => esc_html__( 'inherit', 'element-ready-pro' ),
                  ],
                  'condition' => [ $widget.'_section___section_show_hide_'.$element_name.'_display' => ['flex','inline-flex'] ],

                  'selectors' => [
                      $selector => 'justify-content: {{VALUE}};'
                 ],
              ]
              
          );

          $this->add_responsive_control(
              $widget.'_section_align_items_section_e_'.$element_name.'_flex_align',
              [
                  'label' => esc_html__( 'Align Items', 'element-ready-pro' ),
                  'type' => \Elementor\Controls_Manager::SELECT,
                  'default' => '',
                  'options' => [
                      'flex-start'    => esc_html__( 'Left', 'element-ready-pro' ),
                      'flex-end'      => esc_html__( 'Right', 'element-ready-pro' ),
                      'center'        => esc_html__( 'Center', 'element-ready-pro' ),
                      'baseline'  => esc_html__( 'Baseline', 'element-ready-pro' ),
                      ''              => esc_html__( 'inherit', 'element-ready-pro' ),
                  ],
                  'condition' => [ $widget.'_section___section_show_hide_'.$element_name.'_display' => ['flex','inline-flex'] ],

                  'selectors' => [
                      $selector => 'align-items: {{VALUE}};'
                 ],
              ]
              
          );



          $this->add_control(
              $widget.'_section___section_popover_'.$element_name.'_position',
              [
                  'label' => esc_html__( 'Position', 'element-ready-pro' ),
                  'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                  'label_off' => esc_html__( 'Default', 'element-ready-pro' ),
                  'label_on' => esc_html__( 'Custom', 'element-ready-pro' ),
                  'return_value' => 'yes',
              ]
          );
  
          $this->start_popover();
          $this->add_responsive_control(
              $widget.'_section__'.$element_name.'_position_type',
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
                      $selector => 'position: {{VALUE}};',
                     
                  ],
                  
              ]
          );
  
          $this->add_responsive_control(
              $widget.'main_section_'.$element_name.'_position_left',
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
                      $selector => 'left: {{SIZE}}{{UNIT}};',
                     
                  ],
              ]
          );
  
          $this->add_responsive_control(
              $widget.'main_section_'.$element_name.'_r_position_top',
              [
                  'label' => esc_html__( 'Position Top', 'element-ready-pro' ),
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
                      $selector => 'top: {{SIZE}}{{UNIT}};',
                    
                  ],
              ]
          );

          $this->add_responsive_control(
              $widget.'main_section_'.$element_name.'_r_position_bottom',
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
                      $selector => 'bottom: {{SIZE}}{{UNIT}};',
                     
                  ],
              ]
          );
          $this->add_responsive_control(
              $widget.'main_section_'.$element_name.'_r_position_right',
              [
                  'label' => esc_html__( 'Position Right', 'element-ready-pro' ),
                  'type' => Controls_Manager::SLIDER,
                  'size_units' => [ 'px', '%' ],
                  'range' => [
                      'px' => [
                          'min' => -1600,
                          'max' => 3000,
                          'step' => 5,
                      ],
                      '%' => [
                          'min' => 0,
                          'max' => 100,
                      ],
                  ],
                 
                  'selectors' => [
                      $selector => 'right: {{SIZE}}{{UNIT}};',
                     
                  ],
              ]
          );
          $this->end_popover();

          $this->add_control(
              $widget.'main_section_'.$element_name.'_rbox_popover_section_sizen',
          [
              'label' => esc_html__( 'Box Size', 'element-ready-pro' ),
              'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
              'label_off' => esc_html__( 'Default', 'element-ready-pro' ),
              'label_on' => esc_html__( 'Custom', 'element-ready-pro' ),
              'return_value' => 'yes',
            
          ]
      );

      $this->start_popover();

      $this->add_responsive_control(
          $widget.'main_section_'.$element_name.'_r_section__width',
          [
              'label' => esc_html__( 'Width', 'element-ready-pro' ),
              'type' => Controls_Manager::SLIDER,
              'size_units' => [ 'px', '%' ],
              'range' => [
                  'px' => [
                      'min' => 0,
                      'max' => 3000,
                      'step' => 5,
                  ],
                  '%' => [
                      'min' => 0,
                      'max' => 100,
                  ],
              ],
             
              'selectors' => [
                  $selector => 'width: {{SIZE}}{{UNIT}};',
                 
              ],
          ]
      );

      $this->add_responsive_control(
          $widget.'main_section_'.$element_name.'_r_container_height',
          [
              'label' => esc_html__( 'Height', 'element-ready-pro' ),
              'type' => Controls_Manager::SLIDER,
              'size_units' => [ 'px', '%' ],
              'range' => [
                  'px' => [
                      'min' => 0,
                      'max' => 3000,
                      'step' => 5,
                  ],
                  '%' => [
                      'min' => 0,
                      'max' => 100,
                  ],
              ],
             
              'selectors' => [
                  $selector => 'height: {{SIZE}}{{UNIT}};',
                
              ],
          ]
      );

     
      $this->end_popover();


      $this->end_controls_section();
      /*----------------------------
          ELEMENT__STYLE END
      -----------------------------*/
  }

  public function text_css($atts) {

   $atts_variable = shortcode_atts(
       array(
           'title' => esc_html__('Text Style','element-ready-pro'),
           'slug' => '_text_style',
           'element_name' => '_element_ready_',
           'selector' => '{{WRAPPER}} ',
           'hover_selector' => '{{WRAPPER}} ',
           'condition' => '',
       ), $atts );

   extract($atts_variable);    
   
   $widget = $this->get_name().'_'.element_ready_heading_camelize($slug);

 
   /*----------------------------
       ELEMENT__STYLE
   -----------------------------*/
   $tab_start_section_args =  [
       'label' => $title,
       'tab'   => Controls_Manager::TAB_STYLE,
   ];

   if(is_array($condition)){
       $tab_start_section_args['condition'] = $condition;
   }
 
   $this->start_controls_section(
       $widget.'_style_section',
       $tab_start_section_args
   );

       $this->add_responsive_control(
           $widget.'_alignment', [
               'label'   => esc_html__( 'Alignment', 'element-ready-pro' ),
               'type'    => \Elementor\Controls_Manager::CHOOSE,
               'options' => [

           'left'		 => [
               
               'title' => esc_html__( 'Left', 'element-ready-pro' ),
               'icon'  => 'fa fa-align-left',
           
           ],
               'center'	     => [
               
               'title' => esc_html__( 'Center', 'element-ready-pro' ),
               'icon'  => 'fa fa-align-center',
           
           ],
           'right'	 => [

               'title' => esc_html__( 'Right', 'element-ready-pro' ),
               'icon'  => 'fa fa-align-right',
               
           ],
           
           'justify'	 => [

           'title' => esc_html__( 'Justified', 'element-ready-pro' ),
           'icon'  => 'fa fa-align-justify',
           
                   ],
           ],
           
           'selectors' => [
               $selector => 'text-align: {{VALUE}};',
           ],
           ]
       );//Responsive control end

       $this->start_controls_tabs( $widget.'_tabs_style' );
           $this->start_controls_tab(
               $widget.'_normal_tab',
               [
                   'label' => esc_html__( 'Normal', 'element-ready-pro' ),
               ]
           );

               // Typgraphy
               $this->add_group_control(
                   Group_Control_Typography:: get_type(),
                   [
                       'name'      => $widget.'_typography',
                       'selector'  => $selector,
                   ]
               );

               // Icon Color
               $this->add_control(
                   $widget.'_text_color',
                   [
                       'label'     => esc_html__( 'Color', 'element-ready-pro' ),
                       'type'      => Controls_Manager::COLOR,
                       'default'   => '',
                       'selectors' => [
                           $selector => 'color: {{VALUE}};',
                       ],
                   ]
               );

               $this->add_group_control(
                   \Elementor\Group_Control_Text_Shadow::get_type(),
                   [
                       'name' =>  $widget.'text_shadow_',
                       'label' => esc_html__( 'Text Shadow', 'element-ready-pro' ),
                       'selector' => $selector ,
                   ]
               );
       

               // Background
               $this->add_group_control(
                   Group_Control_Background:: get_type(),
                   [
                       'name'     => $widget.'text_background',
                       'label'    => esc_html__( 'Background', 'element-ready-pro' ),
                       'types'    => [ 'classic', 'gradient','video' ],
                       'selector' => $selector,
                   ]
               );

               // Border
               $this->add_group_control(
                   Group_Control_Border::get_type(),
                   [
                       'name'     => $widget.'_border',
                       'label'    => esc_html__( 'Border', 'element-ready-pro' ),
                       'selector' => $selector,
                   ]
               );

               // Radius
               $this->add_responsive_control(
                   $widget.'_radius',
                   [
                       'label'      => esc_html__( 'Border Radius', 'element-ready-pro' ),
                       'type'       => Controls_Manager::DIMENSIONS,
                       'size_units' => [ 'px', '%', 'em' ],
                       'selectors'  => [
                           $selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                       ],
                   ]
               );
               
               // Shadow
               $this->add_group_control(
                   Group_Control_Box_Shadow::get_type(),
                   [
                       'name'     => $widget.'normal_shadow',
                       'selector' => $selector,
                   ]
               );

               // Margin
               $this->add_responsive_control(
                   $widget.'_margin',
                   [
                       'label'      => esc_html__( 'Margin', 'element-ready-pro' ),
                       'type'       => Controls_Manager::DIMENSIONS,
                       'size_units' => [ 'px', '%', 'em' ],
                       'selectors'  => [
                           $selector  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                       ],
                   ]
               );

               // Padding
               $this->add_responsive_control(
                   $widget.'_padding',
                   [
                       'label'      => esc_html__( 'Padding', 'element-ready-pro' ),
                       'type'       => Controls_Manager::DIMENSIONS,
                       'size_units' => [ 'px', '%', 'em' ],
                       'selectors'  => [
                           $selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                       ],
                   ]
               );

               $this->add_responsive_control(
                   $widget.'main_section_'.$element_name.'_element_ready_control_custom_css',
                   [
                       'label'     => esc_html__( 'Custom CSS', 'element-ready-pro' ),
                       'type'      => Controls_Manager::CODE,
                       'rows'      => 20,
                       'language'  => 'css',
                       'selectors' => [
                           $selector => '{{VALUE}};',
                         
                       ],
                       'separator' => 'before',
                   ]
               );

               $this->add_responsive_control(
                   $widget.'main_section_'.$element_name.'_r_itemdsd_el__width',
                   [
                       'label' => esc_html__( 'Width', 'element-ready-pro' ),
                       'type' => Controls_Manager::SLIDER,
                       'size_units' => [ 'px', '%' ],
                       'range' => [
                           'px' => [
                               'min' => 0,
                               'max' => 3000,
                               'step' => 5,
                           ],
                           '%' => [
                               'min' => 0,
                               'max' => 100,
                           ],
                       ],
                   
                       'selectors' => [
                           $selector => 'width: {{SIZE}}{{UNIT}};',
                       
                       ],
                   ]
               );

               $this->add_responsive_control(
                   $widget.'main_section_'.$element_name.'_r_item_dsd_maxel__width',
                   [
                       'label' => esc_html__( 'Max Width', 'element-ready-pro' ),
                       'type' => Controls_Manager::SLIDER,
                       'size_units' => [ 'px', '%' ],
                       'range' => [
                           'px' => [
                               'min' => 0,
                               'max' => 3000,
                               'step' => 5,
                           ],
                           '%' => [
                               'min' => 0,
                               'max' => 100,
                           ],
                       ],
                   
                       'selectors' => [
                           $selector => 'max-width: {{SIZE}}{{UNIT}};',
                       
                       ],
                   ]
               );

               $this->add_responsive_control(
                   $widget.'main_section_'.$element_name.'_r_item_errt_min_el__width',
                   [
                       'label' => esc_html__( 'Min Width', 'element-ready-pro' ),
                       'type' => Controls_Manager::SLIDER,
                       'size_units' => [ 'px', '%' ],
                       'range' => [
                           'px' => [
                               'min' => 0,
                               'max' => 3000,
                               'step' => 5,
                           ],
                           '%' => [
                               'min' => 0,
                               'max' => 100,
                           ],
                       ],
                   
                       'selectors' => [
                           $selector => 'min-width: {{SIZE}}{{UNIT}};',
                       
                       ],
                   ]
               );

           $this->end_controls_tab();
           if($hover_selector != false || $hover_selector != ''){

           $this->start_controls_tab(
               $widget.'_hover_tab',
               [
                   'label' => esc_html__( 'Hover', 'element-ready-pro' ),
               ]
           );

               //Hover Color
               $this->add_control(
                   'hover_'.$element_name.'_color',
                   [
                       'label'     => esc_html__( 'Color', 'element-ready-pro' ),
                       'type'      => Controls_Manager::COLOR,
                       'selectors' => [
                           $hover_selector => 'color: {{VALUE}};',
                       ],
                   ]
               );

               $this->add_group_control(
                   \Elementor\Group_Control_Text_Shadow::get_type(),
                   [
                       'name' =>  $widget.'text_shadow_hover_',
                       'label' => esc_html__( 'Text Shadow', 'element-ready-pro' ),
                       'selector' => $hover_selector ,
                   ]
               );

               // Hover Background
               $this->add_group_control(
                   Group_Control_Background::get_type(),
                   [
                       'name'     => 'hover_'.$element_name.'_background',
                       'label'    => esc_html__( 'Background', 'element-ready-pro' ),
                       'types'    => [ 'classic', 'gradient' ],
                       'selector' => $hover_selector,
                   ]
               );	

               // Border
               $this->add_group_control(
                   Group_Control_Border::get_type(),
                   [
                       'name'     => 'hover_'.$element_name.'_border',
                       'label'    => esc_html__( 'Border', 'element-ready-pro' ),
                       'selector' => $hover_selector,
                   ]
               );

               // Radius
               $this->add_responsive_control(
                   'hover_'.$element_name.'_radius',
                   [
                       'label'      => esc_html__( 'Border Radius', 'element-ready-pro' ),
                       'type'       => Controls_Manager::DIMENSIONS,
                       'size_units' => [ 'px', '%', 'em' ],
                       'selectors'  => [
                           $hover_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                       ],
                   ]
               );

               // Shadow
               $this->add_group_control(
                   Group_Control_Box_Shadow:: get_type(),
                   [
                       'name'     => 'hover_'.$element_name.'_shadow',
                       'selector' => $hover_selector,
                   ]
               );

               $this->add_responsive_control(
                   $widget.'main_section_'.$element_name.'_element_ready_control_hover_custom_css',
                   [
                       'label'     => esc_html__( 'Custom CSS', 'element-ready-pro' ),
                       'type'      => Controls_Manager::CODE,
                       'rows'      => 20,
                       'language'  => 'css',
                       'selectors' => [
                           $hover_selector => '{{VALUE}};',
                         
                       ],
                       'separator' => 'before',
                   ]
               );
               
           $this->end_controls_tab();
           } // hover_select check end
       $this->end_controls_tabs();

       $this->add_responsive_control(
           $widget.'_section___section_show_hide_'.$element_name.'_display',
           [
               'label' => esc_html__( 'Display', 'element-ready-pro' ),
               'type' => \Elementor\Controls_Manager::SELECT,
               'default' => '',
               'options' => [
                   'flex'         => esc_html__( 'Flex', 'element-ready-pro' ),
                   'inline-flex'         => esc_html__( 'Inline Flex', 'element-ready-pro' ),
                   'block'        => esc_html__( 'Block', 'element-ready-pro' ),
                   'inline-block' => esc_html__( 'Inline Block', 'element-ready-pro' ),
                   'grid'         => esc_html__( 'Grid', 'element-ready-pro' ),
                   'none'         => esc_html__( 'None', 'element-ready-pro' ),
                   ''         => esc_html__( 'Default', 'element-ready-pro' ),
               ],
               'selectors' => [
                  $selector => 'display: {{VALUE}};',
               ],
           ]
       );

       $this->add_responsive_control(
           $widget.'_section___section_flex_direction_'.$element_name.'_display',
           [
               'label' => esc_html__( 'Flex Direction', 'element-ready-pro' ),
               'type' => \Elementor\Controls_Manager::SELECT,
               'default' => '',
               'options' => [
                   'column'         => esc_html__( 'Column', 'element-ready-pro' ),
                   'row'            => esc_html__( 'Row', 'element-ready-pro' ),
                   'column-reverse' => esc_html__( 'Column Reverse', 'element-ready-pro' ),
                   'row-reverse'    => esc_html__( 'Row Reverse', 'element-ready-pro' ),
                   'revert'         => esc_html__( 'Revert', 'element-ready-pro' ),
                   'none'           => esc_html__( 'None', 'element-ready-pro' ),
                   ''               => esc_html__( 'inherit', 'element-ready-pro' ),
               ],
               'selectors' => [
                   $selector => 'flex-direction: {{VALUE}};'
               ],
               'condition' => [ $widget.'_section___section_show_hide_'.$element_name.'_display' => ['flex','inline-flex'] ]
           ]
           
       );

       $this->add_responsive_control(
           $widget.'_section__s_section_flex_wrap_'.$element_name.'_display',
           [
               'label' => esc_html__( 'Flex Wrap', 'element-ready-pro' ),
               'type' => \Elementor\Controls_Manager::SELECT,
               'default' => '',
               'options' => [
                   'wrap'         => esc_html__( 'Wrap', 'element-ready-pro' ),
                   'wrap-reverse' => esc_html__( 'Wrap Reverse', 'element-ready-pro' ),
                   'nowrap'    => esc_html__( 'No Wrap', 'element-ready-pro' ),
                   'unset'         => esc_html__( 'Unset', 'element-ready-pro' ),
                   'normal'           => esc_html__( 'None', 'element-ready-pro' ),
                   'inherit'               => esc_html__( 'inherit', 'element-ready-pro' ),
               ],
               'selectors' => [
                   $selector => 'flex-wrap: {{VALUE}};'
               ],
               'condition' => [ $widget.'_section___section_show_hide_'.$element_name.'_display' => ['flex','inline-flex'] ]
           ]
           
       );

       $this->add_responsive_control(
           $widget.'_section_align_sessction_e_'.$element_name.'_flex_align',
           [
               'label' => esc_html__( 'Alignment', 'element-ready-pro' ),
               'type' => \Elementor\Controls_Manager::SELECT,
               'default' => '',
               'options' => [
                   'flex-start'    => esc_html__( 'Left', 'element-ready-pro' ),
                   'flex-end'      => esc_html__( 'Right', 'element-ready-pro' ),
                   'center'        => esc_html__( 'Center', 'element-ready-pro' ),
                   'space-around'  => esc_html__( 'Space Around', 'element-ready-pro' ),
                   'space-between' => esc_html__( 'Space Between', 'element-ready-pro' ),
                   'space-evenly'  => esc_html__( 'Space Evenly', 'element-ready-pro' ),
                   ''              => esc_html__( 'inherit', 'element-ready-pro' ),
               ],
               'condition' => [ $widget.'_section___section_show_hide_'.$element_name.'_display' => ['flex','inline-flex'] ],

               'selectors' => [
                   $selector => 'justify-content: {{VALUE}};'
              ],
           ]
           
       );

       $this->add_responsive_control(
           $widget.'er_section_align_items_ssection_e_'.$element_name.'_flex_align',
           [
               'label' => esc_html__( 'Align Items', 'element-ready-pro' ),
               'type' => \Elementor\Controls_Manager::SELECT,
               'default' => '',
               'options' => [
                   'flex-start'    => esc_html__( 'Left', 'element-ready-pro' ),
                   'flex-end'      => esc_html__( 'Right', 'element-ready-pro' ),
                   'center'        => esc_html__( 'Center', 'element-ready-pro' ),
                   'baseline'  => esc_html__( 'Baseline', 'element-ready-pro' ),
                   ''              => esc_html__( 'inherit', 'element-ready-pro' ),
               ],
               'condition' => [ $widget.'_section___section_show_hide_'.$element_name.'_display' => ['flex','inline-flex'] ],

               'selectors' => [
                   $selector => 'align-items: {{VALUE}};'
              ],
           ]
           
       );


       $this->add_control(
           $widget.'_section___section_popover_'.$element_name.'_position',
           [
               'label'        => esc_html__( 'Position', 'element-ready-pro' ),
               'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
               'label_off'    => esc_html__( 'Default', 'element-ready-pro' ),
               'label_on'     => esc_html__( 'Custom', 'element-ready-pro' ),
               'return_value' => 'yes',
           ]
       );

       $this->start_popover();
       $this->add_responsive_control(
           $widget.'_section__'.$element_name.'_position_type',
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
                   $selector => 'position: {{VALUE}};',
               ],
             
           ]
       );

       $this->add_responsive_control(
           $widget.'main_section_'.$element_name.'_position_left',
           [
               'label' => esc_html__( 'Position Left', 'element-ready-pro' ),
               'type' => Controls_Manager::SLIDER,
               'size_units' => [ 'px', '%' ],
               'range' => [
                   'px' => [
                       'min' => -1600,
                       'max' => 1600,
                       'step' => 5,
                   ],
                   '%' => [
                       'min' => 0,
                       'max' => 100,
                   ],
               ],
              
               'selectors' => [
                   $selector => 'left: {{SIZE}}{{UNIT}};',
               ],
           ]
       );

       $this->add_responsive_control(
           $widget.'main_section_'.$element_name.'_r_position_top',
           [
               'label' => esc_html__( 'Position Top', 'element-ready-pro' ),
               'type' => Controls_Manager::SLIDER,
               'size_units' => [ 'px', '%' ],
               'range' => [
                   'px' => [
                       'min' => -1600,
                       'max' => 1600,
                       'step' => 5,
                   ],
                   '%' => [
                       'min' => 0,
                       'max' => 100,
                   ],
               ],
              
               'selectors' => [
                   $selector => 'top: {{SIZE}}{{UNIT}};',
               ],
           ]
       );

       $this->add_responsive_control(
           $widget.'main_section_'.$element_name.'_r_position_bottom',
           [
               'label' => esc_html__( 'Position Bottom', 'element-ready-pro' ),
               'type' => Controls_Manager::SLIDER,
               'size_units' => [ 'px', '%' ],
               'range' => [
                   'px' => [
                       'min' => -1600,
                       'max' => 1600,
                       'step' => 5,
                   ],
                   '%' => [
                       'min' => 0,
                       'max' => 100,
                   ],
               ],
              
               'selectors' => [
                   $selector  => 'bottom: {{SIZE}}{{UNIT}};',
               ],
           ]
       );
       $this->add_responsive_control(
           $widget.'main_section_'.$element_name.'_r_position_right',
           [
               'label' => esc_html__( 'Position Right', 'element-ready-pro' ),
               'type' => Controls_Manager::SLIDER,
               'size_units' => [ 'px', '%' ],
               'range' => [
                   'px' => [
                       'min' => -1600,
                       'max' => 1600,
                       'step' => 5,
                   ],
                   '%' => [
                       'min' => 0,
                       'max' => 100,
                   ],
               ],
              
               'selectors' => [
                   $selector => 'right: {{SIZE}}{{UNIT}};',
               ],
           ]
       );
       $this->end_popover();

     
  
   $this->end_controls_section();
   /*----------------------------
       ELEMENT__STYLE END
   -----------------------------*/
}



public function text_wrapper_css($atts) {

   $atts_variable = shortcode_atts(
       array(
           'title' => esc_html__('Text Style','element-ready-pro'),
           'slug' => '_text_style',
           'element_name' => '_element_ready_',
           'selector' => '{{WRAPPER}} ',
           'hover_selector' => '{{WRAPPER}} ',
           'condition' => '',
       ), $atts );

   extract($atts_variable);    
   
   $widget = $this->get_name().'_'.element_ready_heading_camelize($slug);

 
   /*----------------------------
       ELEMENT__STYLE
   -----------------------------*/
   $tab_start_section_args =  [
       'label' => $title,
       'tab'   => Controls_Manager::TAB_STYLE,
   ];

   if(is_array($condition)){
       $tab_start_section_args['condition'] = $condition;
   }
 
   $this->start_controls_section(
       $widget.'_style_section',
       $tab_start_section_args
   );

   

       $this->start_controls_tabs( $widget.'_tabs_style' );
           $this->start_controls_tab(
               $widget.'_normal_tab',
               [
                   'label' => esc_html__( 'Normal', 'element-ready-pro' ),
               ]
           );

              

               // Typgraphy
               $this->add_group_control(
                   Group_Control_Typography:: get_type(),
                   [
                       'name'      => $widget.'_typography',
                       'selector'  => $selector,
                   ]
               );

               // Icon Color
               $this->add_control(
                   $widget.'_text_color',
                   [
                       'label'     => esc_html__( 'Color', 'element-ready-pro' ),
                       'type'      => Controls_Manager::COLOR,
                       'default'   => '',
                       'selectors' => [
                           $selector => 'color: {{VALUE}} !important;',
                       ],
                   ]
               );

               $this->add_group_control(
                   \Elementor\Group_Control_Text_Shadow::get_type(),
                   [
                       'name' =>  $widget.'text_shadow_',
                       'label' => esc_html__( 'Text Shadow', 'element-ready-pro' ),
                       'selector' => $selector ,
                   ]
               );
       

               // Background
               $this->add_group_control(
                  \Elementor\Group_Control_Background:: get_type(),
                   [
                       'name'     => $widget.'text_background',
                       'label'    => esc_html__( 'Background', 'element-ready-pro' ),
                       'types'    => [ 'classic', 'gradient','video' ],
                       'selector' => $selector,
                   ]
               );

               // Border
               $this->add_group_control(
                  \Elementor\Group_Control_Border::get_type(),
                   [
                       'name'     => $widget.'_border',
                       'label'    => esc_html__( 'Border', 'element-ready-pro' ),
                       'selector' => $selector,
                   ]
               );

               // Radius
               $this->add_responsive_control(
                   $widget.'_radius',
                   [
                       'label'      => esc_html__( 'Border Radius', 'element-ready-pro' ),
                       'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                       'size_units' => [ 'px', '%', 'em' ],
                       'selectors'  => [
                           $selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                       ],
                   ]
               );
               
               // Shadow
               $this->add_group_control(
                  \Elementor\Group_Control_Box_Shadow::get_type(),
                   [
                       'name'     => $widget.'normal_shadow',
                       'selector' => $selector,
                   ]
               );

               // Margin
               $this->add_responsive_control(
                   $widget.'_margin',
                   [
                       'label'      => esc_html__( 'Margin', 'element-ready-pro' ),
                       'type'       => Controls_Manager::DIMENSIONS,
                       'size_units' => [ 'px', '%', 'em' ],
                       'selectors'  => [
                           $selector  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                       ],
                   ]
               );

               // Padding
               $this->add_responsive_control(
                   $widget.'_padding',
                   [
                       'label'      => esc_html__( 'Padding', 'element-ready-pro' ),
                       'type'       => Controls_Manager::DIMENSIONS,
                       'size_units' => [ 'px', '%', 'em' ],
                       'selectors'  => [
                           $selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                       ],
                   ]
               );

               $this->add_responsive_control(
                   $widget.'main_section_'.$element_name.'_element_ready_control_custom_css',
                   [
                       'label'     => esc_html__( 'Custom CSS', 'element-ready-pro' ),
                       'type'      => Controls_Manager::CODE,
                       'rows'      => 20,
                       'language'  => 'css',
                       'selectors' => [
                           $selector => '{{VALUE}};',
                         
                       ],
                       'separator' => 'before',
                   ]
               );

               
               $this->add_responsive_control(
                   $widget.'main_section_'.$element_name.'_r_item_el__width',
                   [
                       'label' => esc_html__( 'Width', 'element-ready-pro' ),
                       'type' => Controls_Manager::SLIDER,
                       'size_units' => [ 'px', '%' ],
                       'range' => [
                           'px' => [
                               'min' => 0,
                               'max' => 3000,
                               'step' => 5,
                           ],
                           '%' => [
                               'min' => 0,
                               'max' => 100,
                           ],
                       ],
                   
                       'selectors' => [
                           $selector => 'width: {{SIZE}}{{UNIT}};',
                       
                       ],
                   ]
               );

               $this->add_responsive_control(
                   $widget.'main_section_'.$element_name.'_r_item__maxel__width',
                   [
                       'label' => esc_html__( 'Max Width', 'element-ready-pro' ),
                       'type' => Controls_Manager::SLIDER,
                       'size_units' => [ 'px', '%' ],
                       'range' => [
                           'px' => [
                               'min' => 0,
                               'max' => 3000,
                               'step' => 5,
                           ],
                           '%' => [
                               'min' => 0,
                               'max' => 100,
                           ],
                       ],
                   
                       'selectors' => [
                           $selector => 'max-width: {{SIZE}}{{UNIT}};',
                       
                       ],
                   ]
               );

               $this->add_responsive_control(
                   $widget.'main_section_'.$element_name.'_r_item__min_el__width',
                   [
                       'label' => esc_html__( 'Min Width', 'element-ready-pro' ),
                       'type' => Controls_Manager::SLIDER,
                       'size_units' => [ 'px', '%' ],
                       'range' => [
                           'px' => [
                               'min' => 0,
                               'max' => 3000,
                               'step' => 5,
                           ],
                           '%' => [
                               'min' => 0,
                               'max' => 100,
                           ],
                       ],
                   
                       'selectors' => [
                           $selector => 'min-width: {{SIZE}}{{UNIT}};',
                       
                       ],
                   ]
               );

           $this->end_controls_tab();
           if($hover_selector != false || $hover_selector != ''){

           $this->start_controls_tab(
               $widget.'_hover_tab',
               [
                   'label' => esc_html__( 'Hover', 'element-ready-pro' ),
               ]
           );

               //Hover Color
               $this->add_control(
                   'hover_'.$element_name.'_color',
                   [
                       'label'     => esc_html__( 'Color', 'element-ready-pro' ),
                       'type'      => Controls_Manager::COLOR,
                       'selectors' => [
                           $hover_selector => 'color: {{VALUE}} !important;',
                       ],
                   ]
               );

               $this->add_group_control(
                   \Elementor\Group_Control_Text_Shadow::get_type(),
                   [
                       'name' =>  $widget.'text_shadow_hover_',
                       'label' => esc_html__( 'Text Shadow', 'element-ready-pro' ),
                       'selector' => $hover_selector ,
                   ]
               );

               // Hover Background
               $this->add_group_control(
                  \Elementor\Group_Control_Background::get_type(),
                   [
                       'name'     => 'hover_'.$element_name.'_background',
                       'label'    => esc_html__( 'Background', 'element-ready-pro' ),
                       'types'    => [ 'classic', 'gradient' ],
                       'selector' => $hover_selector,
                   ]
               );	

               // Border
               $this->add_group_control(
                  \Elementor\Group_Control_Border::get_type(),
                   [
                       'name'     => 'hover_'.$element_name.'_border',
                       'label'    => esc_html__( 'Border', 'element-ready-pro' ),
                       'selector' => $hover_selector,
                   ]
               );

               // Radius
               $this->add_responsive_control(
                   'hover_'.$element_name.'_radius',
                   [
                       'label'      => esc_html__( 'Border Radius', 'element-ready-pro' ),
                       'type'       => Controls_Manager::DIMENSIONS,
                       'size_units' => [ 'px', '%', 'em' ],
                       'selectors'  => [
                           $hover_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                       ],
                   ]
               );

               // Shadow
               $this->add_group_control(
                   \Elementor\Group_Control_Box_Shadow:: get_type(),
                   [
                       'name'     => 'hover_'.$element_name.'_shadow',
                       'selector' => $hover_selector,
                   ]
               );

               $this->add_responsive_control(
                   $widget.'main_section_'.$element_name.'_element_ready_control_hover_custom_css',
                   [
                       'label'     => esc_html__( 'Custom CSS', 'element-ready-pro' ),
                       'type'      => Controls_Manager::CODE,
                       'rows'      => 20,
                       'language'  => 'css',
                       'selectors' => [
                           $hover_selector => '{{VALUE}};',
                         
                       ],
                       'separator' => 'before',
                   ]
               );
               
           $this->end_controls_tab();
           } // hover_select check end
       $this->end_controls_tabs();

       $this->add_responsive_control(
           $widget.'_section___section_show_hide_'.$element_name.'_display',
           [
               'label' => esc_html__( 'Display', 'element-ready-pro' ),
               'type' => \Elementor\Controls_Manager::SELECT,
               'default' => '',
               'options' => [
                   'flex'         => esc_html__( 'Flex', 'element-ready-pro' ),
                   'inline-flex'         => esc_html__( 'Inline Flex', 'element-ready-pro' ),
                   'block'        => esc_html__( 'Block', 'element-ready-pro' ),
                   'inline-block' => esc_html__( 'Inline Block', 'element-ready-pro' ),
                   'grid'         => esc_html__( 'Grid', 'element-ready-pro' ),
                   'none'         => esc_html__( 'None', 'element-ready-pro' ),
                   ''         => esc_html__( 'Default', 'element-ready-pro' ),
               ],
               'selectors' => [
                  $selector => 'display: {{VALUE}};',
               ],
           ]
       );

       $this->add_responsive_control(
           $widget.'_section___section_flex_direction_'.$element_name.'_display',
           [
               'label' => esc_html__( 'Flex Direction', 'element-ready-pro' ),
               'type' => \Elementor\Controls_Manager::SELECT,
               'default' => '',
               'options' => [
                   'column'         => esc_html__( 'Column', 'element-ready-pro' ),
                   'row'         => esc_html__( 'Row', 'element-ready-pro' ),
                   'column-reverse'        => esc_html__( 'Column Reverse', 'element-ready-pro' ),
                   'row-reverse' => esc_html__( 'Row Reverse', 'element-ready-pro' ),
                   'revert'         => esc_html__( 'Revert', 'element-ready-pro' ),
                   'none'         => esc_html__( 'None', 'element-ready-pro' ),
                   ''             => esc_html__( 'inherit', 'element-ready-pro' ),
               ],
               'selectors' => [
                   $selector => 'flex-direction: {{VALUE}};'
               ],
               'condition' => [ $widget.'_section___section_show_hide_'.$element_name.'_display' => ['flex','inline-flex'] ]
           ]
           
       );

       
       $this->add_responsive_control(
           $widget.'_section__s_section_flexr_wrap_'.$element_name.'_display',
           [
               'label' => esc_html__( 'Flex Wrap', 'element-ready-pro' ),
               'type' => \Elementor\Controls_Manager::SELECT,
               'default' => '',
               'options' => [
                   'wrap'         => esc_html__( 'Wrap', 'element-ready-pro' ),
                   'wrap-reverse' => esc_html__( 'Wrap Reverse', 'element-ready-pro' ),
                   'nowrap'    => esc_html__( 'No Wrap', 'element-ready-pro' ),
                   'unset'         => esc_html__( 'Unset', 'element-ready-pro' ),
                   'normal'           => esc_html__( 'None', 'element-ready-pro' ),
                   'inherit'               => esc_html__( 'inherit', 'element-ready-pro' ),
               ],
               'selectors' => [
                   $selector => 'flex-wrap: {{VALUE}};'
               ],
               'condition' => [ $widget.'_section___section_show_hide_'.$element_name.'_display' => ['flex','inline-flex'] ]
           ]
           
       );

       $this->add_responsive_control(
           $widget.'_section_align_sessctionr_e_'.$element_name.'_flex_align',
           [
               'label' => esc_html__( 'Alignment', 'element-ready-pro' ),
               'type' => \Elementor\Controls_Manager::SELECT,
               'default' => '',
               'options' => [
                   'flex-start'    => esc_html__( 'Left', 'element-ready-pro' ),
                   'flex-end'      => esc_html__( 'Right', 'element-ready-pro' ),
                   'center'        => esc_html__( 'Center', 'element-ready-pro' ),
                   'space-around'  => esc_html__( 'Space Around', 'element-ready-pro' ),
                   'space-between' => esc_html__( 'Space Between', 'element-ready-pro' ),
                   'space-evenly'  => esc_html__( 'Space Evenly', 'element-ready-pro' ),
                   ''              => esc_html__( 'inherit', 'element-ready-pro' ),
               ],
               'condition' => [ $widget.'_section___section_show_hide_'.$element_name.'_display' => ['flex','inline-flex'] ],

               'selectors' => [
                   $selector => 'justify-content: {{VALUE}};'
              ],
           ]
           
       );

       $this->add_responsive_control(
           $widget.'er_section_align_items_rssection_e_'.$element_name.'_flex_align',
           [
               'label' => esc_html__( 'Align Items', 'element-ready-pro' ),
               'type' => \Elementor\Controls_Manager::SELECT,
               'default' => '',
               'options' => [
                   'flex-start'    => esc_html__( 'Left', 'element-ready-pro' ),
                   'flex-end'      => esc_html__( 'Right', 'element-ready-pro' ),
                   'center'        => esc_html__( 'Center', 'element-ready-pro' ),
                   'baseline'  => esc_html__( 'Baseline', 'element-ready-pro' ),
                   ''              => esc_html__( 'inherit', 'element-ready-pro' ),
               ],
               'condition' => [ $widget.'_section___section_show_hide_'.$element_name.'_display' => ['flex','inline-flex'] ],

               'selectors' => [
                   $selector => 'align-items: {{VALUE}};'
              ],
           ]
           
       );

       $this->add_control(
           $widget.'_section___section_popover_'.$element_name.'_position',
           [
               'label'        => esc_html__( 'Position', 'element-ready-pro' ),
               'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
               'label_off'    => esc_html__( 'Default', 'element-ready-pro' ),
               'label_on'     => esc_html__( 'Custom', 'element-ready-pro' ),
               'return_value' => 'yes',
           ]
       );

       $this->start_popover();
       $this->add_responsive_control(
           $widget.'_section__'.$element_name.'_position_type',
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
                   $selector => 'position: {{VALUE}};',
               ],
             
           ]
       );

       $this->add_responsive_control(
           $widget.'main_section_'.$element_name.'_position_left',
           [
               'label' => esc_html__( 'Position Left', 'element-ready-pro' ),
               'type' => Controls_Manager::SLIDER,
               'size_units' => [ 'px', '%' ],
               'range' => [
                   'px' => [
                       'min' => -1600,
                       'max' => 1600,
                       'step' => 5,
                   ],
                   '%' => [
                       'min' => 0,
                       'max' => 100,
                   ],
               ],
              
               'selectors' => [
                   $selector => 'left: {{SIZE}}{{UNIT}};',
               ],
           ]
       );

       $this->add_responsive_control(
           $widget.'main_section_'.$element_name.'_r_position_top',
           [
               'label' => esc_html__( 'Position Top', 'element-ready-pro' ),
               'type' => Controls_Manager::SLIDER,
               'size_units' => [ 'px', '%' ],
               'range' => [
                   'px' => [
                       'min' => -1600,
                       'max' => 1600,
                       'step' => 5,
                   ],
                   '%' => [
                       'min' => 0,
                       'max' => 100,
                   ],
               ],
              
               'selectors' => [
                   $selector => 'top: {{SIZE}}{{UNIT}};',
               ],
           ]
       );

       $this->add_responsive_control(
           $widget.'main_section_'.$element_name.'_r_position_bottom',
           [
               'label' => esc_html__( 'Position Bottom', 'element-ready-pro' ),
               'type' => Controls_Manager::SLIDER,
               'size_units' => [ 'px', '%' ],
               'range' => [
                   'px' => [
                       'min' => -1600,
                       'max' => 1600,
                       'step' => 5,
                   ],
                   '%' => [
                       'min' => 0,
                       'max' => 100,
                   ],
               ],
              
               'selectors' => [
                   $selector  => 'bottom: {{SIZE}}{{UNIT}};',
               ],
           ]
       );
       $this->add_responsive_control(
           $widget.'main_section_'.$element_name.'_r_position_right',
           [
               'label' => esc_html__( 'Position Right', 'element-ready-pro' ),
               'type' => Controls_Manager::SLIDER,
               'size_units' => [ 'px', '%' ],
               'range' => [
                   'px' => [
                       'min' => -1600,
                       'max' => 1600,
                       'step' => 5,
                   ],
                   '%' => [
                       'min' => 0,
                       'max' => 100,
                   ],
               ],
              
               'selectors' => [
                   $selector => 'right: {{SIZE}}{{UNIT}};',
               ],
           ]
       );
       $this->end_popover();

     
  
   $this->end_controls_section();
   /*----------------------------
       ELEMENT__STYLE END
   -----------------------------*/
}


  

    
}