<?php


namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\StudentModel;
use CodeIgniter\Events\Events;
use App\Libraries\Addrecord;

class Hello extends Controller
{
    public function index()
    {
        return view('home', [
            'title' => 'Home Page'
        ]);
    }
    public function about()
    {
        echo "Hello from greet!";
    }

    public function add()
    {
        //echo $this->request->getMethod();
        if ($this->request->getMethod() === 'POST') {
            //echo "<pre>";
            $data = $this->request->getPost();
            //print_r($data); // Outputs all form values
             $data = [
                'name'    => $this->request->getPost('name'),
                'roll'    => $this->request->getPost('roll'),
                'class'   => $this->request->getPost('class'),
                'email'   => $this->request->getPost('email'),
                'phone'   => $this->request->getPost('phone'),
                'section' => $this->request->getPost('section'),
            ];

            //$model = new StudentModel();
            //$model->insert($data);

             $studentLib = new Addrecord();
           

            try{

                    $addrecord = $studentLib->addData($data);
                    if($addrecord==true)
                    {
                        //if ($model->insert($data)) {
                        Events::trigger('after_form_submit', $data);

                        $htmlMessage = '
                        <!DOCTYPE html>
                        <html lang="en">
                        <head>
                          <meta charset="UTF-8">
                          <title>Student Added</title>
                          <style>
                            body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
                            .container { background: #fff; padding: 20px; border-radius: 6px; max-width: 600px; margin: auto; box-shadow: 0 0 10px rgba(0,0,0,0.1);}
                            .header { background-color: #4CAF50; color: white; padding: 10px; text-align: center; }
                            .content { padding: 20px; color: #333; }
                            .footer { background-color: #eee; padding: 10px; text-align: center; font-size: 12px; color: #777; }
                          </style>
                        </head>
                        <body>
                          <div class="container">
                            <div class="header">
                              <h2>New Student Added</h2>
                            </div>
                            <div class="content">
                              <p>Hello,</p>
                              <p>A new student record has just been added to the system.</p>
                              <p><strong>Name:</strong> ' . htmlspecialchars($data['name']) . '</p>
                              <p><strong>Email:</strong> ' . htmlspecialchars($data['email']) . '</p>
                              <p>Thank you!</p>
                            </div>
                            <div class="footer">
                              &copy; ' . date('Y') . ' Your Company Name
                            </div>
                          </div>
                        </body>
                        </html>';

                        $send_email_status=$this->sendEmail('mkm000991@gmail.com', 'Student Record Added',$htmlMessage);
                        //echo $send_email_status;
                        //exit;
                        return  $this->response->setJSON(['status'=>'success']);
                           // echo "Student inserted successfully!";
                         //return redirect()->to(base_url('hello?s=1'));
                    }
                    else 
                    {
                       //return $this->response->setJSON([ 'status' => 'error','errors' => $model->errors()]);
                        return $this->response->setJSON([ 'status' => 'error','errors' => 'error in library']);
                        //echo "Error inserting student:";
                        //print_r($model->errors()); // Show model validation errors
                    }

            }
            catch(\mysqli_sql_exception $e)
            {
                  return $this->response->setJSON([
                        'status' => 'error',
                        'errors' => ['database' => $e->getMessage()]
                    ]);
                
            } 
            catch (\Exception $e) 
            {
                // Catch any other general exceptions
                return $this->response->setJSON([
                    'status' => 'error',
                    'errors' => ['general' => $e->getMessage()]
                ]);
            }
        }
        return $this->response->setStatusCode(405)->setJSON(['status' => 'error', 'message' => 'Invalid request method']);
        
    }
    public function edit($id)
    {
        $model = new StudentModel();
        $student = $model->find($id);
        // echo "<pre>";
        // print_r($student);
        // echo "</pre>";
        if (!$student) {
           // throw new \CodeIgniter\Exceptions\PageNotFoundException("Student with ID $id not found");
        }

        return view('viewpage',['studentList'=>$student]);
    }
    public function update()
    {
        //echo "<pre>";
        //print_r($this->request->getPost());
        //exit;
         $file = $this->request->getFile('myfile');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Rename the file if needed, or use the original name
            $newName = $file->getRandomName();

            // Move the file to writable/uploads
            $file->move(WRITEPATH . 'uploads', $newName);

            echo "File uploaded successfully: " . $newName;
        } else {
            echo "File upload failed!";
        }
        
        $post=$this->request->getPost();
        $id = $this->request->getPost('id');

        $data = [
            'name'    => $this->request->getPost('name'),
            'roll'    => $this->request->getPost('roll'),
            'class'   => $this->request->getPost('class'),
            'email'   => $this->request->getPost('email'),
            'phone'   => $this->request->getPost('phone'),
            'section' => $this->request->getPost('section'),
            'file_details' => $newName,
        ];
        $model = New StudentModel;
        if ($model->update($id, $data)) 
        {
            return redirect()->to(base_url('about'));
        }
         else 
        {
            echo "Error updating student:";
            print_r($model->errors());
        }
    }


    public function sendEmail($to , $subject , $message )
    {
        $email = \Config\Services::email();

        $config = [
            'protocol'  => 'smtp',
            'SMTPHost'  => 'smtp.gmail.com',
            'SMTPUser'  => 'ronojit.dev20153@gmail.com',       // ✅ Your Gmail
            'SMTPPass'  => 'rhsqnjouqbuvtqng',          // ✅ App password (not Gmail login)
            'SMTPPort'  => 587,
            'SMTPCrypto'=> 'tls',
            'mailType'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n",
        ];

        $email->initialize($config);

        $email->setFrom('mkm000991@gmail.com', 'Amit Sen');
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) {
            return true;
        } else {
            log_message('error', 'Email sending failed: ' . print_r($email->printDebugger(['headers']), true));
            return false;
        }
    }




}


