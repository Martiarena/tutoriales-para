<?php
/**
 * The default template for displaying content
 *
 * @author      NanoAgency
 * @link        http://nanoagency.co
 * @copyright   Copyright (c) 2015 NanoAgency
 * @license     GPL v2
 */
$add_rtl="false";
if(is_rtl()){
    $add_rtl="true";
}
$format = get_post_format();
$add_class=$class='';
    $args = array(
        'category_name'  => $atts['category_name'],
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => $atts['number_post'],
        'tax_query' => array(
            array(
                'taxonomy' => 'post_format',
                'field' => 'slug',
                'terms' => array( 'post-format-video' )
            )
        )
    );
$auto='0';
if($atts['auto_play']=='yes'){
    $auto='1';
}

$the_query = new WP_Query($args);
//$count = $the_query->found_posts;
$count  = $the_query->post_count;
$cats   =  explode(",", $atts['category_name']);
?>

<div class="box-videos clearfix">
    <?php if ($atts['title']) { ?>
        <div class="box-title clearfix">
            <h2 class="title-left "><?php echo esc_html($atts['title']); ?></h2>
            <div class="title-right">
                <a  href="<?php echo esc_url( home_url( '/type/video/' ) ); ?>"><?php esc_html_e('View all','boal')?><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            </div>
        </div>
    <?php } ?>

    <?php switch ($atts['layout_types']) {
        case 'large':?>
            <div class="box-video video-vertical rows clearfix">
                    <div class="col-md-8 col-sm-8 slider-video equal-content">
                        <?php $k=1;
                        while ( $the_query->have_posts() ) {
                            $the_query->the_post();
                            if(has_post_format('video')) {?>
                                <?php $sp_video = get_post_meta( get_the_ID(), '_format_video_embed', true );
                                $placeholder_image = get_template_directory_uri(). '/assets/images/layzyload-video-image.jpg';
                                $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "boal-video-image" );
                                ?>
                                <div class="post-item video-<?php echo esc_attr(get_the_ID());?> <?php echo $k ;?> <?php if ($k == 1) echo esc_attr('active');?>">
                                    <div class="article-video">

                                    </div>
                                    <div class="article-image">
                                        <?php if(wp_oembed_get( $sp_video )) {?>
                                            <img  class="lazy" src="<?php echo esc_url($placeholder_image);?>" data-src="<?php echo esc_attr($thumbnail_src[0]);?>" alt="post-image"/>
                                            <span class="bgr-item"></span>
                                            <span class="btn-play" data-id="<?php echo esc_attr(get_the_ID());?>">
                                            <i class="fa fa-play-circle" aria-hidden="true"></i>
                                            <i class="fa fa-spinner fa-pulse fa-3x fa-fw" aria-hidden="true"></i>
                                        </span>
                                        <?php } ?>
                                    </div>

                                </div>
                            <?php  }  $k++; ?>
                        <?php }
                        wp_reset_postdata();?>
                    </div>
                    <div class="col-md-4 col-sm-4  slider-nav nano equal-sidebar">
                        <div class="nano-content clearfix">
                        <?php
                            $n=1;
                            while ( $the_query->have_posts() ) {
                                $the_query->the_post();
                                $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "boal-video" );
                                $placeholder_image = get_template_directory_uri(). '/assets/images/layzyload-video.jpg';
                                ?>
                                <?php if(has_post_format('video')) :?>
                                    <div class="post-sidebar post-item clearfix">
                                        <div class="post-image single-image btn-play <?php if ($n == 1) echo esc_attr('active');?>" data-name="video<?php echo esc_attr($n);?> " data-id="<?php echo esc_attr(get_the_ID());?>">
                                            <div class="post-image-arg">
                                                <img  class="lazy wp-post-image" src="<?php echo esc_url($placeholder_image);?>" data-src="<?php echo esc_attr($thumbnail_src[0]);?>" alt="post-image"/>
                                                <i class="fa fa-play" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <div class="article-content clearfix">
                                            <header class="entry-header-title">
                                                <?php
                                                the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
                                                ?>
                                            </header>
                                            <div class="article-meta clearfix">
                                                <?php boal_entry_meta(); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php  endif;  $n++;
                        }
                        wp_reset_postdata();?>
                        </div>
                    </div>

            </div>
            <?php break;
        case 'list':?>
            <div class="box-video video-horizontal clearfix">
                <div class="col-md-12 slider-video">
                    <?php $k=1;
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post(); ?>
                        <?php if(has_post_format('video')) {?>
                            <?php $sp_video = get_post_meta( get_the_ID(), '_format_video_embed', true );
                            $placeholder_image = get_template_directory_uri(). '/assets/images/layzyload-video-image.jpg';
                            $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "boal-video-image" );
                            ?>
                            <div class="post-item video-<?php echo esc_attr(get_the_ID());?> <?php echo $k ;?> <?php if ($k == 1) echo esc_attr('active');?>">
                                <div class="article-video">
                                </div>
                                <div class="article-image">
                                    <?php if(wp_oembed_get( $sp_video )) {?>
                                        <img  class="lazy" src="<?php echo esc_url($placeholder_image);?>" data-src="<?php echo esc_attr($thumbnail_src[0]);?>" alt="post-image"/>
                                        <span class="bgr-item"></span>
                                        <span class="btn-play" data-id="<?php echo esc_attr(get_the_ID());?>">
                                            <i class="fa fa-play-circle" aria-hidden="true"></i>
                                            <i class="fa fa-spinner fa-pulse fa-3x fa-fw" aria-hidden="true"></i>
                                        </span>
                                    <?php } ?>
                                </div>
                                <div class="article-content <?php echo esc_attr($add_class);?>">
                                    <div class="entry-header clearfix">
                                        <header class="entry-header-title">
                                            <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
                                        </header>
                                    </div>
                                    <div class="article-meta clearfix">
                                        <?php boal_entry_meta(); ?>
                                    </div>
                                    <a class="btn-read hidden" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read More','boal');?></a>
                                </div>
                            </div>
                        <?php  }  $k++; ?>
                    <?php }
                    wp_reset_postdata();?>
                </div>
                <div class="col-md-12 slider-nav">
                    <?php
                        $n=1;
                        while ( $the_query->have_posts() ) {
                            $the_query->the_post();
                            $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "boal-video" );
                            $placeholder_image = get_template_directory_uri(). '/assets/images/layzyload-video.jpg';
                            ?>
                            <?php if(has_post_format('video')) :?>
                                <div class="post-grid-mini post-item clearfix">
                                    <div class="post-image single-image btn-play <?php if ($n == 1) echo esc_attr('active');?>" data-name="video<?php echo esc_attr($n);?> " data-id="<?php echo esc_attr(get_the_ID());?>">
                                        <div class="post-image-arg">
                                            <img  class="lazy wp-post-image" src="<?php echo esc_url($placeholder_image);?>" data-src="<?php echo esc_attr($thumbnail_src[0]);?>" alt="post-image"/>
                                            <i class="fa fa-play" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="article-content clearfix">
                                        <header class="entry-header-title">
                                            <?php
                                            the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
                                            ?>
                                        </header>
                                        <div class="article-meta clearfix">
                                            <?php boal_entry_meta(); ?>
                                        </div>
                                    </div>
                                </div>
                        <?php  endif;  $n++;
                    }
                    wp_reset_postdata();?>
                </div>
            </div>
            <?php break;
        case 'cat':?>
            <div class="box-video video-cat clearfix">
                <?php
                $i=1;
                foreach($cats as $cat){
                    $the_query = new WP_Query( array(
                        'category_name'=>$cat,
                        'post_type' => 'post',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'post_format',
                                'field' => 'slug',
                                'terms' => array( 'post-format-video' )
                            )
                        )
                    ) );
                    $count = $the_query->found_posts;
                    $catObj = get_category_by_slug($cat);
                    $catName = $catObj->name;
                    $catLink = get_category_link($catObj->term_id);
                    ?>
                    <?php if($i==1): ?>
                        <div class="col-md-8 col-sm-8 col-xs-6 no-padding">
                            <div class="article-image">
                                <?php if($atts['thumbnail_video1']){
                                    $thumbnail_src= wp_get_attachment_image_src( $atts['thumbnail_video1'], "full" );
                                    $thumbnail= $thumbnail_src[0];
                                }else{
                                    $thumbnail = get_template_directory_uri() . '/assets/images/layzyload-grid.jpg';
                                }
                                $background_image = "background-image:url('$thumbnail')";
                                ?>
                                <div class="post-image-videos" style="<?php echo esc_attr($background_image);?>">
                                    <a  class="bgr-item" href="<?php echo esc_url($catLink)?>"></a>
                                </div>
                                <i class="fa fa-play" aria-hidden="true"></i>
                            </div>
                            <div class="article-content">
                                <h3 class="entry-title">
                                    <a href="<?php echo esc_url($catLink)?>"><?php echo esc_attr($catName);?> (<?php echo esc_attr($count)?><?php echo esc_attr(' videos','boal')?>)</a>
                                </h3>
                            </div>
                        </div>
                    <?php elseif($i==2) :?>
                        <div class="col-md-4 col-sm-4 col-xs-6 small-padding">
                            <div class="article-image small">
                                <?php if($atts['thumbnail_video2']){
                                    $thumbnail_src= wp_get_attachment_image_src( $atts['thumbnail_video2'], "full" );
                                    $thumbnail= $thumbnail_src[0];
                                }else{
                                    $thumbnail = get_template_directory_uri() . '/assets/images/layzyload-grid.jpg';
                                }
                                $background_image = "background-image:url('$thumbnail')";
                                ?>
                                <div class="post-image-video" style="<?php echo esc_attr($background_image);?>"><a  class="bgr-item" href="<?php echo esc_url($catLink)?>"></a></div>
                                <i class="fa fa-play" aria-hidden="true"></i>
                                <div class="article-content">
                                    <h3 class="entry-title">
                                        <a href="<?php echo esc_url($catLink)?>"><?php echo esc_attr($catName);?> (<?php echo esc_attr($count)?><?php echo esc_attr(' videos','boal')?>)</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    <?php else:?>
                        <div class="col-md-4 col-sm-4 col-xs-6 small-padding">
                            <div class="article-image small">
                                <?php if($atts['thumbnail_video3']){
                                    $thumbnail_src= wp_get_attachment_image_src( $atts['thumbnail_video3'], "full" );
                                    $thumbnail= $thumbnail_src[0];
                                }else{
                                    $thumbnail = get_template_directory_uri() . '/assets/images/layzyload-grid.jpg';
                                }
                                $background_image = "background-image:url('$thumbnail')";
                                ?>
                                <div class="post-image-video" style="<?php echo esc_attr($background_image);?>"><a  class="bgr-item" href="<?php echo esc_url($catLink)?>"></a></div>
                                <i class="fa fa-play" aria-hidden="true"></i>
                                <div class="article-content">
                                    <h3 class="entry-title">
                                        <a href="<?php echo esc_url($catLink)?>"><?php echo esc_attr($catName);?> (<?php echo esc_attr($count)?><?php echo esc_attr(' videos','boal')?>)</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                    <?php $i++;?>
                <?php } ?>
            </div>
            <?php break;
        case 'carousel':?>
            <div class="box-video video-carousel clearfix">
                <div class="article-carousel" data-rtl="<?php echo esc_attr($add_rtl);?>" data-number="<?php echo esc_attr($atts['show_post']);?>"  data-dots="true" data-table="2" data-mobile = "1" data-mobilemin = "1" data-arrows="false">
                    <?php
                    $n=1;
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post(); ?>

                            <?php if(has_post_format('video')) :?>
                                <div class="post-grid post-item clearfix">
                                    <div class="post-image single-image <?php if ($n == 1) echo esc_attr('active');?>" data-name="video<?php echo esc_attr($n);?>">
                                        <div class="post-image-arg">
                                            <a href="<?php echo esc_url( get_permalink() );?>">
                                                <?php the_post_thumbnail('boal-blog-grid'); ?>
                                            </a>

                                            <i class="fa fa-play" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="article-content clearfix">
                                        <header class="entry-header-title">
                                            <?php
                                            the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
                                            ?>
                                        </header>
                                        <div class="article-meta clearfix">
                                            <?php boal_entry_meta(); ?>
                                        </div>
                                    </div>

                                </div>
                            <?php  endif;  $n++;?>
                    <?php }
                    wp_reset_postdata();?>

                </div>
            </div>
            <?php break;
        default:?>
            <div class="box-video two-large-horizontal clearfix">
                <div class="col-md-9 slider-video">
                    <?php $k=1;
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post(); ?>
                        <?php if(has_post_format('video')) :?>
                            <div class="post-item ">
                                <div class="embed-responsive  embed-responsive-16by9 video-responsive post-video single-video embed-responsive embed-responsive-16by9">
                                    <?php $sp_video = get_post_meta( get_the_ID(), '_format_video_embed', true ); ?>
                                    <?php if(wp_oembed_get( $sp_video )) {
                                        $idVideo='video'.rand(0,99);
                                        if ($k == 1) {
                                            echo boal_oembed_get($sp_video, 1,'video1');
                                        } else {
                                            echo boal_oembed_get($sp_video, 0,$idVideo);
                                        }
                                    } ?>
                                </div>
                                <div class="article-content <?php echo esc_attr($add_class);?>">
                                    <div class="entry-header clearfix">
                                        <header class="entry-header-title">
                                            <?php
                                            the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
                                            ?>
                                        </header>
                                    </div>
                                    <div class="article-meta clearfix">
                                        <?php boal_entry_meta(); ?>
                                    </div>
                                    <div class="entry-content">
                                        <?php
                                        if ( has_excerpt()){
                                            boal_excerpt();
                                        }
                                        else{
                                            echo boal_content(35);
                                        }

                                        wp_link_pages( array(
                                            'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'boal' ) . '</span>',
                                            'after'       => '</div>',
                                            'link_before' => '<span class="page-numbers">',
                                            'link_after'  => '</span>',
                                            'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'boal' ) . ' </span>%',
                                            'separator'   => '<span class="screen-reader-text">, </span>',
                                        ) );
                                        ?>

                                    </div>
                                </div>
                            </div>
                        <?php  endif; $k++; ?>
                    <?php }
                    wp_reset_postdata();?>
                </div>
                <div class="col-md-3 slider-nav">
                    <?php while ( $the_query->have_posts() ) {
                        $the_query->the_post(); ?>
                        <?php if(has_post_format('video')) :?>
                            <div class="post-image single-image ">
                                <?php the_post_thumbnail('boal-video'); ?>
                            </div>
                        <?php  endif;
                    }
                    wp_reset_postdata();?>
                </div>

            </div>
            <?php break;
    } ?>
</div>


