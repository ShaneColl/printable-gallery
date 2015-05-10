<?php
/**
 * Functions 
 *
 * @package     PG
 * @copyright   Copyright (c) 2015, Shane W. Coll 
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       0.3
 */

/**
 * Check whether or not the table page already exists. 
 *
 * If the table page does not exist, it creates a new one.
 *
 * @since 0.1 
 * @param string $title_str the title of the page being checked 
 * @return void
 */
class PG_FUNCTIONS{
	public static function pg_exist_post_by_title( $title_str ) {  
		global $wpdb;
		return $wpdb->get_row(  "SELECT * FROM wp_posts WHERE post_title = '" . $title_str . "'", 'ARRAY_A');
	}

	/**
	 * Generates a table according to user specs and inserts it into a new post. 
	 *
	 * @since 0.1 
	 * @return void
	 */
	public static function pg_generateTable( ) { 
		if(PG_FUNCTIONS::pg_exist_post_by_title('Table Page' ) == NULL ){
			//Creating the $post array
			$post = array( 
				'post_title'  => 'Table Page',
				'post_content'=> "<table>
				<tbody>" .
				PG_FUNCTIONS::pg_table_body() 
				. "</tbody>
				</table>" 
			); wp_insert_post(  $post );
		}
	}

	/**
	 * Generates the body of the table. 
	 *
	 * @since 0.1 
	 * @param TODO Set default values for no option recall 
	 * @return string $tableBody the body of the table 
	 */
	public static function pg_table_body() { 
		if(get_option('pg_rows_number') == NULL){
			$rows= 4;
		}
		else {
			$rows= get_option('pg_rows_number');
		}

		for( $i = 0; $i < $rows; $i++ ){ 
			$tableRows[$i]=  "<tr>" .
				PG_FUNCTIONS::pg_table_data() 
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
	public static function pg_table_data(){ 
		if(get_option('pg_columns_number') == NULL){
			$columns = 4;
		}
		else {
			$columns = get_option('pg_columns_number');
		}

		for( $i = 0; $i < $columns; $i++ ){ 
			$tableColumns[$i]=  "<td>
				Picture will go here
				</td>";       
		}
		$data = implode( $tableColumns );
		return $data;
	}

}
