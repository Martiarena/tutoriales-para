
(function ($) {
    "use strict";
    function customAttribute(){
        // Custom  }
        $( '.nano-custom-attribute > li' ).live( 'click', function(e) {
            e.preventDefault();

            var variation_value = $(this).data( 'value' ),
                selectId        = $(this).parent().data( 'attribute' ),
                select          = $( 'select#'+selectId );

            $(this).addClass( 'selected' ).siblings().removeClass( 'selected' );

            select.val( variation_value ).trigger( 'change' );
        } );

        $( '.variations_form' ).live( 'change', 'select[data-attribute_name]', function() {
            // Auto select option thas has only 1 choice availible
            setTimeout( function() {
                $( '.variations_form select[data-attribute_name]' ).each( function( i, e ) {
                    if ( $( e ).val() == '' && $( e ).children( '[value!=""]' ).length == 1 ) {
                        $( e ).val( $( e ).children( '[value!=""]' ).attr( 'value' ) ).trigger( 'change' );
                    }
                } );
            }, 50 );

            $( '.nano-custom-attribute[data-attribute]' ).each( function( i, e ) {
                ( function( e ) {
                    setTimeout( function() {
                        var option = $( e ).attr( 'data-attribute' ),
                            select = $( '#' + option );

                        $( e ).children().each( function( i2, e2 ) {
                            if ( select.children( '[value="' + $( e2 ).attr( 'data-value' ) + '"]' ).length == 1 ) {
                                $( e2 ).show();
                            } else {
                                $( e2 ).hide();
                            }
                        } );
                    }, 50 );
                } )( e );
            } );
        } );

        $( 'a.reset_variations' ).live( 'click',  function() {
            $( '.nano-custom-attribute' ).each( function( i, e ) {
                $( e ).find( 'li.selected' ).removeClass( 'selected' );
            } )
        } );
    }

    $(document).ready(function() {
        customAttribute();


        var paged = 1;
        //loadMore =====================================================================================================
        jQuery('.type-loadMore').each(function(){
            var wrapper              = jQuery(this);
            var loadMore_button      = jQuery(this).find('#loadMore');
            loadMore_button.live('click', function(){
                paged++;
                var number         = parseInt(wrapper.data( 'number' )),
                    cat            = wrapper.data( 'cat'),
                    col            = wrapper.data( 'col'),
                    pages          = wrapper.data( 'paged'),
                    layout         = wrapper.data( 'layout');
                $.ajax({
                    url: NaScript.ajax_url,
                    dataType: 'html',
                    type: 'POST',
                    data: {
                        action        : 'load_post',
                        number        : number,
                        cat           : cat,
                        paged         : paged,
                        col           : col,
                        layout        : layout
                    },
                    beforeSend: function() {
                        loadMore_button.addClass( 'loading' );
                    },
                    success:function(data) {
                        var val = $(data);
                        var $container = wrapper.find('.affect-isotope').isotope();
                        $container.append(val).isotope( 'appended', val );
                        $("img.lazy").lazy();
                        setTimeout(function() {
                            $container.imagesLoaded().progress( function() {
                                $container.isotope('layout');
                            });
                        }, 100)

                        loadMore_button.removeClass( 'loading' );
                        if ( paged == pages ) {
                            loadMore_button.addClass( 'hidden' );
                        }
                    },

                    error: function(data){
                        console.log(data);
                    },
                });
                return false;
            });
        });
        //infinitescroll ===============================================================================================
        $('.type-infiniteScroll').each(function(){
            var win = $(window);
            var nextPage      = $('.wrapper-posts').find('#nextPage');
            function bindScroll(){
                if($(window).scrollTop() + $(window).innerHeight() > $(document).height() - 250) {
                    $(window).unbind('scroll');
                    loadMore();
                }
            }
            function loadMore()
            {
                paged++;
                var wrapper        = $('.wrapper-posts'),
                    number         = parseInt(wrapper.data( 'number' )),
                    cat            = wrapper.data( 'cat'),
                    col            = wrapper.data( 'col'),
                    pages          = wrapper.data( 'paged'),
                    layout         = wrapper.data( 'layout');

                $.ajax({
                    url: NaScript.ajax_url,
                    dataType: 'html',
                    type: 'POST',
                    data: {
                        action        : 'load_more_post',
                        number        : number,
                        cat           : cat,
                        paged         : paged,
                        col           : col,
                        layout        : layout
                    },
                    beforeSend: function() {
                        nextPage.addClass( 'loading' );
                    },
                    success:function(data) {
                        var val = $(data);
                        // Set Container
                        var $container =  $( '.wrapper-posts').find('.affect-isotope').isotope();
                        $container.append(val).isotope( 'appended', val );
                        $("img.lazy").lazy();
                        setTimeout(function() {
                            $container.imagesLoaded().progress( function() {
                                $container.isotope('layout');
                            });
                        }, 100)

                        nextPage.removeClass( 'loading' );
                        $(window).bind('scroll', bindScroll);
                        if ( paged == pages ) {
                            nextPage.addClass( 'hidden' );
                        }
                    },
                    error: function(data){
                        console.log(data);
                    },
                });



            }
            $(window).scroll(bindScroll);
        });

        //Load Category ================================================================================================
        jQuery('.box-recent').each(function(){
            var loadMoreCat_button      = $('.wrapper-posts').find('#loadMoreCat');
            var loadMore_button         = $('.wrapper-posts').find('#loadMore');
            var $wrapper                = jQuery(this).find('.tab-content');
            var $catItem                = jQuery(this).find('.wrapper-filter .cat-item');
            var $catAll                 = jQuery(this).find('.wrapper-filter .cat-items');
            $catItem.live('click', function(){
                var agr            = $wrapper.parent().find('.agr-loading'),
                    archive        = $wrapper.find('.archive-blog'),
                    cat            = jQuery(this).data( 'catfilter' ),
                    number         = $wrapper.parent().data( 'number' ),
                    col            = $wrapper.parent().data( 'col'),
                    layout         = $wrapper.parent().data( 'layout');
                $catItem.parent().removeClass('active');
                jQuery(this).parent().addClass( 'active' );

                // RequestData ============================
                var requestData = {
                    action        : 'load_more_category',
                    number        : number,
                    cat           : cat,
                    col           : col,
                    layout        : layout
                };

                if(!jQuery(this).hasClass('loaded')){
                    $.ajax({
                        url: NaScript.ajax_url,
                        dataType: 'html',
                        type: 'POST',
                        data: requestData,
                        beforeSend: function() {
                            agr.addClass( 'post-loading' );
                            archive.addClass( 'archive-affect' );
                            return true;
                        },
                        success:function(data) {
                            agr.removeClass( 'post-loading' );
                            archive.removeClass( 'archive-affect');
                            ajaxResponse(data);
                        },
                        error: function(data){
                            console.log(data);
                        }
                    });
                }

                jQuery(this).not('.loaded').addClass('loaded');
                var $activeContent='allCat';
                if(jQuery(this).parent().hasClass('active')){
                    $activeContent = jQuery(this).data( 'catfilter' );
                }
                $wrapper.find('.archive-blog').removeClass('active');
                $wrapper.find('.archive-blog').removeClass('affect-isotope');
                $wrapper.find('#'+$activeContent).addClass('active').addClass('affect-isotope');;
                jQuery( '.wrapper-posts').find('.affect-isotope').isotope({
                    transitionDuration: '0.4s',
                    masonry: {
                        columnWidth:'.col-item'
                    },
                    fitWidth: true,
                });
            });

            function ajaxResponse(data) {
                var val                     = $(data);
                var $container              = $( '.wrapper-posts').find('.affect-isotope').isotope({
                    transitionDuration: '0.4s',
                    masonry: {
                        columnWidth:'.col-item'
                    },
                    fitWidth: true,
                });

                loadMore_button.addClass( 'hidden' );
                loadMoreCat_button.removeClass( 'hidden' );
                $wrapper.append(val).find('.affect-isotope').isotope({
                    transitionDuration: '0.4s',
                    masonry: {
                        columnWidth:'.col-item'
                    },
                    fitWidth: true,
                });
                $wrapper.find("img.lazy").lazy();
                setTimeout(function() {
                    $container.imagesLoaded().progress( function() {
                        $container.isotope('layout');
                    });
                    $("img.lazy").lazy();
                }, 100)
            }

            $catAll.live('click', function(){
                $catItem.parent().removeClass('active');
                jQuery(this).parent().addClass( 'active' );
                jQuery(this).not('.loaded').addClass('loaded');
                var $activeContent='allCat';
                if(jQuery(this).parent().hasClass('active')){
                    $activeContent = jQuery(this).data( 'catfilter' );
                }
                $wrapper.find('.archive-blog').removeClass('active');
                $wrapper.find('.archive-blog').removeClass('affect-isotope');
                $wrapper.find('#'+$activeContent).addClass('active').addClass('affect-isotope');;
                jQuery( '.wrapper-posts').find('.affect-isotope').isotope({
                    transitionDuration: '0.4s',
                    masonry: {
                        columnWidth:'.col-item'
                    },
                    fitWidth: true,
                });
                loadMore_button.removeClass( 'hidden' );
                loadMoreCat_button.addClass( 'hidden' );
            });
        });

        // then loadmore
        jQuery('.box-recent .box-filter').each(function(){
            var wrapper                 = jQuery(this).parent().parent();
            var loadMoreCat_button      = wrapper.find('#loadMoreCat');
            var paged = 1;
            loadMoreCat_button.on('click', function(){
                jQuery('.wrapper-filter .cat-item').on('click', function(){
                    return paged = 1;
                });
                paged++;
                var pages= 1,
                    cat='',
                    number='9',
                    col='',
                    layout='',
                    wrapperActive=wrapper.find('.archive-blog.active');

                if(jQuery('.wrapper-posts').find('.archive-blog').hasClass('active')){
                        pages          = parseInt(wrapperActive.find('#filterPages').data('filter-pages')),
                        cat            = wrapperActive.find('#filterPages').data('filter-cat'),
                        number         = wrapperActive.find('#filterPages').data('filter-number'),
                        col            = jQuery('.wrapper-posts').data( 'col'),
                        layout         = jQuery('.wrapper-posts').data( 'layout');
                }

                if(paged <= pages) {
                    $.ajax({
                        url: NaScript.ajax_url,
                        dataType: 'html',
                        type: 'POST',
                        data: {
                            action: 'load_more_post',
                            number: number,
                            cat: cat,
                            paged: paged,
                            col: col,
                            layout: layout
                        },
                        beforeSend: function () {
                            loadMoreCat_button.addClass('loading');
                        },
                        success: function (response) {
                            var val2 = $(response);
                            var $container =  $( '.wrapper-posts').find('.affect-isotope').isotope({
                                transitionDuration: '0.4s',
                                masonry: {
                                    columnWidth:'.col-item'
                                },
                                fitWidth: true,
                            });
                            $container.append(val2).isotope( 'appended', val2 );
                            $("img.lazy").lazy();
                            setTimeout(function() {
                                $container.imagesLoaded().progress( function() {
                                    $container.isotope('layout');
                                });
                                $("img.lazy").lazy();
                            }, 100)

                            loadMoreCat_button.removeClass('loading');

                            if (paged == pages) {
                                loadMoreCat_button.addClass('hidden');
                            }
                        },
                        error: function (data) {
                            console.log(data);
                        },
                    });
                    return false;
                }
                if (pages == '1') {
                    loadMoreCat_button.addClass('hidden');
                }
            });
        });

        //loadCategory BOX=============================================================================================
        jQuery('.box-cats').each(function(){
            var $wrapper              = jQuery(this).find('.tab-content');
            var $catItem              = jQuery(this).find('.wrapper-filter .cat-item');
            $catItem.live('click', function(){
                var agr            = $wrapper.parent().find('.agr-loading'),
                    archive        = $wrapper.find('.archive-blog'),
                    cat            = jQuery(this).data( 'catfilter' ),
                    number         = $wrapper.parent().data( 'number' ),
                    col            = $wrapper.parent().data( 'col'),
                    layout         = $wrapper.parent().data( 'layout');
                $catItem.parent().removeClass('active');
                jQuery(this).parent().addClass( 'active' );

                // RequestData ============================
                var requestData = {
                    action        : 'load_more_category',
                    number        : number,
                    cat           : cat,
                    col           : col,
                    layout        : layout
                };

                if(!jQuery(this).hasClass('loaded')){
                    $.ajax({
                        url: NaScript.ajax_url,
                        dataType: 'html',
                        type: 'POST',
                        data: requestData,
                        beforeSend: function() {
                            agr.addClass( 'post-loading' );
                            archive.addClass( 'archive-affect' );
                            return true;
                        },
                        success:function(data) {
                            agr.removeClass( 'post-loading' );
                            archive.removeClass( 'archive-affect');
                            ajaxResponse(data);
                        },
                        error: function(data){
                            console.log(data);
                        }
                    });
                }

                jQuery(this).not('.loaded').addClass('loaded');
                var $activeContent='allCat';
                if(jQuery(this).parent().hasClass('active')){
                    $activeContent = jQuery(this).data( 'catfilter' );
                }
                $wrapper.find('.archive-blog').removeClass('active');
                $wrapper.find('#'+$activeContent).addClass('active');
            });

            function ajaxResponse(data) {
                var val                     = $(data);
                $wrapper.append(val);
                $wrapper.find("img.lazy").lazy();
            }

        });

        //Videos BOX=============================================================================================
        jQuery('.box-videos').each(function(){
            var $wrapper              = jQuery(this).find('.slider-video .post-item');

            var $btn                  = jQuery(this).find('.btn-play');


            var $postItem             =   jQuery('.box-video .slider-video .post-item');

            $btn.live('click', function(){

                //check active nav
                if( jQuery('.slider-nav .post-image').hasClass('active')){
                    jQuery('.slider-nav .post-image').removeClass('active');
                };
                jQuery(this).addClass('active');

                var id                    = jQuery(this).data( 'id');
                var videoItem             = jQuery('.slider-video .post-item.video-'+id);
                var iframeVideo           = $postItem.find('.video-item');
                var iframeCurrent         = videoItem.find('.video-item');


                //reset active slider
                if($wrapper.hasClass('active')){
                    $wrapper.removeClass('active');
                }

                //active
                videoItem.addClass('active');


                // RequestData ============================
                var requestData = {
                    action        : 'load_videos',
                    id            : id,
                };
                if(!videoItem.hasClass('loaded')){
                    $.ajax({
                        url: NaScript.ajax_url,
                        dataType: 'html',
                        type: 'POST',
                        data: requestData,
                        beforeSend: function() {
                            //archive.addClass( 'archive-affect' );
                            jQuery('.slider-video .post-item.video-'+id).addClass('video-loading');
                            return true;
                        },
                        success:function(data) {
                            jQuery('.slider-video .post-item.video-'+id).removeClass('video-loading');
                            var val                     = $(data);
                            jQuery('.slider-video .post-item.video-'+id+' .article-video').append(val);
                            jQuery('.slider-video .post-item.video-'+id).addClass('loaded');
                            jQuery('.playing').videoController('play');
                            jQuery('.paused').videoController('pause');
                        },
                        error: function(data){
                            console.log(data);
                        }
                    });
                }
                //add paused
                if(iframeVideo.not('paused')){
                    iframeVideo.addClass('paused');
                };
                //reset playing
                if(iframeVideo.hasClass('playing')){
                    iframeVideo.removeClass('playing');
                };

                //add playing
                iframeCurrent.removeClass('paused');
                iframeCurrent.addClass('playing');

                if(iframeVideo.hasClass('playing')){
                    playVideo();
                }
                if(iframeVideo.hasClass('paused')){
                    pauseVideo();
                }
            });

            function ajaxResponse(data) {
                var val                     = $(data);
                $append.append(val);
            }

        });
        jQuery('.video-item').videoController({
            videoReady: function() { displayEvent('ready'); },
            videoStart: function() { displayEvent('start'); },
            videoPlay: function() { displayEvent('play'); },
            videoPause: function() { displayEvent('pause'); },
            videoEnded: function() { displayEvent('ended'); }
        });

    });
    function playVideo() {
        jQuery('.playing').videoController('play');
    }

    function pauseVideo() {
        jQuery('.paused').videoController('pause');
    }
    function displayEvent(eventType) {
        var textarea  = $('.events');
        textarea.val(textarea.val() + '\n' + eventType);
    }

})(jQuery);
