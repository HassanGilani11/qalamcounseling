;(function ($) {
    "use strict";

    var Element_Ready_Jplayer_Playlist_Widget =function($scope, $){
      
            var $element            = $scope.find( '.er-jp-jplayer-list' );
           
            var $playlist = $element.data('playlist');
            var $remaining_duration = $element.data('remaining_duration');
            var $default_mute       = $element.data('default_mute');
            var $volume             = parseFloat( $element.data('volume') );
          
            var $element_audio      = '#jp-audio-'+$scope.data('id');
    		new jPlayerPlaylist({
    			jPlayer: $element,
               cssSelectorAncestor: $element_audio
    		},
            $playlist,
             {
    		
    			solution         : "html",
    			supplied         : "m4a,mp3",
    			preload          : "auto",
    			volume           : $volume,
    			muted            : $default_mute,
    			wmode            : "window",
    			remainingDuration: $remaining_duration,
    			useStateClassSkin: true,
    			autoBlur         : false,
    			smoothPlayBar    : true,
    			audioFullScreen  : true,
    			keyEnabled       : true,
    			stop: function(e) {
    				$(".toggle-play").removeClass("active");
    				$(".waves").fadeOut();
    			},
    			pause: function(e) {
    				$(".toggle-play").removeClass("active");
    				$(".waves").fadeOut();
    			},
    			play: function(e) {
    				$(".toggle-play").addClass("active");
    				$(".waves").fadeIn();
    			},
    			ready: function(e) {}
    		});
    
    		$(".toggle-list").bind("click", function() {
    			if (!$("body").hasClass("active")) {
    				$("body").addClass("active");
    			} else {
    				$("body").removeClass("active");
    			}
    		});
    		$(window).on("load", function() {
    			$("#jp_video").jPlayer("play");
    		});
    		$(".toggle-play").on("click", function() {
    			if (!$(".jp-audio").hasClass("jp-state-playing")) {
    				$("#jp_video").jPlayer("play");
    			} else {
    				$("#jp_video").jPlayer("stop");
    			}
    		});
    } 
    var Element_Ready_Jplayer_Widget =function($scope, $){
       
        var $element            = $scope.find( '.er-jp-jplayer' );
        var $title              = $element.data('atitle');
        var $remaining_duration = $element.data('remaining_duration');
        var $default_mute       = $element.data('default_mute');
        var $volume             = parseFloat( $element.data('volume') );
        var $url                = $element.data('url');
        var $element_audio      = '#jp-audio-'+$scope.data('id');

        $element.jPlayer({
            ready: function () {
              $(this).jPlayer("setMedia", {
                title: $title,
                m4a: $url,
              });
            },
            cssSelectorAncestor: $element_audio,
            supplied           : "m4a,mp3",
            volume: $volume,
            muted: $default_mute,
            useStateClassSkin  : true,
            autoBlur           : true,
            smoothPlayBar      : true,
            keyEnabled         : false,
            remainingDuration  : $remaining_duration,
            toggleDuration   : true,
            cssSelector      : {
                videoPlay           : '.jp-video-play',
                play                : '.jp-play',
                pause               : '.jp-pause',
                stop                : '.jp-stop',
                seekBar             : '.jp-seek-bar',
                playBar             : '.jp-play-bar',
                mute                : '.jp-mute',
                unmute              : '.jp-unmute',
                volumeBar           : '.jp-volume-bar',
                volumeBarValue      : '.jp-volume-bar-value',
                volumeMax           : '.jp-volume-max',
                playbackRateBar     : '.jp-playback-rate-bar',
                playbackRateBarValue: '.jp-playback-rate-bar-value',
                currentTime         : '.jp-current-time',
                duration            : '.jp-duration',
                title               : '.jp-title',
                fullScreen          : '.jp-full-screen',
                restoreScreen       : '.jp-restore-screen',
                repeat              : '.jp-repeat',
                repeatOff           : '.jp-repeat-off',
                gui                 : '.jp-gui',
                noSolution          : '.jp-no-solution'
               },
          });

    }
    
    var Element_Ready_Binduz_Tab__Widget = function($scope, $){ 

        var $element = $scope.find( '.nav li a' );
        var $element_navs = $scope.find( '.nav li a' );
        var $element_tab_pane = $scope.find( '.tab-content .tab-pane' );
        
        $element.on('click',function(e){
            e.preventDefault()
            var tab_id = $(this).attr('id').replace('#','');
            $element_navs.each(function( index ) {
                $(this).removeClass('active');
            });

            $(this).addClass('active');

            $element_tab_pane.each(function( index ) {
                
                if($(this).attr('id') == tab_id){
                    $(this).addClass('show active');
                }else{
                    $(this).removeClass('active');
                    $(this).removeClass('show');
                }
            });

           
        });
    }

	$(window).on('elementor/frontend/init', function () {
        
        elementorFrontend.hooks.addAction( 'frontend/element_ready/Element_Ready_Jplayer_Widget.default', Element_Ready_Jplayer_Widget );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/Element_Ready_Jplayer_Playlist_Widget.default', Element_Ready_Jplayer_Playlist_Widget );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/element-ready-binduz-grid-post-tabs.default', Element_Ready_Binduz_Tab__Widget );
    });
})(jQuery);