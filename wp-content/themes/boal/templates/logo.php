<?php
    if(!get_theme_mod('boal_logo')) {?>
        <div class="site-title">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
            <?php
            if ( display_header_text() ) {
                $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ) : ?>
                    <p class="site-description"><?php echo esc_attr($description); ?></p>
                <?php endif;
            }
            ?>
        </div>
    <?php }
    else { ?>
        <div class="site-logo" id="logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <?php
                $boal_logo = get_post_meta(get_the_ID(), 'boal_logo', true);
                if($boal_logo && !empty($boal_logo)){?>
                    <img src="<?php echo esc_url(wp_get_attachment_url($boal_logo)); ?>" alt="<?php echo esc_attr('logo'); ?>" />
                <?php }
                else {?>
                    <img src="<?php echo esc_url(get_theme_mod('boal_logo')); ?>" alt="<?php bloginfo( 'name' ); ?>" />
                <?php }
                ?>


            </a>
        </div>
        <?php if(get_theme_mod('boal_logo_retina')) { ?>
            <div class="site-logo" id="logo-retina"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url(get_theme_mod('boal_logo_retina')); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a></div>
        <?php } ?>
        <?php
        if ( display_header_text() ) {
            $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) : ?>
                <p class="site-description"><?php echo esc_attr($description); ?></p>
            <?php endif;
        }
        ?>
    <?php }
?>
