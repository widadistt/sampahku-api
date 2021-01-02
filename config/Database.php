<?php

    class Database{
        //DB Params

        // DB for development
        // private $host = 'localhost';
        // private $db_name = 'sampahku';
        // private $username = 'root';
        // private $password = '';
        // private $conn;

        // // DB for deployment
        // private $host = 'sql12.freemysqlhosting.net';
        // private $db_name = 'sql12382203';
        // private $username = 'sql12382203';
        // private $password = 'rH3SUkEdvG';
        // private $conn;

        //DB connect
        public function connect(){
            $this->conn = null;

            try {
                $db = parse_url(getenv("postgres://tsksabxokdawqm:03f55d605a04fa4d25ee18b978c211953141532f2196333a6a7ed0e4862d0744@ec2-52-201-55-4.compute-1.amazonaws.com:5432/d4h2ac7l9anakb"));
                $this->conn = new PDO("pgsql:" . sprintf(
                    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
                    $db["host"],
                    $db["port"],
                    $db["user"],
                    $db["pass"],
                    ltrim($db["path"], "/")
                ));
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection Error: '.$e ->getMessage();
            }

            return $this->conn;
        }

    }
?>