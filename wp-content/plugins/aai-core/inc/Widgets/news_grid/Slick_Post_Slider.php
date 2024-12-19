<?php
namespace Element_Ready_Pro\Widgets\news_grid;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Custom_Controls_Manager;
use Elementor\Group_Control_Typography;

use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Element_Ready\Base\Repository\Post_Slider_Model;

require_once( ELEMENT_READY_DIR_PATH . '/inc/style_controls/common/common.php' );
require_once( ELEMENT_READY_DIR_PATH . '/inc/style_controls/position/position.php' );
require_once( ELEMENT_READY_DIR_PATH . '/inc/style_controls/box/box_style.php' );
require_once( ELEMENT_READY_DIR_PATH . '/inc/content_controls/common.php' );

if ( ! defined( 'ABSPATH' ) ) exit;

class Slick_Post_Slider extends Widget_Base {


   use \Elementor\Element_Ready_Common_Style;
   use \Elementor\Element_ready_common_content;
   use \Elementor\Element_Ready_Box_Style;

   public $base;

    public function get_name() {
        return 'element-ready-slick-post-slider';
    }

    public function get_title() {
        return esc_html__( 'ER Post Slider', 'element-ready-pro' );
    }

    public function get_icon() { 
        return "eicon-post-slider";
    }

    public function get_categories() {
      return [ 'element-ready-pro' ];
   }
   public function get_script_depends(){
         
      return [
         'slick',
         'element-ready-core',
      ];
   }
   public function get_style_depends(){
         
      return [
         'slick',
         'element-ready-news-grid',
        
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
                  'style1'  => esc_html__( 'Style 1', 'element-ready-pro' ),
                  'style2'  => esc_html__( 'Style 2', 'element-ready-pro' ),
               
               ],
            ]
         );

         $this->add_control(
            'slider_on',
            [
                'label'     => esc_html__('Slider', 'element-ready-pro'),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__('Yes', 'element-ready-pro'),
                'label_off' => esc_html__('No', 'element-ready-pro'),
                'default'   => 'yes',
            
            ]
        );
      

       $this->end_controls_section();
       
     

       $this->slick_slider_option(); 
       do_action( 'element_ready_section_general_slick_slider_tab', $this, $this->get_name() );
       do_action( 'element_ready_section_data_exclude_tab', $this , $this->get_name() );  
       do_action( 'element_ready_section_date_filter_tab', $this , $this->get_name());  
       do_action( 'element_ready_section_taxonomy_filter_tab', $this , $this->get_name());  
       do_action( 'element_ready_section_sort_tab', $this , $this->get_name());  
       do_action( 'element_ready_section_sticky_tab', $this , $this->get_name());  
        // Style
           
        $this->box_css(
         array(
             'title' => esc_html__('Title Wrapper','element-ready-pro'),
             'slug' => 'title_per_box_style',
             'element_name' => 'title_wrapper_element_ready_',
             'selector' => '{{WRAPPER}} .element-ready-title',
         )
       );

       $this->text_css(
         array(
             'title' => esc_html__('Title','element-ready-pro'),
             'slug' => 'title__box_style',
             'element_name' => 'title_per_element_ready_',
             'selector' => '{{WRAPPER}} .element-ready-title a',
         )
       );

       $this->text_wrapper_css(
         array(
             'title' => esc_html__('Content','element-ready-pro'),
             'slug' => 'content_box_style',
             'element_name' => 'comntentr_element_ready_',
             'selector' => '{{WRAPPER}} .element-ready-content',
             'condition' => [ 'block_style' => ['style2','style3'] ]
         )
       );

    
      $this->start_controls_section('element_ready_style_pcontent_section',
      [
         'label'     => esc_html__( 'Post meta', 'element-ready-pro' ),
         'tab'       => Controls_Manager::TAB_STYLE,
        
      ]
     );
  
     $this->add_control(
       'post_meta_color',
         [
             'label' => esc_html__('Author and date color', 'element-ready-pro'),
             'type'  => Controls_Manager::COLOR,
             
             'selectors' => [
                 '{{WRAPPER}} .element-ready-meta-list.meta-date' => 'color: {{VALUE}};',
             
             ],
         ]
       ); 
 
       $this->add_group_control(
         Group_Control_Typography:: get_type(),
         [
             'name'     => 'meta_other_typography',
             'label'    => esc_html__( ' Date and author Typography', 'element-ready-pro' ),
             'selector' => '{{WRAPPER}} .element-ready-meta-list.meta-date',
           
         ]
     );  

     $this->add_responsive_control(
      'post_date_meta_margin',
      [
          'label'      => esc_html__( 'Date Margin', 'element-ready-pro' ),
          'type'       => Controls_Manager::DIMENSIONS,
          'size_units' => [ 'px','%'],
          'selectors'  => [

              '{{WRAPPER}} .element-ready-meta-list.meta-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            
          ],
      ]
  );
     $this->add_control(
      'post_category_color',
      [
         'label'     => esc_html__('Category Color', 'element-ready-pro'),
         'type'      => Controls_Manager::COLOR,
         'default'   => '',
         'selectors' => [

            '{{WRAPPER}} .element-ready-meta-list.meta-categories a' => 'color: {{VALUE}};',
        
         ],
      ]
      ); 
      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
             'name'     => 'meta_category_typography',
             'label'    => esc_html__( 'Category Typography', 'element-ready-pro' ),
             'selector' => '{{WRAPPER}} .element-ready-meta-list.meta-categories a',
             
         ]
     );
      $this->add_responsive_control(
         'post__meta_margin',
         [
             'label'      => esc_html__( 'Margin', 'element-ready-pro' ),
             'type'       => Controls_Manager::DIMENSIONS,
             'size_units' => [ 'px','%'],
             'selectors'  => [

                 '{{WRAPPER}} .element-ready-meta-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
               
             ],
         ]
     );
     
     $this->end_controls_section();

     $this->box_css(
            array(
               'title'        => esc_html__('Meta Wrapper','element-ready-pro'),
               'slug'         => 'post_meta_wrapper__box_style',
               'element_name' => 'post_meta_wrapper_element_ready_',
               'selector'     => '{{WRAPPER}} .element-ready-post-meta',
            )
      );

      $this->element_before_psudocode([
         'title'           => esc_html__('Meta Seperator','element-ready-pro'),
         'slug'            => 'post_meta__separetor_box_style',
         'element_name'    => 'post_meta__separetor_element_ready_',
         'selector'        => '{{WRAPPER}} .element-ready-post-meta .element-ready-meta-list::before',
         'selector_parent' => '{{WRAPPER}} .element-ready-post-meta .element-ready-meta-list',
      ]);
 
      $this->start_controls_section('element_ready_image_section',
         [
            'label' => esc_html__( 'Image', 'element-ready-pro' ),
            'tab'   => Controls_Manager::TAB_STYLE,
         ]
      );
      $this->add_responsive_control(
         'image_margin',
            [
               'label'      => esc_html__( 'Margin', 'element-ready-pro' ),
               'type'       => Controls_Manager::DIMENSIONS,
               'size_units' => [ 'px','%'],
               'selectors'  => [
                  '{{WRAPPER}} .element-ready-thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                     'max'  => 1600,
                     'step' => 1,
                  ],
                  '%' => [
                     'min' => 0,
                     'max' => 100,
                  ],
                
               ],
              
               'selectors' => [
                  '{{WRAPPER}} .element-ready-thumb img' => 'max-width: {{SIZE}}{{UNIT}};',
               ],
            ]
         );

            $this->add_control(
               'post_image_overlay_c_heading',
               [
                  'label'     => __( 'Overlay color', 'element-ready-pro' ),
                  'type'      => \Elementor\Controls_Manager::HEADING,
                  'separator' => 'before',
               ]
            );
   
            $this->add_group_control(
               \Elementor\Group_Control_Background:: get_type(),
               [
                  'name'     => 'post_image_overlay_color',
                  'label'    => esc_html__( 'Background', 'element-ready-pro' ),
                  'types'    => [ 'gradient' ],
                  'selector' => '{{WRAPPER}} .element-ready-thumb::before',
               ]
            );
            
            $this->add_control(
               'post_image_overlay_opecity',
               [
                  'label'      => esc_html__( 'Opacity', 'element-ready-pro' ),
                  'type'       => Controls_Manager::SLIDER,
                  'size_units' => [ 'px' ],
                  'range'      => [
                     'px' => [
                        'min'  => 0,
                        'max'  => 1,
                        'step' => .1,
                     ],
                   
                  ],
                 
                  'selectors' => [
                     '{{WRAPPER}} .element-ready-thumb::before' => 'opacity: {{SIZE}};',
                  ],
               ]
            );

      $this->end_controls_section();

      $this->box_css(
         array(
            'title' => esc_html__('Item Wrapper','element-ready-pro'),
            'slug' => 'item_s_box_style',
            'element_name' => 'item_wrapper_element_ready_',
            'selector' => '{{WRAPPER}} .element-ready-trending-news-item',
         )
     );

        /*----------------------------
            SLIDER NAV WARP
        -----------------------------*/
        $this->start_controls_section(
         'slider_control_warp_style_section',
         [
             'label' => __( 'Slider Arrow Warp', 'element-ready-pro' ),
             'tab'       => Controls_Manager::TAB_STYLE,
             'condition' => [
                 'slider_on' => 'yes',
                 'slarrows'  => 'yes',
             ],
         ]
     );

     // Background
     $this->add_group_control(
         Group_Control_Background:: get_type(),
         [
             'name'     => 'slider_nav_warp_background',
             'label'    => __( 'Background', 'element-ready-pro' ),
             'types'    => [ 'classic', 'gradient' ],
             'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav',
         ]
     );

     // Border
     $this->add_group_control(
         Group_Control_Border:: get_type(),
         [
             'name'     => 'slider_nav_warp_border',
             'label'    => __( 'Border', 'element-ready-pro' ),
             'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav',
         ]
     );

     // Border Radius
     $this->add_control(
         'slider_nav_warp_radius',
         [
             'label'      => __( 'Border Radius', 'element-ready-pro' ),
             'type'       => Controls_Manager::DIMENSIONS,
             'size_units' => [ 'px', '%', 'em' ],
             'selectors'  => [
                 '{{WRAPPER}} .sldier-content-area .owl-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
             ],
         ]
     );

     // Shadow
     $this->add_group_control(
         Group_Control_Box_Shadow:: get_type(),
         [
             'name'     => 'slider_nav_warp_shadow',
             'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav',
         ]
     );

     // Display;
     $this->add_responsive_control(
         'slider_nav_warp_display',
         [
             'label'   => __( 'Display', 'element-ready-pro' ),
             'type'    => Controls_Manager::SELECT,
             'default' => '',
             'options' => [
                 'initial'      => __( 'Initial', 'element-ready-pro' ),
                 'block'        => __( 'Block', 'element-ready-pro' ),
                 'inline-block' => __( 'Inline Block', 'element-ready-pro' ),
                 'flex'         => __( 'Flex', 'element-ready-pro' ),
                 'inline-flex'  => __( 'Inline Flex', 'element-ready-pro' ),
                 'none'         => __( 'none', 'element-ready-pro' ),
             ],
             'selectors' => [
                 '{{WRAPPER}} .sldier-content-area .owl-nav' => 'display: {{VALUE}};',
             ],
         ]
     );

     // Before Postion
     $this->add_responsive_control(
         'slider_nav_warp_position',
         [
             'label'   => __( 'Position', 'element-ready-pro' ),
             'type'    => Controls_Manager::SELECT,
             'default' => '',
             
             'options' => [
                 'initial'  => __( 'Initial', 'element-ready-pro' ),
                 'absolute' => __( 'Absulute', 'element-ready-pro' ),
                 'relative' => __( 'Relative', 'element-ready-pro' ),
                 'static'   => __( 'Static', 'element-ready-pro' ),
             ],
             'selectors' => [
                 '{{WRAPPER}} .sldier-content-area .owl-nav' => 'position: {{VALUE}};',
             ],
         ]
     );

     // Postion From Left
     $this->add_responsive_control(
         'slider_nav_warp_position_from_left',
         [
             'label'      => __( 'From Left', 'element-ready-pro' ),
             'type'       => Controls_Manager::SLIDER,
             'size_units' => [ 'px', '%' ],
             'range'      => [
                 'px' => [
                     'min'  => -1000,
                     'max'  => 1000,
                     'step' => 1,
                 ],
                 '%' => [
                     'min' => -100,
                     'max' => 100,
                 ],
             ],
             'default' => [
                 'unit' => 'px',
             ],
             'selectors' => [
                 '{{WRAPPER}} .sldier-content-area .owl-nav' => 'left: {{SIZE}}{{UNIT}};',
             ],
             'condition' => [
                 'slider_nav_warp_position' => ['absolute','relative']
             ],
         ]
     );

     // Postion From Right
     $this->add_responsive_control(
         'slider_nav_warp_position_from_right',
         [
             'label'      => __( 'From Right', 'element-ready-pro' ),
             'type'       => Controls_Manager::SLIDER,
             'size_units' => [ 'px', '%' ],
             'range'      => [
                 'px' => [
                     'min'  => -1000,
                     'max'  => 1000,
                     'step' => 1,
                 ],
                 '%' => [
                     'min' => -100,
                     'max' => 100,
                 ],
             ],
             'default' => [
                 'unit' => 'px',
             ],
             'selectors' => [
                 '{{WRAPPER}} .sldier-content-area .owl-nav' => 'right: {{SIZE}}{{UNIT}};',
             ],
             'condition' => [
                 'slider_nav_warp_position' => ['absolute','relative']
             ],
         ]
     );

     // Postion From Top
     $this->add_responsive_control(
         'slider_nav_warp_position_from_top',
         [
             'label'      => __( 'From Top', 'element-ready-pro' ),
             'type'       => Controls_Manager::SLIDER,
             'size_units' => [ 'px', '%' ],
             'range'      => [
                 'px' => [
                     'min'  => -1000,
                     'max'  => 1000,
                     'step' => 1,
                 ],
                 '%' => [
                     'min' => -100,
                     'max' => 100,
                 ],
             ],
             'default' => [
                 'unit' => 'px',
             ],
             'selectors' => [
                 '{{WRAPPER}} .sldier-content-area .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
             ],
             'condition' => [
                 'slider_nav_warp_position' => ['absolute','relative']
             ],
         ]
     );

     // Postion From Bottom
     $this->add_responsive_control(
         'slider_nav_warp_position_from_bottom',
         [
             'label'      => __( 'From Bottom', 'element-ready-pro' ),
             'type'       => Controls_Manager::SLIDER,
             'size_units' => [ 'px', '%' ],
             'range'      => [
                 'px' => [
                     'min'  => -1000,
                     'max'  => 1000,
                     'step' => 1,
                 ],
                 '%' => [
                     'min' => -100,
                     'max' => 100,
                 ],
             ],
             'default' => [
                 'unit' => 'px',
             ],
             'selectors' => [
                 '{{WRAPPER}} .sldier-content-area .owl-nav' => 'bottom: {{SIZE}}{{UNIT}};',
             ],
             'condition' => [
                 'slider_nav_warp_position' => ['absolute','relative']
             ],
         ]
     );

     // Align
     $this->add_responsive_control(
         'slider_nav_warp_align',
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
                 '{{WRAPPER}} .sldier-content-area .owl-nav' => 'text-align: {{VALUE}};',
             ],
             'default' => '',
         ]
     );

     // Width
     $this->add_responsive_control(
         'slider_nav_warp_width',
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
                 '{{WRAPPER}} .sldier-content-area .owl-nav' => 'width: {{SIZE}}{{UNIT}};',
             ],
         ]
     );

     // Height
     $this->add_responsive_control(
         'slider_nav_warp_height',
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
                 '{{WRAPPER}} .sldier-content-area .owl-nav' => 'height: {{SIZE}}{{UNIT}};',
             ],
         ]
     );

     // Opacity
     $this->add_control(
         'slider_nav_warp_opacity',
         [
             'label' => __( 'Opacity', 'element-ready-pro' ),
             'type'  => Controls_Manager::SLIDER,
             'range' => [
                 'px' => [
                     'max'  => 1,
                     'min'  => 0.10,
                     'step' => 0.01,
                 ],
             ],
             'selectors' => [
                 '{{WRAPPER}} .sldier-content-area .owl-nav' => 'opacity: {{SIZE}};',
             ],
         ]
     );

     // Z-Index
     $this->add_control(
         'slider_nav_warp_zindex',
         [
             'label'     => __( 'Z-Index', 'element-ready-pro' ),
             'type'      => Controls_Manager::NUMBER,
             'min'       => -99,
             'max'       => 99,
             'step'      => 1,
             'selectors' => [
                 '{{WRAPPER}} .sldier-content-area .owl-nav' => 'z-index: {{SIZE}};',
             ],
         ]
     );

     // Margin
     $this->add_responsive_control(
         'slider_nav_warp_margin',
         [
             'label'      => __( 'Margin', 'element-ready-pro' ),
             'type'       => Controls_Manager::DIMENSIONS,
             'size_units' => [ 'px', '%', 'em' ],
             'selectors'  => [
                 '{{WRAPPER}} .sldier-content-area .owl-nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
             ],
         ]
     );

     // Padding
     $this->add_responsive_control(
         'slider_nav_warp_padding',
         [
             'label'      => __( 'Margin', 'element-ready-pro' ),
             'type'       => Controls_Manager::DIMENSIONS,
             'size_units' => [ 'px', '%', 'em' ],
             'selectors'  => [
                 '{{WRAPPER}} .sldier-content-area .owl-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
             ],
         ]
     );

     $this->end_controls_section();
     /*----------------------------
         SLIDER NAV WARP END
     -----------------------------*/

     /*------------------------
          ARROW STYLE
     --------------------------*/
     $this->start_controls_section(
         'slider_arrow_style',
         [
             'label'     => __( 'Arrow', 'element-ready-pro' ),
             'tab'       => Controls_Manager::TAB_STYLE,
             'condition' => [
                 'slider_on' => 'yes',
                 'slarrows'  => 'yes',
             ],
         ]
     );
     
         $this->start_controls_tabs( 'slider_arrow_style_tabs' );

             // Normal tab Start
             $this->start_controls_tab(
                 'slider_arrow_style_normal_tab',
                 [
                     'label' => __( 'Normal', 'element-ready-pro' ),
                 ]
             );

                 $this->add_control(
                     'slider_arrow_color',
                     [
                         'label'  => __( 'Color', 'element-ready-pro' ),
                         'type'   => Controls_Manager::COLOR,
                         'selectors' => [
                             '{{WRAPPER}} .sldier-content-area .slick-arrow' => 'color: {{VALUE}};',
                         ],
                     ]
                 );

                 $this->add_responsive_control(
                     'slider_arrow_fontsize',
                     [
                         'label'      => __( 'Font Size', 'element-ready-pro' ),
                         'type'       => Controls_Manager::SLIDER,
                         'size_units' => [ 'px', '%' ],
                         'range'      => [
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
                             '{{WRAPPER}} .sldier-content-area .slick-arrow' => 'font-size: {{SIZE}}{{UNIT}};',
                         ],
                     ]
                 );

                 $this->add_group_control(
                     Group_Control_Background:: get_type(),
                     [
                         'name'     => 'slider_arrow_background',
                         'label'    => __( 'Background', 'element-ready-pro' ),
                         'types'    => [ 'classic', 'gradient' ],
                         'selector' => '{{WRAPPER}} .sldier-content-area .slick-arrow',
                     ]
                 );

                 $this->add_group_control(
                     Group_Control_Border:: get_type(),
                     [
                         'name'     => 'slider_arrow_border',
                         'label'    => __( 'Border', 'element-ready-pro' ),
                         'selector' => '{{WRAPPER}} .sldier-content-area .slick-arrow',
                     ]
                 );

                 $this->add_responsive_control(
                     'slider_border_radius',
                     [
                         'label'     => esc_html__( 'Border Radius', 'element-ready-pro' ),
                         'type'      => Controls_Manager::DIMENSIONS,
                         'selectors' => [
                             '{{WRAPPER}} .sldier-content-area .slick-arrow' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                         ],
                     ]
                 );

                 $this->add_group_control(
                     Group_Control_Box_Shadow:: get_type(),
                     [
                         'name'     => 'slider_arrow_shadow',
                         'selector' => '{{WRAPPER}} .sldier-content-area .slick-arrow',
                     ]
                 );

                 $this->add_responsive_control(
                     'slider_arrow_height',
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
                             'size' => 40,
                         ],
                         'selectors' => [
                             '{{WRAPPER}} .sldier-content-area .slick-arrow' => 'height: {{SIZE}}{{UNIT}};',
                         ],
                     ]
                 );

                 $this->add_responsive_control(
                     'slider_arrow_width',
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
                             'size' => 46,
                         ],
                         'selectors' => [
                             '{{WRAPPER}} .sldier-content-area .slick-arrow' => 'width: {{SIZE}}{{UNIT}};',
                         ],
                     ]
                 );

                 $this->add_responsive_control(
                     'slider_arrow_padding',
                     [
                         'label'      => __( 'Padding', 'element-ready-pro' ),
                         'type'       => Controls_Manager::DIMENSIONS,
                         'size_units' => [ 'px', '%', 'em' ],
                         'selectors'  => [
                             '{{WRAPPER}} .sldier-content-area .slick-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                         ],
                         'separator' => 'before',
                     ]
                 );

                 // Postion From Left
                 $this->add_responsive_control(
                     'slide_button_position_from_left',
                     [
                         'label'      => __( 'Left Arrow Position From Left', 'element-ready-pro' ),
                         'type'       => Controls_Manager::SLIDER,
                         'size_units' => [ 'px', '%' ],
                         'range'      => [
                             'px' => [
                                 'min'  => -1000,
                                 'max'  => 1000,
                                 'step' => 1,
                             ],
                             '%' => [
                                 'min' => -100,
                                 'max' => 100,
                             ],
                         ],
                         'default' => [
                             'unit' => 'px',
                         ],
                         'selectors' => [
                             '{{WRAPPER}} .sldier-content-area .owl-nav > div.owl-prev' => 'left: {{SIZE}}{{UNIT}};',
                         ],
                     ]
                 );

                 // Postion Bottom Top
                 $this->add_responsive_control(
                     'slide_button_position_from_bottom',
                     [
                         'label'      => __( 'Left Arrow Position From Top', 'element-ready-pro' ),
                         'type'       => Controls_Manager::SLIDER,
                         'size_units' => [ 'px', '%' ],
                         'range'      => [
                             'px' => [
                                 'min'  => -1000,
                                 'max'  => 1000,
                                 'step' => 1,
                             ],
                             '%' => [
                                 'min' => -100,
                                 'max' => 100,
                             ],
                         ],
                         'default' => [
                             'unit' => 'px',
                         ],
                         'selectors' => [
                             '{{WRAPPER}} .sldier-content-area .owl-nav > div.owl-prev' => 'top: {{SIZE}}{{UNIT}};',
                         ],
                     ]
                 );


                 // Postion From Left
                 $this->add_responsive_control(
                     'slide_button_position_from_right',
                     [
                         'label'      => __( 'Right Arrow Position From Right', 'element-ready-pro' ),
                         'type'       => Controls_Manager::SLIDER,
                         'size_units' => [ 'px', '%' ],
                         'range'      => [
                             'px' => [
                                 'min'  => -1000,
                                 'max'  => 1000,
                                 'step' => 1,
                             ],
                             '%' => [
                                 'min' => -100,
                                 'max' => 100,
                             ],
                         ],
                         'default' => [
                             'unit' => 'px',
                         ],
                         'selectors' => [
                             '{{WRAPPER}} .sldier-content-area .owl-nav > div.owl-next' => 'right: {{SIZE}}{{UNIT}};',
                         ],
                     ]
                 );

                 // Postion Bottom Top
                 $this->add_responsive_control(
                     'slide_button_position_from_top',
                     [
                         'label'      => __( 'Right Arrow Position From Top', 'element-ready-pro' ),
                         'type'       => Controls_Manager::SLIDER,
                         'size_units' => [ 'px', '%' ],
                         'range'      => [
                             'px' => [
                                 'min'  => -1000,
                                 'max'  => 1000,
                                 'step' => 1,
                             ],
                             '%' => [
                                 'min' => -100,
                                 'max' => 100,
                             ],
                         ],
                         'default' => [
                             'unit' => 'px',
                         ],
                         'selectors' => [
                             '{{WRAPPER}} .sldier-content-area .owl-nav > div.owl-next' => 'top: {{SIZE}}{{UNIT}};',
                         ],
                     ]
                 );

             $this->end_controls_tab(); // Normal tab end

             // Hover tab Start
             $this->start_controls_tab(
                 'slider_arrow_style_hover_tab',
                 [
                     'label' => __( 'Hover', 'element-ready-pro' ),
                 ]
             );

                 $this->add_control(
                     'slider_arrow_hover_color',
                     [
                         'label'  => __( 'Color', 'element-ready-pro' ),
                         'type'   => Controls_Manager::COLOR,
                         'selectors' => [
                             '{{WRAPPER}} .sldier-content-area .slick-arrow:hover' => 'color: {{VALUE}};',
                         ],
                     ]
                 );

                 $this->add_group_control(
                     Group_Control_Background:: get_type(),
                     [
                         'name'     => 'slider_arrow_hover_background',
                         'label'    => __( 'Background', 'element-ready-pro' ),
                         'types'    => [ 'classic', 'gradient' ],
                         'selector' => '{{WRAPPER}} .sldier-content-area .slick-arrow:hover',
                     ]
                 );

                 $this->add_group_control(
                     Group_Control_Border:: get_type(),
                     [
                         'name'     => 'slider_arrow_hover_border',
                         'label'    => __( 'Border', 'element-ready-pro' ),
                         'selector' => '{{WRAPPER}} .sldier-content-area .slick-arrow:hover',
                     ]
                 );

                 $this->add_responsive_control(
                     'slider_arrow_hover_border_radius',
                     [
                         'label'     => esc_html__( 'Border Radius', 'element-ready-pro' ),
                         'type'      => Controls_Manager::DIMENSIONS,
                         'selectors' => [
                             '{{WRAPPER}} .sldier-content-area .slick-arrow:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                         ],
                     ]
                 );

                 $this->add_group_control(
                     Group_Control_Box_Shadow:: get_type(),
                     [
                         'name'     => 'slider_arrow_hover_shadow',
                         'selector' => '{{WRAPPER}} .sldier-content-area .slick-arrow:hover',
                     ]
                 );

                 // Postion From Left
                 $this->add_responsive_control(
                     'slide_button_hover_position_from_left',
                     [
                         'label'      => __( 'Left Arrow Position From Left', 'element-ready-pro' ),
                         'type'       => Controls_Manager::SLIDER,
                         'size_units' => [ 'px', '%' ],
                         'range'      => [
                             'px' => [
                                 'min'  => -1000,
                                 'max'  => 1000,
                                 'step' => 1,
                             ],
                             '%' => [
                                 'min' => -100,
                                 'max' => 100,
                             ],
                         ],
                         'default' => [
                             'unit' => 'px',
                         ],
                         'selectors' => [
                             '{{WRAPPER}} .sldier-content-area:hover .owl-nav > div.owl-prev' => 'left: {{SIZE}}{{UNIT}};',
                         ],
                     ]
                 );

                 // Postion Bottom Top
                 $this->add_responsive_control(
                     'slide_button_hover_position_from_bottom',
                     [
                         'label'      => __( 'Left Arrow Position From Top', 'element-ready-pro' ),
                         'type'       => Controls_Manager::SLIDER,
                         'size_units' => [ 'px', '%' ],
                         'range'      => [
                             'px' => [
                                 'min'  => -1000,
                                 'max'  => 1000,
                                 'step' => 1,
                             ],
                             '%' => [
                                 'min' => -100,
                                 'max' => 100,
                             ],
                         ],
                         'default' => [
                             'unit' => 'px',
                         ],
                         'selectors' => [
                             '{{WRAPPER}} .sldier-content-area:hover .owl-nav > div.owl-prev' => 'top: {{SIZE}}{{UNIT}};',
                         ],
                     ]
                 );


                 // Postion From Left
                 $this->add_responsive_control(
                     'slide_button_hover_position_from_right',
                     [
                         'label'      => __( 'Right Arrow Position From Right', 'element-ready-pro' ),
                         'type'       => Controls_Manager::SLIDER,
                         'size_units' => [ 'px', '%' ],
                         'range'      => [
                             'px' => [
                                 'min'  => -1000,
                                 'max'  => 1000,
                                 'step' => 1,
                             ],
                             '%' => [
                                 'min' => -100,
                                 'max' => 100,
                             ],
                         ],
                         'default' => [
                             'unit' => 'px',
                         ],
                         'selectors' => [
                             '{{WRAPPER}} .sldier-content-area:hover .owl-nav > div.owl-next' => 'right: {{SIZE}}{{UNIT}};',
                         ],
                     ]
                 );

                 // Postion Bottom Top
                 $this->add_responsive_control(
                     'slide_button_hover_position_from_top',
                     [
                         'label'      => __( 'Right Arrow Position From Top', 'element-ready-pro' ),
                         'type'       => Controls_Manager::SLIDER,
                         'size_units' => [ 'px', '%' ],
                         'range'      => [
                             'px' => [
                                 'min'  => -1000,
                                 'max'  => 1000,
                                 'step' => 1,
                             ],
                             '%' => [
                                 'min' => -100,
                                 'max' => 100,
                             ],
                         ],
                         'default' => [
                             'unit' => 'px',
                         ],
                         'selectors' => [
                             '{{WRAPPER}} .sldier-content-area:hover .owl-nav > div.owl-next' => 'top: {{SIZE}}{{UNIT}};',
                         ],
                     ]
                 );

             $this->end_controls_tab(); // Hover tab end

         $this->end_controls_tabs();

     $this->end_controls_section(); // Style Slider arrow style end
     /*------------------------
          ARROW STYLE END
     --------------------------*/

     /*------------------------
          DOTS STYLE
     --------------------------*/
     $this->start_controls_section(
         'post_slider_pagination_style_section',
         [
             'label'     => __( 'Pagination', 'element-ready-pro' ),
             'tab'       => Controls_Manager::TAB_STYLE,
             'condition' => [
                 'slider_on' => 'yes',
                 'sldots'  => 'yes',
             ],
         ]
     );
         
         $this->start_controls_tabs('pagination_style_tabs');

             $this->start_controls_tab(
                 'pagination_style_normal_tab',
                 [
                     'label' => __( 'Normal', 'element-ready-pro' ),
                 ]
             );

                 $this->add_responsive_control(
                     'slider_pagination_height',
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
                             'size' => 15,
                         ],
                         'selectors' => [
                             '{{WRAPPER}} .sldier-content-area .slick-dots li' => 'height: {{SIZE}}{{UNIT}};',
                         ],
                     ]
                 );

                 $this->add_responsive_control(
                     'slider_pagination_width',
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
                             'size' => 15,
                         ],
                         'selectors' => [
                             '{{WRAPPER}} .sldier-content-area .slick-dots li' => 'width: {{SIZE}}{{UNIT}};',
                         ],
                     ]
                 );

                 $this->add_group_control(
                     Group_Control_Background:: get_type(),
                     [
                         'name'     => 'pagination_background',
                         'label'    => __( 'Background', 'element-ready-pro' ),
                         'types'    => [ 'classic', 'gradient' ],
                         'selector' => '{{WRAPPER}} .sldier-content-area .slick-dots li',
                     ]
                 );

                 $this->add_responsive_control(
                     'pagination_margin',
                     [
                         'label'      => __( 'Margin', 'element-ready-pro' ),
                         'type'       => Controls_Manager::DIMENSIONS,
                         'size_units' => [ 'px', '%', 'em' ],
                         'selectors'  => [
                             '{{WRAPPER}} .sldier-content-area .slick-dots li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                         ],
                     ]
                 );

                 $this->add_group_control(
                     Group_Control_Border:: get_type(),
                     [
                         'name'     => 'pagination_border',
                         'label'    => __( 'Border', 'element-ready-pro' ),
                         'selector' => '{{WRAPPER}} .sldier-content-area .slick-dots li',
                     ]
                 );

                 $this->add_responsive_control(
                     'pagination_border_radius',
                     [
                         'label'     => esc_html__( 'Border Radius', 'element-ready-pro' ),
                         'type'      => Controls_Manager::DIMENSIONS,
                         'selectors' => [
                             '{{WRAPPER}} .sldier-content-area .slick-dots li' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                         ],
                     ]
                 );

                 $this->add_responsive_control(
                     'pagination_warp_margin',
                     [
                         'label'      => __( 'Pagination Warp Margin', 'element-ready-pro' ),
                         'type'       => Controls_Manager::DIMENSIONS,
                         'size_units' => [ 'px', '%', 'em' ],
                         'selectors'  => [
                             '{{WRAPPER}} .sldier-content-area .slick-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                         ],
                     ]
                 );

                 $this->add_responsive_control(
                     'pagi_war_align',
                     [
                         'label'   => __( 'Pagination Warp Alignment', 'element-ready-pro' ),
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
                                 'title' => __( 'Justified', 'element-ready-pro' ),
                                 'icon'  => 'fa fa-align-justify',
                             ],
                         ],
                         'selectors' => [
                             '{{WRAPPER}} .sldier-content-area .slick-dots' => 'text-align: {{VALUE}};',
                         ],
                     ]
                 );

             $this->end_controls_tab(); // Normal Tab end

             $this->start_controls_tab(
                 'pagination_style_active_tab',
                 [
                     'label' => __( 'Active', 'element-ready-pro' ),
                 ]
             );
                 
                 $this->add_group_control(
                     Group_Control_Background:: get_type(),
                     [
                         'name'     => 'pagination_hover_background',
                         'label'    => __( 'Background', 'element-ready-pro' ),
                         'types'    => [ 'classic', 'gradient' ],
                         'selector' => '{{WRAPPER}} .sldier-content-area .slick-dots li:hover, {{WRAPPER}} .sldier-content-area .slick-dots li.slick-active',
                     ]
                 );

                 $this->add_group_control(
                     Group_Control_Border::get_type(),
                     [
                         'name'     => 'pagination_hover_border',
                         'label'    => __( 'Border', 'element-ready-pro' ),
                         'selector' => '{{WRAPPER}} .sldier-content-area .slick-dots li:hover, {{WRAPPER}} .sldier-content-area .slick-dots li.slick-active',
                     ]
                 );

                 $this->add_responsive_control(
                     'pagination_hover_border_radius',
                     [
                         'label'     => esc_html__( 'Border Radius', 'element-ready-pro' ),
                         'type'      => Controls_Manager::DIMENSIONS,
                         'selectors' => [
                             '{{WRAPPER}} .sldier-content-area .slick-dots li.slick-active' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                             '{{WRAPPER}} .sldier-content-area .slick-dots li:hover'        => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                         ],
                     ]
                 );

             $this->end_controls_tab(); // Hover Tab end

         $this->end_controls_tabs();

     $this->end_controls_section();
     /*------------------------
          DOTS STYLE END
     --------------------------*/
    
     

    }

    protected function render( ) { 
      
        $settings       = $this->get_settings();
        $data           = new Post_Slider_Model($settings);
        $query          = $data->get();

        if(is_search() || element_ready_lite_is_blog()){
            global $wp_query;
            $query = $wp_query;
        }

        if( !$query ){
          return;  
        }
       
        // Slider options
        if( $settings['slider_on'] == 'yes' ){

         $this->add_render_attribute( 'element_ready_post_slider_attr', 'class', 'element-ready-carousel-activation ' );
         $this->add_render_attribute( 'element_ready_post_carousel', 'class', 'feature-area sldier-content-area '.$settings['nav_position'] );
         $this->add_render_attribute( 'element_ready_post_carousel2', 'class', 'sldier-content-area '.$settings['nav_position'] );


         $slideid = rand(2564,1245);

         $slider_settings = [
             'slideid'          => $slideid,
             'arrows'          => ('yes' === $settings['slarrows']),
             'arrow_prev_txt'  => $settings['slprevicon'],
             'arrow_next_txt'  => $settings['slnexticon'],
             'dots'            => ('yes' === $settings['sldots']),
             'autoplay'        => ('yes' === $settings['slautolay']),
             'autoplay_speed'  => absint($settings['slautoplay_speed']),
             'animation_speed' => absint($settings['slanimation_speed']),
             'pause_on_hover'  => ('yes' === $settings['slpause_on_hover']),
             'center_mode'     => ( 'yes' === $settings['slcentermode']),
             'center_padding'  => absint($settings['slcenterpadding']),
             'rows'            => absint($settings['slrows']),
             'fade'            => ( 'yes' === $settings['slfade']),
             'focusonselect'   => ( 'yes' === $settings['slfocusonselect']),
             'vertical'        => ( 'yes' === $settings['slvertical']),
             'rtl'             => ( 'yes' === $settings['slrtl']),
             'infinite'        => ( 'yes' === $settings['slinfinite']),
         ];

         $slider_responsive_settings = [
             'display_columns'        => $settings['slitems'],
             'scroll_columns'         => $settings['slscroll_columns'],
             'tablet_width'           => $settings['sltablet_width'],
             'tablet_display_columns' => $settings['sltablet_display_columns'],
             'tablet_scroll_columns'  => $settings['sltablet_scroll_columns'],
             'mobile_width'           => $settings['slmobile_width'],
             'mobile_display_columns' => $settings['slmobile_display_columns'],
             'mobile_scroll_columns'  => $settings['slmobile_scroll_columns'],

         ];

         $slider_settings = array_merge( $slider_settings, $slider_responsive_settings );

         $this->add_render_attribute( 'element_ready_post_slider_attr', 'data-settings', wp_json_encode( $slider_settings ) );
     }
       
     ?>
       <?php if($settings['block_style'] == 'style1'): ?>

         <section <?php echo $this->get_render_attribute_string( 'element_ready_post_carousel' ); ?>>
            <div <?php echo $this->get_render_attribute_string( 'element_ready_post_slider_attr' ); ?> >
                     <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="column-item">
                           <div class="feature-post element-ready-trending-news-item">
                                 <?php if(has_post_thumbnail()): ?>
                                    <div class="feature-post-thumb element-ready-thumb">
                                          <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php the_title_attribute( ); ?>">
                                    </div>
                                 <?php endif; ?>
                                 <div class="feature-post-content">
                                    <div class="post-meta element-ready-post-meta">
                                       <?php

                                          $categories = get_the_category();
                                          if ( ! empty( $categories) && $settings['show_cat'] == 'yes' ) {
                                       ?>
                                          <div class="meta-categories element-ready-meta-list">

                                             <?php
                                                   echo '<a class="cat" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
                                             ?>
                                          
                                          </div>
                                       <?php } ?>
                                       <?php if($settings['show_date']): ?>      
                                          <div class="meta-date element-ready-meta-list">
                                                <span> <?php echo get_the_date(get_option( 'date_format' )); ?></span>
                                          </div>
                                       <?php endif; ?> 
                                    </div>
                                    <h4 class="title element-ready-title">
                                        <a href="<?php the_permalink( ) ?>"> <?php echo esc_html(wp_trim_words( get_the_title(),$settings['post_title_crop'],'' )); ?> </a>
                                    </h4>
                                 </div>
                           </div>
                        </div>
                      <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <?php if( $settings['slarrows'] == 'yes' || $settings['sldots'] == 'yes' ) : ?>
                  <div class="owl-controls">
                        <?php if( $settings['slarrows'] == 'yes' ) : ?>
                           <div class="element-ready-carousel-nav<?php echo esc_attr( $slideid ); ?> owl-nav"></div>
                        <?php endif; ?>

                        <?php if( $settings['sldots'] == 'yes' ) : ?>
                           <div class="element-ready-carousel-dots<?php echo esc_attr( $slideid ); ?> owl-dots"></div>
                        <?php endif; ?>
                  </div>
            <?php endif; ?>
         </section>
         
       <?php endif; ?>
       <?php if($settings['block_style'] =='style2'): ?>
         <div <?php echo $this->get_render_attribute_string( 'element_ready_post_carousel2' ); ?>>
         <div <?php echo $this->get_render_attribute_string( 'element_ready_post_slider_attr' ); ?>>
            <?php while ($query->have_posts()) : $query->the_post(); ?>
               <div class="column-item">
                     <div class="trending-news-item element-ready-trending-news-item">
                        <?php if(has_post_thumbnail()): ?>
                           <div class="trending-news-thumb element-ready-thumb">
                              <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php the_title_attribute( ); ?>">
                              
                           </div>
                        <?php endif; ?>
                        <div class="trending-news-content">
                           <div class="post-meta element-ready-post-meta">
                                 <?php

                                 $categories = get_the_category();
                                 if ( ! empty( $categories) && $settings['show_cat'] == 'yes' ) {
                                 ?>
                                 <div class="meta-categories element-ready-meta-list">

                                    <?php
                                       echo '<a class="cat" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
                                    ?>

                                 </div>
                                 <?php } ?>
                                 <?php if($settings['show_date']): ?>   

                                    <div class="meta-date element-ready-meta-list">
                                          <span> <?php echo get_the_date(get_option( 'date_format' )); ?></span>
                                    </div>
                                 
                                 <?php endif; ?>
                           </div>
                           <h3 class="title element-ready-title"><a href="<?php the_permalink( ) ?>">  <?php echo esc_html(wp_trim_words( get_the_title(),$settings['post_title_crop'],'' )); ?> </a></h3>
                           <?php if($settings['show_content'] == 'yes'): ?>
                              <p class="text element-ready-content element-ready-text">
                                 <?php echo esc_html(wp_trim_words( get_the_excerpt(), $settings['post_content_crop'],'' )); ?>
                              </p>
                           <?php endif; ?>
                        </div>
                     </div>
               </div>
           <?php endwhile; wp_reset_postdata(); ?>
         </div>
         <?php if( $settings['slarrows'] == 'yes' || $settings['sldots'] == 'yes' ) : ?>
                  <div class="owl-controls">
                        <?php if( $settings['slarrows'] == 'yes' ) : ?>
                           <div class="element-ready-carousel-nav<?php echo esc_attr( $slideid ); ?> owl-nav"></div>
                        <?php endif; ?>

                        <?php if( $settings['sldots'] == 'yes' ) : ?>
                           <div class="element-ready-carousel-dots<?php echo esc_attr( $slideid ); ?> owl-dots"></div>
                        <?php endif; ?>
                  </div>
            <?php endif; ?>
         </div>
       <?php endif; ?>
   
      <?php  
    }
    

    
}