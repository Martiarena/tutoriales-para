<?php
/**
 * The template for displaying pages
 *
 * @author      NanoAgency
 * @link        http://nanoagency.co
 * @copyright   Copyright (c) 2015 NanoAgency
 * @license     GPL v2
 */

get_header();

$boal_title     = get_post_meta(get_the_ID(), 'boal_disable_title',true);

$style_css                  ="";
$bg_header                  = get_theme_mod('boal_cat_image');
$bg_header_color            = get_theme_mod('boal_cat_bg');
if($bg_header){
    $cat_header           ="background-image:url('$bg_header')";
    $style_css            ='style = '.$cat_header.'';
}
if($bg_header_color){
    $cat_header           ="background:$bg_header_color";
    $style_css            ='style = '.$cat_header.'';
}
?>

<div class="wrap-content" role="main">
    <?php if($boal_title != '1'){?>
        <div class="cat-header clearfix" <?php echo esc_attr($style_css);?>>
            <div class="container">
                <?php the_title( '<h1 class="title-page">', '</h1>' );?>
            </div>
        </div>
    <?php }?>
    <div class="container wrap-content-inner">
        <div class="row">
            <div class="site-main page-content col-sm-12 " role="main">
                    <?php
                    while ( have_posts() ) : the_post();?>
                        <?php get_template_part( 'content', 'page' );
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                    endwhile;
                    ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>