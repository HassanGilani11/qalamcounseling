<?php 
namespace Element_Ready_Pro\Base\Post;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Custom_Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Element_Ready\Base\BaseController;

class Blog_Search_List extends BaseController
{
	public function register() 
	{
	
		add_action('element_ready_section_general_blog_search_grid' , array( $this, 'settings_section' ), 10, 2 );
	
	}

   
	public function settings_section( $ele,$widget ) 
	{
            
           $ele->start_controls_section(
            'section_general_tab',
                [
                    'label' => esc_html__('Posts General', 'element-ready'),
                ]
            );
                $ele->add_control(
                'post_count',
                    [
                        'label'         => esc_html__( 'Post count', 'element-ready' ),
                        'type'          => Controls_Manager::NUMBER,
                        'default'       => '8',
                    ]
                );

                $ele->add_control(
                'post_title_crop',
                    [
                        'label'         => esc_html__( 'Post title crop', 'element-ready' ),
                        'type'          => Controls_Manager::NUMBER,
                        'default'       => '8',
                    ]
                );
                // uncommon  
              
                $ele->add_control(
                    'show_content',
                    [
                        'label'     => esc_html__('Show content', 'element-ready'),
                        'type'      => Controls_Manager::SWITCHER,
                        'label_on'  => esc_html__('Yes', 'element-ready'),
                        'label_off' => esc_html__('No', 'element-ready'),
                        'default'   => 'yes',
                    ]
                );
    
              
                $ele->add_control(
                    'post_content_crop',
                        [
                            'label'         => esc_html__( 'Post content crop', 'element-ready' ),
                            'type'          => Controls_Manager::NUMBER,
                            'default'       => '40',
                        ]
                );
               

                $ele->add_control(
                    'show_image',
                    [
                        'label'     => esc_html__('Show Image', 'element-ready'),
                        'type'      => Controls_Manager::SWITCHER,
                        'label_on'  => esc_html__('Yes', 'element-ready'),
                        'label_off' => esc_html__('No', 'element-ready'),
                        'default'   => 'yes',
                    ]
                );
                
                 $ele->add_group_control(
                    \Elementor\Group_Control_Image_Size::get_type(),
                    [
                        'label'        => esc_html__( 'Thumb Size', 'element-ready' ),
                        'name'    =>'thumb_size',
                        'default' => 'large',
                        'condition' => [
                            'show_image' => 'yes',
                        ]
                    ]
                );

               
                $ele->add_control(
                    'show_post_meta',
                    [
                        'label'     => esc_html__('Post Meta', 'element-ready'),
                        'type'      => Controls_Manager::SWITCHER,
                        'label_on'  => esc_html__('Yes', 'element-ready'),
                        'label_off' => esc_html__('No', 'element-ready'),
                        'default'   => 'yes',
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
                    'date_icon',
                    [
                        'label'         => esc_html__( 'Date icon', 'element-ready' ),
                        'type' => \Elementor\Controls_Manager::ICONS,
                        
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
                    'comment_icon',
                    [
                        'label'         => esc_html__( 'Comment icon', 'element-ready' ),
                        'type' => \Elementor\Controls_Manager::ICONS,
                        
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
                    'cat_icon',
                    [
                        'label'         => esc_html__( 'Categoiry icon', 'element-ready' ),
                        'type' => \Elementor\Controls_Manager::ICONS,
                        
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
                    'author_icon',
                    [
                        'label'         => esc_html__( 'Author icon', 'element-ready' ),
                        'type' => \Elementor\Controls_Manager::ICONS,
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
               
               
                $ele->add_control(
                    'show_readmore',
                    [
                        'label'     => esc_html__('Show Readmore', 'element-ready'),
                        'type'      => Controls_Manager::SWITCHER,
                        'label_on'  => esc_html__('Yes', 'element-ready'),
                        'label_off' => esc_html__('No', 'element-ready'),
                        'default'   => '',
                        'condition' => [
                            'style' => ['style1','style2'],
                        ]
                        
                    ]
                );

                $ele->add_control(
                    'readmore_text',
                    [
                        
                    'label'         => esc_html__( 'Readmore', 'element-ready' ),
                    'type'          => Controls_Manager::TEXT,
                    'default'      => esc_html__( 'Read more', 'element-ready' ),  
                    'condition' => [
                        'style' => ['style1','style2'],
                    ]
                    ]
                    );

                $ele->add_control(
                    'readmore_icon',
                    [
                        'label'         => esc_html__( 'Readmore icon', 'element-ready' ),
                        'type' => \Elementor\Controls_Manager::ICONS,
                        'condition' => [
                            'style' => ['style1','style2'],
                        ]
                    ]
                );

                $ele->add_control(
                    'sticky_icon',
                    [
                        'label'         => esc_html__( 'Sticky icon', 'element-ready' ),
                        'type' => \Elementor\Controls_Manager::ICONS,
                        
                    ]
                );
             
             
            $ele->end_controls_section();	
        
    }
    
  
}