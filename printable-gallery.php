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
 * @param TODO int $rows the user input number of rows 
 * @return string $tableBody the body of the table 
 */
function pg_table_body( /*TODO int size*/  ) { 
	 $rows = 4;//TODO make this equal the parameter

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
 * @param TODO int $columns the user input number of rows 
 * @return string $data the data of each cell 
 */
function pg_table_data(/*TODO int size*/){ 
         $columns = 4;//TODO make this equal the parameter

         for( $i = 0; $i < $columns; $i++ ){ 
                $tableColumns[$i]=  "<td>
				    Picture will go here
                              	     </td>";       
         }
         $data = implode( $tableColumns );
         return $data;
}

function pg_settings_api() {

add_settings_section('pg_setttings_section',
	'Printable Gallery Settings',
	'pg_settings_section_callback_function',
	'media');

add_settings_field('pg_gallery_name',
	'Gallery Name',
	'pg_settings_gallery_name_callback',
	'media',
	'pg_settings_section');

register_setting('media', 'pg_gallery_name');


}

add_action('admin_init', 'pg_settings_api');

function pg_settings_section_callback_function(){
	echo '<p>Set up your printable Gallery</p>';
}

function pg_settings_gallery_name_callback(){
//TODO write text field	



}
