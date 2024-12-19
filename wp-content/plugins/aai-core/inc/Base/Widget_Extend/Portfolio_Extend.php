<?php 
namespace Element_Ready_Pro\Base\Widget_Extend;
use Element_Ready\Base\BaseController;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use \Element_Ready_Pro\Base\Traits\Helper;
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

class Portfolio_Extend extends BaseController{
     use Helper;
    public function register() {
       
        add_filter( 'element_ready_portfolio_style_presets', [$this, 'portfolio_style_presets'] );
        add_filter( 'element_ready_portfolio_layout_style_presets', [$this, 'portfolio_layout_style_presets'] );

        add_filter( 'element_ready_portfolio_filter_options_pro_message', [$this,'portfolio_pro_message'], 10, 2 );
        add_action( 'element_ready_portfolio_filter_options', [$this, 'portfolio_filter_options_pro'] );

    }

    public function portfolio_style_presets(){
        return [
            '1'      => __( 'Layout One', 'element-ready' ),
            '2'      => __( 'Layout Two', 'element-ready' ),
            '3'      => __( 'Layout Three', 'element-ready' ),
            '4'      => __( 'Layout Four', 'element-ready' ),
            '5'      => __( 'Layout Five', 'element-ready' ),
            '6'      => __( 'Layout Six', 'element-ready' ),
            '7'      => __( 'Layout Seven', 'element-ready' ),
            '8'      => __( 'Layout Eight', 'element-ready' ),
            'custom' => __( 'Layout Custom', 'element-ready' ),
        ];
    }
    
    public function portfolio_layout_style_presets(){
        return [
            'slider'         => esc_html__( 'Slider', 'element-ready' ),
            'genaral'        => esc_html__( 'Genaral', 'element-ready' ),
            'filtering'      => esc_html__( 'Filtering', 'element-ready' ),
            'masonry'        => esc_html__( 'Masonry', 'element-ready' ),
            'masonry_filter' => esc_html__( 'Masonry Filter', 'element-ready' ),
            'genaral_filter' => esc_html__( 'Genaral Filter', 'element-ready' ),
        ];
    }

    public function portfolio_pro_message( $get_default, $merge ){

        $options = [];
        if( $merge ){
            $return_opt['controls'] = array_merge( $options, $get_default['controls'] );
            return $return_opt;
        }
        $return_opt['controls'] = $options;
        return $return_opt;
    }

    public function portfolio_filter_options_pro( $element ){
        $element->add_control(
            'gallery_menu',
            [
                'label'        => esc_html__( 'Show Filtering Menu ?', 'element-ready' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'element-ready' ),
                'label_off'    => esc_html__( 'Off', 'element-ready' ),
                'return_value' => 'yes',
                'default'      => 'no',
                'separator'    => 'before',
                'condition'    => [
                    'gallery_type!' => 'slider',
                ]
            ]
        );
    }

}