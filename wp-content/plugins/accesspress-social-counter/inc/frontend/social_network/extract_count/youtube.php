<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
$social_profile_url = esc_url( $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'channel_url' ] );
$count = get_transient( 'apsc_youtube' );
$default_count = isset( $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'default_count' ] ) && $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'default_count' ] != '' ? $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'default_count' ] : '0';

if ( false === $count ) {
     $count = $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'subscribers_count' ];
     if ( isset( $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'channel_id' ], $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'api_key' ] ) &&
             $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'channel_id' ] != '' && $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'api_key' ] ) {
          $api_key = $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'api_key' ];
          $channel_id = $apsc_settings[ 'social_profile' ][ 'youtube' ][ 'channel_id' ];
          $api_url = 'https://www.googleapis.com/youtube/v3/channels?part=statistics&id=' . $channel_id . '&key=' . $api_key;
          $connection = wp_remote_get( $api_url, array( 'timeout' => 60 ) );

          if ( ! is_wp_error( $connection ) ) {
               $response = json_decode( $connection[ 'body' ], true );
               if ( isset( $response[ 'items' ][ 0 ][ 'statistics' ][ 'subscriberCount' ] ) ) {
                    $count = $response[ 'items' ][ 0 ][ 'statistics' ][ 'subscriberCount' ];
                    set_transient( 'apsc_youtube', $count, $cache_period );
               } else {
                    $count = $default_count;
               }
          }
     }
}