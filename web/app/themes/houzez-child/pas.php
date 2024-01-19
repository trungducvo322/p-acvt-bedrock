<?php
  $request_url = $_SERVER["REQUEST_URI"];
  $paslink = get_home_url() . '/';
  $is_sp = false;
  $is_sp = ((strpos($ua,'iPhone')!==false)||(strpos($ua,'iPod')!==false)||(strpos($ua,'Android')!==false));
  $HTTPS = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
  $HTTP_HOST = $_SERVER['HTTP_HOST'];
  $top_url = $HTTPS . $HTTP_HOST . "/";
	$full_url = $HTTPS . $HTTP_HOST . $request_url;
  $request_url_explode = explode('/', $request_url);
  $url_count = count($request_url_explode);
  $folder_name = $request_url_explode[$url_count - 2] ? $request_url_explode[$url_count - 2] : null;
  $folder_name2 = $request_url_explode[$url_count - 3] ? $request_url_explode[$url_count - 3] : null;
  $folder_name3 = $request_url_explode[$url_count - 4] ? $request_url_explode[$url_count - 4] : null;
  $folder_name4 = $request_url_explode[$url_count - 5] ? $request_url_explode[$url_count - 5] : null;
  $folder_name5 = $request_url_explode[$url_count - 6] ? $request_url_explode[$url_count - 6] : null;
  $pas = get_stylesheet_directory_uri() . '/';
  $WP_SETTING = get_option('my_theme_options');

?>
