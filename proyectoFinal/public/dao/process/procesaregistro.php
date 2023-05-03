<!DOCTYPE html>
<html lang="es">

<head>
	<title>procesando Registro</title>
	<meta charset="utf-8">
</head>

<body>
	<?php

	$nombre = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	if (!$nombre || empty($nombre = trim($nombre))) {
		$this->errores['usuario'] = 'El nombre de usuario no puede estar vacío';
	}

	$pass = filter_input(INPUT_POST, 'contrasenia', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	if (!$pass || empty($pass = trim($pass))) {
		$this->errores['contrasenia'] = 'El password no puede estar vacío.';
	}
	$npass = filter_input(INPUT_POST, 'ncontrasenia', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	if (!$npass || empty($npass = trim($npass))) {
		$this->errores['ncontrasenia'] = 'El password no puede estar vacío.';
	}
	if ($pass == $npass) {
		//Damos de alta la información
		$db = @mysqli_connect('localhost', 'root', '', 'eljuglar_app');
		if ($db) {
			//consulta que comprueba que un usuario existe

			$sqlcheck = "SELECT * from usuarios where usuario = \"$nombre\""; 
			
			$consulta=mysqli_query($db, $sqlcheck);
			if (mysqli_num_rows($consulta)>0){
				echo "Ya hay una sesion iniciada <br>";
				echo "<a href=\"../../registro.html\"><button>Volver</button></a>";
			}else{
				$sql = "INSERT INTO usuarios VALUES ('$nombre','$pass')";
				if (mysqli_query($db, $sql)) {
					$_SESSION['usuario'] = $nombre;
					header('Location: ../../pageMain.php');
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($db);
				};
			};
			@mysqli_close($db);
		}
	} else {
		echo "Las constaseñas no coinciden";
	};
	?>
</body>

</html>