<?php
/**
 * godaddy custom hosting class
 *
 * Standard: PSR-2
 *
 * @package SC\DUPX\HOST
 * @link http://www.php-fig.org/psr/psr-2/
 *
 */
defined('ABSPATH') || defined('DUPXABSPATH') || exit;

class DUP_PRO_WordpressCom_Host implements DUP_PRO_Host_interface
{

    public static function getIdentifier()
    {
        return DUP_PRO_Custom_Host_Manager::HOST_WORDPRESSCOM;
    }

    public function isHosting()
    {
        return apply_filters('duplicator_pro_wordpress_host_check', file_exists(WPMU_PLUGIN_DIR.'/wpcomsh-loader.php'));
    }

    public function init()
    {
        add_filter('duplicator_pro_is_shellzip_available', '__return_false');
    }
}