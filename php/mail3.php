<?php

ini_set('display_errors',1);

error_reporting(E_ALL);
function send_mail()
{
$name = htmlspecialchars($_REQUEST['name']);
}
{
$email = htmlspecialchars($_REQUEST['email']);
}
$message = '<b>Имя пославшего: </b>'.$_REQUEST['name'].'<br> <b>Электронный адрес: </b>'.$_REQUEST['email'].'<br><b>Сообщение: </b>';

include "phpmailer.php";// подключаем класс

$mail = new PHPMailer();
$mail->From = $_REQUEST['email'];
$mail->FromName = $_REQUEST['name'];
$mail->AddAddress('iamfrontend@mail.ru');
$mail->IsHTML(true);
$mail->Subject = $_POST['name'];

if(isset($_FILES['files']))
{
if($_FILES['files']['error'] == 0)
{
$mail->AddAttachment($_FILES['files']['tmp_name'],$_FILES['files']['name']);
}
}
$mail->Body = $message;
if (!$mail->Send()) die ('Mailer Error: '.$mail->ErrorInfo);
{
echo '<center><b>Спасибо за отправку вашего сообщения';
}
if (!empty($_POST['submit'])) send_mail();
?>