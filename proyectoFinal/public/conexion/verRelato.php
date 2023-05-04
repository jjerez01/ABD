<!DOCTYPE html>
<html lang="es">

<head>
    <title>procesando Registro</title>
    <meta charset="utf-8">

</head>

<body>
    <?php
    session_start();
    echo "<h1>Relatos mas populares</h1>";
    $db = @mysqli_connect('localhost', 'root', '', 'eljuglar_app');
    if ($db) {
        $sql = "SELECT * FROM relatos R" /*TODO order ascendant*/;
        if (mysqli_query($db, $sql)) {
            //coger todas las columnas de la tabla relatos e imprimirlas en la página

            $result = mysqli_query($db, $sql);

            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                $cont = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($cont < 5) {
                        $tit = $row["titulo"];
                        $cont++;

                        echo " - titulo: " . $row["titulo"] . "<br>";
                        echo " - usuario: " . $row["usuario"] . "<br>";
                        echo $row["texto"] . "<br>";


                        $sql2 = "SELECT * FROM comentarios WHERE titulo = \"$tit\"";
                        echo "<h2>Comentarios: </h2>";

                        if (mysqli_query($db, $sql2)) {
                            //coger todas las columnas de la tabla relatos e imprimirlas en la página

                            $result2 = mysqli_query($db, $sql2);
                            if (mysqli_num_rows($result2) > 0) {
                                // output data of each row
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    echo " - usuario: " . $row2["usuario"] . "<br>";
                                    echo $row2["texto"] . "<br>";
                                }
                            } else {
                                echo "no hay comentarios todavia <br>";
                            }
                        } else {
                            echo "ERROR EN LA CONSULTA";
                            echo "Error: " . $sql2 . "<br>" . mysqli_error($db);
                        };
                    }
                }
            } else {
                echo "no hay relatos todavia <br>";
            }
        } else {
            echo "ERROR EN LA CONSULTA";
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        };
        @mysqli_close($db);
    }
    ?>
</body>

</html>