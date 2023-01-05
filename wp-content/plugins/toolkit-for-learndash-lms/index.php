<?php defined( 'ABSPATH' ) or die( 'Access Denied.' );
/*
Plugin Name: Toolkit for Learndash LMS
Plugin URI: http://androidbubble.com/blog/wordpress/plugins/toolkit-for-learndash
Description: An essential toolkit for Learndash LMS plugin with multitier content management options.
Author: Fahad Mahmood
Version: 1.0.7
Text Domain: toolkit-for-learndash
Domain Path: /languages
Author URI: https://profiles.wordpress.org/fahadmahmood/
License: GPL2
	
This WordPress Plugin is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 2 of the License, or any later version. This free software is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with this software. If not, see http://www.gnu.org/licenses/gpl-2.0.html.	
*/

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	
	global $tkflld_data, $tkflld_pro, $tkflld_premium_link, $tkflld_dir, $tkflld_url, $tkflld_options, $wp_docs_tabs, $tkflld_sfwd_lms, $tkflld_learn_dash_update_flag;
	
	$tkflld_data = get_plugin_data(__FILE__);
	$tkflld_dir = plugin_dir_path( __FILE__ );
    $tkflld_url = plugin_dir_url( __FILE__ );
	
    
    $tkflld_options = get_option('tkflld_options', array());
	$tkflld_learn_dash_update_flag = get_option('tkflld_learn_dash_update_flag', true);
	
	$wp_docs_tabs = in_array( 'wp-responsive-tabs/index.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
	$tkflld_sfwd_lms = in_array( 'sfwd-lms/sfwd_lms.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );


    $tkflld_premium_link = 'https://shop.androidbubbles.com/product/toolkit-for-learndash-pro';
	
	
	$tkflld_pro_file = $tkflld_dir.'pro/tkflld-pro.php';

	
    $tkflld_pro = file_exists($tkflld_pro_file);
    if($tkflld_pro){
        include($tkflld_pro_file);
    }	
	
	include_once('inc/functions.php');

	if(is_admin()){
		$plugin = plugin_basename(__FILE__); 
		add_filter("plugin_action_links_$plugin", 'tkflld_plugin_links' );	
	}
	