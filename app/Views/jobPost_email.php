<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
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
      margin: 0;
      padding: 0px;
    }
    .form-container {
      width: 100%;
      max-width: 100%;
      background: #fff;
      padding: 4px 40px 40px 40px;
      border-radius: 0;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .form-container h2 {
      text-align: center;
      margin-bottom: 4px;
      font-size: 28px;
      color: #333;
    }
    .form-group {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }
    .form-group label {
      width: 200px; /* fixed label width */
      font-weight: bold;
      color: #444;
    }
    .form-group input,
    .form-group textarea,
    .form-group select {
      flex: 1;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 15px;
    }
    .form-group textarea {
      min-height: 73px;
    }
    button {
      display: block;
      margin: 30px auto 0;
      width: 300px;
      padding: 15px;
      background: #0073e6;
      color: #fff;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 17px;
      font-weight: bold;
    }
    button:hover {
      background: #005bb5;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Job Application Form</h2>
      <!-- ✅ Success / Failure Message -->
        <?php if (isset($message)): ?>
            <div id="flash-message"  style="padding:12px; margin:15px 0;border-radius:6px;font-weight:bold;
                        <?php if (strpos($message, '✅') !== false): ?>
                            background:#d4edda; color:#155724; border:1px solid #c3e6cb;
                        <?php else: ?>
                            background:#f8d7da; color:#721c24; border:1px solid #f5c6cb;
                        <?php endif; ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>
      <!-- ✅ End Message -->
    <form action="<?= base_url('sendjobPost') ?>" method="post" enctype="multipart/form-data">
      
      <div class="form-group">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="fullname" value="Mrinal Kanti Mandal" required>
      </div>
      
      <div class="form-group">
        <label for="email">From Email</label>
        <input type="email" id="email" name="email" value="mkm000991@gmail.com" required>
      </div>

      <div class="form-group">
        <label for="toemail">To Email</label>
        <input type="email" id="toemail" name="toemail" value="" required>
      </div>
      
      <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" value="8951167690 / 9433416097 / 6361386997" required>
      </div>
      
      <div class="form-group">
        <label for="position">Position Applied For</label>
        <input type="text" id="position" name="position" value="Web Developer / PHP Developer" required>
      </div>
      
      <div class="form-group">
        <label for="experience">Years of Experience</label>
        <input type="number" id="experience" name="experience" value="8" min="0" required>
      </div>
      
      <div class="form-group">
        <label for="skills">Key Skills</label>
        <textarea id="skills" name="skills">PHP, CodeIgniter, Laravel, Magento, MySQL, Ajax, jQuery, Bootstrap, HTML5, CSS3, JavaScript, API Integration, Payment Gateways, AWS</textarea>
      </div>
      
      <div class="form-group">
        <label for="resume">Upload Resume</label>
        <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" required>
      </div>
      
      <button type="submit">Submit Application</button>
    </form>
  </div>
</body>
</html>
<script>
        // Hide message after 5 seconds
        setTimeout(function() {
            var msg = document.getElementById("flash-message");
            if (msg) {
                msg.style.transition = "opacity 1s";
                msg.style.opacity = "0";
                setTimeout(() => msg.remove(), 1000); // fully remove after fade
            }
        }, 5000);
    </script>
<?= $this->endSection() ?>
