<?php

    class Waste {
        //DB stuff
        private $conn;
        private $table = 'waste';

        //Waste props
        public $id;
        public $name;
        public $category;

        //constructor
        public function __construct($db){
            $this->conn = $db;

            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $uri = explode( '/', $uri );
                
            $id = null;
            if (isset($uri[3])) {
                $id = $uri[3];
            }

            $this->id = $id;
        }

        //get wastes
        public function get()
        {
            //create query
            $query = 'SELECT * FROM waste';

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
                FROM waste 
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
            $this->category = $row['category'];
        }

        // POST
        public function post()
        {
            $query = 'INSERT INTO waste
                SET
                    name = :name,
                    category = :category';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->category = htmlspecialchars(strip_tags($this->category));

            // Bind data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':category', $this->category);

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
            $query = 'UPDATE waste
                SET
                    name = :name,
                    category = :category
                WHERE
                    id = :id';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':id', $this->id);
            
            // Clean data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->category = htmlspecialchars(strip_tags($this->category));

            // Bind data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':category', $this->category);

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
            $query = 'DELETE FROM waste
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