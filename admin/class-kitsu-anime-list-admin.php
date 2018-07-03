<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://github.com/filipesm-7
 * @since      1.0.0
 *
 * @package    Kitsu_Anime_List
 * @subpackage Kitsu_Anime_List/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Kitsu_Anime_List
 * @subpackage Kitsu_Anime_List/admin
 * @author     Filipe Mendonça <filipesm.7@gmail.com>
 */
class Kitsu_Anime_List_Admin {

    /**
     * Maximum number of items shown on KAL plugin.
     *
     * @since    1.0.0
     * @access   public
     * @const      integer    MAX_ITEMS_SHOWN    Maximum number of items shown on KAL plugin.
     */
    const MAX_ITEMS_SHOWN = 5;

    /**
     * Default number of items shown on KAL plugin.
     *
     * @since    1.0.0
     * @access   public
     * @const      integer    MAX_ITEMS_SHOWN    Default number of items shown on KAL plugin.
     */
    const DEFAULT_ITEMS_SHOWN = 4;

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Kitsu_Anime_List_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Kitsu_Anime_List_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/kitsu-anime-list-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Kitsu_Anime_List_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Kitsu_Anime_List_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/kitsu-anime-list-admin.js', array( 'jquery' ), $this->version, false );

	}

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    1.0.0
     */

    public function add_plugin_admin_menu() {
        add_options_page( 'Kitsu Anime List', 'Kitsu Anime List', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
        );
    }


    /**
     * Add settings action link to the plugins page.
     *
     * @since    1.0.0
     */

    public function add_action_links( $links ) {
        $settings_link = array(
            '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
        );
        return array_merge(  $settings_link, $links );

    }

    /**
     * Render the settings page for this plugin.
     *
     * @since    1.0.0
     */

    public function display_plugin_setup_page() {
        include_once( 'partials/kitsu-anime-list-admin-display.php' );
    }

    /**
     * Store form data to DB.
     *
     * @since    1.0.0
     */

    public function options_update() {
        register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
    }

    /**
     * Validate admin form for this plugin.
     *
     * @since    1.0.0
     */

    public function validate($input) {
        $valid = array();

        $valid['items_per_page'] = ( $input['items_per_page'] > 1 && $input['items_per_page'] <= self::MAX_ITEMS_SHOWN ) ? $input['items_per_page'] : self::DEFAULT_ITEMS_SHOWN;

        return $valid;
    }
}
