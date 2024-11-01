<?php
require_once 'db.php';

class Student {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->dbConnection();
    }

    public function create($data) {
        $query = "INSERT INTO student (username, password, first_name, middle_name, last_name, email, phone_number, major, enrollment_year, status, section) VALUES (:username, :password, :first_name, :middle_name, :last_name, :email, :phone_number, :major, :enrollment_year, :status, :section)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($data);
        return $stmt->rowCount();
    }

    public function read() {
        $query = "SELECT * FROM student";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($data) {
        $query = "UPDATE student 
        SET username = :username, 
            password = :password, 
            first_name = :first_name, 
            middle_name = :middle_name, 
            last_name = :last_name, 
            email = :email, 
            phone_number = :phone_number, 
            major = :major, 
            enrollment_year = :enrollment_year, 
            status = :status, 
            section = :section 
        WHERE student_id = :student_id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute($data);
        return $stmt->rowCount();
    }

    public function delete($id) {
        $query = "DELETE FROM student WHERE student_id = :student_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':student_id', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function view($id) {
        $query = "SELECT * FROM student WHERE student_id = :student_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':student_id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
