<?php
class Model
{
    private $server = 'localhost';
    private $username = 'root';
    private $password = '';
    private $db = 'booksdb';
    private $conn;
 
    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
 
    public function store($isbn, $name, $author, $num_pages, $description)
    {
        $stmt = $this->conn->prepare("INSERT INTO `books` (`isbn`, `name`, `author`, `num_pages`, `description`) VALUES ('$isbn', '$name', '$author', '$num_pages', '$description')");
        if ($stmt->execute()) {
            return true;
        } else {
            return;
        }
    }
 
    public function findAll()
    {
        $data = [];
 
        $stmt = $this->conn->prepare("SELECT * FROM `books`");
        if ($stmt->execute()) {
            $data = $stmt->fetchAll();
        }
 
        return $data;
    }
 
    public function destroy($isbn)
    {
        $stmt = $this->conn->prepare("DELETE FROM `books` WHERE `isbn` = '$isbn'");
        if ($stmt->execute()) {
            return true;
        } else {
            return;
        }
    }
 
    public function findOne($isbn)
    {
        $data = [];
 
        $stmt = $this->conn->prepare("SELECT * FROM `books` WHERE `isbn` = '$isbn'");
        if ($stmt->execute()) {
            $data = $stmt->fetch();
        }
 
        return $data;
    }
}