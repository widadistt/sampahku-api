<?php

    class Post {
        //DB stuff
        private $conn;
        private $table = 'post';

        //post props
        public $id;
        public $title;
        public $writer;
        public $content;
        public $published_date;

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

        //get posts
        public function get()
        {
            //create query
            $query = 'SELECT * FROM post';

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
                FROM post 
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
            $this->title = $row['title'];
            $this->writer = $row['writer'];
            $this->content = $row['content'];
            $this->published_date = $row['published_date'];
        }

        // POST
        public function post()
        {
            $query = 'INSERT INTO post
                SET
                    title = :title,
                    writer = :writer,
                    content = :content';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->writer = htmlspecialchars(strip_tags($this->writer));
            $this->content = htmlspecialchars(strip_tags($this->content));

            // Bind data
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':writer', $this->writer);
            $stmt->bindParam(':content', $this->content);

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
            $query = 'SELECT * FROM post
                WHERE
                    id = :id';

            //prepare statement
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();

            if (!($stmt -> fetch())) {
                print_r(json_encode(
                    array('message' => 'Wrong ID')));
            } else {
                $query = 'UPDATE post
                SET
                    title = :title,
                    writer = :writer,
                    content = :content
                WHERE
                    id = :id';

                //prepare statement
                $stmt = $this->conn->prepare($query);

                // Clean data
                $this->title = htmlspecialchars(strip_tags($this->title));
                $this->writer = htmlspecialchars(strip_tags($this->writer));
                $this->content = htmlspecialchars(strip_tags($this->content));

                // Bind data
                $stmt->bindParam(':id', $this->id);
                $stmt->bindParam(':title', $this->title);
                $stmt->bindParam(':writer', $this->writer);
                $stmt->bindParam(':content', $this->content);

                //exeCUTE
                if ($stmt->execute()){
                    return true;
                } else {
                    printf("Error: %s.\n", $stmt->error);
                    return false;
                }
            }
        }

        // DELETE data
        public function delete()
        {
            $query = 'DELETE FROM post
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