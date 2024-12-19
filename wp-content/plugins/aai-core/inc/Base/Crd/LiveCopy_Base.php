<?php
namespace Element_Ready_Pro\Base\Crd;

Abstract class LiveCopy_Base
{

	public $post_id    = null;
	public $section_id = null;
	public $type       = 'section';
	
    public function get_data( ) {

		$data = [];

		if($this->post_id){

			if ( get_post_meta( $this->post_id , '_elementor_data', true ) ) {
               $data['content'] = get_post_meta( $this->post_id , '_elementor_data', true );
			}
		}
	
		return $data;
	}
	
	public function get_direct_content( ){
		
		$data    = $this->get_data();
		$content = null;
		
		if( isset($data['content']) ) {
			 
			$decode_content = json_decode($data['content'],true);
			foreach($decode_content as $section){

				if($section['id'] == $this->section_id){
					$content = $section;
					break;	
				}

			}
			
		}
	
		return $content;
	}

  
    
}