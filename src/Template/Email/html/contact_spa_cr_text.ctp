<?php
echo $Title."\n";
echo "\n";
echo 'Nombre: '.$_POST['Name']."\n";
echo 'Apellido: '.$_POST['LastName']."\n";
if(isset($_POST['IdNumber'])){
echo 'Número de cédula: '.$_POST['IdNumber']."\n";
}
if(isset($_POST['JobPosition'])){
echo 'Puesto: '.$_POST['JobPosition']."\n";
}
if(isset($_POST['BusinessName'])){
echo 'Nombre de la Empresa: '.$_POST['BusinessName']."\n";
}
if(isset($_POST['RazonSocial'])){
echo 'Razón Social: '.$_POST['RazonSocial']."\n";
}
if(isset($_POST['CedulaJuridica'])){
echo 'Número de Cédula Jurídica: '.$_POST['CedulaJuridica']."\n";
}
if(isset($_POST['BusArea'])){
echo 'Área Compañía: '.$_POST['BusArea']."\n";
}
echo 'Teléfono 1: '.$_POST['Tel1']."\n";
if(isset($_POST['Tel2'])){
echo 'Teléfono 2: '.$_POST['Tel2']."\n";
}
echo 'Correo Electrónico: '.$_POST['Email']."\n";
if(isset($_POST['Address'])){
echo 'Dirección Física: '.$_POST['Address']."\n";
}
echo 'Comentarios :'.$_POST['Comments']."\n";
echo 'IP: '.$_SERVER['REMOTE_ADDR']."\n";
?>
