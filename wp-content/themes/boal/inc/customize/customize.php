<?php
/**
 * @package     NA Core
 * @version     2.0
 * @author      NanoAgency
 * @link        http://nanoagency.co
 * @copyright   Copyright (c) 2015 NanoAgency
 * @license     GPL v2
 */

require_once( ABSPATH . WPINC . '/class-wp-customize-control.php' );
require_once(get_template_directory() .'/inc/customize/classes/customize-category.php');
require_once(get_template_directory() .'/inc/customize/classes/customize-multi.php');
require_once(get_template_directory() .'/inc/customize/classes/customize-sidebar.php');

require_once(get_template_directory() .'/inc/customize/classes/customize-heading.php');
require_once(get_template_directory() .'/inc/customize/classes/customize-layout.php');
require_once(get_template_directory() .'/inc/customize/classes/customize-toggle.php');
require_once(get_template_directory() .'/inc/customize/classes/customize-info.php');
require_once(get_template_directory() .'/inc/customize/classes/customize-slider.php');

require_once(get_template_directory() .'/inc/customize/includes/customize-controller.php');

$boal_customize = boal_Customize::getInstance();
$boal_customize->init();

