<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/City.php";

    $server = 'mysql:host=localhost:8889;dbname=airline_planner_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CategoryTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            // City::deleteAll();
            // Flight::deleteAll();
        }

        function test_getName()
        {
          //Arrange
          $name = "Portland";
          $test_city = new City($name);

          //Act
          $result = $test_city->getName();

          //Assert
          $this->assertEquals($name, $result);
        }

        function testSetName()
        {
            //Arrange
            $name = "Portland";
            $test_city = new City($name);

            //Act
            $test_city->setName("Brooklyn");
            $result = $test_city->getName();

            //Assert
            $this->assertEquals("Brooklyn", $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Portland";
            $id = 1;
            $test_City = new City($name, $id);

            //Act
            $result = $test_City->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

    }
?>
