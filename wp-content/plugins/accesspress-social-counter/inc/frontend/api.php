<?php

$count = 0;
$apsc_settings = $this -> apsc_settings;
$cache_period = ($apsc_settings[ 'cache_period' ] != '') ? esc_attr( $apsc_settings[ 'cache_period' ] ) * 60 * 60 : 24 * 60 * 60;
switch ( $social_media ) {
     case 'facebook':
          include(SC_PATH . 'inc/frontend/social_network/extract_count/facebook.php');
          break;
     case 'twitter':
          include(SC_PATH . 'inc/frontend/social_network/extract_count/twitter.php');
          break;
     case 'instagram':
          include(SC_PATH . 'inc/frontend/social_network/extract_count/instagram.php');
          break;
     case 'youtube':
          include(SC_PATH . 'inc/frontend/social_network/extract_count/youtube.php');
          break;
     case 'soundcloud':
          include(SC_PATH . 'inc/frontend/social_network/extract_count/soundcloud.php');
          break;
     case 'dribbble':
          include(SC_PATH . 'inc/frontend/social_network/extract_count/dribbble.php');
          break;
     case 'posts':
          include(SC_PATH . 'inc/frontend/social_network/extract_count/posts.php');
          break;
     case 'comments':
          include(SC_PATH . 'inc/frontend/social_network/extract_count/comments.php');
          break;
     default:
          break;
}