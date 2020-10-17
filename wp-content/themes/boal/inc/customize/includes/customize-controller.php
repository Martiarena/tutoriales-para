<?php
/**
 * @package     NA Core
 * @version     0.1
 * @author      Nanoboal
 * @link        http://nanoboal.co
 * @copyright   Copyright (c) 2015 Nanoboal
 * @license     GPL v2
 */
if (!class_exists('boal_Customize')) {
    class boal_Customize
    {
        public $customizers = array();

        public $panels = array();

        public function init()
        {
            $this->customizer();
            add_action('customize_controls_enqueue_scripts', array($this, 'boal_customizer_script'));
            add_action('customize_register', array($this, 'boal_register_theme_customizer'));
            add_action('customize_register', array($this, 'remove_default_customize_section'), 20);
        }

        public static function &getInstance()
        {
            static $instance;
            if (!isset($instance)) {
                $instance = new boal_Customize();
            }
            return $instance;
        }

        protected function customizer()
        {
            $this->panels = array(

                'site_panel' => array(
                    'title'             => esc_html__('Style Setting','boal'),
                    'description'       => esc_html__('Style Setting >','boal'),
                    'priority'          =>  101,
                ),
                'sidebar_panel' => array(
                    'title'             => esc_html__('Sidebar','boal'),
                    'description'       => esc_html__('Sidebar Setting','boal'),
                    'priority'          => 103,
                ),
                'woo_panel' => array(
                    'title'             => esc_html__('WooCommerce','boal'),
                    'description'       => esc_html__('WooCommerce >','boal'),
                    'priority'          =>  102,
                ),
                'boal_option_panel' => array(
                    'title'             => esc_html__('Option','boal'),
                    'description'       => '',
                    'priority'          => 104,
                ),
            );

            $this->customizers = array(
                'title_tagline' => array(
                    'title' => esc_html__('Site Identity', 'boal'),
                    'priority'  =>  1,
                    'settings' => array(
                        'boal_logo' => array(
                            'class' => 'image',
                            'label' => esc_html__('Logo', 'boal'),
                            'description' => esc_html__('Upload Logo Image', 'boal'),
                            'priority' => 12
                        ),
                    )
                ),
//2.General ============================================================================================================
                'boal_general' => array(
                    'title' => esc_html__('General', 'boal'),
                    'description' => '',
                    'priority' => 2,
                    'settings' => array(

                        'boal_bg_body' => array(
                            'label'         => esc_html__('Background - Body', 'boal'),
                            'description'   => '',
                            'class'         => 'color',
                            'priority'      => 2,
                            'params'        => array(
                                'default'   => '',
                            ),
                        ),
                        'boal_primary_body' => array(
                            'label'         => esc_html__('Primary - Color', 'boal'),
                            'description'   => '',
                            'class'         => 'color',
                            'priority'      => 1,
                            'params'        => array(
                                'default'   => '',
                            ),
                        ),
                    )
                ),
//3.Header =============================================================================================================
                'boal_header' => array(
                    'title' => esc_html__('Header', 'boal'),
                    'description' => '',
                    'priority' => 3,
                    'settings' => array(
                        //header
                        'boal_header_heading' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Header', 'boal'),
                            'priority' => 0,
                        ),

                        'boal_header' => array(
                            'class'=> 'layout',
                            'label' => esc_html__('Header Layout', 'boal'),
                            'priority' =>1,
                            'choices' => array(
                                'simple'                   => get_template_directory_uri().'/assets/images/header/default.png',
                                'center'                   => get_template_directory_uri().'/assets/images/header/center.png',
                                'left'                     => get_template_directory_uri().'/assets/images/header/left.png',

                            ),
                            'params' => array(
                                'default' => 'left',
                            ),
                        ),

                        'boal_keep_menu' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Keep Menu','boal'),
                            'priority' => 2,
                            'params' => array(
                                'default' => false,
                            ),
                        ),

                        'boal_bg_header' => array(
                            'label'         => esc_html__('Background - Header', 'boal'),
                            'description'   => '',
                            'class'         => 'color',
                            'priority'      => 5,
                            'params'        => array(
                                'default'   => '',
                            ),
                        ),

                        'boal_color_menu' => array(
                            'label'         => esc_html__('Color - Text', 'boal'),
                            'description'   => '',
                            'class'         => 'color',
                            'priority'      => 6,
                            'params'        => array(
                                'default'   => '',
                            ),
                        ),
                    )
                ),
//4.Footer =============================================================================================================
                'boal_new_section_footer' => array(
                    'title' => esc_html__('Footer', 'boal'),
                    'description' => '',
                    'priority' => 4,
                    'settings' => array(
                        'boal_footer' => array(
                            'type' => 'select',
                            'label' => esc_html__('Choose Footer Style', 'boal'),
                            'description' => '',
                            'priority' => -1,
                            'choices' => array(
                                '1'     => esc_html__('Footer 1', 'boal'),
                                '2'     => esc_html__('Footer 2', 'boal'),
                                'hidden' => esc_html__('Hidden Footer', 'boal')
                            ),
                            'params' => array(
                                'default' => '1',
                            ),
                        ),


                        'boal_enable_footer' => array(
                            'type' => 'checkbox',
                            'label' => esc_html__('Enable Footer', 'boal'),
                            'description' => '',
                            'priority' => 0,
                            'params' => array(
                                'default' => '1',
                            ),
                        ),
                        'boal_enable_copyright' => array(
                            'type' => 'checkbox',
                            'label' => esc_html__('Enable Copyright', 'boal'),
                            'description' => '',
                            'priority' => 0,
                            'params' => array(
                                'default' => '1',
                            ),
                        ),
                        'boal_copyright_text' => array(
                            'type' => 'textarea',
                            'label' => esc_html__('Footer Copyright Text', 'boal'),
                            'description' => '',
                            'priority' => 0,
                        ),

                        'boal_bg_footer' => array(
                            'label'         => esc_html__('Background - Footer', 'boal'),
                            'description'   => '',
                            'class'         => 'color',
                            'priority'      => 5,
                            'params'        => array(
                                'default'   => '',
                            ),

                        ),
                        'boal_color_footer' => array(
                            'label'         => esc_html__('Color - Text ', 'boal'),
                            'description'   => '',
                            'class'         => 'color',
                            'priority'      => 6,
                            'params'        => array(
                                'default'   => '',
                            ),

                        ),
                    )
                ),

//5.Categories Blog ====================================================================================================
                'boal_blog' => array(
                    'title' => esc_html__('Blogs Categories', 'boal'),
                    'description' => '',
                    'priority' => 5,
                    'settings' => array(

                        'boal_sidebar_cat' => array(
                            'class'         => 'layout',
                            'label'         => esc_html__('Sidebar Layout', 'boal'),
                            'priority'      =>3,
                            'choices'       => array(
                                'left'         => get_template_directory_uri().'/assets/images/left.png',
                                'right'        => get_template_directory_uri().'/assets/images/right.png',
                                'full'         => get_template_directory_uri().'/assets/images/full.png',
                            ),
                            'params' => array(
                                'default' => 'right',
                            ),
                        ),
                        'boal_siderbar_cat_info' => array(
                            'class' => 'info',
                            'label' => esc_html__('Info', 'boal'),
                            'description' => esc_html__( 'Please goto Appearance > Widgets > drop drag widget to the sidebar Article.', 'boal' ),
                            'priority' => 4,
                        ),
                        //post-layout-cat
                        'boal_title_cat_heading' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Post Title Category', 'boal'),
                            'priority' =>5,
                        ),
                        'boal_post_title_heading' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Title Category ','boal'),
                            'priority' => 6,
                            'params' => array(
                                'default' => true,
                            ),
                        ),
                        'boal_cat_image' => array(
                            'class'         => 'image',
                            'priority'      =>6,
                            'label'         => esc_html__('Background Image', 'boal'),
                            'params'        => array(
                                'default'   => '',
                            ),
                            'sanitize_callback' =>0,
                        ),
                        'boal_cat_bg' => array(
                            'label'         => esc_html__('Background - Color', 'boal'),
                            'description'   => '',
                            'class'         => 'color',
                            'priority'      => 6,
                            'params'        => array(
                                'default'   => '',
                            ),

                        ),

                        'boal_post_cat_layout' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Category layout', 'boal'),
                            'priority' =>8,
                        ),
                        'boal_layout_cat_content' => array(
                            'class'         => 'layout',
                            'priority'      =>9,
                            'choices'       => array(
//                                'tran'        => get_template_directory_uri().'/assets/images/box-tran.jpg',
                                'grid'        => get_template_directory_uri().'/assets/images/box-grid.jpg',
                                'list'        => get_template_directory_uri().'/assets/images/box-list.jpg',
                            ),
                            'params' => array(
                                'default' => 'list',
                            ),
                        ),
                        'boal_number_post_cat' => array(
                            'class' => 'slider',
                            'label' => esc_html__('Number post on a row', 'boal'),
                            'description' => '',
                            'priority' =>10,
                            'choices' => array(
                                'max' => 4,
                                'min' => 1,
                                'step' => 1
                            ),
                            'params'      => array(
                                'default' =>1
                            ),
                        ),

                        //post meta
                        'boal_cat_meta' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Post meta', 'boal'),
                            'priority' =>13,
                        ),
                        'boal_post_meta_share' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Share ','boal'),
                            'priority' => 14,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'boal_post_meta_author' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Author ','boal'),
                            'priority' => 15,
                            'params' => array(
                                'default' => true,
                            ),
                        ),
                        'boal_post_meta_date' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Date ','boal'),
                            'priority' => 16,
                            'params' => array(
                                'default' => true,
                            ),
                        ),
                        'boal_post_meta_comment' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Comment ','boal'),
                            'priority' => 17,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'boal_post_meta_view' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('View ','boal'),
                            'priority' => 18,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                    ),
                ),
//6.Single blog ========================================================================================================
                'boal_blog_single' => array(
                    'title' => esc_html__('Blog Single', 'boal'),
                    'description' => '',
                    'priority' => 6,
                    'settings' => array(
                        'boal_sidebar_single' => array(
                            'class'         => 'layout',
                            'label'         => esc_html__('Sidebar Layout', 'boal'),
                            'priority'      =>13,
                            'choices'       => array(
                                'left'         => get_template_directory_uri().'/assets/images/left.png',
                                'right'        => get_template_directory_uri().'/assets/images/right.png',
                                'full'         => get_template_directory_uri().'/assets/images/full.png',
                            ),
                            'params' => array(
                                'default' => 'right',
                            ),
                        ),

                        'boal_siderbar_single_info' => array(
                            'class' => 'info',
                            'label' => esc_html__('Info', 'boal'),
                            'description' => esc_html__( 'Please goto Appearance > Widgets > drop drag widget to the sidebar Article.', 'boal' ),
                            'priority' => 14,
                        ),

                        //share
                        'boal_single_share' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Share', 'boal'),
                            'priority' =>19,
                        ),
                        'boal_share_facebook' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Share Facebook  ','boal'),
                            'priority' => 21,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'boal_share_twitter' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Share Twitter  ','boal'),
                            'priority' => 22,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'boal_share_google' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Share Google  ','boal'),
                            'priority' => 23,
                            'params' => array(
                                'default' => false,
                            ),
                        ),

                        'boal_share_linkedin' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Share Linkedin  ','boal'),
                            'priority' => 24,
                            'params' => array(
                                'default' => false,
                            ),
                        ),

                        'boal_share_pinterest' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Share Pinterest  ','boal'),
                            'priority' => 25,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        //comments
                        'boal_single_comments' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Comments', 'boal'),
                            'priority' =>28,
                        ),
                        'boal_comments_single_facebook' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Enable Facebook Comments ','boal'),
                            'priority' => 29,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'boal_comments_single' => array(
                            'type'          => 'text',
                            'label'         => esc_html__('Your app id :', 'boal'),
                            'priority'      => 30,
                            'params'        => array(
                                'default'   => '',
                            ),
                        ),
                        'boal_comments_single_info' => array(
                            'class' => 'info',
                            'label' => esc_html__('Info', 'boal'),
                            'description' => esc_html__('If you want show notification on  your facebook , please input app id ...', 'boal' ),
                            'priority' => 31,
                        ),
                    ),
                ),
                'boal_woo_cat' => array(
                    'title' => esc_html__('Categories', 'boal'),
                    'description' => '',
                    'panel' =>'woo_panel',
                    'priority' => 8,
                    'settings' => array(
                        //siderbar
                        'boal_sidebar_woo' => array(
                            'class'=> 'layout',
                            'label' => esc_html__('Sidebar', 'boal'),
                            'priority' =>2,
                            'choices' => array(
                                'left'         => get_template_directory_uri().'/assets/images/left.png',
                                'full'         => get_template_directory_uri().'/assets/images/full.png',
                                'right'         => get_template_directory_uri().'/assets/images/right.png',
                            ),
                            'params' => array(
                                'default' => 'left',
                            ),
                        ),
                        'boal_siderbar_info' => array(
                            'class' => 'info',
                            'label' => esc_html__('Info', 'boal'),
                            'description' => esc_html__( 'Please goto Appearance > Widgets > drop drag widget to the sidebar SHOP.', 'boal' ),
                            'priority' => 3,
                        ),
                        //category
                        'boal_header_woocat' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Categories Product', 'boal'),
                            'priority' =>1,
                        ),
                        'boal_woo_cat_breadcrumb_image' => array(
                            'class'          => 'image',
                            'label'         => esc_html__('Breadcrumb image Title', 'boal'),
                            'priority'      => 6,
                            'params'        => array(
                                'default'   => '',
                            ),

                        ),
                        'boal_woo_number_product' => array(
                            'class' => 'slider',
                            'label' => esc_html__('Number products on a row', 'boal'),
                            'description' => '',
                            'priority' =>9,
                            'choices' => array(
                                'max' => 6,
                                'min' => 2,
                                'step' => 1
                            ),
                            'params'      => array(
                                'default' => 3
                            ),
                        ),
                        'boal_woo_product_per_page' => array(
                            'class' => 'slider',
                            'label' => esc_html__('Number products per page', 'boal'),
                            'description' => '',
                            'priority' =>9,
                            'choices' => array(
                                'max' => 36,
                                'min' => 6,
                                'step' => 1
                            ),
                            'params'      => array(
                                'default' => 9
                            ),
                        ),

                    ),
                ),

//9.Woocommerces Detail  ===============================================================================================
                'boal_woo_detail' => array(
                    'title' => esc_html__('Product Detail', 'boal'),
                    'description' => '',
                    'panel' =>'woo_panel',
                    'priority' => 9,
                    'settings' => array(
                        //siderbar
                        'boal_sidebar_woo_single' => array(
                            'class'=> 'layout',
                            'label' => esc_html__('Sidebar', 'boal'),
                            'priority' =>2,
                            'choices' => array(
                                'left'         => get_template_directory_uri().'/assets/images/left.png',
                                'full'         => get_template_directory_uri().'/assets/images/full.png',
                                'right'         => get_template_directory_uri().'/assets/images/right.png',
                            ),
                            'params' => array(
                                'default' => 'full',
                            ),
                        ),
                        'boal_woo_related_products' => array(
                            'type'          => 'checkbox',
                            'label'         => __('Display Related Products', 'boal'),
                            'priority'      => 24,
                            'params'        => array(
                                'default'   => true,
                            ),

                        ),
                        'boal_woo_number_related_products' => array(
                            'type' => 'select',
                            'label' => __('Number Products Show', 'boal'),
                            'description' => '',
                            'priority' => 25,
                            'choices' => array(
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5'
                            ),
                            'params' => array(
                                'default' => '4',
                            ),

                        ),
                        //Share products
                        'boal_cat_content_heading' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Share', 'boal'),
                            'priority' =>25,
                        ),
                        'boal_woo_share_facebook' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Facebook','boal'),
                            'priority' => 26,
                            'params' => array(
                                'default' => false,
                            ),

                        ),
                        'boal_woo_share_twitter' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Twitter','boal'),
                            'priority' => 27,
                            'params' => array(
                                'default' => false,
                            ),

                        ),
                        'boal_woo_share_pinterest' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Pinterest','boal'),
                            'priority' => 28,
                            'params' => array(
                                'default' => false,
                            ),

                        ),
                        'boal_woo_share_google' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Google +','boal'),
                            'priority' => 29,
                            'params' => array(
                                'default' => false,
                            ),

                        ),
                        'boal_woo_share_linkedin' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('linkedin','boal'),
                            'priority' => 30,
                            'params' => array(
                                'default' => false,
                            ),

                        ),

                    ),
                ),
//7.Adsense blog ========================================================================================================
                'boal_ads' => array(
                    'title' => esc_html__('Adsense Setting', 'boal'),
                    'description' => '',
                    'priority' => 10,
                    'settings' => array(

                        'boal_ads_rectangle' => array(
                            'type' => 'textarea',
                            'label' => esc_html__(' ADS Size: Large Rectangle', 'boal'),
                            'description' => '',
                            'priority' => 1,
                        ),
                        'boal_ads_rectangle_info' => array(
                            'class' => 'info',
                            'label' => esc_html__('Info', 'boal'),
                            'description' => esc_html__('Add code adsbygoogle with the size is: 250x360,336x280 ,300x250 ...', 'boal' ),
                            'priority' => 2,
                        ),
                        'boal_ads_leaderboard' => array(
                            'type' => 'textarea',
                            'label' => esc_html__('ADS Size: Leaderboard', 'boal'),
                            'description' => 'Add code adsbygoogle with the size is: 468x60 ,728x90, 920x180 ...',
                            'priority' => 3,
                        ),
                        'boal_heading_ads_single' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Single', 'boal'),
                            'priority' =>20,
                        ),
                        'boal_ads_single_article' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Ads at the end of the article ','boal'),
                            'priority' => 21,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'boal_ads_single_comment' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Ads at the top of the Comment ','boal'),
                            'priority' => 21,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                    )
                ),
//Font   ===============================================================================================================
                'boal_new_section_font_size' => array(
                    'title' => esc_html__('Font', 'boal'),
                    'priority' => 11,
                    'settings' => array(
                        'boal_body_font_google' => array(
                            'type'          => 'select',
                            'label'         => esc_html__('Use Google Font', 'boal'),
                            'choices'       => boal_googlefont(),
                            'priority'      => 0,
                            'params'        => array(
                                'default'       => 'Poppins',
                            ),

                        ),
                        'boal_body_font_size' => array(
                            'class' => 'slider',
                            'label' => esc_html__('Font size ', 'boal'),
                            'description' => '',
                            'priority' =>8,
                            'choices' => array(
                                'max' => 30,
                                'min' => 10,
                                'step' => 1
                            ),
                            'params'      => array(
                                'default' => 14,
                            ),
                        ),
                    )
                ),
//Style  ===============================================================================================================


            );
        }

        public function boal_customizer_script()
        {
            // Register
            wp_enqueue_style('na-customize', get_template_directory_uri() . '/inc/customize/assets/css/customizer.css', array(),null);
            wp_enqueue_style('jquery-ui', get_template_directory_uri() . '/inc/customize/assets/css/jquery-ui.min.css', array(),null);
            wp_enqueue_script('na-customize', get_template_directory_uri() . '/inc/customize/assets/js/customizer.js', array('jquery'), null, true);
        }

        public function add_customize($customizers) {
            $this->customizers = array_merge($this->customizers, $customizers);
        }


        public function boal_register_theme_customizer()
        {
            global $wp_customize;

            foreach ($this->customizers as $section => $section_params) {

                //add section
                $wp_customize->add_section($section, $section_params);
                if (isset($section_params['settings']) && count($section_params['settings']) > 0) {
                    foreach ($section_params['settings'] as $setting => $params) {

                        //add setting
                        $setting_params = array();
                        if (isset($params['params'])) {
                            $setting_params = $params['params'];
                            unset($params['params']);
                        }
                        $wp_customize->add_setting($setting, array_merge( array( 'sanitize_callback' => null ), $setting_params));
                        //Get class control
                        $class = 'WP_Customize_Control';
                        if (isset($params['class']) && !empty($params['class'])) {
                            $class = 'WP_Customize_' . ucfirst($params['class']) . '_Control';
                            unset($params['class']);
                        }

                        //add params section and settings
                        $params['section'] = $section;
                        $params['settings'] = $setting;

                        //add controll
                        $wp_customize->add_control(
                            new $class($wp_customize, $setting, $params)
                        );
                    }
                }
            }

            foreach($this->panels as $key => $panel){
                $wp_customize->add_panel($key, $panel);
            }

            return;
        }

        public function remove_default_customize_section()
        {
            global $wp_customize;
//            // Remove Sections
//            $wp_customize->remove_section('title_tagline');
            $wp_customize->remove_section('header_image');
            $wp_customize->remove_section('nav');
            $wp_customize->remove_section('static_front_page');
            $wp_customize->remove_section('colors');
            $wp_customize->remove_section('background_image');
        }
    }
}