<?php 
$your_email ='samardzicmaria@gmail.com';// <<=== update to your email address

session_start();
$errors = '';
$name = '';
$visitor_email = '';
$user_message = '';

if(isset($_POST['submit']))
{
	
	$name = $_POST['name'];
	$visitor_email = $_POST['email'];
	$user_message = $_POST['message'];
	///------------Do Validations-------------
	if(empty($name)||empty($visitor_email))
	{
		$errors .= "\n Name and Email are required fields. ";	
	}
	if(IsInjected($visitor_email))
	{
		$errors .= "\n Bad email value!";
	}
	if(empty($_SESSION['6_letters_code'] ) ||
	  strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)
	{
	//Note: the captcha code is compared case insensitively.
	//if you want case sensitive match, update the check above to
	// strcmp()
		$errors .= "\n The captcha code does not match!";
	}
	
	if(empty($errors))
	{
		//send the email
		$to = $your_email;
		$subject="New form submission";
		$from = $your_email;
		$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
		
		$body = "A user  $name submitted the contact form:\n".
		"Name: $name\n".
		"Email: $visitor_email \n".
		"Message: \n ".
		"$user_message\n".
		"IP: $ip\n";	
		
		$headers = "From: $from \r\n";
		$headers .= "Reply-To: $visitor_email \r\n";
		
		mail($to, $subject, $body,$headers);
		
		header('Location: thank-you.html');
	}
}

// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
?>








<!doctype html>
<html>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<head>
	<title>NADA MACANKOVIC</title>



	<link rel="stylesheet" href="css/bootstrap.css" type="text/css">
	
	<link rel="stylesheet" href="css/style3.css" type="text/css">


	<!--  <link rel="stylesheet" href="css/jquery.lightbox-0.5.css" type="text/css"> --> 
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="js/bootstrap.js" type="text/javascript"></script>

	<script language="JavaScript" src="scripts/gen_validatorv31.js" type="text/javascript"></script>

<script type="text/javascript" src="js/jquery.carouFredSel-5.6.1.js"></script>
<!-- <script type="text/javascript" src="jquery.js"></script> -->

	
	<!-- // <script src="js/jquery.lightbox-0.5.min.js" type="text/javascript"></script> -->

</head>

<body>
<?php
if(!empty($errors)){
echo "<p class='err'>".nl2br($errors)."</p>";
}
?>



<!-- ovo mi je ona nasa forma -->

<div id='wrap'class="row-fluid">
<div id='navigacija' class='span3'>


<div id='logo'><img src="images/logo1.jpg"/>
	</div>





	


<nav >
		<ul >
			<li><a href="index.html">HOME</a></li>
			
			<li><a id='gal' href="#">GALLERY</a>
		<ul  id='ddmenu' >
			<li><a href="magazine.html">MAGAZINE</a></li>
            <li><a href="art.html">ART</a></li>
            
            
        </ul>


			</li>
			
			<li><a href="#">VIDEOS</a>
			<ul  id='ddmenu' >
            <li><a href="projects.html">projects</a></li>
            <li><a href="newprojects.html">NEW PROJECTS</a></li>
            
        </ul>
    		</li>
    		
			<li><a href="about1.html">ABOUT</a></li>
			<li><a href="contact.html">CONTACT</a></li>
		</ul>
	</nav>


</div>

<div id="contact"  class='span9'>

	


		

		<div   id="kima" >
			

			
			<div id="kontakt-forma" >
			
<div class="row-fluid">
	<div class="span3">
	</div>
					<div class="span8"><h3>CONTACT&nbsp;&nbsp; ME&nbsp; <h3/>

						</div>
					
				</div>


				<div class="row-fluid forma">

					<div id='contact_form_errorloc' class='err'></div>
					<div class="span3"><label for="firstname">FIRST NAME:</label></div>
					<div class="span8">
					<input class="span6" type="text" name="firstname" id="firstname" tabindex="10" required value='<?php echo htmlentities($name) ?>'>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span3"><label for="lastname">LAST NAME:</label></div>
					<div class="span8">
					<input class="span6" type="text" name="lastname" tabindex="20" >
					</div>
				</div>
				<div class="row-fluid">
					<div class="span3"><label for="email">E-MAIL:</label></div>
					<div class="span8">
					<input class="span6" type="email" name="email" tabindex="30"
					value='<?php echo htmlentities($visitor_email) ?>'>
					</div>
				</div>
	
			

				<div class="row-fluid">
					<div class="span3"><label for="message">YOUR MESSAGE:</label></div>
					<div class="span8">
						<textarea class="span8"name="message" ><?php echo htmlentities($user_message) ?></textarea>
					</div>
				</div>





				<div class="row-fluid">
					<div class="span3">&nbsp;</div>
					<div class="span8">
						<input class="dugme" id="send" type="submit" name="submit" tabindex="60" value="send" >
						<input class="dugme " type="reset" name="reset" tabindex="60" value="reset" >
					</div>
				</div>
			
    <div class="alert alert-info hidden" id="upozorenje">
			    <button class="close" data-dismiss="alert">×</button>
			    <strong>Warning!</strong> You didn't fill all the required fields correctly.
			    </div>
   			 <p>&nbsp;</p>

   			<p>&nbsp;</p>
			    <div class="alert alert-success hidden" id="uspesno">
			    <button class="close" data-dismiss="alert">×</button>
			    Thank you! Your message has been sent. 
			    </div>

			</div>
	



		</div>
<script language="JavaScript">
// Code for validating the form
// Visit http://www.javascript-coder.com/html-form/javascript-form-validation.phtml
// for details
var frmvalidator  = new Validator("contact_form");
//remove the following two lines if you like error message box popups
frmvalidator.EnableOnPageErrorDisplaySingleBox();
frmvalidator.EnableMsgsTogether();

frmvalidator.addValidation("name","req","Please provide your name"); 
frmvalidator.addValidation("email","req","Please provide your email"); 
frmvalidator.addValidation("email","email","Please enter a valid email address"); 
</script>
<script language='JavaScript' type='text/javascript'>
function refreshCaptcha()
{
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>













</div>
</div>


	
















</body>
	</html>