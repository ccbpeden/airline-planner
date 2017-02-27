<?php
    class City
    {
        private $name;
        private $id;

        function __construct($new_name, $id = null)
        {
            $this->name = $new_name;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function getId()
        {
            return $this->id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO cities (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_cities = $GLOBALS['DB']->query("SELECT * FROM cities");
            $cities = array();
            foreach($returned_cities as $city)
            {
                $name = $city['name'];
                $id = $city['id'];
                $new_city = new City($name, $id);
                array_push($cities, $new_city);
            }
            return $cities;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM cities;");
        }

        static function find($input_id)
        {
            $returned_cities = City::getAll();
            foreach($returned_cities as $returned_city)
            {
                $returned_id = $returned_city->getId();
                if($returned_id == $input_id)
                {
                    return $returned_city;
                }
            }
        }
    }

?>
