<?php if(get_theme_mod('boal_enable_footer', 'hidden')) { ?>
    <footer id="na-footer" class="na-footer  footer-hidden">
        <div class="footer-center clearfix">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <?php dynamic_sidebar('footer-center'); ?>
                </div>
            </div>
            <div id="scrollup" class="scrollup"><i class="ti-angle-up"></i></div>
        </div>
        <!--    Footer bottom-->
        <div class="footer-bottom clearfix">
            <div class="container">
                <div class="container-inner">
                    <div class="row">

                        <div class="col-md-12 col-sm-12">
                                <div class="coppy-right">
                                    <?php if(get_theme_mod('boal_copyright_text')) {?>
                                        <span><?php echo  wp_kses_post(get_theme_mod('boal_copyright_text'));?></span>
                                    <?php } else {
                                        echo '<span>'.esc_html('@ All Right Reserved ','boal').' '.date("Y").' '.esc_html('boal . Made by ','boal').'<i class="fa fa-heart" aria-hidden="true"></i><a href="'.esc_url('http://nanoagency.co').'">'.esc_html(' NanoAgency','boal').'</a></span>';
                                    } ?>
                                </div><!-- .site-info -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer><!-- .site-footer -->

<?php } ?>