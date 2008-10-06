<?php

require_once('Zend/Http/Client/Adapter/Test.php');


class ShipApi_Request_test extends UnitTestCase
{

    public function setUp()
    {
        $this->adapter = new Zend_Http_Client_Adapter_Test();
        $client = new Zend_Http_Client(null, array('adapter' => $this->adapter));
        Zend_Rest_Client::setHttpClient($client);
 

        $this->shipapi = new ShipApi('user','pass', 'http://www.test.com');
    }

    private function responseHeader()
    {
        return "HTTP/1.1 200 OK" . "\r\n" .
            "Content-type: text/xml" . "\r\n" . "\r\n" . 
            '<?xml version="1.0" encoding="UTF-8"?>';
    }

    public function testShipApi_Request_get()
    {
        $this->adapter->setResponse(
            $this->responseHeader() .
            '<shipments>
                <shipment>
                    <id type="integer">10</id>
                    <created-at type="datetime">2008-10-06T17:26:01-04:00</created-at>
                    <updated-at type="datetime">2008-10-06T17:26:06-04:00</updated-at>
                    <status>open</status>
                </shipment>
                <shipment>
                    <id type="integer">11</id>
                    <created-at type="datetime">2008-10-06T17:26:01-04:00</created-at>
                    <updated-at type="datetime">2008-10-06T17:26:06-04:00</updated-at>
                    <status>open</status>
                </shipment>
            </shipments>'
        );

        $shipments = $this->shipapi->get('/shipments');
        $this->assertEqual($shipments->shipment[0]->id[0], 10);
        $this->assertEqual($shipments->shipment[1]->id[0], 11);
    }

    public function testShipApi_Request_get_specific()
    {
        $this->adapter->setResponse(
            $this->responseHeader() .
            '<shipment>
                <id type="integer">10</id>
                <created-at type="datetime">2008-10-06T17:26:01-04:00</created-at>
                <updated-at type="datetime">2008-10-06T17:26:06-04:00</updated-at>
                <status>open</status>
            </shipment>'
        );

        $shipment = $this->shipapi->get('/shipments/10');
        $this->assertEqual($shipment->id(), 10);
    }

    public function testShipApi_Request_post()
    {
        $this->adapter->setResponse(
            $this->responseHeader() .
            '<shipment>
                <id type="integer">12</id>
                <created-at type="datetime">2008-10-06T17:26:01-04:00</created-at>
                <updated-at type="datetime">2008-10-06T17:26:06-04:00</updated-at>
                <status>open</status>
            </shipment>'
        );

        $data = array('created-at' => '2008-10-06T17:26:01-04:00',
            'updated-at' => '2008-10-06T17:26:06-04:00',
            'status' => 'open');
        $shipment = $this->shipapi->post('/shipments/12', $data);
        $this->assertEqual($shipment->id(), 12);
    }

    public function testShipApi_Request_put()
    {
        print " P : Pending `" . __FUNCTION__ . "' until we work out Zend_Rest_Client's PUT option\n"; return;

        $this->adapter->setResponse(
            $this->responseHeader() .
            '<shipment>
                <id type="integer">13</id>
                <created-at type="datetime">2008-10-06T17:26:01-04:00</created-at>
                <updated-at type="datetime">2008-10-06T17:26:06-04:00</updated-at>
                <status>closed</status>
            </shipment>'
        );

        $data = array('status' => 'closed');
        $shipment = $this->shipapi->put('/shipments/13', $data);
        $this->assertEqual($shipment->status(), 'closed');
    }

    public function testShipApi_Request_delete()
    {
        print " P : Pending `" . __FUNCTION__ . "' until we work on a better exception handler.\n"; return;

        $this->adapter->setResponse(
            $this->responseHeader() .
            '<shipment></shipment>'
        );

        $shipment = $this->shipapi->delete('/shipments/13');
        $this->expectError(
            $shipment->shipment->id()
        );
    }
}

class ShipApi_Request_static_methods_test extends UnitTestCase
{
    public $base = 'https://test.com';

    public $resource_simple = '/shipments';
    public $resource_with_id = '/shipments/10';
    public $resource_nested = '/shipments/10/packages';


    function testShipApi_Request_parseUri_should_parse_simple()
    {
        $uri = ShipApi_Request::parseUri($this->base, $this->resource_simple);
        $this->assertEqual($uri, $this->base . $this->resource_simple);
    }

    function testShipApi_Request_parseNode_should_parse_simple()
    {
        $node = ShipApi_Request::parseNode($this->resource_simple);
        $this->assertEqual($node, 'shipments');
    }

    function testShipApi_Request_parseUri_should_parse_with_id()
    {
        $uri = ShipApi_Request::parseUri($this->base, $this->resource_with_id);
        $this->assertEqual($uri, $this->base . $this->resource_with_id);
    }

    function testShipApi_Request_parseNode_should_parse_with_id()
    {
        $node = ShipApi_Request::parseNode($this->resource_with_id);
        $this->assertEqual($node, 'shipments');
    }

    function testShipApi_Request_parseUri_should_parse_nested()
    {
        $uri = ShipApi_Request::parseUri($this->base, $this->resource_nested);
        $this->assertEqual($uri, $this->base . $this->resource_nested);
    }

    function testShipApi_Request_nodeUri_should_parse_nested()
    {
        $node = ShipApi_Request::parseNode($this->resource_nested);
        $this->assertEqual($node, 'packages');
    }



}
