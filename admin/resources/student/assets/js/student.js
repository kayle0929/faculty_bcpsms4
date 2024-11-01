$(document).ready(function () {
    $('#professorsTable').DataTable();

    // Create Professor
    $('#createForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'create.php',
            data: $(this).serialize(),
            success: function (response) {
                $('#createModal').modal('hide');
                Swal.fire({
                    title: 'Success!',
                    text: 'Student has been created successfully.',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then(() => {
                    location.reload();
                });
            }
        });
    });

    // View student
    $(document).on('click', '.view', function () {
        var id = $(this).data('id');
        $.ajax({
            url: 'view.php',
            method: 'GET',
            data: { student_id: id },
            success: function (response) {
                var data = JSON.parse(response);
                const detailsHtml = `
                  <div class="card">
    <div class="card-body">
        <p class="card-text"><strong>Student ID:</strong> ${data.student_id}</p>
        <h5 class="card-title">${data.last_name} ${data.first_name} ${data.middle_name}</h5>
        <p class="card-text"><strong>Username:</strong> ${data.username}</p>
        <!-- Consider removing the password line for security reasons -->
        <p class="card-text"><strong>E-mail:</strong> ${data.email}</p>
        <p class="card-text"><strong>Phone Number:</strong> ${data.phone_number}</p>
        <p class="card-text"><strong>Major:</strong> ${data.major}</p>
        <p class="card-text"><strong>Enrollment Year:</strong> ${data.enrollment_year}</p>
        <p class="card-text"><strong>Status:</strong> ${data.status}</p>
        <p class="card-text"><strong>Section:</strong> ${data.section}</p>
    </div>
</div>
`;
                
                Swal.fire({
                    html: detailsHtml,
                    showCloseButton: true,
                    confirmButtonText: 'Close'
                });
            }
        });
    });

    // Edit Professor
    $(document).on('click', '.edit', function () {
        var id = $(this).data('id');
        $.ajax({
            url: 'view.php',
            method: 'GET',
            data: { student_id: id },
            success: function (response) {
                var data = JSON.parse(response);
                $('#username').val(data.username);
                $('#username').val(data.username);
                $('#password').val(data.password);
                $('#first_name').val(data.first_name);
                $('#middle_name').val(data.middle_name);
                $('#last_name').val(data.last_name);
                $('#email').val(data.email);
                $('#phone_number').val(data.phone_number);
                $('#major').val(data.major);
                $('#enrollment_year').val(data.enrollment_year);
                $('#status').val(data.status);
                $('#section').val(data.section);
               
                $('#createModal').modal('show');

                // Update form action
                $('#createForm').off('submit').on('submit', function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: 'update.php',
                        data: $(this).serialize() + '&student_id=' + id,
                        success: function (response) {
                            $('#createModal').modal('hide');
                            Swal.fire({
                                title: 'Updated!',
                                text: 'Student information has been updated successfully.',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then(() => {
                                location.reload();
                            });
                        }
                    });
                });
            }
        });
    });

    // Delete Professor
    $(document).on('click', '.delete', function () {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'delete.php',
                    method: 'POST',
                    data: { student_id: id },
                    success: function (response) {
                        Swal.fire(
                            'Deleted!',
                            'Student has been deleted.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    }
                });
            }
        });
    });
});