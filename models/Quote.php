<?php
class Quote{
 
    // DB
    private $conn;
    private $table = 'quotes';

    // Properties
    public $id;
    public $quote;
    public $category_id;
    public $categoryName;
    public $author_id;
    public $authorName;

    // Constructor with DB
    public function __construct($db){
        $this->conn=$db;
    }

    // Get quotes
    public function read() {
        // Create query
        $query = 'SELECT 
        quotes.id,
        quotes.quote,
        authors.author AS authorName,
        categories.category AS categoryName
        FROM quotes
        INNER JOIN authors 
            ON quotes.author_id = authors.id
        INNER JOIN categories 
            ON quotes.category_id = categories.id
        WHERE 
            quotes.author_id = COALESCE(:author_id, quotes.author_id)
        AND
            quotes.category_id = COALESCE(:category_id, quotes.category_id)';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindValue(':author_id', $this->author_id);
        $stmt->bindValue(':category_id', $this->category_id);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Get single quote
    public function read_single() {
        // Create query
        $query = 'SELECT 
        quotes.id,
        quotes.quote,
        authors.author AS authorName,
        categories.category AS categoryName
        FROM quotes
        INNER JOIN authors 
            ON quotes.author_id = authors.id
        INNER JOIN categories 
            ON quotes.category_id = categories.id
        WHERE quotes.id = ?';

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
            $this->quote = $row['quote'];
            $this->authorName = $row['authorName'];
            $this->categoryName = $row['categoryName'];
        }else{
            // No quote found
            $this->quote = null;
        }
    }

    // Create quote
    public function create(){
        // Create query
        $query = 'INSERT INTO ' . 
            $this->table . ' 
        SET
            quote = :quote,
            author_id = :author_id,
            category_id = :category_id';

        // Author query
        $authorQuery = 'SELECT id FROM authors WHERE id = :author_id';
        // Category query
        $categoryQuery = 'SELECT id FROM categories WHERE id = :category_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);
        $authorStmt = $this->conn->prepare($authorQuery);
        $categoryStmt = $this->conn->prepare($categoryQuery);

        // Clean data
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        // Bind ID
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);
        $authorStmt->bindParam(':author_id', $this->author_id);
        $categoryStmt->bindParam(':category_id', $this->category_id);

        $authorStmt->execute();
        if($authorStmt->rowCount() == 0){
            return array('message' => 'author_id Not Found');
        }

        $categoryStmt->execute();
        if($categoryStmt->rowCount() == 0){
            return array('message' => 'category_id Not Found');
        }
        
        // Execute query
        if($stmt->execute()){
            return true;
        }
        // Print error
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // Update quote
    public function update(){
        // Create query
        $query = 'UPDATE ' . 
            $this->table . ' 
        SET
            quote = :quote,
            author_id = :author_id,
            category_id = :category_id
        WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

       // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));


        // Bind ID
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);

        // Execute query
        if($stmt->execute()){
            if($stmt->rowCount() == 0){
              return array('message' => 'No Quotes Found');
            }
            return true;
        }
        // Print error
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // Delete quote
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