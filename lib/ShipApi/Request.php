<?php

require_once('Zend/Rest/Client.php');
require_once 'Zend/Rest/Client/Exception.php';

class ShipApi_Request
{ 

    public $shipApi;
    public $xmlRequest;
    private $_zendRestClient;

    public function __construct($shipApi)
    {
        $this->shipApi = $shipApi;
        $this->_zendRestClient = new Zend_Rest_Client;
    }

    public function sendRequest($method,$resource,array $data=null)
    {
        $fullUri = ShipApi_Request::parseUri($this->shipApi->baseUri, $resource);
        $this->_zendRestClient->setAuth($this->shipApi->username, $this->shipApi->apiKey);
        $this->_zendRestClient->setUri($fullUri);

        $method = 'rest' . ucfirst(strtolower($method));
        $rootNodeName = ShipApi_Request::parseNode($resource);
        $response = $this->_zendRestClient->$method($rootNodeName . ".xml", $data);
        
        if($response->isSuccessful()) {
          return new Zend_Rest_Client_Result($response->getBody());
        } else {
          throw new Zend_Rest_Client_Exception('Error ' . $response->getStatus() . ": " . $response->getBody());          
        }
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
