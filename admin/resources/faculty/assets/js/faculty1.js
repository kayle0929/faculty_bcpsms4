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
                    text: 'Professor has been created successfully.',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then(() => {
                    location.reload();
                });
            },
            error: function () {
                Swal.fire({
                    title: 'Error!',
                    text: 'There was an error creating the professor.',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            }
        });
    });

    // View Professor
    $(document).on('click', '.view', function () {
        var id = $(this).data('id');
        $.ajax({
            url: 'view.php',
            method: 'GET',
            data: { fac_id: id },
            success: function (response) {
                var data = JSON.parse(response);
                const detailsHtml = `
                  <div class="card">
                    <div class="card-body">
                        <p class="card-text"><strong>Professor ID:</strong> ${data.fac_id}</p>
                        <p class="card-text"><strong>Name:</strong> ${data.first_name} ${data.last_name}</p>
                        <p class="card-text"><strong>Email:</strong> ${data.email}</p>
                        <p class="card-text"><strong>Phone:</strong> ${data.phone_number}</p>
                        <p class="card-text"><strong>Hire Date:</strong> ${data.hire_date}</p>
                        <p class="card-text"><strong>Specialization:</strong> ${data.specialization}</p>
                        <p class="card-text"><strong>Status:</strong> ${data.status}</p>
                    </div>
                  </div>
                `;

                Swal.fire({
                    html: detailsHtml,
                    showCloseButton: true,
                    confirmButtonText: 'Close'
                });
            },
            error: function () {
                Swal.fire({
                    title: 'Error!',
                    text: 'There was an error retrieving the professor data.',
                    icon: 'error',
                    confirmButtonText: 'Ok'
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
            data: { fac_id: id },
            success: function (response) {
                var data = JSON.parse(response);
                $('#username').val(data.username);
                $('#password').val(data.password);
                $('#first_name').val(data.first_name);
                $('#last_name').val(data.last_name);
                $('#email').val(data.email);
                $('#phone_number').val(data.phone_number);
                $('#hire_date').val(data.hire_date);
                $('#specialization').val(data.specialization);
               

                $('#createModal').modal('show');

                // Update form action
                $('#createForm').off('submit').on('submit', function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: 'update.php',
                        data: $(this).serialize() + '&fac_id=' + id,
                        success: function (response) {
                            $('#createModal').modal('hide');
                            Swal.fire({
                                title: 'Updated!',
                                text: 'Professor information has been updated successfully.',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function () {
                            Swal.fire({
                                title: 'Error!',
                                text: 'There was an error updating the professor information.',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        }
                    });
                });
            },
            error: function () {
                Swal.fire({
                    title: 'Error!',
                    text: 'There was an error retrieving the professor data for editing.',
                    icon: 'error',
                    confirmButtonText: 'Ok'
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
                    data: { fac_id: id },
                    success: function (response) {
                        Swal.fire(
                            'Deleted!',
                            'Professor has been deleted.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an error deleting the professor.',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                });
            }
        });
    });
});
