(function($) {


    var Blog_Search = function($scope, $) {

        $scope.find('.wooready_nice_select select').niceSelect();
      
    };


    $(window).on('elementor/frontend/init', function() {
 
        elementorFrontend.hooks.addAction('frontend/element_ready/element-ready-blog-search.default', Blog_Search);
   
    });


})(jQuery);