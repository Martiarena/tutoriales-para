<?php
/**
 * @package     boal
 * @version     1.0
 * @author      NanoAgency
 * @link        http://www.nanoagency.co
 * @copyright   Copyright (c) 2016 NanoAgency
 * @license     GPL v2
 */

if (class_exists('WPBakeryVisualComposerAbstract')) {

    function boal_vc_templates( $default_templates ) {
        // New templates
        $new_templates = array(
            'templates-home-1' => array(
                'name' 			=> esc_html__( 'Templates Home 1', 'boal' ),
                'weight' 		=> 0,
                'image_path' 	=> get_template_directory_uri() . '/inc/backend/assets/images/home/home1.jpg',
                'custom_class'	=> '',
                'content' 		=> '[vc_row full_width="stretch_row" css=".vc_custom_1501923386541{margin-top: -30px !important;background-image: url() !important;background-position: 0 0 !important;background-repeat: repeat !important;}"][vc_column][top_blog layout_types="column3" number_post="6" title="Todays News"][/vc_column][/vc_row][vc_row][vc_column css=".vc_custom_1501932269455{margin-top: 0px !important;padding-top: 0px !important;}" offset="vc_col-lg-8 vc_col-md-8"][box_category layout_types="box3" type_post="yes" show_cate="" filter="yes" title="Most Popular"][box_video layout_types="list" auto_play="" title="Videos"][blog post_layout="box-list2" filter="" title="Latest News"][/vc_column][vc_column el_class="sidebar" css=".vc_custom_1501932274236{margin-top: 60px !important;margin-bottom: -35px !important;padding-right: 15px !important;padding-left: 35px !important;}" offset="vc_col-lg-4 vc_col-md-4"][vc_widget_sidebar sidebar_id="sidebar1"][/vc_column][/vc_row]'
            ),
            'templates-home-2' => array(
                'name' 			=> esc_html__( 'Templates Home 2', 'boal' ),
                'weight' 		=> 0,
                'image_path' 	=> get_template_directory_uri() . '/inc/backend/assets/images/home/home2.jpg',
                'custom_class'	=> '',
                'content' 		=> '[vc_row full_width="stretch_row" css=".vc_custom_1501923475614{margin-top: -30px !important;background-image: url() !important;background-position: 0 0 !important;background-repeat: repeat !important;}"][vc_column][top_blog layout_types="column4" type_post="yes" number_post="6" category_name=""][/vc_column][/vc_row][vc_row][vc_column offset="vc_col-lg-8 vc_col-md-8"][box_category layout_types="box7" show_cate="" filter="yes" title="Most Popular" category_name=""][/vc_column][vc_column css=".vc_custom_1501932456085{margin-top: 60px !important;padding-right: 15px !important;padding-left: 35px !important;}" el_class="sidebar" offset="vc_col-lg-4 vc_col-md-4"][vc_widget_sidebar sidebar_id="sidebar2"][/vc_column][/vc_row][vc_row][vc_column][box_video layout_types="large" auto_play="" title="Videos" category_name=""][/vc_column][/vc_row][vc_row][vc_column offset="vc_col-lg-8 vc_col-md-8"][blog ads_layout="no-ads" category_name="" title="Latest News"][/vc_column][vc_column css=".vc_custom_1501932463882{margin-top: 60px !important;margin-bottom: -38px !important;padding-right: 15px !important;padding-left: 35px !important;}" el_class="sidebar" offset="vc_col-lg-4 vc_col-md-4"][vc_widget_sidebar sidebar_id="sidebar3"][/vc_column][/vc_row]'
            ),
            'templates-home-3' => array(
                'name' 			=> esc_html__( 'Templates Home 3', 'boal' ),
                'weight' 		=> 0,
                'image_path' 	=> get_template_directory_uri() . '/inc/backend/assets/images/home/home3.jpg',
                'custom_class'	=> '',
                'content' 		=> '[vc_row full_width="stretch_row" css=".vc_custom_1501923482717{margin-top: -30px !important;background-image: url() !important;background-position: 0 0 !important;background-repeat: repeat !important;}"][vc_column][top_blog layout_types="column5a" type_post="yes" number_post="5" category_name=""][/vc_column][/vc_row][vc_row][vc_column][blog_featured show_post="4" category_name="" title="Most Popular"][/vc_column][/vc_row][vc_row][vc_column offset="vc_col-lg-8 vc_col-md-8"][box_video layout_types="list" auto_play="" category_name="" title="Watch now"][box_category layout_types="box3" show_cate="" filter="yes" category_name="" title="Lifestyle"][box_category layout_types="box1" show_cate="" number_post="4" filter="" category_name="" title="Travel"][box_category layout_types="box8" show_cate="" number_post="6" filter="" category_name="" title="Spa"][blog post_layout="grid" ads_layout="no-ads" columns="2" filter="" category_name="" title="News latest"][/vc_column][vc_column el_class="sidebar" css=".vc_custom_1503937724270{margin-top: 60px !important;margin-bottom: -38px !important;padding-right: 15px !important;padding-left: 35px !important;}" offset="vc_col-lg-4 vc_col-md-4"][vc_widget_sidebar sidebar_id="sidebar1"][/vc_column][/vc_row]'
            ),
            'templates-home-4' => array(
                'name' 			=> esc_html__( 'Templates Home 4', 'boal' ),
                'weight' 		=> 0,
                'image_path' 	=> get_template_directory_uri() . '/inc/backend/assets/images/home/home3.jpg',
                'custom_class'	=> '',
                'content' 		=> '[vc_row full_width="stretch_row" css=".vc_custom_1501923456887{margin-top: -30px !important;background-image: url() !important;background-position: 0 0 !important;background-repeat: repeat !important;}"][vc_column][top_blog layout_types="column4b" type_post="yes" number_post="4" category_name=""][/vc_column][/vc_row][vc_row][vc_column offset="vc_col-lg-8 vc_col-md-8"][box_category layout_types="box5a" show_cate="" number_post="7" filter="yes" category_name="" title="Most Popular"][box_video layout_types="carousel" number_post="4" show_post="2" auto_play="" category_name="" title="Videos"][box_category layout_types="box2" show_cate="" filter="yes" category_name="" title="Lifestyle"][box_category layout_types="box8" show_cate="" number_post="6" filter="" category_name="" title="Spa"][blog post_layout="box-list2" ads_layout="no-ads" filter="" category_name="" title="News latest"][/vc_column][vc_column el_class="sidebar" css=".vc_custom_1503937730118{margin-top: 60px !important;margin-bottom: -38px !important;padding-right: 15px !important;padding-left: 35px !important;}" offset="vc_col-lg-4 vc_col-md-4"][vc_widget_sidebar sidebar_id="sidebar1"][/vc_column][/vc_row]'
            ),
            'templates-contact-us' => array(
                'name' 			=> esc_html__( 'Templates Contact Us', 'redmag' ),
                'weight' 		=> 0,
                'custom_class'	=> '',
                'content' 		=> '[vc_row css=".vc_custom_1501780296562{margin-top: 0px !important;}"][vc_column][vc_gmaps link="#E-8_JTNDaWZyYW1lJTIwc3JjJTNEJTIyaHR0cHMlM0ElMkYlMkZ3d3cuZ29vZ2xlLmNvbSUyRm1hcHMlMkZlbWJlZCUzRnBiJTNEJTIxMW0xOCUyMTFtMTIlMjExbTMlMjExZDYzMDQuODI5OTg2MTMxMjcxJTIxMmQtMTIyLjQ3NDY5NjgwMzMwOTIlMjEzZDM3LjgwMzc0NzUyMTYwNDQzJTIxMm0zJTIxMWYwJTIxMmYwJTIxM2YwJTIxM20yJTIxMWkxMDI0JTIxMmk3NjglMjE0ZjEzLjElMjEzbTMlMjExbTIlMjExczB4ODA4NTg2ZTYzMDI2MTVhMSUyNTNBMHg4NmJkMTMwMjUxNzU3YzAwJTIxMnNTdG9yZXklMkJBdmUlMjUyQyUyQlNhbiUyQkZyYW5jaXNjbyUyNTJDJTJCQ0ElMkI5NDEyOSUyMTVlMCUyMTNtMiUyMTFzZW4lMjEyc3VzJTIxNHYxNDM1ODI2NDMyMDUxJTIyJTIwd2lkdGglM0QlMjI2MDAlMjIlMjBoZWlnaHQlM0QlMjI2MDAlMjIlMjBmcmFtZWJvcmRlciUzRCUyMjAlMjIlMjBzdHlsZSUzRCUyMmJvcmRlciUzQTAlMjIlMjBhbGxvd2Z1bGxzY3JlZW4lM0UlM0MlMkZpZnJhbWUlM0U="][/vc_column][/vc_row][vc_row][vc_column width="1/2"][vc_custom_heading text="Get in touch with us " font_container="tag:h2|font_size:24|text_align:left|color:%23000000" use_theme_fonts="yes"][contact-form-7 id="76" title="Get in touch with us "][/vc_column][vc_column width="1/2" css=".vc_custom_1498717766379{margin-left: 0px !important;padding-left: 30px !important;}"][vc_custom_heading text="Contact Details" font_container="tag:h2|font_size:24|text_align:left|color:%23000000" use_theme_fonts="yes"][vc_column_text]<i class="fa fa-map-marker"></i> 198 West 21th Street, Suite 721 New York, NY 10010<i class="fa fa-phone"></i> Phone: +95 (0) 123 456 789<i class="fa fa-envelope-o"></i> <a href="mailto:nanoagency@gmail.com">nanoagency.co@gmail.com</a>[/vc_column_text][vc_single_image image="950" img_size="full"][/vc_column][/vc_row]'
            ),
            'templates-about-me' => array(
                'name' 			=> esc_html__( 'Templates About Me', 'boal' ),
                'weight' 		=> 0,
                'custom_class'	=> '',
                'content' 		=> '[vc_row][vc_column width="2/3"][vc_column_text]
<div class="box-title clearfix">
<h2 class="title-left">Who we are</h2>
</div>
<img class="size-full wp-image-809 aligncenter" src="http://192.168.1.54/wp/wp-boal/wp-content/uploads/2017/08/about1.jpg" alt="" width="768" height="350" />

Nullam id dolor id nibh ultricies vehicula ut id elit. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec sed odio dui. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nullam id dolor id nibh ultricies vehicula ut id elit.

Donec id elit non mi porta gravida at eget metus. Etiam porta sem malesuada magna mollis euismod. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Praesent commodo cursus magna, egestas eget quam.[/vc_column_text][vc_row_inner css=".vc_custom_1503940894405{margin-top: 60px !important;}"][vc_column_inner width="1/2"][vc_single_image image="814" img_size="full" alignment="center"][vc_column_text]
<h4><strong>Our Mission</strong></h4>
Maecenas faucibus mollis interdum. Nulla vitae elit libero, a pharetra augue. Vestibulum id ligula porta felis euismod semper.
<ul class="list-style">
 	<li>Face Care</li>
 	<li>Nail Care</li>
 	<li>Waxing + Threading</li>
 	<li>Makeup</li>
</ul>
[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_single_image image="815" img_size="full" alignment="center"][vc_column_text]
<h4><strong>Our Vision</strong></h4>
Maecenas faucibus mollis interdum. Nulla vitae elit libero, a pharetra augue. Vestibulum id ligula porta felis euismod semper.
<ul class="list-style">
 	<li>Face Care</li>
 	<li>Nail Care</li>
 	<li>Waxing + Threading</li>
 	<li>Makeup</li>
</ul>
[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner css=".vc_custom_1503940911979{margin-top: 30px !important;}"][vc_column_inner][vc_column_text]
<div class="box-title clearfix">
<h2 class="title-left">Honors &amp; Adwards</h2>
</div>
[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/2"][vc_single_image image="824" img_size="full" alignment="center"][vc_single_image image="822" img_size="full" alignment="center"][/vc_column_inner][vc_column_inner width="1/2"][vc_single_image image="823" img_size="full" alignment="center"][vc_single_image image="821" img_size="full" alignment="center"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/3" el_class="sidebar" css=".vc_custom_1503941478191{margin-top: 5px !important;padding-right: 15px !important;padding-left: 35px !important;}"][vc_widget_sidebar sidebar_id="blogs"][/vc_column][/vc_row]'
            ),
        );


        foreach ( array_reverse( $new_templates ) as $template ) {
            array_unshift( $default_templates, $template );
        }

        return $default_templates;
    }
    add_filter( 'vc_load_default_templates', 'boal_vc_templates' );

}
