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

class Teams_Extend extends BaseController{
    
    use Helper;
    public function register() {
        
        add_filter( 'element_ready_teams_style_presets', [$this, 'teams_style_presets'] );

    }

    public function teams_style_presets(){
        return [
			'team__style__1'      => 'Team Style 1',
			'team__style__2'      => 'Team Style 2',
			'team__style__3'      => 'Team Style 3',
			'team__style__4'      => 'Team Style 4',
			'team__style__5'      => 'Team Style 5',
			'team__style__6'      => 'Team Style 6',
			'team__style__7'      => 'Team Style 7',
			'team__style__8'      => 'Team Style 8',
			'team__style__9'      => 'Team Style 9',
			'team__style__10'     => 'Team Style 10',
			'team__custom__style' => 'Team Custom Style',
        ];
    }

    public function teams_pro_message( $get_default, $merge ){

        $options = [];
        if( $merge ){
            $return_opt['controls'] = array_merge( $options, $get_default['controls'] );
            return $return_opt;
        }
        $return_opt['controls'] = $options;
        return $return_opt;       
    }

}