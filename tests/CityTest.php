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
            City::deleteAll();
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

        function test_saveGetAll()
        {

            $name = "Portland";
            $id = 1;
            $test_city = new City($name, $id);
            $test_city->save();
            $name2 = "Brooklyn";
            $id2 = 2;
            $test_city2 = new City($name2, $id2);
            $test_city2->save();

            $result = City::getAll();

            $this->assertEquals([$test_city, $test_city2], $result);
        }

        function test_find()
        {
            $name = "Portland";
            $test_city = new City($name);
            $test_city->save();
            $id=$test_city->getId();
            $name2 = "Brooklyn";
            $test_city2 = new City($name2);
            $test_city2->save();

            $result = City::find($id);

            $this->assertEquals($test_city, $result);
        }

        function test_delete()
        {
            $name = "Portland";
            $test_city = new City($name);
            $test_city->save();
            $id=$test_city->getId();
            $name2 = "Brooklyn";
            $test_city2 = new City($name2);
            $test_city2->save();

            $test_city->delete();
            $result = City::getAll();

            $this->assertEquals([$test_city2], $result);
        }
    }
?>
