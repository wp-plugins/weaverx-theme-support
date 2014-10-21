<?php
/*
Plugin Name: Weaver X Theme Support
Plugin URI: http://weavertheme.com/plugins
Description: Weaver X Theme Support - a package of useful shortcodes and widgets that integrates closely with the Weaver X theme. This plugin Will also allow you to switch from Weaver X to any other theme and still be able to use the shortcodes and widgets from Weaver X with minimal effort.
Author: wpweaver
Author URI: http://weavertheme.com/about/
Version: 0.5

License: GPL

Weaver X Theme Support

Copyright (C) 2014, Bruce E. Wampler - weaver@weavertheme.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


/* CORE FUNCTIONS
*/

define ('WVRX_TS_VERSION','0.5');
define ('WVRX_TS_MINIFY','.min');		// '' for dev, '.min' for production

function wvrx_ts_installed() {
    return true;
}

function wvrx_ts_admin() {
    require_once(dirname( __FILE__ ) . '/includes/wvrx-ts-admin-top.php'); // NOW - load the admin stuff
    wvrx_ts_admin_page();
}

function wvrx_ts_admin_menu() {
    $page = add_theme_page(
	  'Weaver X Theme Support by WeaverTheme.com','<small>&times;Theme Support</small>','manage_options','wvrx_ts', 'wvrx_ts_admin');
	/* using registered $page handle to hook stylesheet loading for this admin page */
    add_action('admin_print_styles-'.$page, 'wvrx_ts_admin_scripts');
}

add_action('admin_menu', 'wvrx_ts_admin_menu', 6);

function wvrx_ts_admin_scripts() {
    /* called only on the admin page, enqueue our special style sheet here (for tabbed pages) */
    wp_enqueue_style('wvrx_ts_sw_Stylesheet', wvrx_ts_plugins_url('/weaverx-ts-admin-style', WVRX_TS_MINIFY . '.css'), array(), WVRX_TS_VERSION);

    wp_enqueue_style ("thickbox");	// @@@@ if we use media browser...
    wp_enqueue_script ("thickbox");

    wp_enqueue_script('wvrx_ts_Yetii', wvrx_ts_plugins_url('/js/yetii/yetii',WVRX_TS_MINIFY.'.js'), array(),WVRX_TS_VERSION);
}

function wvrx_ts_plugins_url($file,$ext) {
    return plugins_url($file,__FILE__) . $ext;
}

function wvrx_ts_enqueue_scripts() {	// action definition

    if (function_exists('wvrx_ts_slider_header')) wvrx_ts_slider_header();

    //-- Weaver X PLus js lib - requires jQuery...


    // put the enqueue script in the tabs shortcode where it belongs

    //wp_enqueue_script('wvrxtsJSLib', wvrx_ts_plugins_url('/js/wvrx-ts-jslib', WVRX_TS_MINIFY . '.js'),array('jquery'),WVRX_TS_VERSION);


    // add plugin CSS here, too.

    wp_register_style('wvrx-ts-style-sheet',wvrx_ts_plugins_url('weaverx-ts-style', WVRX_TS_MINIFY.'.css'),null,WVRX_TS_VERSION,'all');
    wp_enqueue_style('wvrx-ts-style-sheet');
}

add_action('wp_enqueue_scripts', 'wvrx_ts_enqueue_scripts' );

function wvrx_ts_footer() {
}

add_action('wp_footer','wvrx_ts_footer', 9);

require_once(dirname( __FILE__ ) . '/includes/wvrx-ts-runtime-lib.php'); // NOW - load the basic library
require_once(dirname( __FILE__ ) . '/includes/wvrx-ts-widgets.php'); 		// widgets runtime library

require_once(dirname( __FILE__ ) . '/includes/wvrx-ts-shortcodes.php'); // load the shortcode definitions
?>
