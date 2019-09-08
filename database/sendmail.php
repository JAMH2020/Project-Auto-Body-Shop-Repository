<?php
/*************************************************
** sends an email to the client using PHPMailer **
**************************************************/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//name of the sender
$sender_name = "JAMH Group";

//email of the sender
$sender_email = "JAMH@portcreditautobodyshop.tk";

//password of the sender email
$email_password = "************";

//email of the receiver
$receiver_email = "___________________";

//subject of the email
$subject = "Email test";

//message of the email
$message = "Testing if this goes into spam";

//retrieve the files used in the PHPMailer library
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';



$mail = new PHPMailer(true);

$mail->SMTPDebug = 0;

//send through SMTP
$mail->Host = 'smtp.mboxhosting.com';
$mail->SMTPAuth = true;
$mail->Username = $sender_email;
$mail->Password = $email_password;
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

//create email headers
$mail->setFrom($sender_email, $sender_name);
$mail->addAddress($receiver_email);
$mail->addReplyTo($sender_email, $name);

$mail->isHTML(true); 

//create the subject and the message of the email
$mail->Subject = $subject;
$mail->Body = $message;

//sends the mail if no exceptions were encountered
try {
  $mail->send();
  echo 'Your message was sent successfully!';
} catch (Exception $e) {
     echo "Your message could not be sent! PHPMailer Error: {$mail->ErrorInfo}";
}
