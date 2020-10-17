<?php
/**
 * the file for using in boal theme
 */
add_filter( 'soo_demo_packages', function() {
    $settings=array(
		array(
			'name'       => 'Boal',
            'preview'    => NANO_PLUGIN_URL.'inc/importer/data/main-home.jpg',
			'content'    => NANO_PLUGIN_URL.'inc/importer/data/demo-content.xml',
			'customizer' => NANO_PLUGIN_URL.'inc/importer/data/customizer.dat',
			'widgets'    => NANO_PLUGIN_URL.'inc/importer/data/widgets.wie',
			'pages'      => array(
				'front_page' => 'Home',
				'blog'       => 'Blog',
			),
			'menus'      => array(
				'primary_navigation'    => 'primary-navigation',
				'top_navigation'        => 'top-navigation',
			)
		),
	);
    return $settings;
} );
?>