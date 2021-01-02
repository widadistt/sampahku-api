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

        //DB connect
        public function connect(){
            $this->conn = null;

            try {
                $db = parse_url(getenv("postgres://tsksabxokdawqm:03f55d605a04fa4d25ee18b978c211953141532f2196333a6a7ed0e4862d0744@ec2-52-201-55-4.compute-1.amazonaws.com:5432/d4h2ac7l9anakb"));

                // $host = 'ec2-52-201-55-4.compute-1.amazonaws.com';
                // $db_name = 'd4h2ac7l9anakb';
                // $username = 'tsksabxokdawqm';
                // $password = '03f55d605a04fa4d25ee18b978c211953141532f2196333a6a7ed0e4862d0744';
                // $port = 5432;

                $this->conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                new PDO("pgsql:" . sprintf(
                    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
                    'ec2-52-201-55-4.compute-1.amazonaws.com',
                    5432,
                    'tsksabxokdawqm',
                    '03f55d605a04fa4d25ee18b978c211953141532f2196333a6a7ed0e4862d0744',
                    'd4h2ac7l9anakb')
                ));
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection Error: '.$e ->getMessage();
            }

            return $this->conn;
        }

    }
?>