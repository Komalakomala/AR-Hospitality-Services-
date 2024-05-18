<?php 
require("class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP();
$mail->Host = "smartwealth-n.cloudhostdns.net";

$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Port = 465;
$mail->Username = "info@udmindia.in";
$mail->Password = 'Admin@1234@Admin';

$mail->From = "info@udmindia.in";
$mail->FromName = "Prakash Enterprises";

$mail->AddAddress("prakash61972@gmail.com");
//$mail->AddCC("melodynaorem11@gmail.com");

$mail->IsHTML(true);

$mail->Subject = "Contact us form Prakash Enterprises"; 
$message =  "<b>Contact us form from Prakash Enterprises :<b><br>";
foreach ($_POST as $key => $value){
	$message .= "<br>".$key." : ".$value;  
}
$mail->Body = $message ;
//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

if(!$mail->Send())
{
   echo '<script type="text/javascript">'; 
    echo 'alert("Error! Please try again");';
    echo 'window.location.href = "contact.html";';
    echo '</script>';
}
else {
	echo '<script type="text/javascript">';
    echo 'alert("Saved Your Details Successfully");';
    echo 'window.location.href = "contact.html";';
    echo '</script>';
  }


// ?>