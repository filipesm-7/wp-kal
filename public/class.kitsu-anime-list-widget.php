<?php

/**
 *
 * This class defines all code necessary for showing widget form and data.
 *
 * @since      1.0.0
 * @package    Kitsu_Anime_List
 * @subpackage Kitsu_Anime_List/public
 * @author     Filipe Mendonça <filipesm.7@gmail.com>
 */
class Kitsu_Anime_List_Widget extends WP_Widget {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name = "kitsu-anime-list";

    /**
     * Initialize the class and parent class.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
	public function __construct() {
	    load_plugin_textdomain( $this->plugin_name );
		
		parent::__construct(
			$this->plugin_name . '_widget',
			__( 'Kitsu Anime List Widget' , $this->plugin_name),
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

        include( plugin_dir_path(__FILE__) . '../admin/partials/kitsu-anime-list-widget-admin-display.php' );

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

        include_once dirname(__FILE__) . '/partials/kitsu-anime-list-widget-display.php';

        // WordPress core after_widget hook (always include )
        echo $after_widget;
	}
}
