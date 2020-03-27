<?php

if ( ! class_exists( 'ET_Builder_Element' ) ) {
	return;
}

add_action( 'et_builder_ready', 'module_loaded',20);

function module_loaded() {
	$module_files = glob( __DIR__ . '/modules/*/*.php' );
	foreach ( (array) $module_files as $module_file ) {
		if ( $module_file && preg_match( "/\/modules\/\b([^\/]+)\/\\1\.php$/", $module_file ) ) {
			require_once $module_file;
		}
	}
}
// Load custom Divi Builder modules

