<?php
// Remove unnecessary reads
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');

// function my_delete_local_jquery()
// {
// 	wp_deregister_script('jquery');
// }
// add_action('wp_enqueue_scripts', 'my_delete_local_jquery');

// Emoji load removal
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

//add support
add_theme_support('custom-logo');

//theme option
if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'	=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
}

// add function
include 'inc/nav.php';
include 'inc/ajax.php';
include 'inc/like.php';
include 'inc/comment.php';

//check taxonomy
add_action('wp_head', 'check_taxonomy');

function check_taxonomy()
{
	$arrTax = array('property_type', 'property_status', 'property_city', 'property_area', 'property_label', 'property_country', 'property_feature');
	$term_id = '';
	$tax_name = '';
	$term_count = '';
	$term_title = '';
	if (is_tax($arrTax) || is_category()) {
		$object = get_queried_object();
		$tax_name = $object->taxonomy;
		$term_id = $object->term_id;
		$term_count = $object->count;
		$term_title = $object->name;
	}

	define('current_term_id', $term_id);
	define('current_tax', $tax_name);
	define('current_term_count', $term_count);
	define('title', $term_title);
}

//child theme url
$pas = get_stylesheet_directory_uri() . '/';
define('PAS', $pas);

function showr($array_data) {
	return print("<pre>".print_r($array_data,true)."</pre>");
}

include 'page/func/ajax.php';
