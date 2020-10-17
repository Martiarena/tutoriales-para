(function($){
    "use strict";

    jQuery(document).ready(function(){

        jQuery(".owl-single").each(function(){
            jQuery(this).slick({
                autoplay: true,
                dots: true,
                autoplaySpeed: 2000
            });
        });


        jQuery(".article-carousel").each(function(){
            var number = jQuery(this).data('number');
            var dots = jQuery(this).data('dots');
            var arrows = jQuery(this).data('arrows');
            var table = jQuery(this).data('table');
            var mobile = jQuery(this).data('mobile');
            var mobilemin = jQuery(this).data('mobilemin');
            jQuery(this).slick({
                dots: dots,
                slidesToShow: number,
                autoplay: true,
                arrows: arrows,
                autoplaySpeed: 5000,
                responsive: [
                    {
                        breakpoint: 900,
                        settings: {
                            slidesToShow: table
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: mobile
                        }
                    },
                    {
                        breakpoint: 440,
                        settings: {
                            slidesToShow: mobilemin
                        }
                    }
                ]

            });
        });


        jQuery(".article-carousel-center").each(function(){
            var number = jQuery(this).data('number');
            var dots = jQuery(this).data('dots');
            var arrows = jQuery(this).data('arrows');
            jQuery(this).slick({
                dots: dots,
                slidesToShow: number,
                arrows: arrows,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed:5000,
                centerMode: true,
                variableWidth: true,
                focusOnSelect: true,
                responsive: [
                    {
                        breakpoint: 850,
                        settings: {
                            variableWidth: false
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            centerMode: false,
                            variableWidth: false
                        }
                    }
                ]
            });
        });

        // Slider top -------------------------------------------------------------------------------------------------/
        jQuery(".box-slider").each(function(){
            jQuery('.box-large').slick({
                slidesToShow: 1,
                arrows: true,
                autoplay: true,
                fade: true,
                draggable: true,
            });
        });

        // Menu -------------------------------------------------------------------------------------------------------/
        jQuery('.mega-menu').slicknav({
            prependTo   :'#boal-header',
            label       :''
        });

        var scrollTop = $(document).scrollTop();
        var headerHeight = $('.header-fixed').outerHeight();
        var contentHeight = $('.site-header').outerHeight();
        $(window).scroll(function() {
            var headerscroll = $(document).scrollTop();

            if (headerscroll > contentHeight){$('.header-fixed').addClass('fixed');}
            else {$('.header-fixed').removeClass('fixed');}
            //
            if (headerscroll > scrollTop){$('.header-fixed').removeClass('scroll-top');}
            else {$('.header-fixed').addClass('scroll-top');}

            scrollTop = $(document).scrollTop();
        });

        //sticky sidebar
        $('.sidebar').theiaStickySidebar({additionalMarginTop: 0, additionalMarginBottom: 0, minWidth: 992});
        jQuery('.equal-content').each(function () {
            var h=jQuery('.equal-content').outerHeight();
            jQuery('.equal-sidebar').css('height',h);
            $('.equal-sidebar').nanoScroller();
        });
        // Sticky Menu ------------------------------------------------------------------------------------------------/
        jQuery(".btn-mini-search").on( 'click', function(){
            jQuery(".header-content-right .searchform-wrap").removeClass('boal-hidden');
        });
        jQuery(".btn-mini-close").on( 'click', function(){
            jQuery(".header-content-right .searchform-wrap").addClass('boal-hidden');
        });

        // CANVAS MENU ------------------------------------------------------------------------------------------------/
        var menuWrap = jQuery('body').find('.button-offcanvas'),
            mainWrapper = jQuery('body'),
            iconClose = jQuery('.canvas-menu .btn-close'),
            canvasOverlay = jQuery('.canvas-overlay');

        // Function Canvas Menu
        function menuCanvas(){
            mainWrapper.toggleClass('canvas-open');
        }
        // Call Function Canvas
        menuWrap.on( 'click', function(){
            menuCanvas();
        });

        // Click icon close
        iconClose.on( 'click', function(){
            menuCanvas();
        });

        // Click canvas
        canvasOverlay.on( 'click', function(){
            menuCanvas();
        });

        // parallax ---------------------------------------------------------------------------------------------------/


        // Quantity ---------------------------------------------------------------------------------------------------/
        jQuery(".quantity .add-action").live( 'click', function(){
            if( jQuery(this).hasClass('qty-plus') ) {
                jQuery("[name=quantity]",'.quantity').val( parseInt(jQuery("[name=quantity]",'.quantity').val()) + 1 );
            }
            else {
                if( parseInt(jQuery("[name=quantity]",'.quantity').val())  > 1 ) {
                    jQuery("input",'.quantity').val( parseInt(jQuery("[name=quantity]",'.quantity').val()) - 1 );
                }
            }
        } );

        // Accordion Category------------------------------------------------------------------------------------------/

        if($('.product-categories li.cat-parent')[0]){
            $('.product-categories li.cat-parent>a').after('<span class="triggernav"><i class="expand-icon"></i></span>');
            toggleMobileNav('.triggernav', '.widget_product_categories .product-categories li ul');
        }

        function toggleMobileNav(trigger, target) {
            jQuery(target).each(function () {
                jQuery(this).attr('data-h', jQuery(this).outerHeight());
            });
            jQuery(target).addClass('unvisible');
            var h;
            jQuery(trigger).on("click", function () {
                h = 0;
                jQuery(this).prev('a').toggleClass('active');
                jQuery(this).toggleClass('active');
                jQuery.this = jQuery(this).next(target);
                if (jQuery.this.hasClass('unvisible')) {
                    //Get height of this item
                    if (jQuery.this.has("ul").length > 0) {
                        h = parseInt(jQuery.this.attr('data-h')) - parseInt(jQuery.this.find(target).attr('data-h'));
                    }
                    else {
                        h = parseInt(jQuery.this.attr('data-h'));
                    }
                    //resize for parent
                    jQuery.this.parents(target).each(function () {
                        jQuery(this).css('height', jQuery(this).outerHeight() + h);
                    })
                    //set height for this item
                    jQuery.this.css('height', h + "px");
                }
                else {
                    jQuery.this.find(target).not(':has(.unvisible)').addClass('unvisible');
                    //resize for parent when this item hide
                    h = jQuery.this.outerHeight();
                    jQuery.this.parents(target).each(function () {
                        jQuery(this).css('height', jQuery(this).outerHeight() - h);
                    })
                }
                jQuery.this.toggleClass('unvisible');
            });
        }
        //Facebook Comments ------------------------------------------------------------------------------------------//
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        //VIDEO ------------------------------------------------------------------------------------------------------//
        jQuery(".video-verticals").each(function(){
            jQuery('.slider-video').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                infinite: false,
                fade: true,
                asNavFor: '.slider-nav'
            });
            jQuery('.slider-nav').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                asNavFor: '.slider-video',
                dots: false,
                arrows: true,
                centerMode:false,
                infinite: true,
                touchMove:true,
                focusOnSelect: true,
                vertical:true
            });
        });

        //slider video horizontal
        jQuery(".video-horizontal").each(function(){
            jQuery('.slider-nav').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: false,
                dots: false,
                arrows: true,
                centerMode:false,
                focusOnSelect: false,
                responsive: [
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2
                        }
                    }
                ]
            });
        });


        // Woo --------------------------------------------------------------------------------------------------------/
        //Login
        jQuery('.myaccount-login').each(function(){
            jQuery('.btn-form-login').on('click',function() {
                $('.login-wrap').slideUp(0);
                $('.register-wrap').slideDown(250);
            });
            jQuery('.btn-form-register').on('click',function() {
                $('.register-wrap').slideUp(0);
                $('.login-wrap').slideDown(250);

            });

        });
        //carousel
        jQuery(".na-carousel").each(function(){
            var number = jQuery(this).data('number');
            var auto = jQuery(this).data('auto');
            var pagination =jQuery(this).data('pagination');
            jQuery(this).slick({
                autoplay: true,
                slidesToShow: number,
                slidesToScroll: 1,
                dots:pagination,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });


        var initPhotoSwipeFromDOM = function(gallerySelector) {

            // parse slide data (url, title, size ...) from DOM elements
            // (children of gallerySelector)
            var parseThumbnailElements = function(el) {
                var thumbElements = el.childNodes,
                    numNodes = thumbElements.length,
                    items = [],
                    figureEl,
                    linkEl,
                    size,
                    item;

                for(var i = 0; i < numNodes; i++) {

                    figureEl = thumbElements[i]; // <figure> element

                    // include only element nodes
                    if(figureEl.nodeType !== 1) {
                        continue;
                    }

                    linkEl = figureEl.children[0]; // <a> element

                    size = linkEl.getAttribute('data-size').split('x');

                    // create slide object
                    item = {
                        src: linkEl.getAttribute('href'),
                        w: parseInt(size[0], 10),
                        h: parseInt(size[1], 10)
                    };



                    if(figureEl.children.length > 1) {
                        // <figcaption> content
                        item.title = figureEl.children[1].innerHTML;
                    }

                    if(linkEl.children.length > 0) {
                        // <img> thumbnail element, retrieving thumbnail url
                        item.msrc = linkEl.children[0].getAttribute('src');
                    }

                    item.el = figureEl; // save link to element for getThumbBoundsFn
                    items.push(item);
                }

                return items;
            };

            // find nearest parent element
            var closest = function closest(el, fn) {
                return el && ( fn(el) ? el : closest(el.parentNode, fn) );
            };

            // triggers when user clicks on thumbnail
            var onThumbnailsClick = function(e) {
                e = e || window.event;
                e.preventDefault ? e.preventDefault() : e.returnValue = false;

                var eTarget = e.target || e.srcElement;

                // find root element of slide
                var clickedListItem = closest(eTarget, function(el) {
                    return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
                });

                if(!clickedListItem) {
                    return;
                }

                // find index of clicked item by looping through all child nodes
                // alternatively, you may define index via data- attribute
                var clickedGallery = clickedListItem.parentNode,
                    childNodes = clickedListItem.parentNode.childNodes,
                    numChildNodes = childNodes.length,
                    nodeIndex = 0,
                    index;

                for (var i = 0; i < numChildNodes; i++) {
                    if(childNodes[i].nodeType !== 1) {
                        continue;
                    }

                    if(childNodes[i] === clickedListItem) {
                        index = nodeIndex;
                        break;
                    }
                    nodeIndex++;
                }



                if(index >= 0) {
                    // open PhotoSwipe if valid index found
                    openPhotoSwipe( index, clickedGallery );
                }
                return false;
            };

            // parse picture index and gallery index from URL (#&pid=1&gid=2)
            var photoswipeParseHash = function() {
                var hash = window.location.hash.substring(1),
                    params = {};

                if(hash.length < 5) {
                    return params;
                }

                var vars = hash.split('&');
                for (var i = 0; i < vars.length; i++) {
                    if(!vars[i]) {
                        continue;
                    }
                    var pair = vars[i].split('=');
                    if(pair.length < 2) {
                        continue;
                    }
                    params[pair[0]] = pair[1];
                }

                if(params.gid) {
                    params.gid = parseInt(params.gid, 10);
                }

                return params;
            };

            var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
                var pswpElement = document.querySelectorAll('.pswp')[0],
                    gallery,
                    options,
                    items;

                items = parseThumbnailElements(galleryElement);

                // define options (if needed)
                options = {

                    // define gallery index (for URL)
                    galleryUID: galleryElement.getAttribute('data-pswp-uid'),

                    getThumbBoundsFn: function(index) {
                        // See Options -> getThumbBoundsFn section of documentation for more info
                        var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                            pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                            rect = thumbnail.getBoundingClientRect();

                        return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
                    }

                };

                // PhotoSwipe opened from URL
                if(fromURL) {
                    if(options.galleryPIDs) {
                        // parse real index when custom PIDs are used
                        // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                        for(var j = 0; j < items.length; j++) {
                            if(items[j].pid == index) {
                                options.index = j;
                                break;
                            }
                        }
                    } else {
                        // in URL indexes start from 1
                        options.index = parseInt(index, 10) - 1;
                    }
                } else {
                    options.index = parseInt(index, 10);
                }

                // exit if index not found
                if( isNaN(options.index) ) {
                    return;
                }

                if(disableAnimation) {
                    options.showAnimationDuration = 0;
                }

                // Pass data to PhotoSwipe and initialize it
                gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
                gallery.init();
            };

            // loop through all gallery elements and bind events
            var galleryElements = document.querySelectorAll( gallerySelector );

            for(var i = 0, l = galleryElements.length; i < l; i++) {
                galleryElements[i].setAttribute('data-pswp-uid', i+1);
                galleryElements[i].onclick = onThumbnailsClick;
            }

            // Parse URL and open gallery if it contains #&pid=3&gid=1
            var hashData = photoswipeParseHash();
            if(hashData.pid && hashData.gid) {
                openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
            }
        };

// execute above function
        initPhotoSwipeFromDOM('.gallery-main');


    });

})(jQuery);
