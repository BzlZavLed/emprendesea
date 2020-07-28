<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include("PHPMailer-master/src/Exception.php");
include("PHPMailer-master/src/PHPMailer.php");
include("PHPMailer-master/src/SMTP.php");

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {




    $empresa = $_POST['nameInc'];
    $telefono = $_POST['phoneInc'];
    $ubicacion = $_POST['locInc'];
    $nombre = $_POST['name'];
    $celular = $_POST['phone'];
    $correo = $_POST['email'];
    $comentario = $_POST['comment'];
    $servicios = $_POST['service'];
    $cad = "";

    if (!empty($_POST['service'])) {
      for ($i=0; $i < count($servicios); $i++) {
        if ($i == 0) {
          $cad .= $_POST['service'][$i];

        }else {
          $cad .= ", " . $_POST['service'][$i];
        }
      }
    }


        $content_donante="<table class='wrapper' style='border-collapse: collapse;table-layout: fixed;min-width: 320px;width: 100%;background-color: #fff;' cellpadding='0' cellspacing='0' role='presentation'>
          <tbody>
            <tr>
              <td>
                <div role='banner'>
                  <div class='preheader' style='Margin: 0 auto;max-width: 560px;min-width: 280px; width: 280px;width: calc(28000% - 167440px);'>
                    <div style='border-collapse: collapse;display: table;width: 100%;'>
                      <!--[if (mso)|(IE)]><table align='center' class='preheader' cellpadding='0' cellspacing='0' role='presentation'><tr><td style='width: 280px' valign='top'><![endif]-->
                      <div class='snippet'
                        style='display: table-cell;Float: left;font-size: 12px;line-height: 19px;max-width: 280px;min-width: 140px; width: 140px;width: calc(14000% - 78120px);padding: 10px 0 5px 0;color: #767877;font-family: PT Sans,Trebuchet MS,sans-serif;'>
                      </div>
                      <!--[if (mso)|(IE)]></td><td style='width: 280px' valign='top'><![endif]-->
                      <div class='webversion'
                        style='display: table-cell;Float: left;font-size: 12px;line-height: 19px;max-width: 280px;min-width: 139px; width: 139px;width: calc(14100% - 78680px);padding: 10px 0 5px 0;text-align: right;color: #767877;font-family: PT Sans,Trebuchet MS,sans-serif;'>
                      </div>
                      <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                    </div>
                  </div>
                  <div class='header' style='Margin: 0 auto;max-width: 600px;min-width: 320px; width: 320px;width: calc(28000% - 167400px);' id='emb-email-header-container'>
                    <!--[if (mso)|(IE)]><table align='center' class='header' cellpadding='0' cellspacing='0' role='presentation'><tr><td style='width: 600px'><![endif]-->
                    <div class='logo emb-logo-margin-box' style='font-size: 26px;line-height: 32px;Margin-top: 6px;Margin-bottom: 20px;color: #41637e;font-family: Avenir,sans-serif;Margin-left: 20px;Margin-right: 20px;' align='center'>
                      <div class='logo-center' align='center' id='emb-email-header'><img style='display: block;height: auto;width: 100%;border: 0;max-width: 80px;' src='http://eventos.um.edu.mx/wp-content/uploads/2017/04/emblema-color.png' alt=''
                          width='80'></div>
                    </div>
                    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                  </div>
                </div>
                <div role='section'>
                  <div class='layout one-col fixed-width' style='Margin: 0 auto;max-width: 600px;min-width: 320px; width: 320px;width: calc(28000% - 167400px);overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;'>
                    <div class='layout__inner' style='border-collapse: collapse;display: table;width: 100%;background-color: #ffffff;' emb-background-style=''>
                      <!--[if (mso)|(IE)]><table align='center' cellpadding='0' cellspacing='0' role='presentation'><tr class='layout-fixed-width' emb-background-style><td style='width: 600px' class='w560'><![endif]-->
                      <div class='column' style='text-align: left;color: #767877;font-size: 14px;line-height: 21px;font-family: Merriweather,Georgia,serif;max-width: 600px;min-width: 320px; width: 320px;width: calc(28000% - 167400px);'>
                        <div style='Margin-left: 20px;Margin-right: 20px;Margin-top: 12px;'>
                          <div style='mso-line-height-rule: exactly;line-height: 10px;font-size: 1px;'>&nbsp;</div>
                        </div>
                        <div style='Margin-left: 20px;Margin-right: 20px;'>
                          <div style='mso-line-height-rule: exactly;line-height: 5px;font-size: 1px;'>&nbsp;</div>
                        </div>
                        <div style='Margin-left: 20px;Margin-right: 20px;'>
                          <div style='mso-line-height-rule: exactly;mso-text-raise: 4px;'>
                            <h1 class='size-20' style='Margin-top: 0;Margin-bottom: 0;font-style: normal;font-weight: normal;color: #767877;font-size: 17px;line-height: 26px;font-family: Open Sans,sans-serif;text-align: center;' lang='x-size-20'>¡Acabas de
                              dar un paso para mejorar tu escritura! Hemos agendado tu cita al Centro de Escritura con los siguientes datos:</h1>
                            <p style='Margin-top: 20px;Margin-bottom: 0;'><strong>1)&nbsp; Empresa:</strong> $empresa</p>
                            <p style='Margin-top: 10px;Margin-bottom: 0;'><strong>2)&nbsp; Teléfono Oficina:</strong> $telefono</p>
                            <p style='Margin-top: 10px;Margin-bottom: 0;'><strong>3)&nbsp; Ciudad y Estado:</strong> $ubicacion</p>
                            <p style='Margin-top: 10px;Margin-bottom: 0;'><strong>4)&nbsp; Nombre Personal:</strong> $nombre</p>
                            <p style='Margin-top: 10px;Margin-bottom: 0;'><strong>5)&nbsp; Teléfono/Whatsapp:</strong> $celular</p>
                            <p style='Margin-top: 10px;Margin-bottom: 0;'><strong>6)&nbsp; Correo Electrónico</strong> $correo</p>
                            <p style='Margin-top: 10px;Margin-bottom: 0;'><strong>7)&nbsp; Servicios:</strong> $cad</p>
                            <p style='Margin-top: 10px;Margin-bottom: 0;'><strong>8)&nbsp; Comentarios:</strong> $comentario</p>
                            <h1 class='size-20' style='Margin-top: 20px;Margin-bottom: 0;font-style: normal;font-weight: normal;color: #767877;font-size: 17px;line-height: 26px;font-family: Open Sans,sans-serif;text-align: left;' lang='x-size-20'>¡Gracias
                              por tu interés, estamos felices de poder ayudarte!</h1>
                            <h1 class='size-20' style='Margin-top: 0;Margin-bottom: 0;font-style: normal;font-weight: normal;color: #767877;font-size: 17px;line-height: 26px;font-family: Open Sans,sans-serif;text-align: left;' lang='x-size-20'>Bendiciones.
                            </h1>
                          </div>
                        </div>
                      </div>
                      <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                    </div>
                  </div>
                  <div style='mso-line-height-rule: exactly;' role='contentinfo'>
                    <div class='layout email-footer' style='Margin: 0 auto;max-width: 600px;min-width: 320px; width: 320px;width: calc(28000% - 167400px);overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;'>
                      <div class='layout__inner' style='border-collapse: collapse;display: table;width: 100%;'>
                        <!--[if (mso)|(IE)]></td><td style='width: 200px;' valign='top' class='w160'><![endif]-->
                        <div class='column narrow'
                          style='text-align: left;font-size: 12px;line-height: 19px;color: #767877;font-family: PT Sans,Trebuchet MS,sans-serif;Float: left;max-width: 320px;min-width: 200px; width: 320px;width: calc(72200px - 12000%);'>
                          <div style='Margin-left: 20px;Margin-right: 20px;Margin-top: 10px;Margin-bottom: 10px;'>

                          </div>
                        </div>
                        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                      </div>
                    </div>
                  </div>
                  <div style='mso-line-height-rule: exactly;line-height: 40px;font-size: 40px;'>&nbsp;</div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>";

        $content_maestro="<table class='wrapper' style='border-collapse: collapse;table-layout: fixed;min-width: 320px;width: 100%;background-color: #fff;' cellpadding='0' cellspacing='0' role='presentation'>
          <tbody>
            <tr>
              <td>
                <div role='banner'>
                  <div class='preheader' style='Margin: 0 auto;max-width: 560px;min-width: 280px; width: 280px;width: calc(28000% - 167440px);'>
                    <div style='border-collapse: collapse;display: table;width: 100%;'>
                      <!--[if (mso)|(IE)]><table align='center' class='preheader' cellpadding='0' cellspacing='0' role='presentation'><tr><td style='width: 280px' valign='top'><![endif]-->
                      <div class='snippet'
                        style='display: table-cell;Float: left;font-size: 12px;line-height: 19px;max-width: 280px;min-width: 140px; width: 140px;width: calc(14000% - 78120px);padding: 10px 0 5px 0;color: #767877;font-family: PT Sans,Trebuchet MS,sans-serif;'>
                      </div>
                      <!--[if (mso)|(IE)]></td><td style='width: 280px' valign='top'><![endif]-->
                      <div class='webversion'
                        style='display: table-cell;Float: left;font-size: 12px;line-height: 19px;max-width: 280px;min-width: 139px; width: 139px;width: calc(14100% - 78680px);padding: 10px 0 5px 0;text-align: right;color: #767877;font-family: PT Sans,Trebuchet MS,sans-serif;'>
                      </div>
                      <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                    </div>
                  </div>
                  <div class='header' style='Margin: 0 auto;max-width: 600px;min-width: 320px; width: 320px;width: calc(28000% - 167400px);' id='emb-email-header-container'>
                    <!--[if (mso)|(IE)]><table align='center' class='header' cellpadding='0' cellspacing='0' role='presentation'><tr><td style='width: 600px'><![endif]-->
                    <div class='logo emb-logo-margin-box' style='font-size: 26px;line-height: 32px;Margin-top: 6px;Margin-bottom: 20px;color: #41637e;font-family: Avenir,sans-serif;Margin-left: 20px;Margin-right: 20px;' align='center'>
                      <div class='logo-center' align='center' id='emb-email-header'><img style='display: block;height: auto;width: 100%;border: 0;max-width: 80px;' src='http://eventos.um.edu.mx/wp-content/uploads/2017/04/emblema-color.png' alt=''
                          width='80'></div>
                    </div>
                    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                  </div>
                </div>
                <div role='section'>
                  <div class='layout one-col fixed-width' style='Margin: 0 auto;max-width: 600px;min-width: 320px; width: 320px;width: calc(28000% - 167400px);overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;'>
                    <div class='layout__inner' style='border-collapse: collapse;display: table;width: 100%;background-color: #ffffff;' emb-background-style=''>
                      <!--[if (mso)|(IE)]><table align='center' cellpadding='0' cellspacing='0' role='presentation'><tr class='layout-fixed-width' emb-background-style><td style='width: 600px' class='w560'><![endif]-->
                      <div class='column' style='text-align: left;color: #767877;font-size: 14px;line-height: 21px;font-family: Merriweather,Georgia,serif;max-width: 600px;min-width: 320px; width: 320px;width: calc(28000% - 167400px);'>
                        <div style='Margin-left: 20px;Margin-right: 20px;Margin-top: 12px;'>
                          <div style='mso-line-height-rule: exactly;line-height: 10px;font-size: 1px;'>&nbsp;</div>
                        </div>
                        <div style='Margin-left: 20px;Margin-right: 20px;'>
                          <div style='mso-line-height-rule: exactly;line-height: 5px;font-size: 1px;'>&nbsp;</div>
                        </div>
                        <div style='Margin-left: 20px;Margin-right: 20px;'>
                          <div style='mso-line-height-rule: exactly;mso-text-raise: 4px;'>
                            <h1 class='size-20' style='Margin-top: 0;Margin-bottom: 0;font-style: normal;font-weight: normal;color: #767877;font-size: 17px;line-height: 26px;font-family: Open Sans,sans-serif;text-align: center;' lang='x-size-20'>¡Buen día!
                              Uno de nuestros alumnos ha agendado una cita con usted para obtener asesoría de escritura. Los datos de la cita son los siguientes:</h1>
                              <p style='Margin-top: 20px;Margin-bottom: 0;'><strong>1)&nbsp; Empresa:</strong> $empresa</p>
                              <p style='Margin-top: 10px;Margin-bottom: 0;'><strong>2)&nbsp; Teléfono Oficina:</strong> $telefono</p>
                              <p style='Margin-top: 10px;Margin-bottom: 0;'><strong>3)&nbsp; Ciudad y Estado:</strong> $ubicacion</p>
                              <p style='Margin-top: 10px;Margin-bottom: 0;'><strong>4)&nbsp; Nombre Personal:</strong> $nombre</p>
                              <p style='Margin-top: 10px;Margin-bottom: 0;'><strong>5)&nbsp; Teléfono/Whatsapp:</strong> $celular</p>
                              <p style='Margin-top: 10px;Margin-bottom: 0;'><strong>6)&nbsp; Correo Electrónico</strong> $correo</p>
                              <p style='Margin-top: 10px;Margin-bottom: 0;'><strong>7)&nbsp; Servicios:</strong> $cad</p>
                              <p style='Margin-top: 10px;Margin-bottom: 0;'><strong>8)&nbsp; Comentarios:</strong> $comentario</p>
                            <h1 class='size-20' style='Margin-top: 20px;Margin-bottom: 0;font-style: normal;font-weight: normal;color: #767877;font-size: 17px;line-height: 26px;font-family: Open Sans,sans-serif;text-align: left;' lang='x-size-20'>¡Muchas
                              gracias por tu interés! Juntos hacemos la diferencia.</h1>
                            <h1 class='size-20' style='Margin-top: 0;Margin-bottom: 0;font-style: normal;font-weight: normal;color: #767877;font-size: 17px;line-height: 26px;font-family: Open Sans,sans-serif;text-align: left;' lang='x-size-20'>Bendiciones.
                            </h1>
                          </div>
                        </div>
                      </div>
                      <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                    </div>
                  </div>
                  <div style='mso-line-height-rule: exactly;' role='contentinfo'>
                    <div class='layout email-footer' style='Margin: 0 auto;max-width: 600px;min-width: 320px; width: 320px;width: calc(28000% - 167400px);overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;'>
                      <div class='layout__inner' style='border-collapse: collapse;display: table;width: 100%;'>
                        <!--[if (mso)|(IE)]></td><td style='width: 200px;' valign='top' class='w160'><![endif]-->
                        <div class='column narrow'
                          style='text-align: left;font-size: 12px;line-height: 19px;color: #767877;font-family: PT Sans,Trebuchet MS,sans-serif;Float: left;max-width: 320px;min-width: 200px; width: 320px;width: calc(72200px - 12000%);'>
                          <div style='Margin-left: 20px;Margin-right: 20px;Margin-top: 10px;Margin-bottom: 10px;'>

                          </div>
                        </div>
                        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                      </div>
                    </div>
                  </div>
                  <div style='mso-line-height-rule: exactly;line-height: 40px;font-size: 40px;'>&nbsp;</div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>";


        $asunto = utf8_decode($nombre) . ' - Emprendum';
        enviarMail($correo, $asunto,utf8_decode($content_donante));
        $success=enviarMail('contactoemprendum@um.edu.mx', $asunto,$content_maestro);

        // $success=enviarMailMaestro($correo, utf8_decode($nombre) . ' - Centro De Escritura',utf8_decode($content_maestro));

        if ($success) {
            # Establece un código de respuesta 200 (correcto).
            http_response_code(200);
            echo "!Felicidades! Tu cita ha sido agendada, en breve recibirás un correo con todos los detalles";
        } else {
            # Establezce un código de respuesta 500 (error interno del servidor).
            http_response_code(500);
            echo "Lo sentimos, estamos experimentando dificultades, si el problema persiste por favor comunícate al correo surielgarcia@um.edu.mx.";
        }




  }else {
    http_response_code(403);
    echo "Hubo un problema con tu registro, intenta de nuevo.";
  }
function enviarMail($correo,$asunto,$contenido){
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
      $mail->addAddress($correo);     // Add a recipient
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
