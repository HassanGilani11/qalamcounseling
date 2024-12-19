<?php 
namespace Element_Ready_Pro\Base\Widget_Extend;

use Element_Ready\Base\BaseController;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use \Element_Ready_Pro\Base\Traits\Helper;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Repeater;

class Price_Table_Extend extends BaseController{
    use Helper;
    public function register() {

        add_filter( 'element_ready_price_table_style_presets', [$this, 'price_table_style_presets'] );

    }

    public function price_table_style_presets($data){
        
        return [
            '1'  => __( 'Style One', 'element-ready-pro' ),
            '2'  => __( 'Style Two', 'element-ready-pro' ),
            '3'  => __( 'Style Three', 'element-ready-pro' ),
            '4'  => __( 'Style Four', 'element-ready-pro' ),
            '5'  => __( 'Style Five', 'element-ready-pro' ),
            '6'  => __( 'Style Six', 'element-ready-pro' ),
            '7'  => __( 'Style Seven', 'element-ready-pro' ),
            '8'  => __( 'Style Eight', 'element-ready-pro' ),
            '9'  => __( 'Style Nine', 'element-ready-pro' ),
            '10' => __( 'Style Ten', 'element-ready-pro' ),
            '11' => __( 'Style Eleven', 'element-ready-pro' ),
            '12' => __( 'Style Twelve', 'element-ready-pro' ),
            '13' => __( 'Style Thirteen', 'element-ready-pro' ),
        ];
    }

    public function price_table_pro_message( $get_default, $merge ){

        $options = [];
        if( $merge ){
            $return_opt['controls'] = array_merge( $options, $get_default['controls'] );
            return $return_opt;
        }
        $return_opt['controls'] = $options;
        return $return_opt;       
    }

}