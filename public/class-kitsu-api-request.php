<?php

/**
 *
 * This class defines implementation for querying Kitsu's API and return its data.
 *
 * @since      1.0.0
 * @package    Kitsu_Api_List
 * @subpackage Kitsu_Api_List/public
 * @author     Filipe Mendonça <filipesm.7@gmail.com>
 */
class Kitsu_API_Request {


    /**
     * Kitsu API endpoint
     *
     * @since       1.0.0
     * @access      public
     * @constant    string    API_ENDPOINT    Kitsu's API endpoint
     *
    */
    const ENPOINT = "https://kitsu.io/api/edge/";

    /**
     * Make a request to Kitsu API. Request is stored on client session data up to an hour
     * and is used in subsequent page requests until it expires.
     *
     * @since    1.0.0
     * @return   Array     widget options
     * @throws   Exception
     */
    public static function make_request( $url ) {
        $headers['Accept'] = 'application/vnd.api+json';
        $headers['Content-Type'] = 'application/vnd.api+json';

        $result = self::wp_http_request( $url, $headers );

        return $result['data'];
    }

    /**
     * Makes an http request using WP_Http class and returns and decodes it's body response.
     *
     * @since    1.0.0
     * @params   string    $url         Request url
     * @params   string    $headers     Request headers
     *
     * @return   Array     $result      Decoded API response data
     */
    private static function wp_http_request( $url, $headers ) {
	    $args = array();
	    $args['headers'] = $headers;

	    $wp_http = new WP_Http();
	    $result = $wp_http->request( $url, $args );

	    if( empty($result) || $result['response']['code'] != 200 ) {
	        throw new Exception();
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

	    $order_type = ( $options['order_type'] == "desc" ) ? '-' : '';

	    $params['sort'] = $order_type . $options['sort_type'];
	    $params['page[limit]'] = $options['items_per_page'];
	    $params['page[offset]'] = 0;

        return http_build_query( $params );
    }
}
