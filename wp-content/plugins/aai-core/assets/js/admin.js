
( function ( $ ) {

  if ( "undefined" != typeof wp && wp.media ) {

  var e = wp.media.view.MediaFrame.Select,
      i = (wp.media.controller.Library, wp.media.view.l10n),
      t = wp.media.view.Frame,
      importData = null,
      er_pagination = 1,
      tabTitle = 'Unsplash Photos',
      defaultSearchTerm = ''; 
      
      wp.media.view.Element_Ready_AttachmentsBrowser = t.extend({
          tagName: "div",
          id: "element-ready-unsplash",
          className: "er-unsplash-photos-browser element-ready-unsplash",
          initialize: function () {
            er_pagination = 1; 
            importData = this;
            element_ready_unplash_load_content('list');
           
          
          }
        }), e.prototype.bindHandlers = function () {
          this.on("router:create:browse", this.createRouter, this), this.on("router:render:browse", this.browseRouter, this), this.on("content:create:browse", this.browseContent, this), this.on("content:create:ElementReadygallery", this.ElementReadygallery, this), this.on("content:render:upload", this.uploadContent, this), this.on("toolbar:create:select", this.createSelectToolbar, this)
        }, e.prototype.browseRouter = function (e) {
          var t = {};
          t.upload = {
            text: i.uploadFilesTitle,
            priority: 19
          }, t.browse = {
            text: i.mediaLibraryTitle,
            priority: 42
          }, t.ElementReadygallery = {
            text: tabTitle,
            priority: 62
          }, 
          e.set(t);
        
        }, e.prototype.ElementReadygallery = function (e) {
          var t = this.state();
          
          e.view = new wp.media.view.Element_Ready_AttachmentsBrowser({
            controller: this,
            model: t,
            AttachmentView: t.get("AttachmentView")
          });
          
          
        };

  } //endif

  function element_ready_unplash_load_content( type='list' , q='', page=1 ){
     
      var params = { action: 'element_ready_get_unsplash', type: type, page: page };

      if(type == 'search'){
        params['q'] = q;
      }
     
      var body_str = $.param( params );
      fetch(ermedia.ajaxurl, {
          method: 'POST',
          headers: new Headers({'Content-Type': 'application/x-www-form-urlencoded'}),
          body: body_str
      })
      .then(response => response.json())
      .then((tmpl) => {
        
        var template = wp.template( 'element-ready-pro-gallary-home' );
        
        importData.$el.html( template( { images: tmpl.data.results } ) );
    
      })
      .catch(function(error) {
      
          console.log(error);
      });
    
  }


  $(document).on("click","#er-unsplash-search-ubtn-",function() {
      er_paginatio = 1; 
      let that         = $(this);
      defaultSearchTerm = that.prev( ".er-unsplash-search" ).val();

      that.prev( ".er-unsplash-search" ).css( "background", "#e1e1e1" );
      element_ready_unplash_load_content('search',defaultSearchTerm,er_pagination);
        
  });

  $(document).on('click','.element-ready-unsplash-remote-image',function(){

    let image_id = $(this).find('img').data('id');
    var params = { action:'element_ready_get_unsplash', type: 'single' ,'id': image_id };
 
    var body_str = $.param( params );
    fetch(ermedia.ajaxurl, {
        method: 'POST',
        headers: new Headers({'Content-Type': 'application/x-www-form-urlencoded'}),
        body: body_str
    })
    .then(response => response.json())
    .then((tmpl) => {
      
      var template = wp.template( 'element-ready-pro-gallary-unsplash-single-image' );
     
      importData.$el.html( template( { image_id: image_id,image:tmpl.data } ) );

    })
    .catch(function(error) {
    
        console.log(error);
    });

  });
  
  $(document).on('click','.element-ready-unsplash-back-btn',function(){
    er_pagination = 1; 
    element_ready_unplash_load_content( 'list' );
  });

  $(document).on('click','.er-unsplash-insert-button ',function(){

    let inser_btn  = $(this);
    let loader = null;
    let image_size = null;
    let image      = inser_btn.attr('data-src');
        image_size = inser_btn.prev( ".er-unsplash-image-size" ).val();
        loader = inser_btn.next( ".er-loader-img" );
        loader.show();
        loader.find( ".er-loader-status" ).text('Downloading image from unsplash');
   
    let _params = { action:'save_er_unsplash_media', size: image_size ,'src': 'unsplash',image:image };

    if( ermedia.hasOwnProperty('post_id')){
      _params['post_id'] = ermedia.post_id.ID;
    }
 
    let body__str = $.param( _params );
    fetch(ermedia.ajaxurl, {
      method: 'POST',
      headers: new Headers({'Content-Type': 'application/x-www-form-urlencoded'}),
      body: body__str
    })
    .then(response => response.json())
    .then((data) => {
       
       loader.find( ".er-loader-status" ).text('Done');
       importData.model.get("selection").add(data.data.attachmentData)
       importData.model.frame.trigger("library:selection:add")
       let buttons = document.querySelectorAll(".media-toolbar .media-toolbar-primary .media-button-select")
       buttons[buttons.length-1].click()
       element_ready_unplash_load_content('list');
       er_pagination = 1; 
    })
    .catch(function(error) {
      loader.find( ".er-loader-status" ).text('File Download fail ').css({'color':'red'});
      loader.find('img').hide();
    
    });

  });

  $(document).on('click','#er-pro-unsplash-next-ubtn-',function(){
      
      if(defaultSearchTerm.length>1){
        
        element_ready_unplash_load_content('search',defaultSearchTerm ,++er_pagination);
      }else{
        element_ready_unplash_load_content('list','',++er_pagination);
      }
     
 
  });  


} )( jQuery );
 


      

