<?php namespace Tekton\API;

use GuzzleHttp\Client;

class ApiManager {

    use \Tekton\Support\Traits\LibraryWrapper;

    protected $clients = array();
    protected $timeout;

    function __construct($timeout = 10.0) {
        $this->timeout = $timeout;

        // Default client
        $this->library = new Client(array(
            'timeout' => $this->timeout,
        ));
    }

    function client($uri, $key = '', $args = array()) {
        // Set client key
        if ( ! $key) {
            $key = $uri;
        }

        // Fetch client if already initialized
        if (isset($this->clients[$key])) {
            return $this->clients[$key];
        }

        // Set guzzle args
        $args = array_merge(array(
            'base_uri' => $uri, 'timeout' => 5.0
        ), $args);

        return $this->clients[$key] = new Client($args);
    }
}
