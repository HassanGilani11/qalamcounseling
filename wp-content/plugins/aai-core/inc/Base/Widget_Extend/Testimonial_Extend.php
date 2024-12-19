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

class Testimonial_Extend extends BaseController{
    
    use Helper; 
    public function register() {

        add_filter( 'element_ready_testimonial_style_presets', [$this, 'testimonial_style_presets'] );

    }

    public function testimonial_style_presets(){
        return [
			'tesmonial_style_1'      => 'Testmonial Style 1',
			'tesmonial_style_2'      => 'Testmonial Style 2',
			'tesmonial_style_3'      => 'Testmonial Style 3',
			'tesmonial_style_4'      => 'Testmonial Style 4',
			'tesmonial_style_5'      => 'Testmonial Style 5',
			'tesmonial_style_6'      => 'Testmonial Style 6',
			'tesmonial_style_7'      => 'Testmonial Style 7',
			'tesmonial_style_8'      => 'Testmonial Style 8',
			'tesmonial_style_9'      => 'Testmonial Style 9',
			'tesmonial_style_10'     => 'Testmonial Style 10',
			'tesmonial_style_11'     => 'Testmonial Style 11',
			'tesmonial_style_12'     => 'Testmonial Style 12',
			'tesmonial_style_13'     => 'Testmonial Style 13',
			'tesmonial_style_14'     => 'Testmonial Style 14',
			'tesmonial_style_15'     => 'Testmonial Style 15',
			'tesmonial_custom_style' => 'Testmonial Custom Style',
        ];
    }

    public function testimonial_pro_message( $get_default, $merge ){

        $options = [];
        if( $merge ){
            $return_opt['controls'] = array_merge( $options, $get_default['controls'] );
            return $return_opt;
        }
        $return_opt['controls'] = $options;
        return $return_opt;
    }

}