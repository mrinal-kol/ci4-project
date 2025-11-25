<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
   
     <!-- Add Bootstrap CSS in your layout/header -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-4">
    <h2 class="mb-4">Student Records</h2>

    <table class="table table-bordered table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Photo</th>
                <th scope="col">Name</th>
                <th scope="col">Roll</th>
                <th scope="col">Class</th>
                <th scope="col">Section</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($studentList) && is_array($studentList)): ?>
                <?php foreach ($studentList as $student): ?>
                    <tr>
                        <td><?= esc($student['id']) ?></td>
                        <td>
                            <?php
                            if($student['file_details']!='' || !empty($student['file_details']))
                            {
                                ?>
                            
                            <img src="<?= base_url('uploads/' . esc($student['file_details'])) ?>" 
                                 class="img-thumbnail" 
                                 style="max-width: 70px; height:auto;">

                            <?php
                            }
                            ?>
                        </td>
                        <td><?= esc($student['name']) ?></td>
                        <td><?= esc($student['roll']) ?></td>
                        <td><?= esc($student['class']) ?></td>
                        <td><?= esc($student['section']) ?></td>
                        <td><?= esc($student['email']) ?></td>
                        <td><?= esc($student['phone']) ?></td>
                        <td class="text-center">
                            <a href="<?= base_url('hello/edit/'.$student['id']) ?>" class="btn btn-sm btn-primary">
                                Edit
                            </a>
                           
                            <a href="<?= base_url('delete/'.$student['id']) ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Are you sure you want to delete this record?');">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="text-center text-muted">No student records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>


  
<?= $this->endSection() ?>
