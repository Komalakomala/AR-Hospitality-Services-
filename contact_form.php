<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';

// $recaptcha_secret = '6LfB0yYpAAAAAEQY_qQQdZiiJxyL89X0ZjAqw3AJ';
// $recaptcha_response = $_POST['g-recaptcha-response'];

// $url = "https://www.google.com/recaptcha/api/siteverify";
// $data = [
//     'secret' => $recaptcha_secret,
//     'response' => $recaptcha_response,
// ];

// $options = [
//     'http' => [
//         'header' => "Content-type: application/x-www-form-urlencoded\r\n",
//         'method' => 'POST',
//         'content' => http_build_query($data),
//     ],
// ];

// $context = stream_context_create($options);
// $result = file_get_contents($url, false, $context);
// $json = json_decode($result, true);

// if ($json['success'] !== true) {
//     die('CAPTCHA verification failed!');
// }






//get data from form
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

if($_POST['name']){
  $name = $_POST['name'];
}
if($_POST['email']){
  $email = $_POST['email'];
}
if($_POST['phone']){
  $phone = $_POST['phone'];
}
if($_POST['message']){
  $message = $_POST['message'];
}
// preparing mail content
if($phone){
  $messagecontent ='<html> 
  <head>
  <title>Arhospitalitys Service</title>
  </head>
  <body>
  <br>
  <h2>Arhospitalitys Service - Contact Us</h2>

  <ul style="list-style-type:square;"> 
    <h3><li>Name : ' . $name . '</li></h3>
    <h3><li>Email : ' . $email . '</li></h3>
    <h3><li>Phone : ' . $phone . '</li></h3>
    <h3><li>Message : ' . $message . '</li></h3>
  </ul>

  <h4 style="color: grey;">Thank you<br>Arhospitalitys Service Team</h4>
  <br>

  </body> 
  </html>';
}else{
  $messagecontent ='<html> 
        <head>
        <title>Arhospitalitys Service</title>
        </head>
        <body>
        <br>
        <h2 style="color: #33bbff;">Arhospitalitys Service - Contact Us</h2>

        <ul style="list-style-type:square; color: #3399ff;"> 
          <h3><li>Name : ' . $name . '</li></h3>
          <h3><li>Email : ' . $email . '</li></h3>
          <h3><li>Message : ' . $message . '</li></h3>
        </ul>

        <h4 style="color: grey;">Thank you<br>Arhospitalitys Service Team</h4>
        <br>

        </body> 
        </html>';
}

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
try {
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    //$mail->isSMTP();
    //$mail->Host = 'smtp.gmail.com';
   // $mail->SMTPAuth = true;
   // $mail->Username = 'rajnarayan777be@gmail.com'; // Your Gmail email address
    //$mail->Password = 'ziumzjlhcsmisvnn'; // Your Gmail app password or your account password (if less secure apps are allowed)
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    //$mail->Port = 587; // TCP port to connect to
   $mail->isSMTP();
   $mail->Host = 'smartwealth-n.cloudhostdns.net';
   $mail->SMTPAuth = true;
   $mail->Username = 'info@arhospitalityservices.in';
   $mail->Password = 'Admin@2569@Admin';
   $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // or PHPMailer::ENCRYPTION_STARTTLS;
   $mail->Port = 465;
	
    $mail->setFrom($email, $name);
    $mail->addAddress('info@arhospitalityservices.in', 'AR Hospitality & Services');
    $mail->isHTML(true);
    $mail->Subject = 'New Contact Form Submission';
    $mail->Body = $messagecontent;

    $mail->send();
    header('Location: https://arhospitalityservices.in/?status=success&message=' . urlencode('Thank you for contacting us. We will contact you shortly.'));
    exit;
} catch (Exception $e) {
    // Redirect with error message
    header('Location: https://arhospitalityservices.in/?status=error&message=' . urlencode("Message could not be sent. Mailer Error: {$mail->ErrorInfo}"));
    exit;
}
?>