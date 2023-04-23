<!DOCTYPE html>
<html lang="es">
<head>
	<title>procesando Registro</title>
	<meta charset="utf-8">
    
</head>
<body>
<?php
    $db = @mysqli_connect('localhost','root','','eljuglar_app');
    if ($db) {
        echo 'Conexión realizada correctamente.<br />';
        $sql = "SELECT * FROM relatos R" /*TODO order ascendant*/ ;
        if (mysqli_query($db, $sql)) {
            //coger todas las columnas de la tabla relatos e imprimirlas en la página
            
            $result = mysqli_query($db, $sql);
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    echo " - titulo: " . $row["titulo"] . "<br>";
                    echo " - texto: " . $row["texto"] . "<br>";
                    echo " - usuario: " . $row["usuario"]. "<br>";
                    echo " pon algun comentario: <br>";
                    echo "<form action='procesaComentario.php' method='post'>";
                    echo "<input type='text' name='comentario'>";
                    echo "<input type='submit' value='enviar'>";
                    echo "</form>";
                     
                }
            } else {
                echo "0 results";
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