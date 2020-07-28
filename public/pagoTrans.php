<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include("PHPMailer-master/src/Exception.php");
include("PHPMailer-master/src/PHPMailer.php");
include("PHPMailer-master/src/SMTP.php");


  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//echo "<script>console.log('datos:->".$_REQUEST."')</script>";
//print_r($_REQUEST);
//exit;

// guardar aqui en variables lo que traiga 

    $referencia = $_REQUEST['referencia'];
    $codigo = $_REQUEST['codigo'];
    $precioTotal = $_REQUEST['precioTotal'];
    $correoBene = $_REQUEST['correoBene'];
    $benefactor = $_REQUEST['benefactor'];
    $respaldo = 'respaldoemprendum@um.edu.mx';
    $asunto = 'Emprendum - ';
   // $correoBene = 'edny_k3@hotmail.com';
    

        $content_donante="<div style='width: 496px; border-radius: 4px; box-sizing: border-box; padding: 0 45px; margin: 40px auto; overflow: hidden; border: 1px solid #b0afb5; font-family: &quot;Open Sans&quot;, sans-serif; color: #4f5365;'>
        <div>
          <div style='position: relative;	top: -1px; padding: 9px 0 10px; font-size: 11px; text-transform: uppercase; text-align: center; color: #ffffff; background: #000000'>Ficha digital. No es necesario imprimir.</div>
          <div style='margin-top: 26px; position: relative;'>
            <div style='width: 45%; float: left;'><img style='max-width: 150px; margin-top: 2px;' src='https://emprendum.um.edu.mx/images/Logo_Emprendum.png' alt='SPEIPay'></div>
            <div style='width: 55%; float: right;'>
              <h3>Monto a pagar</h3>
              <h2 style='font-size: 36px; color: #000000; line-height: 24px; margin-bottom: 15px;'>$ $precioTotal.00 <sup style='font-size: 16px; position: relative; top: -2px'>MXN</sup></h2>
              <p style='font-size: 10px; line-height: 14px;'>Monto toal a pagar.</p>
            </div>
          </div>
          <div style='visibility: hidden; display: block;font-size: 0; content: &quot;&quot;; clear: both; height: 0;'></div>
          <div style='margin-top: 14px;'>
            <h3 style='margin-bottom: 10px;	font-size: 15px; font-weight: 600; text-transform: uppercase;'>CLABE</h3>
            <h1 style='font-size: 27px; color: #000000; text-align: center; margin-top: -1px; padding: 6px 0 7px; border: 1px solid #b0afb5; border-radius: 4px; background: #f8f9fa;'>$referencia</h1>
          </div>
        </div>
        <div style='margin: 32px -45px 0; padding: 32px 45px 45px; border-top: 1px solid #b0afb5; background: #f8f9fa;'>
          <h3>Instrucciones</h3>
          <ol style='margin: 17px 0 0 16px;'>
            <li style='margin-top: 10px; color: #000000;'>Inicia sesión en tu banca portal en linea.</li>
            <li style='margin-top: 10px; color: #000000;'>Registra la CLABE brindada.</li>
            <li style='margin-top: 10px; color: #000000;'>Realiza la transferencia con el monto. <strong>EXACTO</strong> o la transferencia será rechazada</li>
            <li style='margin-top: 10px; color: #000000;'>Para confirmar el pago tu banco te brindará un recibo electrónico, REVISA QUE SE REALIZÓ CORRECTAMENTE.</li>
          </ol>
          <div style='margin-top: 22px; padding: 22px 20 24px; color: #108f30; text-align: center; border: 1px solid #108f30; border-radius: 4px; background: #ffffff;'>Al completar estos pasos recibirás un correo de <strong>Emprendum</strong> confirmando tu pago.</div>
        </div>
      </div>";


        $asunto .= utf8_decode($benefactor);
        $asuntoV = 'Emprendum - Compra';
        $asuntoV .= $alumno;
        enviarMail($correoBene, $asuntoV,utf8_decode($content_donante));
        enviarMail($respaldo, $asuntoV,utf8_decode($content_donante));
        $success=enviarMail('contactoemprendum@um.edu.mx', $asunto,$content_donante);

        // $success=enviarMailMaestro($correo, utf8_decode($nombre) . ' - Centro De Escritura',utf8_decode($content_maestro));
/*
        if ($success) {
            # Establece un código de respuesta 200 (correcto).
            http_response_code(200);
            echo "!Felicidades! Tu cita ha sido agendada, en breve recibirás un correo con todos los detalles";
        } else {
            # Establezce un código de respuesta 500 (error interno del servidor).
            http_response_code(500);
            echo "Lo sentimos, estamos experimentando dificultades, si el problema persiste por favor comunícate al correo surielgarcia@um.edu.mx.";
        }
*/

  }else {
    http_response_code(403);
    echo "Hubo un problema con tu registro, intenta de nuevo.";
  }
function enviarMail($correoBene,$asunto,$contenido){
  $mail = new PHPMailer\PHPMailer\PHPMailer();
  try {
      //Server settings
      $mail->SMTPDebug = 0;                                 // Enable verbose debug output
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = 'contactoemprendum@um.edu.mx';                 // SMTP username
      $mail->Password = 'karla179';                           // SMTP password
      $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 587;                                    // TCP port to connect to

      // verificaciones humanas
      // echo $email."<br />";
      // echo $nombre."<br />";
      // echo $asunto."<br />";
      // echo $correo."<br />";

      //Recipients
      $mail->setFrom('contactoemprendum@um.edu.mx', utf8_decode('Emprendum'));
      $mail->addAddress($correoBene);     // Add a recipient
      // $mail->addAddress('surielgarcia@um.edu.mx', 'Joe User');     // Add a recipient

      // //Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = $asunto;
      $mail->Body    = $contenido;
      $mail->AltBody = 'Lo sentimos, tu navegador no soporta el contenido de nuestro correo';

      $exito=$mail->send();

      if ($exito) {
        // echo 'Message has been sent <br />';
        return true;
      }else {
        return false;
      }

  } catch (Exception $e) {
      echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
      return false;
  }
}
?>
