<!DOCTYPE html>
<html lang="es">
<head>
	<title>relato</title>
	<meta charset="utf-8">
</head>
<body>
    <?php
    session_start();
    $titulo = $_GET['id'];
    $usuarioLector = $_SESSION['usuario'];
    $db = @mysqli_connect('localhost','root','','eljuglar_app');
    if ($db) {
        echo 'Conexión realizada correctamente.<br />';
        $sql = "SELECT * FROM relatos R WHERE R.titulo = '$titulo'";
        if (mysqli_query($db, $sql)) {
            //coger todas las columnas de la tabla relatos e imprimirlas en la página
            $result = mysqli_query($db, $sql);
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                $row = mysqli_fetch_assoc($result);
                $tit = $row['titulo'];
                $texto = $row['texto'];
                $usuario = $row['usuario'];
                echo "<h1>$tit</h1>";
                echo "<h2>autor: $usuario</h2>";
                echo "<p>$texto</p>";
            } else {
                echo "no hay relatos todavia";
            }
        } else {
            ECHO "ERROR EN LA CONSULTA";
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        }
        $sql2 = "SELECT * FROM comentarios C WHERE C.titulo = '$titulo'";
        if (mysqli_query($db, $sql2)) {
            //coger todas las columnas de la tabla relatos e imprimirlas en la página
            $result2 = mysqli_query($db, $sql2);
            if (mysqli_num_rows($result2) > 0) {
                // output data of each row
                while($row2 = mysqli_fetch_assoc($result2)) {
                    $comentario = $row2['texto'];
                    $usuarioComentador = $row2['usuario'];
                    echo "<h3>comentario de $usuarioComentador</h3>";
                    echo "<p>$comentario</p>";
                }
            } else {
                echo "no hay comentarios todavia";
            }
        } else {
            ECHO "ERROR EN LA CONSULTA";
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        } 
        $sql3 = "INSERT INTO lecturas (Usuario,titulo, hora de lectura, leido) VALUES ('$usuarioLector','$titulo',NOW(),0)";       
        
            //hazme una checkbox para indicar que el ususario se ha leido el relato y si le da cambiar el valor de la columna leido a 1
        $sql3bis = "SELECT * FROM lecturas L WHERE L.titulo = '$titulo' AND L.usuario = '$usuarioLector'";
        if (mysqli_query($db, $sql3bis)) {
            //coger todas las columnas de la tabla relatos e imprimirlas en la página
            $result3 = mysqli_query($db, $sql3bis);
            if (mysqli_num_rows($result3) > 0) {
                // output data of each row
                while($row3 = mysqli_fetch_assoc($result3)) {
                    $leido = $row3['leido'];
                    if($leido == 0){
                        echo "<form action='relatoInfo.php?id=$titulo' method='post'>";
                        echo "<input type='checkbox' name='leido' value='leido'>Leido<br>";
                        echo "<input type='submit' value='Submit'>";
                        echo "</form>";
                    }else{
                        echo "<form action='relatoInfo.php?id=$titulo' method='post'>";
                        echo "<input type='checkbox' name='leido' value='leido' checked>Leido<br>";
                        echo "<input type='submit' value='Submit'>";
                        echo "</form>";
                    }
                }
            } else {
                if(mysqli_query($db, $sql3)){
                    echo "<form action='relatoInfo.php?id=$titulo' method='post'>";
                        echo "<input type='checkbox' name='leido' value='leido' checked>Leido<br>";
                        echo "<input type='submit' value='Submit'>";
                        echo "</form>";
                }
            }
        } else {
            ECHO "ERROR EN LA CONSULTA";
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        }
    
    }else{
        echo "CONEXION NO ESTABLECIDA CORRECTAMENTE";
    }
    @mysqli_close($db);
    ?>
</body>
</html>
