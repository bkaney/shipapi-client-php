<?php

require_once('Zend/Rest/Client.php');

class ShipApi_Request
{ 

    public $shipApi;
    public $xmlRequest;
    private $_zendRestClient;

    public function __construct($shipApi)
    {
        $this->shipApi = $shipApi;
        $this->_zendRestClient = new Zend_Rest_Client;
        $this->_zendRestClient->username($this->shipApi->username);
        $this->_zendRestClient->apikey($this->shipApi->apiKey);
    }

    public function sendRequest($method,$resource,array $data=null)
    {
        $fullUri = ShipApi_Request::parseUri($this->shipApi->baseUri, $resource);
        $rootNodeName = ShipApi_Request::parseNode($resource);
        $this->_zendRestClient->setUri($fullUri);
        $this->_zendRestClient->$rootNodeName($data);
        return $this->_zendRestClient->$method();
    }


    public static function parseUri($baseUri, $resource)
    {
        return $fullUri = $baseUri . $resource;
    }

    public static function parseNode($resource)
    {
        if (preg_match("/[0-9]$/", $resource)) {
            return preg_replace("/\/([^\/]*)(\/[0-9]*)$/", "\\1", $resource);
        } else {
            return preg_replace("/.*\/([^\/]*)$/", "\\1", $resource);
        }
    }

}
