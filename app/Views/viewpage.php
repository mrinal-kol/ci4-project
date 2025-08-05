<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php
    $data = $studentList;
   ?>
   <form action="<?=base_url('hello/update')?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= isset($data['id']) ? $data['id'] : '' ?>" />
        <table class='table'>
            <tr>
                <td>Name</td>
                <td><input type="text" name='name' value='<?= isset($data['name']) ? $data['name'] : '' ?>'/></td>
            </tr>
            <tr>
                <td>roll</td>
                <td><input type="text" name='roll' value='<?= isset($data['roll']) ? $data['roll'] : '' ?>'/></td>
            </tr>
            <tr>
                <td>class</td>
                <td><input type="text" name='class' value='<?= isset($data['class']) ? $data['class'] : '' ?>'/></td>
            </tr>
            <tr>
                <td>email</td>
                <td><input type="text" name='email' value='<?= isset($data['email']) ? $data['email'] : '' ?>'/></td>
            </tr>
            <tr>
                <td>phone</td>
                <td><input type="text" name='phone' value='<?= isset($data['phone']) ? $data['phone'] : '' ?>'/></td>
            </tr>
            <tr>
                <td>section</td>
                <td><input type="text" name='section' value='<?= isset($data['section']) ? $data['section'] : '' ?>'/></td>
            </tr>
            <tr>
                <td>Pic</td>
                <td><input type="file" name='myfile' /></td>
            </tr>
            <tr>
                <td colspan="2" align='center'><input class='btn btn-primary' type="submit" name='update' value='update' /></td>
            </tr>
        </table>
   </form>

   <?php if (isset($_GET['s']) && $_GET['s'] == 1): ?>
    <div class="alert alert-success">
        Student added successfully!
    </div>
   <?php elseif (isset($_GET['s']) && $_GET['s'] == 0): ?>
    <div class="alert alert-danger">
        Failed to add student.
    </div>
   <?php endif; ?>

<?= $this->endSection() ?>
