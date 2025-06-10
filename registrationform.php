<?php
session_start();
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Registraion Form | Knowledge Sathi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Description website">
    <meta name="author" content="Maksym Blank">
    <meta name="keywords" content="website, with, meta, tags">
    <meta name="robots" content="noindex, follow">
    <meta name="revisit-after" content="5 month">
    <meta name="image" content="../../mywebsite.com/image.php">
    <meta name="og:title" content="Title website">
    <meta name="og:description" content="Description website">
    <meta name="og:image" content="../../mywebsite.com/image.php">
    <meta name="og:site_name" content="My Website">
    <meta name="og:type" content="website">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Title website">
    <meta name="twitter:description" content="Description website">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon.png">
    <!-- Css -->
    <link href="assets/css/plugins/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/plugins/slick.css" rel="stylesheet">
    <link href="assets/css/plugins/magnific-popup.css" rel="stylesheet">
    <link href="assets/css/plugins/animate.css" rel="stylesheet">
    <link href="assets/fonts/flaticon/flaticon.css" rel="stylesheet">
    <link href="assets/fonts/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/form.css">
</head>

<body>
    <style>
  .qr-toggle {
    text-align: center;
    cursor: pointer;
    color: #0066cc;
    margin: 10px 0;
  }
  .qr-toggle:hover {
    text-decoration: underline;
  }
  .qr-code-container {
    display: none;
    text-align: center;
    margin: 10px 0;
  }
  .show-qr {
    display: block;
  }
</style>

    <!-- Preloader Start -->
    <div class="preloader">
        <img src="assets/images/preloader.svg" alt="preloader">
    </div>
    <!-- Preloader End -->
    <?php include("header.php");?>

    <div class="career-heading">
        <h1>Career Counseling Form</h1>
		<p align="center"><font color="#FF0000"><b><?php echo $_GET['msg'];?></b></font></p>
    </div>
    <section class="section">
	
    <div class="container">
        
        <form action="send.php" method="POST" enctype="multipart/form-data">
		    <h1 style="font-size:16px">Part I: Personal Information</h1>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group form_style">
                        <label>Full Name *</label>
                        <input type="text" name="name" class="form-control" autocomplete="off" placeholder="Full Name" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group form_style">
                        <label>E-Mail *</label>
                        <input type="email" name="email" class="form-control" autocomplete="off" placeholder="E-Mail" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group form_style">
                        <label>Date of Birth *</label>
                        <input type="date" name="dob" class="form-control" autocomplete="off" placeholder="Date of Birth" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group form_style">
                        <label>Gender *</label>
                         <select name="gender" class="form-control" required>
						 <option value="" selected="selected">Select Anyone</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="other">Other</option>

                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group form_style">
                        <label>Grade *</label>
                        <select name="grade" class="form-control" required>
						    <option value="" selected="selected">Select Anyone</option>
                            <option value="9th OR Lower">9th OR Lower</option>
                            <option value="10th">10th</option>
                            <option value="11th">11th</option>
                            <option value="12th">12th</option>
                        </select>
                    </div>
                </div>
            </div>
     
	<h1 style="font-size:16px">Part II: Career Choices Questionnaire</h1> 
           <div class="row">
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label>1. I am encouraged by school authorities to take<br> courses related to my career development:</label>
            <select name="encouraged" class="form-control">
			    <option value="" selected="selected">Select Anyone</option>
                <option value="Disagreed">Disagreed</option>
                <option value="Neutral">Neutral</option>
                <option value="Agreed">Agreed</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label>2. I am willing to learn about future career<br> opportunities:</label>
            <select name="willingToLearn" class="form-control">
                <option value="" selected="selected">Select Anyone</option>
				<option value="Disagreed">Disagreed</option>
                <option value="Neutral">Neutral</option>
                <option value="Agreed">Agreed</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label>3. Some courses in school are especially for girls:</label>
            <select name="girlsCourses" class="form-control">
                <option value="" selected="selected">Select Anyone</option>
				<option value="Disagreed">Disagreed</option>
                <option value="Neutral">Neutral</option>
                <option value="Agreed">Agreed</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label>4. Teachers treat students equally:</label>
            <select name="teachersTreatEqually" class="form-control">
                <option value="" selected="selected">Select Anyone</option>
				<option value="Disagreed">Disagreed</option>
                <option value="Neutral">Neutral</option>
                <option value="Agreed">Agreed</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label>5. Teachers usually pay more attention to female <br>students:</label>
            <select name="femaleStudents" class="form-control">
                <option value="" selected="selected">Select Anyone</option>
				<option value="Disagreed">Disagreed</option>
                <option value="Neutral">Neutral</option>
                <option value="Agreed">Agreed</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label>6. Teachers usually pay more attention to male <br>students:</label>
            <select name="maleStudents" class="form-control">
                <option value="" selected="selected">Select Anyone</option>
				<option value="Disagreed">Disagreed</option>
                <option value="Neutral">Neutral</option>
                <option value="Agreed">Agreed</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label>7. Teachers encourage students to choose<br>untraditional career choices also:</label>
            <select name="untraditionalCareers" class="form-control">
                <option value="" selected="selected">Select Anyone</option>
				<option value="Disagreed">Disagreed</option>
                <option value="Neutral">Neutral</option>
                <option value="Agreed">Agreed</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label>8. There are support groups in the school for <br>students that encourage them to choose <br>untraditional career choices:</label>
            <select name="supportGroups" class="form-control">
                <option value="" selected="selected">Select Anyone</option>
				<option value="Disagreed">Disagreed</option>
                <option value="Neutral">Neutral</option>
                <option value="Agreed">Agreed</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label>9. I have the same career goal as my friends:</label>
            <select name="sameCareerGoal" class="form-control">
                <option value="" selected="selected">Select Anyone</option>
				<option value="Disagreed">Disagreed</option>
                <option value="Neutral">Neutral</option>
                <option value="Agreed">Agreed</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label>10. I know what I want to do for my future career:</label>
            <select name="knowCareer" class="form-control">
                <option value="" selected="selected">Select Anyone</option>
				<option value="Disagreed">Disagreed</option>
                <option value="Neutral">Neutral</option>
                <option value="Agreed">Agreed</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label>11. I feel confident about reaching my career goals:</label>
            <select name="confidentCareerGoals" class="form-control">
                <option value="" selected="selected">Select Anyone</option>
				<option value="Disagreed">Disagreed</option>
                <option value="Neutral">Neutral</option>
                <option value="Agreed">Agreed</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label>12. My parents support me with my career choice:</label>
            <select name="parentsSupport" class="form-control">
                <option value="" selected="selected">Select Anyone</option>
				<option value="Disagreed">Disagreed</option>
                <option value="Neutral">Neutral</option>
                <option value="Agreed">Agreed</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label>13. My male friends support me with my career<br> choice:</label>
            <select name="maleFriendsSupport" class="form-control">
                <option value="" selected="selected">Select Anyone</option>
				<option value="Disagreed">Disagreed</option>
                <option value="Neutral">Neutral</option>
                <option value="Agreed">Agreed</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label>14. My female friends support me with my career<br> choice:</label>
            <select name="femaleFriendsSupport" class="form-control">
                <option value="" selected="selected">Select Anyone</option>
				<option value="Disagreed">Disagreed</option>
                <option value="Neutral">Neutral</option>
                <option value="Agreed">Agreed</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label>15. It is very important to be economically <br>self-sufficient and be independent:</label>
            <select name="selfSufficient" class="form-control">
                <option value="" selected="selected">Select Anyone</option>
				<option value="Disagreed">Disagreed</option>
                <option value="Neutral">Neutral</option>
                <option value="Agreed">Agreed</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label>16. I enjoy exploring different things:</label>
            <select name="enjoyExploring" class="form-control">
                <option value="" selected="selected">Select Anyone</option>
				<option value="Disagreed">Disagreed</option>
                <option value="Neutral">Neutral</option>
                <option value="Agreed">Agreed</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label>17. I can be whatever I want to be:</label>
            <select name="beAnything" class="form-control">
                <option value="" selected="selected">Select Anyone</option>
				<option value="Disagreed">Disagreed</option>
                <option value="Neutral">Neutral</option>
                <option value="Agreed">Agreed</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label>18. I can make my own decisions:</label>
            <select name="makeDecisions" class="form-control">
                <option value="" selected="selected">Select Anyone</option>
				<option value="Disagreed">Disagreed</option>
                <option value="Neutral">Neutral</option>
                <option value="Agreed">Agreed</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label>19. I set my career goal by considering my abilities:</label>
            <select name="careerGoalsBasedOnAbilities" class="form-control">
                <option value="" selected="selected">Select Anyone</option>
				<option value="Disagreed">Disagreed</option>
                <option value="Neutral">Neutral</option>
                <option value="Agreed">Agreed</option>
            </select>
        </div>
    </div>
</div>
    <h1 style="font-size:16px">Part III: Career Choices Questionnaire</h1>
    <h1 style="font-size:16px">Please check two (2) of the following statements that apply to you most:</h1>
            <div class="row">
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label><input type="checkbox" name="checkvalue1" value="Yes"> I enjoy analyzing data using statistics</label>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label><input type="checkbox" name="checkvalue2" value="Yes"> I would like to find solutions to economic problems</label>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label><input type="checkbox" name="checkvalue3" value="Yes"> I am interested in art</label>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label><input type="checkbox" name="checkvalue4" value="Yes"> I enjoy entertaining the audience</label>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label><input type="checkbox" name="checkvalue5" value="Yes"> I am against injustice and inequality</label>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label><input type="checkbox" name="checkvalue6" value="Yes"> I am an extrovert person</label>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label><input type="checkbox" name="checkvalue7" value="Yes"> I like repairing things in my house</label>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label><input type="checkbox" name="checkvalue8" value="Yes"> I am intrested in industrial design</label>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label><input type="checkbox" name="checkvalue9" value="Yes"> I always check my medical reports in details</label>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label><input type="checkbox" name="checkvalue10" value="Yes"> I enjoy helping people</label>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label><input type="checkbox" name="checkvalue11" value="Yes"> I am intrested in programming</label>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group form_style">
            <label><input type="checkbox" name="checkvalue12" value="Yes"> I prefer working on my own</label>
        </div>
    </div>
	<h1 style="font-size:16px; text-align:center; width:100%;">Part IV: Payment</h1>
	<!-- ===== NEW: PART IV - PAYMENT VERIFICATION ===== -->
            <h1 class="qr-toggle" onclick="toggleQR()" style="font-size:16px; text-align: center;">
  ▼ Click to Show Payment QR Code ▼
</h1>

<div class="qr-code-container" id="qrCodeContainer">
  <img src="../KS Server/assets/images/qrcode.jpg" style="max-width: 300px;">
  <p><small>Scan with any UPI app (Google Pay, PhonePe, Paytm)</small></p>
</div>

<div class="row">
  <!-- Payment Screenshot Upload (always visible) -->
  <div class="col-lg-6 col-sm-12">
    <div class="form-group form_style">
      <label>Upload Payment Screenshot *</label>
      <input type="file" name="payment_proof" class="form-control" accept="image/*" required>
    </div>
  </div>
  
  <!-- Transaction Reference (always visible) -->
<div class="col-lg-6 col-sm-12">
  <div class="form-group form_style">
    <label>Transaction/Reference Number *</label>
    <input type="text" 
           name="transaction_id" 
           class="form-control" 
           required
           style="border: 1px solid #333; 
                  background-color: #f9f9f9; 
                  padding: 12px; 
                  font-size: 16px; 
                  color: #000;">
  </div>
</div>
            
            <!-- Captcha (Existing) -->
            <div class="col-lg-6 col-sm-12">
                <div class="form-group form_style">
                    <label><?php $_SESSION['6_letters_code'] = rand(11111,99999); 
                    echo "Captcha Code : ".$_SESSION['6_letters_code'];
                    ?></label>
                    <input type="text" id="6_letters_code" name="6_letters_code" class="form-control" autocomplete="off" placeholder="Captcha Code" required style="border: 1px solid #333; 
                  background-color: #f9f9f9; 
                  padding: 12px; 
                  font-size: 16px; 
                  color: #000;">
                </div>
            </div>
            
            <!-- Submit Button -->
            <div class="col-lg-12 text-center">
                <button type="submit" class="thm-btn bg-thm-color-three thm-color-three-shadow btn-rectangle">Submit<i class="fal fa-chevron-right ml-2"></i></button>
            </div>
        </form>
    </div>
</section>
<script>
  function toggleQR() {
    const qrContainer = document.getElementById('qrCodeContainer');
    const toggleHeading = document.querySelector('.qr-toggle');
    
    if (qrContainer.classList.contains('show-qr')) {
      qrContainer.classList.remove('show-qr');
      toggleHeading.innerHTML = '▼ Click to Show Payment QR Code ▼';
    } else {
      qrContainer.classList.add('show-qr');
      toggleHeading.innerHTML = '▲ Click to Hide Payment QR Code ▲';
    }
  }
</script>

    <!-- Footer Start -->
    <footer class="footer">
    <?php include("footer.php");?>
    </footer>
    <!-- Footer End -->
    <a href="#" data-target="html" class="back-to-top ft-sticky">
        <i class="fal fa-long-arrow-up"></i>
    </a>
    <!-- Scripts -->
    <script src="assets/js/plugins/jquery-3.6.0.min.js"></script>
    <script src="assets/js/plugins/bootstrap.bundle.min.js"></script>
    <script src="assets/js/plugins/slick.min.js"></script>
    <script src="assets/js/plugins/imagesloaded.min.js"></script>
    <script src="assets/js/plugins/isotope.pkgd.min.js"></script>
    <script src="assets/js/plugins/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/plugins/jquery.counterup.min.js"></script>
    <script src="assets/js/plugins/jquery.inview.min.js"></script>
    <script src="assets/js/plugins/jquery.easypiechart.js"></script>
    <script src="assets/js/plugins/jquery.countdown.min.js"></script>
    <script src="assets/js/plugins/wow.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>