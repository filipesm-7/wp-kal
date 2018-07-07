<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://github.com/filipesm-7
 * @since      1.0.0
 *
 * @package    Kitsu_Api_List
 * @subpackage Kitsu_Api_List/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Kitsu_Api_List
 * @subpackage Kitsu_Api_List/includes
 * @author     Filipe Mendonça <filipesm.7@gmail.com>
 */
class Kitsu_Api_List_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
        $plugin_data = get_plugin_data( dirname( __FILE__ ) . '/../kitsu-api-list.php' );

        delete_option( $plugin_data['TextDomain'] );
	}

}