<?php
if (!function_exists('nano_shortcode_box_video')) {
    function nano_shortcode_box_video($atts)
    {
        $atts = shortcode_atts(array(
            'title'             => '',
            'layout_types'      => 'large',
            'category_name'     => '',
            'thumbnail_video1'  => '',
            'thumbnail_video2'  => '',
            'thumbnail_video3'  => '',
            'auto_play'         => 'no',
            'number_post'       => -1,
            'show_post'         => 3,
            'el_class'          => ''
        ), $atts);
        ob_start();
        nano_template_part('shortcode', 'blog-video', array('atts' => $atts));
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}
add_shortcode('box_video', 'nano_shortcode_box_video');

add_action('vc_before_init', 'nano_box_video_integrate_vc');

if (!function_exists('nano_box_video_integrate_vc')) {
    function nano_box_video_integrate_vc()
    {
        vc_map(array(
            'name' => __('NA Box Video', 'nano'),
            'base' => 'box_video',
            'category' => __('NA', 'nano'),
            'icon' => 'nano-box-video',
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
                        esc_html__(NANO_PLUGIN_URL.'assets/images/top-blog/col2.jpg', 'nano')               => 'large',
                        esc_html__(NANO_PLUGIN_URL.'assets/images/top-blog/col4a.jpg', 'nano')              => 'list',
                        esc_html__(NANO_PLUGIN_URL.'assets/images/content-blog/box1.jpg', 'nano')           => 'carousel',
                    ),
                    'width' => '100px',
                    'height' => '70px',
                    'param_name' => 'layout_types',
                    'std' => 'column',
                    'description' => esc_html__('Select layout type for display post', 'nano'),
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Posts Count", 'nano'),
                    "param_name" => "number_post",
                    'dependency' => array(
                        'element' => 'layout_types',
                        'value' => array( 'carousel' ),
                    ),
                    "value" => '6'
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Posts show in a row", 'nano'),
                    "param_name" => "show_post",
                    'dependency' => array(
                        'element' => 'layout_types',
                        'value' => array( 'carousel' ),
                    ),
                    "value" => '3'
                ),
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__('Image1', 'nano'),
                    'param_name' => 'thumbnail_video1',
                    'value' => '',
                    'dependency' => array(
                        'element' => 'layout_types',
                        'value' => array( 'cat' ),
                    ),
                    'group' => __( 'Thumbnail Video', 'nano' ),
                    'edit_field_class' => 'vc_col-sm-12',
                ),
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__('Image2', 'nano'),
                    'param_name' => 'thumbnail_video2',
                    'value' => '',
                    'dependency' => array(
                        'element' => 'layout_types',
                        'value' => array( 'cat' ),
                    ),
                    'group' => __( 'Thumbnail Video', 'nano' ),
                    'edit_field_class' => 'vc_col-sm-12',
                ),
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__('Image3', 'nano'),
                    'param_name' => 'thumbnail_video3',
                    'value' => '',
                    'dependency' => array(
                        'element' => 'layout_types',
                        'value' => array( 'cat' ),
                    ),
                    'group' => __( 'Thumbnail Video', 'nano' ),
                    'edit_field_class' => 'vc_col-sm-12',
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
                    'heading' => __("Auto Play", 'nano'),
                    'param_name' => 'auto_play',
                    'std' => 'no',
                    'value' => array(__('Yes', 'nano') => 'yes')
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
