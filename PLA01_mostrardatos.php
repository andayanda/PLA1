<?php
//activar variables de sesion
session_start();
$nif = trim(isset($_POST['nif']))?$_POST['nif']:null;
$nom = trim($_POST['nom']??null);
$cognom = trim($_POST['cognom']?? null);
$nota = trim($_POST['nota']?? null);
// $email2 = trim(filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL));
$email=trim($_POST['email']?? null);
$errores = '';

try {
	
if (empty($nif)) {
	$errores .= 'nif obligatori<br>';	
}
if (empty($nom)) {
	$errores .=  'nom obligatori<br>';
}
if (empty($cognom)) {
	$errores .=  'cognom obligatori<br>';
}
if (empty($email)) {
	$errores .= 'email obligatori<br>';
}
if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
	throw new Exception('El format del correu es incorrecte');
}
if ($nota=='') {
	$errores .=  'Nota obligatoria<br>';
}
	else {
		if ($nota <0 || $nota >10) {

			$errores .=  'Nota no permitida<br>';			
		}
	}
if (!empty($errores)) {
	throw new Exception($errores);	
}
// operativa que depende de la validación
// evaluar la nota
/*
entre 0 < 5 = Supenso
entre 5 y < 6 = aprobado
entre 6 < 7 = bien
entre 7 < 9 = notable
entre 9 o mayor = excelente */
if ($nota <5) {
	$evaluacion = 'Supenso';	
}
elseif ($nota >= 5 && $nota <6) {
	$evaluacion = 'Aprobado';	
	$class= "rojo";
}
elseif ($nota >= 6 && $nota <7) {
	$evaluacion = 'Bien';	
	$class= "amarillo";
}
elseif ($nota >= 7 && $nota <9) {
	$evaluacion = 'Notable';	
	$class= "verde";
}
else $evaluacion = 'Excelente';
}
catch (Exception $error) {
	$mensajes = $error ->getMessage();
} 	
//compactar datos en la variable para conservarlos y recuperarlos fuera de este formulario
	$datos = compact('nif','nom', 'cognom', 'nota', 'email');
	//echo '<pre>';print_r($datos);echo '</pre>';
	$_SESSION ['datos'] = $datos;	 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PLA01</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css?v=1.0">
</head>
<body>
	<div class='container'>
		<h1 class='centrar'>PLA01: MOSTRAR DADES</h1>
		<div class='card'>
			<input type="text" name="nif" placeholder="nif" disabled value='<?php echo $nif;?>'><?php $nif ?><br><br>
			<input type="text" name="nom" placeholder="nom" disabled value='<?php echo $nom;?>'>
			<input type="text" name="cognom" placeholder="cognoms" disabled value='<?php echo $cognom;?>'><br><br>
			<input type="text" name="qualificacio" placeholder="qualificació" disabled value='<?php echo $evaluacion ??null;?>'>
			<!--aqui iran las cajitas <aside></aside>-->
			<?php 
			for ($i = 0; $i <= $nota; $i++) {
				if($i <5){
					echo "<aside class= 'rojo'></aside>";
				}
			    if($i >= 5 && $i < 7){
                    echo "<aside class= 'amarillo'></aside>";
                }}
				if($i >= 7 && $i < 9){
                    echo "<aside class='verde'></aside>";
                }
				if($i >= 9){
                    echo "<aside class='azul'></aside>";
                }
			?>			
			
			<br><br>
			<input type="text" placeholder="email" disabled value='<?php echo $email ??null;?>'><br><br>
			<textarea  cols='22' rows='5' disabled></textarea>
			<p class='errores'><?php echo $mensajes ??null; ?> </p>
			<a href="PLA01_formulario.php">Volver al Formulario</a>
		</div>
	</div>
</body>
</html>