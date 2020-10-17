(function ($) {
    "use strict";

    var Na_Admin = {
        init: function() {
            this.metabox.tab();
        },
        megamenu: {
            select_image: function() {

            }
        },
        metabox: {
            element: '#postbox-container-2 #normal-sortables',
            tab: function() {
            }
        }

    };
    function na_infiniteScroll(){
        var infiniteScroll = {
            navSelector: '.pagination', // selector for the paged navigation
            nextSelector: '.pagination .next', // selector for the NEXT link (to page 2)
            itemSelector: '.na-blog-content .archive-blog > .col-post-item', // selector for all items you'll retrieve
            contentSelector: '.na-blog-content .archive-blog'
        };
        jQuery(infiniteScroll.contentSelector).infinitescroll(
            infiniteScroll, function (newElements) {
                //if (jQuery('#loadmore-button').hasClass('load-more')) {
                //    jQuery('#loadmore-button').fadeIn(400);
                //}
                if (jQuery('.na-blog-content .archive-blog').length) {
                    var container = document.querySelector('.na-blog-content .archive-blog');
                    var msnry = new Masonry(container);
                    var $newElems = $(newElements).css('opacity', '0');
                    $newElems.imagesLoaded(function () {
                        // show elems now they're ready
                        $newElems.addClass('new');
                        msnry.appended($newElems);
                        msnry.layout();
                        msnry.on('layoutComplete', function () {
                            new Masonry(container);
                        });
                    });
                }
                jQuery("img.lazy").lazyload();
            }
        );
        jQuery(window).unbind('.infscr');
        if (!$('.pagination .next')[0]) {
            jQuery('#loadmore-button').html('No More Load');
        }
        else {
            var url = '';
            jQuery('#loadmore-button').on('click', function (e) {
                e.preventDefault();
                if (url == '') {
                    url = $('.pagination .next').attr('href');
                }
                else {
                    if ($('.inactive[href="' + url + '"]').next('.inactive')[0]) {
                        url = $('.inactive[href="' + url + '"]').next('.inactive').attr('href');
                    }
                    else {
                        url = window.location.href;
                    }
                }
                if (url != window.location.href) {
                    jQuery(this).html('Loading... <i class="fa fa-spinner fa-spin"></i>');
                    jQuery('.na-blog-content .archive-blog').infinitescroll('retrieve');
                    window.history.pushState({path: url}, '', url);
                    jQuery(".na-blog-content .archive-blog").bind("DOMSubtreeModified", function () {
                        if ($('.inactive[href="' + url + '"]').next('.inactive')[0]) {
                            jQuery('#loadmore-button').html('Load More <i class="fa fa-angle-double-right"></i>');
                        }
                        else {
                            jQuery('#loadmore-button').html('No More Load');
                        }
                    });
                }
                else {
                    jQuery('#loadmore-button').html('No More Load');
                }
            });

        }
    }
    $(document).ready(function() {
        Na_Admin.init();
        na_infiniteScroll();
    });

})(jQuery);