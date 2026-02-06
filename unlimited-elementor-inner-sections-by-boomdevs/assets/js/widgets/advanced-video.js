(function($) {
    'use strict';

    var AdvancedVideo = function($scope, $) {
        var $wrapper = $scope.find('.pea-advanced-video-wrapper');
        var $overlay = $wrapper.find('.pea-advanced-video-overlay');
        var $iframe = $wrapper.find('.pea-advanced-video-iframe');
        var $video = $wrapper.find('.pea-advanced-video-player');

        if ($overlay.length) {
            $overlay.on('click', function() {
                var videoSource = $wrapper.data('video-source');
                
                // Hide overlay
                $(this).fadeOut(300);
                
                // Start video playback
                if ($iframe.length) {
                    var currentSrc = $iframe.attr('src');
                    var separator = currentSrc.indexOf('?') > -1 ? '&' : '?';
                    var newSrc = currentSrc;
                    
                    // Add autoplay parameter based on platform
                    if (videoSource === 'youtube') {
                        newSrc = currentSrc + separator + 'autoplay=1&mute=1';
                        $iframe.attr('allow', 'autoplay; encrypted-media');
                    } else if (videoSource === 'vimeo') {
                        newSrc = currentSrc + separator + 'autoplay=1&muted=1';
                        $iframe.attr('allow', 'autoplay; fullscreen; picture-in-picture');
                    } else if (videoSource === 'dailymotion') {
                        newSrc = currentSrc + separator + 'autoplay=1';
                        $iframe.attr('allow', 'autoplay');
                    }
                    
                    setTimeout(() => {
                        // Reload iframe with new src
                        $iframe.attr('src', newSrc);
                    }, 200);
                    
                } else if ($video.length) {
                    $video[0].play();
                }
            });
        }
    };

    // Elementor frontend handler
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/pea_advanced_video.default', AdvancedVideo);
    });

})(jQuery);
