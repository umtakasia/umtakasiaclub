<?php 
    session_start();
	require_once 'umt_connection.php';
    $sql = "SELECT `verified` FROM `account` WHERE `email` = ? AND `password` = ?";
		
    if($stmt = mysqli_prepare($conn, $sql)){
        $email = $_SESSION["email"];
        $password = $_SESSION["password"];
        mysqli_stmt_bind_param($stmt, "ss", $email,$password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        if(mysqli_stmt_num_rows($stmt) == 1){
            mysqli_stmt_bind_result($stmt, $c1);
            mysqli_stmt_fetch($stmt);
            
            if($c1 == "true")
            {
                header("Location: thankyou.php");
            }
            else if($c1 == "false")
            {
                echo '<script>alert("Invalid password!")</script>';
                header("Location: home.php");
            }
            else
            {
                
            }
        }
    }
?>



<!DOCTYPE html>
<head>
<meta http-equiv="Refresh" content="30">
<script type="text/javascript">
    function load()
    {
    setTimeout("window.open(self.location, '_self');", 10000);
    }
    </script>
</head>

 <body onload="load()">


<img src="LOGO.png" alt="Universiti Malaysia Terengganu">
      
<p>Redirecting... Please Wait(If )</p>
</body>



</html>