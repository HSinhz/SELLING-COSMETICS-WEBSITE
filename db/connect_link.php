<?php
    require_once("config.php");
    class connect_link {
        protected $link;

        function __construct() {
            $this->link = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        }

        function getLink() {
            return $this->link;
        }
    }
?>