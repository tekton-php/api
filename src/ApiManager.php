<?php namespace Tekton\API;

use GuzzleHttp\Client;
use Tekton\Support\Repository;

class ApiManager
{
    use \Tekton\Support\Traits\LibraryWrapper;

    protected $clients = array();
    protected $config;

    function __construct($config = [])
    {
        $this->config = new Repository($config);

        // Default client
        $this->library = new Client(array(
            'timeout' => $this->config->get('timeout', 10.0),
        ));
    }

    function client($uri, $key = '', $args = array())
    {
        // Set client key
        if (! $key) {
            $key = $uri;
        }

        // Fetch client if already initialized
        if (isset($this->clients[$key])) {
            return $this->clients[$key];
        }

        // Set guzzle args
        $args = array_merge(array(
            'base_uri' => $uri, 'timeout' => $this->config->get('timeout', 10.0)
        ), $args);

        return $this->clients[$key] = new Client($args);
    }
}
