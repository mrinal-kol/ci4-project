<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
   
       <table class='table' border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Roll</th>
            <th>Class</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Section</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
         <?php if (!empty($studentList) && is_array($studentList)): ?>

            <?php
            //print_r($studentList);
            ?>
            <?php foreach ($studentList as $student): ?>
                <tr>
                    <td><?= esc($student['id']) ?></td>
                    <td><?= esc($student['name']) ?></td>
                    <td><?= esc($student['roll']) ?></td>
                    <td><?= esc($student['class']) ?></td>
                    <td><?= esc($student['email']) ?></td>
                    <td><?= esc($student['phone']) ?></td>
                    <td><?= esc($student['section']) ?></td>
                    <td> <img src="<?= base_url('uploads/' . esc($student['file_details'])) ?>"  style="max-width:100px;"> </td>
                    <td>
                        <a href="<?=base_url('hello/edit/'.$student['id'])?>"><button>Edit</button></a>
                        <button>Copy</button>
                        <button>Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="8">No student records found.</td></tr>
        <?php endif; ?>
    </tbody>
        </table>

  
<?= $this->endSection() ?>
