<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Job Application Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      padding: 20px;
    }
    .form-container {
      max-width: 600px;
      margin: auto;
      background: #fff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .form-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    label {
      font-weight: bold;
      display: block;
      margin-top: 15px;
    }
    input, textarea, select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    button {
      margin-top: 20px;
      width: 100%;
      padding: 12px;
      background: #0073e6;
      color: #fff;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
    }
    button:hover {
      background: #005bb5;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Job Application Form</h2>
    <!-- Updated to submit to CodeIgniter route -->
    <form action="<?= base_url('sendjobPost') ?>" method="post" enctype="multipart/form-data">
      
      <label for="fullname">Full Name</label>
      <input type="text" id="fullname" name="fullname" value="Mrinal Kanti Mandal" required>
      
      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="mkm000991@gmail.com" required>
      
      <label for="phone">Phone Number</label>
      <input type="tel" id="phone" name="phone" value="8951167690, 9433416097, 6361386997" required>
      
      <label for="position">Position Applied For</label>
      <input type="text" id="position" name="position" value="Web Developer / PHP Developer" required>
      
      <label for="experience">Years of Experience</label>
      <input type="number" id="experience" name="experience" value="8" min="0" required>
      
      <label for="skills">Key Skills</label>
      <textarea id="skills" name="skills" rows="4">PHP, CodeIgniter, Laravel, Magento, MySQL, Ajax, jQuery, Bootstrap, HTML5, CSS3, JavaScript, API Integration, Payment Gateways, AWS</textarea>
      
      
      <label for="resume">Upload Resume</label>
      <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" required>
      
      <button type="submit">Submit Application</button>
    </form>
  </div>
</body>
</html>
