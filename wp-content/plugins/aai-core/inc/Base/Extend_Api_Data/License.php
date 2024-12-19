<?php 
namespace Element_Ready_Pro\Base\Extend_Api_Data;
use Element_Ready_Pro\License\service\License as launcher;

Class License {
    
    public function register() {
      
       $this->rst();
       add_filter('element_ready/dashboard/api-data',[$this,'include'],10,1);
    } 
   
    public function include($api_data){

        return $api_data;
   }

   public function rst(){

       if(class_exists('Element_Ready_Pro\License\service\License')){
          launcher::getInit();
       } 
   }

}