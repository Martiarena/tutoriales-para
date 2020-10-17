<?php
/**
 * The default template for displaying content
 *
 * @author      NanoAgency
 * @link        http://nanoagency.co
 * @copyright   Copyright (c) 2015 NanoAgency
 * @license     GPL v2
 */

$format = get_post_format();
$format = get_post_format();
$add_class='';

//number word content
$number_word = get_theme_mod('boal_number_content_post','45');

$placeholder_image = get_template_directory_uri(). '/assets/images/layzy-list.jpg';
$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "boal-slider-list" );
?>
<article  <?php post_class('post-item post-list-large clearfix'); ?>>
    <div class="article-image">
        <?php if(has_post_thumbnail()) : ?>
            <div class="post-image">
                <span class="bgr-item"></span>
                <a href="<?php echo get_permalink();?>">
                    <img  class="lazy" src="<?php echo esc_url($placeholder_image);?>"  data-src="<?php echo esc_attr($thumbnail_src[0]);?>""/>
                </a>
            </div>
        <?php else :
            $add_class='full-width';
        endif; ?>
        <?php if(has_post_format('gallery')) : ?>
            <?php $images = get_post_meta( get_the_ID(), '_format_gallery_images', true );?>
            <?php if($images) : ?>
                <div class="post-gallery">
                    <a  href="<?php echo get_post_format_link( $format ); ?>" class="post-format"><i class="ti-camera"></i></a>
                </div>
            <?php endif; ?>

        <?php elseif(has_post_format('video')) : ?>
            <div class="post-video">
                <a  href="<?php echo get_post_format_link( $format ); ?>" class="post-format"><i class="ti-control-play"></i></a>
            </div>
        <?php elseif(has_post_format('audio')) : ?>
            <div class="post-audio">
                <a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('boal-blog-list'); ?></a>
                <a  href="<?php echo get_post_format_link( $format ); ?>" class="post-format"><i class="ti-headphone"></i></a>
            </div>
        <?php elseif(has_post_format('quote')) :?>
            <div class="post-quote <?php echo esc_attr($add_class);?>">
                <?php $sp_quote = get_post_meta( get_the_ID(), '_format_quote_source_name', true ); ?>
                <a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('boal-slider-list'); ?></a>
                <a  href="<?php echo get_post_format_link( $format ); ?>" class="post-format"><i class="ti-quote-left"></i></a>
            </div>
        <?php endif; ?>
        <span class="post-cat"><?php echo boal_category(' '); ?></span>
    </div>
    <div class="article-content <?php echo esc_attr($add_class);?>">
        <div class="entry-header clearfix">
            <header class="entry-header-title">
                <?php
                the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
                ?>
            </header>
        </div>
        <div class="article-meta clearfix">
            <?php boal_entry_meta(); ?>
        </div>
        <div class="entry-content">
            <?php
            if ( has_excerpt() || is_search() ){
                boal_excerpt();
            }
            else{
                echo boal_content($number_word);
            }
            ?>
            <a class="btn-readMore" href="<?php echo get_permalink() ?>"><?php echo esc_attr('Read more','boal'); ?></a>
        </div>

    </div>
</article><!-- #post-## -->
