<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include("PHPMailer-master/src/Exception.php");
include("PHPMailer-master/src/PHPMailer.php");
include("PHPMailer-master/src/SMTP.php");

$body = @file_get_contents('php://input');
$data = json_decode($body); //order.pending_confirmation
//if($data->type == 'order.pending_confirmation')
if ($data->data->object->charges->data[0]->payment_method->type == 'oxxo' && $data->type == 'order.paid'){
}
?>