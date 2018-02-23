<?php
    class database{
        // Set the Properties
        private $database_host = 'localhost';
        private $database_name = 'PhpRestSQLApp';
        private $database_user = 'root';
        private $database_pass = '123456';

        // Setup the Connection
        public function connect(){
            $mysql_connect_str = "mysql:host=$this->database_host;database_name=$this->database_name";
            $database_connection = new PDO($mysql_connect_str, $this->database_user, $this->database_pass);
            $database_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $database_connection;
        }
    }