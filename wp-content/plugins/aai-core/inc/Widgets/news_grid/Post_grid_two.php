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

class Post_grid_two extends Widget_Base {

  
  public $base;

    public function get_name() {

        return 'element-ready-pro-multi-grid-post';
    }

    public function get_style_depends(){

        wp_enqueue_style( 'element-ready-grid', ELEMENT_READY_ROOT_CSS .'grid.css' ); 
        return [
           'element-ready-grid',
           'element-ready-news-grid'
        ];
  }

    public function get_title() {
        return esc_html__( 'ER Multi Grid Post', 'element-ready-pro' );
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
					'style2' => esc_html__( 'Style 2', 'element-ready-pro' ),
				
				],
			]
		);

       $this->end_controls_section();

       do_action( 'er_section_general_grid_tab_2', $this, $this->get_name() );
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
            'slug' => '_title_box_style',
            'element_name' => '_title_rapp_element_ready_',
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

      $this->start_controls_section(
        'element_ready_widget_sort_item_section',
        [
            
            'label' => esc_html__( 'Sort Content', 'element-ready-pro' ),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
      );

      $this->add_control(
        'er_meta_order',
        [
          'label'   => esc_html__( 'Meta', 'element-ready-pro' ),
          'type'    => Controls_Manager::NUMBER,
          'default' => 1,
          'min'     => -100,
          'step'    => 1,
          'selectors'	 => [
            '{{WRAPPER}} .meta-date' => 'order: {{VALUE}};',
         
          ],
        ]
      );

      $this->add_control(
        'er_title_order',
        [
          'label'   => esc_html__( 'Title', 'element-ready-pro' ),
          'type'    => Controls_Manager::NUMBER,
          'default' => 1,
          'min'     => -100,
          'step'    => 1,
          'selectors'	 => [
            '{{WRAPPER}} .er-news-title' => 'order: {{VALUE}};',
         
          ],
        ]
      );

      $this->add_control(
        'er_content_order',
        [
          'label'   => esc_html__( 'Content', 'element-ready-pro' ),
          'type'    => Controls_Manager::NUMBER,
          'default' => 1,
          'min'     => -100,
          'step'    => 1,
          'selectors'	 => [
            '{{WRAPPER}} .er-news-content' => 'order: {{VALUE}};',
         
          ],
        ]
      );

      

    $this->end_controls_section();

      $this->start_controls_section('newsprk_image_section',
            [
                'label' => esc_html__( 'Image ', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'label'        => esc_html__( 'Thumb Size', 'element-ready-pro' ),
                'name'    =>'thumb_size',
                'default' => 'large',
               
            ]
        );
         
        $this->add_responsive_control(
            'image_margin',
            [
            'label'      => esc_html__( ' Margin', 'element-ready-pro' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px','%'],
            'selectors'  => [
                '{{WRAPPER}} .post-thumb.er-small img'     => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                
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
                    '{{WRAPPER}} .post-thumb.er-small img'     => 'height: {{SIZE}}{{UNIT}};',
                
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
                    '{{WRAPPER}} .post-thumb.er-small img'     => 'width: {{SIZE}}{{UNIT}};',
                    
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
                    '{{WRAPPER}} .post-thumb.er-small img'     => 'max-width: {{SIZE}}{{UNIT}};',
                
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
                    
                    '{{WRAPPER}} .post-thumb.er-small img'      => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                
                    
                ],
            ]
            );

        $this->end_controls_section();
        
        $this->start_controls_section('vijnewsprk_image_section',
            [
                'label' => esc_html__( 'Big Image ', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => ['block_style' => 'style1']
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'label'        => esc_html__( 'Thumb Size', 'element-ready-pro' ),
                'name'    =>'big_thumb_size',
                'default' => 'large',
               
            ]
        );
        $this->add_responsive_control(
            'bihimage_margin',
            [
            'label'      => esc_html__( 'Margin', 'element-ready-pro' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px','%'],
            'selectors'  => [
                '{{WRAPPER}} .post-thumb.er-big img'     => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                
            ],
            ]
            );
            $this->add_responsive_control(
            'big_box_image_height',
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
                    '{{WRAPPER}}  .post-thumb.er-big img'     => 'height: {{SIZE}}{{UNIT}};',
                
                ],
                
            ]
            );
            
            $this->add_responsive_control(
            'bigbox_image_width',
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
                    '{{WRAPPER}} .post-thumb.er-big img'     => 'width: {{SIZE}}{{UNIT}};',
                    
                ],
                
            ]
            ); 

            $this->add_responsive_control(
            'bigbox_image_amax_width',
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
                    '{{WRAPPER}} .post-thumb.er-big img'     => 'max-width: {{SIZE}}{{UNIT}};',
                
                ],
                
            ]
        ); 

            $this->add_responsive_control(
            'bigimg_borders__radius',
            [
                'label'      => esc_html__( 'Image Border radius', 'element-ready-pro' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors'  => [
                    
                    '{{WRAPPER}} .post-thumb.er-big img'      => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                
                    
                ],
            ]
            );

        $this->end_controls_section();
        $this->text_wrapper_css(
            array(
                'title' => esc_html__('Item Wrapper','element-ready-pro'),
                'slug' => '_cat__swr_box_style',
                'element_name' => '_cat_wrasspper_element_ready_',
                'selector' => '{{WRAPPER}} .post-thumb',
            )
         );
      $this->text_wrapper_css(
         array(
             'title' => esc_html__('Category','element-ready-pro'),
             'slug' => '_cat_box_style',
             'element_name' => '_cat_wrapper_element_ready_',
             'selector' => '{{WRAPPER}} .post-thumb span',
         )
      );

      $this->text_wrapper_css(
        array(
            'title' => esc_html__('Date','element-ready-pro'),
            'slug' => '_date_box_style',
            'element_name' => '_date_wrapper_element_ready_',
            'selector' => '{{WRAPPER}} .meta-date span',
        )
     );
     
     $this->text_wrapper_css(
        array(
            'title' => esc_html__('Date Shape','element-ready-pro'),
            'slug' => '_date_shape_box_style',
            'element_name' => '_date_shape_wrapper_element_ready_',
            'selector' => '{{WRAPPER}} .qs_newsp_post-style-5-item .post-contact .meta-date span::before',
        )
     );
     

     $this->box_css(
        array(

            'title' => esc_html__('Content Area','element-ready-pro'),
            'slug' => '_content_area_verwr_box_style',
            'element_name' => '_content_ver_wer_wrapper_element_ready_',
            'selector' => '{{WRAPPER}} .qs_newsp_post-style-5-item .post-contact',
           
        )
     ); 
      
      $this->box_css(
         array(

             'title' => esc_html__('Content Conntainer','element-ready-pro'),
             'slug' => '_contnt_verwr_box_style',
             'element_name' => '_content_ver_wer_wrapper_element_ready_',
             'selector' => '{{WRAPPER}} .qs_newsp_post-style-5-item',
            
         )
      ); 

      $this->box_css(
         array(

             'title' => esc_html__('Hover Content Conntainer','element-ready-pro'),
             'slug' => '_contnt_hoverwr_box_style',
             'element_name' => '_content_hover_wer_wrapper_element_ready_',
             'selector' => '{{WRAPPER}} .qs_newsp_post-style-5-item',
         )
      ); 
      

    }

    protected function render( ) { 

        $settings        = $this->get_settings();
        $post_title_crop = $settings['post_title_crop'];
         
        if(is_search() || element_ready_lite_is_blog()){

          global $wp_query;
     
        }else{

            $data  = new Base_Modal($settings);
            $wp_query = $data->get();
        }

        if(!$wp_query){
             return;  
        }

        $total = $wp_query->post_count;
        ?>
        
        <div class="quomodo-container">  
            <div class="quomodo-row">
                <?php if($settings['block_style'] == 'style1'): ?>
                <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                        <?php
                            $index = $wp_query->current_post + 1; 
                            
                        ?>
                        
                        <?php if($index == 1 || $index == 2): ?>
                            
                            <?php echo $index == 1?'<div class="quomodo-col-lg-3 quomodo-col-md-6 order-1">':''; ?> 
                                <?php if($index == 1): ?>
                                    <div class="qs_newsp_post-style-5-item mb-10">
                                        <?php if( has_post_thumbnail() ): ?>
                                            <div class="post-thumb er-small">
                                            <?php  $thumb_link  = \Elementor\Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'thumb_size', $settings ); ?>
                                            <img src="<?php echo esc_url($thumb_link); ?>" alt="<?php the_title_attribute(); ?>">
                                            <?php
                                                    $categories = get_the_category();
                                                    if ( ! empty( $categories) && $settings['show_cat'] == 'yes' ) {
                                                        echo '<span>' . esc_html( $categories[0]->name ) . '</span>';
                                                    }
                                            ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="post-contact er-news-post-content-area">
                                            <h4 class="title er-news-title"><a href="<?php the_permalink() ?>"> <?php echo esc_html(wp_trim_words( get_the_title(),$settings['post_title_crop'], '' )); ?></a></h4>
                                            <?php if($settings['show_content'] == 'yes'): ?>
                                                 <p class="er-news-content"> <?php echo esc_html(wp_trim_words( get_the_excerpt(), $settings['post_content_crop'],'' )); ?> </p>
                                            <?php endif; ?>
                                            <?php if($settings['show_date']): ?>      
                                            <div class="meta-date element-ready-post-meta">
                                                <span><?php echo get_the_date(get_option( 'date_format' )); ?></span>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($index == 2): ?>
                                    <div class="qs_newsp_post-style-5-item mb-10">
                                        <?php if( has_post_thumbnail() ): ?>
                                            <div class="post-thumb er-small">
                                            <?php  $thumb_link  = \Elementor\Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'thumb_size', $settings ); ?>
                                            <img src="<?php echo esc_url($thumb_link); ?>" alt="<?php the_title_attribute(); ?>">
                                            <?php
                                                    $categories = get_the_category();
                                                    if ( ! empty( $categories) && $settings['show_cat'] == 'yes' ) {
                                                        echo '<span>' . esc_html( $categories[0]->name ) . '</span>';
                                                    }
                                            ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="post-contact er-news-post-content-area">
                                            <h4 class="title er-news-title"><a href="<?php the_permalink() ?>"> <?php echo esc_html(wp_trim_words( get_the_title(),$settings['post_title_crop'], '' )); ?></a></h4>
                                            <?php if($settings['show_content'] == 'yes'): ?>
                                                 <p class="er-news-content element-ready-content"> <?php echo esc_html(wp_trim_words( get_the_excerpt(), $settings['post_content_crop'],'' )); ?> </p>
                                            <?php endif; ?>
                                            <?php if($settings['show_date']): ?>      
                                                <div class="meta-date element-ready-post-meta">
                                                    <span><?php echo get_the_date(get_option( 'date_format' )); ?></span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            
                            <?php echo ($index == 2 && $total >= 2) || ($index == 1 && $total == 1) ?' </div>':''; ?>
                        
                    
                        <?php elseif( $index == 3 ): ?>
                            <div class="quomodo-col-lg-6 quomodo-order-lg-2 quomodo-order-3">
                                <div class="qs_newsp_post-style-5-item post-style-big mb-10">
                                    <?php if( has_post_thumbnail() ): ?>
                                        <div class="post-thumb er-big">
                                        <?php  $thumb_link = \Elementor\Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'big_thumb_size', $settings ); ?>
                                            <img src="<?php echo esc_url($thumb_link); ?>" alt="<?php the_title_attribute(); ?>">
                                                <?php
                                                    $categories = get_the_category();
                                                    if ( ! empty( $categories) && $settings['show_cat'] == 'yes' ) {
                                                        echo '<span>' . esc_html( $categories[0]->name ) . '</span>';
                                                    }
                                                ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="post-contact">
                                    <h4 class="title er-news-title"><a href="<?php the_permalink() ?>"> <?php echo esc_html(wp_trim_words( get_the_title(),$settings['post_title_crop'], '' )); ?></a></h4>
                                    <?php if($settings['show_middle_content'] == 'yes'): ?>
                                            <p class="er-news-content element-ready-content"> <?php echo esc_html(wp_trim_words( get_the_excerpt(), $settings['post_content_crop'],'' )); ?> </p>
                                    <?php endif; ?> 
                                        <?php if($settings['show_date']): ?>      
                                            <div class="meta-date">
                                                <span><?php echo get_the_date(get_option( 'date_format' )); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php elseif( $index > 3 ): ?>
                            <?php echo $index == 4?'<div class="quomodo-col-lg-3 quomodo-col-md-6 quomodo-order-lg-3 quomodo-order-2">':''; ?> 
                                <?php if( $index == 4 ): ?>
                                    <div class="qs_newsp_post-style-5-item mb-10">
                                        <?php if( has_post_thumbnail() ): ?>
                                            <div class="post-thumb er-small">
                                            <?php $thumb_link = \Elementor\Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'thumb_size', $settings ); ?>
                                                <img src="<?php echo esc_url($thumb_link); ?>" alt="<?php the_title_attribute(); ?>">
                                                    <?php
                                                        $categories = get_the_category();
                                                        if ( ! empty( $categories) && $settings['show_cat'] == 'yes' ) {
                                                            echo '<span>' . esc_html( $categories[0]->name ) . '</span>';
                                                        }
                                                    ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="post-contact">
                                        <h4 class="title er-news-title"><a href="<?php the_permalink() ?>"> <?php echo esc_html(wp_trim_words( get_the_title(),$settings['post_title_crop'], '' )); ?></a></h4>
                                            <?php if($settings['show_content'] == 'yes'): ?>
                                                 <p class="er-news-content"> <?php echo esc_html(wp_trim_words( get_the_excerpt(), $settings['post_content_crop'],'' )); ?> </p>
                                            <?php endif; ?>
                                            <?php if($settings['show_date']): ?>      
                                            <div class="meta-date">
                                                <span><?php echo get_the_date(get_option( 'date_format' )); ?></span>
                                            </div>
                                        <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if( $index == 5 ): ?>
                                    <div class="qs_newsp_post-style-5-item mb-10">
                                        <?php if( has_post_thumbnail() ): ?>
                                            <div class="post-thumb er-small">
                                            <?php  $thumb_link  = \Elementor\Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'thumb_size', $settings ); ?>
                                                <img src="<?php echo esc_url($thumb_link); ?>" alt="<?php the_title_attribute(); ?>">
                                                    <?php
                                                        $categories = get_the_category();
                                                        if ( ! empty( $categories) && $settings['show_cat'] == 'yes' ) {
                                                            echo '<span>' . esc_html( $categories[0]->name ) . '</span>';
                                                        }
                                                    ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="post-contact">
                                        <h4 class="title er-news-title"><a href="<?php the_permalink() ?>"> <?php echo esc_html(wp_trim_words( get_the_title(),$settings['post_title_crop'], '' )); ?></a></h4>
                                            <?php if($settings['show_content'] == 'yes'): ?>
                                                 <p class="er-news-content"> <?php echo esc_html(wp_trim_words( get_the_excerpt(), $settings['post_content_crop'],'' )); ?> </p>
                                            <?php endif; ?>
                                            <?php if($settings['show_date']): ?>      
                                            <div class="meta-date">
                                                <span><?php echo get_the_date(get_option( 'date_format' )); ?></span>
                                            </div>
                                        <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                <?php endif; ?>
                                <?php echo ($index == 5 && $total >= 4) || ($index == 4 && $total == 4) ?' </div>':''; ?>
                        <?php endif; ?>
                    <?php endwhile; wp_reset_postdata(); ?>
                <?php endif; ?>
                <?php if($settings['block_style'] == 'style2'): ?>
                    <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                        <?php
                            $index = $wp_query->current_post + 1; 
                            
                        ?>
                            
                            <?php echo $index == 1?'<div class="quomodo-col-lg-12 quomodo-order-1">':''; ?> 
                                
                                    <div class="qs_newsp_post-style-5-item mb-10">
                                        <?php if( has_post_thumbnail() ): ?>
                                            <div class="post-thumb er-small">
                                            <?php  $thumb_link  = \Elementor\Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'thumb_size', $settings ); ?>
                                            <img src="<?php echo esc_url($thumb_link); ?>" alt="<?php the_title_attribute(); ?>">
                                            <?php
                                                    $categories = get_the_category();
                                                    if ( ! empty( $categories) && $settings['show_cat'] == 'yes' ) {
                                                        echo '<span>' . esc_html( $categories[0]->name ) . '</span>';
                                                    }
                                            ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="post-contact">
                                            <h4 class="title er-news-title"><a href="<?php the_permalink() ?>"> <?php echo esc_html(wp_trim_words( get_the_title(),$settings['post_title_crop'], '' )); ?></a></h4>
                                            <?php if($settings['show_content'] == 'yes'): ?>
                                                 <p class="er-news-content"> <?php echo esc_html(wp_trim_words( get_the_excerpt(), $settings['post_content_crop'],'' )); ?> </p>
                                            <?php endif; ?>
                                            <?php if($settings['show_date']): ?>      
                                            <div class="meta-date">
                                                <span><?php echo get_the_date(get_option( 'date_format' )); ?></span>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                
                            
                            <?php echo ( $index ==  $total )  ?' </div>':''; ?>
                        
                        
                    <?php endwhile; wp_reset_postdata(); ?>
                <?php endif; ?>
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
           'title'          => esc_html__('Text Style','element-ready-pro'),
           'slug'           => '_text_style',
           'element_name'   => '_element_ready_',
           'selector'       => '{{WRAPPER}} ',
           'hover_selector' => '{{WRAPPER}} ',
           'condition'      => '',
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