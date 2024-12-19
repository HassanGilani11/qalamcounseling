<?php
namespace Element_Ready_Pro\Modules\Blog\Custom_Post_Type;


trait Option_Html {

    public $types        = array();

    public function settype(){

        $this->types = [
          ''                 => esc_html__('Select Page','element-ready-pro'),
          '404'              => esc_html__('404','element-ready-pro'),
          'post'             => esc_html__('Post','element-ready-pro'),
          'archive'          => esc_html__('Archive','element-ready-pro'),
          'category'         => esc_html__('Category','element-ready-pro'),
          'tag'              => esc_html__('Tag','element-ready-pro'),
          'author'           => esc_html__('Author','element-ready-pro'),
          'blog'             => esc_html__('Blog','element-ready-pro'),
          'search'           => esc_html__('Search','element-ready-pro'),
          'no_search_result' => esc_html__('Search - no result','element-ready-pro')
        ];

    }

    public function option_html( $checked = '' ){

        $html = '';
      
        foreach($this->types as $key => $option){
            $selected = selected( $checked , $key , false);
            $html .= sprintf( '<option value="%s" %s> %s </option>' , $key , $selected,  $option); 
        }

        return $html;
    }

}