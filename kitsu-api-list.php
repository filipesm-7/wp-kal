<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin.
 *
 * @link              http://github.com/filipesm-7
 * @since             1.0.0
 * @package           Kitsu_Api_List
 *
 * @wordpress-plugin
 * Plugin Name:       Kitsu API List
 * Plugin URI:        http://github.com/filipesm-7/wp-kal
 * Description:       Kitsu API List is a widget that allows you a list of anime or manga from their database, while giving the ability to customize your list.
 * Version:           1.0.0
 * Author:            Filipe Mendonça
 * Author URI:        http://github.com/filipesm-7
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       kitsu-api-list
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-kitsu-api-list.php';

$plugin = new Kitsu_Api_List();
$plugin->run();
