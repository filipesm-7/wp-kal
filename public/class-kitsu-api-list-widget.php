<?php

//Load session manager class that will store api requests
require plugin_dir_path( __FILE__ ) . '../includes/class-kitsu-api-list-session-manager.php';

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
     * Session manager singleton.
     *
     * @since    1.0.0
     * @access   private
     * @var      Kitsu_Api_List_Session_Manager_Singleton    $session_manager    Session manager singleton.
     */
    private $session_manager;

    /**
     * Initialize the class and parent class. Get the instance of the Session Manager class and store it.
     *
     * @since    1.0.0
     */
	public function __construct() {
	    load_plugin_textdomain( $this->plugin_name );

	    $this->session_manager = Kitsu_Api_List_Session_Manager_Singleton::get_instance();
		parent::__construct(
			$this->plugin_name . '_widget',
			__( 'Kitsu API List Widget' , $this->plugin_name),
			array(
			    'description' => __( 'Customize Kitsu API Widget' , $this->plugin_name ),
                'customize_selective_refresh' => true
            )
		);
	}

    /**
     * Build the widget form.
     *
     * @since    1.0.0
     * @param    array    $instance       .
     */
	public function form( $instance ) {

        // Set widget defaults
        $defaults = array(
            'title'             => __( 'Kitsu API List' , $this->plugin_name ),
            'items_per_page'    => 5,
            'search_type'       => 'anime',
            'sort_type'         => 'averageRating',
            'order_type'        => 'desc',
            'trending'          => ''
        );
        $max_items_per_page = 20;

        // Parse current settings with defaults
        extract( wp_parse_args( ( array ) $instance, $defaults ) );

        include( plugin_dir_path(__FILE__) . '../admin/partials/kitsu-api-list-widget-admin-display.php' );

	}

    /**
     * Save widget form data.
     *
     * @since    1.0.0
     * @param    array    $new_instance
     * @param    array    $old_instance
     */
	public function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['items_per_page'] = $new_instance['items_per_page'];
        $instance['search_type'] = $new_instance['search_type'];
        $instance['sort_type'] = $new_instance['sort_type'];
        $instance['order_type'] = $new_instance['order_type'];
        $instance['trending'] = $new_instance['trending'];

		return $instance;
	}

    /**
     * Render widget on the website.
     *
     * @since    1.0.0
     * @param      Object    $args
     * @param      Object    $instance
     */
	public function widget( $args, $instance ) {
        extract( $args );

        // WordPress core before_widget hook (always include )
        echo $before_widget;

        try {
            $list = $this->get_api_data( $instance );

            if( empty( $list ) ) {
                throw new Exception();
            }

            $nr_items = count( $list );

            //for some reason, Kitsu API trending search does not work with limit attribute so we cut the extra results
            if ( $instance['trending'] == '1' && $nr_items > $instance['items_per_page'] ) {
                array_splice( $list, 0, ( $nr_items - $instance['items_per_page'] ) );
            }

            include dirname(__FILE__) . '/partials/kitsu-api-list-widget-display.php';

        } catch ( Exception $e ) {
            echo _e( "No results were found.", $this->plugin_name );
        }

        // WordPress core after_widget hook (always include )
        echo $after_widget;
	}

    /**
     * Load Kitsu list for the widget's options. Use stored results in session if they exist
     * and haven't expired
     *
     * @since    1.0.0
     * @param    array    $widget_options
	 * @return   array    					List returned from Kitsu's API.
     */
	public function get_api_data( $widget_options ) {
	    $session_manager = $this->session_manager;

        $query_string = Kitsu_API_Request::build_query_string( $widget_options );
        $search_type = ( $widget_options['trending'] == '1' ) ? 'trending/' . $widget_options['search_type'] : $widget_options['search_type'];

        $url = Kitsu_API_Request::ENPOINT . $search_type . '?' . $query_string;

        $list = $session_manager::get_client_session_data( $url );
        if ( empty( $list ) ) {
            $list = Kitsu_API_Request::make_request( $url );

            //save list to session
            $session_manager::save_client_session_data( $url, $list );
        }
        return $list;
    }
}
