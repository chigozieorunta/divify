<?php

if ( ! class_exists( 'ET_Builder_Element' ) ) {
	return;
}

//$module_files = glob( __DIR__ . '/modules/**/*.php' );

require_once __DIR__ . '/modules/Realify/Search/Search.php';
require_once __DIR__ . '/modules/Realify/Featured/Featured.php';

// Load custom Divi Builder modules
/*foreach ( (array) $module_files as $module_file ) {
	if ( $module_file && preg_match( "/\/modules\/\b([^\/]+)\/\\1\.php$/", $module_file ) ) {
		require_once $module_file;
	}
}*/
