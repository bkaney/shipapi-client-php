<?php

require_once('Zend/Rest/Client.php');


/**
 * This manages our communication with the ShipAPI
 * webservice.  It is responsible for encoding and
 * decoding messages to/from ShipApi.
 *
 * It also creates instances of ShipApi_Request and
 * ShipApi_Response.
 *
 * This isn't really intended to be used directly, 
 * rather is is used by ShipApi.
 *
 */
class ShipApi_Comm 
{
    public $request = null;
    public $response = null;
    public $shipApi = null;

    private $_connection = null;

    public function __construct($shipApi)
    {
        $this->shipApi = $shipApi;
    }

    public function openConnection()
    {
//        try {
            $this->_handle = fopen($this->shipApi->SHIPAPI_URI, "r");
//        }
    }
}
