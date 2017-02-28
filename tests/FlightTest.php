<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/City.php";
    require_once "src/Flight.php";

    $server = 'mysql:host=localhost:8889;dbname=airline_planner_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class FlightTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            City::deleteAll();
            Flight::deleteAll();
        }

        function test_getDepartureCityName()
        {
            $new_city = new City("Portland");
            $new_city->save();

            $city_id = $new_city->getId();

            $new_flight = new Flight("2017-03-22 12:12:12 pm", $city_id, 364, 3);
            $new_flight->save();

            $result = $new_flight->getDepartureCityName();

            $this->assertEquals($result, "Portland");
        }

    }
?>
