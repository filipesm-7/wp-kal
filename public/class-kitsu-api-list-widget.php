<?php

/**
 *
 * This class defines all code necessary for showing widget form and data.
 *
 * @since      1.0.0
 * @package    Kitsu_Api_List
 * @subpackage Kitsu_Api_List/public
 * @author     Filipe Mendonça <filipesm.7@gmail.com>
 */
class Kitsu_Api_List_Widget extends WP_Widget {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name = "kitsu-api-list";

    /**
     * Widget data from the api.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $data;

    /**
     * Initialize the class and parent class.
     *
     * @since    1.0.0
     */
	public function __construct() {
	    load_plugin_textdomain( $this->plugin_name );

	    $this->load_api_data( new Kitsu_API_Request() );
		
		parent::__construct(
			$this->plugin_name . '_widget',
			__( 'Kitsu Api List Widget' , $this->plugin_name),
			array( 'description' => __( 'Description test' , $this->plugin_name) )
		);
	}

    /**
     * Build the widget form.
     *
     * @since    1.0.0
     * @param      Array    $instance       .
     */
	public function form( $instance ) {

		if ( $instance && isset( $instance['title'] ) ) {
			$title = $instance['title'];
		}
		else {
			$title = __( 'Title' , $this->plugin_name );
		}

        include( plugin_dir_path(__FILE__) . '../admin/partials/kitsu-api-list-widget-admin-display.php' );

	}

    /**
     * Save widget form data.
     *
     * @since    1.0.0
     * @param      Array    $new_instance
     * @param      Array    $old_instance
     */
	public function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}

    /**
     * Display widget on the website.
     *
     * @since    1.0.0
     * @param      Object    $args
     * @param      Object    $instance
     */
	public function widget( $args, $instance ) {
        extract( $args );

        // WordPress core before_widget hook (always include )
        echo $before_widget;

        $list = $this->data;

        include_once dirname(__FILE__) . '/partials/kitsu-api-list-widget-display.php';

        // WordPress core after_widget hook (always include )
        echo $after_widget;
	}

    /**
     * Load Kitsu API data.
     *
     * @since    1.0.0
     * @param      Object    $args
     * @param      Object    $instance
     */
	public function load_api_data(Kitsu_API_Request $api) {
        $this->data = array();

	    try {
            $result = $api->make_request( $api::ANIME_QUERY, get_option($this->plugin_name) );
            $this->data = $result['data'];
        } catch ( Exception $e ) {
	        /* TODO treat exception as needed */
        }
    }

}
