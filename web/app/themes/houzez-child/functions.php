<?php
//add support
add_theme_support('custom-logo');

//define child theme url
$pas = get_stylesheet_directory_uri() . '/';
define('PAS', $pas);

// handle function
include 'include/nav.php';
include 'include/ajax.php';
include 'include/comment.php';
include "include/theme_filter.php";
include "include/theme_option.php";