<?php
ini_set('display_errors',1);

error_reporting(E_ALL);
// несколько получателей

$to  = 'ruslan-webmaster@mail.ru';  // обратите внимание на запятую

  $name  = substr( $_POST['name'], 0, 64 );
  $tel = substr( $_POST['phone'], 0, 64 );
  $email   = substr( $_POST['email'], 0, 64 ); 

  if ( !empty( $_FILES['file']['tmp_name'] ) and $_FILES['file']['error'] == 0 ) {
    $filepath = $_FILES['file']['tmp_name'];
    $filename = $_FILES['file']['name'];
  } else {
    $filepath = '';
    $filename = '';
  }
 
  $body = "Имя:\r\n".$name."\r\n\r\n";
  $body .= "Контактный номер:\r\n".$tel."\r\n\r\n";
  $body .= "E-mail:\r\n".$email."\r\n\r\n";
 
  send_mail($to, $body, $email, $filepath, $filename);




// Вспомогательная функция для отправки почтового сообщения с вложением
function send_mail($to, $body, $email, $filepath, $filename)
{
  $subject = 'Тестирование формы с прикреплением файла';
  $boundary = "--".md5(uniqid(time())); // генерируем разделитель
  $headers = "From: ".$email."\r\n";   
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .="Content-Type: multipart/mixed; boundary=\"".$boundary."\"\r\n";
  $multipart = "--".$boundary."\r\n";
  $multipart .= "Content-type: text/plain; charset=\"utf-8\"\r\n";
  $multipart .= "Content-Transfer-Encoding: quoted-printable\r\n\r\n";

  $body = $body."\r\n\r\n";
 
  $multipart .= $body;
 
  $file = '';
  if ( !empty( $filepath ) ) {
    $fp = fopen($filepath, "r");
    if ( $fp ) {
      $content = fread($fp, filesize($filepath));
      fclose($fp);
      $file .= "--".$boundary."\r\n";
      $file .= "Content-Type: application/octet-stream\r\n";
      $file .= "Content-Transfer-Encoding: base64\r\n";
      $file .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
      $file .= chunk_split(base64_encode($content))."\r\n";
    }
  }
  $multipart .= $file."--".$boundary."--\r\n";
  mail($to, $subject, $multipart, $headers);
}

?>

<!DOCTYPE html>

<html lang="ru">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<meta name="Keywords" content="кузовной центр, кузовной ремонт, ремонт кузова"/>

	<meta name="Description" content="Кузовной ремонт автомобилей"/>

    <meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="robots" content="all"/>

	<meta name="robots" content="noyaca"/>

	<meta name="robots" content="noodp"/>



	<title>AutoCar plus | Обратная связь</title>



	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">


	<link type="text/css" rel="stylesheet" href="css/normalize.css">

	<link type="text/css" rel="stylesheet" href="css/style.css">





	<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>

	<script type="text/javascript" src="js/prefixfree.min.js"></script>

	<script type="text/javascript" src="js/html5shiv.min.js"></script>

	<script type="text/javascript" src="js/script.js"></script>



</head>
<body>
	<div id="wrapper">
		<section class="container success">
			<h1>Ваша заявка успешно отправлена!</h1>
		</section>
	</div>
</body>
</html>