<?php
namespace Element_Ready_Pro\Widgets\social_feed;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Custom_Controls_Manager;
use Elementor\Group_Control_Typography;

use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;


if ( ! defined( 'ABSPATH' ) ) exit;
require_once( ELEMENT_READY_DIR_PATH . '/inc/style_controls/common/common.php' );
require_once( ELEMENT_READY_DIR_PATH . '/inc/style_controls/position/position.php' );
require_once( ELEMENT_READY_DIR_PATH . '/inc/style_controls/box/box_style.php' );
require_once( ELEMENT_READY_DIR_PATH . '/inc/content_controls/common.php' );

class ER_Facebook_Feed extends Widget_Base {

    use \Elementor\Element_Ready_Common_Style;
    use \Elementor\Element_ready_common_content;
    use \Elementor\Element_Ready_Box_Style;
 
    public $base;

    public function get_name() {
        return 'Element_Ready_Facebook_Feed_Widget';
    }
    
    public function get_title() {
        return __( 'ER Facebook Feed', 'element-ready-pro' );
    }

    public function get_icon() {
        return 'eicon-facebook';
    }

    public function get_categories() {
        return [ 'element-ready-pro' ];
    }

    public function get_keywords() {
        return [ 'facebook feed', 'social', 'feed' ];
    }

    public function get_script_depends(){
         
        return [
           
        ];
        
     }
     public function get_style_depends(){
           
        return [
           
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
                        'default' => 'style2',
                        'options' => [
                            'style1'  => esc_html__( 'Style 1', 'element-ready-pro' ),
                            
                        
                        ],
                    ]
                );


       $this->end_controls_section();

       $this->start_controls_section(
            'section_api_tab',
            [
                'label' => esc_html__('Api Settings', 'element-ready-pro'),
            ]
        );

       $this->add_control(
            'page_id',
            [
                'label'       => __( 'FB Page ID', 'element-ready-pro' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '1308846962486102',
                'placeholder' => __( 'Page id', 'element-ready-pro' ),
            ]
        );

        $this->add_control(
            'access_token',
            [
                'label'       => __( 'Access Token', 'element-ready-pro' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => '',
                'placeholder' => __( 'Access Token from facebook dev', 'element-ready-pro' ),
            ]
        );

       $this->end_controls_section();
      

    }

    public function get_page_content(){

        $settings    = $this->get_settings_for_display();
        $page_id     = trim( sanitize_text_field($settings['page_id']) );
        $accessToken = trim( sanitize_text_field($settings['access_token']) );
        $cache_key   = 'er_facebook_feed_'.$page_id;
        
        if($accessToken == ''){
            return false;
        }

        if($page_id == ''){
            return false;
        }

        $facebook_query_results = get_transient( $cache_key );
        $limit = 10; 
       // if ( $facebook_query_results === false ) {
            $fld = 'created_time,permalink_url,message,full_picture{user_likes,message,from,likes.limit(5).summary(true)}';
            $fld = 'created_time,permalink_url,message,full_picture{user_likes,message,from,likes.limit(5).summary(true)}';
            $url          = sprintf("https://graph.facebook.com/%s/feed?access_token=%s&limit=%s&fields=%s",$page_id,$accessToken,$limit,$fld);
         
            $response     = wp_remote_get($url);
            $responseBody = wp_remote_retrieve_body( $response );
            $result       = json_decode( $responseBody );
            
            if ( is_object( $result ) && ! is_wp_error( $result ) &&  wp_remote_retrieve_response_code( $response ) == 200  ) {
                
                if(isset($result->data)){
                    $facebook_query_results = $result->data;
                    set_transient( $cache_key , $facebook_query_results , 20 * MINUTE_IN_SECONDS );
                  
                }else{
                    return false;
                }
               
               
            } else {
               return false;
            }
       // }
        
        return $facebook_query_results;
    }

    protected function render( $instance = [] ) {

        $settings     = $this->get_settings_for_display();
        $facebook_data = $this->get_page_content();   
    

        
        if(!$facebook_data){
            return;
        }
 

       ?>
   
        
        <?php
    }
}