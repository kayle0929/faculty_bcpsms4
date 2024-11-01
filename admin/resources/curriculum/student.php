<?php
require_once 'db.php';

class Student {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->dbConnection();
    }

    public function create($data) {
        $query = "INSERT INTO curriculum (curriculum_year, period, level, program_code, course_code, course_name, lec, lab, units, complab) 
                  VALUES (:curriculum_year, :period, :level, :program_code, :course_code, :course_name, :lec, :lab, :units, :complab)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute($data);
        
        return $stmt->rowCount();
    }
    

    public function read() {
        $query = "SELECT * FROM curriculum";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($data) {
        // Ensure curriculum_id is included in the data
        $data['curriculum_id'] = $_POST['curriculum_id'];
    
        // Prepare the SQL update statement
        $query = "UPDATE curriculum SET 
            curriculum_year = :curriculum_year,
            period = :period,
            level = :level,
            program_code = :program_code,
            course_code = :course_code,
            course_name = :course_name,
            lec = :lec,
            lab = :lab,
            units = :units,
            complab = :complab 
            WHERE curriculum_id = :curriculum_id";
    
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
    
        // Bind the parameters
        $stmt->bindParam(':curriculum_year', $data['curriculum_year']);
        $stmt->bindParam(':period', $data['period']);
        $stmt->bindParam(':level', $data['level']);
        $stmt->bindParam(':program_code', $data['program_code']);
        $stmt->bindParam(':course_code', $data['course_code']);
        $stmt->bindParam(':course_name', $data['course_name']);
        $stmt->bindParam(':lec', $data['lec']);
        $stmt->bindParam(':lab', $data['lab']);
        $stmt->bindParam(':units', $data['units']);
        $stmt->bindParam(':complab', $data['complab']);
        $stmt->bindParam(':curriculum_id', $data['curriculum_id']);
    
        // Execute the statement
        $stmt->execute();
    
        // Return the number of affected rows
        return $stmt->rowCount();
    }
    

    public function delete($id) {
        $query = "DELETE FROM curriculum WHERE curriculum_id = :curriculum_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':curriculum_id', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function view($id) {
        $query = "SELECT * FROM curriculum WHERE curriculum_id = :curriculum_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':curriculum_id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
