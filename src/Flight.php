<?php
    Class Flight
    {
        private $id;
        private $departure_time;
        private $departure_city_id;
        private $arrival_city_id;
        private $status;

        function __construct($departure_time, $departure_city_id, $arrival_city_id, $status, $id = null)
        {
            $this->departure_time = $departure_time;
            $this->departure_city_id = $departure_city_id;
            $this->arrival_city_id = $arrival_city_id;
            $this->status = $status;
            $this->id = $id;
        }

        function getId()
        {
            return $this->id;
        }

        function getDepartureTime()
        {
            return $this->departure_time;
        }

        function getDepartureCity()
        {
            return $this->departure_city_id;
        }

        function getArrivalCity()
        {
            return $this->arrival_city_id;
        }

        function getStatus()
        {
            return $this->status;
        }

        function setDepartureTime($input)
        {
            $this->departure_time = $input;
        }

        function setDepartureCity($input)
        {
            $this->departure_city_id = $input;
        }

        function setArrivalCity($input)
        {
            $this->arrival_city_id = $input;
        }

        function setStatus($input)
        {
            $this->status = $input;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO flights (departure_time, departure_city_id, arrival_city_id, status) VALUES ('{$this->getDepartureTime()}', {$this->getDepartureCity()}, {$this->getArrivalCity()}, {$this->getStatus()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_flights = $GLOBALS['DB']->query("SELECT * FROM flights");
            $flights = array();
            foreach ($returned_flights as $returned_flight)
            {
                $departure_time = $returned_flight['departure_time'];
                $departure_city_id = $returned_flight['departure_city_id'];
                $arrival_city_id = $returned_flight['arrival_city_id'];
                $status = $returned_flight['status'];
                $id = $returned_flight['id'];
                $new_flight = new Flight($departure_time, $departure_city_id, $arrival_city_id, $status, $id);
                array_push($flights, $new_flight);
            }
            return $flights;
        }

        static function find($input_id)
        {
            $all_flights = Flight::getAll();
            foreach($all_flights as $flight)
            {
                $flight_id = $flight->getId();
                if($flight_id == $input_id)
                {
                    return $flight;
                }
            }
        }

        function update($new_departure_time, $new_departure_city, $new_arrival_city, $new_status)
        {
            $GLOBALS['DB']->exec("UPDATE flights SET departure_time = '{$new_departure_time}', departure_city_id = {$new_departure_time}, arrival_city_id = {$new_arrival_city}, status = {$new_status} WHERE id = {$this->getId()};");
            $this->setDepartureTime($new_departure_time);
            $this->setDepartureCity($new_departure_city);
            $this->setArrivalCity($new_arrival_city);
            $this->setStatus($new_status);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM flights where id = {$this->getId()};");
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM flights;");
        }

        function getDepartureCityName()
        {
            $all_cities = City::getAll();
            foreach ($all_cities as $city)
            {
                $city_id = $city->getId();
                if($this->departure_city_id == $city_id)
                {
                    return $city->getName();
                }
            }

            // $return_cities = $GLOBALS['DB']->query("SELECT cities.* FROM flights JOIN cities ON (cities.id = flights.departure_city_id) WHERE id = {$this->getDepartureCity()}");
            // $cities = array();
            // foreach ($return_cities as $returned_city) {
            //     return $returned_city["name"];
            // }

        }

    }
?>
