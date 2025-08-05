<?php 
namespace App\Controllers;
use App\Models\StudentModel;


class About extends \CodeIgniter\Controller
{
    public function index()
    {
        $model = new StudentModel();
         $students = $model->findAll();
        //      echo "<pre>";
        // print_r($students);
        // echo "</pre>";
        // exit;
        return view('about', [
            'title' => 'About',
            'studentList'=>$students
        ]);
    }
}