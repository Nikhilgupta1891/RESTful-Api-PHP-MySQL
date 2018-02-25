<?php
    class db{
        //properties
        private $dbhost = 'localhost';
        private $dbuser = 'root';
        private $dbpass = 'SDsb7ENp8E63NvF6';
        private $dbname = 'slimappdb';
        
        //Connect
        public function connect() { 
            // format: new PDO("mysql:dbname=$db;host=$host", $username, $password);
            $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
            $dbConnection = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass);
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbConnection;
        }
    }   