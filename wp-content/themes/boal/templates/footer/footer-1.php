<?php if(get_theme_mod('boal_enable_footer', '1')) { ?>
    <footer id="na-footer" class="na-footer  footer-1">

        <!--    Footer center-->
        <?php  if(is_active_sidebar( 'footer-1a' ) || is_active_sidebar( 'footer-1b' ) || is_active_sidebar( 'footer-1c' )){ ?>
            <!--    Footer center-->
            <div class="footer-center clearfix">
                <div class="container">
                    <div class="container-inner">
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <?php dynamic_sidebar('footer-1a'); ?>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <?php dynamic_sidebar('footer-1b'); ?>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <?php dynamic_sidebar('footer-1c'); ?>
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
