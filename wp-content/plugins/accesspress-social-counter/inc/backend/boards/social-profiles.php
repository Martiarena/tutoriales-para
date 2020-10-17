<div class="apsc-boards-tabs" id="apsc-board-social-profile-settings">
     <div class="apsc-tab-wrapper">
          <!---Facebook-->
          <div class="apsc-option-outer-wrapper">
               <h4><?php _e( 'Facebook', 'accesspress-social-counter' ) ?></h4>
               <div class="apsc-option-inner-wrapper">
                    <label><?php _e( 'Display Counter', 'accesspress-social-counter' ) ?></label>
                    <div class="apsc-option-field">
                         <label>
                              <input type="checkbox" name="social_profile[facebook][active]" value="1" class="apsc-counter-activation-trigger" <?php if ( isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'active' ] ) ) { ?>checked="checked"<?php } ?>/><?php _e( 'Show/Hide', 'accesspress-social-counter' ); ?>
                         </label>
                    </div>
               </div>
               <div class="apsc-option-inner-wrapper ">
                    <label for="apsc-facebook-method">
                         <?php _e( 'Facebook Counter Extraction', 'accesspress-social-counter' ) ?>
                    </label>
                    <div class="apsc-option-field">
                         <label class="apsc-fb-method">
                              <input type="radio" name="social_profile[facebook][method]" value="1" class="apss-facebook-method" id="" <?php echo isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] ) && $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] == '1' ? ' checked="checked" ' : '1111'; ?>/>
                              <?php _e( 'Method 1', 'accesspress-social-counter' ); ?>
                         </label>
                         <div class="apsc-option-note"><?php _e( 'Method 1 you will require to enter your app id and app secret. Due to recent changes in Facebook API, most of our clients have been complaining that "Method 1" does not work.  ', 'accesspress-social-counter' ); ?></div>

                         <label class="apsc-fb-method">
                              <input type="radio" name="social_profile[facebook][method]" value="2" class="apss-facebook-method" id="" <?php echo isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] ) && $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] == '2' ? 'checked="checked"' : '2222'; ?>/>
                              <?php _e( 'Method 2', 'accesspress-social-counter' ); ?>
                         </label>
                         <div class="apsc-option-note"><?php _e( 'Method 2 makes use of a third party API "WidgetPack" to do the work. Please login to your Facebook account using the "FB Connect" button and connect WidgetPack to Facebook. Once done, you will notice that the image and name of your page will be displayed beneath the "FB Connect" button in the plugin settings. When you click on it, All the details will automatically be entered in the fields beneath the "FB Connect Button". Note: Your FB login details will NOT be stored.', 'accesspress-social-counter' ); ?></div>
                    </div>
               </div>
               <div class="apss-facebook-method-1" id="apss-facebook-method-1" <?php echo ( isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] ) && $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] == '1' ) ? 'style=display:block;' : 'style=display:none;'; ?>>
                    <div class="apsc-option-extra">
                         <div class="apsc-option-inner-wrapper">
                              <label><?php _e( 'Facebook Page ID', 'accesspress-social-counter' ); ?></label>
                              <div class="apsc-option-field">
                                   <input type="text" name="social_profile[facebook][page_id]" value="<?php echo esc_attr( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'page_id' ] ); ?>"/>
                                   <div class="apsc-option-note"><?php _e( 'Please enter the page ID or page name.For example:If your page url is https://www.facebook.com/AccessPressThemes then your page ID is AccessPressThemes.', 'accesspress-social-counter' ); ?>
                                   </div>

                              </div>
                         </div>
                         <div class="apsc-option-inner-wrapper">
                              <label><?php _e( 'Facebook App ID', 'accesspress-social-counter' ); ?></label>
                              <div class="apsc-option-field">
                                   <input type="text" name="social_profile[facebook][app_id]" value="<?php echo isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'app_id' ] ) ? esc_attr( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'app_id' ] ) : ''; ?>"/>
                                   <div class="apsc-option-note"><?php _e( 'Please go to <a href="https://developers.facebook.com/" target="_blank">https://developers.facebook.com/</a> and create an app and get the App ID', 'accesspress-social-counter' ); ?>
                                   </div>
                              </div>
                         </div>
                         <div class="apsc-option-inner-wrapper">
                              <label><?php _e( 'Facebook App Secret', 'accesspress-social-counter' ); ?></label>
                              <div class="apsc-option-field">
                                   <input type="text" name="social_profile[facebook][app_secret]" value="<?php echo isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'app_secret' ] ) ? esc_attr( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'app_secret' ] ) : ''; ?>"/>
                                   <div class="apsc-option-note"><?php _e( 'Please go to <a href="https://developers.facebook.com/" target="_blank">https://developers.facebook.com/</a> and create an app and get the App Secret', 'accesspress-social-counter' ); ?>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="apss-facebook-method-2" id="apss-facebook-method-2" <?php echo ( isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] ) && $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] == '2' ) ? 'style=display:block;' : 'style=display:none;'; ?>>
                    <style>
                         .apsc-main-wrap .apsc-fb-pages-list{
                              width: 60%;
                         }

                         .apsc-fb-pages-list .apsc-page:hover
                         {
                              pointer: cusor;
                              background-color: #eee;
                         }

                         .apsc-fb-pages-list .apsc-page .apsc-page-photo
                         {
                              float:left;
                         }
                         .apsc-fb-pages-list .apsc-page .apsc-page-name
                         {
                              width: 50%;
                              float: left;
                              margin-left: 5px;
                         }
                         .apsc-page-photo{
                              height: 55px;
                              width:55px;
                         }

                         .apsc-fb-pages-list .apsc-page {
                              width: 25%;
                              margin-top: 10px;
                              float: left;
                              display: flex;
                              -webkit-align-items: center;
                              align-items: center;
                              cursor: pointer;
                              margin-right: 20px;
                         }
                    </style>
                    <div class="apsc-option-inner-wrapper apsc-row-even">
                         <label><?php _e( 'Facebook Login', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <button type="button" id="apsc_fb_connect"><?php _e( 'FB Connect', 'accesspress-social-counter' ); ?></button>
                              <div class="apsc-fb-pages-list"></div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper apsc-row-even">
                         <label><?php _e( 'Page Name', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" id="" class="apsc-page-name" name="social_profile[facebook][page_name]" value="<?php (isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'page_name' ] ) && ! empty( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'page_name' ] )) ? esc_attr_e( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'page_name' ] ) : ''; ?>" class="apsc-page-name" placeholder="<?php _e( 'Page Name', 'accesspress-social-counter' ); ?>" readonly />
                              <div class="apsc-option-note"><?php _e( ' ', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper apsc-row-even">
                         <label><?php _e( 'Page ID', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" class="apsc-page-id" id="" name="social_profile[facebook][fb_page_id]" value="<?php (isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'fb_page_id' ] ) && ! empty( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'fb_page_id' ] )) ? esc_attr_e( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'fb_page_id' ] ) : ''; ?>" class="apsc-page-name" placeholder="<?php _e( 'Page ID', 'accesspress-social-counter' ); ?>" readonly />
                              <div class="apsc-option-note"><?php _e( ' ', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper apsc-row-even">
                         <label><?php _e( 'Access Token', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" id="" class="apsc-page-token" name="social_profile[facebook][access_token]" value="<?php (isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'access_token' ] ) && ! empty( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'access_token' ] )) ? esc_attr_e( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'access_token' ] ) : ''; ?>" class="apsc-page-name" placeholder="<?php _e( 'Access Token', 'accesspress-social-counter' ); ?>" readonly />
                              <div class="apsc-option-note"><?php _e( ' ', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-widget-id="<?php echo 'apss-facebook-method-2'; ?>" onload="fbrev_init({widgetId: this.getAttribute('data-widget-id')})" style="display:none">
               </div>
               <div class="apsc-option-inner-wrapper apsc-row-odd">
                    <label><?php _e( 'Default Count', 'accesspress-social-counter' ); ?></label>
                    <div class="apsc-option-field">
                         <input type="text" name="social_profile[facebook][default_count]" value="<?php
                         if ( isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'default_count' ] ) ) {
                              echo esc_attr($apsc_settings[ 'social_profile' ][ 'facebook' ][ 'default_count' ]);
                         } else {
                              echo '';
                         }
                         ?>"/>
                         <div class="apsc-option-note"><?php _e( 'Please enter the default count to show instead of 0 when API\'s are not available.', 'accesspress-social-counter' ); ?></div>
                    </div>
               </div>
               <div class="apsc-extra-note"><?php _e( 'Please use: [aps-get-count social_media="facebook"] to get the Facebook Count only.You can also pass count_format parameter too in this shortcode to format your count.Formats are "short" for abbreviated format and "comma" for comma separated formats.' ); ?></div>
          </div>
          <!---Facebook-->

          <!--Twitter-->
          <div class="apsc-option-outer-wrapper">
               <h4><?php _e( 'Twitter', 'accesspress-social-counter' ) ?></h4>
               <div class="apsc-option-inner-wrapper">
                    <label><?php _e( 'Display Counter', 'accesspress-social-counter' ) ?></label>
                    <div class="apsc-option-field">
                         <label>
                              <input type="checkbox" name="social_profile[twitter][active]" value="1" class="apsc-counter-activation-trigger" <?php if ( isset( $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'active' ] ) ) { ?>checked="checked"<?php } ?>/><?php _e( 'Show/Hide', 'accesspress-social-counter' ); ?>
                         </label>
                    </div>
               </div>
               <div class="apsc-option-extra">
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Twitter Username', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[twitter][username]" value="<?php echo esc_attr( $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'username' ] ); ?>"/>
                              <div class="apsc-option-note">
                                   <?php _e( 'Please enter the twitter username.For example:apthemes', 'accesspress-social-counter' ); ?>
                              </div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Twitter Consumer Key', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[twitter][consumer_key]" value="<?php echo esc_attr( $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'consumer_key' ] ); ?>"/>
                              <div class="apsc-option-note">
                                   <?php _e( 'Please create an app on Twitter through this link:', 'accesspress-social-counter' ); ?><a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps</a><?php _e( ' and get this information.' ); ?>
                              </div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Twitter Consumer Secret', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[twitter][consumer_secret]" value="<?php echo esc_attr( $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'consumer_secret' ] ); ?>"/>
                              <div class="apsc-option-note">
                                   <?php _e( 'Please create an app on Twitter through this link:', 'accesspress-social-counter' ); ?>
                                   <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps </a>
                                   <?php _e( ' and get this information.' ); ?>
                              </div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Twitter Access Token', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[twitter][access_token]" value="<?php echo esc_attr( $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'access_token' ] ); ?>"/>
                              <div class="apsc-option-note">
                                   <?php _e( 'Please create an app on Twitter through this link:', 'accesspress-social-counter' ); ?>
                                   <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps </a>
                                   <?php _e( ' and get this information.' ); ?>
                              </div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Twitter Access Token Secret', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[twitter][access_token_secret]" value="<?php echo esc_attr( $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'access_token_secret' ] ); ?>"/>
                              <div class="apsc-option-note">
                                   <?php _e( 'Please create an app on Twitter through this link:', 'accesspress-social-counter' ); ?>
                                   <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps </a>
                                   <?php _e( ' and get this information.' ); ?>
                              </div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper apsc-row-odd">
                         <label><?php _e( 'Default Count', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[twitter][default_count]" value="<?php echo isset( $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'default_count' ] ) && $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'default_count' ] != '' ? esc_attr($apsc_settings[ 'social_profile' ][ 'twitter' ][ 'default_count' ]) : ''; ?>"/>
                              <div class="apsc-option-note"><?php _e( 'Please enter the default count to show instead of 0 when API\'s are not available.', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
               </div>
               <div class="apsc-extra-note"><?php _e( 'Please use: [aps-get-count social_media="twitter"] to get the Twitter Count only.You can also pass count_format parameter too in this shortcode to format your count.Formats are "short" for abbreviated format and "comma" for comma separated formats.' ); ?></div>
          </div>
          <!--Twitter-->

          <!--Instagram-->
          <div class="apsc-option-outer-wrapper">
              <div class="apsc-extra-note">
                       <p><?php _e('Note: After the latest changes in instagram api, your instagram account should be business account in order to get follower count.
                                   According to this changes, you need to go to <a href="https://developers.facebook.com">this</a> link to create app. Setup facebook login and put (https://demo.accesspressthemes.com/wordpress-plugins/insta-feed/graph/access_token.php) as valid oauth redirect url.Then, enter
                                   your app id and app secret in backend and first save it.Then, click on get access token.After few steps of selecting
                                   your facebook page and instagram account you should be redirected to backend with your user id and access token', 'accesspress-social-counter'); ?></p>
                   </div>
               <h4><?php _e( 'Instagram', 'accesspress-social-counter' ) ?></h4>
               <div class="apsc-option-inner-wrapper">
                    <label><?php _e( 'Display Counter', 'accesspress-social-counter' ) ?></label>
                    <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[instagram][active]" value="1" class="apsc-counter-activation-trigger" <?php if ( isset( $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'active' ] ) ) { ?>checked="checked"<?php } ?>/><?php _e( 'Show/Hide', 'accesspress-social-counter' ); ?></label></div>
               </div>
               <div class="apsc-option-extra">
                   
                   <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Facebook App ID', 'accesspress-social-counter'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[instagram][app_id]" placeholder="Enter your facebook app id" value="<?php echo isset($apsc_settings['social_profile']['instagram']['app_id']) && $apsc_settings['social_profile']['instagram']['app_id'] != '' ? esc_attr($apsc_settings['social_profile']['instagram']['app_id']) : ''; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter your facebook app id from developers page.', 'accesspress-social-counter'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Facebook App Secret', 'accesspress-social-counter'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[instagram][app_secret]" placeholder="Enter your facebook app secret" value="<?php echo isset($apsc_settings['social_profile']['instagram']['app_secret']) ? esc_attr($apsc_settings['social_profile']['instagram']['app_secret']) : ''; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter your facebook app secret from developers page.', 'accesspress-social-counter'); ?></div>
                    </div>
                </div>
                   <?php
                //$dribbble_url='https://dribbble.com/oauth/authorize?'.$apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'client_id' ].'';
                if (isset($apsc_settings['social_profile']['instagram']['app_id'])) {
                    $instagram_app_id = $apsc_settings['social_profile']['instagram']['app_id'];
                } else {
                    $instagram_app_id = '';
                }
                if (isset($apsc_settings['social_profile']['instagram']['app_secret'])) {
                    $instagram_app_secret = $apsc_settings['social_profile']['instagram']['app_secret'];
                } else {
                    $instagram_app_secret = '';
                }
                ?>
                   <div class="apsc-option-inner-wrapper apsc-row-even">
                    <label><?php _e('Get Instagram Access Token', 'accesspress-social-counter'); ?></label>
                    <div class="apsc-option-field">
                        <a target="_self" id="get_token" href="https://demo.accesspressthemes.com/wordpress-plugins/insta-feed/graph/access_token.php?app_id=<?php echo esc_attr($instagram_app_id);?>&app_secret=<?php echo esc_attr($instagram_app_secret); ?>&back_url=<?php echo admin_url('admin.php?page=ap-social-counter'); ?>">Get access token</a>
                        <div class="apsc-option-note"><?php _e('Note: After entering your app id and app secret remember to save changes first,then only proceed toward getting access token.', 'accesspress-social-counter'); ?>
                        </div>
                    </div>
                </div>
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Instagram Username', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[instagram][username]" value="<?php echo esc_attr( $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'username' ] ); ?>"/>
                              <div class="apsc-option-note"><?php _e( 'Please enter the instagram username', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Instagram User ID', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[instagram][user_id]" value="<?php
                        if (isset($_GET["instaid"])) {
                            echo esc_attr($_GET["instaid"]);
                        } elseif (isset($apsc_settings['social_profile']['instagram']['user_id'])) {
                            echo esc_attr($apsc_settings['social_profile']['instagram']['user_id']);
                        } else {
                            echo '';
                        }
                        ?>"/>
                              <div class="apsc-option-note"><?php _e( 'Note: If not loaded automatically after clicking Get Access Token button provided above, please check if you have followed all steps properly.', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Instagram Access Token', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[instagram][access_token]" value="<?php
                        if (isset($_GET["access_token"])) {
                            echo esc_attr($_GET["access_token"]);
                        } elseif (isset($apsc_settings['social_profile']['instagram']['access_token']) && $apsc_settings['social_profile']['instagram']['access_token'] != '') {
                            echo esc_attr($apsc_settings['social_profile']['instagram']['access_token']);
                        } else {
                            echo '';
                        }
                        ?>"/>
                              <div class="apsc-option-note"><?php _e( 'Note: If not loaded automatically after clicking Get Access Token button provided above, please check if you have followed all steps properly.', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper apsc-row-odd">
                         <label><?php _e( 'Default Count', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[instagram][default_count]" value="<?php echo isset( $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'default_count' ] ) && $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'default_count' ] != '' ? esc_attr($apsc_settings[ 'social_profile' ][ 'instagram' ][ 'default_count' ]) : ''; ?>"/>
                              <div class="apsc-option-note"><?php _e( 'Please enter the default count to show instead of 0 when API\'s are not available.', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
               </div>
               <div class="apsc-extra-note"><?php _e( 'Please use: [aps-get-count social_media="instagram"] to get the Instagram Count only.You can also pass count_format parameter too in this shortcode to format your count.Formats are "short" for abbreviated format and "comma" for comma separated formats.' ); ?></div>
          </div>
          <!--Instagram-->

          <!--Youtube-->
          <div class="apsc-option-outer-wrapper">
               <h4><?php _e( 'Youtube', 'accesspress-social-counter' ) ?></h4>
               <div class="apsc-option-inner-wrapper">
                    <label><?php _e( 'Display Counter', 'accesspress-social-counter' ) ?></label>
                    <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[youtube][active]" value="1" class="apsc-counter-activation-trigger" <?php if ( isset( $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'active' ] ) ) { ?>checked="checked"<?php } ?>/><?php _e( 'Show/Hide', 'accesspress-social-counter' ); ?></label></div>
               </div>
               <div class="apsc-option-extra">
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Youtube Channel ID', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[youtube][channel_id]" value="<?php echo isset( $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'channel_id' ] ) ? esc_attr( $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'channel_id' ] ) : ''; ?>"/>
                              <div class="apsc-option-note"><?php _e( 'Please enter the youtube channel ID.Your channel ID looks like: UC4WMyzBds5sSZcQxyAhxJ8g. And please note that your channel ID is different from username.Please go <a href="https://support.google.com/youtube/answer/3250431?hl=en" target="_blank">here</a> to know how to get your channel ID.', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Youtube Channel URL', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[youtube][channel_url]" value="<?php echo esc_attr( $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'channel_url' ] ); ?>"/>
                              <div class="apsc-option-note"><?php _e( 'Please enter the youtube channel URL.For example:https://www.youtube.com/user/accesspressthemes', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Youtube API Key', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[youtube][api_key]" value="<?php echo isset( $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'api_key' ] ) ? esc_attr( $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'api_key' ] ) : ''; ?>"/>
                              <div class="apsc-option-note"><?php _e( 'To get your API Key, first create a project/app in <a href="https://console.developers.google.com/project" target="_blank">https://console.developers.google.com/project</a> and then turn on both Youtube Data and Analytics API from "APIs & auth >APIs inside your project.Then again go to "APIs & auth > APIs > Credentials > Public API access" and then click "CREATE A NEW KEY" button, select the "Browser key" option and click in the "CREATE" button, and then copy your API key and paste in above field.', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Default Subscribers Count', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[youtube][subscribers_count]" value="<?php echo isset( $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'subscribers_count' ] ) ? esc_attr( $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'subscribers_count' ] ) : 0; ?>"/>
                              <div class="apsc-option-note"><?php _e( 'Please enter total number of subscribers that your youtube channel has in case the API fetching is failed for automatic update.', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
               </div>
               <div class="apsc-extra-note"><?php _e( 'Please use: [aps-get-count social_media="youtube"] to get the Youtube Count only.You can also pass count_format parameter too in this shortcode to format your count.Formats are "short" for abbreviated format and "comma" for comma separated formats.' ); ?></div>
          </div>
          <!--Youtube-->

          <!--Sound Cloud-->
          <div class="apsc-option-outer-wrapper">
               <h4><?php _e( 'Sound Cloud', 'accesspress-social-counter' ) ?></h4>
               <div class="apsc-option-inner-wrapper">
                    <label><?php _e( 'Display Counter', 'accesspress-social-counter' ) ?></label>
                    <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[soundcloud][active]" value="1" class="apsc-counter-activation-trigger" <?php if ( isset( $apsc_settings[ 'social_profile' ][ 'soundcloud' ][ 'active' ] ) ) { ?>checked="checked"<?php } ?>/><?php _e( 'Show/Hide', 'accesspress-social-counter' ); ?></label></div>
               </div>
               <div class="apsc-option-extra">
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'SoundCloud Username', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[soundcloud][username]" value="<?php echo esc_attr($apsc_settings[ 'social_profile' ][ 'soundcloud' ][ 'username' ]); ?>"/>
                              <div class="apsc-option-note"><?php _e( 'Please enter the SoundCloud username.For example:bchettri', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'SoundCloud Client ID', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[soundcloud][client_id]" value="<?php echo esc_attr( $apsc_settings[ 'social_profile' ][ 'soundcloud' ][ 'client_id' ] ); ?>"/>
                              <div class="apsc-option-note"><?php _e( 'Please enter the SoundCloud APP Client ID.You can get this information from <a href="http://soundcloud.com/you/apps/new">http://soundcloud.com/you/apps/new</a> after creating a new app', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
                    <div class="apsc-option-inner-wrapper apsc-row-even">
                         <label><?php _e( 'Default Count', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[soundcloud][default_count]" value="<?php echo isset( $apsc_settings[ 'social_profile' ][ 'soundcloud' ][ 'default_count' ] ) && $apsc_settings[ 'social_profile' ][ 'soundcloud' ][ 'default_count' ] != '' ? esc_attr($apsc_settings[ 'social_profile' ][ 'soundcloud' ][ 'default_count' ]) : ''; ?>"/>
                              <div class="apsc-option-note"><?php _e( 'Please enter the default count to show instead of 0 when API\'s are not available.', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
               </div>
               <div class="apsc-extra-note"><?php _e( 'Please use: [aps-get-count social_media="soundcloud"] to get the SoundCloud Count only.You can also pass count_format parameter too in this shortcode to format your count.Formats are "short" for abbreviated format and "comma" for comma separated formats.' ); ?></div>
          </div>
          <!--Sound Cloud-->

          <!--Dribbble-->
          <div class="apsc-option-outer-wrapper">
               <h4><?php _e( 'Dribbble', 'accesspress-social-counter' ) ?></h4>
               <div class="apsc-option-inner-wrapper">
                    <label><?php _e( 'Display Counter', 'accesspress-social-counter' ) ?></label>
                    <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[dribbble][active]" value="1" class="apsc-counter-activation-trigger" <?php if ( isset( $apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'active' ] ) ) { ?>checked="checked"<?php } ?>/><?php _e( 'Show/Hide', 'accesspress-social-counter' ); ?></label></div>
               </div>
               <div class="apsc-option-extra">
                    <div class="apsc-option-inner-wrapper">
                         <label><?php _e( 'Dribbble Username', 'accesspress-social-counter' ); ?></label>
                         <div class="apsc-option-field">
                              <input type="text" name="social_profile[dribbble][username]" value="<?php echo esc_attr( $apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'username' ] ); ?>"/>
                              <div class="apsc-option-note"><?php _e( 'Please enter your dribbble username.For example:Creativedash', 'accesspress-social-counter' ); ?></div>
                         </div>
                    </div>
                   <div class="apsc-option-inner-wrapper apsc-row-odd">
                    <label><?php _e('Dribbble Client id', 'accesspress-social-counter'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[dribbble][client_id]" value="<?php echo isset($apsc_settings['social_profile']['dribbble']['client_id']) && $apsc_settings['social_profile']['dribbble']['client_id'] != '' ? esc_attr($apsc_settings['social_profile']['dribbble']['client_id']) : ''; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter your dribbble client id', 'accesspress-social-counter'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-inner-wrapper apsc-row-even">
                    <label><?php _e('Dribbble Client secret', 'accesspress-social-counter'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[dribbble][client_secret]" value="<?php echo isset($apsc_settings['social_profile']['dribbble']['client_secret']) && $apsc_settings['social_profile']['dribbble']['client_secret'] != '' ? esc_attr($apsc_settings['social_profile']['dribbble']['client_secret']) : ''; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter your dribbble client secret', 'accesspress-social-counter'); ?></div>
                    </div>
                </div>
                <?php
                //$dribbble_url='https://dribbble.com/oauth/authorize?'.$apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'client_id' ].'';
                if (isset($apsc_settings['social_profile']['dribbble']['client_id'])) {
                    $dribble_client_id = $apsc_settings['social_profile']['dribbble']['client_id'];
                } else {
                    $dribble_client_id = '';
                }
                if (isset($apsc_settings['social_profile']['dribbble']['client_secret'])) {
                    $dribble_client_secret = $apsc_settings['social_profile']['dribbble']['client_secret'];
                } else {
                    $dribble_client_secret = '';
                }
                ?>
                <div class="apsc-option-inner-wrapper apsc-row-odd">
                    <label><?php _e('Get Dribbble access token', 'accesspress-social-counter'); ?></label>
                    <!-- <div class="apsc-option-field"> -->
                    <div class="apsc-option-field">
                        <a target="_self" id="get_token" href="https://dribbble.com/oauth/authorize?client_id=<?php echo esc_attr($dribble_client_id); ?>&client_secret=<?php echo esc_attr($dribble_client_secret); ?>">Get access token</a>
                        <div class="apsc-option-note">
                        <?php $back_url = admin_url('admin.php?page=ap-social-counter');
                        ?>
                        <?php _e('Note: After entering your app id and app secret remember to save changes first,then only proceed toward getting access token. Please enter (' . $back_url . ') as callback url', 'accesspress-social-counter'); ?>
                    </div>
                    </div>
                </div>
                <?php
                if (isset($_GET['code']) && $_GET['code'] != '') {
                    $redirect_url = admin_url('admin.php?page=ap-social-counter-pro');
                    $curl = curl_init('https://dribbble.com/oauth/token');
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, array(
                        'client_id' => $dribble_client_id,
                        'client_secret' => $dribble_client_secret,
                        'code' => $_GET['code'],
                            // The code from the previous request
                            //'redirect_uri' => $redirect_url,
                            // 'grant_type' => 'authorization_code'
                    ));
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    $auth = curl_exec($curl);
                    $secret = json_decode($auth);
                    //die(print_r($secret));
                    $accessToken = $secret->access_token;
                }
                ?>

                <div class="apsc-option-inner-wrapper apsc-row-even">
                    <label><?php _e('Access Token', 'accesspress-social-counter'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[dribbble][access_token]" value="<?php
                        if (isset($accessToken)) {
                            echo esc_attr($accessToken);
                        } elseif (isset($apsc_settings['social_profile']['dribbble']['access_token'])) {
                            echo esc_attr($apsc_settings['social_profile']['dribbble']['access_token']);
                        }
                        ?>"/>
                        <div class="apsc-option-note"><?php _e('Note: If not loaded automatically after clicking Get Access Token button provided above, please check if you have followed all steps properly.', 'accesspress-social-counter'); ?></div>
                        <div class="apsc-option-note">
                            How to create application? <br />
                            please login to your dribbble account first and go to <a href='https://dribbble.com/account/applications/new' target='_blank'>this</a> link and create an app. There you will need to enter your app name, Description, Website URL, Callback URL and need to accept the dribbble API terms and conditions and Click on Register Application button. Upon Registration after page reload you will get your client id and client secret.
                        </div>
                    </div>
                </div>
               </div>
               
               <div class="apsc-option-inner-wrapper apsc-row-even">
                    <label><?php _e( 'Default Count', 'accesspress-social-counter' ); ?></label>
                    <div class="apsc-option-field">
                         <input type="text" name="social_profile[dribbble][default_count]" value="<?php echo isset( $apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'default_count' ] ) && $apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'default_count' ] != '' ? esc_attr($apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'default_count' ]) : ''; ?>"/>
                         <div class="apsc-option-note"><?php _e( 'Please enter the default count to show instead of 0 when API\'s are not available.', 'accesspress-social-counter' ); ?></div>
                    </div>
               </div>
               <div class="apsc-extra-note"><?php _e( 'Please use: [aps-get-count social_media="dribbble"] to get the Dribbble Count only.You can also pass count_format parameter too in this shortcode to format your count.Formats are "short" for abbreviated format and "comma" for comma separated formats.' ); ?></div>
          </div>
          <!--Dribbble-->

          <!--Posts-->
          <div class="apsc-option-outer-wrapper">
               <h4><?php _e( "Posts", 'accesspress-social-counter' ) ?></h4>
               <div class="apsc-option-inner-wrapper">
                    <label><?php _e( 'Display Counter', 'accesspress-social-counter' ); ?></label>
                    <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[posts][active]" value="1" class="apsc-counter-activation-trigger" <?php if ( isset( $apsc_settings[ 'social_profile' ][ 'posts' ][ 'active' ] ) ) { ?>checked="checked"<?php } ?>/><?php _e( 'Show/Hide', 'accesspress-social-counter' ); ?></label></div>
               </div>
               <div class="apsc-extra-note"><?php _e( 'Please use: [aps-get-count social_media="posts"] to get the Posts Count only.You can also pass count_format parameter too in this shortcode to format your count.Formats are "short" for abbreviated format and "comma" for comma separated formats.' ); ?></div>
          </div>
          <!--Posts-->

          <!--Comments-->
          <div class="apsc-option-outer-wrapper">
               <h4><?php _e( "Comments", 'accesspress-social-counter' ); ?></h4>
               <div class="apsc-option-inner-wrapper">
                    <label><?php _e( 'Display Counter', 'accesspress-social-counter' ); ?></label>
                    <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[comments][active]" value="1" class="apsc-counter-activation-trigger" <?php if ( isset( $apsc_settings[ 'social_profile' ][ 'comments' ][ 'active' ] ) ) { ?>checked="checked"<?php } ?>/><?php _e( 'Show/Hide', 'accesspress-social-counter' ); ?></label></div>
               </div>
               <div class="apsc-extra-note"><?php _e( 'Please use: [aps-get-count social_media="comments"] to get the Comments Count only.You can also pass count_format parameter too in this shortcode to format your count.Formats are "short" for abbreviated format and "comma" for comma separated formats.' ); ?></div>
          </div>
          <!--Comments-->

     </div>
     <?php
include(SC_PATH . '/inc/backend/boards/save-button.php');
?>
</div>
