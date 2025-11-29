<?php


namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\StudentModel;
use CodeIgniter\Events\Events;
use App\Libraries\Addrecord;
use PhpOffice\PhpWord\IOFactory;
//use TCPDF;
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
        $newName='';
        //echo $this->request->getMethod();
        if ($this->request->getMethod() === 'POST') {


              $file = $this->request->getFile('myfile');

              if ($file && $file->isValid() && !$file->hasMoved()) {
                  $newName = $file->getRandomName();

                  if ($file->move(FCPATH . 'uploads', $newName)) {
                      //echo "File uploaded successfully: " . $newName;
                  } else {
                      // Move failed
                      //echo "File could not be moved!";
                      //exit;
                      return $this->response->setJSON([ 'status' => 'error','errors' => 'error in upload file']);
                  }
              } else {
                //return $this->response->setJSON([ 'status' => 'error','errors' => 'error in upload file']);
                //exit;
                  // Show error details
                  //echo "File upload failed!<br>";
                  //echo "Error Code: " . $file->getError() . "<br>";
                  //echo "Error Message: " . $file->getErrorString();
                 // exit;
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

      $newName='';
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

      /*
        careers@freshworks.com,careers@zohocorp.com,careers@browserstack.com,careers@postman.com,careers@tallysolutions.com,careers@inmobi.com,careers@cleartax.in,careers@mindfiresolutions.com,hr@binaryfolks.com,careers@indusnet.co.in,hr@esolz.net,hr@corelynx.com,hr@cyberswift.net,hr@citytechcorp.com,hr@kreeti.com,info@webguru-india.com,career@technosoft.com,hr@nextgen.com,hr@teamcognito.com,contact@innofied.com,hr@peconsoftware.com,careers@fusionbpo.com,hr@unifiedinfotech.net,info@anisoftech.com,hr@idealogic.com,hr@turing.com,career@binaryic.com,careers@mobisoftinfotech.com,hr@tatainfotech.com,careers@niit-tech.com,hr@ust-global.com,careers@hexaware.com,hr@zensar.com,careers@persistent.com,hr@sonata-software.com,hr@ramco.com,careers@newgensoft.com,hr@happiestminds.com,careers@exlservice.com,hr@subex.com,careers@cyient.com,hr@infogain.com,careers@zycus.com,hr@icertis.com,careers@nagarro.com,hr@tataelxsi.com,careers@fractal.ai,hr@musigma.com,hr@xoriant.com,careers@mindtree.com,careers@mphasis.com,hr@birlasoft.com,careers@coforge.com,hr@niit.com,hr@capillarytech.com,careers@iifl.com,hr@intellectdesign.com,careers@lntinfotech.com,hr@niit-tech.com,careers@aurionpro.com,hr@subexworld.com,hr@synechron.com,careers@ust.com,hr@kpit.com,careers@sasken.com,hr@infrasofttech.com,careers@zensar.com,hr@teksystems.com,careers@trigent.com,hr@infobeans.com,hr@qburst.com,careers@volansys.com,hr@tothenew.com,careers@valuelabs.com,hr@harman.com,careers@hexagon.com,hr@geekyants.com,careers@accenture.com,hr@hcl.com,hr@infosys.com,hr@wipro.com,hr@tcs.com,careers@cognizant.com,careers@capgemini.com,hr@techmahindra.com,hr@ibm.com,hr@oracle.com,hr@sap.com,hr@adobe.com,hr@deloitte.com,hr@pwc.com,careers@ey.com,hr@kpmg.com,hr@siemens.com,careers@bosch.com,hr@nokia.com,careers@ericsson.com

      */
      
      if ($this->request->getMethod() === 'POST') 
      {
        

        

          $emails1 = "careers@freshworks.com,careers@zohocorp.com,careers@browserstack.com,careers@postman.com,careers@tallysolutions.com,careers@inmobi.com,careers@cleartax.in,careers@mindfiresolutions.com,hr@binaryfolks.com,careers@indusnet.co.in";

          $emails2 = "hr@esolz.net,hr@corelynx.com,hr@cyberswift.net,hr@citytechcorp.com,hr@kreeti.com,info@webguru-india.com,career@technosoft.com,hr@nextgen.com,hr@teamcognito.com,contact@innofied.com";

          $emails3 = "hr@peconsoftware.com,careers@fusionbpo.com,hr@unifiedinfotech.net,info@anisoftech.com,hr@idealogic.com,hr@turing.com,career@binaryic.com,careers@mobisoftinfotech.com,hr@tatainfotech.com,careers@niit-tech.com";

          $emails4 = "hr@ust-global.com,careers@hexaware.com,hr@zensar.com,careers@persistent.com,hr@sonata-software.com,hr@ramco.com,careers@newgensoft.com,hr@happiestminds.com,careers@exlservice.com,hr@subex.com";

          $emails5 = "careers@cyient.com,hr@infogain.com,careers@zycus.com,hr@icertis.com,careers@nagarro.com,hr@tataelxsi.com,careers@fractal.ai,hr@musigma.com,hr@xoriant.com,careers@mindtree.com";

          $emails6 = "careers@mphasis.com,hr@birlasoft.com,careers@coforge.com,hr@niit.com,hr@capillarytech.com,careers@iifl.com,hr@intellectdesign.com,careers@lntinfotech.com,hr@niit-tech.com,careers@aurionpro.com";

          $emails7 = "hr@subexworld.com,hr@synechron.com,careers@ust.com,hr@kpit.com,careers@sasken.com,hr@infrasofttech.com,careers@zensar.com,hr@teksystems.com,careers@trigent.com,hr@infobeans.com";

          $emails8 = "hr@qburst.com,careers@volansys.com,hr@tothenew.com,careers@valuelabs.com,hr@harman.com,careers@hexagon.com,hr@geekyants.com,careers@accenture.com,hr@hcl.com,hr@infosys.com";

          $emails9 = "hr@wipro.com,hr@tcs.com,careers@cognizant.com,careers@capgemini.com,hr@techmahindra.com,hr@ibm.com,hr@oracle.com,hr@sap.com,hr@adobe.com,hr@deloitte.com";

          $emails10 = "hr@pwc.com,careers@ey.com,hr@kpmg.com,hr@siemens.com,careers@bosch.com,hr@nokia.com,careers@ericsson.com";


        

        $data = $this->request->getPost();
        $fullname   = $data['fullname'];
        $from_email      = $data['email'];
        $phone      = $data['phone'];
        $position   = $data['position'];
        $experience = $data['experience'];
        $skills     = $data['skills'];
        $to_email     = $data['toemail'];
        $information     = $data['information'];
        $extra_info ='';
        if($information!='')
        {
             $extra_info ='<strong>Additional Information:</strong><br>'.$information;
        }
        //exit;
        //$to_email     = $emails10;

        //print_r($to_email);
        //exit;

        // Professional email body in HTML
        $html = '
              <div style="font-family:Arial, sans-serif; font-size:14px; color:#333; line-height:1.6;">
          <p>Dear Hiring Manager,</p>

          <p>I am writing to formally apply for the position of 
          <strong>Web Developer / PHP Developer</strong>. 
          With <strong>'.$experience.' years of professional experience</strong> in web development, I have developed 
          extensive expertise in <strong>PHP (Core & OOPs), CodeIgniter, Laravel, Magento, MySQL, 
          JavaScript, jQuery, Ajax, Bootstrap, HTML5, CSS3, Vue.js, React.js and Flutter</strong>. 
          Additionally, I have hands-on experience with <strong>API integration, payment gateway solutions, 
          and AWS cloud services</strong>.</p>

          <p>At <strong>Celex Technologies Pvt. Ltd.</strong>, I led and contributed to multiple projects 
          in travel technology, e-commerce, and fintech, including:</p>

          <ul>
              <li><strong>MakeMyHSRP.com</strong> - A high-security registration plate management system 
                  built with PHP, MySQL, AWS, and integrated payment gateways.</li>
              <li><strong>TripCheers.com & MSTHappyJourney.com</strong> - Travel booking platforms (flights, hotels, 
                  holidays, recharges) with multi-currency support and agent commission modules.</li>
              <li>Custom <strong>CRM and ERP applications</strong> with secure integrations of PayPal, PayU, 
                  CCAvenue, Easebuzz, and CyberPlat APIs.</li>
          </ul>

          <p>I hold an <strong>MCA degree from Sikkim Manipal Institute of Technology</strong> and 
          have consistently demonstrated the ability to deliver efficient, scalable, and business-driven 
          solutions. I am particularly interested in this opportunity because of <strong>growth-oriented environment</strong>.</p>

          <p>Enclosed is my resume for your review. I would be delighted to discuss in more detail how 
          my skills and background align with your requirements and how I can contribute to your team’s success.</p>

          <p>Thank you for your time and consideration.</p>
          '.$extra_info.'
          
          <p>
          Best regards,<br>
          <strong>'.$fullname.'</strong><br>
          📞 '.$phone.'<br>
          📍 Nayapatti, Kolkata<br>
          ✉️ '.$from_email.'
          </p>
      </div>

        ';
        //echo $html;
        //exit;
        // Attach resume (adjust path as per your upload logic)
        //$resumePath = FCPATH . 'uploads/' . ($data['resume'] ?? 'Mrinal_Kanti_Mandal_Resume.docx');
        /*
        $resumeFile = $this->request->getFile('resume');
        $resumePath = '';
        if ($resumeFile && $resumeFile->isValid() && !$resumeFile->hasMoved()) {
            $newName = $resumeFile->getRandomName();  
            $resumeFile->move(FCPATH . 'uploads', $newName);  
            $resumePath = FCPATH . 'uploads/' . $newName;
        }
        */

        $resumePath = FCPATH . 'uploads/' .'1756203084_2bbc0a366f7b2ecf86e5.docx';
        $subject = 'Application for '.$position.' -'.$fullname;
        // Send email
        $send_email_status = $this->jobPostsendEmail($to_email, $subject, $html, $resumePath,$from_email);

        if ($send_email_status) {
           // return "✅ Application email sent successfully.";
           $data['message'] = "✅ Application email sent successfully.";
        } else {
           // return "❌ Failed to send application email.";
           $data['message'] = "❌ Failed to send application email.";
        }

        return view('jobPost_email', $data);
      }
      else{
        
        return redirect()->to(base_url('jobPost'));
      }
    }


    public function jobPostsendEmail($to , $subject , $message,$attachmentName,$from_email)
    {

        
        $to_emails = array_map('trim', explode(',', $to));
        

        //$attachment =  WRITEPATH . 'uploads/'.$attachmentName  ;
        $attachment =$attachmentName;
        //$attachment = FCPATH . 'uploads/' . $attachmentName;
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

        foreach ($to_emails as $recipient) {
            if (!filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
                log_message('error', "Invalid email skipped: $recipient");
                continue;
            }

            $email->clear(true); // ✅ clear previous headers, attachments, etc.

            $email->setFrom($from_email, 'Mrinal');
            $email->setTo($recipient);
            $email->setSubject($subject);
            $email->setMessage($message);

            if (!empty($attachment) && file_exists($attachment)) {
                $email->attach($attachment);
            }

            if (!$email->send()) {
                log_message('error', 'Email sending failed for ' . $recipient . ': ' . print_r($email->printDebugger(['headers']), true));
            }
        }
        return true;
    }


    public function pdfConvert()
    {
        return view('upload_form');
    }

    public function docpdfConvert()
    {
        return view('upload_doc_form');
    }

      public function convertDocToPDF_let()
      {
          $file = $this->request->getFile('docs');

          if (!$file->isValid()) {
              return "File upload error!";
          }

          // Step 1: Upload DOCX file
          $newName = $file->getRandomName();
          $filePath = WRITEPATH . 'uploads/' . $newName;
          $file->move(WRITEPATH . 'uploads/', $newName);

          // Step 2: Load DOCX with PhpWord
          $phpWord = \PhpOffice\PhpWord\IOFactory::load($filePath);

          // Step 3: Convert DOCX → HTML (MOST IMPORTANT)
          $htmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
          $htmlPath = WRITEPATH . "uploads/" . $newName . ".html";
          $htmlWriter->save($htmlPath);

          // Step 4: Load HTML → Convert to PDF using DomPDF
          $dompdf = new \Dompdf\Dompdf();
          $dompdf->loadHtml(file_get_contents($htmlPath));
          $dompdf->setPaper('A4', 'portrait');
          $dompdf->render();

          // Step 5: Create PDF file
          $pdfName = pathinfo($newName, PATHINFO_FILENAME) . ".pdf";
          $pdfPath = WRITEPATH . "uploads/" . $pdfName;

          file_put_contents($pdfPath, $dompdf->output());

          // Step 6: Delete DOCX + HTML after PDF generated
          unlink($filePath);
          unlink($htmlPath);

          // Step 7: Download PDF and delete after download
          return $this->response->download($pdfPath, null)->setFileName($pdfName)->setContentType('application/pdf')->setFileDeleted(true);
      }

    public function uploadImage()
    {
        try {
            // Load TCPDF manually
            require_once APPPATH . 'Libraries/tcpdf/tcpdf.php';

            $file = $this->request->getFile('image');

            if (!$file->isValid()) {
                return redirect()->back()->with('error', 'Please select a valid image.');
            }

            // Move uploaded file to writable/uploads
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $newName);
            $filePath = WRITEPATH . 'uploads/' . $newName;

            // Create PDF
            $pdf = new \TCPDF();
            $pdf->AddPage();

            // Full-page A4 (210 x 297 mm)
            $pdf->Image($filePath, 10, 10, 190, 0, '', '', '', false, 300);

            // Send as download
            $this->response->setHeader('Content-Type', 'application/pdf');
            $pdf->Output('converted.pdf', 'D'); // D = download

        } catch (\Exception $e) {
            // Log error and show friendly message
            log_message('error', 'PDF Generation Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while generating the PDF.');
        }
    }

    public function convertDocTopdf()
    {
        $file = $this->request->getFile('docs');

        if (!$file->isValid()) {
        return "Invalid file";
    }

    // Upload path
    $uploadPath = WRITEPATH . 'uploads/';
    if (!is_dir($uploadPath)) mkdir($uploadPath, 0777, true);

    // Move uploaded file
    $newName = $file->getRandomName();
    $file->move($uploadPath, $newName);

    $docxPath = $uploadPath . $newName;

    // Load DOCX
    $phpWord = \PhpOffice\PhpWord\IOFactory::load($docxPath);

    // Renderer
    \PhpOffice\PhpWord\Settings::setPdfRendererName('TCPDF');
    \PhpOffice\PhpWord\Settings::setPdfRendererPath(APPPATH . "Libraries/tcpdf/");

    // Generate PDF
    $pdfName = pathinfo($newName, PATHINFO_FILENAME) . ".pdf";
    $pdfPath = $uploadPath . $pdfName;

    $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'PDF');
    $writer->save($pdfPath);

    // Delete DOCX
    unlink($docxPath);

    // Read PDF content manually
    $pdfData = file_get_contents($pdfPath);

    // Delete PDF after reading
    unlink($pdfPath);

    // Return PDF as download
    return $this->response
        ->setHeader('Content-Type', 'application/pdf')
        ->setHeader('Content-Disposition', 'attachment; filename="' . $pdfName . '"')
        ->setBody($pdfData);
    }

    public function skinImage()
    {

       try {
            require_once APPPATH . 'Libraries/tcpdf/tcpdf.php';
            $file = $this->request->getFile('image');

            if ($file->isValid() && !$file->hasMoved()) 
            {
                $newName = $file->getRandomName();
                $file->move(WRITEPATH . 'uploads', $newName);

                // Load TCPDF library
                $pdf = new \TCPDF();
                $pdf->setPrintHeader(false);
                $pdf->setPrintFooter(false);
                $pdf->AddPage();

                $imagePath = WRITEPATH . 'uploads/' . $newName;

                // Insert image inside PDF
                $pdf->Image($imagePath, 15, 30, 180, 0, '', '', '', false, 300);
                // Insert image inside PDF (fit width of A4)
                //$pdf->Image($imagePath, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

                
                // Optional: Add header text
                //$pdf->SetFont('helvetica', 'B', 14);
                //$pdf->SetY(10);
                //$pdf->Cell(0, 10, 'Soft Copy Document', 0, 1, 'C');

                // Save output as PDF
                //$pdfName = WRITEPATH . 'uploads/' . pathinfo($newName, PATHINFO_FILENAME) . '.pdf';
                //$pdf->Output($pdfName, 'F');
                $this->response->setHeader('Content-Type', 'application/pdf');
                $pdf->Output('converted.pdf', 'D'); // D = download

                //echo "✅ Soft copy generated: " . $pdfName;
            } 
            else 
            {
                //echo "❌ Invalid file upload.";
            }
        } 
        catch (\Exception $e) 
        {
            // Log error and show friendly message
            log_message('error', 'PDF Generation Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while generating the PDF.');
        }
    }

    public function deleterec($r)
    {
      echo "test";
    }

}


