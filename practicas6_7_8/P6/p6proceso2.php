<!DOCTYPE html>
<html>
<head>
	<title>Información sobre el alta</title>
	<meta charset="utf-8">
</head>
<body>
	<?php  
		$nombre=$_POST['nombre2'];
		$pass=$_POST['pass2'];
		$npass=$_POST['npass2'];
		if ($pass==$npass){
			//Damos de alta la información
			$db = @mysqli_connect('localhost','root','','p6');
			if ($db) {
	    		echo 'Conexión realizada correctamente.<br />';
				$sql = "INSERT INTO usuarios VALUES ('$nombre','$pass')";
				if (mysqli_query($db, $sql)) {
				    echo "New record created successfully";
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