(function ($) {
    "use strict";

    function er_tpl_blog_message_render(response){
            
        var notice= $("#er-blog-tpl-js-notice");
        notice.addClass('show');
        notice.html(response.data.msg);
        if(response.success) {

            setTimeout(function(){

                notice.removeClass('show');

            } , 1000);

        }else{

            setTimeout(function(){

           notice.removeClass('show');

          } , 1000);
        }
    }
    
    // Iframe Popup
    $(document).on('click', '.content_edit a.er-blog-tpl-edit-button' ,function(e){
          
        e.preventDefault();
        var url = $(this).attr('href');
        var dynamic_content = $('.er-blog-tpl-content .wready-md-body');
        var iframe = $('<iframe></iframe>');
        iframe.attr('src', url);
        iframe.hide().on('load',function(){
         
        }).fadeIn('2500');

        dynamic_content.html(iframe);
        $('#er-blog-tpl-nifty-modal').nifty("show");
        
    });

    // Option Store

    $(document).on( 'click','label.er-blog-tpl-switch input' , function(){
        
        var switch_active = $(this);
      
        var post_id = switch_active.attr('data-post_id');
        var active = switch_active.is(":checked") ? 'active' : 'inacitve';
      
        setTimeout(function(){
          
                 $.ajax({
                    type : "post",
                    dataType : "json",
                    url : wp.ajax.settings.url,
                    data : {
                        'action': "er_blog_template_options_store",
                        'er_post_id' : post_id,
                        'er_blog_tpl_key': 'er_blog_tpl_active',
                        'er_blog_tpl_value': active
                    },
                    success: function(response) {
                        er_tpl_blog_message_render(response);
                    }
                 }) 
        },1000);
       

    });

    $(document).on( 'change','.er-template-type-select-fld select' , function(){
        
        var template_type = $(this);
      
        var post_id = template_type.attr('data-post_id');
        var tpl_type = template_type.val();
        
        setTimeout(function(){
          
                 $.ajax({
                    type : "post",
                    dataType : "json",
                    url : wp.ajax.settings.url,
                    data : {
                        'action'           : "er_blog_template_options_store",
                        'er_post_id'       : post_id,
                        'er_blog_tpl_key'  : 'er_blog_tpl_type',
                        'er_blog_tpl_value': tpl_type
                    },
                    success: function(response) {
                        er_tpl_blog_message_render(response);
                    }
                 }) 
        },1000);
  

    });
    
   
})(jQuery);