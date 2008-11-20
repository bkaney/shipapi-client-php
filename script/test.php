#!/usr/bin/php 
<?php

ini_set('include_path', ini_get('include_path').':'.
                        dirname(__FILE__).'/../:'.
                        dirname(__FILE__).'/../lib:'.
                        dirname(__FILE__).'/../test'); 

require_once('simpletest/unit_tester.php');
require_once('simpletest/reporter.php');
require_once('simpletest/mock_objects.php');
require_once('simpletest/autorun.php');

require_once('ShipApi.php');

class AllTests extends TestSuite {
    function AllTests() {
        $this->TestSuite('All Tests');
        $this->addFile('test/ShipApi/Base_test.php');
        $this->addFile('test/ShipApi/Request_test.php');
    }
}


if (!defined('RUNNER')) {
    define('RUNNER', true);
    $test = &new AllTests();
    $test->run(new TextReporter());
}


