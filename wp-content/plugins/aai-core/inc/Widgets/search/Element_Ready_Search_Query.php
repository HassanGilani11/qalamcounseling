<?php
namespace Element_Ready_Pro\Widgets\search;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;


if ( ! defined( 'ABSPATH' ) ) exit;

class Element_Ready_Search_Query extends Widget_Base {

    public $base;
  
    public function get_name() {
        return 'element-ready-pro-search-query';
    }

    public function get_keywords() {
		return ['search query','search','er search query'];
	}

    public function get_title() {
        return esc_html__( 'ER Search Query', 'element-ready-pro' );
    }

    public function get_icon() { 
        return 'eicon-post';
    }

    public function get_categories() {
        return [ 'element-ready-pro' ];
    }
 
    protected function register_controls() {

        $this->start_controls_section(
            'element_ready_content_cart_section',
            [
                'label' => esc_html__( 'Settings', 'element-ready-pro' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->add_control(
                'heading_text',
                [
                    'label'       => esc_html__( 'Heading', 'element-ready-pro' ),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'default'     => esc_html__( 'Search Results for:', 'element-ready-pro' ),
                    'placeholder' => esc_html__( 'Type Search Results for:', 'element-ready-pro' ),
                ]
            );

        $this->end_controls_section();

         /*-------------------------
            TITLE STYLE
        --------------------------*/
        $this->start_controls_section(
            'title_section_style',
            [
                'label'     => esc_html__( 'Title', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
              
            ]
        );

            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'title_typography',
                    'selector' => '{{WRAPPER}} ._title',
                ]
            );

            $this->add_control(
                'title_color',
                [
                    'label'     => esc_html__( 'Color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ._title' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'title_background',
                    'label'    => esc_html__( 'Background', 'element-ready-pro' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} ._title',
                ]
            );
            $this->add_responsive_control(
                'title_margin',
                [
                    'label'      => esc_html__( 'Margin', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} ._title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'title_padding',
                [
                    'label'      => esc_html__( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} ._title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

        $this->end_controls_section();

          /*-------------------------
            TITLE Query STYLE
        --------------------------*/
        $this->start_controls_section(
            'title_search_q_section_style',
            [
                'label'     => esc_html__( 'Search Query', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            
            ]
        );
            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'titlesearch_q_typography',
                    'selector' => '{{WRAPPER}} ._title span',
                ]
            );
            $this->add_control(
                'title_search_q_color',
                [
                    'label'     => esc_html__( 'Color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} ._title span' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'search_qtitle_background',
                    'label'    => esc_html__( 'Background', 'element-ready-pro' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} ._title span',
                ]
            );
           
            $this->add_responsive_control(
                'search_qtitle_padding',
                [
                    'label'      => esc_html__( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} ._title span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

        $this->end_controls_section();
   
    } //Register control end
   
    protected function render( ) { 

        $settings = $this->get_settings();
        
    ?>  
        <h2 class="_title">
            <?php echo sprintf('%s <span> %s </span>', $settings['heading_text'], get_search_query()); ?>
        </h2>
    
    <?php  

    }
    
    protected function content_template() { }

}