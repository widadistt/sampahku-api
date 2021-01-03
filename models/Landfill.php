<?php

    class Landfill {
        //DB stuff
        private $conn;
        private $table = 'landfill';

        //Landfill props
        public $id;
        public $name;
        public $phone_number;
        public $address;

        //constructor
        public function __construct($db){
            $this->conn = $db;

            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $uri = explode( '/', $uri );
            
            // DEBUG
            echo $uri[1] $uri[2], $uri[3];

            $id = null;
            if (isset($uri[3])) {
                $id = $uri[3];
            }

            $this->id = $id;
        }

        //get landfills
        public function get()
        {
            //create query
            $query = 'SELECT * FROM landfill';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //exeCUTE
            $stmt->execute();

            return $stmt;
        }

        public function get_single()
        {
            //create query
            $query = 'SELECT * 
                FROM landfill 
                WHERE id = ?
                LIMIT 0,1';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind ID 
            $stmt->bindParam(1, $this->id);

            //exeCUTE
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->phone_number = $row['phone_number'];
            $this->address = $row['address'];
        }

        // POST
        public function post()
        {
            $query = 'INSERT INTO landfill
                SET
                    name = :name,
                    phone_number = :phone_number,
                    address = :address';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
            $this->address = htmlspecialchars(strip_tags($this->address));

            // Bind data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':phone_number', $this->phone_number);
            $stmt->bindParam(':address', $this->address);

            //exeCUTE
            if ($stmt->execute()){
                return true;
            } else {
                printf("Error: %s.\n", $stmt->error);
                return false;
            }
        }

        // Update POST
        public function update()
        {
            $query = 'UPDATE landfill
                SET
                    name = :name,
                    phone_number = :phone_number,
                    address = :address
                WHERE
                    id = :id';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind ID 
            $stmt->bindParam(':id', $this->id);

            // Clean data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
            $this->address = htmlspecialchars(strip_tags($this->address));

            // Bind data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':phone_number', $this->phone_number);
            $stmt->bindParam(':address', $this->address);

            //exeCUTE
            if ($stmt->execute()){
                return true;
            } else {
                printf("Error: %s.\n", $stmt->error);
                return false;
            }
        }

        // DELETE data
        public function delete()
        {
            $query = 'DELETE FROM landfill
                WHERE id = :id';
            
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind ID
            $stmt->bindParam(':id', $this->id);

            //exeCUTE
            if ($stmt->execute()){
                return true;
            } else {
                printf("Error: %s.\n", $stmt->error);
                return false;
            }
        }
    }
?>