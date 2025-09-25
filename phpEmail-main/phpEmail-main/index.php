<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
function rand_string( $length ) {

  $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  return substr(str_shuffle($chars),0,$length);

}

function getDefaultPassword($str){
    $initial = str_shuffle($str);
    return $initial;
}

if(isset($_POST['send'])){
            $name="Coolers Delight";
            $email= htmlentities($_POST['email']);
            $dpwd = getDefaultPassword($email);
            $subject= "OTP";
            $password = rand_string(8);
            $msg="Your OTP is: ".$password;
            // ."\nYour default password is: ".$dpwd;
    
            $mail = new PHPMailer(true); 
             $mail->isSMTP();
        	$mail->Host       = "sg2plzcpnl503264.prod.sin2.secureserver.net"; 
        	$mail->SMTPAuth   = true;                 
        	$mail->Username   = "info@coolersdelight.com";   
        	$mail->Password   = "JUenpg:E9H5jQh7";            
        	$mail->Port       = 587;                    
            $mail->SMTPSecure = 'tls';
             $mail->isHTML(true);
             $mail->setFrom($email, $name);
             $mail->addAddress('authcoolersdelight@gmail.com');
        	
        	$mail->IsSendmail();  
        
        	$mail->From       = "authentication@coolersdelight.com";
        	$mail->FromName   = "authentication@coolersdelight.com";
        
        	$mail->AddAddress($email);
            $mail->Subject  = $subject;
        	$mail->WordWrap   = 80; 
        
            $mail->MsgHTML($msg);
        	$mail->IsHTML(true); 
        //  $mail->send();
        //  header("Location: ./index.php?=email_sent!");
            if(!$mail->Send())
            {
                ?>
              	<script>
    	            alert("Errors occured, please try again!")
    	        </script>
    	        <?php 
            }
            else
            {
              	?>
              	<script>
    	            alert("Thank You for Contacting Us We Will Response You As Early As Possible")
    	        </script>
    	        <?php 
                // $register = updateUserOTP($_POST,$password);
                header("Location: ./index.php?=email_sent!");
            }
?>
<html>
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/allencasul/lonica@ecf757694536701bca01f35abccd027d973b87cb/css/cdn/lonica.css" integrity="sha256-ZvOPRbk40bnqb7kYJpMnfIBOoIKaHXksgI9BWuvupYE=" crossorigin="anonymous">
  <script defer src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script defer src="https://kit.fontawesome.com/1e8d61f212.js"></script>
</head>
<body class="center-absolute">
  <form class="display-grid row-gap-1-rem" method="post">
  
    <input class="box-shadow-primary" name="email" type="email" placeholder="Email" autocomplete="off" required />
  
    <button type="submit" name="send">
      Send <i class="fa-solid fa-paper-plane color-white margin-left-1-rem"></i>
    </button>
  </form>

  <script defer src="https://cdn.jsdelivr.net/gh/allencasul/lonica@ecf757694536701bca01f35abccd027d973b87cb/js/components.min.js" integrity="sha256-RDu3ysp4BVgm91duXwSsiZ4cx8UGcnSA2hxKLFZMjP8=" crossorigin="anonymous"></script>
</body>
</html>