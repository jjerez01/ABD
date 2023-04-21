<!DOCTYPE html>
<html lang="es">
<head>
	<title>procesando Registro</title>
	<meta charset="utf-8">
</head>
<body>
	<?php  
		require_once 'config.php';
		
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
		if ($pass==$npass){
			//Damos de alta la información
			$db = @mysqli_connect('localhost','root','','eljuglar_app');
			if ($db) {
	    		echo 'Conexión realizada correctamente.<br />';
				$sql = "INSERT INTO usuarios VALUES ('$nombre','$pass')";
				if (mysqli_query($db, $sql)) {
				    echo "New record created successfully";
					$_SESSION['usuario'] = $nombre;
					header('Location: pageMain.php');
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($db);
				};
		    @mysqli_close($db);
			}
		}
		else
		{
			echo "Las constaseñas no coinciden";
		};
	?>
</body>
</html>