<?php
/*
Plugin Name: Divify
Plugin URI:  https://github.com/chigozieorunta/divify
Description: A simple Divi plugin containing list of custom modules for extending your WordPress Divi sites.
Version:     1.0.0
Author:      Chigozie Orunta
Author URI:  https://linkedin.com/in/chigozieorunta
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: divi-divify
Domain Path: /languages

Divify is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Divify is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Divify. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/


if ( ! function_exists( 'divi_initialize_extension' ) ):
/**
 * Creates the extension's main class instance.
 *
 * @since 1.0.0
 */
function divi_initialize_extension() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/Divify.php';
}
add_action( 'divi_extensions_init', 'divi_initialize_extension' );
endif;
