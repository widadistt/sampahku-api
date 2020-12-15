<?php

    class Database{
        //DB Params

        // DB for development
        // private $host = 'localhost';
        // private $db_name = 'sampahku';
        // private $username = 'root';
        // private $password = '';
        // private $conn;

        // DB for deployment
        private $host = 'sql12.freemysqlhosting.net';
        private $db_name = 'sql12382203';
        private $username = 'sql12382203';
        private $password = 'rH3SUkEdvG';
        private $conn;

        //DB connect
        public function connect(){
            $this->conn = null;

            try {
                $this->conn = new PDO(
                    'mysql:host='.$this->host.';dbname='.$this->db_name,
                    $this->username,
                    $this->password
                );
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection Error: '.$e ->getMessage();
            }

            return $this->conn;
        }

    }
?>