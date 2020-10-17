<?php
if (!function_exists('nano_shortcode_top_blog')) {
    function nano_shortcode_top_blog($atts)
    {
        $atts = shortcode_atts(array(
            'title'         => '',
            'layout_types'   => 'column',
            'type_post'     => 'no',
            'category_name' => '',
            'number_post'   => 3,
            'number_sidebar'=> 8,
            'style_content' =>'style_bottom',
            'el_class'      => ''
        ), $atts);
        ob_start();
        nano_template_part('shortcode', 'blog-top', array('atts' => $atts));
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}
add_shortcode('top_blog', 'nano_shortcode_top_blog');

add_action('vc_before_init', 'nano_top_blog_integrate_vc');

if (!function_exists('nano_top_blog_integrate_vc')) {
    function nano_top_blog_integrate_vc()
    {
        vc_map(array(
            'name' => __('NA Silder', 'nano'),
            'base' => 'top_blog',
            'category' => __('NA', 'nano'),
            'icon' => 'nano-top-blog',
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
                        esc_html__(NANO_PLUGIN_URL.'assets/images/top-blog/col1.jpg', 'nano')           => 'column1',
                        esc_html__(NANO_PLUGIN_URL.'assets/images/top-blog/col3.jpg', 'nano')           => 'column3',
                        esc_html__(NANO_PLUGIN_URL.'assets/images/top-blog/col4.jpg', 'nano')           => 'column4',
                        esc_html__(NANO_PLUGIN_URL.'assets/images/top-blog/col4b.jpg', 'nano')          => 'column4b',
                        esc_html__(NANO_PLUGIN_URL.'assets/images/top-blog/col5a.jpg', 'nano')          => 'column5a',
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
                    "type" => "textfield",
                    "heading" => __("Posts Count in the Slider", 'nano'),
                    "param_name" => "number_post",
                    'group' => __( 'Layout Settings', 'nano' ),
                    "value" => '3'
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Posts Count in the Sidebar", 'nano'),
                    "param_name" => "number_sidebar",
                    'group' => __( 'Layout Settings', 'nano' ),
                    'dependency' => Array('element' => 'layout_types', 'value' =>'column2'),
                    "value" => '8'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Extra class name', 'nano' ),
                    'param_name' => 'el_class',
                    'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'nano' )
                ),
            )
        ));
    }
}
