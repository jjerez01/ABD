<!DOCTYPE html>
<html lang="es">

<head>
  <title>relato</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href=".././css/relatoInfo.css">
</head>


<body>
    <?php
    session_start();
    $titulo = $_GET['id'];
    $usuarioLector = $_SESSION['usuario'];
    $db = @mysqli_connect('localhost', 'root', '', 'eljuglar_app');
    if ($db) {
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
                echo "no hay relatos todavia <br>";
            }
        } else {
            echo "ERROR EN LA CONSULTA";
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        }
        
        echo " pon algun comentario: <br>";
        echo "<form action='./process/procesaComentario.php' method='post'>";
        echo "<textarea id='comentario' name='comentario' rows='3' cols='30' placeholder='comenta'></textarea> <br>";
        echo "<input type='submit' value='enviar'>";
        echo "<input type='hidden' name='titulo' value='$titulo'>";
        echo "</form>";
        
        $sql2 = "SELECT * FROM comentarios C WHERE C.titulo = '$titulo'";
        if (mysqli_query($db, $sql2)) {
            //coger todas las columnas de la tabla relatos e imprimirlas en la página
            $result2 = mysqli_query($db, $sql2);
            if (mysqli_num_rows($result2) > 0) {
                // output data of each row
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $comentario = $row2['texto'];
                    $usuarioComentador = $row2['usuario'];
                    echo "<h3>comentario de $usuarioComentador</h3>";
                    echo "<p>$comentario</p>";
                }
            } else {
                echo "no hay comentarios todavia <br>";
            }
        } else {
            echo "ERROR EN LA CONSULTA";
            echo "Error: " . $sql2 . "<br>" . mysqli_error($db);
        }
        $hora = date('Y-m-d H:i:s', time());
        $sql3 = "INSERT INTO lecturas (Usuario,titulo,hora_de_lectura) VALUES ('$usuarioLector','$titulo','$hora') ON DUPLICATE KEY UPDATE hora_de_lectura = '$hora'";
        if (mysqli_query($db, $sql3)) {
            //MOSTRAR LA HORA DE LECTURA
            echo "ultima hora de lectura: ". date('Y-m-d H:i:s', time());
        } else {
            echo "Error: " . $sql3 . "<br>" . mysqli_error($db);
        }

        echo "<h2>Donaciones: <h2> <br>";
        echo "<form action='./process/procesaDonacion.php' method='post'>";
        echo "<input type='hidden' name='donado' value='$usuario'>";
        echo "<input type='hidden' name='titulo' value='$titulo'>";
        echo "<input type='text' name='cantidad'>";
        echo "<input type='submit' value='enviar'>";
        echo "</form>";
        
    } else {
        echo "CONEXION NO ESTABLECIDA CORRECTAMENTE";
    }
    @mysqli_close($db);
    ?>
</body>

</html>