<?php
class Author{
 
    // DB
    private $conn;
    private $table = 'authors';

    // Properties
    public $id;
    public $author;

    // Constructor with DB
    public function __construct($db){
        $this->conn=$db;
    }

    // Get authors
    public function read() {
        // Create query
        $query = 'SELECT
            id,
            author
        FROM '
        . $this->table . '
        ORDER BY
        id DESC';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Get single author
    public function read_single() {
        // Create query
        $query = 'SELECT
            id,
            author
        FROM '
        . $this->table . '
        WHERE id = ?
        LIMIT 1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row){
            // Set properties
            $this->id = $row['id'];
            $this->author = $row['author'];

        }else{
            $this->id=null;
        }
    }

    // Create author
    public function create(){
        // Create query
        $query = 'INSERT INTO ' . 
            $this->table . '
        SET
            author = :author';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->author = htmlspecialchars(strip_tags($this->author));

        // Bind Data
        $stmt->bindParam(':author', $this->author);

        // Execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        // Print error
        printf("Error: %s.\n", $stmt->error);
        return false;

    }

    // Update author
    public function update(){
        // Create query
        $query = 'UPDATE ' . 
            $this->table . '
        SET
            author = :author
        WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->id = htmlspecialchars(strip_tags($this->id));


        // Bind ID
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()){
            if($stmt->rowCount() == 0){
              return array('message' => 'author_id Not Found');
            }
            return true;
        }
        // Print error
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // Delete author
    public function delete(){
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()){
            // Check if any deletion
            if($stmt->rowCount() > 0){
                return true;
            } else {
                return false;
            }

        }

        // Print error
        printf("Error: %s.\n", $stmt->error);
            return false;
        }

}