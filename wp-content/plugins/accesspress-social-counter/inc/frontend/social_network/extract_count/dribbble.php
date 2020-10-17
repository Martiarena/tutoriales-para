<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );

$social_profile_url = 'http://dribbble.com/' . $apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'username' ];
$default_count = isset( $apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'default_count' ] ) && $apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'default_count' ] != '' ? $apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'default_count' ] : '';

$dribbble_count = get_transient( 'apsc_dribbble' );

//$dribbble_count = false;

if ( false === $dribbble_count ) {
     $username = (isset( $apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'username' ] ) && $apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'username' ] != '') ? $apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'username' ] : '';
     if ( isset( $apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'access_token' ] ) && $apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'access_token' ] != '' ) {
          $access_token = $apsc_settings[ 'social_profile' ][ 'dribbble' ][ 'access_token' ];
          //$api_url = 'https://api.dribbble.com/v1/users/' . $username.'/?access_token='.$access_token; This one is depricated (V1)
          //die( 'reached' );
          $api_url = 'https://api.dribbble.com/v2/user?access_token=' . $access_token;
     } else {
          $api_url = 'http://api.dribbble.com/' . $username;
     }
     $params = array(
         'sslverify' => false,
         'timeout' => 60
     );
     $connection = wp_remote_get( $api_url, $params );
     if ( is_wp_error( $connection ) ) {
          $count = $default_count;
     } else {
          $response = json_decode( $connection[ 'body' ], true );
          if ( isset( $response[ 'followers_count' ] ) ) {
               $count = intval( $response[ 'followers_count' ] );
          } else {
               $count = $default_count;
          }
     }
     set_transient( 'apsc_dribbble', $count, $cache_period );
} else {
     $count = $dribbble_count;
}