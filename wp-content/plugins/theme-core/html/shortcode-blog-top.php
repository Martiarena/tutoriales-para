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
$add_rtl="false";
if(is_rtl()){
    $add_rtl="true";
}
$add_class='';
    $args = array(
        'category_name'  => $atts['category_name'],
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => $atts['number_post'],
    );
    $arr = array(
        'category_name'  => $atts['category_name'],
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => $atts['number_sidebar'],
    );
    if( $atts['type_post'] == 'yes' ){
        $meta_query[] = array(
            'key' => '_featured',
            'value' => 'yes'
        );
        $args['meta_query'] = $meta_query;
    }
//news or featured post
$the_query = new WP_Query($args);
$count = $the_query->found_posts;
//news post
$the_query2 = new WP_Query($arr);
?>
<?php
switch ($atts['layout_types']) {
    case 'column1':?>
        <div class="box-sliders  sliders-column1">
            <div class="article-carousel" data-rtl="<?php echo esc_attr($add_rtl);?>"  data-table="1" data-number="1" data-mobile = "1" data-mobilemin = "1" data-dots="false" data-arrows="true">
                <?php if ($the_query->have_posts()):
                    while ($the_query->have_posts()): $the_query->the_post();
                            na_part_templates('layout/slider-full');
                    endwhile;
                endif;
                wp_reset_postdata();?>
            </div>
        </div>
        <?php break;

    case 'column3':?>
        <div class="box-sliders article-carousel sliders-column3" data-rtl="<?php echo esc_attr($add_rtl);?>"  data-number="1" data-mobile = "1" data-table="1" data-mobilemin = "1" data-dots="false" data-arrows="false">
            <?php $k=1;
            while ( $the_query->have_posts() ) {
                $the_query->the_post(); ?>
                <?php if ($k == 1 || (($k - 1) % 3) == 0) { ?>
                    <?php //created row ?>
                    <div class="rows">
                        <div class="archive-blog article-grid clearfix">
                            <?php //col large ?>
                            <div class="col-sm-12 col-md-6 box-large article-item">
                                <?php na_part_templates('layout/slider-full'); ?>
                            </div>
                        <?php if ($k ==  $atts['number_post'] || $k ==$count ) { ?>
                           <?php //end row ?>
                               </div>
                           </div>
                       <?php }?>
                <?php }
               else{ ?>
                        <?php //col small ?>
                        <div class="col-sm-6 col-xs-6  col-md-6 box-small article-item description-hidden">
                            <?php na_part_templates('layout/slider-full'); ?>
                        </div>
                   <?php if (($k % 3) == 0 || $k ==$count || $k ==  $atts['number_post']  ) { ?>
                       <?php //end row ?>
                           </div>
                       </div>
                   <?php }?>
                <?php } ?>
                <?php $k++;
            }
            wp_reset_postdata();?>
        </div>
        <?php break;

    case 'column4':?>
        <div class="box-sliders article-carousel sliders-column4 clearfix" data-rtl="<?php echo esc_attr($add_rtl);?>"  data-number="4" data-mobile = "1" data-table="2" data-mobilemin = "1" data-dots="false" data-arrows="true">
                <?php $k=1;
                while ( $the_query->have_posts() ) :
                    $the_query->the_post(); ?>
                        <div class="col-sm-6 col-md-3 box-large article-item description-hidden">
                            <?php na_part_templates('layout/slider-full'); ?>
                        </div>
                <?php $k++; endwhile;
                wp_reset_postdata();?>
        </div>
        <?php break;



    case 'column4b':?>
        <div class="box-sliders sliders-column4b clearfix" data-rtl="<?php echo esc_attr($add_rtl);?>"  data-number="1" data-mobile = "1" data-table="1" data-mobilemin = "1" data-dots="false" data-arrows="false">
                <?php $k=1;
                while ( $the_query->have_posts() ) :
                    $the_query->the_post(); ?>
                    <?php if ($k < 5 ) { ?>
                        <?php if ($k ==1) { ?>
                                    <?php //col large ?>
                                    <div class="col-sm-6 col-md-6 article-item description-hidden slider-vertical">
                                        <?php na_part_templates('layout/slider-full'); ?>
                                    </div>
                        <?php } elseif ($k == 4) { ?>
                                <div class="col-sm-6 col-md-6 article-item description-hidden">
                                    <?php na_part_templates('layout/slider-full'); ?>
                                </div>
                        <?php } else{ ?>
                                 <div class="col-sm-3 col-md-3 article-item description-hidden">
                                    <?php na_part_templates('layout/slider-full'); ?>
                                </div>
                        <?php } ?>
                    <?php } ?>
                <?php $k++; endwhile;
                wp_reset_postdata();?>

        </div>
    <?php break;

    case 'column5a':?>
        <div class="box-sliders sliders-column5a clearfix" data-rtl="<?php echo esc_attr($add_rtl);?>"  data-number="1" data-mobile = "1" data-table="1" data-mobilemin = "1" data-dots="false" data-arrows="false">
                <?php $k=1;
                while ( $the_query->have_posts() ) :
                    $the_query->the_post(); ?>
                    <?php if ($k < 6 ) { ?>
                        <?php if ($k < 4 ) { ?>
                                <?php //col large ?>
                                <div class="col-sm-4 col-md-4 article-item description-hidden">
                                    <?php na_part_templates('layout/slider-full'); ?>
                                </div>
                        <?php }
                       else{ ?>
                                <div class="col-sm-6 col-md-6 article-item description-hidden">
                                    <?php na_part_templates('layout/slider-full'); ?>
                                </div>
                        <?php } ?>
                    <?php } ?>
                <?php $k++; endwhile;
                wp_reset_postdata();?>

        </div>
    <?php break;

    default:?>
      <div class="box-sliders sliders-column1">
            <div class="article-carousel" data-rtl="<?php echo esc_attr($add_rtl);?>"  data-table="1" data-number="1" data-mobile = "1" data-mobilemin = "1" data-dots="false" data-arrows="true">
                <?php if ($the_query->have_posts()):
                    while ($the_query->have_posts()): $the_query->the_post();
                            na_part_templates('layout/slider-full');
                    endwhile;
                endif;
                wp_reset_postdata();?>
            </div>
      </div>
    <?php break;
}
?>



