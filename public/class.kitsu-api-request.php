<?php

/**
 *
 * This class defines implementation for querying Kitsu's API and return its data.
 *
 * @since      1.0.0
 * @package    Kitsu_Anime_List
 * @subpackage Kitsu_Anime_List/public
 * @author     Filipe Mendonça <filipesm.7@gmail.com>
 */
class Kitsu_API_Request extends WP_Http {


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
     * Headers used for Kitsu API request.
     *
     * @since    1.0.0
     * @access   private
     * @var      Array    $headers   request headers
     *
     */
    private $headers;

    /**
     * Initialize the class and build request headers.
     *
     * @since    1.0.0
     */
	public function __construct() {
        $this->build_request_headers();
	}

    /**
     * Retrieve from Kitsu API a list of anime with the best rating.
     *
     * @since    1.0.0
     */
	public function get_top_anime() {
	    $args = array();
	    $args['headers'] = $this->headers;

	    /*TODO cache results*/

	    /*TODO fetch filter params*/
	    $uri = 'anime?sort=-averageRating&page[limit]=10&page[offset]=0';

	    $result = $this->request( self::ENPOINT . $uri, $args );

	    if( empty($result) || $result['response']['code'] != 200 ) {
	        throw new Exception( "Invalid response from API!" );
        }

	    return json_decode( $result['body'], TRUE );
    }

    /**
     * Build Kitsu request headers.
     *
     * @since    1.0.0
     */
    public function build_request_headers() {
	    $this->headers['Accept'] = 'application/vnd.api+json';
	    $this->headers['Content-Type'] = 'application/vnd.api+json';
    }
}
