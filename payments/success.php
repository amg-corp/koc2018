<?php
require_once('../Mail/class.phpmailer.php');
require_once('../Mail/class.smtp.php');

include '../includes/init.php';

$status = $_POST["status"];
$firstname = $_POST["firstname"];
$amount = $_POST["amount"];
$txnid = $_POST["txnid"];
$posted_hash = $_POST["hash"];
$key = $_POST["key"];
$productinfo = $_POST["productinfo"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$role = $_POST["amount"] == "1" ? "Student" : "Professional";
$email = $_POST["email"];
$salt = "4lPfUCnjwj";
$payment = false;

$body1 = "Congratulations on successful registration with koc2016.<br>
         This is to inform you that we have received your application for the upcoming conference on April 17th, 2016 as <b>" . $role . "</b>.";
$body2 = "In case of any issues regarding Transaction, please feel free to contact us at <a href='mailto:transaction@koc2016.in' style='text-decoration: underline;'>transaction@koc2016.in</a> "
        . "mentioning your transaction id(TXNID) and conference id(conid)";
$body3 = "Best Regards,<br>
          <b>KOC2016 Support</b>";

?>	

<html>
    <head>
        <title> KOC2016 | Success</title>
        <meta http-equiv="refresh" content="10; URL='<?php echo $home ?>'">
    </head>

    <body onload="clearData();">
        <div id="data">
            <?php
            If (isset($_POST["additionalCharges"])) {
                $additionalCharges = $_POST["additionalCharges"];
                $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
            } else {

                $retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
            }
            $hash = hash("sha512", $retHashSeq);

            if ($hash != $posted_hash) {
                echo "Invalid Transaction. Please try again";
            } else {

// Create connection
                $conn = mysql_connect($servername, $username, $password, $dbname);

// Check connection
                if (!$conn) {
                    die("Connection failed: " . mysql_error());
                }

                mysql_select_db('mydb');

                $sql = "INSERT INTO `koc2016regitration`.`reg` (`name`, `role`, `Productinfo`,`mobile`, `Email`, `TransactionId`, `is_Paid`) VALUES ('$firstname','$role',
                       '$productinfo','$phone','$email', '$txnid', 1);";

                mysql_query($sql);
                $conid = mysql_insert_id() + 700;

                if (!($conid > 0)) {
                    echo "No Data";
                    exit();
                }

                $bodyLline1 = "<div><h3>Dear " . $firstname . ",</h3>";
                $bodyLline2 = "<p>" . $body1 . "</p>";
                $bodyLline3 = "<li>Your CONID: " . $conid . "</li>";
                $bodyLline4 = "<li>Your TXNID: " . $txnid . "</li>";
                $bodyLline5 = "<p>" . $body2 . "</p>";
                $bodyLline6 = "<p>" . $body3 . "</p></div>";

                $mail = new PHPMailer(); // create a new object
                $mail->IsSMTP(); // enable SMTP
                $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
                $mail->SMTPAuth = true; // authentication enabled
                $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
                $mail->Host = "sg2plcpnl0094.prod.sin2.secureserver.net";
                $mail->Port = 465; // or 587
                $mail->IsHTML(true);
                $mail->Username = "registration@koc2016.in";
                $mail->Password = "Reg@2016";
                $mail->SetFrom("registration@koc2016.in");
                $mail->Subject = "Registration Confirmation for " . $firstname . " | CON ID: " . $conid;
                $mail->Body = $bodyLline1 . $bodyLline2 . $bodyLline3 . $bodyLline4 . $bodyLline5 . $bodyLline6;
                $mail->AddAddress($email, $firstname);
                $mail->AddAddress("aritram90@gmail.com", "Aritra Mondal");
                if (!$mail->Send()) {
                    echo "Mailer Error: " . $mail->ErrorInfo;
                    exit();
                }
                $payment = true;
            }
            ?>
        </div>
        <div id="correct">
            <?php
            if ($payment) {
                echo "<h3>Thank You. Your order status is " . $status . ".</h3>";
                echo "<h4>Your Transaction ID for this transaction is " . $txnid . ".</h4>";
                echo "<h4>We have received a payment of Rs. " . $amount . ". Your will receve an confirmation mail soon.</h4>";
                
            } else {
                echo "<h3>Thank You. Your order status is " . $status . ".</h3>";
                echo "<h3>Your order failed</h3>";
            }
            
            echo '<h3>If your browser doesn\'t automatically go to home within a few seconds,you may want to go to <a href="' . $home . '">the homepage</a> manually.</h2>';
            ?>
        </div>

        <script type="text/javascript">
            function clearData() {
                document.getElementById('data').innerHTML = '';
            }
        </script>
    </body>
</html>