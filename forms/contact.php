<?php

  require("class.phpmailer.php");
  require("class.smtp.php");

  $name = $_POST["name"];
  $email = $_POST["email"];
  $subject = $_POST["subject"];
  $message = $_POST["message"];

  $EmailTo = "info@g2r.com.ar";
  //$EmailTo = "santiagomauhourat@hotmail.com";
  $Subject = "Contacto Web - Greencloud.com.ar";
  
  // Datos de la cuenta de correo utilizada para enviar vía SMTP
  $smtpHost = "c1730360.ferozo.com";  // Dominio alternativo brindado en el email de alta 
  $smtpUsuario = "info@greencloud.com.ar";  // Mi cuenta de correo
  $smtpClave = "G3rman1971";  // Mi contraseña

// prepare email body text
$Body = "";
$Body .= "Name: ";
$Body .= $name;
$Body .= "\n";
$Body .= "Email: ";
$Body .= $email;
$Body .= "\n";
$Body .= "Subject: ";
$Body .= $subject;
$Body .= "\n";
$Body .= "Message: ";
$Body .= $message;
$Body .= "\n";

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 465; 
$mail->SMTPSecure = 'ssl';
$mail->IsHTML(true); 
$mail->CharSet = "utf-8";

// VALORES A MODIFICAR //
$mail->Host = $smtpHost; 
$mail->Username = $smtpUsuario; 
$mail->Password = $smtpClave;

$mail->From = $email; // Email desde donde envío el correo.
$mail->FromName = $name;
$mail->AddAddress($EmailTo); // Esta es la dirección a donde enviamos los datos del formulario

$mail->Subject = "Greencloud.com.ar - Contacto Web"; // Este es el titulo del email.
$mensajeHtml = nl2br($Body);
$mail->Body = "{$mensajeHtml} <br /><br />{$name}<br />{$email}"; // Texto del email en formato HTML
$mail->AltBody = "{$Body} \n\n {$name} \n {$email}"; // Texto sin formato <HTML></HTML>


// FIN - VALORES A MODIFICAR //

$success = $mail->Send();   

//redirect to success page
if ($success && $errorMSG == ""){
  echo "OK";
}else{
   if($errorMSG == ""){
       echo "Ha ocurrido un error :(";
   } else {
       echo $errorMSG;
   }
}

?>
