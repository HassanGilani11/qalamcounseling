<?php
namespace Element_Ready_Pro\Widgets\news_grid;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Element_Ready\Base\Repository\Base_Modal;

require_once( ELEMENT_READY_DIR_PATH . '/inc/style_controls/common/common.php' );
require_once( ELEMENT_READY_DIR_PATH . '/inc/style_controls/position/position.php' );
require_once( ELEMENT_READY_DIR_PATH . '/inc/style_controls/box/box_style.php' );
require_once( ELEMENT_READY_DIR_PATH . '/inc/content_controls/common.php' );

if ( ! defined( 'ABSPATH' ) ) exit;

class Post_grid extends Widget_Base {

   use \Elementor\Element_Ready_Common_Style;
   use \Elementor\Element_ready_common_content;
   use \Elementor\Element_Ready_Box_Style;

   public $base;

    public function get_name() {
        return 'element-ready-grid-post';
    }

    public function get_title() {
        return esc_html__( 'ER Grid Post', 'element-ready-pro' );
    }

    public function get_icon() { 
        return "eicon-posts-grid";
    }

    public function get_categories() {
       return [ 'element-ready-pro' ];
    }

   
   public function get_script_depends(){
         
         return [
            'element-ready-core',
         ];
   }
   
   public function get_style_depends(){
         
         return [
            'element-ready-news-grid','element-ready-grid'
         ];
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

					'style1' => esc_html__( 'Style 1', 'element-ready-pro' ),
					'style2' => esc_html__( 'Style 2', 'element-ready-pro' ),
					'style3' => esc_html__( 'Style 3', 'element-ready-pro' ),
			
				],
			]
		);
       $this->end_controls_section();
       
        $this->start_controls_section('element_ready_block_title_section',
        [
           'label' => esc_html__( 'Heading', 'element-ready-pro' ),
           'condition' => [ 'block_style' => ['style2','style2','style4'] ] 
        ]
       );
            $this->add_control(
               'heading',
               [
               'label'     => esc_html__( 'Title', 'element-ready-pro' ),
               'type'      => Controls_Manager::TEXT,
               'default'   => esc_html__( 'Sports Post', 'element-ready-pro' ),
              
               ]
            );
           

       $this->end_controls_section();
       /**-----------------------------*/
      
       $this->content_text([
          'title' => esc_html__('Advanced Content','element-ready-pro'),
          'slug' => '_advanced_content',
          'condition' => '',
          'controls' => [
               
              'column'=> [
                  'label'     => esc_html__('Enable Column', 'element-ready-pro'),
                  'type'      => Controls_Manager::SWITCHER,
                  'label_on'  => esc_html__('Yes', 'element-ready-pro'),
                  'label_off' => esc_html__('No', 'element-ready-pro'),
                  'default'   => '',
                  'condition' => [ 'block_style' => ['style1'] ]
              ],  

              'column_number'=> [
                  'label' => esc_html__( 'Column Number', 'element-ready-pro' ),
                  'type' => \Elementor\Controls_Manager::SELECT,
                  'default' => 'col-6',
                  'options' => [

                     'col-md-6'  => esc_html__( 'Column 6', 'element-ready-pro' ),
                     'col-md-4'  => esc_html__( 'Column 4', 'element-ready-pro' ),
                     'col-md-3'  => esc_html__( 'Column 3', 'element-ready-pro' ),
                     'col-md-2'  => esc_html__( 'Column 2', 'element-ready-pro' ),
                     'col-md-5'  => esc_html__( 'Column 5', 'element-ready-pro' ),
                     'col-md-12' => esc_html__( 'Colmun 12', 'element-ready-pro' ),
                     'col-md-8'  => esc_html__( 'Colmun 8', 'element-ready-pro' ),
                     'col-md-7'  => esc_html__( 'Colmun 7', 'element-ready-pro' ),
                     'col-md-9'  => esc_html__( 'Colmun 9', 'element-ready-pro' ),
                     'col-md-10' => esc_html__( 'Colmun 10', 'element-ready-pro' ),
                     'col-md-11' => esc_html__( 'Colmun 11', 'element-ready-pro' ),
                     ''          => esc_html__( 'Empty', 'element-ready-pro' ),
                     
                  ],
                  'condition' => [
                     'column' => ['yes']
                  ]
              ],  


              'sort_image_bottom'=> [
                  'label'     => esc_html__('Image Reverse', 'element-ready-pro'),
                  'type'      => Controls_Manager::SWITCHER,
                  'label_on'  => esc_html__('Yes', 'element-ready-pro'),
                  'label_off' => esc_html__('No', 'element-ready-pro'),
                  'default'   => '',
                 
              ],

              'title_order'=> [
               'label'     => esc_html__('Title Order', 'element-ready-pro'),
               'type'          => Controls_Manager::NUMBER,
               'default'      => 0, 
               'selectors'  => [
                  '{{WRAPPER}} .element-ready-title' => 'order: {{VALUE}};',
               ],
               'description' => esc_html__('To order element please give flex option in content box in style section','element-ready-pro')
              ],

              'excerpt_order'=> [
               'label'     => esc_html__('Excerpt / Content Order', 'element-ready-pro'),
               'type'          => Controls_Manager::NUMBER,
               'default'      => 0, 
               'description' => esc_html__('To order element please give flex option in content box in style section','element-ready-pro'),
               'selectors'  => [
                  '{{WRAPPER}} .element-ready-content' => 'order: {{VALUE}};',
               ], 
             ],

              'meta_order'=> [
               'label'     => esc_html__('Meta Order', 'element-ready-pro'),
               'type'          => Controls_Manager::NUMBER,
               'default'      => 0, 
               'selectors'  => [
                  '{{WRAPPER}} .element-ready-post-meta' => 'order: {{VALUE}};',
               ],
               'description' => esc_html__('To order element please give flex option in content box in style section','element-ready-pro')
              ],

              'readmore_order'=> [
                'label'     => esc_html__('Readmore Order', 'element-ready-pro'),
                'type'          => Controls_Manager::NUMBER,
                'default'      => 0, 
                'condition' => [ 'block_style' => ['style2','style1','style3'] ],
                'selectors'  => [
                   '{{WRAPPER}} .element-ready-news-btn' => 'order: {{VALUE}};',
                ],
                'description' => esc_html__('To order element please give flex option in content box in style section','element-ready-pro')
               ],

             

              
          ]
       ]);

         do_action( 'element_ready_section_general_grid_tab', $this, $this->get_name() );
         do_action( 'element_ready_section_data_exclude_tab', $this , $this->get_name() );  
         do_action( 'element_ready_section_date_filter_tab', $this , $this->get_name());  
         do_action( 'element_ready_section_taxonomy_filter_tab', $this , $this->get_name());  
         do_action( 'element_ready_section_sort_tab', $this , $this->get_name());  
         do_action( 'element_ready_section_sticky_tab', $this , $this->get_name());  

         $this->content_text([
            'title' => esc_html__('Meta Icon','element-ready-pro'),
            'slug' => '_meta_icons_content',
            'condition' => '',
            'controls' => [
            
                'meta_icon'=> [
                  'label'         => esc_html__( 'Meta Icon', 'element-ready-pro' ),
                  'type' => \Elementor\Controls_Manager::ICONS,
                ],
  
                'meta_cat_icon'=> [
                  'label'         => esc_html__( 'Meta Category Icon', 'element-ready-pro' ),
                  'type' => \Elementor\Controls_Manager::ICONS,
                ],
  
                'meta_author_icon'=> [
                  'label'         => esc_html__( 'Meta Author Icon', 'element-ready-pro' ),
                  'type' => \Elementor\Controls_Manager::ICONS,
                ],
  
                'meta_date_icon'=> [
                  'label'         => esc_html__( 'Meta Date Icon', 'element-ready-pro' ),
                  'type' => \Elementor\Controls_Manager::ICONS,
                ],
  
                'meta_comment_icon'=> [
                  'label'         => esc_html__( 'Meta Comment Icon', 'element-ready-pro' ),
                  'type' => \Elementor\Controls_Manager::ICONS,
                ],
  
                
            ]
         ]);
  
 
         /*--------------------------
            STYLE
        ----------------------------*/

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
             '{{WRAPPER}} .element-ready-post-meta' => 'order: {{VALUE}};',
          
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
             '{{WRAPPER}} .element-ready-title' => 'order: {{VALUE}};',
          
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
             '{{WRAPPER}} .element-ready-content' => 'order: {{VALUE}};',
          
           ],
         ]
       );

       $this->add_control(
         'er_readmore_order',
         [
           'label'   => esc_html__( 'Readmore', 'element-ready-pro' ),
           'type'    => Controls_Manager::NUMBER,
           'default' => 1,
           'min'     => -100,
           'step'    => 1,
           'selectors'	 => [
             '{{WRAPPER}} .element-ready-news-btn' => 'order: {{VALUE}};',
          
           ],
         ]
       );

     $this->end_controls_section();

        $this->box_css(
         array(
            'title' => esc_html__('Content Box','element-ready-pro'),
            'slug' => 'content_box_box_style',
            'element_name' => 'content_box_element_ready_',
            'selector' => '{{WRAPPER}} .element-ready-trending-news-content',
         )
        );

        $this->text_minimum_css(
               array(
                  'title' => esc_html__('Post Title','element-ready-pro'),
                  'slug' => 'post_title_style',
                  'element_name' => 'post_title_element_ready_',
                  'selector' => '{{WRAPPER}} .element-ready-title a',
                  'hover_selector' => '{{WRAPPER}} .element-ready-title:hover a',
                  // 'condition' => [
                  //    'title_hide' => '',
                  // ],
               )
         );

         $this->text_wrapper_css(
            array(
                'title' => esc_html__('Title Wrapper','element-ready-pro'),
                'slug' => 'title_wrapper_box_style',
                'element_name' => 'title_wrapper_element_ready_',
                'selector' => '{{WRAPPER}} .element-ready-title',
            )
        );

         $this->text_minimum_css(
            array(
               'title' => esc_html__('Post Details','element-ready-pro'),
               'slug' => 'post_content_style',
               'element_name' => 'post_content_element_ready_',
               'selector' => '{{WRAPPER}} .element-ready-content',
               'hover_selector' => '{{WRAPPER}} .element-ready-content:hover',
               'condition' => [
                  'show_content' => 'yes',
               ],
            )
        );

        

        $this->box_minimum_css(
               array(
                  'title' => esc_html__('Image Wrapper','element-ready-pro'),
                  'slug' => 'post_image_wrapper_box_style',
                  'element_name' => 'post_image_wrapper_element_ready_',
                  'selector' => '{{WRAPPER}} .element-ready-trending-news-thumb',
               )
         );

         $this->box_css(
            array(
               'title' => esc_html__('Image','element-ready-pro'),
               'slug' => 'post_image_box_style',
               'element_name' => 'post_image_element_ready_',
               'selector' => '{{WRAPPER}} .element-ready-trending-news-thumb img',
            )
         );
         
         $this->box_minimum_css(
            array(
               'title' => esc_html__('Trending','element-ready-pro'),
               'slug' => 'post_trending_box_style',
               'element_name' => 'post_trending_element_ready_',
               'selector' => '{{WRAPPER}} .element-ready-icon',
            )
         );

         $this->text_wrapper_css(
            array(
                'title' => esc_html__('Trending Icon','element-ready-pro'),
                'slug' => 'trending_iconr_box_style',
                'element_name' => 'trending_element_ready_',
                'selector' => '{{WRAPPER}} .element-ready-icon i',
            )
        );


        $this->box_minimum_css(
               array(
                  'title' => esc_html__('Post Meta','element-ready-pro'),
                  'slug' => 'post_meta_wrapper_box_style',
                  'element_name' => 'post_meta_wrapper_element_ready_',
                  'selector' => '{{WRAPPER}} .element-ready-post-meta',
               )
         );

         $this->element_before_psudocode([
            'title' => esc_html__('Meta Seperator','element-ready-pro'),
            'slug' => 'post_meta_separetor_box_style',
            'element_name' => 'post_meta_separetor_element_ready_',
            'selector' => '{{WRAPPER}} .element-ready-post-meta .element-ready-meta-list::before',
            'selector_parent' => '{{WRAPPER}} .element-ready-post-meta .element-ready-meta-list',
         ]);

         $this->text_wrapper_css(
            array(
               'title' => esc_html__('Meta Icon','element-ready-pro'),
               'slug' => 'meta_icon_style',
               'element_name' => 'meta_icon_element_ready_',
               'selector' => '{{WRAPPER}} .element-ready-meta-list i',
               'hover_selector' => false,
              
            )
        );

         $this->text_wrapper_css(
            array(
               'title' => esc_html__('Date','element-ready-pro'),
               'slug' => 'post_date_style',
               'element_name' => 'post_date_element_ready_',
               'selector' => '{{WRAPPER}} .element-ready-date',
               'hover_selector' => '{{WRAPPER}} .element-ready-date:hover',
               'condition' => [
                  'show_date' => 'yes',
               ],
            )
        );

        $this->text_wrapper_css(
            array(
               'title' => esc_html__('Author','element-ready-pro'),
               'slug' => 'post_author_style',
               'element_name' => 'post_author_element_ready_',
               'selector' => '{{WRAPPER}} .element-ready-author',
               'hover_selector' => '{{WRAPPER}} .element-ready-author:hover',
               'condition' => [
                  'show_author' => 'yes',
               ],
            )
        );

        $this->text_wrapper_css(
               array(
                  'title' => esc_html__('Category','element-ready-pro'),
                  'slug' => 'post_cat_style',
                  'element_name' => 'post_cat_element_ready_',
                  'selector' => '{{WRAPPER}} .element-ready-post-meta .element-ready-meta-categories .element-ready-cat',
                  'hover_selector' => '{{WRAPPER}} .element-ready-post-meta .element-ready-meta-categories .element-ready-cat:hover',
                  'condition' => [
                     'show_cat' => 'yes',
                  ],
               )
         );

         $this->text_wrapper_css(
            array(
               'title' => esc_html__('Comment','element-ready-pro'),
               'slug' => 'post_comment_style',
               'element_name' => 'post_comment_element_ready_',
               'selector' => '{{WRAPPER}} .element-ready-comment',
               'hover_selector' => '{{WRAPPER}} .element-ready-comment:hover',
               'condition' => [
                  'show_comment' => 'yes',
               ],
            )
        );

       $this->text_css(
                array(
                'title' => esc_html__('Readmore','element-ready-pro'),
                'slug' => 'post_readmore_style',
                'element_name' => 'post_readmore_element_ready_',
                'selector' => '{{WRAPPER}} .element-ready-news-btn',
                'hover_selector' => '{{WRAPPER}} .element-ready-news-btn:hover',
                'condition' => [
                    'show_readmore' => 'yes',
                ],
                )
        );

      $this->box_css(
            array(
               'title' => esc_html__('Item Wrapper','element-ready-pro'),
               'slug' => 'item__box_style',
               'element_name' => 'item_wrapper_element_ready_',
               'selector' => '{{WRAPPER}} .element-ready-trending-news-item',
            )
        );
     
         /*--------------------------
             STYLE END
         ----------------------------*/  
    }

    protected function render( ) { 

        $settings        = $this->get_settings();
        $post_title_crop = $settings['post_title_crop'];
        $data            = new Base_Modal($settings);
        $query           = $data->get();
        
        if(!$query){
          return;  
        }

        $rating_settings = [];

        global $wp_query;
        
        if(is_search() || element_ready_lite_is_blog()){
         $query = $wp_query;
        }
    
        ?>
        
         <?php if($settings['block_style'] == 'style1'): ?>
            <div class="element-ready-post-grid style1 ">
               <?php if($settings['column'] == 'yes' && $settings['column_number'] !=''): ?>
                  <div class="row">
               <?php endif; ?>
                     <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <?php if($settings['column'] == 'yes' && $settings['column_number'] !=''): ?>
                           <div class="<?php echo esc_attr($settings['column_number']); ?>">
                        <?php endif; ?>
                        <div class="trending-news-item element-ready-trending-news-item">
                           <?php if($settings['sort_image_bottom'] !='yes'): ?>
                                 <?php if(has_post_thumbnail() && $settings['show_image'] =='yes'): ?>
                                    <div class="trending-news-thumb element-ready-trending-news-thumb">
                                        <?php  $thumb_link  = \Elementor\Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumb_size', $settings ); ?>
                                       <img src="<?php echo esc_url($thumb_link); ?>" alt="<?php the_title_attribute(); ?>">
                                      
                                        <?php include('parts/trending.php');  ?>
                                     
                                    </div>
                                 <?php endif; ?>
                           <?php endif; ?>
                           <div class="trending-news-content element-ready-trending-news-content">

                               <?php include('parts/meta.php');  ?>
                               <?php include('parts/title.php');  ?>
                               <?php include('parts/content.php');  ?>
                               <?php include('parts/readmore.php');  ?>
                           </div>
                           <?php if( $settings['sort_image_bottom'] =='yes' ): ?>
                                 <?php if(has_post_thumbnail() && $settings['show_image'] =='yes'): ?>
                                    <div class="trending-news-thumb element-ready-trending-news-thumb">
                                       <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php the_title_attribute(); ?>">
                                       <?php 
                                          $tranding = get_post_meta(get_the_id(),'_element_ready_trending',true);
                                          $tranding = 'yes';
                                       ?>
                                       <?php if($tranding == 'yes' && $settings['show_tranding_icon'] == 'yes'): ?>
                                             <div class="icon element-ready-icon">
                                                <a href="<?php the_permalink() ?>">
                                                   <?php \Elementor\Icons_Manager::render_icon( $settings['trending_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                </a>
                                             </div>
                                       <?php endif; ?>
                                    </div>
                                 <?php endif; ?>
                           <?php endif; ?>
                        </div>
                        <?php if($settings['column'] == 'yes' && $settings['column_number'] !=''): ?>
                           </div>
                        <?php endif; ?>
                     <?php endwhile; wp_reset_postdata(); ?>
               <?php if($settings['column'] == 'yes' && $settings['column_number'] !=''): ?>
                  </div>
               <?php endif; ?>
            </div>   
         <?php endif; ?>  
         
         <?php if($settings['block_style'] == 'style2'): ?>
            <div class="element-ready-post-grid business-post style2 ">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="business-post-item mb-40 element-ready-trending-news-item">
                        <div class="quomodo-row">
                            <?php if(has_post_thumbnail() && $settings['show_image'] =='yes'): ?>
                                <div class="quomodo-col-lg-6 quomodo-col-md-6 <?php echo esc_attr( $settings['sort_image_bottom']=='yes'?'order-3':'' ); ?>">
                                    <div class="business-post-thumb element-ready-trending-news-thumb">
                                    <?php  $thumb_link  = \Elementor\Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumb_size', $settings ); ?>
                                         <img src="<?php echo esc_url($thumb_link); ?>" alt="<?php the_title_attribute(); ?>">
                                         <?php include('parts/trending.php');  ?>
                                       
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="quomodo-col-lg-6 quomodo-col-md-6 ">
                                <div class="trending-news-item ">
                                    <div class="trending-news-content element-ready-trending-news-content">

                                        <?php include('parts/meta.php');  ?>
                                        <?php include('parts/title.php');  ?>
                                        <?php include('parts/content.php');  ?>
                                        <?php include('parts/readmore.php');  ?>
                                         
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
         <?php endif; ?>   

         <?php if( $settings['block_style'] == 'style3' ): ?>
            <div class="element-ready-post-grid style3">
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="post-news-item-2 element-ready-trending-news-item">
                            <?php if(has_post_thumbnail() && $settings['show_image'] =='yes' && $settings['sort_image_bottom'] !='yes' ): ?>
                                <div class="post-news-thumb element-ready-trending-news-thumb">
                                <?php  $thumb_link  = \Elementor\Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumb_size', $settings ); ?>
                                        <img src="<?php echo esc_url($thumb_link); ?>" alt="<?php the_title_attribute(); ?>">
                                         <?php include('parts/trending.php');  ?>
                                        
                                </div>
                            <?php endif; ?>
                            <div class="post-news-content element-ready-trending-news-content">
                                <?php include('parts/title.php');  ?>
                                <?php include('parts/content.php');  ?>
                                <?php include('parts/meta-2.php');  ?>
                                <?php include('parts/readmore.php');  ?>
                            </div>
                            <?php if(has_post_thumbnail() && $settings['show_image'] =='yes' && $settings['sort_image_bottom'] =='yes' ): ?>
                                <div class="post-news-thumb element-ready-trending-news-thumb">
                                        <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php the_title_attribute(); ?>">
                                         <?php include('parts/trending.php');  ?>
                                         
                                </div>
                            <?php endif; ?>
                        </div>  
                    <?php endwhile; wp_reset_postdata(); ?>   
            </div>   
         <?php endif; ?>   
        

      <?php  
    }

  

    
}