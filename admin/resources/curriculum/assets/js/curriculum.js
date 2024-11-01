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
            data: { curriculum_id: id },
            success: function (response) {
                var data = JSON.parse(response);
                const detailsHtml = `
                <div class="card">
                    <div class="card-body">
                        <p class="card-text"><strong>Curriculum ID:</strong> ${data.curriculum_id}</p>
                        <p class="card-text"><strong>Curriculum Year:</strong> ${data.curriculum_year}</p>
                        <p class="card-text"><strong>Period:</strong> ${data.period}</p>
                        <p class="card-text"><strong>Level:</strong> ${data.level}</p>
                        <p class="card-text"><strong>Program Code:</strong> ${data.program_code}</p>
                        <p class="card-text"><strong>Course Code:</strong> ${data.course_code}</p>
                        <p class="card-text"><strong>Course Name:</strong> ${data.course_name}</p>
                        <p class="card-text"><strong>Lecture Hours:</strong> ${data.lec}</p>
                        <p class="card-text"><strong>Lab Hours:</strong> ${data.lab}</p>
                        <p class="card-text"><strong>Units:</strong> ${data.units}</p>
                        <p class="card-text"><strong>Completion Lab:</strong> ${data.complab}</p>
                        <p class="card-text"><strong>Created At:</strong> ${data.created_at}</p>
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
        data: { curriculum_id: id },
        success: function (response) {
            var data = JSON.parse(response);
            $('#curriculum_id').val(data.curriculum_id);
            $('#curriculum_year').val(data.curriculum_year);
            $('#period').val(data.period);
            $('#level').val(data.level);
            $('#program_code').val(data.program_code);
            $('#course_code').val(data.course_code);
            $('#course_name').val(data.course_name);
            $('#lec').val(data.lec);
            $('#lab').val(data.lab);
            $('#units').val(data.units);
            $('#complab').val(data.complab);
            
            $('#createModal').modal('show');

            // Update form action
            $('#createForm').off('submit').on('submit', function (e) {
                e.preventDefault();
                // Include curriculum_id in the serialized data
                var formData = $(this).serialize() + '&curriculum_id=' + data.curriculum_id; 
                $.ajax({
                    type: 'POST',
                    url: 'update.php',
                    data: formData,
                    success: function (response) {
                        $('#createModal').modal('hide');
                        Swal.fire({
                            title: 'Updated!',
                            text: 'Curriculum information has been updated successfully.',
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function (xhr, status, error) {
                        // Handle error
                        console.error(error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was a problem updating the curriculum.',
                            icon: 'error',
                            confirmButtonText: 'Ok'
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
                    data: { curriculum_id: id },
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