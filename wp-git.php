<?php
/*
Plugin Name: WordPress CLI and Git Commands
Version: 0.3
Description: WP CLI Command to accessing git commands and repository
Author: Tristup Ghosh
Author URI: 
Text Domain: wp_git
*/
if ( defined( 'WP_CLI' ) ) {
	require __DIR__ . '/class-command.php';
}