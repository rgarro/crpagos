<?php
echo $Title."\n";
echo "\n";
echo 'Nombre: '.Sanitize::clean($_POST['Name'])."\n";
echo 'Apellido: '.Sanitize::clean($_POST['LastName'])."\n";
if(isset($_POST['IdNumber'])){
echo 'Número de cédula: '.Sanitize::clean($_POST['IdNumber'])."\n";
}
if(isset($_POST['JobPosition'])){
echo 'Puesto: '.Sanitize::clean($_POST['JobPosition'])."\n";
}
if(isset($_POST['BusinessName'])){
echo 'Nombre de la Empresa: '.Sanitize::clean($_POST['BusinessName'])."\n";
}
if(isset($_POST['RazonSocial'])){
echo 'Razón Social: '.Sanitize::clean($_POST['RazonSocial'])."\n";
}
if(isset($_POST['CedulaJuridica'])){
echo 'Número de Cédula Jurídica: '.Sanitize::clean($_POST['CedulaJuridica'])."\n";
}
if(isset($_POST['BusArea'])){
echo 'Área negocio: '.Sanitize::clean($_POST['BusArea'])."\n";
}
echo 'Teléfono 1: '.Sanitize::clean($_POST['Tel1'])."\n";
if(isset($_POST['Tel2'])){
echo 'Teléfono 2: '.Sanitize::clean($_POST['Tel2'])."\n";
}
echo 'Correo Electrónico: '.Sanitize::clean($_POST['Email'])."\n";
if(isset($_POST['Address'])){
echo 'Dirección Física: '.Sanitize::clean($_POST['Address'])."\n";
}
echo 'Comentarios :'.Sanitize::clean($_POST['Comments'])."\n";
echo 'IP: '.Sanitize::paranoid($_SERVER['REMOTE_ADDR'], array('.'))."\n";
?>