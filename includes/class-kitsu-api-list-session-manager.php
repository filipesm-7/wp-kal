<?php

/**
 * Session Manager Singleton class
 *
 * This class is used to manage client session data. In the plugin
 * context, this will store for a period of an hour the result to any given
 * request in the api
 *
 * @since      1.0.0
 * @package    Kitsu_Api_List
 * @subpackage Kitsu_Api_List/includes
 * @author     Filipe Mendonça <filipesm.7@gmail.com>
 */
class Kitsu_Api_List_Session_Manager_Singleton {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      Kitsu_Api_List_Session_Manager_Singleton    $instance    Stores the class instance.
	 */
	public static $instance;


	/**
	 * Override constructor and make it unable to be instanciated outside this class.
	 *
	 * @since    1.0.0
	 */
	private function __construct() {}

    /**
     * Override clonde method and make it unable to be used outside this class.
     *
     * @since    1.0.0
     */
    private function __clone() {}

    /**
     * Return class instance.
     *
     * @since    1.0.0
     * @return   Kitsu_Api_List_Session_Manager_Singleton    This class instance.
     */
    public static function get_instance() {
        static $instance = null;
        if ( null === $instance ) {
            $instance = new static();
            $instance::start_client_session();
        }

        return $instance;
    }

    /**
     * Start client session if one was not started yet.
     *
     * @since    1.0.0
     */
    private static function start_client_session() {
        if ( !session_id() ) {
            session_start();
        }
    }

    /**
     * Returns session data for the given key if it exists and has not expired yet.
     *
     * @since    1.0.0
     * @param    string    $key	$_SESSION key.
     * @return   array     Data saved on client session or an empty array.
     */
    public static function get_client_session_data( $key ) {
        return ( !empty( $_SESSION[$key] ) && $_SESSION[$key]['expire_date'] > ( time() ) ) ? $_SESSION[$key]['data'] : [];
    }

    /**
     * Saves session data for the given key and sets an one hour expire date.
     *
     * @since    1.0.0
     * @param    string    $key
     * @param    mixed     $data
     */
    public static function save_client_session_data( $key, $data ) {
        $_SESSION[$key] = array(
            'data' => $data,
            'expire_date' => time()+3600
        );
    }

}
