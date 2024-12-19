<?php 
namespace Element_Ready_Pro\Base\Sections;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Element_Base;
use Elementor\Group_Control_Background;
use Element_Ready_Pro\Base\Traits\Helper as Utility;
use Elementor\Group_Control_Image_Size;
class Widget_Custom_Control {

    use Utility;  
    public function register(){
      
        $this->update_price_table_control();
        add_action('element_ready_lite_pr_table_before_price',[$this,'element_ready_price_icon'],20);
        add_action('custom_Element_Ready_Jplayer_Playlist_Widget_WrapperPlaylistUlCur',[$this,'audio_playlist_current'],20);
    }

    public function update_price_table_control(){
        add_action( 'elementor/element/Element_Ready_Pricing_Table/element_ready_pricing_header/before_section_end', function( $element, $args ) {
           
            $elementor = \Elementor\Plugin::instance();
            // Get the control you want to update
            $control_data = $elementor->controls_manager->get_control_from_stack( $element->get_name(), 'headerimage' );
            $control_data_2 = $elementor->controls_manager->get_control_from_stack( $element->get_name(), 'element_ready_header_icon_type' );
        
            if ( is_wp_error( $control_data ) ) {
                return;
            }
         
            $control_data_2['condition'] = [
                'content_layout_style'    => ['2','13', '9'],
               
            ];

            $control_data['condition'] = [
                'content_layout_style'    => ['2','13', '9'],
                'element_ready_header_icon_type' => 'img',
            ];

            // update old settings
            $element->update_control( 'element_ready_header_icon_type', $control_data_2 );
            $element->update_control( 'headerimage', $control_data );
            
        }, 10, 2);
    }

    public function audio_playlist_current($element){
      
        $element->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'element_re_playlist_pr_sma_ba_border',
                'label'    => esc_html__( 'Border', 'element-ready' ),
                'selector' => '{{WRAPPER}} .jp-playlist ul li.jp-playlist-current',
            ]
        );
    
        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'element_re_playlist_pr_sma_background',
                'label'    => esc_html__( 'Background', 'element-ready' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .jp-playlist ul li.jp-playlist-current',
            ]
        );
    }

    public function element_ready_price_icon($settings){
         ?>
        <div class="price__icon">
            <?php
                if( $settings['element_ready_header_icon_type'] == 'img' ){  
                    echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'headerimagesize', 'headerimage' );
                }else{
                    echo '<i class="'.$settings['headericon'].'"></i>';
                }
            ?>
        </div>
        <?php
    }
}