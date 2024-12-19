<?php 
namespace Element_Ready_Pro\Base\Post;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Custom_Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Element_Ready\Base\BaseController;

class Blog_Meta extends BaseController
{
	public function register() 
	{
	
		add_action('element_ready_section_general_blog_post_meta' , array( $this, 'settings_section' ), 10, 2 );
	
	}
    
	public function settings_section( $ele,$widget ) 
	{
            
           $ele->start_controls_section(
            'section_general_tab',
                [
                    'label' => esc_html__('General', 'element-ready'),
                ]
            );
            
               
               
                $ele->add_control(
                    'show_date',
                    [
                        'label'     => esc_html__('Show Date', 'element-ready'),
                        'type'      => Controls_Manager::SWITCHER,
                        'label_on'  => esc_html__('Yes', 'element-ready'),
                        'label_off' => esc_html__('No', 'element-ready'),
                        'default'   => 'yes',
                    ]
                );

             

                $ele->add_control(
                    'show_comment',
                    [
                        'label'     => esc_html__('Show Comment', 'element-ready'),
                        'type'      => Controls_Manager::SWITCHER,
                        'label_on'  => esc_html__('Yes', 'element-ready'),
                        'label_off' => esc_html__('No', 'element-ready'),
                        'default'   => 'yes',
                    ]
                );
                
                $ele->add_control(
                    'show_comment_text',
                    [
                        'label'     => esc_html__('Comment Text?', 'element-ready'),
                        'type'      => Controls_Manager::SWITCHER,
                        'label_on'  => esc_html__('Yes', 'element-ready'),
                        'label_off' => esc_html__('No', 'element-ready'),
                        'default'   => 'yes',
                    ]
                );

                $ele->add_control(
                    'show_cat',
                    [
                        'label'     => esc_html__('Show Category', 'element-ready'),
                        'type'      => Controls_Manager::SWITCHER,
                        'label_on'  => esc_html__('Yes', 'element-ready'),
                        'label_off' => esc_html__('No', 'element-ready'),
                        'default'   => 'yes',
                    ]
                );
    
               
                $ele->add_control(
                    'show_author',
                    [
                        'label'     => esc_html__('Show Author', 'element-ready'),
                        'type'      => Controls_Manager::SWITCHER,
                        'label_on'  => esc_html__('Yes', 'element-ready'),
                        'label_off' => esc_html__('No', 'element-ready'),
                        'default'   => 'yes',
                    ]
                );

              
                $ele->add_control(
                    'show_author_img',
                    [
                        'label'     => esc_html__('Show Author image', 'element-ready'),
                        'type'      => Controls_Manager::SWITCHER,
                        'label_on'  => esc_html__('Yes', 'element-ready'),
                        'label_off' => esc_html__('No', 'element-ready'),
                        'default'   => 'no',
                    ]
                );

             
             
          
            $ele->end_controls_section();	
               
           $ele->start_controls_section(
            'section__icon__general_tab',
                [
                    'label' => esc_html__('Icons', 'element-ready'),
                ]
            );

                $ele->add_control(
                    'date_icon',
                    [
                        'label'         => esc_html__( 'Date icon', 'element-ready' ),
                        'type' => \Elementor\Controls_Manager::ICONS,
                        
                    ]
                );

                $ele->add_control(
                    'author_icon',
                    [
                        'label'         => esc_html__( 'Author icon', 'element-ready' ),
                        'type' => \Elementor\Controls_Manager::ICONS,
                    ]
                );

                $ele->add_control(
                    'cat_icon',
                    [
                        'label'         => esc_html__( 'Categoiry icon', 'element-ready' ),
                        'type' => \Elementor\Controls_Manager::ICONS,
                        
                    ]
                );

                $ele->add_control(
                    'comment_icon',
                    [
                        'label'         => esc_html__( 'Comment icon', 'element-ready' ),
                        'type' => \Elementor\Controls_Manager::ICONS,
                        
                    ]
                );
            
            $ele->end_controls_section();	
        
    }
    
  
}