<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include("PHPMailer-master/src/Exception.php");
include("PHPMailer-master/src/PHPMailer.php");
include("PHPMailer-master/src/SMTP.php");

$body = @file_get_contents('php://input');
$data = json_decode($body);
if ($data->data->object->charges->data[0]->payment_method->type == 'oxxo' && $data->type == 'order.paid'){
    echo $data->data->object->charges->data[0]->payment_method->type . " -- " .$data->data->object->metadata->total . " -- " . $data->data->object->metadata->totalList . " -- " . $data->data->object->metadata->envio . " -- " . $data->data->object->customer_info->name . " -- " . $data->data->object->customer_info->email . " -- " . $data->data->object->metadata->more_info[0]->name . " -- " . $data->data->object->metadata->reference . " -- " . $data->data->object->metadata->more_info[0]->photo . " -- " . $data->data->object->metadata->name . " -- " . $data->data->object->metadata->id . " -- " . $data->data->object->metadata->mail;
    $benefactor = $data->data->object->customer_info->name;
    $correoBene = $data->data->object->customer_info->email;
    $alumno = $data->data->object->metadata->name;
    $numPedido = $data->data->object->metadata->reference;
    $foto = "https://emprendum.um.edu.mx/" . $data->data->object->metadata->photo;
    $link = "https://emprendum.um.edu.mx/universitarios/" . $data->data->object->metadata->id;
    $correoAlum = $data->data->object->metadata->mail;

    $total= $data->data->object->metadata->total/100;
    $totalGema=$data->data->object->metadata->total - $data->data->object->metadata->totalList/100;
    $envio = $data->data->object->metadata->envio;

    $tte = $total+$envio;
    $ttv = $totalGema+$envio;
    $ttb = $tte-$ttv;

    $co1 = (($tte*.029)+2.5)*1.16;
    $co2 = $totalGema*.05;

    $ttn = $ttb-$co1-$co2;

    $bo1 = $ttb*.21;
    $bo2 = $ttn*.14;
    $bo3 = $ttn*.15;

    $ttnb = $ttn+$bo1+$bo2+$bo3;

    $diezmo = $ttb*.10;

    echo $ttnb;
    
    /*echo $data->data->object->metadata->more_info[0]->mail;
    echo $data->data->object->metadata->more_info[0]->photo;
    echo $data->data->object->metadata->more_info[0]->id;
    echo json_encode($data->data->object->customer_info);
    echo json_encode($data->data->object->shipping_contact);*/

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
            <td style='text-align: right;'>$ $total</td>
            <td>Libro precio de lista GEMA (Contado)</td>
          </tr>
          <tr>
            <td style='text-align: right;'>$ $envio</td>
            <td>Paquetería</td>
          </tr>
          <tr>
            <td style='text-align: right;'>$ $tte</td>
            <td>Precio de venta (Público General)
            </td>
          </tr>
          <tr>
            <td>
              <td colspan='2'>&nbsp;</td>
            </td>
          </tr>
          <tr>
            <td style='text-align: right;'>$ $totalGema</td>
            <td>GEMA</td>
          </tr>
          <tr>
            <td style='text-align: right;'>$ $envio</td>
            <td>Paquetería</td>
          </tr>
          <tr>
            <td style='text-align: right;'>$ $ttv</td>
            <td>Costo de venta
            </td>
          </tr>
          <tr>
            <td>
              <td colspan='1'>&nbsp;</td>
            </td>
          </tr>
          <tr>
            <td style='text-align: right;'>$ $ttb</td>
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
            <td style='text-align: right;'>-$ $co1</td>
            <td>Comision 1 al libro</td>
          </tr>
          <tr>
            <td style='text-align: right;'>-$ $co2</td>
            <td>Comision 2 a Utilidad bruta
            </td>
          </tr>
          <tr>
            <td style='text-align: right;'>$ $ttn</td>
            <td>Utilidad neta 1
            </td>
          </tr>
          <tr>
            <td>
              <td colspan='2' style='color: #2C6DED;'>Bonificación</td>
            </td>
          </tr>
          <tr>
            <td style='text-align: right;'>$ $bo1</td>
            <td>Gema 21% a Utilidad bruta</td>
          </tr>
          <tr>
            <td style='text-align: right;'>$ $bo2</td>
            <td>UM 14% a Utilidad bruta 1
            </td>
          </tr>
          <tr>
            <td style='text-align: right;'>$ $bo3</td>
            <td>UM 15% a Utilidad bruta 1
            </td>
          </tr>
          <tr>
            <td>
              <td colspan='1'>&nbsp;</td>
            </td>
          </tr>
          <tr>
            <td style='text-align: right;'>$ $ttnb</td>
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

$asuntoV = 'Emprendum - Pago realizado';
enviarMail($correoBene, $asuntoV,utf8_decode($content_donante));
enviarMail($correoAlum, $asuntoV,utf8_decode($content_alumno));
    http_response_code(200); // Return 200 OK
    $content=json_encode($data);
    enviarMail('edny_k3@hotmail.com', 'oxxo', $content);
  }else{
    echo "error";
    http_response_code(1);
  }

  function enviarMail($correoBenefactor,$asunto,$contenido){
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
        $mail->addAddress($correoBenefactor);     // Add a recipient
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
