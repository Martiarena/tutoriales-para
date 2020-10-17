<?php
/**
 * 
 * Standard: PSR-2
 * @link http://www.php-fig.org/psr/psr-2 Full Documentation
 *
 * @package SC\DUPX
 *
 */
defined('ABSPATH') || defined('DUPXABSPATH') || exit;

/**
 * View s3 functions
 */
class DUPX_View_S2
{

    public static function modeButtons()
    {
        if (self::skipDbTest()) {
            return;
        }
        ?>
        <div class="s2-btngrp">
            <input id="s2-basic-btn" type="button" value="Basic" class="active" onclick="DUPX.togglePanels('basic')" />
            <input id="s2-cpnl-btn" type="button" value="cPanel" class="in-active" onclick="DUPX.togglePanels('cpanel')" />
        </div>
        <?php
    }

    public static function basicPanel()
    {
        $state         = DUPX_InstallerState::getInstance();
        $paramsManager = DUPX_Paramas_Manager::getInstance();

        if (self::skipDbTest()) {
            $dbhost        = null;
            $dbname        = null;
            $dbuser        = null;
            $dbpass        = null;
            $skipOverwrite = true;
        } else {
            if ($state->getMode() === DUPX_InstallerState::MODE_STD_INSTALL) {
                $dbhost = $GLOBALS['DUPX_AC']->dbhost;
                $dbname = $GLOBALS['DUPX_AC']->dbname;
                $dbuser = $GLOBALS['DUPX_AC']->dbuser;
                $dbpass = $GLOBALS['DUPX_AC']->dbpass;
            } else {
                $dbhost = null;
                $dbname = null;
                $dbuser = null;
                $dbpass = null;
            }
            $skipOverwrite = false;
        }
        ?>
        <div class="hdr-sub1 toggle-hdr close" data-type="toggle" data-target="#s2-db-basic">
            <a href="javascript:void(0)"><i class="fa fa-minus-square"></i>Setup</a>
        </div>
        <div id="s2-db-basic" class="hdr-sub1-area" >
            <?php if (!$skipOverwrite && $state->getMode() === DUPX_InstallerState::MODE_OVR_INSTALL) : ?>
                <div id="s2-db-basic-overwrite">
                    <b style='color:maroon'>Ready to connect to existing sites database? </b><br/>
                    <div class="warn-text">
                        The existing sites database settings are ready to be applied below.  If you want to connect to this database and replace all its data then
                        click the 'Apply button' to set the placeholder values.  To use different database settings click the 'Reset button' to clear and set new values.
                        <br/><br/>

                        <i><i class="fas fa-exclamation-triangle fa-sm"></i> Warning: Please note that reusing an existing site's database will <u>overwrite</u> all of its data. If you're not 100% sure about
                            using these database settings, then create a new database and use the new credentials instead.</i>
                    </div>

                    <div class="btn-area">
                        <input type="button" value="Apply" class="overwrite-btn" onclick="DUPX.checkOverwriteParameters()">
                        <input type="button" value="Reset" class="overwrite-btn" onclick="DUPX.resetParameters()">
                    </div>
                </div>
            <?php endif; ?>

            <div class="dupx-opts" >
                <?php
                $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_DB_ACTION);
                $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_DB_HOST, $dbhost);
                $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_DB_NAME, $dbname);
                $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_DB_USER, $dbuser);
                $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_DB_PASS, $dbpass);
                ?>
            </div>
        </div>
        <?php
    }

    public static function skipDbTest()
    {
        $paramsManager = DUPX_Paramas_Manager::getInstance();
        if ($paramsManager->getValue(DUPX_Paramas_Manager::PARAM_DB_TEST_OK) &&
            !$paramsManager->isHtmlInput(DUPX_Paramas_Manager::PARAM_DB_HOST) &&
            !$paramsManager->isHtmlInput(DUPX_Paramas_Manager::PARAM_DB_NAME) &&
            !$paramsManager->isHtmlInput(DUPX_Paramas_Manager::PARAM_DB_USER) &&
            !$paramsManager->isHtmlInput(DUPX_Paramas_Manager::PARAM_DB_PASS)) {
            return true;
        } else {
            return false;
        }
    }

    public static function basicValitadion()
    {
        if (self::skipDbTest()) {
            $skipTest         = true;
            $testDisabled     = 'disabled';
            $continueDisabled = '';
            $disabled         = '';
        } else {
            $skipTest         = false;
            $testDisabled     = '';
            $continueDisabled = 'disabled';
            $disabled         = 'disabled="true"';
        }
        ?>
        <!-- =========================================
        BASIC: DB VALIDATION -->
        <?php
        if (!$skipTest) {
            ?>
            <div class="hdr-sub1 toggle-hdr close" data-type="toggle" data-target="#s2-dbtest-area-basic">
                <a href="javascript:void(0)"><i class="fa fa-minus-square"></i>Validation</a>
            </div>
            <div id="s2-dbtest-area-basic" class="hdr-sub1-area s2-dbtest-area">
                <div id="s2-dbrefresh-basic">
                    <a href="javascript:void(0)" onclick="DUPX.testDBConnect()"><i class="fa fa-sync fa-sm"></i> Retry Test</a>
                </div>
                <div style="clear:both"></div>
                <div id="s2-dbtest-hb-basic" class="s2-dbtest-hb">
                    <div class="message">
                        To continue click the 'Test Database' button <br/>
                        to	perform a database integrity check.
                    </div>
                </div>
            </div>
        <?php }
        ?>
        <div class="footer-buttons">
            <div class="content-left">
            </div>
            <div class="content-right" >
                <?php
                if (!$skipTest) {
                    ?>
                    <button id="s2-dbtest-btn-basic" type="button" onclick="DUPX.testDBConnect()" class="default-btn <?php echo $testDisabled; ?>" />
                    <i class="fas fa-database fa-sm"></i> Test Database
                    </button>
                <?php }
                ?>
                <button id="s2-next-btn-basic" type="button" onclick="DUPX.confirmDeployment()" class="default-btn <?php echo $continueDisabled; ?>" <?php echo $disabled; ?>
                        title="The 'Test Database' connectivity requirements must pass to continue with install!">
                    Next <i class="fa fa-caret-right"></i>
                </button>
            </div>
        </div>
        <?php
    }

    public static function cpanlePanel()
    {
        $paramsManager = DUPX_Paramas_Manager::getInstance();
        ?>
        <div class="hdr-sub1 toggle-hdr close" data-type="toggle" data-target="#s2-cpnl-area">
            <a href="javascript:void(0)"><i class="fa fa-minus-square"></i> cPanel Login: </a>
            <a id="s2-cpnl-status-msg" href="javascript:void(0)" onclick="$('#s2-cpnl-status-details').toggle()"></a>
        </div>

        <div id="s2-cpnl-area" class="hdr-sub1-area dupx-opts">
            <?php
            $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_CPNL_HOST);
            $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_CPNL_USER);
            $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_CPNL_PASS);
            ?>
            <?php /*
              <table class="dupx-opts">
              <tr>
              <td>Host:</td>
              <td>
              <input type="text" name="cpnl-host" id="cpnl-host" required="true" value="<?php echo $GLOBALS['DUPX_AC']->cpnl_host; ?>" placeholder="cPanel url" />
              <a id="cpnl-host-get-lnk" href="javascript:DUPX.getcPanelURL('cpnl-host')" style="font-size:12px">get</a>
              <div id="cpnl-host-warn">
              Caution: The cPanel host name and URL in the browser address bar do not match, in rare cases this may be intentional.
              Please be sure this is the correct server to avoid data loss.
              </div>
              </td>
              </tr>
              <tr>
              <td>Username:</td>
              <td>
              <!-- Pattern: "/^[a-zA-Z0-9-_]+$/" was to restrictive -->
              <input type="text" name="cpnl-user" id="cpnl-user" required="true" data-parsley-pattern="/^[\w.-~]+$/" value="<?php echo DUPX_U::esc_attr($GLOBALS['DUPX_AC']->cpnl_user); ?>" placeholder="cPanel username" />
              </td>
              </tr>
              <tr>
              <td>Password:</td>
              <td>
              <?php
              DUPX_U_Html::inputPasswordToggle('cpnl-pass', 'cpnl-pass', array(),
              array(
              'placeholder' => 'cPanel password',
              'value'       => $GLOBALS['DUPX_AC']->cpnl_pass,
              'required'    => 'true'
              ));
              ?>
              </td>
              </tr>
              </table> */
            ?>

            <div id="s2-cpnl-connect">
                <input type="button" id="s2-cpnl-connect-btn" class="default-btn" onclick="DUPX.cpnlConnect()" value="Connect" />
                <input type="button" id="s2-cpnl-change-btn" onclick="DUPX.cpnlToggleLogin()" value="Change" class="default-btn"  style="display:none" />
                <div id="s2-cpnl-status-details" style="display:none">
                    <div id="s2-cpnl-status-details-msg">
                        Please click the connect button to connect to your cPanel.
                    </div>
                    <small style="font-style: italic">
                        <a href="javascript:void()" onclick="$('#s2-cpnl-status-details').hide()">[Hide Message]</a> &nbsp;
                        <a href='https://snapcreek.com/wordpress-hosting/' target='_blank'>[cPanel Supported Hosts]</a>
                    </small>
                </div>
            </div>
        </div>
        <?php
    }

    public static function cpanelSetup()
    {
        $paramsManager = DUPX_Paramas_Manager::getInstance();
        ?>
        <!-- =========================================
            CPNL DB SETUP -->
        <div class="hdr-sub1 toggle-hdr close" data-type="toggle" data-target="#s2-cpnl-db-opts">
            <a href="javascript:void(0)"><i class="fa fa-minus-square"></i>Setup</a>
            <span id="s2-cpnl-db-opts-lbl">cPanel login required to enable</span>
        </div>
        <div id="s2-cpnl-db-opts" class="hdr-sub1-area dupx-opts">
            <input type="hidden" name="cpnl-dbname-result" id="cpnl-dbname-result" />
            <input type="hidden" name="cpnl-dbuser-result" id="cpnl-dbuser-result" />
            <?php
            $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_CPNL_DB_ACTION);
            $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_CPNL_DB_HOST);
            $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_CPNL_PREFIX);
            ?>
            <div class="param-wrapper" >
                <?php
                $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_CPNL_DB_NAME_SEL);
                $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_CPNL_DB_NAME_TXT);
                ?>
            </div>
            <div class="param-wrapper" >
                <?php
                $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_CPNL_DB_USER_SEL);
                $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_CPNL_DB_USER_TXT);
                $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_CPNL_DB_USER_CHK);
                ?>
            </div>
            <?php
            $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_CPNL_DB_PASS);
            ?>
        </div>
        <?php return; ?>

        <table id="s2-cpnl-db-opts" class="dupx-opts">
            <tr>
                <td>Action:</td>
                <td>
                    <select name="cpnl-dbaction" id="cpnl-dbaction">
                        <option value="create">Create New Database</option>
                        <option value="empty">Connect and Remove All Data</option>
                        <option value="rename">Connect and Backup Any Existing Data</option>
                        <option value="manual">Manual SQL Execution (Advanced)</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Host:</td>
                <td><input type="text" name="cpnl-dbhost" id="cpnl-dbhost" required="true" value="<?php echo DUPX_U::esc_attr($GLOBALS['DUPX_AC']->cpnl_dbhost); ?>" placeholder="localhost" /></td>
            </tr>
            <tr>
                <td>Database:</td>
                <td>
                    <!-- EXISTING CPNL DB -->
                    <div id="s2-cpnl-dbname-area1">
                        <select name="cpnl-dbname-select" 
                                id="cpnl-dbname-select" 
                                required="true" 
                                data-parsley-pattern="^((?!-- Select Database --).)*$"></select>
                        <div class="s2-warning-emptydb">
                            Warning: The selected 'Action' above will remove <u>all data</u> from this database!
                        </div>
                    </div>
                    <!-- NEW CPNL DB -->
                    <div id="s2-cpnl-dbname-area2">
                        <table>
                            <tr>
                                <td id="cpnl-prefix-dbname"></td>
                                <td>

                                    <input type="text" name="cpnl-dbname-txt" id="cpnl-dbname-txt" 
                                           required="true" 
                                           data-parsley-pattern="/^[\w.-~]+$/"
                                           data-parsley-errors-container="#cpnl-dbname-txt-error"
                                           value="<?php echo DUPX_U::esc_attr($GLOBALS['DUPX_AC']->cpnl_dbname); ?>"
                                           placeholder="new or existing database name"  />
                                </td>
                            </tr>
                        </table>
                        <div id="cpnl-dbname-txt-error"></div>
                    </div>
                    <div class="s2-warning-renamedb">
                        Notice: The selected 'Action' will rename <u>all existing tables</u> from the database name above with a prefix '<?php echo $GLOBALS['DB_RENAME_PREFIX']; ?>'.
                        The prefix is only applied to existing tables and not the new tables that will be installed.
                    </div>
                    <div class="s2-warning-manualdb">
                        Notice: The 'Manual SQL execution' action will prevent the SQL script in the archive from running. The database name above should already be
                        pre-populated with data which will be updated in the next step.  No data in the database will be modified until after Step 2 runs.
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="checkbox" name="cpnl-dbuser-chk" id="cpnl-dbuser-chk" value="1" style="margin-left:5px" /> <label for="cpnl-dbuser-chk">Create New Database User</label> </td>
            </tr>
            <tr>
                <td>User:</td>
                <td>
                    <div id="s2-cpnl-dbuser-area1">
                        <select name="cpnl-dbuser-select" id="cpnl-dbuser-select" required="true" 
                                data-parsley-pattern="^((?!-- Select User --).)*$"></select>
                    </div>
                    <div id="s2-cpnl-dbuser-area2">
                        <table>
                            <tr>
                                <td id="cpnl-prefix-dbuser"></td>
                                <td>
                                    <input type="text" 
                                           name="cpnl-dbuser-txt"
                                           id="cpnl-dbuser-txt" 
                                           required="true" 
                                           data-parsley-pattern="/^[a-zA-Z0-9-_]+$/"
                                           data-parsley-errors-container="#cpnl-dbuser-txt-error" 
                                           data-parsley-cpnluser="16"
                                           value="<?php echo DUPX_U::esc_attr($GLOBALS['DUPX_AC']->cpnl_dbuser); ?>" placeholder="valid database username" />
                                </td>
                            </tr>
                        </table>
                        <div id="cpnl-dbuser-txt-error"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Password:</td>
                <td>
                    <?php
                    DUPX_U_Html::inputPasswordToggle('cpnl-dbpass', 'cpnl-dbpass', array(),
                                                     array(
                            'placeholder' => 'valid database user password',
                            'value'       => '',
                            'required'    => 'true'
                    ));
                    ?>
                </td>
            </tr>

        </table>
        <?php
    }

    public static function cpanelValidation()
    {
        ?>
        <!-- =========================================
        CPNL: DB VALIDATION -->
        <div class="hdr-sub1 toggle-hdr close" data-type="toggle" data-target="#s2-dbtest-area-cpnl">
            <a href="javascript:void(0)"><i class="fa fa-minus-square"></i>Validation</a>
        </div>
        <div id='s2-dbtest-area-cpnl' class="hdr-sub1-area s2-dbtest-area">
            <div id="s2-dbrefresh-cpnl">
                <a href="javascript:void(0)" onclick="DUPX.testDBConnect()"><i class="fa fa-sync fa-sm"></i> Retry Test</a>
            </div>
            <div style="clear:both"></div>
            <div id="s2-dbtest-hb-cpnl" class="s2-dbtest-hb">
                <div class="message">
                    To continue click the 'Test Database' button <br/>
                    to	perform a database integrity check for cPanel
                </div>
            </div>
        </div>
        <div class="footer-buttons">
            <div class="content-left">
            </div>
            <div class="content-right" >
                <button id="s2-dbtest-btn-cpnl" type="button" onclick="DUPX.testDBConnect()" class="default-btn" /><i class="fas fa-database fa-sm"></i> Test Database</button>
                <button id="s2-next-btn-cpnl" type="button" onclick="DUPX.confirmDeployment()" class="default-btn disabled" disabled="true"
                        title="The 'Test Database' connectivity requirements must pass to continue with install!">
                    Next <i class="fa fa-caret-right"></i>
            </div>
        </button>
        </div>

        <?php
    }

    public static function basicOptions()
    {
        /**
         * @todo add this
         * 
         * 			<tr>
          <td>Prefix:</td>
          <td>
          <input type="checkbox" name="cpnl_ignore_prefix"  id="cpnl_ignore_prefix" value="1" onclick="DUPX.cpnlPrefixIgnore()" />
          <label for="cpnl_ignore_prefix">Ignore cPanel Prefix</label>
          </td>
          </tr>
         */
        $paramsManager = DUPX_Paramas_Manager::getInstance();
        ?>
        <div class="hdr-sub1 toggle-hdr open" id="s2-opts-hdr-basic" data-type="toggle" data-target="#s2-opts-basic">
            <a href="javascript:void(0)"><i class="fa fa-plus-square"></i>Options</a>
        </div>
        <div id="s2-opts-basic" class="hdr-sub1-area s2-opts no-display">
            <div class="help-target">
        <?php DUPX_View_Funcs::helpIconLink('step2'); ?>
            </div>

            <div class="dupx-opts dupx-advopts">
                <?php
                $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_DB_CHUNK);
                $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_DB_CHARSET_FB);
                $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_DB_CHARSET_FB_VAL);
                $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_DB_COLLATE_FB);
                $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_DB_COLLATE_FB_VAL);
                $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_DB_SPACING);
                ?>
                <div class="param-wrapper" >
                    <?php
                    $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_DB_MYSQL_MODE);
                    $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_DB_MYSQL_MODE_OPTS);
                    ?>
                </div>
                <?php
                $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_DB_VIEW_CREATION);
                $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_DB_PROC_CREATION);
                $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_DB_CHARSET);
                $paramsManager->getHtmlFormParam(DUPX_Paramas_Manager::PARAM_DB_COLLATE);
                ?>
            </div>
        </div>
        <?php
    }
}