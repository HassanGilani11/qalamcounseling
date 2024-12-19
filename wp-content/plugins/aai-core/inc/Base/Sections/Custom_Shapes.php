<?php 
namespace Element_Ready_Pro\Base\Sections;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Element_Base;

class Custom_Shapes{

    use \Element_Ready_Pro\Base\Traits\Helper;
    public function register(){
 //if($this->element_ready_get_modules_option('section_custom_shapes')){
        if($this->element_ready_get_modules_option('widget_background_overlay')){
            add_action( 'elementor/shapes/additional_shapes', [ $this, 'register_cpt_custom_shapes' ],19 );
        }
       
    }

     public function register_cpt_custom_shapes(){

        $customs_shapes_cpt = new \WP_Query( [
			'post_type'      => 'er_custom_shapes',
			'posts_per_page' => 100,
			'post_status'    => 'publish',
		] );

		$additional_shapes = $this->custom_section_shapes();
		if ( $customs_shapes_cpt->have_posts() ) {

			while ( $customs_shapes_cpt->have_posts() ) {
			    $customs_shapes_cpt->the_post();
			    global $post;
			    $er_thumbnail_id = get_post_thumbnail_id( $post->ID );
			    if ( !empty( $er_thumbnail_id ) ) {
			    	$er_thumbnail_path = get_attached_file( $er_thumbnail_id );
			    	$er_thumbnail_url = wp_get_attachment_url( $er_thumbnail_id );
			    	if ( $er_thumbnail_path && $er_thumbnail_url && $post->post_name && $post->post_title ) {
                 
			    		$additional_shapes[ $post->post_name ] = [
			    			'title' => $post->post_title,
			    			'path' => $er_thumbnail_path, 
			    			'url' => $er_thumbnail_url, 
			    			'has_flip' => true,
			    			'has_negative' => true
			    		];

			    	}
			    }
			}
           
			wp_reset_postdata();
		}

		return $additional_shapes;
     }

}