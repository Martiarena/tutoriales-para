<?php
/**
 * Class used to control values about the package meta data
 *
 * Standard: PSR-2
 * @link http://www.php-fig.org/psr/psr-2 Full Documentation
 *
 * @package SC\DUPX\ArchiveConfig
 *
 */
defined('ABSPATH') || defined('DUPXABSPATH') || exit;

abstract class DUPX_LicenseType
{

    const Unlicensed   = 0;
    const Personal     = 1;
    const Freelancer   = 2;
    const BusinessGold = 3;

}

/**
 * singleton class
 */
class DUPX_ArchiveConfig
{

    //READ-ONLY: COMPARE VALUES
    public $created;
    public $version_dup;
    public $version_wp;
    public $version_db;
    public $version_php;
    public $version_os;
    public $dbInfo;
    public $wpInfo;
    //GENERAL
    public $secure_on;
    public $secure_pass;
    public $skipscan;
    public $package_name;
    public $package_hash;
    public $package_notes;
    public $wp_tableprefix;
    public $blogname;
    public $wplogin_url;
    public $relative_content_dir;
    public $blogNameSafe;
    public $exportOnlyDB;
    //BASIC DB
    public $dbhost;
    public $dbname;
    public $dbuser;
    public $dbpass;
    //CPANEL: Login
    public $cpnl_host;
    public $cpnl_user;
    public $cpnl_pass;
    public $cpnl_enable;
    public $cpnl_connect;
    //CPANEL: DB
    public $cpnl_dbaction;
    public $cpnl_dbhost;
    public $cpnl_dbname;
    public $cpnl_dbuser;
    //ADV OPTS
    public $wproot;
    public $url_old;
    public $opts_delete;
    //MULTISITE
    public $mu_mode;
    public $mu_generation;
    public $subsites                 = array();
    public $main_site_id             = null;
    public $mu_is_filtered;
    //LICENSING
    public $license_limit;
    //PARAMS
    public $overwriteInstallerParams = array();

    /**
     *
     * @var self 
     */
    private static $instance = null;

    /**
     * Loads a usable object from the archive.txt file found in the dup-installer root
     *
     * @param string $path	// The root path to the location of the server config files
     * 
     * @return self
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected function __construct()
    {
        $config_filepath = DUPX_Package::getPackageArchivePath();
        if (file_exists($config_filepath)) {
            $file_contents = file_get_contents($config_filepath);
            $ac_data       = json_decode($file_contents);

            foreach ($ac_data as $key => $value) {
                $this->{$key} = $value;
            }
        } else {
            echo "$config_filepath doesn't exist<br/>";
        }

        //Instance Updates:
        $this->blogNameSafe = preg_replace("/[^A-Za-z0-9?!]/", '', $this->blogname);
        $this->dbhost       = empty($this->dbhost) ? 'localhost' : $this->dbhost;
        $this->cpnl_host    = empty($this->cpnl_host) ? "https://{$GLOBALS['HOST_NAME']}:2083" : $this->cpnl_host;
        $this->cpnl_dbhost  = empty($this->cpnl_dbhost) ? 'localhost' : $this->cpnl_dbhost;
        $this->cpnl_dbname  = strlen($this->cpnl_dbname) ? $this->cpnl_dbname : '';
    }

    /**
     * Returns the license type this installer file is made of.
     *
     * @return obj	Returns an enum type of DUPX_LicenseType
     */
    public function getLicenseType()
    {
        $license_type = DUPX_LicenseType::Personal;

        if ($this->license_limit < 0) {
            $license_type = DUPX_LicenseType::Unlicensed;
        } else if ($this->license_limit < 15) {
            $license_type = DUPX_LicenseType::Personal;
        } else if ($this->license_limit < 500) {
            $license_type = DUPX_LicenseType::Freelancer;
        } else if ($this->license_limit >= 500) {
            $license_type = DUPX_LicenseType::BusinessGold;
        }

        return $license_type;
    }

    /**
     * 
     * @return bool
     */
    public function isZipArchive()
    {
        //$extension = strtolower(pathinfo($this->package_name)['extension']);
        $extension = strtolower(pathinfo($this->package_name, PATHINFO_EXTENSION));

        return ($extension == 'zip');
    }

    /**
     * 
     * @param string $define
     * @return bool             // return true if define value exists
     */
    public function defineValueExists($define)
    {
        return isset($this->wpInfo->configs->defines->{$define});
    }

    /**
     * 
     * @param string $define
     * @param array $default
     * @return array
     */
    public function getDefineArrayValue($define, $default = array(
            'value'      => false,
            'inWpConfig' => false
        ))
    {
        $defines = $this->wpInfo->configs->defines;
        if (isset($defines->{$define})) {
            return (array) $defines->{$define};
        } else {
            return $default;
        }
    }

    /**
     * return define value from archive or default value if don't exists
     * 
     * @param string $define
     * @param mixed $default
     * @return mixed
     */
    public function getDefineValue($define, $default = false)
    {
        $defines = $this->wpInfo->configs->defines;
        if (isset($defines->{$define})) {
            return $defines->{$define}->value;
        } else {
            return $default;
        }
    }

    /**
     * return define value from archive or default value if don't exists in wp-config
     * 
     * @param string $define
     * @param mixed $default
     * @return mixed
     */
    public function getWpConfigDefineValue($define, $default = false)
    {
        $defines = $this->wpInfo->configs->defines;
        if (isset($defines->{$define}) && $defines->{$define}->inWpConfig) {
            return $defines->{$define}->value;
        } else {
            return $default;
        }
    }

    public function inWpConfigDefine($define)
    {
        $defines = $this->wpInfo->configs->defines;
        if (isset($defines->{$define})) {
            return $defines->{$define}->inWpConfig;
        } else {
            return false;
        }
    }

    /**
     * 
     * @param string $key
     * @return boolean
     */
    public function realValueExists($key)
    {
        return isset($this->wpInfo->configs->realValues->{$key});
    }

    /**
     * return read value from archive if exists of default if don't exists
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function getRealValue($key, $default = false)
    {
        $values = $this->wpInfo->configs->realValues;
        if (isset($values->{$key})) {
            return $values->{$key};
        } else {
            return $default;
        }
    }

    /**
     * 
     * @return string
     */
    public function getBlognameFromSelectedSubsiteId()
    {
        $subsiteId = DUPX_Paramas_Manager::getInstance()->getValue(DUPX_Paramas_Manager::PARAM_SUBSITE_ID);
        $blogname  = $this->blogname;
        if ($subsiteId > 0) {
            foreach ($this->subsites as $subsite) {
                if ($subsiteId == $subsite->id) {
                    $blogname = $subsite->blogname;
                    break;
                }
            }
        }
        return $blogname;
    }

    /**
     * 
     * @return bool
     */
    public function isNetworkInstall()
    {
        $subsiteId = DUPX_Paramas_Manager::getInstance()->getValue(DUPX_Paramas_Manager::PARAM_SUBSITE_ID);
        return $subsiteId < 1 && $this->mu_mode > 0;
    }

    public function setNewPathsAndUrlParamsByMainNew()
    {
        $paramsManager = DUPX_Paramas_Manager::getInstance();
        $archiveConfig = DUPX_ArchiveConfig::getInstance();

        $oldHomeUrl = $paramsManager->getValue(DUPX_Paramas_Manager::PARAM_URL_OLD);
        $newHomeUrl = $paramsManager->getValue(DUPX_Paramas_Manager::PARAM_URL_NEW);
        self::setNewParamUrl(DUPX_Paramas_Manager::PARAM_SITE_URL_OLD, DUPX_Paramas_Manager::PARAM_SITE_URL, $oldHomeUrl, $newHomeUrl);
        self::setNewParamUrl(DUPX_Paramas_Manager::PARAM_URL_CONTENT_OLD, DUPX_Paramas_Manager::PARAM_URL_CONTENT_NEW, $oldHomeUrl, $newHomeUrl);
        self::setNewParamUrl(DUPX_Paramas_Manager::PARAM_URL_UPLOADS_OLD, DUPX_Paramas_Manager::PARAM_URL_UPLOADS_NEW, $oldHomeUrl, $newHomeUrl);
        self::setNewParamUrl(DUPX_Paramas_Manager::PARAM_URL_PLUGINS_OLD, DUPX_Paramas_Manager::PARAM_URL_PLUGINS_NEW, $oldHomeUrl, $newHomeUrl);
        self::setNewParamUrl(DUPX_Paramas_Manager::PARAM_URL_MUPLUGINS_OLD, DUPX_Paramas_Manager::PARAM_URL_MUPLUGINS_NEW, $oldHomeUrl, $newHomeUrl);

        $oldMainPath = $paramsManager->getValue(DUPX_Paramas_Manager::PARAM_PATH_OLD);
        $newMainPath = $paramsManager->getValue(DUPX_Paramas_Manager::PARAM_PATH_NEW);
        self::setNewParamPath(DUPX_Paramas_Manager::PARAM_PATH_CONTENT_OLD, DUPX_Paramas_Manager::PARAM_PATH_CONTENT_NEW, $oldMainPath, $newMainPath);
        self::setNewParamPath(DUPX_Paramas_Manager::PARAM_PATH_UPLOADS_OLD, DUPX_Paramas_Manager::PARAM_PATH_UPLOADS_NEW, $oldMainPath, $newMainPath);
        self::setNewParamPath(DUPX_Paramas_Manager::PARAM_PATH_PLUGINS_OLD, DUPX_Paramas_Manager::PARAM_PATH_PLUGINS_NEW, $oldMainPath, $newMainPath);
        self::setNewParamPath(DUPX_Paramas_Manager::PARAM_PATH_MUPLUGINS_OLD, DUPX_Paramas_Manager::PARAM_PATH_MUPLUGINS_NEW, $oldMainPath, $newMainPath);

        $newCacheHomeVal = self::getNewSubString($oldMainPath, $newMainPath, $archiveConfig->getWpConfigDefineValue('WPCACHEHOME'));
        $newVal          = array(
            'value'      => $newCacheHomeVal,
            'inWpConfig' => $archiveConfig->inWpConfigDefine('WPCACHEHOME') && !empty($newCacheHomeVal)
        );
        $paramsManager->setValue(DUPX_Paramas_Manager::PARAM_WP_CONF_WPCACHEHOME, $newVal);
    }

    protected static function setNewParamUrl($oldParamKey, $newParamKey, $oldMain, $newMain)
    {
        $paramsManager = DUPX_Paramas_Manager::getInstance();
        $oldValue      = $paramsManager->getValue($oldParamKey);
        return self::setNewParamUrlByString($oldValue, $newParamKey, $oldMain, $newMain);
    }

    protected static function setNewParamPath($oldParamKey, $newParamKey, $oldMain, $newMain)
    {
        $paramsManager = DUPX_Paramas_Manager::getInstance();
        $oldValue      = $paramsManager->getValue($oldParamKey);
        return self::setNewParamByString($oldValue, $newParamKey, $oldMain, $newMain);
    }

    protected static function setNewParamByString($oldValue, $newParamKey, $oldMain, $newMain)
    {
        $paramsManager = DUPX_Paramas_Manager::getInstance();

        if (($newValue = self::getNewSubString($oldMain, $newMain, $oldValue)) === false) {
            DUPX_Log::info('PARAM STRING SET NEW VALUE ERROR '.$newParamKey.' OLD VALUE: '.$oldValue);
            $noticeManager = DUPX_NOTICE_MANAGER::getInstance();
            $noticeManager->addNextStepNotice(array(
                'shortMsg'    => 'Check the parameter '.$paramsManager->getLabel($newParamKey),
                'level'       => DUPX_NOTICE_ITEM::NOTICE,
                'longMsg'     => 'The new value can\'t be generated automatically, <b>please check the parameter in Options - Other Config before continuing</b>.',
                'longMsgMode' => DUPX_NOTICE_ITEM::MSG_MODE_HTML
            ));
            // set old value in new param 
            $newValue      = $oldValue;
        }
        $paramsManager->setValue($newParamKey, $newValue);
    }

    protected static function setNewParamUrlByString($oldValue, $newParamKey, $oldMain, $newMain)
    {
        $paramsManager = DUPX_Paramas_Manager::getInstance();

        if (($newValue = self::getNewSubUrl($oldMain, $newMain, $oldValue)) === false) {
            DUPX_Log::info('PARAM URL SET NEW VALUE ERROR '.$newParamKey.' OLD VALUE: '.$oldValue);
            $noticeManager = DUPX_NOTICE_MANAGER::getInstance();
            $noticeManager->addNextStepNotice(array(
                'shortMsg'    => 'Check the parameter '.$paramsManager->getLabel($newParamKey),
                'level'       => DUPX_NOTICE_ITEM::NOTICE,
                'longMsg'     => 'The new URL can\'t be generated automatically, <b>please check the parameter in Options - Other Config before continuing</b>.',
                'longMsgMode' => DUPX_NOTICE_ITEM::MSG_MODE_HTML
            ));
            // set old value in new param 
            $newValue      = $oldValue;
        }
        $paramsManager->setValue($newParamKey, $newValue);
    }

    protected static function getNewSubString($oldMain, $newMain, $subOld)
    {
        if ($oldMain === $subOld) {
            return $newMain;
        } else if (empty($oldMain)) {
            return $newMain.$subOld;
        } else if (strpos($subOld, $oldMain) === 0) {
            return str_replace($oldMain, $newMain, $subOld);
        } else {
            return false;
        }
    }

    protected static function getNewSubUrl($oldMain, $newMain, $subOld)
    {

        $parsedOldMain = DupProSnapLibURLU::parseUrl($oldMain);
        $parsedNewMain = DupProSnapLibURLU::parseUrl($newMain);
        $parsedSubOld  = DupProSnapLibURLU::parseUrl($subOld);

        $parsedSubNew           = $parsedSubOld;
        $parsedSubNew['scheme'] = $parsedNewMain['scheme'];
        $parsedSubNew['port']   = $parsedNewMain['port'];

        if ($parsedOldMain['host'] !== $parsedSubOld['host']) {
            return false;
        }
        $parsedSubNew['host'] = $parsedNewMain['host'];

        if (($newPath = self::getNewSubString($parsedOldMain['path'], $parsedNewMain['path'], $parsedSubOld['path'])) === false) {
            return false;
        }
        $parsedSubNew['path'] = $newPath;
        return DupProSnapLibURLU::buildUrl($parsedSubNew);
    }

    /**
     * 
     * @return array
     */
    public function getSubsitesWithFormattedUrls()
    {
        if (!$this->isNetworkInstall()) {
            return array();
        }

        if ($this->mu_mode == DUPX_MultisiteMode::Subdirectory) {
            $subsites = DUPX_U::urlForSubdirectoryMode($this->subsites, $this->url_old);
        } else {
            $subsites = $this->subsites;
        }
        $subsites = DUPX_U::appendProtocol($subsites);
        return $subsites;
    }

    public function getMainSiteIndex()
    {
        static $mainSubsiteIndex = null;
        if (is_null($mainSubsiteIndex)) {
            $mainSubsiteIndex = -1;
            if ($this->isNetworkInstall() && !empty($this->subsites)) {
                foreach ($this->subsites as $index => $subsite) {
                    if ($subsite->id === $this->main_site_id) {
                        $mainSubsiteIndex = $index;
                        break;
                    }
                }
                if ($mainSubsiteIndex == -1) {
                    $mainSubsiteIndex = 0;
                }
            }
        }
        return $mainSubsiteIndex;
    }

    /**
     * 
     * @param int $id
     * @return boolean|stdClass refurn false if id dont exists
     */
    public function getSubsiteObjById($id)
    {
        static $indexCache = array();

        if (!isset($indexCache[$id])) {
            foreach ($this->subsites as $subsite) {
                if ($subsite->id == $id) {
                    $indexCache[$id] = $subsite;
                    break;
                }
            }
            if (!isset($indexCache[$id])) {
                $indexCache[$id] = false;
            }
        }

        return $indexCache[$id];
    }

    /**
     * 
     * @return array
     */
    public function getOldUrlsArrayIdVal()
    {
        $result   = array();
        $subsites = $this->getSubsitesWithFormattedUrls();

        foreach ($subsites as $subsite) {
            $result[$subsite->id] = rtrim($subsite->name, '/');
        }
        return $result;
    }

    /**
     * 
     * @return array
     */
    public function getNewUrlsArrayIdVal()
    {
        $result   = array();
        $subsites = $this->getSubsitesWithFormattedUrls();

        if (empty($subsites)) {
            return array();
        }

        $mainSiteIndex = $this->getMainSiteIndex();
        $mainUrl       = $subsites[$mainSiteIndex]->name;

        foreach ($subsites as $subsite) {
            $result[$subsite->id] = DUPX_U::getDefaultURL($subsite->name, $mainUrl);
        }

        return $result;
    }

    /**
     * 
     * @return string
     */
    public function getNewCookyeDomainFromOld()
    {
        $archiveConfig = DUPX_ArchiveConfig::getInstance();
        if ($archiveConfig->getWpConfigDefineValue('COOKIE_DOMAIN')) {
            $parsedUrlNew = parse_url(DUPX_Paramas_Manager::getInstance()->getValue(DUPX_Paramas_Manager::PARAM_URL_NEW));
            $parsedUrlOld = parse_url(DUPX_Paramas_Manager::getInstance()->getValue(DUPX_Paramas_Manager::PARAM_URL_OLD));

            $cookieDomain = $archiveConfig->getWpConfigDefineValue('COOKIE_DOMAIN', null);
            if ($cookieDomain == $parsedUrlOld['host']) {
                return $parsedUrlNew['host'];
            } else {
                return $cookieDomain;
            }
        } else {
            return false;
        }
    }

    /**
     * 
     * @staticvar string|bool $relativePath return false if PARAM_PATH_MUPLUGINS_NEW isn't a sub path of PARAM_PATH_NEW
     * @return string
     */
    public function getRelativeMuPlugins()
    {
        static $relativePath = null;
        if (is_null($relativePath)) {
            $relativePath = DupProSnapLibIOU::getRelativePath(
                    DUPX_Paramas_Manager::getInstance()->getValue(DUPX_Paramas_Manager::PARAM_PATH_MUPLUGINS_NEW),
                    DUPX_Paramas_Manager::getInstance()->getValue(DUPX_Paramas_Manager::PARAM_PATH_NEW)
            );
        }
        return $relativePath;
    }

    /**
     * 
     * @param WPConfigTransformer $confTrans
     * @param string $defineKey
     * @param string $paramKey
     */
    public static function updateWpConfigByParam($confTrans, $defineKey, $paramKey)
    {
        $paramsManager = DUPX_Paramas_Manager::getInstance();
        $wpConfVal     = $paramsManager->getValue($paramKey);
        return self::updateWpConfigByValue($confTrans, $defineKey, $wpConfVal);
    }

    /**
     * 
     * @param WPConfigTransformer $confTrans
     * @param string $defineKey
     * @param mixed $wpConfVal
     */
    public static function updateWpConfigByValue($confTrans, $defineKey, $wpConfVal)
    {
        if ($wpConfVal['inWpConfig']) {
            $stringVal = '';
            switch (gettype($wpConfVal['value'])) {
                case "boolean":
                    $stringVal = $wpConfVal['value'] ? 'true' : 'false';
                    $updParam  = array('raw' => true, 'normalize' => true);
                    break;
                case "integer":
                case "double":
                    $stringVal = (string) $wpConfVal['value'];
                    $updParam  = array('raw' => true, 'normalize' => true);
                    break;
                case "string":
                    $stringVal = $wpConfVal['value'];
                    $updParam  = array('raw' => false, 'normalize' => true);
                    break;
                case "NULL":
                    $stringVal = 'null';
                    $updParam  = array('raw' => true, 'normalize' => true);
                    break;
                case "array":
                case "object":
                case "resource":
                case "resource (closed)":
                case "unknown type":
                default:
                    $stringVal = '';
                    $updParam  = array('raw' => true, 'normalize' => true);
                    brack;
            }
            DUPX_Log::info('WP CONFIG UPDATE '.$defineKey.' '.DUPX_Log::varToString($wpConfVal['value']));
            $confTrans->update('constant', $defineKey, $stringVal, $updParam);
        } else {
            if ($confTrans->exists('constant', $defineKey)) {
                DUPX_Log::info('WP CONFIG REMOVE '.$defineKey);
                $confTrans->remove('constant', $defineKey);
            }
        }
    }
}