<?php

class ShipApi
{

    const GET       = 'get';
    const PUT       = 'put';
    const POST      = 'post';
    const DELETE    = 'delete';

    /**
     * The URI for ShipAPI to communicate to. 
     */
     public static $base_uri = 'https://test.shipapi.com';

    /**
     * The username
     * @var string
     */
    public static $username = null;

    /**
     * The API key for the user
     * @var string
     */
    public static $apiKey = null;


    /**
     * Constructor for the ShipAPI object.
     *
     * @param string @username  The ShipAPI username
     * @param string @apiKey    The ShipAPI API Key
     * @param string @baseUri   The ShipAPI base URI
     * @return ShipAPI
     */
    public function __construct($username, $apiKey, $baseUri='')
    {
        if (!($apiKey)) { throw new ShipApi_Error("Need an apiKey!"); }
        if (!($username)) { throw new ShipApi_Error("Need a username!"); }
        $this->username = $username;
        $this->apiKey = $apiKey;
        if ($baseUri) {
            $this->baseUri = $uri;
        }
    }

    public function get($resource)
    {
        return $this->sendRequest(GET,$resource);
    }

    public function post($resource, $data)
    {
        return $this->sendRequest(POST,$resource,$data);
    }

    public function delete($resource)
    {
        return $this->sendRequest(DELETE,$resource);
    }

    public function put ($resource, $data)
    {
        return $this->sendRequest(PUT,$uri,$data);
    }


    private function sendRequest($method, $resource, array $data=null)
    {
        $this->request = new ShipAPI_Request($this);
        return $this->request->send($method,$resource,$data);
    }

}
