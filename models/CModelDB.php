<?php

class CModelDB {
    private $conn;

    
    public function __construct($host, $username, $password, $dbname) {
        $this->conn = new mysqli($host, $username, $password, $dbname);

        
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }


    public function GetData() {
        $arrayResult = [];

        
        $sql = "SELECT title, date_created, author_name, image_url, text FROM blog_posts";
        
        
        $result = $this->conn->query($sql);

        if ($result === false) {
            echo "Error: " . $this->conn->error;
        } else {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $arrayResult[] = array(
                        'TITLE' => $row['title'],
                        'DATE' => $row['date_created'],
                        'AUTHOR' => $row['author_name'],
                        'IMAGE' => $row['image_url'],
                        'TEXT' => $row['text']
                    );
                }
            } else {
                echo "No records found";
            }
        }

        
        return $arrayResult;
    }

    
    public function __destruct() {
        $this->conn->close();
    }
}
?>
