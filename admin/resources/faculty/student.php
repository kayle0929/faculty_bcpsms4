<?php
require_once 'db.php';

class Student {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->dbConnection();
    }

    public function create($data) {
        $query = "INSERT INTO faculty (username, password, first_name, last_name, email, phone_number, hire_date, specialization, status) 
          VALUES (:username, :password, :first_name, :last_name, :email, :phone_number, :hire_date, :specialization, :status)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($data);
        return $stmt->rowCount();
    }

    public function read() {
        $query = "SELECT * FROM faculty";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($data) {
        $query = "UPDATE faculty 
        SET username = :username, 
            password = :password, 
            first_name = :first_name, 
            last_name = :last_name, 
            email = :email, 
            phone_number = :phone_number, 
            hire_date = :hire_date, 
            specialization = :specialization, 
            status = :status 
        WHERE fac_id = :fac_id";
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute($data);
        return $stmt->rowCount();
    }
    

    public function delete($id) {
        $query = "DELETE FROM faculty WHERE fac_id = :fac_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':fac_id', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function view($id) {
        $query = "SELECT * FROM faculty WHERE fac_id = :fac_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':fac_id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
