<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://github.com/filipesm-7
 * @since      1.0.0
 *
 * @package    Kitsu_Anime_List
 * @subpackage Kitsu_Anime_List/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Kitsu_Anime_List
 * @subpackage Kitsu_Anime_List/includes
 * @author     Filipe Mendonça <filipesm.7@gmail.com>
 */
class Kitsu_Anime_List_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'kitsu-anime-list',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
