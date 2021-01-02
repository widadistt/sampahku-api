<?php

    class Database{
        //DB Params

        // DB for development
        // private $host = 'localhost';
        // private $db_name = 'sampahku';
        // private $username = 'root';
        // private $password = '';

        private $conn;

        // DB for deployment
        // private $host = 'sql12.freemysqlhosting.net';
        // private $db_name = 'sql12384697';
        // private $username = 'sql12384697';
        // private $password = 'wqLDnFyuNG';

        //DB connect
        public function connect(){
            $this->conn = null;

            $host = 'sql12.freemysqlhosting.net';
            $db_name = 'sql12384697';
            $username = 'sql12384697';
            $password = 'wqLDnFyuNG';

            try {
                $this->conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
                
                // new PDO("pgsql:" . sprintf(
                //     "host=%s;port=%s;user=%s;password=%s;dbname=%s",
                //     'ec2-52-201-55-4.compute-1.amazonaws.com',
                //     5432,
                //     'tsksabxokdawqm',
                //     '03f55d605a04fa4d25ee18b978c211953141532f2196333a6a7ed0e4862d0744',
                //     'd4h2ac7l9anakb')
                // ));
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection Error: '.$e ->getMessage();
            }

            return $this->conn;
        }

    }
?>