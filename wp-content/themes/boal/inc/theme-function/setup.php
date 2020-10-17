<?php
/**
 * @package     Boal
 * @version     1.0
 * @author      NanoAgency
 * @link        http://www.nanoagency.co
 * @copyright   Copyright (c) 2016 NanoAgency
 * @license     GPL v2
 */

/*  Setup Theme ===================================================================================================== */
add_action( 'after_setup_theme', 'boal_theme_setup' );
if ( ! function_exists( 'boal_theme_setup' ) ) :
    function boal_theme_setup() {
        load_theme_textdomain( 'boal', get_template_directory() . '/languages' );

        //  Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        //  Let WordPress manage the document title.
        add_theme_support( 'title-tag' );

        //  Enable support for Post Thumbnails on posts and pages.
        add_theme_support( 'post-thumbnails' );

        //Enable support for Post Formats.
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ) );

        add_theme_support( 'post-formats', array(
            'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
        ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        add_theme_support( 'custom-header' );

        add_theme_support( 'custom-background' );

        add_theme_support( "title-tag" );

        add_theme_support( 'wp-block-styles' );

        add_theme_support( 'align-wide' );

        add_theme_support( 'editor-styles' );

        add_editor_style( array( 'assets/css/editor-style.css', boal_font_url() ) );

        add_theme_support( 'responsive-embeds' );


        add_theme_support( 'editor-color-palette', array(
            array(
                'name' => __( 'strong magenta', 'ganesa' ),
                'slug' => 'strong-magenta',
                'color' => '#a156b4',
            ),
            array(
                'name' => __( 'light grayish magenta', 'ganesa' ),
                'slug' => 'light-grayish-magenta',
                'color' => '#d0a5db',
            ),
            array(
                'name' => __( 'very light gray', 'ganesa' ),
                'slug' => 'very-light-gray',
                'color' => '#eee',
            ),
            array(
                'name' => __( 'very dark gray', 'ganesa' ),
                'slug' => 'very-dark-gray',
                'color' => '#444',
            ),
        ) );
    }
endif;

/* Thumbnail Sizes ================================================================================================== */
set_post_thumbnail_size( 220, 150, true);

add_image_size( 'boal-blog-list', 370, 280, true);

add_image_size( 'boal-blog-grid', 438, 290, true);

add_image_size( 'boal-mini-list', 150 ,100, true);

add_image_size( 'boal-blog-tran', 438 ,290, true);

add_image_size( 'boal-blog-tran-large', 770 ,420, true);

add_image_size( 'boal-blog-tran-vertical', 350 ,370, true);

add_image_size( 'boal-blog-vertical', 510 ,680, true);

add_image_size( 'boal-video-image',770,433,true);

add_image_size( 'boal-video',180,110,true);

add_image_size( 'boal-sidebar', 100 ,100, true);

add_image_size( 'boal-related-image',370,247,true);

/* Setup Font ======================================================================================================= */
function boal_font_url() {
    $fonts_url = '';
    $poppins     = _x( 'on', 'Poppins font: on or off', 'boal' );
    if ( 'off' !== $poppins ) {
        $font_families = array();
        if ( 'off' !== $poppins ) {
            $font_families[] = 'Poppins:300,400,500,600,700';
        }
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return esc_url_raw( $fonts_url );
}


/* Load Front-end scripts  ========================================================================================== */
add_action( 'wp_enqueue_scripts', 'boal_theme_scripts');
function boal_theme_scripts() {

    // Add  fonts, used in the main stylesheet.
    wp_enqueue_style( 'boal_fonts', boal_font_url(), array(), null );
    //style plugins
    wp_enqueue_style('bootstrap',get_template_directory_uri().'/assets/css/bootstrap.min.css', array(), '3.0.2 ');
    wp_enqueue_style('font-awesome',get_template_directory_uri().'/assets/css/font-awesome.min.css', array(), '4.6.3');
    wp_enqueue_style('jquery-ui',get_template_directory_uri().'/assets/css/jquery-ui.min.css', array(), '1.11.4');
    wp_enqueue_style('themify-icons',get_template_directory_uri().'/assets/css/themify-icons.css', array(),null);
    wp_enqueue_style('photoswipe',get_template_directory_uri().'/assets/css/photoswipe.css', array(), null);
    wp_enqueue_style('default-skin',get_template_directory_uri().'/assets/css/default-skin/default-skin.css', array(), null);
    //style MAIN THEME
    wp_enqueue_style( 'boal-main', get_template_directory_uri(). '/style.css', array(), null );
    //style skin
    wp_enqueue_style('boal-css', get_template_directory_uri().'/assets/css/style-default.min.css' );
    //register all plugins
    wp_enqueue_script( 'plugins', get_template_directory_uri().'/assets/js/plugins.min.js', array(), null, true );

    wp_enqueue_script( 'nanoscroller', get_template_directory_uri().'/assets/js/plugins/jquery.nanoscroller.min.js', array(), null, true );
    wp_enqueue_script( 'isotope.pkgd', get_template_directory_uri().'/assets/js/plugins/isotope.pkgd.min.js', array(), '2.2.0', true );


    wp_enqueue_script( 'photoswipe', get_template_directory_uri().'/assets/js/photoswipe.min.js', array(), null, true );
    wp_enqueue_script( 'photoswipe-ui-default', get_template_directory_uri().'/assets/js/photoswipe-ui-default.min.js', array(), null, true );


    wp_enqueue_script('videoController', get_template_directory_uri().'/assets/js/plugins/jquery.videoController.min.js','jquery', null, true);
    wp_register_script('tweets-widgets', get_template_directory_uri().'/assets/js/plugins/tweets-widgets.min.js','jquery', '2.3.0', true);

    wp_enqueue_script( 'lazyload', get_template_directory_uri().'/assets/js/plugins/jquery.lazy.js', array(),'1.7.5', true );


    wp_enqueue_script('jquery-masonry');
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    if( function_exists('is_product') && is_product()){
        //vertical
        wp_register_script( 'slick-init', get_template_directory_uri().'/assets/js/dev/slick-init.js', array('jquery'),null, true );
    }

    if ( is_singular() && wp_attachment_is_image() ) {
        wp_enqueue_script( 'boal-theme-keyboard-image-navigation', get_template_directory_uri() . '/assets/js/keyboard-image-navigation.min.js', array( 'jquery' ), '20141010' );
    }

    //jquery MAIN THEME
    wp_enqueue_script('boal-init', get_template_directory_uri() . '/assets/js/dev/boal-init.js', array('jquery'),null, true);
    wp_enqueue_script('boal', get_template_directory_uri() . '/assets/js/dev/boal.js', array('jquery'),null, true);

}

/* Load Back-end SCRIPTS============================================================================================= */
function boal_js_enqueue()
{
    wp_enqueue_media();
    wp_enqueue_style('thickbox');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    // moved the js to an external file, you may want to change the path
    wp_enqueue_script('information_js',get_template_directory_uri(). '/assets/js/widget.min.js', 'jquery', '1.0', true);
}
add_action('admin_enqueue_scripts', 'boal_js_enqueue');

/* Register the required plugins    ================================================================================= */
add_action( 'tgmpa_register', 'boal_register_required_plugins' );
function boal_register_required_plugins() {

    $plugins = array(
        // This is an example of how to include a plugin pre-packaged with a theme.
        array(
            'name'      => esc_html__( 'Nano Core Plugin', 'boal' ),
            'slug'      => 'theme-core',
            'source'    => get_template_directory() . '/inc/theme-plugins/theme-core.zip',
            'required'  => true,
            'version'   => '2.0.0',
            'force_activation' => false,
            'force_deactivation' => false,
            'image_url' => get_template_directory_uri() . '/inc/backend/assets/images/plugins/nano.jpg',

        ),
        //Contact form 7
        array(
            'name'      => esc_html__('Contact Form 7', 'boal' ),
            'slug'      => 'contact-form-7',
            'required'  => false,
            'image_url' => get_template_directory_uri() . '/inc/backend/assets/images/plugins/contact-form7.jpg',
        ),
        //WPBakery Visual Composer
        array(
            'name'      =>  esc_html__('WPBakery Visual Compose', 'boal' ),
            'slug'      => 'js_composer',
            'source'    => get_template_directory() . '/inc/theme-plugins/js_composer.zip',
            'required'  => true,
            'version'   => '5.7',
            'image_url' => get_template_directory_uri() . '/inc/backend/assets/images/plugins/vc.jpg',
        ),
        //MailChimp for WordPress
        array(
            'name'      =>  esc_html__('MailChimp for WordPress ', 'boal' ),
            'slug'      => 'mailchimp-for-wp',
            'required'  => false,
            'image_url' => get_template_directory_uri() . '/inc/backend/assets/images/plugins/mailchimp.jpg',
        ),
        //Instagram
        array(
            'name'      =>  esc_html__('Instagram Feed', 'boal' ),
            'slug'      => 'instagram-feed',
            'required'  => false,
            'image_url' => get_template_directory_uri() . '/inc/backend/assets/images/plugins/instagram.jpg',
        ),
        //Social Counter
        array(
            'name'      =>  esc_html__('AccessPress Social Counter', 'boal' ),
            'slug'      => 'accesspress-social-counter',
            'required'  => false,
            'image_url' => get_template_directory_uri() . '/inc/backend/assets/images/plugins/ap.jpg',
        ),
        //Classic Editor
        array(
            'name'      =>  esc_html__('Classic Editor', 'boal' ),
            'slug'      => 'classic-editor',
            'required'  => false,
        ),
        //Loco Translate
        array(
            'name'      =>  esc_html__('Loco Translate', 'benko' ),
            'slug'      => 'loco-translate',
            'required'  => false,
        ),

    );

    $config = array(
        'id'           => 'boal',                   // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                       // Default absolute path to pre-packaged plugins.
        'has_notices'  => true,
        'menu'         => 'tgmpa-install-plugins',  // Menu slug.
        'dismiss_msg'  => '',                       // If 'dismissable' is false, this message will be output at top of nag.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'is_automatic' => true,                     // Automatically activate plugins after installation or not.
        'message'      => '',                       // Message to output right before the plugins table.

    );

    tgmpa( $plugins, $config );

}

/* Register Navigation ============================================================================================== */
register_nav_menus( array(
    'primary_navigation'    => esc_html__( 'Primary Navigation', 'boal' ),
    'top_navigation'        => esc_html__( 'Topbar Navigation', 'boal' )
) );


/* Register Sidebar ================================================================================================= */
if ( function_exists('register_sidebar') ) {
    register_sidebar( array(
        'name'          => esc_html__( 'Archive', 'boal' ),
        'id'            => 'archive',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'boal' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Blogs', 'boal' ),
        'id'            => 'blogs',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'boal' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Shop', 'boal' ),
        'id'            => 'shop',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'boal' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar 1', 'boal' ),
        'id'            => 'sidebar1',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'boal' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar 2', 'boal' ),
        'id'            => 'sidebar2',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'boal' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar 3', 'boal' ),
        'id'            => 'sidebar3',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'boal' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar(array(
        'name' => esc_html__('Footer Top','boal'),
        'id'   => 'footer-top',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 1 Column 1','boal'),
        'id'   => 'footer-1a',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 1 Column 2','boal'),
        'id'   => 'footer-1b',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 1 Column 3','boal'),
        'id'   => 'footer-1c',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 2 Column 1','boal'),
        'id'   => 'footer-2a',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 2 Column 2','boal'),
        'id'   => 'footer-2b',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 2 Column 3','boal'),
        'id'   => 'footer-2c',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 2 Column 4','boal'),
        'id'   => 'footer-2d',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Bottom Single','boal'),
        'id'   => 'single-post',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Custom Header Left','boal'),
        'id'   => 'custom-header-middle',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Custom Copy Right','boal'),
        'id'   => 'copy-right',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Topbar  Right','boal'),
        'id'   => 'topbar-right',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
}