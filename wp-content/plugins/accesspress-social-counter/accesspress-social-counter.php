<?php

defined( 'ABSPATH' ) or die( "No script kiddies please!" );

/**
 * Plugin Name: AccessPress Social Counter
 * Plugin URI: https://accesspressthemes.com/wordpress-plugins/accesspress-social-counter/
 * Description: A plugin to display your social accounts fans, subscribers and followers number on your website with handful of backend settings and interface.
 * Version: 1.9.0
 * Author: AccessPress Themes
 * Author URI: http://accesspressthemes.com
 * Text Domain: aps-counter
 * Domain Path: /languages/
 * Network: false
 * License: GPL2
 */


if ( ! defined( 'SC_IMAGE_DIR' ) ) {
    define( 'SC_IMAGE_DIR', plugin_dir_url( __FILE__ ) . 'images' );
}

if ( ! defined( 'SC_JS_DIR' ) ) {
    define( 'SC_JS_DIR', plugin_dir_url( __FILE__ ) . 'js' );
}

if ( ! defined( 'SC_CSS_DIR' ) ) {
    define( 'SC_CSS_DIR', plugin_dir_url( __FILE__ ) . 'css' );
}

if ( ! defined( 'SC_VERSION' ) ) {
    define( 'SC_VERSION', '1.9.0' );
}

if ( ! defined( 'SC_PATH' ) ) {
    define( 'SC_PATH', plugin_dir_path( __FILE__ ) );
}

defined('APSC_LITE_PLUGIN_NAME') or define('APSC_LITE_PLUGIN_NAME', 'AccessPress Social Counter');
defined('APSC_LITE_DEMO') or define('APSC_LITE_DEMO', 'http://demo.accesspressthemes.com/wordpress-plugins/accesspress-social-counter');
defined('APSC_LITE_DOC') or define('APSC_LITE_DOC', 'https://accesspressthemes.com/documentation/accesspress-social-counter/');
defined('APSC_LITE_DETAIL') or define('APSC_LITE_DETAIL', 'https://accesspressthemes.com/wordpress-plugins/accesspress-social-counter/');
defined('APSC_LITE_RATING') or define('APSC_LITE_RATING', 'https://wordpress.org/support/plugin/accesspress-social-counter/reviews/#new-post');

defined('APSC_PRO_PLUGIN_NAME') or define('APSC_PRO_PLUGIN_NAME', 'AccessPress Social Pro');
defined('APSC_PRO_LINK') or define('APSC_PRO_LINK','https://accesspressthemes.com/wordpress-plugins/accesspress-social-pro/');
defined('APSC_PRO_DEMO') or define('APSC_PRO_DEMO', 'http://demo.accesspressthemes.com/wordpress-plugins/accesspress-social-pro');
defined('APSC_PRO_DETAIL') or define('APSC_PRO_DETAIL', 'https://accesspressthemes.com/wordpress-plugins/accesspress-social-pro/');


/**
 * Register of widgets
 * */
include_once('inc/backend/widget.php');
if ( ! class_exists( 'SC_Class' ) ) {

    class SC_Class{

        var $apsc_settings;

        function __construct(){
            $this -> apsc_settings = get_option( 'apsc_settings' );
            register_activation_hook( __FILE__, array( $this, 'load_default_settings' ) ); //loads default settings for the plugin while activating the plugin
            add_action( 'init', array( $this, 'plugin_text_domain' ) ); //loads text domain for translation ready
            add_action( 'admin_menu', array( $this, 'add_sc_menu' ) ); //adds plugin menu in wp-admin
            add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_assets' ) ); //registers admin assests such as js and css
            add_action( 'wp_enqueue_scripts', array( $this, 'register_frontend_assets' ) ); //registers js and css for frontend
            add_action( 'admin_post_apsc_settings_action', array( $this, 'apsc_settings_action' ) ); //recieves the posted values from settings form
            add_action( 'admin_post_apsc_restore_default', array( $this, 'apsc_restore_default' ) ); //restores default settings;
            add_action( 'widgets_init', array( $this, 'register_apsc_widget' ) ); //registers the widget
            add_shortcode( 'aps-counter', array( $this, 'apsc_shortcode' ) ); //adds a shortcode
            add_shortcode( 'aps-get-count', array( $this, 'apsc_count_shortcode' ) ); //
            add_action( 'admin_post_apsc_delete_cache', array( $this, 'apsc_delete_cache' ) ); //deletes the counter values from cache

            add_filter( 'plugin_row_meta', array( $this, 'apsc_plugin_row_meta' ), 10, 2 );
            add_filter( 'admin_footer_text', array( $this, 'apsc_admin_footer_text' ) );
            add_action( 'admin_init', array( $this, 'redirect_to_site' ), 1 );

        }

        function redirect_to_site(){
            if ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == 'apsc-documentation' ) {
                wp_redirect( APSC_LITE_DOC );
                exit();
            }

            if ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == 'apsc-premium' ) {
                wp_redirect( APSC_PRO_LINK );
                exit();
            }
        }

        function apsc_plugin_row_meta( $links, $file ){
            if ( strpos( $file, 'accesspress-social-counter.php' ) !== false ) {
                $new_links = array(
                    'demo' => '<a href="'.APSC_LITE_DEMO.'" target="_blank"><span class="dashicons dashicons-welcome-view-site"></span>Live Demo</a>',
                    'doc' => '<a href="'.APSC_LITE_DOC.'" target="_blank"><span class="dashicons dashicons-media-document"></span>Documentation</a>',
                    'support' => '<a href="http://accesspressthemes.com/support" target="_blank"><span class="dashicons dashicons-admin-users"></span>Support</a>',
                    'pro' => '<a href="'.APSC_PRO_LINK.'" target="_blank"><span class="dashicons dashicons-cart"></span>Premium version</a>'
                );
                $links = array_merge( $links, $new_links );
            }
            return $links;
        }

        function apsc_admin_footer_text( $text ){
            global $post;
            if ( isset($_GET['page']) && $_GET['page'] === 'ap-social-counter') {
                $text = 'Enjoyed ' . APSC_LITE_PLUGIN_NAME . '? <a href="' . APSC_LITE_RATING . '" target="_blank">Please leave us a ★★★★★ rating</a> We really appreciate your support! | Try premium version <a href="' . APSC_PRO_LINK . '" target="_blank">' . APSC_PRO_PLUGIN_NAME . '</a> - more features, more power!';
                return $text;
            } else {
                return $text;

            }
        }

        function plugin_text_domain(){
           load_plugin_textdomain( 'accesspress-social-counter', false, basename( dirname( __FILE__ ) ) . '/languages/' );
        }

        function load_default_settings(){
            if ( ! get_option( 'apsc_settings' ) ) {
                $apsc_settings = $this -> get_default_settings();
                update_option( 'apsc_settings', $apsc_settings );
            }
        }


        function add_sc_menu(){
            add_menu_page( __( 'AccessPress Social Counter', 'accesspress-social-counter' ), __( 'AccessPress Social Counter', 'accesspress-social-counter' ), 'manage_options', 'ap-social-counter', array( $this, 'sc_settings' ), SC_IMAGE_DIR . '/sc-icon.png' );

            add_submenu_page('ap-social-counter', __('Documentation', 'accesspress-social-counter'), __('Documentation', 'accesspress-social-counter'), 'manage_options', 'apsc-documentation', '__return_false', null, 9);
            add_submenu_page('ap-social-counter', __('Check Premium Version', 'accesspress-social-counter'), __('Check Premium Version', 'accesspress-social-counter'), 'manage_options', 'apsc-premium', '__return_false', null, 9);
        }

        function sc_settings(){
           include('inc/backend/settings.php');
        }

        function register_admin_assets(){
            if ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == 'ap-social-counter' ) {
                wp_enqueue_style( 'sc-admin-css', SC_CSS_DIR . '/backend.css', array(), SC_VERSION );
                wp_enqueue_script( 'sc-admin-js', SC_JS_DIR . '/backend.js', array( 'jquery', 'jquery-ui-sortable' ), SC_VERSION );
                wp_enqueue_script( 'sc-wpac-time-js', SC_JS_DIR . '/wpac-time.js', array( 'jquery' ), SC_VERSION ); // Third Party API for Facebook followers count
                wp_enqueue_script( 'sc-wpac-js', SC_JS_DIR . '/wpac.js', array( 'jquery' ), SC_VERSION );  // Third Party API for Facebook followers count
            }
            wp_enqueue_style( 'fontawesome-css', SC_CSS_DIR . '/font-awesome.min.css', false, SC_VERSION );
        }

        function register_frontend_assets(){
            $apsc_settings = $this -> apsc_settings;
            $enable_font_css = (isset( $apsc_settings[ 'disable_font_css' ] ) && $apsc_settings[ 'disable_font_css' ] == 0) ? true : false;
            $enable_frontend_css = (isset( $apsc_settings[ 'disable_frontend_css' ] ) && $apsc_settings[ 'disable_frontend_css' ] == 0) ? true : false;
            if ( $enable_font_css ) {
                if ( isset( $apsc_settings[ 'font_awesome_version' ]) && $apsc_settings[ 'font_awesome_version' ] == 'apsc-font-awesome-four' ) {
                    wp_enqueue_style( 'fontawesome-four-css', SC_CSS_DIR . '/font-awesome.min.css', false, SC_VERSION );
                }
                else{
                    wp_enqueue_style( 'fontawesome-five-css', SC_CSS_DIR . '/fontawesome-all.css', false, SC_VERSION );
                }
            }
            if ( $enable_frontend_css ) {
                wp_enqueue_style( 'apsc-frontend-css', SC_CSS_DIR . '/frontend.css', array(), SC_VERSION );
            }
        }

        function apsc_settings_action(){
            if ( ! empty( $_POST ) && wp_verify_nonce( $_POST[ 'apsc_settings_nonce' ], 'apsc_settings_action' ) ) {
                include('inc/backend/save-settings.php');
            }
        }

        function print_array( $array ){
            echo "<pre>";
            print_r( $array );
            echo "</pre>";
        }

        function apsc_restore_default(){
            if ( ! empty( $_GET ) && wp_verify_nonce( $_GET[ '_wpnonce' ], 'apsc-restore-default-nonce' ) ) {
                $apsc_settings = $this -> get_default_settings();
                update_option( 'apsc_settings', $apsc_settings );
                $_SESSION[ 'apsc_message' ] = __( 'Default Settings Restored Successfully', 'accesspress-social-counter' );
                wp_redirect( admin_url() . 'admin.php?page=ap-social-counter' );
            }
        }

        function get_default_settings(){
            $apsc_settings = array( 'social_profile' => array( 'facebook' => array( 'page_id' => '' ),
                'twitter' => array( 'username' => '', 'consumer_key' => '', 
                    'consumer_secret' => '', 
                    'access_token' => '', 
                    'access_token_secret' => '' ),
                'instagram' => array('app_id' => '',
                    'app_secret' => '',
                    'username' => '', 
                    'access_token' => '', 
                    'user_id' => '' ),
                'youtube' => array( 'username' => '', 
                    'channel_url' => '' ),
                'soundcloud' => array( 'username' => '', 
                    'client_id' => '' ),
                'dribbble' => array( 'client_id' => '',
                    'client_secret' => '',
                    'username' => '',
                    'access_token' => ''),
            ),
                'profile_order' => array( 'facebook', 'twitter', 'instagram', 'youtube', 'soundcloud', 'dribbble', 'posts', 'comments' ),
                'social_profile_theme' => 'theme-1',
                'counter_format' => 'comma',
                'font_awesome_version' => 'apsc-font-awesome-five',
                'cache_period' => '',
                'disable_font_css' => 0,
                'disable_frontend_css' => 0
            );
            return $apsc_settings;
        }

        function register_apsc_widget(){
           register_widget( 'APSC_Widget' );
        }

        function apsc_shortcode( $atts ){
           ob_start();
           include('inc/frontend/shortcode.php');
           $html = ob_get_contents();
           ob_get_clean();
           return $html;
        }

        function apsc_delete_cache(){
            if ( ! empty( $_GET ) && wp_verify_nonce( $_GET[ '_wpnonce' ], 'apsc-cache-nonce' ) ) {
                $transient_array = array( 'apsc_facebook', 'apsc_twitter', 'apsc_youtube', 'apsc_instagram','apsc_soundcloud', 'apsc_dribbble', 'apsc_posts', 'apsc_comments' );
                foreach ( $transient_array as $transient ) {
                    delete_transient( $transient );
                }
                $_SESSION[ 'apsc_message' ] = __( 'Cache Deleted Successfully', 'accesspress-social-counter' );
                wp_redirect( admin_url() . 'admin.php?page=ap-social-counter' );
            }
        }

        function authorization( $user, $consumer_key, $consumer_secret, $oauth_access_token, $oauth_access_token_secret ){
            $query = 'screen_name=' . $user;
            $signature = $this -> signature( $query, $consumer_key, $consumer_secret, $oauth_access_token, $oauth_access_token_secret );
            return $this -> header( $signature );
        }

        function signature_base_string( $url, $query, $method, $params ){
            $return = array();
            ksort( $params );

            foreach ( $params as $key => $value ) {
                $return[] = $key . '=' . $value;
            }

            return $method . "&" . rawurlencode( $url ) . '&' . rawurlencode( implode( '&', $return ) ) . '%26' . rawurlencode( $query );
        }

        function signature( $query, $consumer_key, $consumer_secret, $oauth_access_token, $oauth_access_token_secret ){
            $oauth = array(
             'oauth_consumer_key' => $consumer_key,
             'oauth_nonce' => hash_hmac( 'sha1', time(), true ),
             'oauth_signature_method' => 'HMAC-SHA1',
             'oauth_token' => $oauth_access_token,
             'oauth_timestamp' => time(),
             'oauth_version' => '1.0'
         );
            $api_url = 'https://api.twitter.com/1.1/users/show.json';
            $base_info = $this -> signature_base_string( $api_url, $query, 'GET', $oauth );
            $composite_key = rawurlencode( $consumer_secret ) . '&' . rawurlencode( $oauth_access_token_secret );
            $oauth_signature = base64_encode( hash_hmac( 'sha1', $base_info, $composite_key, true ) );
            $oauth[ 'oauth_signature' ] = $oauth_signature;
            return $oauth;
        }

        public function header( $signature ){
            $return = 'OAuth ';
            $values = array();

            foreach ( $signature as $key => $value ) {
                $values[] = $key . '="' . rawurlencode( $value ) . '"';
            }

            $return .= implode( ', ', $values );

            return $return;
        }


        function get_twitter_count(){
            $apsc_settings = $this -> apsc_settings;
            $user = $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'username' ];
            $api_url = 'https://api.twitter.com/1.1/users/show.json';
            $params = array(
                'method' => 'GET',
                'sslverify' => false,
                'timeout' => 60,
                'headers' => array(
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Authorization' => $this -> authorization(
                        $user, $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'consumer_key' ], $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'consumer_secret' ], $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'access_token' ], $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'access_token_secret' ]
                    )
                )
            );

            $connection = wp_remote_get( $api_url . '?screen_name=' . $user, $params );
            if ( is_wp_error( $connection ) ) {
                $count = 0;
            } else {
                $_data = json_decode( $connection[ 'body' ], true );
                if ( isset( $_data[ 'followers_count' ] ) ) {
                    $count = intval( $_data[ 'followers_count' ] );
                } else {
                    $count = 0;
                }
            }
            return $count;
        }

        function get_formatted_count( $count, $format ){
            if ( $count == '' ) {
                return '';
            }
            switch ( $format ) {
                case 'comma':
                    $count = number_format( $count );
                break;
                case 'short':
                    $count = $this -> abreviateTotalCount( $count );
                break;
                default:
                break;
            }
            return $count;
        }

        function abreviateTotalCount( $value ){

            $abbreviations = array( 12 => 'T', 9 => 'B', 6 => 'M', 3 => 'K', 0 => '' );

            foreach ( $abbreviations as $exponent => $abbreviation ) {

                if ( $value >= pow( 10, $exponent ) ) {
                    return round( floatval( $value / pow( 10, $exponent ) ), 1 ) . $abbreviation;
                }
            }
        }

        function facebook_count( $url ){

            $fql = "SELECT like_count ";
            $fql .= " FROM link_stat WHERE url = '$url'";

            $fqlURL = "https://api.facebook.com/method/fql.query?format=json&query=" . urlencode( $fql );

            $response = wp_remote_get( $fqlURL );

            if ( ! is_wp_error( $response ) ) {
                $response = json_decode( $response[ 'body' ] );
                if ( is_array( $response ) && isset( $response[ 0 ] -> like_count ) ) {
                    return $response[ 0 ] -> like_count;
                } else {
                    $count = '0';
                    return $count;
                }
            }else{
                $count = '0';
                return $count;
            }
        }

        function get_count( $social_media ){
           include('inc/frontend/api.php');
           return $count;
        }

        function apsc_count_shortcode( $atts ){
            if ( isset( $atts[ 'social_media' ] ) ) {
                $count = $this -> get_count( $atts[ 'social_media' ] );
                if ( isset( $atts[ 'count_format' ] ) && $count != '' ) {
                    $count = $this -> get_formatted_count( $count, $atts[ 'count_format' ] );
                }
                return $count;
            }
        }

        function get_fb_access_token(){
            $apsc_settings = $this -> apsc_settings;
            $api_url = 'https://graph.facebook.com/';
            $url = sprintf(
             '%soauth/access_token?client_id=%s&client_secret=%s&grant_type=client_credentials', $api_url, $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'app_id' ], $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'app_secret' ]
         );
            $access_token = wp_remote_get( $url, array( 'timeout' => 60 ) );

            if ( is_wp_error( $access_token ) || ( isset( $access_token[ 'response' ][ 'code' ] ) && 200 != $access_token[ 'response' ][ 'code' ] ) ) {
                return '';
            } else {
                return sanitize_text_field( $access_token[ 'body' ] );
            }
        }

        function new_fb_count(){
            $apsc_settings = $this -> apsc_settings;
            $facebook_method = ( isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] ) && $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] != '' ) ? $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] : '2';
            if ( $facebook_method == '1' ) {
                $access_token = $this -> get_fb_access_token();
                $access_token = json_decode( $access_token );
                $access_token = $access_token -> access_token;
                $api_url = 'https://graph.facebook.com/v3.0/'; //not working
                //$api_url = 'https://graph.facebook.com/v2.8/'; // not working
                //$api_url = 'https://graph.facebook.com/v3.2/'; // not working
                $url = sprintf(
                  '%s%s?fields=fan_count&access_token=%s', $api_url, $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'page_id' ], $access_token
                );
            } else {
                $fb_page_id = (isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'fb_page_id' ] ) && ! empty( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'fb_page_id' ] )) ? $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'fb_page_id' ] : ' ';
                $fb_access_token = (isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'access_token' ] ) && ! empty( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'access_token' ] )) ? $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'access_token' ] : ' ';

                if ( $fb_access_token != '' && $fb_page_id != '' ) {
                    $api_url = 'https://graph.facebook.com/';
                    $url = sprintf(
                       '%s%s?fields=fan_count&access_token=%s', $api_url, $fb_page_id, $fb_access_token
                   );
                } else {
                    $url = 'https://graph.facebook.com/';
                }
            }
            $connection = wp_remote_get( $url, array( 'timeout' => 60 ) );

            if ( is_wp_error( $connection ) || ( isset( $connection[ 'response' ][ 'code' ] ) && 200 != $connection[ 'response' ][ 'code' ] ) ) {
                $count = 0;
            } else {
                $_data = json_decode( $connection[ 'body' ], true );
                if ( isset( $_data[ 'fan_count' ] ) ) {
                    $count = intval( $_data[ 'fan_count' ] );
                } else {
                    $count = 0;
                }
            }
            return $count;
        }
    }
    $sc_object = new SC_Class(); 
}
