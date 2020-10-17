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
$add_class='';
$args = array(
    'category_name'  => $atts['category_name'],
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => $atts['number_post'],
    'meta_key'       => 'post_views_count',
    'orderby'       =>'meta_value_num',
    'order'         =>'DESC',
    'date_query' => array( array( 'after' =>  $atts['date_views'] ) ),
);
if( $atts['type_post'] == 'featured' ){
    $meta_query[] = array(
        'key'   => '_featured',
        'value' => 'yes'
    );
    $args['meta_query'] = $meta_query;
}

$the_query = new WP_Query($args);

?>
<div class="box-featured">
    <?php if ($atts['title']) { ?>
        <h2 class="widgettitle"><?php echo esc_html($atts['title']); ?></h2>
    <?php } ?>

    <div class="article-carousel posts-featured row" data-rtl="<?php echo esc_attr($add_rtl);?>" data-number="<?php echo esc_attr($atts['show_post']);?>"  data-dots="false" data-table="2" data-mobile = "2" data-mobilemin = "2" data-arrows="false">
        <?php   while ( $the_query->have_posts() ) {
            $the_query->the_post(); ?>
            <div class="description-hidden archive-blog clearfix">
                <?php na_part_templates('layout/content-grid'); ?>
            </div>
        <?php } ?>
        <?php wp_reset_postdata();?>
    </div>
</div>




