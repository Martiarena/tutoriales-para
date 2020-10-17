<?php
/**
 * Class for handling archive setup and build process
 *
 * Standard: PSR-2 (almost)
 * @link http://www.php-fig.org/psr/psr-2
 *
 * @package DUP_PRO
 * @subpackage classes/package
 * @copyright (c) 2017, Snapcreek LLC
 * @license	https://opensource.org/licenses/GPL-3.0 GNU Public License
 * @since 1.0.0
 *
 * @notes: Trace process time
 *	$timer01 = DUP_PRO_U::getMicrotime();
 *	DUP_PRO_LOG::trace("SCAN TIME-B = " . DUP_PRO_U::elapsedTime(DUP_PRO_U::getMicrotime(), $timer01));
 *
 */
defined('ABSPATH') || defined('DUPXABSPATH') || exit;

require_once (DUPLICATOR_PRO_PLUGIN_PATH . 'classes/package/class.pack.archive.filters.php');
require_once (DUPLICATOR_PRO_PLUGIN_PATH . 'classes/package/class.pack.archive.zip.php');
require_once (DUPLICATOR_PRO_PLUGIN_PATH . 'classes/package/duparchive/class.pack.archive.duparchive.php');
require_once (DUPLICATOR_PRO_PLUGIN_PATH . 'classes/package/class.pack.archive.shellzip.php');
require_once (DUPLICATOR_PRO_PLUGIN_PATH . 'classes/class.exceptions.php');
require_once (DUPLICATOR_PRO_PLUGIN_PATH . 'classes/class.io.php');
require_once (DUPLICATOR_PRO_PLUGIN_PATH . 'lib/forceutf8/src/Encoding.php');
//require_once(DUPLICATOR_PRO_PLUGIN_PATH  . 'lib/snaplib/class.snaplib.u.util.php');


class DUP_PRO_Archive
{
    const DIRS_LIST_FILE_NAME_SUFFIX  = '_dirs.txt';
    const FILES_LIST_FILE_NAME_SUFFIX = '_files.txt';

    //PUBLIC
    //Includes only the dirs set on the package
    public $ExportOnlyDB;
    public $FilterDirs;
    public $FilterExts;
    public $FilterFiles;
    //Includes all FilterInfo except warnings
    public $FilterDirsAll  = array();
    public $FilterExtsAll  = array();
    public $FilterFilesAll = array();
    public $FilterOn;
    public $File;
    public $Format;
    public $PackDir;
    public $Size           = 0;
    public $Dirs           = array();
    public $DirCount       = 0;
    public $RecursiveLinks = array();
    public $Files          = array();
    public $FileCount      = 0;
    public $file_count     = -1;

    /**
     *
     * @var DUP_PRO_Archive_Filter_Info
     */
    public $FilterInfo = null;
    public $ListDelimiter = "\n";

    /**
     *
     * @var DUP_PRO_Package
     */
    protected $Package;
    private $global;
    private $tmpFilterDirsAll = array();
    private $wpCorePaths      = array();
    private $wpCoreExactPaths = array();

    /**
     *
     * @var DUP_PRO_Archive_File_List 
     */
    private $listFileObj    = null;

    /**
     *
     * @var DUP_PRO_Archive_File_List 
     */
    private $listDirObj     = null;
    private $FileListHandle = null;
    private $DirListHandle  = null;

    /**
     *
     * @param DUP_PRO_Package $package
     */
    public function __construct($package)
    {
        $this->Package    = $package;
        $this->FilterOn   = false;
        $this->FilterInfo = new DUP_PRO_Archive_Filter_Info();
        $this->global     = DUP_PRO_Global_Entity::get_instance();
        $this->ExportOnlyDB = false;
        $this->throttleDelayInUs =  $this->global->getMicrosecLoadReduction();

        $rootPath = duplicator_pro_get_root_path();

        $this->wpCorePaths[] = DUP_PRO_U::safePath("{$rootPath}/wp-admin");
        $this->wpCorePaths[] = DUP_PRO_U::safePath(WP_CONTENT_DIR . "/uploads");
        $this->wpCorePaths[] = DUP_PRO_U::safePath(WP_CONTENT_DIR . "/languages");
        $this->wpCorePaths[] = DUP_PRO_U::safePath(WP_PLUGIN_DIR);
        $this->wpCorePaths[] = DUP_PRO_U::safePath(get_theme_root());
        $this->wpCorePaths[] = DUP_PRO_U::safePath("{$rootPath}/wp-includes");

        $this->wpCoreExactPaths[] = DUP_PRO_U::safePath("{$rootPath}");
		$this->wpCoreExactPaths[] = DUP_PRO_U::safePath(WP_CONTENT_DIR);
        
        $this->listDirObj = new DUP_PRO_Archive_File_List(DUPLICATOR_PRO_SSDIR_PATH_TMP.'/'.$this->Package->get_dirs_list_filename());
        $this->listFileObj = new DUP_PRO_Archive_File_List(DUPLICATOR_PRO_SSDIR_PATH_TMP.'/'.$this->Package->get_files_list_filename());
        
    }

    function __destruct()
    {
        $this->Package = null;
    }
    
    public function __clone()
    {
        DUP_PRO_LOG::trace("CLONE ".__CLASS__);

        $this->FilterInfo = clone $this->FilterInfo;
    }

    /**
     * Builds the archive file
     *
     * @returns null
     */
    public function buildFile($package, $build_progress)
    {
        DUP_PRO_LOG::trace("Building archive");

        try {
            $this->Package = $package;
            if (!isset($this->PackDir) && !is_dir($this->PackDir)) throw new Exception("The 'PackDir' property must be a valid directory.");
            if (!isset($this->File)) throw new Exception("A 'File' property must be set.");

            $completed = false;

            switch ($this->Format) {
                case 'TAR': break;

                case 'DAF':
                    $completed = DUP_PRO_Dup_Archive::create($this, $build_progress);
                    $this->Package->Update();
                    break;

                default:
                    $this->Format = 'ZIP';

                    if ($build_progress->current_build_mode == DUP_PRO_Archive_Build_Mode::Shell_Exec) {
                        DUP_PRO_LOG::trace('Doing shell exec zip');
                        $completed = DUP_PRO_ShellZip::create($this, $build_progress);
                    } else {
                        $zipArchive = new DUP_PRO_ZipArchive();
                        $completed  = $zipArchive->create($this, $build_progress);
                    }

                    $this->Package->Update();
                    break;
            }

            if ($completed) {
                if ($build_progress->failed) {
                    DUP_PRO_LOG::traceError("Error building archive");
                    $this->Package->set_status(DUP_PRO_PackageStatus::ERROR);
                } else {
                    $filepath    = DUP_PRO_U::safePath("{$this->Package->StorePath}/{$this->Package->Archive->File}");
                    $this->Size	 = @filesize($filepath);
                    $this->Package->set_status(DUP_PRO_PackageStatus::ARCDONE);
                    DUP_PRO_LOG::trace("filesize of archive = {$this->Size}");
                    DUP_PRO_LOG::trace("Done building archive");
                }
            } else {
                DUP_PRO_LOG::trace("Archive chunk completed");
            }

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    /**
     * Create filters info and generate meta data about the dirs and files needed for the build
     *
     * @link http://msdn.microsoft.com/en-us/library/aa365247%28VS.85%29.aspx Windows filename restrictions
     *
     * @returns object	Returns a copy of this object containing scanner results
     */
    public function buildScanStats()
    {
        DUP_PRO_LOG::trace(' START');
        $this->createFilterInfo();
        $this->initScanStats();

        $rootPath = duplicator_pro_get_root_path();
        //If the root directory is a filter then skip it all
        if (in_array($this->PackDir, $this->FilterDirsAll) || $this->Package->Archive->ExportOnlyDB) {
            DUP_PRO_LOG::trace('SKIP ALL FILES');
            $this->initFileListHandles();
            $this->closeFileListHandles();
            $this->Dirs = array();
        } else {
            $this->initFileListHandles();

            if (($result = $this->getFileLists($rootPath, '')) != false) {
                $this->addToDirList($rootPath, '', $result['size'], $result['nodes'] + 1);
            } else {
                DUP_PRO_LOG::trace('Can\'t scan the folder '.$rootPath);
            }

            if (self::isOuterWPContentDir()) {
                if (($result = $this->getFileLists(DUP_PRO_U::safePathUntrailingslashit(WP_CONTENT_DIR), DUP_PRO_U::safePathUntrailingslashit(WP_CONTENT_DIR))) != false) {
                    $this->addToDirList(DUP_PRO_U::safePathUntrailingslashit(WP_CONTENT_DIR), DUP_PRO_U::safePathUntrailingslashit(WP_CONTENT_DIR), $result['size'], $result['nodes'] + 1);
                } else {
                    DUP_PRO_LOG::trace('Can\'t scan the folder '.DUP_PRO_U::safePathUntrailingslashit(WP_CONTENT_DIR));
                }
            }
            $this->closeFileListHandles();
        }

        DUP_PRO_LOG::trace('set filters all');
        $this->FilterDirsAll  = array_merge($this->FilterDirsAll, $this->FilterInfo->Dirs->Unreadable);
        $this->FilterFilesAll = array_merge($this->FilterFilesAll, $this->FilterInfo->Files->Unreadable);
        sort($this->FilterDirsAll);
        sort($this->FilterFilesAll);
        $this->setTreeFilters();

        return $this;
    }

    private function initScanStats()
    {
        $this->RecursiveLinks = array();
        $this->FilterInfo->reset(true);

        // For file
        $this->Size      = 0;
        $this->FileCount = 0;
        $this->DirCount  = 0;
    }

    /**
     * Get the file path to the archive file
     *
     * @return string	Returns the full file path to the archive file
     */
    public function getSafeFilePath()
    {
        return DUP_PRO_U::safePath(DUPLICATOR_PRO_SSDIR_PATH."/{$this->File}");
    }

    /**
     * Get the store URL to the archive file
     *
     * @return string	Returns the full URL path to the archive file
     */
    public function getURL()
    {
        return DUPLICATOR_PRO_SSDIR_URL."/{$this->File}";
    }

    public static function parsePathFilter($input = '', $getFilterList = false)
    {
        // replace all new line with ;
        $input = str_replace(array("\r\n", "\n", "\r"), ';', $input);
        // remove all empty content
        $input = trim(preg_replace('/;([\s\t]*;)+/', ';' , $input), "; \t\n\r\0\x0B");
        // get content array
        $line_array = preg_split('/[\s\t]*;[\s\t]*/', $input);

        $result     = array();
        foreach ($line_array as $val) {
            if (strlen($val) == 0 || preg_match('/^[\s\t]*?#/', $val)) {
                if (!$getFilterList) {
                    $result[] = trim($val);
                }
            } else {
                $safePath = str_replace(array("\t", "\r"), '', $val);
                $safePath = DUP_PRO_U::safePath(trim(rtrim($safePath, "/\\")));
                if (strlen($safePath) >= 2) {
                    $result[] = $safePath;
                }
            }
        }

        if ($getFilterList) {
            $result = array_unique($result);
            sort($result);
            return $result;
        } else {
            return implode(";", $result);
        }
    }

    /**
     * Parse the list of ";" separated paths to make paths/format safe
     *
     * @param string $dirs A list of dirs to parse
     *
     * @return string	Returns a cleanup up ";" separated string of dir paths
     */
    public static function parseDirectoryFilter($dirs = '', $getPathList = false)
    {
        return self::parsePathFilter($dirs, $getPathList);
    }

    /**
     * Parse the list of ";" separated extension names to make paths/format safe
     *
     * @param string $extensions A list of file extension names to parse
     *
     * @return string	Returns a cleanup up ";" separated string of extension names
     */
    public static function parseExtensionFilter($extensions = "")
    {
        $filter_exts = "";
        if (!empty($extensions) && $extensions != ";") {
            $filter_exts = str_replace(array(' ', '.'), '', $extensions);
            $filter_exts = str_replace(",", ";", $filter_exts);
            $filter_exts = DUP_PRO_STR::appendOnce($extensions, ";");
        }
        return $filter_exts;
    }

    /**
     * Parse the list of ";" separated paths to make paths/format safe
     *
     * @param string $files		A list of file paths to parse
     *
     * @return string	Returns a cleanup up ";" separated string of file paths
     */
    public static function parseFileFilter($files = '', $getPathList = false)
    {
        return self::parsePathFilter($files, $getPathList);
    }

    /**
     * Creates all of the filter information meta stores
     *
     * @todo: Create New Section Settings > Packages > Filters
     * Two new check boxes one for directories and one for files
     * Readonly list boxes for directories and files
     *
     * @return null
     */
    private function createFilterInfo()
    {        
        DUP_PRO_LOG::traceObject('Filter files', $this->FilterFiles);
        
        $this->FilterInfo->Dirs->Core = array();
        
        //FILTER: INSTANCE ITEMS
        if ($this->FilterOn) {            
            $this->FilterInfo->Dirs->Instance  = self::parsePathFilter($this->FilterDirs, true);

            $this->FilterInfo->Exts->Instance  = explode(";", $this->FilterExts);
            // Remove blank entries
            $this->FilterInfo->Exts->Instance  = array_filter(array_map('trim', $this->FilterInfo->Exts->Instance));

            $this->FilterInfo->Files->Instance = self::parsePathFilter($this->FilterFiles, true);
        }

        //FILTER: GLOBAL ITMES
        if ($GLOBALS['DUPLICATOR_PRO_GLOBAL_DIR_FILTERS_ON']) {
            $this->FilterInfo->Dirs->Global = $GLOBALS['DUPLICATOR_PRO_GLOBAL_DIR_FILTERS'];
        }

        $root_path = duplicator_pro_get_root_path();
        $GLOBALS['DUPLICATOR_PRO_GLOBAL_FILE_FILTERS'][] = $root_path . '/.htaccess';
		$GLOBALS['DUPLICATOR_PRO_GLOBAL_FILE_FILTERS'][] = $root_path . '/wp-config.php';

        if ($GLOBALS['DUPLICATOR_PRO_GLOBAL_FILE_FILTERS_ON']) {
            $this->FilterInfo->Files->Global = $GLOBALS['DUPLICATOR_PRO_GLOBAL_FILE_FILTERS'];
        }

        //FILTER: CORE ITMES
        //Filters Duplicator free packages & All pro local directories
        $storages = DUP_PRO_Storage_Entity::get_all();
        foreach ($storages as $storage) {
            if ($storage->storage_type == DUP_PRO_Storage_Types::Local && $storage->local_filter_protection) {
                $this->FilterInfo->Dirs->Core[] = DUP_PRO_U::safePath($storage->local_storage_folder);
            }
        }

        // Prevent adding double wp-content dir conflicts
        if ($this->isOuterWPContentDir()) {
            $default_wp_content_dir_path = DUP_PRO_U::safePath(ABSPATH.'wp-content');
            if (file_exists($default_wp_content_dir_path)) {
                if (is_dir($default_wp_content_dir_path)) {
                    $this->FilterInfo->Dirs->Core[] = $default_wp_content_dir_path;
                } else {
                    $this->FilterInfo->Files->Core[] = $default_wp_content_dir_path;
                }
            }
        }
        
        $this->FilterDirsAll  = array_merge($this->FilterInfo->Dirs->Instance, $this->FilterInfo->Dirs->Global, $this->FilterInfo->Dirs->Core, $this->Package->Multisite->getDirsToFilter());
        $this->FilterExtsAll  = array_merge($this->FilterInfo->Exts->Instance, $this->FilterInfo->Exts->Global, $this->FilterInfo->Exts->Core);
        $this->FilterFilesAll = array_merge($this->FilterInfo->Files->Instance, $this->FilterInfo->Files->Global, $this->FilterInfo->Files->Core);
        $this->tmpFilterDirsAll = $this->FilterDirsAll;

        //PHP 5 on windows decode patch
        if (! DUP_PRO_U::$PHP7_plus && DupProSnapLibOSU::isWindows()) {
            foreach ($this->tmpFilterDirsAll as $key => $value) {
                if ( preg_match('/[^\x20-\x7f]/', $value)) {
                    $this->tmpFilterDirsAll[$key] = utf8_decode($value);
                }
            }
        }
        DUP_PRO_LOG::trace('Filter files Ok');
    }

    /**
     * Recursive function to get all directories in a wp install
     *
     * @notes:
     * 	Older PHP logic which is more stable on older version of PHP
     * 	NOTE RecursiveIteratorIterator is problematic on some systems issues include:
     *  - error 'too many files open' for recursion
     *  - $file->getExtension() is not reliable as it silently fails at least in php 5.2.17
     *  - issues with when a file has a permission such as 705 and trying to get info (had to fallback to path-info)
     *  - basic conclusion wait on the SPL libs until after php 5.4 is a requirments
     *  - tight recursive loop use caution for speed
     *
     * @return array	Returns an array of directories to include in the archive
     */
    private function getFileLists($path, $relativePath)
    {
        if (($handle = opendir($path)) === false) {
            DUP_PRO_LOG::trace('Can\'t open dir: '.$path);
            return false;
        }
        
        $result = array(
            'size'  => 0,
            'nodes' => 1
        );
        
        $trimmedRelativePath = ltrim($relativePath.'/' , '/');

        while (($currentName = readdir($handle)) !== false) {
            if ($currentName == '.' || $currentName == '..') {
                continue;
            }
            $currentPath = $path.'/'.$currentName;

            if (is_dir($currentPath)) {
                DUP_PRO_LOG::trace(' Scan dir: '.$currentPath);
                $add = true;
                if (!is_link($currentPath)) {
                    foreach ($this->tmpFilterDirsAll as $key => $val) {
                        $trimmedFilterDir = rtrim($val, '/');
                        if ($currentPath == $trimmedFilterDir || strpos($currentPath, $trimmedFilterDir.'/') !== false) {
                            $add = false;
                            unset($this->tmpFilterDirsAll[$key]);
                            break;
                        }
                    }
                } else {
                    //Convert relative path of link to absolute paths
                    chdir($currentPath);
                    $link_path = str_replace("\\", '/', realpath(readlink($currentPath)));
                    chdir(dirname(__FILE__));

                    $link_pos = strpos($currentPath, $link_path);
                    if ($link_pos === 0 && (strlen($link_path) < strlen($currentPath))) {
                        $add                    = false;
                        $this->RecursiveLinks[] = $currentPath;
                        $this->FilterDirsAll[]  = $currentPath;
                    } else { // For link filter
                        foreach ($this->tmpFilterDirsAll as $key => $val) {
                            $trimmedFilterDir = rtrim($val, '/');
                            if ($currentPath == $trimmedFilterDir || strpos($currentPath, $trimmedFilterDir.'/') !== false) {
                                $add = false;
                                unset($this->tmpFilterDirsAll[$key]);
                                break;
                            }
                        }
                    }
                }

                if ($add) {
                    $childResult     = $this->getFileLists($currentPath, $trimmedRelativePath.$currentName);
                    $result['size']  += $childResult['size'];
                    $result['nodes'] += $childResult['nodes'];
                    $this->addToDirList($currentPath, $trimmedRelativePath.$currentName, $childResult['size'], $childResult['nodes']);
                    //MT: SERVER THROTTLE
                    /*  Disable throttle on scan ulti chunking is implementend
                      if ($this->throttleDelayInUs > 0) {
                      usleep($this->throttleDelayInUs);
                      } */
                }
            } else {
                // Note: The last clause is present to perform just a filename check
                if (!(in_array(pathinfo($currentName, PATHINFO_EXTENSION), $this->FilterExtsAll) || in_array($currentPath, $this->FilterFilesAll) || in_array($currentName, $this->FilterFilesAll))) {
                    $fileSize = (int) @filesize($currentPath);
                    $result['size']  += $fileSize;
                    $result['nodes'] += 1;
                    $this->addToFileList($currentPath, $trimmedRelativePath.$currentName, $fileSize);
                    //MT: SERVER THROTTLE
                    /*  Disable throttle on scan ulti chunking is implementend
                      if ($this->throttleDelayInUs > 0) {
                      usleep($this->throttleDelayInUs);
                      } */
                }
            }
        }
        closedir($handle);
        return $result;
    }

    /**
     * Initializes the file list handles. Handles are set-up as properties for
     * performance improvement. Otherwise each handle would be opened and closed
     * with each path added.
     */
    private function initFileListHandles()
    {
        DUP_PRO_LOG::trace('Inif list files');
        $this->listDirObj->open(true);
        $this->listFileObj->open(true);
    }

    /**
     * Closes file and dir list handles
     */
    private function closeFileListHandles()
    {
        $this->listDirObj->close();
        $this->listFileObj->close();
    }

    public static function isValidEncoding($string)
    {
        return !preg_match('/([\/\*\?><\:\\\\\|]|[^\x20-\x7f])/', $string);
    }

    private function addToDirList($dirPath, $relativePath, $size, $nodes)
    {
        //Dir is not readble remove and flag
        if (!DupProSnapLibOSU::isWindows() && !is_readable($dirPath)) {
            $this->FilterInfo->Dirs->Unreadable[] = $dirPath;
            return;
        }

        // is relative path is empty is the root path
        if (!empty($relativePath) && !DUP_PRO_Secure_Global_Entity::getInstance()->skip_archive_scan) {
            $name = basename($dirPath);

            //Locate invalid directories and warn
            $invalid_encoding = !self::isValidEncoding($name);
            if ($invalid_encoding) {
                $dirPath = Encoding::toUTF8($dirPath);
            }
            $trimmedName = trim($name);
            
            $invalid_name = $invalid_encoding || strlen($dirPath) > PHP_MAXPATHLEN || empty($trimmedName) || $name[strlen($name) - 1] === '.';

            if ($invalid_name) {
                if ($this->global->archive_build_mode != DUP_PRO_Archive_Build_Mode::Shell_Exec) {
                    // only warnings, not removing dir from archive
                    $this->FilterInfo->Dirs->Warning[] = $dirPath;
                }
            }
            
            if ($size > DUPLICATOR_PRO_SCAN_WARN_DIR_SIZE) {
                $this->FilterInfo->Dirs->Size[] = array(
                    'ubytes' => $size,
                    'bytes'  => DUP_PRO_U::byteSize($size, 0),
                    'nodes'  => $nodes,
                    'name'   => $name,
                    'dir'    => pathinfo($relativePath, PATHINFO_DIRNAME),
                    'path'   => $relativePath
                );
            }

            //Check for other WordPress installs
            if ($name === 'wp-admin') {
                $parent_dir = realpath(dirname($dirPath));
                if ($parent_dir != realpath(duplicator_pro_get_root_path())) {
                    if (file_exists("$parent_dir/wp-includes")) {
                        if (file_exists("$parent_dir/wp-config.php")) {
                            // Ensure we aren't adding any critical directories
                            $parent_name = basename($parent_dir);
                            if (($parent_name != 'wp-includes') && ($parent_name != 'wp-content') && ($parent_name != 'wp-admin')) {
                                $this->FilterInfo->Dirs->AddonSites[] = str_replace("\\", '/', $parent_dir);
                            }
                        }
                    }
                }
            }
        }

        $this->DirCount++;
        $this->listDirObj->addEntry($relativePath, $size, $nodes);
    }

    private function addToFileList($filePath, $relativePath, $fileSize)
    {
        if (!is_readable($filePath)) {
            $this->FilterInfo->Files->Unreadable[] = $filePath;
            return;
        }

        if (!DUP_PRO_Secure_Global_Entity::getInstance()->skip_archive_scan) {
            $fileName = basename($filePath);

            //File Warnings
            $invalid_encoding = !self::isValidEncoding($fileName);
            
            $trimmed_name = trim($fileName);
            
            $invalid_name     = $invalid_encoding || strlen($filePath) > PHP_MAXPATHLEN || empty($trimmed_name);
            if ($invalid_encoding) {
                $filePath = Encoding::toUTF8($filePath);
                $fileName = Encoding::toUTF8($fileName);
            }

            if ($invalid_name) {
                if ($this->global->archive_build_mode != DUP_PRO_Archive_Build_Mode::Shell_Exec) {
                    $this->FilterInfo->Files->Warning[] = array(
                        'name' => $fileName,
                        'dir'  => pathinfo($relativePath, PATHINFO_DIRNAME),
                        'path' => $relativePath
                    );
                }
            }

            if ($fileSize > DUPLICATOR_PRO_SCAN_WARN_FILE_SIZE) {
                $this->FilterInfo->Files->Size[] = array(
                    'ubytes' => $fileSize,
                    'bytes'  => DUP_PRO_U::byteSize($fileSize, 0),
                    'nodes'  => 1,
                    'name'   => $fileName,
                    'dir'    => pathinfo($relativePath, PATHINFO_DIRNAME),
                    'path'   => $relativePath
                );
            }
        }

        $this->FileCount++;
        $this->Size += $fileSize;

        $this->listFileObj->addEntry($relativePath, $fileSize, 1);
    }

    /**
     *  Builds a tree for both file size warnings and name check warnings
     *  The trees are used to apply filters from the scan screen
     *
     *  @return null
     */
    private function setTreeFilters()
    {
        //-------------------------
        //SIZE TREE
        //BUILD: File Size tree
        DUP_PRO_LOG::trace('BUILD: File Size tree');

        if (count($this->FilterInfo->Dirs->Size) || count($this->FilterInfo->Files->Size)) {
            $treeObj = new DUP_PRO_Tree_files(ABSPATH, false);

            foreach ($this->FilterInfo->Dirs->Size as $fileData) {
                /*if (DupProSnapLibUtilWp::isWpCore($fileData, DupProSnapLibUtilWp::PATH_RELATIVE, true)) {
                    continue;
                }*/
                $data = array(
                    'is_warning' => true,
                    'size'       => $fileData['bytes'],
                    'ubytes'     => $fileData['ubytes'],
                    'nodes'      => $fileData['nodes'],
                );

                try {
                    $treeObj->addElement($fileData['path'], $data, false);
                }
                catch (Exception $e) {
                    DUP_PRO_Log::trace('Add filter dir size error MSG: '.$e->getMessage());
                }
            }

            foreach ($this->FilterInfo->Files->Size as $fileData) {
                /*if (DupProSnapLibUtilWp::isWpCore($fileData, DupProSnapLibUtilWp::PATH_RELATIVE, true)) {
                    continue;
                }*/
                $data = array(
                    'is_warning' => true,
                    'size'       => $fileData['bytes'],
                    'ubytes'     => $fileData['ubytes'],
                    'nodes'      => 1
                );

                try {
                    $treeObj->addElement($fileData['path'], $data, false);
                }
                catch (Exception $e) {
                    DUP_PRO_Log::trace('Add filter file size error MSG: '.$e->getMessage());
                }
            }

            $treeObj->tree->uasort(array(__CLASS__, 'sortTreeByFolderWarningName'));
            $treeObj->tree->treeTraverseCallback(array($this, 'checkTreeNodesFolder'));
        } else {
            $treeObj = new DUP_PRO_Tree_files(ABSPATH, false);
        }

        $this->FilterInfo->TreeSize = self::treeNodeTojstreeNode($treeObj->tree, true, DUP_PRO_U::esc_html__('No large files found during this scan.'));

        //-------------------------
        //NAME TREE
        //BUILD: Warning tree for file names
        DUP_PRO_LOG::trace('BUILD: Warning tree for file names');

        if (count($this->FilterInfo->Dirs->Warning) || count($this->FilterInfo->Files->Warning)) {
            $treeObj = new DUP_PRO_Tree_files(ABSPATH, false);
            foreach ($this->FilterInfo->Dirs->Warning as $dir) {
                $nodeData = array(
                    'is_warning' => true,
                );

                try {
                    $treeObj->addElement($dir, $nodeData, false);
                }
                catch (Exception $e) {
                    DUP_PRO_Log::trace('Add filter dir utf8 error MSG: '.$e->getMessage());
                }
            }

            foreach ($this->FilterInfo->Files->Warning as $fileData) {
                $nodeData = array(
                    'is_warning' => true
                );
                try {
                    $treeObj->addElement($fileData['path'], $nodeData, false);
                }
                catch (Exception $e) {
                    DUP_PRO_Log::trace('Add filter file utf8 error MSG: '.$e->getMessage());
                }
            }

            $treeObj->tree->uasort(array(__CLASS__, 'sortTreeByFolderWarningName'));
            $treeObj->tree->treeTraverseCallback(array($this, 'checkTreeNodesFolder'));
        } else {
            $treeObj = new DUP_PRO_Tree_files(ABSPATH, false);
        }

        $this->FilterInfo->TreeWarning = self::treeNodeTojstreeNode($treeObj->tree, true, DUP_PRO_U::esc_html__('No file/directory name warnings found.'));
        DUP_PRO_LOG::trace(' END');
        return true;
    }

    /**
     *
     * @param DUP_PRO_Tree_files_node $a
     * @param DUP_PRO_Tree_files_node $b
     */
    public static function sortTreeByFolderWarningName($a, $b)
    {
        // check sort by path type
        if ($a->isDir && !$b->isDir) {
            return -1;
        } else if (!$a->isDir && $b->isDir) {
            return 1;
        } else {
            // sort by warning
            if (
                (isset($a->data['is_warning']) && $a->data['is_warning'] == true) &&
                (!isset($b->data['is_warning']) || $b->data['is_warning'] == false)
            ) {
                return -1;
            } else if (
                (!isset($a->data['is_warning']) || $a->data['is_warning'] == false) &&
                (isset($b->data['is_warning']) && $b->data['is_warning'] == true)
            ) {
                return 1;
            } else {
                // sort by name
                return strcmp($a->name, $b->name);
            }
        }
    }

    /**
     *
     * @param DUP_PRO_Tree_files_node $node
     */
    public function checkTreeNodesFolder($node)
    {
        $node->data['is_core']     = 0;
        $node->data['is_filtered'] = 0;

        if ($node->isDir) {
            $node->data['is_core'] = (int) DupProSnapLibUtilWp::isWpCore($node->fullPath, DupProSnapLibUtilWp::PATH_FULL);

            if (in_array($node->fullPath, $this->FilterDirsAll)) {
                $node->data['is_filtered'] = 1;
            }

            if (!isset($node->data['bytes'])) {
                $dirData             = $this->listDirObj->getEntryFromPath(DupProSnapLibUtilWp::getRelativePathFromFull($node->fullPath));
                $node->data['size']  = DUP_PRO_U::byteSize($dirData['s'], 0);
                $node->data['nodes'] = $dirData['n'];
            }
        } else {
            $ext = pathinfo($node->fullPath, PATHINFO_EXTENSION);

            if (in_array($ext, $this->FilterExtsAll)) {
                $node->data['is_filtered'] = 1;
            } else if (in_array($node->fullPath, $this->FilterFilesAll)) {
                $node->data['is_filtered'] = 1;
            }

            if (!isset($node->data['size'])) {
                $node->data['size'] = false;
            }
            if (!isset($node->data['nodes'])) {
                $node->data['nodes'] = 1;
            }

            /*
             * provision to disable the core files to be excluded.
             * 
             * $node->data['is_core'] = (int) DupProSnapLibUtilWp::isWpCore($node->fullPath , DupProSnapLibUtilWp::PATH_FULL);
             */
        }
    }

    /**
     * @param DUP_PRO_Tree_files_node $node
     * 
     * @return array
     */
    public static function treeNodeTojstreeNode($node, $root = false, $notFoundText = '', $addFullLoaded = true)
    {
        $name = $root ? $node->fullPath : $node->name;
        $isCore = isset($node->data['is_core']) && $node->data['is_core'];
        $isFiltered = isset($node->data['is_filtered']) && $node->data['is_filtered'];

        if (isset($node->data['size'])) {
            $name .= ' <span class="size" >'.(($node->data['size'] !== false && !$isFiltered) ? $node->data['size'] : '&nbsp;').'</span>';
        }

        if (isset($node->data['nodes'])) {
            $name .= ' <span class="nodes" >'.(($node->data['nodes'] > 1 && !$isFiltered) ? $node->data['nodes'] : '&nbsp;').'</span>';
        }

        $li_classes  = '';
        $a_attr      = array();
        $li_attr     = array();
        $rootWarning = false;

        if ($root) {
            $li_classes   .= ' root-node';
            $rootWarnings = count($node->childs) > 0;
        }

        if ($isCore) {
            $li_classes .= ' core-node';
            if ($node->isDir) {
                $a_attr['title'] = DUP_PRO_U::esc_attr__('Core WordPress directories should not be filtered. Use caution when excluding files.');
            }
            $isWraning = false; // never warings for cores files
        } else {
            $isWraning = isset($node->data['is_warning']) && $node->data['is_warning'];
        }

        if ($isWraning) {
            $li_classes .= ' warning-node';
        }

        if ($isFiltered) {
            $li_classes .= ' filtered-node';
            if ($node->isDir) {
                $a_attr['title'] = DUP_PRO_U::esc_attr__('This dir is filtered.');
            } else {
                $a_attr['title'] = DUP_PRO_U::esc_attr__('This file is filtered.');
            }
        }

        if ($addFullLoaded && $node->isDir) {
            $li_attr['data-full-loaded'] = false;
            if (!$root && $node->haveChildren && !$isWraning) {
                $li_classes .= ' warning-childs';
            }
        }

        $li_attr['class'] = $li_classes;

        $result = array(
            //'id'          => $node->id, // will be autogenerated if omitted
            'text'     => $name, // node text
            'fullPath' => $node->fullPath,
            'type'     => $node->isDir ? 'folder' : 'file',
            'state'    => array(
                'opened'            => true, // is the node open
                'disabled'          => false, // is the node disabled
                'selected'          => false, // is the node selected,
                'checked'           => false,
                'checkbox_disabled' => $isCore || $isFiltered
            ),
            'children' => array(), // array of strings or objects
            'li_attr'  => $li_attr, // attributes for the generated LI node
            'a_attr'   => $a_attr   // attributes for the generated A node
        );

        if ($root) {
            if (count($node->childs) == 0) {
                $result['state']['disabled'] = true;
                $result['state']['opened']   = true;
                $result['li_attr']['class']  .= ' no-warnings';
                $result['children'][]        = array(
                    //'id'          => 'no_child_founds',
                    'text'  => $notFoundText, // node text
                    'type'  => 'info-text',
                    'state' => array(
                        'opened'            => false, // is the node open
                        'disabled'          => true, // is the node disabled
                        'selected'          => false, // is the node selected,
                        'checked'           => false,
                        'checkbox_disabled' => true
                    )
                );
            } else {
                $result['li_attr']['class'] .= ' warning-childs';
            }
        } else {
            if (count($node->childs) == 0) {
                $result['children']        = $node->haveChildren;
                $result['state']['opened'] = false;
            }
        }

        foreach ($node->childs as $child) {
            $result['children'][] = self::treeNodeTojstreeNode($child, false, '', $addFullLoaded);
        }

        return $result;
    }

    public function getWPConfigFilePath() { 
        $wpconfig_filepath = ''; 
        $root_path = duplicator_pro_get_root_path();
        if (file_exists($root_path . '/wp-config.php')) { 
            $wpconfig_filepath = $root_path . '/wp-config.php'; 
        } elseif (@file_exists(dirname($root_path) . '/wp-config.php') && !@file_exists(dirname($root_path) . '/wp-settings.php')) { 
            $wpconfig_filepath = dirname($root_path) . '/wp-config.php'; 
        } 
        return $wpconfig_filepath; 
	}
	
	public static function isOuterWPContentDir()
    {
        static $isOuter = null;

        if (is_null($isOuter)) {
            if (0 !== strpos(wp_normalize_path(WP_CONTENT_DIR), wp_normalize_path(ABSPATH))) {
                $isOuter = true;
            } else {
                $isOuter = false;
            }
        }
        return $isOuter;
    }

    public function wpContentDirNormalizePath() {
		if (!isset($this->wpContentDirNormalizePath)) {
			$this->wpContentDirNormalizePath = trailingslashit(wp_normalize_path(WP_CONTENT_DIR));
		}
		return $this->wpContentDirNormalizePath;
    }
    
	public function getLocalDirPath($dir, $basePath = '') {
		$wpContentDirNormalizePath = $this->wpContentDirNormalizePath();
		$compressDir = rtrim(wp_normalize_path(DUP_PRO_U::safePath($this->PackDir)), '/');
			
        $dir = trailingslashit(wp_normalize_path($dir));
        if (self::isOuterWPContentDir() && 0 === strpos($dir, $wpContentDirNormalizePath)) {
			$newWPContentDirPath = empty($basePath) 
										? 'wp-content/' 
										: $basePath.'wp-content/';
			$emptyDir = ltrim(str_replace($wpContentDirNormalizePath, $newWPContentDirPath, $dir), '/');
        } else {
            $emptyDir = ltrim(str_replace($compressDir, $basePath, $dir), '/');
        }
        return $emptyDir;
    }

    public function getLocalFilePath($file, $basePath = '') {
		$wpContentDirNormalizePath = $this->wpContentDirNormalizePath();
		$compressDir = rtrim(wp_normalize_path(DUP_PRO_U::safePath($this->PackDir)), '/');
        $file = wp_normalize_path($file);
        if (self::isOuterWPContentDir() && 0 === strpos($file, $wpContentDirNormalizePath)) {
			$newWPContentDirPath = empty($basePath) 
										? 'wp-content/' 
										: $basePath.'wp-content/';
            $localFileName = ltrim(str_replace($wpContentDirNormalizePath, $newWPContentDirPath, $file), '/');
        } else {
            $localFileName = ltrim(str_replace($compressDir, $basePath, $file), '/');
        }
        return $localFileName;
    }
}
