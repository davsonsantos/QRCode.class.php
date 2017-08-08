<?php

require 'QRCode.class.php';

$QRCode = new QRCodePHP;


//$QRCode->QRCodeSimple('Criando meu primeiro QRCode');

$D = ['Dados' => 'httsps://www.davtech.com.br', 'qrcode_name' => 'string'];
$QRCode->QRCodeSimple($D);
echo '<img src="../uploads/qrcode/string.png" />';
echo str_repeat("<br>", 5);

$Email = ['Maito'=>'davsonsantos@gmail.com','Subject'=>'Enviando Email', 'Body'=>'Corpo do Email', 'qrcode_name' => 'email'];
$QRCode->QRCodeEmail($Email);
echo '<img src="../uploads/qrcode/email.png" />';

echo str_repeat("<br>", 5);

$Card = ['name' => 'Davson Santos','phoneCell'=>'+55 (92) 99167-0359', 'email' => "davsonsantos@gmail.com",'qrcode_name' => 'endereco','addrLabel'=>'Endereço Residencial','addrStreet'=>'Rua Papagaio, 223'];
$QRCode->QRCodeCard($Card);
echo '<img src="../uploads/qrcode/endereco.png" />';


echo str_repeat("<br>", 5);
 

$Data = ['nickname' => 'davsonsantos','qrcode_size' => 4];
$QRCode->QRCodeSkype($Data);
echo '<img src="../uploads/qrcode/name_qrcode.png" />';



?>

