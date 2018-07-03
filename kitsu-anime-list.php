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
 * @package           Kitsu_Anime_List
 *
 * @wordpress-plugin
 * Plugin Name:       Kitsu Anime List
 * Plugin URI:        http://github.com/filipesm-7/kitsu-anime-list
 * Description:       Kitsu Anime List allows you to show the top anime listed on Kitsu's website.
 * Version:           1.0.0
 * Author:            Filipe Mendonça
 * Author URI:        http://github.com/filipesm-7
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       kitsu-anime-list
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
 * This action is documented in includes/class-kitsu-anime-list-activator.php
 */
function activate_kitsu_anime_list() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-kitsu-anime-list-activator.php';
	Kitsu_Anime_List_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-kitsu-anime-list-deactivator.php
 */
function deactivate_kitsu_anime_list() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-kitsu-anime-list-deactivator.php';
	Kitsu_Anime_List_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_kitsu_anime_list' );
register_deactivation_hook( __FILE__, 'deactivate_kitsu_anime_list' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-kitsu-anime-list.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_kitsu_anime_list() {

	$plugin = new Kitsu_Anime_List();
	$plugin->run();

}
run_kitsu_anime_list();
