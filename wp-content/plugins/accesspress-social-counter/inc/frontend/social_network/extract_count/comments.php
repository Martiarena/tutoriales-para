<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );

$comments_count = get_transient( 'apsc_comments' );
if ( false === $comments_count ) {
     $data = wp_count_comments();
     $count = ($data -> approved);
     set_transient( 'apsc_comments', $count, $cache_period );
} else {
     $count = $comments_count;
}