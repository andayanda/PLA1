<?php
//recuperar variables de sesion si esta existe
session_start();
if (isset($_SESSION['datos'])){
//crear variables independientes a partir de las claves asociativas del array 
extract($_SESSION['datos']);
}
//echo "$nif $nom $cognom";

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PLA01</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>
	<div class='container'>
		<h1 class='centrar'>PLA01: FORMULARI</h1>
		<form method="post" action="PLA01_mostrardatos.php">
			<label for='nif'>Nif</label>
			<input type="text" name="nif" id='nif' value='<?php echo $nif ??null;?>'><br><br>
			<label for='nombre'>Nom</label>
			<input type="text" name="nom" id='nom' value='<?php echo $nom ??null;?>'><br><br>
			<label for='apellidos'>Gognoms</label>
			<input type="text" name="cognom" id='cognom' value='<?php echo $cognom ??null;?>'><br><br>
			<label for='email'>Email</label>
			<input type="email" name="email" id='email' value='<?php echo $email ??null;?>'><br><br>
			<label for='nota'>Nota exàmen</label>
			<input type="number" name="nota" id='nota' value='<?php echo $nota ??null;?>'><br><br>			
			<label for='mensaje'>Missatge</label>
			<textarea name='mensaje' id='mensaje' cols='22' rows='5'></textarea><br><br>
			<label></label>
			<input type="submit" name="Enviar">
		</form>
	</div>
</body>
</html>