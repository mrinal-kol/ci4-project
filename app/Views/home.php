<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-1">
    <h3 class="mb-1 text-primary">Add Student</h3>

    <form id="formValidate" method="post" enctype="multipart/form-data" class="p-3 bg-light rounded shadow-sm">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="John Doe" class="form-control" placeholder="Enter full name"/>
        </div>
        <div class="mb-3">
            <label class="form-label">Roll</label>
            <input type="text" name="roll" value="1025" class="form-control" placeholder="Enter roll number"/>
        </div>
        <div class="mb-3">
            <label class="form-label">Class</label>
            <input type="text" name="class" value="10" class="form-control" placeholder="Enter class"/>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="johndoe@example.com" class="form-control" placeholder="Enter email"/>
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" value="1234567890" class="form-control" placeholder="Enter phone number"/>
        </div>
        <div class="mb-3">
            <label class="form-label">Section</label>
            <input type="text" name="section" value="A" class="form-control" placeholder="Enter section"/>
        </div>
        <div class="mb-3">
            <label class="form-label">Profile Picture</label>
            <input type="file" name="myfile" class="form-control"/>
        </div>
        <div class="text-center">
            <button class="btn btn-primary px-4 add_student" type="submit" name="save">
                <i class="bi bi-save"></i> Add Student
            </button>
            <div id="loader" class="text-center mt-3 text-primary fw-bold" style="display:none;">
                Loading...
            </div>
        </div>
    </form>

    
    <div id="messageBox" class="mt-3"></div>
</div>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    $('#formValidate').validate({
        rules: {
            name: { required: true, minlength: 3 },
            roll: { required: true, digits: true },
            class: { required: true },
            email: { required: true, email: true },
            phone: { required: true, digits: true, minlength: 10 },
            section: { required: true }
        },
        messages: {
            name: "Please enter a valid name",
            roll: "Please enter a numeric roll",
            class: "Class is required",
            email: "Enter a valid email",
            phone: "Enter a valid phone number",
            section: "Section is required"
        },
        submitHandler: function(form) {
            var formData = new FormData(form);
            $.ajax({
                url: "<?= base_url('Hello/add') ?>",
                type: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false, 
                beforeSend: function () {
                    $('.add_student').hide();
                    $("#loader").show();
                },
                success: function(response) {
                    $("#loader").hide();
                    $('.add_student').show();
                    if (response.status === 'success') {
                        $('#messageBox').html('<div class="alert alert-success">✅ Student added successfully!</div>');
                        $('#formValidate')[0].reset();
                    } else if (response.status === 'error') {
                        let errorHtml = '<div class="alert alert-danger"><ul>';
                        if (typeof response.errors === 'object') {
                            $.each(response.errors, function(key, value) {
                                errorHtml += '<li>' + value + '</li>';
                            });
                        } else {
                            errorHtml += '<li>' + response.errors + '</li>';
                        }
                        errorHtml += '</ul></div>';
                        $('#messageBox').html(errorHtml);
                    }

                    setTimeout(function() {
                        $('#messageBox').fadeOut('slow', function() {
                            $(this).html('').show();
                        });
                    }, 5000);
                }
            });
        }
    });
});
</script>
<?= $this->endSection() ?>
