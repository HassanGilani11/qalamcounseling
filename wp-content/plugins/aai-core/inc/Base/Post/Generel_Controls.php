<?php 
namespace Element_Ready_Pro\Base\Post;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Custom_Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Element_Ready\Base\BaseController;

class Generel_Controls extends BaseController
{
	public function register() 
	{
	
	  add_action('element_ready_pro_section_general_grid_tab' , array( $this, 'settings_section' ), 10, 2 );
	}
  
	public function settings_section( $ele,$widget ) 
	{
            
           $ele->start_controls_section(
            'section_general_tab',
                [
                    'label' => esc_html__('General', 'element-ready-pro'),
                ]
            );
                    $ele->add_control(
                    'post_count',
                        [
                            'label'         => esc_html__( 'Post count', 'element-ready-pro' ),
                            'type'          => Controls_Manager::NUMBER,
                            'default'       => '8',
                        ]
                    );

                    $ele->add_control(
                    'post_title_crop',
                        [
                            'label'         => esc_html__( 'Post title crop', 'element-ready-pro' ),
                            'type'          => Controls_Manager::NUMBER,
                            'default'       => '8',
                        ]
                    );
               
                    $ele->add_control(
                        'post_content_crop',
                            [
                                'label'         => esc_html__( 'Post content crop', 'element-ready-pro' ),
                                'type'          => Controls_Manager::NUMBER,
                                'default'       => '18',
                            ]
                    );
         
            $ele->end_controls_section();	
           
    }
    
    
}