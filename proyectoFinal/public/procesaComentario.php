<!DOCTYPE html>
<html lang="es">
<head>
	<title>procesando Registro</title>
	<meta charset="utf-8">
    
</head>
<body>
<?php
session_start();  
//require_once 'config.php';

    $usuario=$_SESSION['usuario'];
    $texto=$_POST['comentario'];
    
    $titulo=$_SESSION['titulo'];
    $db = @mysqli_connect('localhost','root','','eljuglar_app');
    if ($db) {
        echo 'Conexión realizada correctamente.<br />';
        $sql = "INSERT INTO comentarios (usuario, texto, titulo) VALUES ('$usuario','$texto','$titulo')";
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