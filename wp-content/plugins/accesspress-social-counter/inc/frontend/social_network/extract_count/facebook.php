<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" );
//$facebook_page_id = isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'page_id' ] ) && $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'page_id' ] != '' ? $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'page_id' ] : '';
//$default_count = isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'default_count' ] ) && $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'default_count' ] != '' ? $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'default_count' ] : '0';
//$facebook_count = get_transient( 'apsc_facebook' );
//
//if ( false === $facebook_count ) {
//     $facebook_method = ( isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] ) && $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] != '' ) ? esc_attr( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] ) : '2';
//     if ( $facebook_method == '1' ) {
//          $count = $this -> new_fb_count();
//     } else {
//          if ( isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'app_id' ], $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'app_secret' ] ) && $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'app_id' ] != '' && $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'app_secret' ] != '' ) {
//               $count = $this -> new_fb_count();
//          } else {
//               $api_url = 'https://www.facebook.com/' . $facebook_page_id;
//               $count = $this -> facebook_count( $api_url );
//          }
//     }
//     set_transient( 'apsc_facebook', $count, $cache_period );
//} else {
//     $count = $facebook_count;
//}
//
//$count = ($count == 0) ? $default_count : $count;
//if ( $count != 0 ) {
//     set_transient( 'apsc_facebook', $count, $cache_period );
//}
$facebook_page_id = isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'page_id' ] ) && $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'page_id' ] != '' ? $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'page_id' ] : '';
$default_count = isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'default_count' ] ) && $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'default_count' ] != '' ? $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'default_count' ] : '0';
$facebook_count = get_transient( 'apsc_facebook' );
if ( false === $facebook_count ) {
     $facebook_method = ( isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] ) && $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] != '' ) ? esc_attr( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'method' ] ) : '2';
     if ( $facebook_method == '1' ) {
       if ( isset( $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'app_id' ], $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'app_secret' ] ) && $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'app_id' ] != '' && $apsc_settings[ 'social_profile' ][ 'facebook' ][ 'app_secret' ] != '' ) {
              $count = $this -> new_fb_count();
          } else {
               $api_url = 'https://www.facebook.com/' . $facebook_page_id;
               $count = $this -> facebook_count( $api_url );
          }
     } else {
$count = $this -> new_fb_count();
     }
	$count = ($count == 0) ? $default_count : $count;
     set_transient( 'apsc_facebook', $count, $cache_period );
} else {
     $count = $facebook_count;
}

