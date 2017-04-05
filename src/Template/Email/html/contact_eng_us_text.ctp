<?php
echo $Title."\n";
echo "\n";
echo 'Name: '.$_POST['Name']."\n";
echo 'Last Name: '.$_POST['LastName']."\n";
if(isset($_POST['IdNumber'])){
echo 'ID Number: '.$_POST['IdNumber']."\n";
}
if(isset($_POST['JobPosition'])){
echo 'Position: '.$_POST['JobPosition']."\n";
}
if(isset($_POST['BusinessName'])){
echo 'Name of the Company: '.$_POST['BusinessName']."\n";
}
if(isset($_POST['RazonSocial'])){
echo 'Razón Social: '.$_POST['RazonSocial']."\n";
}
if(isset($_POST['CedulaJuridica'])){
echo 'Cédula Jurídica number: '.$_POST['CedulaJuridica']."\n";
}
if(isset($_POST['BusArea'])){
echo 'Business area: '.$_POST['BusArea']."\n";
}
echo 'Telephone 1: '.$_POST['Tel1']."\n";
if(isset($_POST['Tel2'])){
echo 'Telephone 2: '.$_POST['Tel2']."\n";
}
echo 'E-mail: '.$_POST['Email'])."\n";
if(isset($_POST['Address'])){
echo 'Address: '.$_POST['Address']."\n";
}
echo 'Comments :'.$_POST['Comments']."\n";
echo 'IP: '.$_SERVER['REMOTE_ADDR']."\n";
?>
