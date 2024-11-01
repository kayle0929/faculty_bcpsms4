<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/proff.css">
   
    <title>Professors Management</title>
    <style>
      
    </style>
</head>

<body>
    <div class="container mt-4">
        <h2>Student Information</h2>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createModal">
            <i class="fas fa-plus"></i> Add Student
        </button>
        <table id="professorsTable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'student.php';
                $student = new Student();
                $student = $student->read();
                foreach ($student as $row) {
                    echo "<tr>
                            <td>{$row['student_id']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['first_name']} {$row['middle_name']} {$row['last_name']}</td>
                            <td>{$row['status']}</td>
                            <td>
                                <button class='btn btn-info btn-custom view' data-id='{$row['student_id']}'><i class='fas fa-eye'></i></button>
                                <button class='btn btn-warning btn-custom edit' data-id='{$row['student_id']}'><i class='fas fa-edit'></i></button>
                                <button class='btn btn-danger btn-custom delete' data-id='{$row['student_id']}'><i class='fas fa-trash'></i></button>
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
        <label for="username" class="col-sm-4 col-form-label">Username</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-sm-4 col-form-label">Password</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="first_name" class="col-sm-4 col-form-label">First Name</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="middle_name" class="col-sm-4 col-form-label">Middle Name</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="middle_name" name="middle_name" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="last_name" class="col-sm-4 col-form-label">Last Name</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-sm-4 col-form-label">Email</label>
        <div class="col-sm-8">
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="phone_number" class="col-sm-4 col-form-label">Phone Number</label>
        <div class="col-sm-8">
            <input type="tel" class="form-control" id="phone_number" name="phone_number" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="major" class="col-sm-4 col-form-label">Major</label>
        <div class="col-sm-8">
            <select class="form-control" id="major" name="major" required>
                <option value="">None</option>
                <option value="information management">Information Management</option>
                <option value="information security">Information Security</option>
                <option value="network administration">Network Administration</option>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="enrollment_year" class="col-sm-4 col-form-label">Enrollment Year</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="enrollment_year" name="enrollment_year" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="status" class="col-sm-4 col-form-label">Status</label>
        <div class="col-sm-8">
            <select class="form-control" id="status" name="status" required>
                <option value="">None</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="section" class="col-sm-4 col-form-label">Section</label>
        <div class="col-sm-8">
            <select class="form-control" id="section" name="section" required>
                <option value="">None</option>
                <option value="Section 1">Section 1</option>
                <option value="Section 2">Section 2</option>
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
    <script src="assets/js/student.js">



    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
