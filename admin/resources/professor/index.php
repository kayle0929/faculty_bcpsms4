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
</head>

<body>
    <div class="container mt-4">
        <h2>Professors Management</h2>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createModal">
            <i class="fas fa-plus"></i> Add Professor
        </button>
        <table id="professorsTable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Status</th>
                    <th>Section</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'Professor.php';
                $professor = new Professor();
                $professors = $professor->read();
                foreach ($professors as $row) {
                    echo "<tr>
                            <td>{$row['professor_id']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['first_name']} {$row['middle_name']} {$row['last_name']} {$row['suffix']}</td>
                            <td>{$row['status']}</td>
                            <td>{$row['section_id']}</td>
                            <td>
                                <button class='btn btn-info btn-custom view' data-id='{$row['professor_id']}'><i class='fas fa-eye'></i></button>
                                <button class='btn btn-warning btn-custom edit' data-id='{$row['professor_id']}'><i class='fas fa-edit'></i></button>
                                <button class='btn btn-danger btn-custom delete' data-id='{$row['professor_id']}'><i class='fas fa-trash'></i></button>
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
                            <label for="last_name" class="col-sm-4 col-form-label">Last Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
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
                                <input type="text" class="form-control" id="middle_name" name="middle_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="suffix" class="col-sm-4 col-form-label">Suffix</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="suffix" name="suffix">
                                    <option value="">None</option>
                                    <option value="jr">Jr.</option>
                                    <option value="sr">Sr.</option>
                                    <option value="III">III</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="start_date" class="col-sm-4 col-form-label">Start Date</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="end_date" class="col-sm-4 col-form-label">End Date</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="end_date" name="end_date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-4 col-form-label">Status</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="status" name="status">
                                    <option value="active">Active</option>
                                    <option value="completed">Completed</option>
                                    <option value="terminated">Terminated</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea class="form-control" id="notes" name="notes"></textarea>
                        </div>

                        <?php
                        require_once 'Professor.php';
                        $professor = new Professor();
                        $sections = $professor->getSections(); // Fetch sections
                        ?>
                        <div class="form-group row">
                            <label for="section" class="col-sm-4 col-form-label">Assign Section</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="section" name="section" required>
                                    <option value="">Select Section</option>
                                    <?php foreach ($sections as $section): ?>
                                        <option value="<?= $section['section_id']; ?>"><?= $section['section_id']; ?></option>
                                    <?php endforeach; ?>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="assets/js/proff.js"></script>
</body>
</html>
