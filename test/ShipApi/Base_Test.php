<?php

require_once('simpletest/autorun.php');
require_once('ShipApi.php');

class ShipApi_BaseTest extends UnitTestCase {

    public $username;
    public $apiKey;

    public function setUp() {
        $username = 'joe';
        $apiKey = '123456';
    }

    public function testShipApi_should_error_without_username()
    {
        $this->username = null;
        $shipApi = new ShipApi($this->username, $this->apiKey;
        $this->assertError();
    }


    public function testShipApi_should_error_without_apiKey()
    {
        $this->apiKey = null;
        $shipApi = new ShipApi($this->username, $this->apiKey;
        $shipApi = new ShipApi();
        $this->assertError();
    }

}

