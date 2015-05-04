<?php
/*
Plugin Name: Printable Gallery
Description: This plugin takes a bunch of images, arranges them into a gallery, and allows users to select them to be  printed.
*/

function pg_generateTable() {

//TODO condtional does page exist

//Creating the $post array
$post = array(
	'post_title' => 'Table Page',
	'post_content'=> 'This is the page where the table will be generated'
); wp_insert_post( $post );

} add_action('init', 'pg_generateTable');

?>
