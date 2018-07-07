<?php

/**
 * Fired during plugin activation
 *
 * @link       http://github.com/filipesm-7
 * @since      1.0.0
 *
 * @package    Kitsu_Api_List
 * @subpackage Kitsu_Api_List/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Kitsu_Api_List
 * @subpackage Kitsu_Api_List/includes
 * @author     Filipe Mendonça <filipesm.7@gmail.com>
 */
class Kitsu_Api_List_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
        $plugin_data = get_plugin_data( dirname( __FILE__ ) . '/../kitsu-api-list.php' );

        update_option( $plugin_data['TextDomain'], array( 'items_per_page' => Kitsu_Api_List_Admin::DEFAULT_ITEMS_SHOWN ) );
	}

}