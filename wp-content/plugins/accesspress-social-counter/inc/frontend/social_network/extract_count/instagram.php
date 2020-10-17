<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
$username = isset( $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'username' ] ) && $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'username' ] != '' ? $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'username' ] : '';
$user_id = isset( $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'user_id' ] ) && $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'user_id' ] != '' ? $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'user_id' ] : '';
$default_count = isset( $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'default_count' ] ) && $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'default_count' ] != '' ? $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'default_count' ] : '0';

$social_profile_url = 'https://instagram.com/' . $username;

$instagram_count = get_transient( 'apsc_instagram' );

//if ( false === $instagram_count ) {
//     $access_token = $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'access_token' ];
//
//     $api_url = 'https://api.instagram.com/v1/users/self/?access_token=' . $access_token;
//     $params = array(
//         'sslverify' => false,
//         'timeout' => 60
//     );
//     $connection = wp_remote_get( $api_url, $params );
//     if ( is_wp_error( $connection ) ) {
//          $count = $default_count;
//     } else {
//          $response = json_decode( $connection[ 'body' ], true );
//          if (
//                  isset( $response[ 'meta' ][ 'code' ] ) && 200 == $response[ 'meta' ][ 'code' ] && isset( $response[ 'data' ][ 'counts' ][ 'followed_by' ] )
//          ) {
//               $count = (intval( $response[ 'data' ][ 'counts' ][ 'followed_by' ] ));
//               set_transient( 'apsc_instagram', $count, $cache_period );
//          } else {
//               $count = $default_count;
//          }
//     }
//} else {
//     $count = $instagram_count;
//}
if ( false === $instagram_count ) {
     $access_token = (isset( $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'access_token' ] ) && $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'access_token' ] != '') ? $apsc_settings[ 'social_profile' ][ 'instagram' ][ 'access_token' ] : '';
     $api_url='https://graph.facebook.com/v5.0/'.$user_id.'?fields=business_discovery.username('.$username.'){username,follows_count,followers_count}&access_token=' . $access_token .'';
//     die(var_dump($api_url));
     $params = array(
         'sslverify' => false,
         'timeout' => 60
     );
     $connection = wp_remote_get( $api_url, $params );
     if ( is_wp_error( $connection ) ) {
          $count = $default_count;
     } else {
          $response = json_decode( $connection[ 'body' ], true );
          // echo "<pre>";
          // print_r($response);
          // echo "</pre>";
          if ( isset( $response[ 'business_discovery' ][ 'followers_count' ] ) ) {
               $count = intval( $response[ 'business_discovery' ][ 'followers_count' ] );
              // var_dump($count);
          } else {
            //die(print_r($response));
               $count = $default_count;
          }
     }
     set_transient( 'apsc_instagram', $count, $cache_period );
} else {
     $count = $instagram_count;
}

