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
    $donante=$_SESSION['usuario'];
    $donado=$_POST['donado'];
    $cantidad=$_POST['cantidad'];
    $titulo=$_POST['titulo'];
    $db = @mysqli_connect('localhost','root','','eljuglar_app');
    if ($db) {
        $sql = "INSERT INTO donaciones (donante, donado, cantidad) VALUES ('$donante','$donado','$cantidad')";
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