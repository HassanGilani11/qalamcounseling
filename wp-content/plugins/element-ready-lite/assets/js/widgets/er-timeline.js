!function(e){var t=function(e,t){var i=e.find(".element__ready__timeline__activation").eq(0).data("settings"),n=i.timeline_id,r=i.mode,a=i.horizontal_start_postion,o=i.vertical_start_postion,_=i.force_vartical_in?parseInt(i.force_vartical_in):700,l=i.move_item?parseInt(i.move_item):1,m=i.start_index?parseInt(i.start_index):0,s=i.vartical_trigger?i.vartical_trigger:"15%",d=i.show_item?parseInt(i.show_item):3;try{t("#element__ready__timeline__"+n+" .timeline").timeline({forceVerticalMode:_,horizontalStartPosition:a,mode:r,moveItems:l,startIndex:m,verticalStartPosition:o,verticalTrigger:s,visibleItems:d})}catch(e){t("#element__ready__timeline__"+n+" .timeline").timeline({forceVerticalMode:_,horizontalStartPosition:a,moveItems:l,startIndex:m,verticalStartPosition:o,verticalTrigger:s,visibleItems:d})}};e(window).on("elementor/frontend/init",function(){elementorFrontend.hooks.addAction("frontend/element_ready/Element_Ready_Timeline_Widget.default",t)})}(jQuery);