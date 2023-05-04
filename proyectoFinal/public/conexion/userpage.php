<!DOCTYPE html>
<html lang="es">
<head>
	<title>Pagina de usuario</title>
	<meta charset="utf-8">
    <link rel="stylesheet" href=".././css/userpage.css">
</head>
<body>
    <?php
    session_start();
        $usuario = $_SESSION['usuario'];
        echo "<h1>Hola " . $usuario . "</h1>";
        echo "libros leidos";//TODO
        echo " todos los relatos: <br>";
        

        $db = @mysqli_connect('localhost','root','','eljuglar_app');
        if ($db) {
            $sql = "SELECT * FROM relatos R" /*TODO order ascendant*/ ;
            if (mysqli_query($db, $sql)) {
                //coger todas las columnas de la tabla relatos e imprimirlas en la página
                
                $result = mysqli_query($db, $sql);
                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        $tit = $row['titulo'];
                        
                        echo "<a href='./relatoInfo.php?id=$tit' method='post'> $tit </a>";
                        echo "<br>";
                    }
                } else {
                    echo "no hay relatos todavia <br>";
                }

            } else {
                ECHO "ERROR EN LA CONSULTA";
                echo "Error: " . $sql . "<br>" . mysqli_error($db);
            }

            

            @mysqli_close($db);
        }else{
            echo "CONEXION NO ESTABLECIDA CORRECTAMENTE";
        }


    ?>