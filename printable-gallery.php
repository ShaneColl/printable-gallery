<?php
/*
Plugin Name: Printable Gallery 
Plugin URI:  TODO             
Description: Generates a table of images where users can select individual images to be printed .
Version:     0.3
Author:      Shane W. Coll
Author URI:  http://shanecoll.com
 */

//TODO IMPLEMENT OBJECT ORIENTATION

//Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if( ! class_exists( 'Printable_Gallery' ) ) :

	require_once "includes/class-pg-table.php";
require_once "includes/settings.php";

/**
 * Main Printable_Gallery Class
 *
 * @since 0.2 
 */

class Printable_Gallery {

	private static $instance;

	static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Printable_Gallery ) ) {

			self::$instance = new Printable_Gallery;

			add_action('admin_init', 'pg_settings_api');

			self::$instance->table = new PG_TABLE(); 
		}
		return self::$instance;
	}

	private function setup_constants() {
		//Plugin folder path
		if ( ! defined( 'PG_PLUGIN_DIR' ) ) {
			define( 'PG_PLUGIN_DIR', plugin_dir_path(__FILE__ ) );
		}



	}
	
	private function includes() {

		require_once PG_PLUGIN_DIR . "includes/class-pg-table.php";

		require_once PG_PLUGIN_DIR . "includes/settings.php";



	}
}

endif;

function PG() {
	Printable_Gallery::instance();
}

PG();
