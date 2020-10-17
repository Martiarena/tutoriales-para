(function($){
    "use strict";
    jQuery(document).ready(function($) {
        //vertical
        jQuery('.na-gallery-image').each(function(){
            var number = jQuery(this).data('number');
            jQuery('.gallery-main').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                dots: true,
                asNavFor: '.gallery-nav'
            });
            jQuery('.gallery-nav').slick({
                slidesToShow: number,
                slidesToScroll: 1,
                asNavFor: '.gallery-main',
                focusOnSelect: true,
                arrows: false,
                infinite: false,
                vertical: true,
                verticalSwiping: true
            });

        });
    });

})(jQuery);