 /* Live Copy */
 (function ($) {

    Element_ready_Live_Button_Module = function( $target ) {

        var self         = this,
        sectionId        = $target.data('id'),
        settings         = false,
        editMode         = Boolean( elementorFrontend.isEditMode() ),
        $window          = $( window ),
        $body            = $( 'body' ),
        platform         = navigator.platform;
        /**
         * Init
         */
        self.init = function() {
            
            self.element_ready_live_btn( sectionId );
           
            return false;
        };

        
        self.element_ready_live_btn = function (sectionId){
            
            
            let template = wp.template( 'element-ready-live-btn' );

            let element_ready_section_live_btn = false;
            let element_ready_pro_live_link = '#';
            let element_ready_pro_live_btn_text = 'live copy';
        
            element_ready_section_live_btn = self.getSettings( sectionId, 'element_ready_pro_live_btn_enable' );
            element_ready_pro_live_btn_text = self.getSettings( sectionId, 'element_ready_pro_live_btn_text' );
            element_ready_pro_live_link = self.getSettings( sectionId, 'element_ready_pro_live_link' );
          
            
            
            if( element_ready_section_live_btn == 'yes' ){

                $target.addClass('element-ready-pro-live-btn');
              
                setTimeout(function(){

                    $target.append(template( { text: element_ready_pro_live_btn_text , link: element_ready_pro_live_link } ));
                 },
                2000
                );
               
                
            }else{

                $target.removeClass('element-ready-pro-live-btn');
                
            }


        };

        self.getSettings = function(sectionId, key){
            var editorElements      = null,
            sectionData             = {};
             

            if ( ! editMode ) {
                sectionId = 'section' + sectionId;

                if(!window.element_ready_pro_section_live_button_data || ! window.element_ready_pro_section_live_button_data.hasOwnProperty( sectionId )){
                    return false;
                }

                if(! window.element_ready_pro_section_live_button_data[ sectionId ].hasOwnProperty( key )){
                    return false;
                }

                return window.element_ready_pro_section_live_button_data[ sectionId ][key];
            }else{
                 
                if ( ! window.elementor.hasOwnProperty( 'elements' ) ) {
                    return false;
                }
                editorElements = window.elementor.elements;
                
                if ( ! editorElements.models ) {
                    return false;
                }
                $.each( editorElements.models, function( index, obj ) {
                    if ( sectionId == obj.id ) {
                        sectionData = obj.attributes.settings.attributes;
                    }
                });

                if ( ! sectionData.hasOwnProperty( key ) ) {
                    return false;
                }
            }

            return sectionData[ key ];
        };
    }

    var Element_Ready_Live_Button = {

        elementorSection: function( $scope ) {
            var $element_ready_target   = $scope,
                instance  = null,
                editMode  = Boolean( elementorFrontend.isEditMode() );
                instance = new Element_ready_Live_Button_Module( $element_ready_target );
                // run main functionality
                
                instance.init(instance);
        },
    };

    $(window).on('elementor/frontend/init', function () {

        if (typeof ercp !== 'undefined') {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/section', Element_Ready_Live_Button.elementorSection );
       }

    });


 $(document).on('click', '.element-ready-live-btn-wrp a', function (e) {
   
       
    let that              = $( this );
    let button_lebel      = that.text();
    let parentTag         = that.parent().parent().get( 0 );
    let element_id        = $(parentTag).data('id');
    let element_type      = $(parentTag).data('element_type');
    let post_id           = elementorFrontend.config.post.id;
  
    var json_data = {
        'action'    : 'element_ready_fetch_live_copy_data',
        'type'      : element_type,
        'section_id': element_id,
        'post_id'   : post_id
    };
    
    fetch(ercp.ajaxurl, {
        method: 'POST',
         headers: new Headers({'Content-Type': 'application/x-www-form-urlencoded'}),
         body: $.param(json_data)
     })
     .then(response => response.json())
     .then((tmpl) => {

        let copiedElement = tmpl.data;
     
        localStorage.clear();
        xdLocalStorage.setItem( 'element-ready-ercp-element', JSON.stringify(copiedElement), function (data) {
           that.html('<span>&#10003;</span> Copied section').css({'font-style':'italic'});
        });

        setTimeout(function(){ 

            that.text(button_lebel).css({'font-style':'normal'});
         
        }, 
         1000
        );

   
    })
    .catch(function(error) {
        that.text('Copy error').css({'font-style':'italic'});
    });

});

if (typeof ercp !== 'undefined') {
     
    if(typeof xdLocalStorage !== 'undefined'){
       
        xdLocalStorage.init(
            {
             iframeUrl: ercp.script_url
            }
           );
        
    }
    
}

})(jQuery);