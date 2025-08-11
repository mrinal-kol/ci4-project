<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
        #loader {
            display: none;
            color: blue;
        }
    </style>
<form id="formValidate" method="post">
    <table class="table">
        <tr>
            <td>Name</td>
            <td><input type="text" name="name" value="John Doe" class="form-control"/></td>
        </tr>
        <tr>
            <td>Roll</td>
            <td><input type="text" name="roll" value="1025" class="form-control"/></td>
        </tr>
        <tr>
            <td>Class</td>
            <td><input type="text" name="class" value="10" class="form-control"/></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" value="johndoe@example.com" class="form-control"/></td>
        </tr>
        <tr>
            <td>Phone</td>
            <td><input type="text" name="phone" value="1234567890" class="form-control"/></td>
        </tr>
        <tr>
            <td>Section</td>
            <td><input type="text" name="section" value="A" class="form-control"/></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input class="btn btn-primary" type="submit" name="save" value="Add" />
            </td>
        </tr>
    </table>
</form>
<div id="loader">Loading...</div>

<div id="messageBox"></div>
<?= $this->endSection() ?>  <!-- CLOSE content section here! -->

<?= $this->section('scripts') ?> <!-- START scripts section AFTER content -->
<script>
$(document).ready(function() {
    //console.log("jQuery loaded and document ready1");

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
            $.ajax({
                url: "<?= base_url('Hello/add') ?>",
                type: 'POST',
                 dataType: 'json', // ← Important!
                data: $(form).serialize(),
                beforeSend: function () {
        $("#loader").show(); // Show the loader
      },
                success: function(response) {
                    console.log(response);
                 if (response.status === 'success') 
                 {
                    $('#messageBox').html('<div class="alert alert-success">Student added successfully!</div>');
                    $('#formValidate')[0].reset();
                }
                else if (response.status === 'error') {
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
                        $(this).html('').show(); // Reset content and restore visibility
                    });
                }, 5000);
                }
            });
        }
    });


});

</script>
<?= $this->endSection() ?>
