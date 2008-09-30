<?php

class ShipApi
{

    /**
     * The URI for ShipAPI to communicate to. 
     */
    const SHIPAPI_URI = 'https://live.shipapi.com';

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
     * @return ShipAPI
     */
    public function __construct($username, $apiKey)
    {
        if (!($apiKey)) { throw new ShipApi_Error("Need an apiKey!"); }
        if (!($username)) { throw new ShipApi_Error("Need a username!"); }
        $this->username = $username;
        $this->apiKey = $apiKey;
    }

    /**
     * Send a ShipAPI_Request
     *
     * @param array $requestHash A named-hash, the request
     * @return ShipApi_Response
     */
    public function sendRequest($requestHash)
    {
        $this->request = new ShipAPI_Request($this, $requestHash);
        return $this->request->send;
    }

}
