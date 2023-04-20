<!DOCTYPE html>
<html lang="es">
<head>
	<title>procesando Registro</title>
	<meta charset="utf-8">
</head>
<body>
<?php  
    // TODO $nombre=$_POST['usuario'];
    $titulo=$_POST['titulo'];
    $relato=$_POST['relato'];
    $db = @mysqli_connect('localhost','root','','eljuglar_app');
    if ($db) {
        echo 'Conexión realizada correctamente.<br />';
        $sql = "INSERT INTO relatos VALUES ('$titulo','$relato')";
        if (mysqli_query($db, $sql)) {
            echo "New record created successfully";
            header('Location: pageMain.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        };
        @mysqli_close($db);
    }
?>
</body>
</html>
