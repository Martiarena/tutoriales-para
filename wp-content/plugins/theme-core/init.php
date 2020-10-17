<?php
/**
 * Plugin Name: Nano Core Plugin
 * Plugin URI: http://www.nanoagency.co
 * Description: This is not just a plugin, it is a package with many tools a website needed.
 * Author: Nanoagency
 * Version: 2.0.0
 * Author URI: http://www.nanoagency.co
 * Text Domain: nano
*/

require_once('core-config.php');
require_once('inc/helpers/vc.php');

/*  Include Meta Box ================================================================================================ */
require_once( 'inc/meta-box/meta-box-master/meta-box.php');
require_once( 'inc/meta-box/meta-boxes.php');

/*  Include Post Format ============================================================================================= */
require_once( 'inc/vafpress-post-formats/vp-post-formats-ui.php');

/*  Importer ======================================================================================================== */
require_once( 'inc/importer/sample.php');
require_once( 'inc/importer/wp-importer.php');

//Shortcode
require_once( 'inc/shortcode/na_blog.php');
require_once( 'inc/shortcode/na_blogs_top.php');
require_once( 'inc/shortcode/na_blog_box.php');
require_once( 'inc/shortcode/na_blog_video.php');
require_once( 'inc/shortcode/na_blogs_featured.php');