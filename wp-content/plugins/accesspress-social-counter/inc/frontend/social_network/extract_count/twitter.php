<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
$default_count = isset( $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'default_count' ] ) && $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'default_count' ] != '' ? $apsc_settings[ 'social_profile' ][ 'twitter' ][ 'default_count' ] : '0';

$twitter_count = get_transient( 'apsc_twitter' );
if ( false === $twitter_count ) {
     $count = ($this -> get_twitter_count());
     if ( isset( $count ) && ($count == ' ' || $count == '0') ) {
          $count = $default_count;
     }
     set_transient( 'apsc_twitter', $count, $cache_period );
} else {
     $count = $twitter_count;
}
