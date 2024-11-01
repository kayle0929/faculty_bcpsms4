<?php
require_once 'db.php';

class Professor {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->dbConnection();
    }

    public function create($data) {
        $query = "INSERT INTO professors (username, password, last_name, first_name, middle_name, suffix, start_date, end_date, status, notes, section_id) VALUES (:username, :password, :last_name, :first_name, :middle_name, :suffix, :start_date, :end_date, :status, :notes, :section_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($data);
        return $stmt->rowCount();
    }

    public function read() {
        $query = "SELECT * FROM professors";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($data) {
        $query = "UPDATE professors SET username = :username, last_name = :last_name, first_name = :first_name, middle_name = :middle_name, suffix = :suffix, start_date = :start_date, end_date = :end_date, status = :status, notes = :notes WHERE professor_id = :professor_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($data);
        return $stmt->rowCount();
    }

    public function delete($id) {
        $query = "DELETE FROM professors WHERE professor_id = :professor_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':professor_id', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function view($id) {
        $query = "SELECT * FROM professors WHERE professor_id = :professor_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':professor_id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getSections() {
    $query = "SELECT section_id FROM section";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
?>
