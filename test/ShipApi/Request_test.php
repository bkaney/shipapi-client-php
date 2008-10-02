<?php

class ShipApi_Request_test extends UnitTestCase
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
