<?php
#ini_set('display_errors',1);

#error_reporting(E_ALL);
//if (isset ($_POST['phone'])) {
  $to = "ruslan-webmaster@mail.ru"; // поменять на свой электронный адрес
  $from = $_POST['email'];
  $phone = $_POST['phone'];
  $subject = "Контактная форма с ".$_SERVER['HTTP_REFERER'];
  $message = "Имя: ".$_POST['name']."\nEmail: ".$from."\nIP: ".$_SERVER['REMOTE_ADDR'];
  //$boundary = md5(date('r', time()));
  $filesize = '';
  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "From: " . $from . "\r\n";
  $headers .= "Reply-To: " . $from . "\r\n";
  $headers .= "Content-Type: multipart/mixed;\r\n";

  $headers .= 'To: <ruslan-webmaster@mail.ru>' . "\r\n"; // Свое имя и email
  $headers .= 'From: '  . $_POST['name'] . '<' . $_POST['phone'] . '>' . "\r\n";

  /*for($i=0;$i<count($_FILES['file']['name']);$i++) {
     if(is_uploaded_file($_FILES['file']['tmp_name'][$i])) {
         $attachment = chunk_split(base64_encode(file_get_contents($_FILES['file']['tmp_name'][$i])));
         $filename = $_FILES['file']['name'][$i];
         $filetype = $_FILES['file']['type'][$i];
         $filesize += $_FILES['file']['size'][$i];
         $message.="

Content-Type: \"$filetype\"; name=\"$filename\"
Content-Transfer-Encoding: base64
Content-Disposition: attachment; filename=\"$filename\"

$attachment";
     }
   }*/

  mail($to, $subject, $message, $headers);
    echo '<p style="font-size: 20px; text-align: center; padding-top: 60px;">'.$_POST['name'].', Ваше сообщение получено, спасибо!</p>';

  //if ($filesize < 10000000) { // проверка на общий размер всех файлов. Многие почтовые сервисы не принимают вложения больше 10 МБ
    
  //} else {
    //echo 'Извините, письмо не отправлено. Размер всех файлов превышает 10 МБ.';
  //}
//}
?>