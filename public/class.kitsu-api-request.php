<?php

require_once dirname( __FILE__ ) . '/../includes/class-kitsu-anime-list-session-manager.php';

/**
 *
 * This class defines implementation for querying Kitsu's API and return its data.
 *
 * @since      1.0.0
 * @package    Kitsu_Anime_List
 * @subpackage Kitsu_Anime_List/public
 * @author     Filipe Mendonça <filipesm.7@gmail.com>
 */
class Kitsu_API_Request {


    /**
     * Kitsu API endpoint
     *
     * @since    1.0.0
     * @access   public
     * @constant      string    API_ENDPOINT    Kitsu's API endpoint
     *
    */
    const ENPOINT = "https://kitsu.io/api/edge/";

    /**
     * Kitsu anime query uri
     *
     * @since    1.0.0
     * @access   public
     * @constant      string    API_ENDPOINT    Kitsu anime query uri
     *
     */
    const ANIME_QUERY = "anime";

    /**
     * Make a request to Kitsu API. Request is stored on client session data up to an hour
     * and is used in subsequent page requests until it expires.
     *
     * @since    1.0.0
     * @params   string    $request_type    Kitsu anime query uri
     * @return   Array     API response data
     * @throws Exception
     */
	public static function make_request( $request_type, $options= array() ) {
        $session_manager = SessionManagerSingleton::get_instance();

        $query_string = self::build_query_string( $options );
        $url = self::ENPOINT . $request_type . '?' . $query_string;
        
        $result = $session_manager::get_client_session_data( $url );

        if( /*empty( $result )*/ true ) {
            $headers['Accept'] = 'application/vnd.api+json';
            $headers['Content-Type'] = 'application/vnd.api+json';

            $result = self::wp_http_request( $url, $headers );

            $session_manager::save_client_session_data( $url, $result );
        }

        return $result;
    }

    /**
     * Makes an http request using WP_Http class and returns and decodes it's body response.
     *
     * @since    1.0.0
     * @params   string    $url         Request url
     * @params   string    $headers     Request headers
     *
     * @return   Array     $result         Decoded API response data
     */
	public static function wp_http_request( $url, $headers ) {
	    $args = array();
	    $args['headers'] = $headers;

	    $wp_http = new WP_Http();
	    $result = $wp_http->request( $url, $args );

	    if( empty($result) || $result['response']['code'] != 200 ) {
	        throw new Exception( "Invalid response from API!" );
        }

	    return json_decode( $result['body'], TRUE );
    }

    /**
     * Generates the query string based on the widget options.
     *
     * @since    1.0.0
     * @params   Array    $options         The widget options
     *
     * @return   string         The request query string
     */
    public static function build_query_string( $options ) {
	    $params = array();
	    $params['sort'] = '-averageRating';
	    $params['page[limit]'] = $options['items_per_page'];
	    $params['page[offset]'] = 0;

	    return http_build_query( $params );
    }

}
