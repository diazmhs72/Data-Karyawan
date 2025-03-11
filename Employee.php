<?php
require_once "database.php";

class Employee {
    private $conn;
    private $table_name = "employees";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create($name, $position, $salary) {
        $query = "INSERT INTO " . $this->table_name . " (name, position, salary) VALUES (:name, :position, :salary)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":position", $position);
        $stmt->bindParam(":salary", $salary);
        return $stmt->execute();
    }
    
    public function readById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function update($id, $name, $position, $salary) {
        $query = "UPDATE " . $this->table_name . " SET name = :name, position = :position, salary = :salary WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":position", $position);
        $stmt->bindParam(":salary", $salary);
        return $stmt->execute();
    }
    
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}