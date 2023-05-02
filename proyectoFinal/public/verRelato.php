<!DOCTYPE html>
<html lang="es">
<head>
	<title>procesando Registro</title>
	<meta charset="utf-8">
    
</head>
<body>
<?php
session_start();
    $db = @mysqli_connect('localhost','root','','eljuglar_app');
    if ($db) {
        echo 'Conexión realizada correctamente.<br />';
        $sql = "SELECT * FROM relatos R" /*TODO order ascendant*/ ;
        if (mysqli_query($db, $sql) && mysqli_query($db, $sql2)) {
            //coger todas las columnas de la tabla relatos e imprimirlas en la página
            
            $result = mysqli_query($db, $sql);
            
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                $cont = 0;
                while($row = mysqli_fetch_assoc($result) && $cont < 5 ) {
                    $tit = $row["titulo"];
                    $cont++;
                    echo " - titulo: " . $row["titulo"] . "<br>";
                    echo " - texto: " . $row["texto"] . "<br>";
                    echo " - usuario: " . $row["usuario"]. "<br>";
                    echo " pon algun comentario: <br>";
                    echo "<form action='procesaComentario.php' method='post'>";
                    echo "<input type='text' name='comentario'>";
                    echo "<input type='submit' value='enviar'>";
                    echo "</form>";
                    $sql2 = "SELECT * FROM comentarios WHERE titulo = \"$tit\"";
                    
                    if (mysqli_query($db, $sql2)) {
                        //coger todas las columnas de la tabla relatos e imprimirlas en la página
                        
                        $result2 = mysqli_query($db, $sql2);
                        if (mysqli_num_rows($result2) > 0) {
                            // output data of each row
                            while($row2 = mysqli_fetch_assoc($result2)) {
                                echo " - usuario: " . $row2["usuario"] . "<br>";
                                echo " - texto: " . $row2["texto"] . "<br>";
                            }
                        } else {
                            echo "no hay comentarios todavia";
                        }
                    } else {
                        ECHO "ERROR EN LA CONSULTA";
                        echo "Error: " . $sql2 . "<br>" . mysqli_error($db);
                    };
                }
            } else {
                echo "no hay relatos todavia";
            }

        } else {
            ECHO "ERROR EN LA CONSULTA";
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        };
        @mysqli_close($db);
    }
?>
</body>
</html>