<html>
    <head>
        <title>VCOVS | Mail</title>
    </head>

    <?php
    require_once('class.phpmailer.php');
    require_once('class.smtp.php');

    $feedback = 0;

    $name = $_POST["name"];
    $email = $_POST["email"];
    $Phone = $_POST["phone"];
    $plan = $_POST["plan"];

    echo "Name: " . $name;
    echo "Email: " . $email;
    echo "Phone: " . $Phone;
    echo "Plan: " . $plan;
    echo "--------------------------------------";
    echo "\n";

    $bodyLline1 = "Name: ". $name;
    $bodyLline2 = "Email: " . $email . "\n";
    $bodyLline3 = "Phone: " . $Phone . "\n";
    $bodyLline4 = "Plan: " . $plan . "\n";


    $mail = new PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
    $mail->Host = "sg2plcpnl0094.prod.sin2.secureserver.net";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "koc2016.admin@koc2016.in";
    $mail->Password = "admin#1234";
    $mail->SetFrom("koc2016.admin@koc2016.in");
    $mail->Subject = "Feedback from " . $name;
    $mail->Body = "Following are the Feedback details:\\n" . $bodyLline1 . $bodyLline2 . $bodyLline3 . $bodyLline4;
    $mail->AddAddress("registration.info@koc2016.in", "Koc Registration 2016");
//    $mail->AddAddress("sourajitonline@gmail.com", "Sourajit Mitra");
//    $mail->AddAddress("aritram90@gmail.com", "Aritra Mondal");
//    $mail->AddAddress("gourabmitraonline@gmail.com", "Gourab Mitra");
    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
//    header("Location");
    } else {
        echo "Message has been sent";
//        header('Location: ../index1.php');
//    http_redirect("../index1.php",true,HTTP_REDIRECT_PERM);  
        ?>
        <body>
            <script>
//                window.location.href = "../index.html?v=d";
            </script>
        </body>
    </html>
    <?php
}