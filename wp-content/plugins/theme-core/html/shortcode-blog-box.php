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
$add_class=$class='';
    $args = array(
        'category_name'  => $atts['category_name'],
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => $atts['number_post'],
    );
    if( $atts['type_post'] == 'yes' ){
        $meta_query[] = array(
            'key' => '_featured',
            'value' => 'yes'
        );
        $args['meta_query'] = $meta_query;
    }
    switch ($atts['columns']) {
        case '2':
            $class .= "col-xs-6 col-sm-6 col-md-6";
            break;
        case '3':
            $class .= "col-xs-6 col-sm-6 col-md-4";
            break;
        case '4':
            $class .= "col-xs-6 col-sm-6 col-md-3";
            break;
        default:
            $class .= "col-xs-6 col-sm-6 col-md-6";
            break;
    }

$the_query = new WP_Query($args);
$count = $the_query->found_posts;
$num_pages = $the_query->max_num_pages;

if(isset($atts['category_name']) & !empty($atts['category_name'])){
    $categories = explode( ',', $atts['category_name'] );
} else{
    $categories=get_the_category();
}

if(isset($atts['show_cate']) & !empty($atts['show_cate'])){
    $show_cat = 'show-cate';
} else{
    $show_cat='hidden-cate';
}
?>

<?php
switch ($atts['layout_types']) {

    case 'box1':?>
        <?php $rand = rand(0,99);?>
        <div class="box-cats wrapper-posts layout-box1 <?php echo esc_html($show_cat);?> " data-layout="box1" data-paged="<?php echo esc_attr($num_pages);?>" data-col="<?php echo esc_attr($class);?>" data-cat="<?php echo esc_attr($atts['category_name'])?>" data-number="<?php echo esc_attr($atts['number_post'])?>">
            <?php if ($atts['title']) { ?>
                <div class="box-title clearfix">
                    <h2 class="title-left"><?php echo esc_html($atts['title']); ?></h2>
                    <?php if($atts['filter'] && $atts['type_filter']=='cat_filter' ){?>
                        <div class="box-filter clearfix">
                            <ul class="wrapper-filter" data-filter="true">
                                <?php
                                $n=1;
                                echo '<li class="active"><span class="cat-item" data-catfilter="allCat-'.$rand.'">'.esc_attr('All','nano').'</span></li>';
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
                <div id="allCat-<?php echo esc_attr($rand);?>" class="box-blog archive-blog active row large-vertical clearfix">
                    <?php  while ( $the_query->have_posts() ) {
                        $the_query->the_post(); ?>
                        <div class="<?php echo esc_html($class);?> box-large  description-hidden">
                            <?php na_part_templates('layout/content-grid'); ?>
                        </div>
                    <?php } wp_reset_postdata();?>
                </div>

            </div>
        </div>
        <?php break;

    case 'box2':?>
        <?php $rand = rand(0,99);?>
        <div class="box-cats wrapper-posts layout-box2 <?php echo esc_html__($show_cat);?>" data-layout="box2" data-paged="<?php echo esc_attr($num_pages);?>" data-col="<?php echo esc_attr($class);?>" data-cat="<?php echo esc_attr($atts['category_name'])?>" data-number="<?php echo esc_attr($atts['number_post'])?>">
            <?php if ($atts['title']) { ?>
                <div class="box-title clearfix">
                    <h2 class="title-left"><?php echo esc_html($atts['title']); ?></h2>
                    <?php if($atts['filter'] && $atts['type_filter']=='cat_filter' ){?>

                        <div class="box-filter clearfix">
                            <ul class="wrapper-filter" data-filter="true">
                                <?php
                                $n=1;
                                echo '<li class="active"><span class="cat-item" data-catfilter="allCat-'.$rand.'">'.esc_attr('All','nano').'</span></li>';
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
                <div id="allCat-<?php echo esc_attr($rand);?>" class="box-blog archive-blog active row large-vertical clearfix">
                    <?php $k=1;
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post(); ?>
                        <?php if ($k ==1) { ?>
                            <div class="col-md-7 col-sm-7 col-xs-12 box-large">
                                <?php na_part_templates('layout/slider-full'); ?>
                            </div>
                        <?php }
                        else{ ?>
                            <div class="col-md-5 col-sm-5 col-xs-12 box-small  description-hidden">
                                <?php na_part_templates('layout/content-sidebar'); ?>
                            </div>
                        <?php } ?>
                        <?php $k++;
                    }
                    wp_reset_postdata();?>
                </div>

            </div>
        </div>
        <?php break;

    case 'box3':?>
        <?php $rand = rand(0,99);?>
        <div class="box-cats wrapper-posts layout-box3 <?php echo esc_html__($show_cat);?>" data-layout="box3" data-paged="<?php echo esc_attr($num_pages);?>" data-col="<?php echo esc_attr($class);?>" data-cat="<?php echo esc_attr($atts['category_name'])?>" data-number="<?php echo esc_attr($atts['number_post'])?>">
            <?php if ($atts['title']) { ?>
                <div class="box-title clearfix">
                    <h2 class="title-left"><?php echo esc_html($atts['title']); ?></h2>
                    <?php if($atts['filter'] && $atts['type_filter']=='cat_filter' ){?>

                        <div class="box-filter clearfix">
                            <ul class="wrapper-filter" data-filter="true">
                                <?php
                                $n=1;
                                echo '<li class="active"><span class="cat-item" data-catfilter="allCat-'.$rand.'">'.esc_attr('All','nano').'</span></li>';
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
                <div id="allCat-<?php echo esc_attr($rand);?>" class="box-blog archive-blog active row large-vertical clearfix">
                    <?php $k=1;
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post(); ?>
                        <?php if ($k ==1) { ?>
                            <div class="col-md-6 col-sm-6 col-xs-12 box-large">
                                <?php na_part_templates('layout/content-grid'); ?>
                            </div>
                        <?php }
                        else{ ?>
                            <div class="col-md-6 col-sm-6 col-xs-12 box-small  description-hidden">
                                <?php na_part_templates('layout/content-sidebar'); ?>
                            </div>
                        <?php } ?>
                        <?php $k++;
                    }
                    wp_reset_postdata();?>
                </div>

            </div>
        </div>
        <?php break;

    case 'box4':?>
        <?php $rand = rand(0,99);?>
        <div class="box-cats wrapper-posts layout-box4 <?php echo esc_html__($show_cat);?>" data-layout="box4" data-paged="<?php echo esc_attr($num_pages);?>" data-col="<?php echo esc_attr($class);?>" data-cat="<?php echo esc_attr($atts['category_name'])?>" data-number="<?php echo esc_attr($atts['number_post'])?>">
            <?php if ($atts['title']) { ?>
            <div class="box-title clearfix">
               <h2 class="title-left"><?php echo esc_html($atts['title']); ?></h2>
                <?php if($atts['filter'] && $atts['type_filter']=='cat_filter' ){?>

                    <div class="box-filter clearfix">
                        <ul class="wrapper-filter" data-filter="true">
                            <?php
                            $n=1;
                            echo '<li class="active"><span class="cat-item" data-catfilter="allCat-'.$rand.'">'.esc_attr('All','nano').'</span></li>';
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
                <div id="allCat"id="allCat-<?php echo esc_attr($rand);?>" class="box-blog archive-blog active row large-vertical clearfix">
                    <?php $k=1;
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post(); ?>
                        <?php if ($k ==1) { ?>
                            <div class="col-md-12 col-xs-12 box-large">
                                <?php na_part_templates('layout/content-trans'); ?>
                            </div>
                        <?php }
                        else{ ?>
                            <div class="col-md-12 box-large">
                                <?php na_part_templates('layout/content-list'); ?>
                            </div>
                        <?php } ?>
                        <?php $k++;
                    }
                    wp_reset_postdata();?>
                </div>

            </div>
        </div>
        <?php break;

    case 'box5':?>
        <?php $rand = rand(0,99);?>
        <div class="box-cats wrapper-posts layout-box5 <?php echo esc_html__($show_cat);?>" data-layout="box5" data-paged="<?php echo esc_attr($num_pages);?>" data-col="<?php echo esc_attr($class);?>" data-cat="<?php echo esc_attr($atts['category_name'])?>" data-number="<?php echo esc_attr($atts['number_post'])?>">
            <?php if ($atts['title']) { ?>
                <div class="box-title clearfix">
                    <h2 class="title-left"><?php echo esc_html($atts['title']); ?></h2>
                    <?php if($atts['filter'] && $atts['type_filter']=='cat_filter' ){?>

                        <div class="box-filter clearfix">
                            <ul class="wrapper-filter" data-filter="true">
                                <?php
                                $n=1;
                                echo '<li class="active"><span class="cat-item" data-catfilter="allCat-'.$rand.'">'.esc_attr('All','nano').'</span></li>';
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
                <div id="allCat-<?php echo esc_attr($rand);?>" class="box-blog archive-blog active row large-vertical clearfix">
                    <?php $k=1;
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post(); ?>
                        <?php if ($k ==1) { ?>
                            <div class="col-md-12 col-sm-12 col-xs-12 box-large">
                                <?php na_part_templates('layout/content-trans'); ?>
                            </div>
                        <?php }
                        else{ ?>
                            <div class="col-md-6 col-sm-6 col-xs-12 box-small  description-hidden">
                                <?php na_part_templates('layout/content-sidebar'); ?>
                            </div>
                        <?php } ?>
                        <?php $k++;
                    }
                    wp_reset_postdata();?>
                </div>

            </div>
        </div>
        <?php break;

    case 'box5a':?>
        <?php $rand = rand(0,99);?>
        <div class="box-cats wrapper-posts layout-box5a <?php echo esc_html__($show_cat);?>" data-layout="box5a" data-paged="<?php echo esc_attr($num_pages);?>" data-col="<?php echo esc_attr($class);?>" data-cat="<?php echo esc_attr($atts['category_name'])?>" data-number="<?php echo esc_attr($atts['number_post'])?>">
            <?php if ($atts['title']) { ?>
                <div class="box-title clearfix">
                    <h2 class="title-left"><?php echo esc_html($atts['title']); ?></h2>
                    <?php if($atts['filter'] && $atts['type_filter']=='cat_filter' ){?>

                        <div class="box-filter clearfix">
                            <ul class="wrapper-filter" data-filter="true">
                                <?php
                                $n=1;
                                echo '<li class="active"><span class="cat-item" data-catfilter="allCat-'.$rand.'">'.esc_attr('All','nano').'</span></li>';
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
                <div id="allCat-<?php echo esc_attr($rand);?>" class="box-blog archive-blog active row large-vertical clearfix">
                    <?php $k=1;
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post(); ?>
                        <?php if ($k ==1) { ?>
                            <div class="col-md-12 col-sm-12 col-xs-12 box-large">
                                <?php na_part_templates('layout/content-trans-large'); ?>
                            </div>
                        <?php }
                        else{ ?>
                            <div class="col-md-4 col-sm-4 col-xs-6 box-small meta-hidden description-hidden">
                                <?php na_part_templates('layout/content-grid'); ?>
                            </div>
                        <?php } ?>
                        <?php $k++;
                    }
                    wp_reset_postdata();?>
                </div>

            </div>
        </div>
        <?php break;

    case 'box6':?>
        <?php $rand = rand(0,99);?>
        <div class="box-cats wrapper-posts layout-box6 <?php echo esc_html__($show_cat);?>" data-layout="box6" data-paged="<?php echo esc_attr($num_pages);?>" data-col="<?php echo esc_attr($class);?>" data-cat="<?php echo esc_attr($atts['category_name'])?>" data-number="<?php echo esc_attr($atts['number_post'])?>">
            <?php if ($atts['title']) { ?>
                <div class="box-title clearfix">
                    <h2 class="title-left"><?php echo esc_html($atts['title']); ?></h2>
                    <?php if($atts['filter'] && $atts['type_filter']=='cat_filter' ){?>

                        <div class="box-filter clearfix">
                            <ul class="wrapper-filter" data-filter="true">
                                <?php
                                $n=1;
                                echo '<li class="active"><span class="cat-item" data-catfilter="allCat-'.$rand.'">'.esc_attr('All','nano').'</span></li>';
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
                <div id="allCat" class="box-blog archive-blog active row large-vertical clearfix">
                    <?php $k=1;
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post(); ?>
                        <?php if ($k ==1) { ?>
                            <div class="col-md-12 col-sm-12 col-xs-12 box-large">
                                <?php na_part_templates('layout/content-list'); ?>
                            </div>
                        <?php }
                        else{ ?>
                            <div class="col-md-4 col-sm-4 col-xs-12 box-small  description-hidden">
                                <?php na_part_templates('layout/content-grid'); ?>
                            </div>
                        <?php } ?>
                        <?php $k++;
                    }
                    wp_reset_postdata();?>
                </div>

            </div>
        </div>
        <?php break;
    case 'box7':?>
        <?php $rand = rand(0,99);?>
        <div class="box-cats wrapper-posts layout-box7 <?php echo esc_html__($show_cat);?>" data-layout="box7" data-paged="<?php echo esc_attr($num_pages);?>" data-col="<?php echo esc_attr($class);?>" data-cat="<?php echo esc_attr($atts['category_name'])?>" data-number="<?php echo esc_attr($atts['number_post'])?>">
            <?php if ($atts['title']) { ?>
                <div class="box-title clearfix">
                    <h2 class="title-left"><?php echo esc_html($atts['title']); ?></h2>
                    <?php if($atts['filter'] && $atts['type_filter']=='cat_filter' ){?>

                        <div class="box-filter clearfix">
                            <ul class="wrapper-filter" data-filter="true">
                                <?php
                                $n=1;
                                echo '<li class="active"><span class="cat-item" data-catfilter="allCat-'.$rand.'">'.esc_attr('All','nano').'</span></li>';
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
                <div id="allCat-<?php echo esc_attr($rand);?>" class="box-blog archive-blog active row large-vertical clearfix">
                    <?php $k=1;
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post(); ?>
                        <?php if ($k ==1) { ?>
                            <div class="col-md-12 col-sm-12 col-xs-12 box-large">
                                <?php na_part_templates('layout/content-list'); ?>
                            </div>
                        <?php }
                        else{ ?>
                            <div class="col-md-6 col-sm-6 col-xs-12 box-small  description-hidden">
                                <?php na_part_templates('layout/content-sidebar'); ?>
                            </div>
                        <?php } ?>
                        <?php $k++;
                    }
                    wp_reset_postdata();?>
                </div>

            </div>
        </div>
        <?php break;

    case 'box8':?>
        <?php $rand = rand(0,99);?>
        <div class="box-cats wrapper-posts layout-box8 <?php echo esc_html__($show_cat);?>" data-layout="box8" data-paged="<?php echo esc_attr($num_pages);?>" data-col="<?php echo esc_attr($class);?>" data-cat="<?php echo esc_attr($atts['category_name'])?>" data-number="<?php echo esc_attr($atts['number_post'])?>">
            <?php if ($atts['title']) { ?>
                <div class="box-title clearfix">
                    <h2 class="title-left"><?php echo esc_html($atts['title']); ?></h2>
                    <?php if($atts['filter'] && $atts['type_filter']=='cat_filter' ){?>

                        <div class="box-filter clearfix">
                            <ul class="wrapper-filter" data-filter="true">
                                <?php
                                $n=1;
                                echo '<li class="active"><span class="cat-item" data-catfilter="allCat-'.$rand.'">'.esc_attr('All','nano').'</span></li>';
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
                <div id="allCat-<?php echo esc_attr($rand);?>" class="box-blog archive-blog active row large-vertical clearfix">
                    <?php $k=1;
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post(); ?>

                        <?php if ($k ==1 || $k==2) { ?>
                            <div class="col-md-6 col-sm-6 col-xs-6 box-large">
                                <?php na_part_templates('layout/content-grid'); ?>
                            </div>
                        <?php }
                        else{ ?>
                            <?php if ($k%2 !=0) {
                                $clear='clear';
                            }else{
                                $clear='';
                            } ?>
                            <div class="col-md-6 col-sm-6 col-xs-12 box-small <?php echo esc_html($clear);?> description-hidden">
                                <?php na_part_templates('layout/content-sidebar'); ?>
                            </div>
                        <?php } ?>
                        <?php $k++;
                    }
                    wp_reset_postdata();?>
                </div>

            </div>
        </div>
        <?php break;

    default:?>
        <?php $rand = rand(0,99);?>
        <div class="box-cats wrapper-posts layout-box2 <?php echo esc_html__($show_cat);?>" data-layout="box2" data-paged="<?php echo esc_attr($num_pages);?>" data-col="<?php echo esc_attr($class);?>" data-cat="<?php echo esc_attr($atts['category_name'])?>" data-number="<?php echo esc_attr($atts['number_post'])?>">
            <?php if ($atts['title']) { ?>
                <div class="box-title clearfix">
                    <h2 class="title-left"><?php echo esc_html($atts['title']); ?></h2>
                    <?php if($atts['filter'] && $atts['type_filter']=='cat_filter' ){?>

                        <div class="box-filter clearfix">
                            <ul class="wrapper-filter" data-filter="true">
                                <?php
                                $n=1;
                                echo '<li class="active"><span class="cat-item" data-catfilter="allCat-'.$rand.'">'.esc_attr('All','nano').'</span></li>';
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
                <div id="allCat-<?php echo esc_attr($rand);?>" class="box-blog archive-blog active row large-vertical clearfix">
                    <?php $k=1;
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post(); ?>
                        <?php if ($k ==1) { ?>
                            <div class="col-md-6 col-sm-6 col-xs-12 box-large">
                                <?php na_part_templates('layout/content-grid'); ?>
                            </div>
                        <?php }
                        else{ ?>
                            <div class="col-md-6 col-sm-6 col-xs-12 box-small  description-hidden">
                                <?php na_part_templates('layout/content-sidebar'); ?>
                            </div>
                        <?php } ?>
                        <?php $k++;
                    }
                    wp_reset_postdata();?>
                </div>

            </div>
        </div>
        <?php break;
}
?>



