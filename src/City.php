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
    }

?>
