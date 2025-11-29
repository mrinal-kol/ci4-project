<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Job Application Form</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

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
   <style>
        /* Modal Background */
        #previewModal {
            display:none;
            position:fixed;
            top:0; left:0;
            width:100%; height:100%;
            background:rgba(0,0,0,0.6);
            padding:40px 0;
            z-index:9999;
        }

        /* Modal Box */
        #previewBox {
            background:#fff;
            width:60%;
            max-height:80vh;
            margin:auto;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 20px rgba(0,0,0,0.4);
            overflow-y:auto;    /* Enables scrolling inside popup */
        }

        /* Hide scrollbar overlay */
        #previewBox::-webkit-scrollbar {
            width:8px;
        }
        #previewBox::-webkit-scrollbar-thumb {
            background:#bbb;
            border-radius:10px;
        }
        #previewBtn {
            background-color: red;
            color: white;
            border: none;
        }
        #previewBtn:hover {
            background-color: darkred;
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
        <input type="text" id="toemail" name="toemail" value="" required>
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
        <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" >
      </div>
      <div class="form-group">
        <label for="information">Additional Information: </label>
        <textarea id="information" name="information" rows='7'>▪ Total Experience: 9 Years<br> 
▪ Current CTC: ₹80,000 per month <br>
▪ Expected CTC: ₹1,20,000 per month <br>
▪ Notice Period: Immediate Joiner<br></textarea>
      </div>
      
      <button type="submit">Submit Application</button>
    </form>
    <button id="previewBtn" >Preview Email</button>
  </div>
  
  <div id="previewModal">
    <div id="previewBox">
        <h3 class="text-center mb-3">Email Preview</h3>
        <div id="previewContent" style="white-space:pre-line; font-size:16px;"></div>

        <div class="text-end mt-4">
            <button id="closePreview" class="btn btn-danger">Close</button>
        </div>
    </div>
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
    
document.getElementById("previewBtn").addEventListener("click", function () {

    let fullname     = document.getElementById("fullname").value;
    let position     = document.getElementById("position").value;
    let experience   = document.getElementById("experience").value;
    let skills       = document.getElementById("skills").value;
    let information  = document.getElementById("information").value;

    let previewText = `
Dear Hiring Manager,

I am writing to formally apply for the position of ${position}. With ${experience} years of professional experience in web development, I have developed extensive expertise in ${skills}.

At Celex Technologies Pvt. Ltd., I led and contributed to multiple projects in travel technology, e-commerce, and fintech, including:

MakeMyHSRP.com - A high-security registration plate management system built with PHP, MySQL, AWS, and integrated payment gateways.
TripCheers.com & MSTHappyJourney.com - Travel booking platforms (flights, hotels, holidays, recharges) with multi-currency support and agent commission modules.
Custom CRM and ERP applications with secure integrations of PayPal, PayU, CCAvenue, Easebuzz, and CyberPlat APIs.

I hold an MCA degree from Sikkim Manipal Institute of Technology and have consistently demonstrated the ability to deliver efficient, scalable, and business-driven solutions. I am particularly interested in this opportunity because of growth-oriented environment.

Enclosed is my resume for your review. I would be delighted to discuss in more detail how my skills and background align with your requirements and how I can contribute to your team’s success.

Thank you for your time and consideration.

Additional Information:
${information}
    `;

    document.getElementById("previewContent").innerText = previewText;
    document.getElementById("previewModal").style.display = "block";
});


// Close on button click
document.getElementById("closePreview").addEventListener("click", function () {
    document.getElementById("previewModal").style.display = "none";
});

// Close when clicking anywhere outside modal box
document.getElementById("previewModal").addEventListener("click", function (event) {
    if (event.target === this) { 
        this.style.display = "none";
    }
});
</script>
<?= $this->endSection() ?>
