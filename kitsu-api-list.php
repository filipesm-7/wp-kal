<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
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
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-kitsu-api-list-activator.php
 */
function activate_kitsu_api_list() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-kitsu-api-list-activator.php';
	Kitsu_Api_List_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-kitsu-api-list-deactivator.php
 */
function deactivate_kitsu_api_list() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-kitsu-api-list-deactivator.php';
	Kitsu_Api_List_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_kitsu_api_list' );
register_deactivation_hook( __FILE__, 'deactivate_kitsu_api_list' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-kitsu-api-list.php';

$plugin = new Kitsu_Api_List();
$plugin->run();
