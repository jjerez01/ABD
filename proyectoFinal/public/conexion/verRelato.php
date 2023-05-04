<!DOCTYPE html>
<html lang="es">
<head>
    <title>Relatos mas populares</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href=".././css/verRelato.css">
</head>

<body>
    <?php
    session_start();
    echo "<h1>Relatos mas populares</h1>";
    $db = @mysqli_connect('localhost', 'root', '', 'eljuglar_app');
    if ($db) {
        $sql = "SELECT * FROM relatos R" /*TODO order ascendant*/;
        if (mysqli_query($db, $sql)) {
            $result = mysqli_query($db, $sql);
            if (mysqli_num_rows($result) > 0) {
                $cont = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($cont < 5) {
                        $tit = $row["titulo"];
                        $cont++;
                        echo "<h3>" . $row["titulo"] . "</h3>";
                        echo "<p>Usuario: " . $row["usuario"] . "</p>";
                        echo "<p>" . $row["texto"] . "</p>";
                        $sql2 = "SELECT * FROM comentarios WHERE titulo = \"$tit\"";
                        echo "<h2>Comentarios:</h2>";
                        if (mysqli_query($db, $sql2)) {
                            $result2 = mysqli_query($db, $sql2);
                            if (mysqli_num_rows($result2) > 0) {
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    echo "<p class='comment'>- usuario: " . $row2["usuario"] . "</p>";
                                    echo "<p class='comment'>" . $row2["texto"] . "</p>";
                                }
                            } else {
                                echo "<p class='comment'>no hay comentarios todavia</p>";
                            }
                        } else {
                            echo "<p class='comment'>ERROR EN LA CONSULTA</p>";
                            echo "<p class='comment'>Error: " . $sql2 . "<br>" . mysqli_error($db) . "</p>";
                        };
                    }
                }
            } else {
                echo "<p class='comment'>no hay relatos todavia</p>";
            }
        } else {
            echo "<p class='comment'>ERROR EN LA CONSULTA</p>";
            echo "<p class='comment'>Error: " . $sql . "<br>" . mysqli_error($db) . "</p>";
        };
        @mysqli_close($db);
    }
    ?>
</body>
</html>
