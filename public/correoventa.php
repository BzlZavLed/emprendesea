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

    $alumno = $_REQUEST['alumno'];
    $benefactor = $_REQUEST['benefactor'];
    $direccion = $_REQUEST['direccion'];
    $codigoP = $_REQUEST['codigoP'];
    $benTel = $_REQUEST['benTel'];
    $city = $_REQUEST['city'];
    $est = $_REQUEST['est'];
    $piezas = $_REQUEST['piezas'];//
    $peso = $_REQUEST['peso'];//
    $paqueteria = $_REQUEST['paqueteria'];
    $precioLibro = $_REQUEST['precioLibro'];
    $precioEnvio = $_REQUEST['precioEnvio'];
    $precioTotal = $_REQUEST['precioTotal'];
    $foto = $_REQUEST['foto'];
    $link = $_REQUEST['link'];
    $nombreLibro = $_REQUEST['nombreLibro'];//
    $numPedido = $_REQUEST['numPedido'];
    $numGuia = $_REQUEST['numGuia'];//
    $correoBene = $_REQUEST['correoBene'];
    $correoAlum = $_REQUEST['correoAlum'];
    $respaldo = 'respaldoemprendum@um.edu.mx';

    $gema=$precioLibro/2;
    $venta=($precioLibro/2)+$precioEnvio;
    $diezmo=$gema*.10;
    $com1=(($precioTotal*.029)+2.5)*1.16;
    $com2=$gema*.05;
    $neta=$gema-$com1-$com2;
    $bon1=$gema*.21;
    $bon2=$neta*.14;
    $bon3=$neta*.15;

    $util=$neta+$bon1+$bon2+$bon3;
    //lafuente@um.edu.mx edny_k3_k3@hotmail.com
    //$servicios = $_POST['service'];


        $content_donante="<div style='background-color: #DEDEDE;'>
        <div style ='background-image: url(https://emprendum.um.edu.mx/images/correoA.png); background-position: center center; background-repeat: no-repeat; background-attachment: scroll; background-size: cover; background-color: #DEDEDE; 	width: 75%; margin: auto; height: auto; padding-bottom: 100px;'>
            <div style='background-color: #fff; width: 70%; margin: auto; padding: 20px; padding-bottom: 1%;'>
                <div style='width: 50%'>
                    <img src='http://centauro.um.edu.mx/emprendum/logo.png' style='width: 100%; margin-bottom: 0;'>
                </div>
                <div style='background-color: #fff; width: 80%; margin: auto;'>
                <div style='font-family: Verdana, Geneva, sans-serif; font-size: 3vw; margin: 1em 0; font-weight: bolder;'><span style='color: #FFC100; '>HOLA,</span> <span style='color: #2C6DED; '>$benefactor</span></div>
                <div style='font-family: Verdana, Geneva, sans-serif; color: #696969; font-size: 3vw'>
                    <p style='font-size: 1.2vw;'>&quot;Cuando en nuestra vida tenemos la oportunidad de ayudar y servir a toda persona sin esperar nada a cambio, la mejor recompensa vendrá sobre nosotros&quot; <i>(Libro: Su Palabra de Honor).</i></p>
                    <p style='margin: 2.2em 0; font-size: 1.2vw;'>
                        Gracias por adquirir y contribuir al sueño de tu servidor
                        <span style='color: #696969; font-weight: bold;'>$alumno.</span> Tu número de pedido es el <span style='color: #696969; font-weight: bold;'>$numPedido</span> para seguimiento de tu compra, recibirás otro correo con el número de guía para que puedas monitorearlo en la compañía de paquetería de tu elección.
                    </p>
                    <p style='color: #696969; font-weight: bold; font-size: 1.2vw; margin-bottom: 2em;'>
                        Estamos seguros que en las hojas de este manual encontraras información que elevará tu calidad de vida y la de los tuyos.
                    </p>
                </div>
                </div>
            </div>
        </div>
        <div style='background-image: url($foto);  background-position: center center; background-repeat: no-repeat; background-attachment: scroll; background-size: cover; background-color: #464646; height: 220px; 	width: 160px; margin: 5% auto 0 auto;'>
            <img src='http://centauro.um.edu.mx/emprendum/marco.png' style='width: 100%'>
        </div>
        <p style='font-family: Verdana, Geneva, sans-serif; color: #696969; font-size: 1vw; text-align: center; padding-bottom: 1em; margin-bottom: 0;'>Recuerda que puedes continuar siendo benefactor de
            <br>
            <span style='color: #696969; font-weight: bold; '>$alumno</span> al compartir su enlace: $link </p>
    </div>
    <div style=' margin: auto; height: auto; background-color: #DEDEDE; text-align: center;'>
    	<img src='http://centauro.um.edu.mx/emprendum/central_correo_a.jpg' style='width: 100%;'>	
    </div>
    <div style='width: 100% ;height: auto ;background-color  : #2c6ded;' >
    	<table style='border:0' >
    		<tr>
    			<td style='vertical-align: bottom;font-family: Verdana, Geneva, sans-serif; font-size: 1vw; width: 50%; color: #fff; text-align: left;width: 25%'>Emprendum<br>
    				Av. Libertad 1300 Pte.<br>
    				Montemorelos<br>
    				NL 64500<br>
    			México</td>
    			<td style='font-family: Verdana, Geneva, sans-serif; font-size: 1.5vw; width: 50%; color: #fff; text-align: center;'><h4>&quot;Tus acciones tienen un eco en la eternidad&quot;</h4></td>
    			<td style='vertical-align: bottom; text-align: center;'>

    				<img src='https://emprendum.um.edu.mx/images/facebook_logo.png' style='width: 10%' onclick='window.location.href='facebook.com/emprendumc/'>
    				<img src='https://emprendum.um.edu.mx/images/instagram_logo.png' style='width: 10%;' onclick='window.location.href='instagram.com/emprendum/'>	
    				<img src='https://emprendum.um.edu.mx/images/youtube_logo.png' style='width: 10%' onclick='window.location.href='youtube.com/channel/UCc6L8Ojxb3skVSs7ZYCSnjA'>	
    			</td>
    		</tr>
    </div>";

        $content_emprendum="<p>$paqueteria</p><p>Benefactor correo: $correoBene</p><p> Alumno correo: $correoAlum</p><p> Alumno: $alumno </p><p>Numero de pedido: $numPedido</p><table style='width: 100%;' border='1'>
        <tbody>
        <tr>
        <td>
        <p>Desde:</p>
        <p>Oficinas Emprendum - Libros</p>
        <p>Libertad 1300 pte.</p>
        <p>Apdo 16 Tel. 2831059783</p>
        <p>CP 67530, MONTERREY, NUEVO LEON</p>
        <p>MX</p>
        </td>
        <td>
        <p>A:&nbsp;</p>
        <p>$benefactor</p>
        <p>$direccion</p>
        <p>$benTel</p>
        <p>CP. $codigoP, $city $est</p>
        <p>MX</p>
        </td>
        </tr>
        </tbody>
        </table>
        <table style='width: 100%;' border='1'>
        <tbody>
        <tr>
        <td style='text-align: center;'>MTY - </td>
        </tr>
        <tr>
        <td>
        <table style='width: 100%;'>
        <tbody>
        <tr>
        <td style='text-align: center;'>Guia</td>
        <td style='text-align: center;'>Fecha</td>
        <td style='text-align: center;'>Kilos</td>
        <td style='text-align: center;'>Piezas</td>
        </tr>
        <tr>
        <td style='text-align: center;'>&nbsp;</td>
        <td style='text-align: center;'>00/00/0000</td>
        <td style='text-align: center;'>&nbsp;</td>
        <td style='text-align: center;'>&nbsp;</td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>";
      $content_alumno="<div style=' background-image: url(http://centauro.um.edu.mx/emprendum/3604471.png);  background-position: center center; background-repeat: no-repeat; background-attachment: scroll; background-size: cover; background-color: #464646; height: 1700px; 	width: 100%;'>

      <div style='background-color: #fff; 	position: absolute; 		width: 80%; margin-top: 0px; margin-left: 5%; padding: 20px; height: 93%;'>
        <div style='width: 40%'>
          <img src='http://centauro.um.edu.mx/emprendum/logo.png' style='width: 100%'>
        </div>
        <br>
        <br>
        <div style='font-size:28px;  font-family: Verdana, Geneva, sans-serif;'><span style='color: #FFC100; '>HOLA,</span> <span style='color: #2C6DED; '>$alumno</span></div>
        <br>
        <p style='font-family: Verdana, Geneva, sans-serif; color: #696969; font-size: 16px'>
      Tus acciones tienen un eco en la eternidad y
    están siendo recompensadas, <span style='color: #696969; font-weight: bold;'>$benefactor</span> hizo una compra a tu nombre en
    nuestra tienda virtual, te enviamos el
    desglose <span style='color: #696969; font-weight: bold;'>ESTIMADO</span> del pedido <span style='color: #696969; font-weight: bold;'>#$numPedido</span> y cómo quedará tu depósito a la
    Universidad: 
    
    </p>
    
        <table border='0' style='font-size:18px;  font-family: Verdana, Geneva, sans-serif;'>
          <tr>
            <td style='text-align: right;'>$ $precioLibro</td>
            <td>Libro precio de lista GEMA (Contado)</td>
          </tr>
          <tr>
            <td style='text-align: right;'>$ $precioEnvio</td>
            <td>Paquetería</td>
          </tr>
          <tr>
            <td style='text-align: right;'>$ $precioTotal</td>
            <td>Precio de venta (Público General)
            </td>
          </tr>
          <tr>
            <td>
              <td colspan='2'>&nbsp;</td>
            </td>
          </tr>
          <tr>
            <td style='text-align: right;'>$ $gema</td>
            <td>GEMA</td>
          </tr>
          <tr>
            <td style='text-align: right;'>$ $precioEnvio</td>
            <td>Paquetería</td>
          </tr>
          <tr>
            <td style='text-align: right;'>$ $venta</td>
            <td>Costo de venta
            </td>
          </tr>
          <tr>
            <td>
              <td colspan='1'>&nbsp;</td>
            </td>
          </tr>
          <tr>
            <td style='text-align: right;'>$ $gema</td>
            <td>Utilidad bruta
            </td>
          </tr>
          <tr>
            <td>
              <td colspan='1'>&nbsp;</td>
            </td>
          </tr>
          <tr>
            <td style='text-align: right;'>**$ $diezmo</td>
            <td>El diezmo debes entregarlo en el campo donde estas inscrito</td>
          </tr>
          <tr>
            <td style='text-align: right;'>-$ $com1</td>
            <td>Comision 1 al libro</td>
          </tr>
          <tr>
            <td style='text-align: right;'>-$ $com2</td>
            <td>Comision 2 a Utilidad bruta
            </td>
          </tr>
          <tr>
            <td style='text-align: right;'>$ $neta</td>
            <td>Utilidad neta 1
            </td>
          </tr>
          <tr>
            <td>
              <td colspan='2' style='color: #2C6DED;'>Bonificación</td>
            </td>
          </tr>
          <tr>
            <td style='text-align: right;'>$ $bon1</td>
            <td>Gema 21% a Utilidad bruta</td>
          </tr>
          <tr>
            <td style='text-align: right;'>$ $bon2</td>
            <td>UM 14% a Utilidad bruta 1
            </td>
          </tr>
          <tr>
            <td style='text-align: right;'>$ $bon3</td>
            <td>UM 15% a Utilidad bruta 1
            </td>
          </tr>
          <tr>
            <td>
              <td colspan='1'>&nbsp;</td>
            </td>
          </tr>
          <tr>
            <td style='text-align: right;'>$ $util</td>
            <td>Utilidad neta + Bonificacion
            </td>
          </tr>
        </table>
    
        <p style='font-family: Verdana, Geneva, sans-serif; color: #696969; font-size: 16px'>Te invitamos a que sigas siendo constante,
    que Dios tiene preparadas muchas
    bendiciones para ti. </p>
    
    <p style='font-weight: bolder; font-family: Verdana, Geneva, sans-serif; color: #696969; font-size: 16px'>
      No tengas miedo, que yo estoy contigo; no
    te desanimes, que yo soy tu Dios. Yo soy
    quien te da fuerzas, y siempre te ayudaré; te
    sostendré con la diestra de mi justicia
    (Isaías 41:10). 
    </p>
    <br>
    
    
      </div>
    </div>
    
    <div style='background-color: #DEDEDE; height: 400px; 	width: 100%;'>
    <br>
    <br>
      <div style='background-image: url($foto);  background-position: center center; background-repeat: no-repeat; background-attachment: scroll; background-size: cover; background-color: #464646; height: 220px; 	width: 160px; margin-left: 40%;'>
        <img src='http://centauro.um.edu.mx/emprendum/marco.png' style='width: 100%'>
      </div>
      <br>
      <p style='font-family: Verdana, Geneva, sans-serif; color: #696969; font-size: 16px; text-align: center'>¡En hora buena! Sigue compartiendo tu enlace con familiares, amigos y conocidos para ser de
    bendición a través de la verdad presente y como consecuencia los recursos financieros para tu
    proyecto educativo llegarán. Su enlace: $link</p>
    </div>
    <img src='http://centauro.um.edu.mx/emprendum/instrumento2.png' style='width: 100%'>
    <div style='width: 100% ;height: auto ;background-color  : #2c6ded;' >
    	<table style='border:0' >
    		<tr>
    			<td style='vertical-align: bottom;font-family: Verdana, Geneva, sans-serif; font-size: 1vw; width: 50%; color: #fff; text-align: left;width: 25%'>Emprendum<br>
    				Av. Libertad 1300 Pte.<br>
    				Montemorelos<br>
    				NL 64500<br>
    			México</td>
    			<td style='font-family: Verdana, Geneva, sans-serif; font-size: 1.5vw; width: 50%; color: #fff; text-align: center;'><h4>&quot;Tus acciones tienen un eco en la eternidad&quot;</h4></td>
    			<td style='vertical-align: bottom; text-align: center;'>

    				<img src='https://emprendum.um.edu.mx/images/facebook_logo.png' style='width: 10%' onclick='window.location.href='facebook.com/emprendumc/'>
    				<img src='https://emprendum.um.edu.mx/images/instagram_logo.png' style='width: 10%;' onclick='window.location.href='instagram.com/emprendum/'>	
    				<img src='https://emprendum.um.edu.mx/images/youtube_logo.png' style='width: 10%' onclick='window.location.href='youtube.com/channel/UCc6L8Ojxb3skVSs7ZYCSnjA'>	
    			</td>
    		</tr>
    </div>";
    $content_envio="<div style='background-color: #DEDEDE;'>
    <div style ='background-image: url(http://centauro.um.edu.mx/emprendum/3476930.png); background-position: center center; background-repeat: no-repeat; background-attachment: scroll; background-size: cover; background-color: #DEDEDE; 	width: 75%; margin: auto; height: auto; padding-bottom: 100px;'>
        <div style='background-color: #fff; width: 70%; margin: auto; padding: 20px; padding-bottom: 1%;'>
            <div style='width: 50%'>
                <img src='http://centauro.um.edu.mx/emprendum/logo.png' style='width: 100%; margin-bottom: 0;'>
            </div>
            <div style='background-color: #fff; width: 80%; margin: auto;'>
            <div style='font-family: Verdana, Geneva, sans-serif; color: #696969; font-size: 3vw'>
                <p style='margin: 2.2em 0; font-size: 1.2vw;'>&quot;Si supiera que el mundo se acaba mañana, yo,
        hoy todavía, plantaría un árbol&quot; <i> Martin Luther
          King.</i>
        </p>
                <p style='margin: 2.2em 0; font-size: 1.2vw;'>
                    <span style='color: #2C6DED; '>$benefactor </span>tu pedido está en camino, el
número de guía es el <span style='color: #FFC100; font-weight: bold;'>$ Numero Guia</span> por $paqueteria
                    
      </p>
      <p style='margin: 2.2em 0; font-size: 1.2vw;'>
        <span style='color: #696969; font-weight: bold;'>$alumno</span> está agradecido por ser su
benefactor, con esta acción tuya seguirá
cumpliendo sus sueños académicos gracias a ti.
      </p>
                <p style='margin: 2.2em 0; font-size: 1.2vw;'>
        Deseamos que cuando tengas el material en tus
      manos puedas adentrarte en él y disfrutar de
      cada uno de sus grandes beneficios. 
      </p>
      
      <p style='margin: 2.2em 0; font-size: 1.2vw;'>
        ¿Quieres ser parte de nuestras redes sociales?
      Etiquétanos una foto con el libro que adquiriste
      con los hashtags: 
      </p>
      
      <p style='margin: 2.2em 0; font-size: 1.2vw;'> 
        <span style='color: #FFC100; '>#SoyEmprendum #soyUM #Verano2020
      #soybenefactoremprendum</span>
      </p>
            </div>
            </div>
        </div>
    </div>
    <div style='background-image: url($foto);  background-position: center center; background-repeat: no-repeat; background-attachment: scroll; background-size: cover; background-color: #464646; height: 220px; 	width: 160px; margin: 5% auto 0 auto;'>
        <img src='http://centauro.um.edu.mx/emprendum/marco.png' style='width: 100%'>
    </div>
    <p style='font-family: Verdana, Geneva, sans-serif; color: #696969; font-size: 1vw; text-align: center; padding-bottom: 1em; margin-bottom: 0;'>Recuerda que puedes continuar siendo benefactor de
        <br>
        <span style='color: #696969; font-weight: bold; '>$alumno</span> al compartir su enlace: $link </p>
</div>
<div style=' margin: auto; height: auto; background-color: #DEDEDE; text-align: center;'>
  <img src='http://centauro.um.edu.mx/emprendum/central_correo_b.jpg' style='width: 100%;'>	
</div>
<div style='width: 100% ;height: auto ;background-color  : #2c6ded;' >
  <table style='border:0' >
    <tr>
      <td style='vertical-align: bottom;font-family: Verdana, Geneva, sans-serif; font-size: 1vw; width: 50%; color: #fff; text-align: left;width: 25%'>Emprendum<br>
        Av. Libertad 1300 Pte.<br>
        Montemorelos<br>
        NL 64500<br>
      México</td>
      <td style='font-family: Verdana, Geneva, sans-serif; font-size: 1.5vw; width: 50%; color: #fff; text-align: center;'><h4>&quot;Tus acciones tienen un eco en la eternidad&quot;</h4></td>
      <td style='vertical-align: bottom; text-align: center;'>

        <img src='https://emprendum.um.edu.mx/images/facebook_logo.png' style='width: 10%' onclick='window.location.href='facebook.com/emprendumc/'>
        <img src='https://emprendum.um.edu.mx/images/instagram_logo.png' style='width: 10%;' onclick='window.location.href='instagram.com/emprendum/'>	
        <img src='https://emprendum.um.edu.mx/images/youtube_logo.png' style='width: 10%' onclick='window.location.href='youtube.com/channel/UCc6L8Ojxb3skVSs7ZYCSnjA'>	
      </td>
    </tr>
</div>

</body>
    ";
      $asunto = 'Emprendum - ';
      $asunto .=  utf8_decode($benefactor);
        $asuntoV = 'Emprendum - Compra';
        $asuntoV .= $alumno;
        //enviarMail($correoBene, $asuntoV,utf8_decode($content_donante));
        //enviarMail($correoAlum, $asuntoV,utf8_decode($content_alumno));
        enviarMail($respaldo, $asuntoV,utf8_decode($content_donante));
        enviarMail($respaldo, $asuntoV,utf8_decode($content_alumno));
        enviarMail($respaldo, $asunto,utf8_decode($content_envio));
        enviarMail($respaldo, $asunto,utf8_decode($content_emprendum));
        enviarMail('contactoemprendum@um.edu.mx', $asunto,utf8_decode($content_envio));
        $success=enviarMail('contactoemprendum@um.edu.mx', $asunto,utf8_decode($content_emprendum));
       //  enviarMail($correoBene, $asunto,utf8_decode($content_maestro));

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
function enviarMail($correoBene,$asunto,$contenido){
  $mail = new PHPMailer\PHPMailer\PHPMailer();
  try {
      //Server settings
      $mail->SMTPDebug = 0;                                 // Enable verbose debug output
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = 'contactoemprendum@um.edu.mx';                 // SMTP username
      $mail->Password = 'karla179';                        // SMTP password
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
