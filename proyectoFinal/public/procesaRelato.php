<!DOCTYPE html>
<html lang="es">
<head>
	<title>procesando Registro</title>
	<meta charset="utf-8">
    
</head>
<body>
<?php  
//require_once 'config.php';

    $titulo=$_POST['titulo'];
    $texto=$_POST['texto'];
    session_start();
    $nombre=$_SESSION['usuario'];
    $db = @mysqli_connect('localhost','root','','eljuglar_app');
    if ($db) {
        echo 'Conexión realizada correctamente.<br />';
        $sql = "INSERT INTO relatos (titulo, texto, usuario) VALUES ('$titulo','$texto','$nombre')";
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
