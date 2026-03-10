<?php
class Category{
 
    // DB
    private $conn;
    private $table = 'categories';

    // Properties
    public $id;
    public $category;

    // Constructor with DB
    public function __construct($db){
        $this->conn=$db;
    }

    // Get categories
    public function read() {
        // Create query
        $query = 'SELECT
            id,
            category
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

    // Get single category
    public function read_single() {
        // Create query
        $query = 'SELECT
            id,
            category
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
            $this->category = $row['category'];
        }else{
            $this->id=null;
        }
    }

    // Create category
    public function create(){
        // Create query
        $query = 'INSERT INTO ' . 
            $this->table . '
        SET
            category = :category';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->category = htmlspecialchars(strip_tags($this->category));

        // Bind Data
        $stmt->bindParam(':category', $this->category);

        // Execute query
        if($stmt->execute()){
            return true;
        }
        // Print error
        printf("Error: %s.\n", $stmt->error);
        return false;

    }

    // Update category
    public function update(){
        // Create query
        $query = 'UPDATE ' . 
            $this->table . '
        SET
            category = :category
        WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->id = htmlspecialchars(strip_tags($this->id));


        // Bind ID
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()){
            if($stmt->rowCount() == 0){
              return array('message' => 'category_id Not Found');
            }
            return true;
        }
        
         // Print error
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // Delete category
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