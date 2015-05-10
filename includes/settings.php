<?php
/**
 * Settings 
 *
 * @package     PG
 * @copyright   Copyright (c) 2015, Shane W. Coll 
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.3
 */

/**
 * Generates the settings page and handles user input. 
 *
 * @since 0.1 
 */
function pg_settings_api() {

	add_settings_section('pg_settings_section',
		'Printable Gallery Settings',
		'pg_settings_section_callback_function',
		'media');

	add_settings_field('pg_gallery_name',
		'Gallery Name:',
		'pg_settings_gallery_name_callback',
		'media',
		'pg_settings_section');

	add_settings_field('pg_rows_number',
		'Rows of images:',
		'pg_settings_rows_num_callback',
		'media',
		'pg_settings_section');

	add_settings_field('pg_columns_number',
		'Columns of images:',
		'pg_settings_columns_num_callback',
		'media',
		'pg_settings_section');

	register_setting('media', 'pg_columns_number');
	register_setting('media', 'pg_gallery_name');
	register_setting('media', 'pg_rows_number');
	PG_FUNCTIONS::pg_generateTable();
}
/**
 * Prints message in the Gallery settings section 
 *
 * @since 0.1 
 */
function pg_settings_section_callback_function(){
	echo '<p>Set up your Printable Gallery</p>';
}

/**
 * Generates the rows field 
 *
 * If there is no option value, the it displays "4" as the default value
 * 
 * @since 0.1 
 */
function pg_settings_rows_num_callback(){
	if(get_option('pg_rows_number') == NULL){
		echo '<input name="pg_rows_number" type="number" value="4" max="10"/>';
	}
	else {
		echo '<input name="pg_rows_number" type="number" value="' . get_option('pg_rows_number') . '" max="10"/>';
	}		
}

/**
 * Generates the columns field 
 *
 * If there is no option value, the it displays "4" as the default value
 * 
 * @since 0.1 
 */
function pg_settings_columns_num_callback(){
	if(get_option('pg_columns_number') == NULL){
		echo '<input name="pg_columns_number" type="number" value="4" max="10"/>';
	}
	else {
		echo '<input name="pg_columns_number" type="number" value="' . get_option('pg_columns_number') . '" max="10"/>';
	}		
}

/**
 * Generates the gallery name field 
 *
 * If there is no option value, the it displays "Gallery Name" as the default value
 * 
 * @since 0.1 
 */
function pg_settings_gallery_name_callback(){
	if(get_option('pg_gallery_name') == NULL){
		echo '<input name="pg_gallery_name" type="text" value="Gallery Name" maxlength="20"/>';
	}
	else {
		echo '<input name="pg_gallery_name" type="text" value="' . get_option('pg_gallery_name') . '" maxlength="20"/>';
	}		
}
