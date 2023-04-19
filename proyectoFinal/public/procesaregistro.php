<!DOCTYPE html>
<html lang="es">
<head>
	<title>procesando Registro</title>
	<meta charset="utf-8">
</head>
<body>
	<?php  
		$nombre=$_POST['usuario'];
		$pass=$_POST['contrasenia'];
		$npass=$_POST['ncontrasenia'];
		if ($pass==$npass){
			echo "wtf como he entrado";
			//Damos de alta la información
			$db = @mysqli_connect('localhost','root','','eljuglar_app');
			if ($db) {
	    		echo 'Conexión realizada correctamente.<br />';
				$sql = "INSERT INTO usuarios VALUES ('$nombre','$pass')";
				if (mysqli_query($db, $sql)) {
				    echo "New record created successfully";
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