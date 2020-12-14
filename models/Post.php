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
                    ,
                    content = :content';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->writer = htmlspecialchars(strip_tags($this->writer));

            // Bind data
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':writer', $this->writer);

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
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->writer = htmlspecialchars(strip_tags($this->writer));
            $this->content = htmlspecialchars(strip_tags($this->content));
            $this->published_date = htmlspecialchars(strip_tags($this->published_date));

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