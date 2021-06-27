<?php 
	require_once 'umt_connection.php';
?>

<?php  
 if(isset($_POST["true"]))  
 {  

    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['email'],$_POST['password']))
    {
        $veri = "true";
        $email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
        $sql = "UPDATE `account` SET `verified`= ?  WHERE `email` = ? AND `password`=?";
		if($stmt = mysqli_prepare($conn ,$sql)){
			
			mysqli_stmt_bind_param($stmt, "sss", $veri, $email,$password);
			
			mysqli_stmt_execute($stmt);
			
			if(mysqli_stmt_affected_rows($stmt) == 1){
                echo '<script>alert("Succesfully set to true!")</script>';
			}
			else{
				echo '<script>alert("Fail set to true!")</script>';
			}
			mysqli_stmt_close($stmt);
		}  
    }	
	   
 } 
else if(isset($_POST["false"]))
{
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['email'],$_POST['password']))
    {
        $veri = "false";
        $email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
        $sql = "UPDATE `account` SET `verified`= ?  WHERE `email` = ? AND `password`=?";
		if($stmt = mysqli_prepare($conn ,$sql)){
			
			mysqli_stmt_bind_param($stmt, "sss", $veri, $email,$password);
			
			mysqli_stmt_execute($stmt);
			
			if(mysqli_stmt_affected_rows($stmt) == 1){
                echo '<script>alert("Succesfully set to false!")</script>';
			}
			else{
				echo '<script>alert("Fail set to false!")</script>';
			}
			mysqli_stmt_close($stmt);
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
                <button class="form-element form-button" type="submit" name="true"
                    >true</button>
                    <button class="form-element form-button" type="submit" name="false"
                    >false</button>
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

