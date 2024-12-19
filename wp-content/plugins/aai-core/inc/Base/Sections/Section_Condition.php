<?php 
namespace Element_Ready_Pro\Base\Sections;

class Section_Condition {

    public function list($settings){

        $flag       = true;
        $conditions = $settings['element_ready_pro_conditional_content_list'];
       
        foreach($conditions as $item){

           if( $item['condition']  == 'login_status' ) {
              $flag = $this->login_status($item);
             
            }

            if( $item['condition']  == 'date_time' ) {

                $flag = $this->date_time($item);
            }

            if( $item['condition']  == 'current_page' ) {

                $flag = $this->page($item);
            }

            if( $item['condition']  == 'current_archive' ) {

                $flag = $this->archive_page($item);
            }

        }
       
        return $flag;
    }

    public function archive_page($item){
           
       $flag = true;
       if( $item['archive_where'] == 'match' && $item['archive_template'] !='none' && function_exists( $item['archive_template'] ) ){
         
            if( $item['archive_template']() ){
               
                $flag = true;  
            }else{
                $flag = false;  
            } 
           
       }
       
       if( $item['archive_where'] == 'not_match' && $item['archive_template'] !='none' && function_exists( $item['archive_template'] ) ){
         
        if( !$item['archive_template']() ){
            $flag = true;  
        }else{
            $flag = false;  
        } 
       
   }

       return $flag;
    }
    public function page($item){
  
     global $template;
     
      $flag = true;
      $post_ids = explode( ',',$item['post_ids'] );
      
      if( !empty($post_ids) ) {

            if( isset($item['page_where2']) && isset($item['page_where']) &&  $item['page_where'] =='match' && $item['page_where2'] == '' ){
                // post id match
                if(in_array(get_the_id(),$post_ids)){
                    $flag = true;
                }else{

                    $flag = false;
                }
               
            }elseif( (isset($item['page_where']) && $item['page_where'] =='match' && isset($item['page_where2']) && $item['page_where2'] =='or' ) && $item['post_templates'] != -1 ){
                
                 if( in_array(get_the_id(),$post_ids) || is_page_template( $item['post_templates'] ) ){
                   
                    $flag = true;
                 }else{
                    $flag = false; 
                 }

            }elseif( (isset($item['page_where']) && $item['page_where'] =='match' && isset($item['page_where2']) && $item['page_where2'] =='and' ) && $item['post_templates'] != -1 ){

                if( in_array(get_the_id(),$post_ids) && is_page_template( $item['post_templates'] ) ){
                    
                    $flag = true;
                 }else{
                    $flag = false; 
                 }

            }
            // post id not match
            if( isset($item['page_where']) && $item['page_where'] =='not_match' && isset($item['page_where2']) && $item['page_where2'] == ''){
               
                if( in_array(get_the_id(), $post_ids) ){
                    $flag = false;
                }else{
                    $flag = true;
                }
      
            }elseif( (  isset($item['page_where']) && $item['page_where'] =='not_match' && isset($item['page_where2']) && $item['page_where2'] =='or' ) && $item['post_templates'] != -1 ){
               
                if( !in_array(get_the_id(),$post_ids) || !is_page_template( $item['post_templates'] ) ){
                   
                    $flag = true;
                 }else{
                    $flag = false; 
                 }

            }elseif( ( isset($item['page_where']) && $item['page_where'] =='not_match' && isset($item['page_where2']) && $item['page_where2'] =='and' ) && $item['post_templates'] != -1 ){

                if( in_array(get_the_id(),$post_ids) && is_page_template( $item['post_templates'] ) ){
                    $flag = true;
                 }else{
                    $flag = false; 
                 }
            }
         
      }

     return $flag;

    }

    public function login_status($item){
    
        if( isset($item['login_status']) && $item['login_status'] == 'is' && $item['login'] == 'logged_in' && is_user_logged_in() ) {
            // user must logged in to show content
          return true;
        }elseif( isset( $item['login_status'] ) && $item['login_status'] == 'is_not' && isset($item['login']) && $item['login'] == 'logged_in' && !is_user_logged_in() ) {
            // user not logged
            return true;
        }elseif( isset( $item['login_status'] ) && $item['login_status'] == 'is' && isset( $item['login'] ) && $item['login'] == 'logged_in_role' && is_user_logged_in() ) {
            
            
            if( !empty($item['role']) ) {
                    // user role check 
                    foreach( $item['role'] as $role ) {
                        
                        if( in_array( $role , element_ready_get_current_user_role() ) ) {
                            return true;
                        }

                    }
                    return false;
            }

           return true; 
        }
      
        return false;
    }

    public function date_time($item){

        if( isset($item['date_range']) && $item['date_range'] != 'yes'  && isset($item['due_date']) &&  $item['due_date'] !='' ){

            // will be show in this date
            $current_date = date( 'y-m-d' , time() );
            $due_date     = date( 'y-m-d' , strtotime( $item['due_date'] ) );
          
            if( $due_date == $current_date ) {
              return true;
            }

            return false;
        }elseif( isset($item['date_range']) && $item['date_range'] == 'yes' && isset($item['date_from']) && $item['date_from'] != '' && $item['date_to'] != '' ) {

            $current_date = date('Y-m-d'); 
            $date_from  = date('Y-m-d',strtotime( $item['date_from'] ));
            $date_to   = date('Y-m-d',strtotime( $item['date_to'] ));
 
            if ( ($current_date >= $date_from) && ($current_date <= $date_to) ){
               return true;
            }else{
               return false;
            }
           
        }

        return true;
    }
}