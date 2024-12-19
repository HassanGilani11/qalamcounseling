<?php
namespace Element_Ready_Pro\Widgets\woocommerce;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit;

class WC_Cart_Count extends Widget_Base {


    public $base;

    public function get_name() {
        return 'element-ready-wc-cart-added-product';
    }
    public function get_keywords() {
		return ['woocommerce','shopping','cart','product count'];
	}
    public function get_title() {
        return esc_html__( 'ER Woo Cart Count', 'element-ready-pro' );
    }

    public function get_icon() { 
        return 'fa fa-bars';
    }

    public function get_categories() {
        return [ 'element-ready-pro' ];
    }
    
    public function layout(){
        return[
            'style1'   => esc_html__( 'Style 1', 'element-ready-pro' ),
        ];
    }

   
    protected function register_controls() {

        $this->start_controls_section(
			'menu_layout',
			[
				'label' => esc_html__( 'Layout', 'element-ready-pro' ),
			]
        );

            $this->add_control(
                'menu_style',
                [
                    'label' => esc_html__( 'Style', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'style1',
                    'options' => $this->layout()
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
			'wc_cart_settings_',
			[
				'label' => esc_html__( 'Cart Settings', 'element-ready-pro' ),
			]
        );

            $this->add_control(
                'header_cart_icon',
                [
                    'label' => esc_html__( 'Icon', 'element-ready-pro' ),
                    'type' => \Elementor\Controls_Manager::ICONS,
                ]
            );
			
        $this->end_controls_section();
        $this->start_controls_section(
            'cart_container_style_section',
            [
                'label'     => __( 'Container', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );  
            
            $this->add_responsive_control(
                'cart_container_display',
                [
                    'label'   => __( 'Layout', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,			
                    'options' => [
                        'initial' => __( 'Initial', 'element-ready-pro' ),
                        'block'   => __( 'Block', 'element-ready-pro' ),
                        'flex'    => __( 'Flex', 'element-ready-pro' ),
                    
                    ],
                    'defualt' => 'flex',
                    'selectors' => [
                        '{{WRAPPER}} .element-ready-cart-content' => 'display: {{VALUE}};',
                    ],
                ]
            );
         
            $this->add_responsive_control(
                'cart_container_direction',
                [
                    'label'   => __( 'Direction', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,			
                    'options' => [
                        'row'    => __( 'Row', 'element-ready-pro' ),
                        'column' => __( 'Column', 'element-ready-pro' ),
                    ],
                    'default' => 'row',
                    'selectors' => [
                        '{{WRAPPER}} .element-ready-cart-content' => 'flex-direction: {{VALUE}};',
                    ],
                    'condition' => [
                        'cart_container_display' => ['flex']
                    ],
                ]
            );

            $this->add_responsive_control(
                'cart_container_align',
                [
                    'label'   => __( 'Align', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,			
                    'options' => [
                        'left'   => __( 'Left', 'element-ready-pro' ),
                        'right'  => __( 'Right', 'element-ready-pro' ),
                        'center' => __( 'Center', 'element-ready-pro' ),
                    ],
                    'default' => 'row',
                    'selectors' => [
                        '{{WRAPPER}} .element-ready-cart-content' => 'justify-content: {{VALUE}};',
                    ],
                    'condition' => [
                        'cart_container_display' => ['flex']
                    ],
                ]
            );

            $this->add_responsive_control(
                'cart_container_align_items',
                [
                    'label'   => __( 'Align Items', 'element-ready-pro' ),
                    'type'    => Controls_Manager::SELECT,			
                    'options' => [
                        'flex-start' => __( 'Left', 'element-ready-pro' ),
                        'flex-end'   => __( 'Right', 'element-ready-pro' ),
                        'center'     => __( 'Center', 'element-ready-pro' ),
                    ],
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .element-ready-cart-content' => 'align-items: {{VALUE}};',
                    ],
                    'condition' => [
                        'cart_container_display' => ['flex']
                    ],
                ]
            );
 

            $this->add_responsive_control(
                'cart_container_gap',
                [
                        'label'      => __( 'Gap', 'element-ready-pro' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => [ 'px' ],
                        'range'      => [
                            'px' => [
                                'min'  => 0,
                                'max'  => 300,
                                'step' => 1,
                            ],
                           
                        ],
                        'default' => [
                            'unit' => 'px',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .element-ready-cart-content' => 'gap: {{SIZE}}{{UNIT}};',
                        ],

                        'condition' => [
                            'cart_container_display' => ['flex']
                        ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'cart_container_icon_style_section',
            [
                'label'     => __( 'Cart Icon', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );  

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'      => 'cart_container_icon_typography',
                    'selector'  => '{{WRAPPER}} .element-ready-cart-content i',
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'cart_container_icon_color',
                [
                    'label'     => __( 'Color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .element-ready-cart-content i' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .element-ready-cart-content svg path' => 'fill: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'cart_container_icon_hover_color',
                [
                    'label'     => __( 'Hover Color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .element-ready-cart-content i:hover' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .element-ready-cart-content svg:hover path' => 'fill: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'cart_container_icon_padding',
                [
                    'label'      => __( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .element-ready-cart-content i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .element-ready-cart-content svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
         
        $this->end_controls_section();

        $this->start_controls_section(
            'cart_container_count_style_section',
            [
                'label'     => __( 'Cart Count', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );  

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'      => 'cart_container_count_typography',
                    'selector'  => '{{WRAPPER}} a.cart-btn span',
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'cart_container_count_color',
                [
                    'label'     => __( 'Color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} a.cart-btn span' => 'color: {{VALUE}};',
                       
                    ],
                ]
            );

            $this->add_control(
                'cart_container_count_hover_color',
                [
                    'label'     => __( 'Hover Color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} a.cart-btn span:hover' => 'color: {{VALUE}};',
                  
                    ],
                ]
            );

            $this->add_responsive_control(
                'cart_container_count_padding',
                [
                    'label'      => __( 'Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} a.cart-btn span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        
                    ],
                ]
            );
         
        $this->end_controls_section();

        $this->start_controls_section(
            'cart_container_price_totalo_style_section',
            [
                'label'     => __( 'Cart Total', 'element-ready-pro' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );  

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'      => 'cart_container_total_typography',
                    'selector'  => '{{WRAPPER}} .er-wc-product-price',
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'cart_container_total_color',
                [
                    'label'     => __( 'Color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .er-wc-product-price' => 'color: {{VALUE}};',
                       
                    ],
                ]
            );

            $this->add_control(
                'cart_container_total_symbol_color',
                [
                    'label'     => __( 'Symbol Color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .er-wc-product-price .woocommerce-Price-currencySymbol' => 'color: {{VALUE}};',
                       
                    ],
                ]
            );

            $this->add_control(
                'cart_container_total_hover_color',
                [
                    'label'     => __( 'Hover Color', 'element-ready-pro' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .er-wc-product-price:hover' => 'color: {{VALUE}};',
                  
                    ],
                ]
            );

            $this->add_responsive_control(
                'cart_container_total_symbop_padding',
                [
                    'label'      => __( 'Symbol Padding', 'element-ready-pro' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .er-wc-product-price .woocommerce-Price-currencySymbol' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        
                    ],
                ]
            );
         
        $this->end_controls_section();
      
     
    } //Register control end

    
     
    protected function render( ) { 

        if( !class_exists( 'woocommerce' ) ){
            return;  
        }

        $settings = $this->get_settings();
        update_option('element_ready_wc_count_icon',wp_json_encode( $settings['header_cart_icon'] ));
        ?>
     	<div class="cart-area element-ready-cart-content">
            <a class="cart-btn" href="<?php echo wc_get_cart_url(); ?>">
                <?php \Elementor\Icons_Manager::render_icon( $settings['header_cart_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                <?php if(isset(WC()->cart)): ?>
                    <span>
                        <?php echo sprintf (_n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>
                    </span>
                <?php else: ?>
                 <span> 0 </span>       
                <?php endif; ?>
            </a>
            <div class="er-wc-product-price">
            
                   
                <?php if(isset(WC()->cart)): ?>
                    <?php echo wc_price( WC()->cart->total); ?> 
                <?php else: ?>
                    <?php wc_price(0); ?>
                <?php endif; ?>
              
            </div>
        </div>
    
    <?php  

    }
    
    protected function content_template() { }

}