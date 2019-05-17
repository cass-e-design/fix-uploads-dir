<?php
/*
Plugin Name: Fix Upload Directories
Plugin URI: https://cass-e.net/plugins/wordpress-fix-upload-directory/
Description: Adds a filter to 'upload_dir' to guarantee that wordpress obeys the UPLOADS directive
Version: 1.0.0
Date: 05/14/2019
Author: Cass-E
Author URI: http://cass-e.net
License: GPLv2 or Later
*/

define('FIX_UPLOAD_DIR_BASE', plugin_basename(__FILE__));

if (is_admin())
	require_once(plugin_dir_path(__FILE__).'fix-upload-dir-settings.php');

$upload_const = get_option('fix_upload_dir');

function fix_upload_dir_filter($upload_dir) {
	if (defined('UPLOADS')) {
		$upload_const = UPLOADS;
	}
	
	if (isset($upload_const))
	{
		//var_dump($upload_dir);
		$upload_dir['path'] = str_replace("wp-content/uploads", $upload_const, $upload_dir['path']);
		$upload_dir['url'] = str_replace("wp-content/uploads", $upload_const, $upload_dir['url']);
		$upload_dir['basedir'] = str_replace("wp-content/uploads", $upload_const, $upload_dir['basedir']);
		$upload_dir['baseurl'] = str_replace("wp-content/uploads", $upload_const, $upload_dir['baseurl']);
	}
	return $upload_dir;
}
add_filter('upload_dir', 'fix_upload_dir_filter');