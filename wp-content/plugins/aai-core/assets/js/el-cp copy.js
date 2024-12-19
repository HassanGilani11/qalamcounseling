( function ( $ ) {
   
    function element_ready_importContent( newWidget, elementCode, container ) {

        var elementCodeStringify = encodeURIComponent( JSON.stringify(elementCode) );
        var containsMedia = /png|gif|webp|tiff|psd|raw|bmp|heif|svg|jpg/.test(elementCodeStringify);
        
        if ( containsMedia ) {
            fetch(ercp.ajaxurl, {
                method: 'POST',
                headers: new Headers({'Content-Type': 'application/x-www-form-urlencoded'}),
                body: 'action=element_ready_fetch_copy_paste_data&type=single&data=' + elementCodeStringify
            })
            .then(response => response.json())
            .then((tmpl) => {

                var newWidget = {};
                newWidget.elType = tmpl.data[0].elType;
                newWidget.settings = tmpl.data[0].settings;
                newWidget.elements = tmpl.data[0].elements;
    
                $e.run( "document/elements/create", {
                    model: newWidget,
                    container: container
                });
            })
            .catch(function(error) {
                console.log('Something went wrong!');
                console.error(error);

                elementor.notifications.showToast({
                    message: elementor.translate('#2 Something went wrong!')
                });
            });
        } else {
            $e.run( "document/elements/create", {
                model: newWidget,
                container: container,
            });
        }
    }

    function element_ready_pasteElement( newElement, element ) {
         
        // Original element
        var quomodoElement = element;
        var quomodoElementType = element.model.get( "elType" );
        
        // Copied Element
        var elementType = newElement.elementCode.elType;
        var elementCode = newElement.elementCode;
        
        var newWidget = {
            elType: elementType,
            settings: elementCode.settings
        };
        var container;
     
        switch( elementType ) {
            case 'section':
                newWidget.elements = element_ready_cp_getUniqueId( elementCode.elements );
                container = elementor.getPreviewContainer();
                break;
            case 'column':
                              
                newWidget.elements = element_ready_cp_getUniqueId( elementCode.elements );
                switch( quomodoElementType ){

                    case 'widget':
                        
                        container = quomodoElement.getContainer().parent.parent;
                        break;
                    case 'column':
                        container = quomodoElement.getContainer().parent;
                        break;
                    case 'section':
                        container = quomodoElement.getContainer();
                        break;
                }
                break;
            case 'widget':
                newWidget.widgetType = newElement.elementType;
                container = quomodoElement.getContainer();
                switch( quomodoElementType ) {
                    case 'widget':
                        container = quomodoElement.getContainer().parent;
                      
                        quomodoElementType.index = quomodoElement.getOption( "_index" ) + 1;
                        break;
                    case 'column':
                        container = quomodoElement.getContainer();
                        break;
                    case 'section':
                        container = quomodoElement.children.findByIndex(0).getContainer();
                        break;
                }
                break;
        }
      
        element_ready_importContent( newWidget, elementCode, container );
    }


    var copyType = [ 'widget', 'column', 'section' ];
    //var copyType = [  'column', 'section' ];
    var allElements = [];

    copyType.forEach( function( item, index ) {
        elementor.hooks.addFilter( 'elements/' + copyType[index] + '/contextMenuGroups', function ( groups, element ) {
            allElements.push(element);

            groups.push({
                name: "er_" + copyType[index],
                actions: [
                    {
                        name: 'er_copy',
                        title: ercp.copy,
                        callback: function () {

                            var cookieEnabled = navigator.cookieEnabled;

                            if(!cookieEnabled){
                              alert("Please Enable Your browser Cookie");      
                            }
     

                            localStorage.clear();
                            var copiedElement = {};
                            copiedElement.elementType = copyType[index] == "widget" ? element.model.get( "widgetType" ) : null;
                            
                            copiedElement.elementCode = element.model.toJSON();
                            xdLocalStorage.setItem( 'element-ready-ercp-element', JSON.stringify(copiedElement), function (data) {
                                elementor.notifications.showToast({
                                    message: elementor.translate('Content Copied!')
                                });
                            });
                            
    

                        }
                    },
                    {
                        name: 'er_paste',
                        title: ercp.paste,
                        callback: function () {
                            xdLocalStorage.getItem( 'element-ready-ercp-element', function ( newElement ) {
                                element_ready_pasteElement( JSON.parse( newElement.value ), element );

                                elementor.notifications.showToast({
                                    message: elementor.translate('Content Pasted! ')
                                });
                            });
                        }
                    },
                    {
                        name: 'er_copy_all',
                        title: ercp.copy_all,
                        callback: function () {
                            var allSections = [];
                            allElements.forEach(elem => {
                                if ( elem.container.type == "section" ) {
                                    var sect = elem.model.toJSON();
                                    if ( ( sect.isInner === false || sect.isInner === "" ) && sect.elements.length ) {
                                        allSections.push( elem.model.toJSON() );
                                    }
                                }
                            });

                            xdLocalStorage.setItem( 'element-ready-ercp-page-sections', JSON.stringify(allSections), function (data) {
                                elementor.notifications.showToast({
                                    message: elementor.translate('All Sections Copied! ')
                                });
                            });
                        }
                    },
                    {
                        name: 'er_paste_all',
                        title: ercp.paste_all,
                        callback: function () {
                            xdLocalStorage.getItem( 'element-ready-ercp-page-sections', function ( newElement ) {

                                var copiedSections = JSON.parse( newElement.value );
								var sectionsStringify = encodeURIComponent( JSON.stringify(copiedSections) );
                                
                                fetch(ercp.ajaxurl, {
                                    method: 'POST',
                                    headers: new Headers({'Content-Type': 'application/x-www-form-urlencoded'}),
                                    body: 'action=element_ready_fetch_copy_paste_data&type=multiple&data=' + sectionsStringify
                                })
                                .then(response => response.json())
                                .then((tmpl) => {

                                    var elements = element_ready_cp_getUniqueId( tmpl.data.data.template.content );

                                    if ( ercp.elementorCompatible ) {
                                        // Compatibility for older elementor versions
                                        elementor.sections.currentView.addChildModel( elements )
                                    } else {
                                        elementor.previewView.addChildModel( elements )
                                    }
                                    elementor.notifications.showToast({
                                        message: elementor.translate('Page Pasted! 👶')
                                    });
                                })
                                .catch(function(error) {
                                
                                    elementor.notifications.showToast({
                                        message: elementor.translate('Template import fail 🏸')
                                    });
                                });

                            });
                        }
                    },
                ]
            });
            return groups;
        });
    });

  
    function element_ready_cp_getUniqueId( elements ) {

        elements.forEach( function( item, index ) {
            item.id =  elementorCommon.helpers.getUniqueId();
            if( item.elements.length > 0 ) {
                element_ready_cp_getUniqueId( item.elements );
            }
        } );
        return elements;

    }

    xdLocalStorage.init(
        {
            iframeUrl: ercp.script_url,
            initCallback: function () {  }
        }
    );
    
    function element_ready_supports_html5_storage() {
        try {
          if ('localStorage' in window && window['localStorage'] !== null)
              {
                localStorage.setItem("ertestitem",true);
                localStorage.removeItem("ertestitem");
                return true;
              }
        } catch (e) {
          return false;
        }
      
      }
  
} )( jQuery );