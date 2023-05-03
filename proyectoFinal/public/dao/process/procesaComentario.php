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
    session_start();
    $usuario=$_SESSION['usuario'];
    $texto=$_POST['comentario'];
    
    $titulo=$_SESSION['titulo'];
    $db = @mysqli_connect('localhost','root','','eljuglar_app');
    if ($db) {
        $sql = "INSERT INTO comentarios (usuario, texto, titulo) VALUES ('$usuario','$texto','$titulo')";
        if (mysqli_query($db, $sql)) {
            header("Location: ../relatoInfo.php?id=$titulo");
            die();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        };
        @mysqli_close($db);
    }
?>
</body>
</html>