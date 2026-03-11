<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php
    $data = $studentList;
   ?>
   <form action="<?= base_url('hello/update') ?>" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= isset($data['id']) ? $data['id'] : '' ?>" />

        <table class='table'>

            <tr>
            <td>Name</td>
            <td>
            <input type="text" name="name" value="<?= old('name', $data['name'] ?? '') ?>" />
            <?php if(session('errors.name')): ?>
            <div style="color:red"><?= session('errors.name') ?></div>
            <?php endif; ?>
            </td>
            </tr>

            <tr>
            <td>Roll</td>
            <td>
            <input type="text" name="roll" value="<?= old('roll', $data['roll'] ?? '') ?>" />
            <?php if(session('errors.roll')): ?>
            <div style="color:red"><?= session('errors.roll') ?></div>
            <?php endif; ?>
            </td>
            </tr>

            <tr>
            <td>Class</td>
            <td>
            <input type="text" name="class" value="<?= old('class', $data['class'] ?? '') ?>" />
            <?php if(session('errors.class')): ?>
            <div style="color:red"><?= session('errors.class') ?></div>
            <?php endif; ?>
            </td>
            </tr>

            <tr>
            <td>Email</td>
            <td>
            <input type="text" name="email" value="<?= old('email', $data['email'] ?? '') ?>" />
            <?php if(session('errors.email')): ?>
            <div style="color:red"><?= session('errors.email') ?></div>
            <?php endif; ?>
            </td>
            </tr>

            <tr>
            <td>Phone</td>
            <td>
            <input type="text" name="phone" value="<?= old('phone', $data['phone'] ?? '') ?>" />
            <?php if(session('errors.phone')): ?>
            <div style="color:red"><?= session('errors.phone') ?></div>
            <?php endif; ?>
            </td>
            </tr>

            <tr>
            <td>Section</td>
            <td>
            <input type="text" name="section" value="<?= old('section', $data['section'] ?? '') ?>" />
            <?php if(session('errors.section')): ?>
            <div style="color:red"><?= session('errors.section') ?></div>
            <?php endif; ?>
            </td>
            </tr>

            <tr>
            <td>Pic</td>
            <td>
            <input type="file" name="myfile" />
            <?php if(session('errors.myfile')): ?>
            <div style="color:red"><?= session('errors.myfile') ?></div>
            <?php endif; ?>
            </td>
            </tr>

            <tr>
            <td colspan="2" align="center">
            <input class="btn btn-primary" type="submit" name="update" value="update" />
            </td>
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
