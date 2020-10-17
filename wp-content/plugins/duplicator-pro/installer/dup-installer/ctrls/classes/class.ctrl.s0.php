<?php
/**
 * controller step 0
 * 
 * Standard: PSR-2
 * @link http://www.php-fig.org/psr/psr-2 Full Documentation
 *
 * @package SC\DUPX
 *
 */
defined('ABSPATH') || defined('DUPXABSPATH') || exit;

final class DUPX_Ctrl_S0
{

    public static function stepHeaderLog()
    {
        $archive_path  = DUPX_Security::getInstance()->getArchivePath();
        $paramsManager = DUPX_Paramas_Manager::getInstance();

        DUPX_Log::info("********************************************************************************");
        DUPX_Log::info('* DUPLICATOR-PRO: Install-Log');
        DUPX_Log::info('* STEP-0 START @ '.@date('h:i:s'));
        DUPX_Log::info("* VERSION: {$GLOBALS['DUPX_AC']->version_dup}");
        DUPX_Log::info('* NOTICE: Do NOT post to public sites or forums!!');
        DUPX_Log::info("********************************************************************************");

        $colSize      = 60;
        $labelPadSize = 20;
        $os           = defined('PHP_OS') ? PHP_OS : 'unknown';
        $log          = str_pad(str_pad('PACKAGE INFO', $labelPadSize, '_', STR_PAD_RIGHT).' '.'CURRENT SERVER', $colSize, ' ', STR_PAD_RIGHT).'|'.'ORIGINAL SERVER'."\n".
            str_pad(str_pad('PHP VERSION', $labelPadSize, '_', STR_PAD_RIGHT).': '.$GLOBALS['DUPX_AC']->version_php, $colSize, ' ', STR_PAD_RIGHT).'|'.phpversion()."\n".
            str_pad(str_pad('OS', $labelPadSize, '_', STR_PAD_RIGHT).': '.$GLOBALS['DUPX_AC']->version_os, $colSize, ' ', STR_PAD_RIGHT).'|'.$os."\n".
            str_pad('CREATED', $labelPadSize, '_', STR_PAD_RIGHT).': '.$GLOBALS['DUPX_AC']->created."\n".
            str_pad('WP VERSION', $labelPadSize, '_', STR_PAD_RIGHT).': '.$GLOBALS['DUPX_AC']->version_wp."\n".
            str_pad('DUP VERSION', $labelPadSize, '_', STR_PAD_RIGHT).': '.$GLOBALS['DUPX_AC']->version_dup."\n".
            str_pad('DB', $labelPadSize, '_', STR_PAD_RIGHT).': '.$GLOBALS['DUPX_AC']->version_db."\n".
            str_pad('DB TABLES', $labelPadSize, '_', STR_PAD_RIGHT).': '.$GLOBALS['DUPX_AC']->dbInfo->tablesFinalCount."\n".
            str_pad('DB ROWS', $labelPadSize, '_', STR_PAD_RIGHT).': '.$GLOBALS['DUPX_AC']->dbInfo->tablesRowCount."\n".
            str_pad('DB FILE SIZE', $labelPadSize, '_', STR_PAD_RIGHT).': '.$GLOBALS['DUPX_AC']->dbInfo->tablesSizeOnDisk."\n".
            "********************************************************************************";
        DUPX_Log::info($log, DUPX_Log::LV_DEFAULT);

        DUPX_Log::info("SERVER INFO");
        DUPX_Log::info(str_pad('PHP', $labelPadSize, '_', STR_PAD_RIGHT).': '.phpversion().' | SAPI: '.php_sapi_name());
        DUPX_Log::info(str_pad('PHP MEMORY', $labelPadSize, '_', STR_PAD_RIGHT).': '.$GLOBALS['PHP_MEMORY_LIMIT'].' | SUHOSIN: '.$GLOBALS['PHP_SUHOSIN_ON']);
        DUPX_Log::info(str_pad('SERVER', $labelPadSize, '_', STR_PAD_RIGHT).': '.$_SERVER['SERVER_SOFTWARE']);
        DUPX_Log::info(str_pad('DOC ROOT', $labelPadSize, '_', STR_PAD_RIGHT).': '.DUPX_Log::varToString(DUPX_ROOT));
        DUPX_Log::info(str_pad('LOG FILE 644', $labelPadSize, '_', STR_PAD_RIGHT).': '.var_export($GLOBALS['CHOWN_LOG_PATH'], true));
        DUPX_Log::info(str_pad('REQUEST URL', $labelPadSize, '_', STR_PAD_RIGHT).': '.DUPX_Log::varToString($GLOBALS['URL_PATH']));
        DUPX_Log::info("********************************************************************************");

        DUPX_Log::info("INSTALLER INFO");
        DUPX_Log::info(str_pad('PATH_NEW', $labelPadSize, '_', STR_PAD_RIGHT).': '.DUPX_Log::varToString($paramsManager->getValue(DUPX_Paramas_Manager::PARAM_PATH_NEW)));
        DUPX_Log::info(str_pad('URL_NEW', $labelPadSize, '_', STR_PAD_RIGHT).': '.DUPX_Log::varToString($paramsManager->getValue(DUPX_Paramas_Manager::PARAM_URL_NEW)));
        DUPX_Log::info("********************************************************************************");

        $log = "\n--------------------------------------\n";
        $log .= "ARCHIVE SETUP\n";
        $log .= "--------------------------------------\n";
        $log .= str_pad('NAME', $labelPadSize, '_', STR_PAD_RIGHT).': '.DUPX_Log::varToString($archive_path)."\n";
        $log .= str_pad('SIZE', $labelPadSize, '_', STR_PAD_RIGHT).': '.DUPX_U::readableByteSize(DUPX_Conf_Utils::archiveSize());

        DUPX_Log::info($log."\n", DUPX_Log::LV_DEFAULT);
        DUPX_Log::flush();
    }
}