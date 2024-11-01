<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/proff.css">
    <title>Curriculum Management</title>

</head>

<body>
    <div class="container mt-4">
        <h2>Curriculum Information</h2>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createModal">
            <i class="fas fa-plus"></i> Add Curriculum
        </button>
        <table id="professorsTable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Curriculum ID</th>
                    <th>Curriculum Year</th>
                    <th>Period</th>
                    <th>Level</th>
                    <th>Program Code</th>
                    <th>Course Code</th>
                    <th>Course Name</th>
                     
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
require_once 'student.php';
$student = new Student();
$students = $student->read();

foreach ($students as $row) {
    echo "<tr>
            <td>{$row['curriculum_id']}</td>
            <td>{$row['curriculum_year']}</td>
            <td>{$row['period']}</td>
            <td>{$row['level']}</td>
            <td>{$row['program_code']}</td>
            <td>{$row['course_code']}</td>
            <td>{$row['course_name']}</td>
           
            
            <td>
                <button class='btn btn-info btn-custom view' data-id='{$row['curriculum_id']}'><i class='fas fa-eye'></i></button>
                <button class='btn btn-warning btn-custom edit' data-id='{$row['curriculum_id']}'><i class='fas fa-edit'></i></button>
                <button class='btn btn-danger btn-custom delete' data-id='{$row['curriculum_id']}'><i class='fas fa-trash'></i></button>
            </td>
        </tr>";
}
?>

            </tbody>
        </table>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">UPDATE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="createForm">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="curriculum_year" class="col-sm-4 col-form-label">Curriculum Year</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="curriculum_year" name="curriculum_year" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="period" class="col-sm-4 col-form-label">Period</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="period" name="period" required>
                                    <option value="">None</option>
                                    <option value="1st Semester">1st Semester</option>
                                    <option value="2nd Semester">2nd Semester</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="level" class="col-sm-4 col-form-label">Level</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="level" name="level" required>
                                    <option value="">None</option>
                                    <option value="1st Year">1st Year</option>
                                    <option value="2nd Year">2nd Year</option>
                                    <option value="3rd Year">3rd Year</option>
                                    <option value="4th Year">4th Year</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="program_code" class="col-sm-4 col-form-label">Program Code</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="program_code" name="program_code" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="course_code" class="col-sm-4 col-form-label">Course Code</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="course_code" name="course_code" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="course_name" class="col-sm-4 col-form-label">Course Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="course_name" name="course_name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lec" class="col-sm-4 col-form-label">Lec</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="lec" name="lec" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lab" class="col-sm-4 col-form-label">Lab</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="lab" name="lab" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="units" class="col-sm-4 col-form-label">Unit</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="units" name="units" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="complab" class="col-sm-4 col-form-label">Complab.</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="complab" name="complab" required>
                                    <option value="">None</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="assets/js/curriculum.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
