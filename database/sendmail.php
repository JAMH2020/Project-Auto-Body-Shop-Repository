<?php
/*************************************************
** sends an email to the client using PHPMailer **
**************************************************/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_mail($receiver, $message_subject, $email_message){

  //TEMPORARILY turn email service off by only sending to self
  $receiver = "JAMH@portcreditautobodyshop.tk";


  //name of the sender
  $sender_name = "JAMH Group";

  //email of the sender
  $sender_email = "JAMH@portcreditautobodyshop.tk";

  //password of the sender email
  $Password = "****************";

  //email of the receiver
  $receiver_email = $receiver;

  //subject of the email
  $subject = $message_subject;

  //message of the email
  $message = $email_message;

  //retrieve the files used in the PHPMailer library
  require '/srv/disk13/3148213/www/portcreditautobodyshop.tk/database/src/Exception.php';
  require '/srv/disk13/3148213/www/portcreditautobodyshop.tk/database/src/PHPMailer.php';
  require '/srv/disk13/3148213/www/portcreditautobodyshop.tk/database/src/SMTP.php';



  $mail = new PHPMailer(true);

  $mail->SMTPDebug = 0;

  //send through SMTP
  $mail->Host = 'smtp.mboxhosting.com';
  $mail->SMTPAuth = true;
  $mail->Username = $sender_email;
  $mail->Password = $Password;
  $mail->SMTPSecure = 'tls';
  $mail->Port = 587;

  //create email headers
  $mail->setFrom($sender_email, $sender_name);
  $mail->addAddress($receiver_email);
  $mail->addReplyTo($sender_email, $name);

  //create the subject and the message of the email
  $mail->Subject = $subject;
  $mail->Body = $message;
  
  $mail->isHTML(true); 


  //sends the mail if no exceptions were encountered
  try {
    $mail->send();
    echo 'Your message was sent successfully!';
  } catch (Exception $e) {
       echo "Your message could not be sent! PHPMailer Error: {$mail->ErrorInfo}";
  }
        
}
 ?>
