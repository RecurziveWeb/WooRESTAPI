<?php
/*
Plugin Name: Recurizve-WP-API
Plugin URI:  https://recurzive.com
Description: Bridge to Wp and API
Version:     1.0
Author:      Thilina Abeysinghe
License:     MIT
License URI: http://recurzive.com
*/

// Exit if Accessed Directly
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

// Woo Products
require_once( plugin_dir_path( __FILE__ ) . 'includes/get_woocommerce_products.php' );

?>