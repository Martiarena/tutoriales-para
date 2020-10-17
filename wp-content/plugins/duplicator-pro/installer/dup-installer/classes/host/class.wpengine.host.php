<?php
/**
 * wpengine custom hosting class
 *
 * Standard: PSR-2
 *
 * @package SC\DUPX\DB
 * @link http://www.php-fig.org/psr/psr-2/
 *
 */
defined('ABSPATH') || defined('DUPXABSPATH') || exit;

/**
 * class for wpengine managed hosting
 * 
 * @todo not yet implemneted
 * 
 */
class DUPX_WPEngine_Host implements DUPX_Host_interface
{

    /**
     * return the current host itentifier
     *
     * @return string
     */
    public static function getIdentifier()
    {
        return DUPX_Custom_Host_Manager::HOST_WPENGINE;
    }

    /**
     * @return bool true if is current host
     */
    public function isHosting()
    {

        // can't a manager hosting if isn't a overwrite install
        if (DUPX_InstallerState::getInstance()->getMode() !== DUPX_InstallerState::MODE_OVR_INSTALL) {
            return false;
        }
        $file = DUPX_Paramas_Manager::getInstance()->getValue(DUPX_Paramas_Manager::PARAM_PATH_MUPLUGINS_NEW).'/wpengine-security-auditor.php';
        return file_exists($file);
    }

    /**
     * the init function.
     * is called only if isHosting is true
     *
     * @return void
     */
    public function init()
    {
        
    }

    /**
     * 
     * @return string
     */
    public function getLabel()
    {
        return 'WP Engine';
    }

    /**
     * this function is called if current hosting is this
     */
    public function setCustomParams()
    {
        DUPX_Paramas_Manager::getInstance()->setValue(DUPX_Paramas_Manager::PARAM_IGNORE_PLUGINS, array(
            'mu-plugin.php',
            'advanced-cache.php',
            'wpengine-security-auditor.php',
            'stop-long-comments.php',
            'slt-force-strong-passwords.php'
        ));
    }
}