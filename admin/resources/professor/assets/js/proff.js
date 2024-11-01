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
            }
        });
    });

    // View Professor
    $(document).on('click', '.view', function () {
        var id = $(this).data('id');
        $.ajax({
            url: 'view.php',
            method: 'GET',
            data: { professor_id: id },
            success: function (response) {
                var data = JSON.parse(response);
                const detailsHtml = `
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">${data.first_name} ${data.last_name}</h5>
                            <p class="card-text"><strong>Username:</strong> ${data.username}</p>
                            <p class="card-text"><strong>Last Name:</strong> ${data.last_name}</p>
                            <p class="card-text"><strong>First Name:</strong> ${data.first_name}</p>
                            <p class="card-text"><strong>Middle Name:</strong> ${data.middle_name}</p>
                            <p class="card-text"><strong>Suffix:</strong> ${data.suffix}</p>
                            <p class="card-text"><strong>Status:</strong> ${data.status}</p>
                            <p class="card-text"><strong>Start Date:</strong> ${data.start_date}</p>
                            <p class="card-text"><strong>End Date:</strong> ${data.end_date}</p>
                            <p class="card-text"><strong>Notes:</strong> ${data.notes}</p>
                            <p class="card-text"><strong>Section ID:</strong> ${data.section_id}</p>
                        </div>
                    </div>`;
                
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
            data: { professor_id: id },
            success: function (response) {
                var data = JSON.parse(response);
                $('#username').val(data.username);
                $('#password').val(data.password); // Consider hiding this field
                $('#last_name').val(data.last_name);
                $('#first_name').val(data.first_name);
                $('#middle_name').val(data.middle_name);
                $('#suffix').val(data.suffix);
                $('#start_date').val(data.start_date);
                $('#end_date').val(data.end_date);
                $('#status').val(data.status);
                $('#notes').val(data.notes);
                $('#section').val(data.section_id); // Set the section ID here
                $('#createModal').modal('show');

                // Update form action
                $('#createForm').off('submit').on('submit', function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: 'update.php',
                        data: $(this).serialize() + '&professor_id=' + id,
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
                    data: { professor_id: id },
                    success: function (response) {
                        Swal.fire(
                            'Deleted!',
                            'The professor has been deleted.',
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
