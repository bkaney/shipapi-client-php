<?php

class ShipApi_Base_test extends UnitTestCase
{

    public $username;
    public $apiKey;

    public function setUp() 
    {
        $this->username = 'joe';
        $this->apiKey = '123456';
    }

    public function testShipApi_should_be_valid()
    {
        $shipApi = &new ShipApi($this->username, $this->apiKey);
        $this->assertNotNull($shipApi);
        $this->assertIsA($shipApi, 'ShipApi');
    }

    public function testShipApi_should_error_without_username()
    {
        $this->expectException(ShipApi_Error);
        $this->username = null;
        $shipApi = &new ShipApi($this->username, $this->apiKey);
    }


    public function testShipApi_should_error_without_apiKey()
    {
        $this->expectException(ShipApi_Error);
        $this->apiKey = null;
        $shipApi = &new ShipApi($this->username, $this->apiKey);
        $this->assertError();
    }

}

