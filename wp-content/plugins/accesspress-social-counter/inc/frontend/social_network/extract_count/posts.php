<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
$posts_count = get_transient( 'apsc_posts' );
if ( false === $posts_count ) {
     $posts_count = wp_count_posts();
     $count = $posts_count -> publish;
     set_transient( 'apsc_posts', $count, $cache_period );
} else {
     $count = $posts_count;
}

