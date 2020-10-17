<?php
if (!function_exists('nano_shortcode_blog')) {
    function nano_shortcode_blog($atts)
    {
        $atts = shortcode_atts(array(
            'title'                 => '',
            'post_layout'           => 'list',
            'columns'               => 1,
            'category_name'         => '',
            'number'                => 8,
            'view_more'             => true,
            'number_words'          =>'25',
            'share_button'          =>'yes',
            'pagination'            =>'loadMore',
            'ads_layout'            =>'large-rectangle',
            'filter'                => false,
            'type_filter'           => 'cat_filter',
            'list_type'             => 'post_latest,post_featured,post_view',
            'el_class'              => ''
        ), $atts);

        ob_start();
        nano_template_part('shortcode', 'blog' , array('atts' => $atts));
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}
add_shortcode('blog', 'nano_shortcode_blog');

add_action('vc_before_init', 'nano_blog_integrate_vc');

if (!function_exists('nano_blog_integrate_vc')) {
    function nano_blog_integrate_vc()
    {
        $show_tab = array(
            array('post_latest', __('Latest Posts', 'nano')),
            array('post_featured', __('Featured Posts', 'nano' )),
            array('post_view', __('Most Viewed', 'nano' )),
        );
        vc_map(array(
            'name' => __('NA Blog Content', 'nano'),
            'base' => 'blog',
            'category' => __('NA', 'nano'),
            'icon' => 'nano-blog',
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => __("Title", 'nano'),
                    "param_name" => "title",
                    "admin_label" => true
                ),
                array(
                    'type' => 'nano_image_radio',
                    'heading' => esc_html__('Layout a post', 'nano'),
                    'value' => array(
                        esc_html__(NANO_PLUGIN_URL.'assets/images/box-grid.jpg', 'nano')            => 'grid',
                        esc_html__(NANO_PLUGIN_URL.'assets/images/box-list.jpg', 'nano')            => 'list',
                        esc_html__(NANO_PLUGIN_URL.'assets/images/content-blog/box4.jpg', 'nano')   => 'box-list2',
                    ),
                    'group' => __( 'Layout Settings', 'nano' ),
                    'width' => '100px',
                    'height' => '70px',
                    'param_name' => 'post_layout',
                    'std' => 'list',
                ),
                array(
                    'type' => 'nano_image_radio',
                    'heading' => esc_html__('Adsense size', 'nano'),
                    'value' => array(
                        esc_html__(NANO_PLUGIN_URL.'assets/images/noads.jpg', 'nano')               => 'no-ads',
                        esc_html__(NANO_PLUGIN_URL.'assets/images/ads-largerectangle.jpg', 'nano')  => 'large-rectangle',
                        esc_html__(NANO_PLUGIN_URL.'assets/images/ads-leaderboard.jpg', 'nano')     => 'leaderboard',
                    ),
                    'group' => __( 'Adsense Settings', 'nano' ),
                    'width' => '100px',
                    'height' => '70px',
                    'param_name' => 'ads_layout',
                    'std' => 'large-rectangle'
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Columns", 'nano'),
                    "param_name" => "columns",
                    'std' => '1',
                    "value" => array(
                        __('1', 'nano' ) => 1,
                        __('2', 'nano' ) => 2,
                        __('3', 'nano' ) => 3,
                        __('4', 'nano' ) => 4,
                    ),
                    'group' => __( 'Layout Settings', 'nano' ),
                ),

                array(
                    "type" => "nano_post_categories",
                    "heading" => __("Category IDs", 'nano'),
                    "description" => __("Select category", 'nano'),
                    "param_name" => "category_name",
                    "admin_label" => true,
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Posts Count", 'nano'),
                    "param_name" => "number",
                    "value" => '8'
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => __("Show content", 'nano'),
                    'param_name' => 'view_more',
                    'std' => 'yes',
                    'value' => array(__('Yes', 'nano') => 'yes')
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => __("Share", 'nano'),
                    'description' => __( 'Show button share.', 'nano' ),
                    'param_name' => 'share_button',
                    'std' => 'yes',
                    'value' => array(__('Yes', 'js_composer') => 'yes')
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Pagination ", 'nano'),
                    "param_name" => "pagination",
                    "value" => array(
                        __('Pagination', 'nano' ) => 'pagination',
                        __('Load more button', 'nano' ) => 'loadMore',
                        __('Lazy Loading', 'nano' ) => 'lazyLoading',
                    ),
                    'group' => __( 'Layout Settings', 'nano' ),
                    'std' => 'loadMore',
                ),
                //filter
                array(
                    'type' => 'checkbox',
                    'heading' => __("Show Filter", 'nano'),
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
                    'description' => __('Control teasers look. Enable blocks and place them in desired order.', 'nano'),
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
