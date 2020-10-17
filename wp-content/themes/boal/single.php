<?php
/**
 * Single Product
 *
 * @author      NanoAgency
 * @link        http://nanoagency.co
 * @copyright   Copyright (c) 2015 NanoAgency
 * @license     GPL v2
 */


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

get_header();
?>
<div class="wrap-content" role="main">
    <?php
        while ( have_posts() ) : the_post();?>
        <div class="single-header clearfix" <?php echo esc_attr($style_css);?>>
            <div class="container">
                <header class="entry-header-title">
                    <span class="post-cat"><?php echo boal_category(' '); ?></span>
                    <?php  the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header>
                <!-- .entry-header -->
                <?php boal_excerpt(); ?>
                <div class="article-meta clearfix">
                    <?php boal_entry_meta(); ?>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
    <div class="container wrap-content-inner">
        <div class="row">
            <?php do_action('single-sidebar-left'); ?>

            <?php do_action('single-content-before'); ?>
                <div class="content-inner">
                    <?php
                    // Start the loop.
                    while ( have_posts() ) : the_post();?>
                        <div class="box box-article">
                            <article id="post-<?php the_ID(); ?>" <?php  post_class();?>>
                                <?php if(has_post_format('gallery')) : ?>
                                <?php $images = get_post_meta( $post->ID, '_format_gallery_images', true ); ?>
                                <?php if($images) : ?>
                                    <div class="post-image single-image">
                                        <ul class="owl-single">
                                            <?php foreach($images as $image) : ?>
                                                <?php $the_image = wp_get_attachment_image_src( $image, 'boal-single' ); ?>
                                                <?php $the_caption = get_post_field('post_excerpt', $image); ?>
                                                <li><img src="<?php echo esc_url($the_image[0]); ?>" <?php if($the_caption) : ?>title="<?php echo esc_attr($the_caption); ?>"<?php endif; ?> /></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <?php elseif(has_post_format('video')) : ?>
                                    <div class="embed-responsive embed-responsive-16by9 post-video single-video embed-responsive embed-responsive-16by9">
                                        <?php $sp_video = get_post_meta( get_the_ID(), '_format_video_embed', true ); ?>
                                        <?php if(wp_oembed_get( $sp_video )) : ?>
                                            <?php echo wp_oembed_get($sp_video); ?>
                                        <?php else : ?>
                                            <?php echo esc_url($sp_video); ?>
                                        <?php endif; ?>
                                    </div>

                                <?php elseif(has_post_format('audio')) : ?>

                                    <div class="post-image audio single-audio">
                                        <?php $sp_audio = get_post_meta( $post->ID, '_format_audio_embed', true ); ?>
                                        <?php if(wp_oembed_get( $sp_audio )) : ?>
                                            <?php echo str_replace($search, $replace, wp_oembed_get($sp_audio)); ?>
                                        <?php else : ?>
                                            <?php echo str_replace('','', $sp_audio); ?>
                                        <?php endif; ?>
                                    </div>

                                <?php else : ?>

                                    <?php if(has_post_thumbnail()) : ?>
                                        <?php if(!get_theme_mod('sp_post_thumb')) : ?>
                                            <div class="post-image single-image ">
                                                <?php the_post_thumbnail('boal-single'); ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                <?php endif; ?>



                                <div class="entry-content">
                                    <?php //ads
                                    if(get_theme_mod('boal_ads_single_article')) {?>
                                        <div class="ads_content_single ads-before-content">
                                            <?php echo wp_kses_post(get_theme_mod('boal_ads_rectangle'));?>
                                        </div>
                                    <?php }

                                    the_content();

                                    //ads
                                    if(get_theme_mod('boal_ads_single_article')) {?>
                                        <div class="advertising_content_single">
                                            <?php echo wp_kses_post(get_theme_mod('boal_ads_leaderboard'));?>
                                        </div>
                                    <?php }
                                    wp_link_pages( array(
                                        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'boal' ) . '</span>',
                                        'after'       => '</div>',
                                        'link_before' => '<span class="page-numbers">',
                                        'link_after'  => '</span>',
                                        'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'boal' ) . ' </span>%',
                                        'separator'   => '<span class="screen-reader-text">, </span>',
                                    ) );

                                    ?>
                                </div>
                                <!--    Author bio.-->
                                <div class="entry-footer clearfix">
                                    <?php
                                    get_template_part('templates/share');
                                    ?>
                                </div>
                            </article>
                        </div>
                        <div class="box box-author">
                            <?php
                            if ( '' !== get_the_author_meta( 'description' ) ) {
                                get_template_part('templates/about_author');
                            }
                            ?>
                        </div>
                        <?php get_template_part('templates/post_pagination'); ?>

                        <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;

                        //ads
                        if(get_theme_mod('boal_ads_single_comment')) {?>
                            <div class="advertising_content_single">
                                <?php echo wp_kses_post(get_theme_mod('boal_ads_leaderboard'));?>
                            </div>
                        <?php }
                        ?>

                        <?php get_template_part('templates/related_posts');

                        // End the loop.
                    endwhile;
                    ?>
                    <?php if ( is_active_sidebar( 'single-post' ) ) :?>
                        <div class="more-single">
                            <?php dynamic_sidebar( 'single-post' );?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php do_action('single-content-after'); ?>

            <?php do_action('single-sidebar-right'); ?>

        </div><!-- .content-area -->
    </div>
</div>
<?php get_footer(); ?>
