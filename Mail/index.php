<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
require_once('class.phpmailer.php');
require_once('class.smtp.php');

$feedback = 0;

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$age = $_POST["age"];
$comment = $_POST["comment"];
$email = $_POST["email"];


echo "Name: " . $fname . " " . $lname;
echo "Age: " . $age;
echo "Mail: " . $email;
echo "Comment: " . $comment;
echo "--------------------------------------";
echo "\n";

$bodyLline1 = "Name: " . $fname . " " . $lname . "\\n";
$bodyLline2 = "Age: " . $age . "\n";
$bodyLline3 = "Mail: " . $email . "\n";
$bodyLline4 = "Comment: " . $comment . "\n";


$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "bh-8.webhostbox.net";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "vcovs.admin@vcovs.org";
$mail->Password = "admin1234";
$mail->SetFrom("vcovs.admin@vcovs.org");
$mail->Subject = "Feedback from " . $fname . " " . $lname;
$mail->Body = "Following are the Feedback details:\\n" . $bodyLline1 . $bodyLline2 . $bodyLline3 . $bodyLline4;
$mail->AddAddress("vcovs.feedback@vcovs.org", "VCOVS Feedback");
$mail->AddAddress("aritra.mondal@vcovs.org", "VCOVS AMG");
$mail->AddAddress("aritram90@gmail.com", "Aritra Mondal");
$mail->AddAddress("gourabmitraonline@gmail.com", "Gourab Mitra");
echo "<h1> Hi</h1>";
if (!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
//    header("Location");
} else {
    echo "Message has been sent";
//        header('Location: ../index1.php');
//    http_redirect("../index1.php",true,HTTP_REDIRECT_PERM);  
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

    </body>
</html>
