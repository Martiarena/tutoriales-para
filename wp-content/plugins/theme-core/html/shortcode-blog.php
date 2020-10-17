<?php
/**
 * The default template for displaying content
 *
 * @author      Nanoliberty
 * @link        http://nanoliberty.co
 * @copyright   Copyright (c) 2015 Nanoliberty
 * @license     GPL v2
 */

$format = get_post_format();
$view_more = 'description-hidden';

if ($atts['view_more'] && $atts['view_more']=='yes'){
    $view_more = 'description-show';
}

//$args['paged'] = (nano_get_query_var('paged')) ? nano_get_query_var('paged') : 1;

$args = array(
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'orderby'             => 'date',
    'order'               => 'DESC',
    'ignore_sticky_posts' => true,
    'category_name'       => $atts['category_name'],
    'posts_per_page'      =>($atts['number'] > 0) ? $atts['number'] : get_option('posts_per_page')
);
$args['paged'] = (nano_get_query_var('paged')) ? nano_get_query_var('paged') : 1;
$the_query = new WP_Query($args);
$num_pages = $the_query->max_num_pages;
//class for option columns
$class = '';
switch ($atts['columns']) {
    case '1':
        $class .= "col-xs-12 col-1";
        break;
    case '2':
        $class .= "col-xs-6 col-sm-6 col-md-6";
        break;
    case '3':
        $class .= "col-xs-6 col-sm-6 col-md-4";
        break;
}
$class_pagination='pagination';
if($atts['pagination']=='loadMore'){
    $class_pagination='loadMore';
}
if($atts['pagination']=='lazyLoading'){
    $class_pagination='infiniteScroll';
}
if(isset($atts['category_name']) & !empty($atts['category_name'])){
    $categories = explode( ',', $atts['category_name'] );
} else{
    $categories=get_the_category();
}
$i=1;
?>

<div class="<?php echo 'wrapper-posts box-recent type-'.esc_attr($class_pagination).' layout-' . esc_attr($atts['post_layout']); ?>" data-layout="<?php echo esc_attr($atts['post_layout']);?>" data-paged="<?php echo esc_attr($num_pages);?>" data-col="<?php echo esc_attr($class);?>" data-cat="<?php echo esc_attr($atts['category_name'])?>" data-number="<?php echo esc_attr($atts['number'])?>" data-ads="<?php echo esc_attr($atts['ads_layout']);?>">
    <?php if ($atts['title']) { ?>
        <div class="box-title clearfix">
            <h2 class="title-left"><?php echo esc_html($atts['title']); ?></h2>
            <?php if($atts['filter'] && $atts['type_filter']=='cat_filter' ){?>

                <div class="box-filter clearfix">
                    <ul class="wrapper-filter" data-filter="true">
                        <?php
                        $n=1;
                        echo '<li class="active"><span class="cat-items" data-catfilter="allCat">'.esc_attr('All','nano').'</span></li>';
                        foreach ($categories as $category){
                            $cat = get_term_by( 'slug',$category, 'category');
                            if($n<6){
                                echo '<li><span class="cat-item"  data-catfilter="'.$category.'" >'.$cat->name.'</span></li>';
                            }
                            $n++;
                        }
                        ?>
                    </ul>
                    <?php if($n>5){ ?>
                        <div class="wrapper-more">
                            <span class="filter-more"><?php esc_html_e('...','nano'); ?></span>
                            <ul class="wrapper-filter more" data-filter="true">
                                <?php
                                $m=1;
                                foreach ($categories as $category){
                                    $cat = get_term_by( 'slug',$category, 'category');
                                    if($m>5){
                                        echo '<li><span class="cat-item"  data-catfilter="'.$category.'" >'.$cat->name.'</span></li>';
                                    }
                                    $m++;
                                }
                                ?>
                            </ul>
                        </div>
                    <?php }?>
                </div>
            <?php }?>
        </div>
    <?php } ?>
    <span class="agr-loading"></span>
    <div class="tab-content">
        <div id="allCats" class="archive-blog affect-isotope row active <?php echo esc_attr($view_more);?>">
            <?php if($atts['post_layout'] == 'grid'){?>
                <?php if ($the_query->have_posts()):
                    while ($the_query->have_posts()): $the_query->the_post(); ?>

                        <div class="col-item <?php echo esc_attr($class);?> ">
                            <?php na_part_templates('layout/content-grid');?>
                        </div>

                        <?php endwhile;
                    wp_reset_postdata();
                endif;

                ?>
            <?php }
            elseif($atts['post_layout'] == 'list'){?>
                <?php if ($the_query->have_posts()):
                    while ($the_query->have_posts()): $the_query->the_post(); ?>

                        <div class="col-item <?php echo esc_attr($class);?>">
                            <?php na_part_templates('layout/content-list');?>
                        </div>

                        <?php $i++; endwhile;
                    wp_reset_postdata();
                endif;

                ?>
            <?php }
            elseif($atts['post_layout'] == 'box-list2'){?>
                <?php $i=1;
                if ($the_query->have_posts()):
                    while ($the_query->have_posts()): $the_query->the_post(); ?>

                        <?php if ($i ==1) { ?>
                            <div class="col-item col-md-12 col-sm-12 col-xs-12">
                                <?php na_part_templates('layout/content-trans-large'); ?>
                            </div>
                        <?php }
                        else{?>
                            <div class="col-item <?php echo esc_attr($class);?> ">
                                <?php na_part_templates('layout/content-list');?>
                            </div>
                        <?php } ?>

                        <?php $i++; endwhile;
                    wp_reset_postdata();
                endif;

                ?>
            <?php }
            else{
                if ($the_query->have_posts()):
                    while ($the_query->have_posts()): $the_query->the_post(); ?>

                        <div class="col-item <?php echo esc_attr($class);?> ">
                            <?php na_part_templates('layout/content-list');?>
                        </div>

                    <?php endwhile;
                    wp_reset_postdata();
                endif;

            }
            ?>
        </div>
    </div>

    <?php
    //paging
    if($atts['pagination']=='loadMore'){?>
        <span id="loadMore" class="button">
            <?php echo esc_html('Load More','nano');?>
        </span>
    <?php }
    elseif($atts['pagination']=='lazyLoading'){  ?>
        <span id="nextPage" class="button">
        </span>
        <?php
    }
    else{
        nano_pagination(3, $the_query);
    }
    //end paging
    if($atts['filter'] && $atts['type_filter']=='cat_filter' ){?>
        <span id="loadMoreCat" class="button hidden">
            <?php echo esc_html('Load More','nano');?>
        </span>
    <?php }

    ?>
</div>