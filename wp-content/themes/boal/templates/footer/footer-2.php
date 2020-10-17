<?php if(get_theme_mod('boal_enable_footer', '1')) { ?>
    <footer id="na-footer" class="na-footer  footer-2">
        <!--    Footer top-->
        <?php if(is_active_sidebar( 'footer-top' )): ?>
            <div class="footer-top clearfix">
                <div class="container">
                    <div class="row">
                        <div class="footer-top-inner">
                            <?php dynamic_sidebar('footer-top'); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php  if(is_active_sidebar( 'footer-2a' ) || is_active_sidebar( 'footer-2b' ) || is_active_sidebar( 'footer-2c' ) || is_active_sidebar( 'footer-2d' )){ ?>
            <!--    Footer center-->
            <div class="footer-center clearfix">
                <div class="container">
                    <div class="container-inner">
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <?php dynamic_sidebar('footer-2a'); ?>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <?php dynamic_sidebar('footer-2b'); ?>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <?php dynamic_sidebar('footer-2c'); ?>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <?php dynamic_sidebar('footer-2d'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
        <!--    Footer bottom-->
        <div class="footer-bottom clearfix">
            <div class="container">
                <div class="container-inner">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="coppy-right">
                                <?php if(get_theme_mod('boal_copyright_text')) {?>
                                    <span><?php echo  wp_kses_post(get_theme_mod('boal_copyright_text'));?></span>
                                <?php } else {
                                    echo '<span>'.esc_html('Copyrights &copy;','boal').' '.date("Y").'<a href="'.esc_url('http://boal.nanoagency.co').'">'.esc_html('  Boal Theme. ','boal').'</a>'.esc_html(' All Rights Reserved.','boal').'</span>';
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 footer-bottom-left">
                            <?php dynamic_sidebar('copy-right'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer><!-- .site-footer -->

<?php } ?>
