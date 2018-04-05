<?php
$to      = 'nobody@example.com';
$subject = 'qr code';
$message = "<html><head></head><body>";
$message .= "<img src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=%3Ca%20href=%22localhost%22%3Eklik%20hier%20om%20te%20betalen%3C/a%3E' alt='' /></body></html>";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From: info@test.net\r\n"."X-Mailer: php";

  mail($to, $subject, $message, $headers);
?>
