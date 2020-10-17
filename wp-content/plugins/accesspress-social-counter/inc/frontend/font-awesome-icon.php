<?php

$apsc_settings = get_option('apsc_settings');
$enable_font_css = (isset($apsc_settings['disable_font_css']) && $apsc_settings['disable_font_css'] == 0) ? true : false;
if ($enable_font_css) {
    if (isset($apsc_settings['font_awesome_version']) && $apsc_settings['font_awesome_version'] == 'apsc-font-awesome-four') {
        $version = array(
            $comments = 'fa fa-comments',
            $dribble = 'fa fa-dribbble',
            $facebook = 'fa fa-facebook',
            $instagram = 'fa fa-instagram',
            $edit = 'fa fa-edit',
            $soundcloud = 'fa fa-soundcloud',
            $twitter = 'fa fa-twitter',
            $youtube = 'fa fa-youtube'
        );
    } else {
        $version = array(
            $comments = 'fas fa-comments',
            $dribble = 'fab fa-dribbble',
            $facebook = 'fab fa-facebook-f',
            $instagram = 'fab fa-instagram',
            $edit = 'fas fa-edit',
            $soundcloud = 'fab fa-soundcloud',
            $twitter = 'fab fa-twitter',
            $youtube = 'fab fa-youtube'
        );
    }
} else {
    $version = array(
        $comments = 'fas fa-comments',
        $dribble = 'fab fa-dribbble',
        $facebook = 'fab fa-facebook-f',
        $instagram = 'fab fa-instagram',
        $edit = 'fas fa-edit',
        $soundcloud = 'fab fa-soundcloud',
        $twitter = 'fab fa-twitter',
        $youtube = 'fab fa-youtube'
    );
}
?>
