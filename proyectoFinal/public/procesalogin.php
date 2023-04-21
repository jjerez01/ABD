<!DOCTYPE html>
<html lang="es">
<head>
	<title>procesando login</title>
	<meta charset="utf-8">
</head>
<body>
	<?php  

		require_once 'config.php';

		$db = @mysqli_connect('localhost','root','','eljuglar_app');
		if ($db) {
    		echo 'Conexión realizada correctamente.<br />';
    		$nombre=$_POST['usuario'];
			$pass=$_POST['contrasenia'];
			$sql="SELECT * FROM usuarios WHERE usuario='$nombre' AND contrasenia = '$pass'";
			$consulta=mysqli_query($db, $sql);
			if (mysqli_num_rows($consulta)>0){
				echo "Acceso correcto";
				$_SESSION['usuario'] = $nombre;
				header('Location: pageMain.php');
			}else{
				echo "Acceso incorrecto, contraseña o usuario incorrecto";
			};
			
    	};

	?>
</body>
</html>