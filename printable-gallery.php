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

require_once "includes/class-pg-functions.php";
require_once "includes/settings.php";
/**
 * Main Printable_Gallery Class
 *
 * @since 0.2 
 */

class Printable_Gallery {

	private static $instance;

	public static function instance() {

		self::$instance = new Printable_Gallery;

		add_action('admin_init', 'pg_settings_api');

		self::$instance->functions = new PG_FUNCTIONS(); 

	}
}

function PG() {
	 Printable_Gallery::instance();
}

PG();
