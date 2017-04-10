<?php
echo '<table border="0" align="center">';
echo '<tr><th colspan="2">',$Title,'</b></th></tr>';
echo '<tr><td><b>Nombre</b>:</td><td>'.Sanitize::html($_POST['Name']).'</td></tr>';
echo '<tr><td><b>Apellido</b>:</td><td>'.Sanitize::html($_POST['LastName']).'</td></tr>';
if(isset($_POST['IdNumber'])){
echo '<tr><td valign="top"><b>N&uacute;mero de c&eacute;dula</b>:</td><td valign="top">'.Sanitize::html($_POST['IdNumber']).'</td></tr>';
}
if(isset($_POST['JobPosition'])){
echo '<tr><td valign="top"><b>Puesto</b>:</td><td valign="top">'.Sanitize::html($_POST['JobPosition']).'</td></tr>';
}
if(isset($_POST['BusinessName'])){
echo '<tr><td valign="top"><b>Nombre de la Empresa</b>:</td><td valign="top">'.Sanitize::html($_POST['BusinessName']).'</td></tr>';
}
if(isset($_POST['RazonSocial'])){
echo '<tr><td valign="top"><b>Raz&oacute;n Social</b>:</td><td valign="top">'.Sanitize::html($_POST['RazonSocial']).'</td></tr>';
}
if(isset($_POST['CedulaJuridica'])){
echo '<tr><td valign="top"><b>N&uacute;mero de C&eacute;dula J&uacute;rídica</b>:</td><td valign="top">'.Sanitize::html($_POST['CedulaJuridica']).'</td></tr>';
}
if(isset($_POST['BusArea'])){
echo '<tr><td valign="top"><b>&Aacute;rea de negocio:</b> '.Sanitize::html($_POST['BusArea']).'</td></tr>';
}
echo '<tr><td valign="top"><b>Tel&eacute;fono 1</b>:</td><td valign="top">'.Sanitize::html($_POST['Tel1']).'</td></tr>';
if(isset($_POST['Tel2'])){
echo '<tr><td valign="top"><b>Tel&eacute;fono 2</b>:</td><td valign="top">'.Sanitize::html($_POST['Tel2']).'</td></tr>';
}
echo '<tr><td valign="top"><b>Correo Electr&oacute;nico</b>:</td><td valign="top">'.Sanitize::html($_POST['Email']).'</td></tr>';
if(isset($_POST['Address'])){
echo '<tr><td valign="top"><b>Direcci&oacute;n F&iacute;sica</b>:</td><td valign="top">'.nl2br(Sanitize::html($_POST['Address'])).'</td></tr>';
}
echo '<tr><td valign="top"><b>Comentarios</b>:</td><td valign="top">'.nl2br(Sanitize::html($_POST['Comments'])).'</td></tr>';
echo '<tr><td valign="top"><b>IP</b>:</td><td valign="top">'.Sanitize::paranoid($_SERVER['REMOTE_ADDR'], array('.')).'</td></tr>';
echo '</table>'
?>