<?php
if (!function_exists('nano_shortcode_box_category')) {
    function nano_shortcode_box_category($atts)
    {
        $atts = shortcode_atts(array(
            'title'                 => '',
            'layout_types'          => 'column',
            'columns'               => '2',
            'type_post'             => 'no',
            'category_name'         => '',
            'number_post'           => 5,
            'filter'                => false,
            'type_filter'           => 'cat_filter',
            'show_cate'             => false,
            'list_type'             => 'post_latest,post_featured,post_view',
            'el_class'              => '',
        ), $atts);
        ob_start();
        nano_template_part('shortcode', 'blog-box', array('atts' => $atts));
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}
add_shortcode('box_category', 'nano_shortcode_box_category');

add_action('vc_before_init', 'nano_box_category_integrate_vc');

if (!function_exists('nano_box_category_integrate_vc')) {
    function nano_box_category_integrate_vc()
    {
        $show_tab = array(
            array('post_latest', __('Latest Posts', 'nano')),
            array('post_featured', __('Featured Posts', 'nano' )),
            array('post_view', __('Most Viewed', 'nano' )),
        );
        vc_map(array(
            'name' => __('NA Box Category', 'nano'),
            'base' => 'box_category',
            'category' => __('NA', 'nano'),
            'icon' => 'nano-box-category',
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => __("Title", 'nano'),
                    "param_name" => "title",
                    "admin_label" => true
                ),
                array(
                    'type' => 'nano_image_radio',
                    'heading' => esc_html__('Layout type', 'nano'),
                    'value' => array(
                        esc_html__(NANO_PLUGIN_URL.'assets/images/content-blog/box1.jpg', 'nano')       => 'box1',
                        esc_html__(NANO_PLUGIN_URL.'assets/images/content-blog/box2.jpg', 'nano')       => 'box2',
                        esc_html__(NANO_PLUGIN_URL.'assets/images/content-blog/box3.jpg', 'nano')       => 'box3',
                        esc_html__(NANO_PLUGIN_URL.'assets/images/content-blog/box4.jpg', 'nano')       => 'box4',
                        esc_html__(NANO_PLUGIN_URL.'assets/images/content-blog/box5.jpg', 'nano')       => 'box5',
                        esc_html__(NANO_PLUGIN_URL.'assets/images/content-blog/box5a.jpg', 'nano')      => 'box5a',
                        esc_html__(NANO_PLUGIN_URL.'assets/images/content-blog/box6.jpg', 'nano')       => 'box6',
                        esc_html__(NANO_PLUGIN_URL.'assets/images/content-blog/box7.jpg', 'nano')       => 'box7',
                        esc_html__(NANO_PLUGIN_URL.'assets/images/content-blog/box8.jpg', 'nano')       => 'box8',
                    ),
                    'width' => '100px',
                    'height' => '70px',
                    'param_name' => 'layout_types',
                    'std' => 'column',
                    'group' => __( 'Layout Settings', 'nano' ),
                    'description' => esc_html__('Select layout type for display post', 'nano'),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Columns", 'nano'),
                    "param_name" => "columns",
                    'dependency' => Array('element' => 'layout_types', 'value' =>array('box1')),
                    'std' => '2',
                    'group' => __( 'Layout Settings', 'nano' ),
                    "value" => array(
                        esc_html__('2', 'nano' ) => 2,
                        esc_html__('3', 'nano' ) => 3,
                        esc_html__('4', 'nano' ) => 4
                    )
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Type Post", 'nano'),
                    "param_name" => "type_post",
                    "value" => array(
                        esc_html__('News', 'nano' )     => 'no',
                        esc_html__('Featured', 'nano' ) => 'yes',
                    ),
                    'std' => 'no',
                    "description" => esc_html__("The criteria you want to show",'nano')
                ),
                array(
                    "type" => "nano_post_categories",
                    "heading" => __("Category IDs", 'nano'),
                    "description" => __("Select category", 'nano'),
                    "param_name" => "category_name",
                    "admin_label" => true
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => __("Show table category", 'nano'),
                    "description" => __("Show table category on post", 'nano'),
                    'param_name' => 'show_cate',
                    'std' => 'no',
                    'group' => __( 'Layout Settings', 'nano' ),

                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Posts Count", 'nano'),
                    "param_name" => "number_post",
                    'group' => __( 'Layout Settings', 'nano' ),
                    "value" => '5'
                ),
                //filter
                array(
                    'type' => 'checkbox',
                    'heading' => __("Show Filter", 'nano'),
                    "description" => __("Table filters will not show when the Title Box is Empty", 'nano'),
                    'param_name' => 'filter',
                    'std' => 'no',
                    'value' => array(__('Yes', 'nano') => 'yes'),
                    'group' => __( 'Filter Settings', 'nano' ),

                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Type Filters ", 'nano'),
                    "param_name" => "type_filter",
                    'dependency' => Array('element' => 'filter', 'value' =>'yes'),
                    "value" => array(
                        __('Category Filters ', 'nano' ) => 'cat_filter',
                        __('Post Filters', 'nano' )      => 'post_filter',
                    ),
                    'group' => __( 'Filter Settings', 'nano' ),
                    'std' => 'cat_filter',
                ),

                array(
                    'type' => 'sorted_list',
                    'heading' => __('Type post', 'nano'),
                    'param_name' => 'list_type',
                    'description' => __('Updating....!!! Control teasers look. Enable blocks and place them in desired order.', 'nano'),
                    'dependency' => Array('element' => 'type_filter', 'value' =>'post_filter'),
                    'group' => __( 'Filter Settings', 'nano' ),
                    'value' => 'post_latest,post_featured,post_view',
                    'options' => $show_tab,
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Extra class name', 'nano' ),
                    'param_name' => 'el_class',
                    'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'nano' )
                )
            )
        ));
    }
}
