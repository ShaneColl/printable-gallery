<?php
/*
Plugin Name: Printable Gallery 
Plugin URI:  TODO             
Description: Generates a table of images where users can select individual images to be printed .
Version:     0.1
Author:      Shane W. Coll
Author URI:  http://shanecoll.com
*/


if(pg_exist_post_by_title('Table Page' ) == NULL ){ 
add_action('init', 'pg_generateTable' );
}

/**
 * Generates a table according to user specs and inserts it into a new post. 
 *
 * @since 0.1 
 * @return void
 */
function pg_generateTable( ) { 
        //Creating the $post array
        $post = array( 
                'post_title'  => 'Table Page',
                'post_content'=> "<table>
                                  <tbody>" .
                                   pg_table_body() 
                                  . "</tbody>
                                  </table>" 
        ); wp_insert_post(  $post );
}

/**
 * Check whether or not the table page already exists. 
 *
 * If the table page does not exist, it creates a new one.
 *
 * @since 0.1 
 * @param string $title_str the title of the page being checked 
 * @return void
 */
function pg_exist_post_by_title( $title_str ) {  
        global $wpdb;
        return $wpdb->get_row(  "SELECT * FROM wp_posts WHERE post_title = '" . $title_str . "'", 'ARRAY_A');
}

/**
 * Generates the body of the table. 
 *
 * @since 0.1 
 * @param TODO Set default values for no option recall 
 * @return string $tableBody the body of the table 
 */
function pg_table_body() { 
	 $rows = get_option('pg_rows_number');

	 for( $i = 0; $i < $rows; $i++ ){ 
               	$tableRows[$i]=  "<tr>" .
				pg_table_data() 
                	       . "</tr>";	
	 }
	 $tableBody = implode( $tableRows );
	 return $tableBody;
}

/**
 * Generates the columns of the table and insets their data. 
 *
 * @since 0.1 
 * @param TODO Set default values for no option recall 
 * @return string $data the data of each cell 
 */
function pg_table_data(){ 
         $columns = get_option('pg_columns_number');

         for( $i = 0; $i < $columns; $i++ ){ 
                $tableColumns[$i]=  "<td>
				    Picture will go here
                              	     </td>";       
         }
         $data = implode( $tableColumns );
         return $data;
}

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
}

add_action('admin_init', 'pg_settings_api');

function pg_settings_section_callback_function(){
	echo '<p>Set up your Printable Gallery</p>';
}

function pg_settings_rows_num_callback(){
	echo '<input name="pg_rows_number" type="number" value="' . get_option('pg_rows_number') . '"  max="10"/>';
}

function pg_settings_columns_num_callback(){
	echo '<input name="pg_columns_number" type="number" value="' . get_option('pg_columns_number') . '" max="10"/>';
}


function pg_settings_gallery_name_callback(){
	echo '<input name="pg_gallery_name" type="text" value="' . get_option('pg_gallery_name') . '"  maxlength="20"/>';
}
