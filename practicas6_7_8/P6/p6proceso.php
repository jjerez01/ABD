<!DOCTYPE html>
<html>
<head>
	<title>Procesando</title>
	<meta charset="utf-8">
</head>
<body>
	<?php  
		$db = @mysqli_connect('localhost','root','','p6');
		if ($db) {
    		
    		$nombre=$_POST['nombre'];
			$pass=$_POST['pass'];
			$sql="SELECT * FROM usuarios WHERE usuario='$nombre' AND password = '$pass'";
			$consulta=mysqli_query($db, $sql);
			if (mysqli_num_rows($consulta)>0){
				echo "Acceso correcto";
			}else{
				echo '<form action="p6proceso2.php" method="post">';
				echo '<fieldset>';
				echo '<legend>Datos personales: </legend>';
				echo '<table>';
				echo '<tr><td>Nombre</td><td><input type="text" name="nombre2"></td></tr>';
				echo '<tr><td>Contraseña</td><td><input type="password" name="pass2"></td></tr>';
				echo '<tr><td>Repita contraseña</td><td><input type="password" name="npass2"></td></tr>';
				echo '</table>';
				echo '<input type="submit" name="OK">';
				echo '</fieldset>';
				echo '</form>';
			};
			
    	};

	?>
</body>
</html>