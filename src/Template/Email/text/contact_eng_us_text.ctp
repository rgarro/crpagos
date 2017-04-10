<?php
echo $Title."\n";
echo "\n";
echo 'Name: '.Sanitize::clean($_POST['Name'])."\n";
echo 'Last Name: '.Sanitize::clean($_POST['LastName'])."\n";
if(isset($_POST['IdNumber'])){
echo 'ID Number: '.Sanitize::clean($_POST['IdNumber'])."\n";
}
if(isset($_POST['JobPosition'])){
echo 'Position: '.Sanitize::clean($_POST['JobPosition'])."\n";
}
if(isset($_POST['BusinessName'])){
echo 'Name of the Company: '.Sanitize::clean($_POST['BusinessName'])."\n";
}
if(isset($_POST['RazonSocial'])){
echo 'Razón Social: '.Sanitize::clean($_POST['RazonSocial'])."\n";
}
if(isset($_POST['CedulaJuridica'])){
echo 'Cédula Jurídica number: '.Sanitize::clean($_POST['CedulaJuridica'])."\n";
}
if(isset($_POST['BusArea'])){
echo 'Business area: '.Sanitize::clean($_POST['BusArea'])."\n";
}
echo 'Telephone 1: '.Sanitize::clean($_POST['Tel1'])."\n";
if(isset($_POST['Tel2'])){
echo 'Telephone 2: '.Sanitize::clean($_POST['Tel2'])."\n";
}
echo 'E-mail: '.Sanitize::clean($_POST['Email'])."\n";
if(isset($_POST['Address'])){
echo 'Address: '.Sanitize::clean($_POST['Address'])."\n";
}
echo 'Comments :'.Sanitize::clean($_POST['Comments'])."\n";
echo 'IP: '.Sanitize::paranoid($_SERVER['REMOTE_ADDR'], array('.'))."\n";
?>