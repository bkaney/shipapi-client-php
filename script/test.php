#!/usr/bin/php 
<?php

ini_set('include_path', ini_get('include_path').':'.
                        dirname(__FILE__).'/../:'.
                        dirname(__FILE__).'/../lib:'.
                        dirname(__FILE__).'/../test'); 

require_once('simpletest/unit_tester.php');
require_once('simpletest/reporter.php');

require_once('ShipApi.php');

// TODO: Create a dynamic test harness here...
require_once('test/ShipApi/Base_test.php');
$test = &new shipapi_base_test();
$test->run(new textreporter());


require_once('test/ShipApi/Request_test.php');
$test = &new shipapi_request_test();
$test->run(new textreporter());
