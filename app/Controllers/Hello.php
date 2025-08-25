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


              $file = $this->request->getFile('myfile');

              if ($file && $file->isValid() && !$file->hasMoved()) {
                  $newName = $file->getRandomName();

                  if ($file->move(FCPATH . 'uploads', $newName)) {
                      //echo "File uploaded successfully: " . $newName;
                  } else {
                      // Move failed
                      echo "File could not be moved!";
                      exit;
                  }
              } else {
                  // Show error details
                  echo "File upload failed!<br>";
                  echo "Error Code: " . $file->getError() . "<br>";
                  echo "Error Message: " . $file->getErrorString();
                  exit;
              }


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
                'file_details' => $newName,
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

                        $html ='<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Professional Email</title>
  </head>
  <body style="margin:0; padding:0; background-color:#f2f4f6; font-family:Helvetica Neue,Helvetica,Arial,sans-serif;">
    <center style="width:100%; background-color:#f2f4f6;">
      <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#f2f4f6">
        <tr>
          <td align="center">
            <!-- Container -->
            <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color:#ffffff; margin: 40px 0; border-radius:8px; overflow:hidden; box-shadow:0 2px 4px rgba(0,0,0,0.1);">
              
              <!-- Header -->
              <tr>
                <td style="padding: 30px; background-color:#004080; color:#ffffff; text-align:center;">
                  <h1 style="margin:0; font-size:24px;">Company Name</h1>
                  <p style="margin:5px 0 0; font-size:14px;">Professional Update</p>
                </td>
              </tr>

              <!-- Main Image -->
              <tr>
                <td>
                  <!--<img src="https://via.placeholder.com/600x200?text=Professional+Banner" alt="Banner" style="width:100%; display:block;" />-->
                  <!--<img src="https://ui-avatars.com/api/?name=Your+Company&background=004080&color=fff&size=150" alt="Company Logo" />-->
                  <!--<img src="https://images.unsplash.com/photo-1522199710521-72d69614c702?crop=entropy&cs=tinysrgb&fit=crop&h=60&w=200" alt="Logo" />-->
                </td>
              </tr>

              <!-- Content Section -->
              <tr>
                <td style="padding: 30px; color:#333333;">
                  <h2 style="margin-top:0;">Subject Line or Greeting</h2>
                  <p>Dear '.htmlspecialchars($data['name']).',</p>
                  <p>
                    We are reaching out to share the latest updates and insights from our team. Here is what is new:
                  </p>
                  <ul style="padding-left:20px;">
                    <li>Update 1: Important announcement or feature</li>
                    <li>Update 2: Upcoming event or deadline</li>
                    <li>Update 3: Recent achievement or milestone</li>
                  </ul>
                  <p>
                    We appreciate your continued partnership and look forward to sharing more exciting news soon.
                  </p>
                  <p>Best regards,<br><strong>Your Company Team</strong></p>
                </td>
              </tr>

              <!-- Call-to-Action Button -->
              <tr>
                <td align="center" style="padding: 20px;">
                  <a href="https://example.com" style="background-color:#007BFF; color:#ffffff; text-decoration:none; padding:12px 24px; font-size:16px; border-radius:4px; display:inline-block;">Learn More</a>
                </td>
              </tr>

              <!-- Footer -->
              <tr>
                <td style="background-color:#f9f9f9; padding:20px; text-align:center; font-size:12px; color:#777;">
                  <p style="margin:0;">&copy; 2025 Company Name. All rights reserved.</p>
                  <p style="margin:5px 0 0;">
                    <a href="#" style="color:#777; text-decoration:underline;">Unsubscribe</a> |
                    <a href="#" style="color:#777; text-decoration:underline;">Privacy Policy</a>
                  </p>
                </td>
              </tr>

            </table>
            <!-- End Container -->
          </td>
        </tr>
      </table>
    </center>
  </body>
</html>
';

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

                        $send_email_status=$this->sendEmail('mkm000991@gmail.com', 'Student Record Added',$html,$newName);
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
            $file->move(FCPATH . 'uploads', $newName); // FCPATH WRITEPATH

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


    public function sendEmail($to , $subject , $message,$attachmentName )
    {

        //$attachment =  WRITEPATH . 'uploads/'.$attachmentName  ;
        $attachment = FCPATH . 'uploads/' . $attachmentName;
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

        $email->setFrom('ronojit.dev20153@gmail.com', 'Developer Mrinal');
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($message);
        if (!empty($attachment) && file_exists($attachment)) {
            $email->attach($attachment);
        }

        if ($email->send()) {
            return true;
        } else {
            log_message('error', 'Email sending failed: ' . print_r($email->printDebugger(['headers']), true));
            return false;
        }
    }
    public function jobpost()
    {
        return view('jobPost_email');
    }

    public function jobpostemail()
    {
        $data = $this->request->getPost();

        // Professional email body in HTML
        $html = '
        <div style="font-family:Arial, sans-serif; font-size:14px; color:#333; line-height:1.6;">
            <p>Dear Hiring Manager,</p>

            <p>I am writing to formally apply for the position of 
            <strong>Web Developer / PHP Developer</strong> at <strong>[Company Name]</strong>. 
            With <strong>8 years of professional experience</strong> in web development, I have developed 
            extensive expertise in <strong>PHP (Core & OOPs), CodeIgniter, Laravel, Magento, MySQL, 
            JavaScript, jQuery, Ajax, Bootstrap, HTML5, and CSS3</strong>. 
            Additionally, I have hands-on experience with <strong>API integration, payment gateway solutions, 
            and AWS cloud services</strong>.</p>

            <p>At <strong>Celex Technologies Pvt. Ltd.</strong>, I led and contributed to multiple projects 
            in travel technology, e-commerce, and fintech, including:</p>

            <ul>
                <li><strong>MakeMyHSRP.com</strong> – A high-security registration plate management system 
                    built with PHP, MySQL, AWS, and integrated payment gateways.</li>
                <li><strong>TripCheers.com & MSTHappyJourney.com</strong> – Travel booking platforms (flights, hotels, 
                    holidays, recharges) with multi-currency support and agent commission modules.</li>
                <li>Custom <strong>CRM and ERP applications</strong> with secure integrations of PayPal, PayU, 
                    CCAvenue, Easebuzz, and CyberPlat APIs.</li>
            </ul>

            <p>I hold an <strong>MCA degree from Sikkim Manipal Institute of Technology</strong> and 
            have consistently demonstrated the ability to deliver efficient, scalable, and business-driven 
            solutions. I am particularly interested in this opportunity because of <strong>[reason tailored to company – 
            e.g., cutting-edge projects, growth-oriented environment, or reputation for innovation]</strong>.</p>

            <p>Enclosed is my resume for your review. I would be delighted to discuss in more detail how 
            my skills and background align with your requirements and how I can contribute to your team’s success.</p>

            <p>Thank you for your time and consideration.</p>

            <br>
            <p>
            Best regards,<br>
            <strong>Mrinal Kanti Mandal</strong><br>
            📞 8951167690 | 9433416097 | 6361386997<br>
            📍 Kalipark, Kolkata<br>
            ✉️ mkm000991@gmail.com
            </p>
        </div>
        ';

        // Attach resume (adjust path as per your upload logic)
        $resumePath = FCPATH . 'uploads/' . ($data['resume'] ?? 'Mrinal_Kanti_Mandal_Resume.docx');

        // Send email
        $send_email_status = $this->jobPostsendEmail(
            'mkm000991@gmail.com', // <-- recruiter email here
            'Application for Web Developer / PHP Developer – Mrinal Kanti Mandal', 
            $html, 
            $resumePath
        );

        if ($send_email_status) {
            return "✅ Application email sent successfully.";
        } else {
            return "❌ Failed to send application email.";
        }
    }


    public function jobPostsendEmail($to , $subject , $message,$attachmentName )
    {

        //$attachment =  WRITEPATH . 'uploads/'.$attachmentName  ;
        $attachment = FCPATH . 'uploads/' . $attachmentName;
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

        $email->setFrom('ronojit.dev20153@gmail.com', 'Mrinal');
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($message);
        if (!empty($attachment) && file_exists($attachment)) {
            $email->attach($attachment);
        }

        if ($email->send()) {
            return true;
        } else {

            print_r($email->printDebugger(['headers']));
            exit;
            log_message('error', 'Email sending failed: ' . print_r($email->printDebugger(['headers']), true));
            return false;
        }
    }




}


