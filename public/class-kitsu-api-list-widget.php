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
     * Session manager singleton.
     *
     * @since    1.0.0
     * @access   private
     * @var      SessionManagerSingleton    $session_manager    Session manager singleton.
     */
    private $session_manager;

    /**
     * Widget options.
     *
     * @since    1.0.0
     * @access   private
     * @var      Array    $options    Widget options.
     */
    private $options = array();

    /**
     * Initialize the class and parent class.
     *
     * @since    1.0.0
     */
	public function __construct() {
	    load_plugin_textdomain( $this->plugin_name );

	    $this->session_manager = SessionManagerSingleton::get_instance();
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
     * @param      Array    $instance       .
     */
	public function form( $instance ) {

        // Set widget defaults
        $defaults = array(
            'title'             => __( 'Kitsu API List' , $this->plugin_name ),
            'items_per_page'    => 5,
            'search_type'       => 'anime',
            'sort_type'         => 'averageRating',
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
     * @param      Array    $new_instance
     * @param      Array    $old_instance
     */
	public function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['items_per_page'] = $new_instance['items_per_page'];
        $instance['search_type'] = $new_instance['search_type'];
        $instance['sort_type'] = $new_instance['sort_type'];

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

        try {
            $list = $this->get_api_data( $instance );

            if( empty( $list ) ) {
                throw new Exception();
            }

            // WordPress core before_widget hook (always include )
            echo $before_widget;

            include_once dirname(__FILE__) . '/partials/kitsu-api-list-widget-display.php';

            // WordPress core after_widget hook (always include )
            echo $after_widget;

        } catch ( Exception $e ) {
            echo _e( "No results were found.", $this->plugin_name );
        }
	}

    /**
     * Load Kitsu list for the widget's options. Use stored results in session if they exist
     * and haven't expired
     *
     * @since    1.0.0
     * @param      Array    $widget_options
     */
	public function get_api_data( $widget_options ) {
	    $session_manager = $this->session_manager;

        $query_string = Kitsu_API_Request::build_query_string( $widget_options );
        $url = Kitsu_API_Request::ENPOINT . $widget_options['search_type'] . '?' . $query_string;

        $list = $session_manager::get_client_session_data( $url );
        if ( empty( $list ) ) {
            $list = Kitsu_API_Request::make_request( $url );

            //save list to session
            $session_manager::save_client_session_data( $url, $list );
        }
        return $list;
    }
}
