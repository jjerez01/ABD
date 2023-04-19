<!DOCTYPE html>
<html>
<head>
	<title>librería</title>
<style>
table, th, td {
    border: 1px solid black;
}
th{color:blue;}
td{color:green;}
</style>
</head>
<body>
<?php 
	//Leemos la base de datos en el array estilos
	$estilos= array();
	$db = @mysqli_connect('localhost','root','','p7');
/*	if ($db) {
    echo 'Conexión realizada correctamente.<br />';
    echo 'Información sobre el servidor: ',
         mysqli_get_host_info($db),'<br />';
    echo 'Versión del servidor: ',
         mysqli_get_server_info($db),'<br />';
  } else {
    printf(
      'Error %d: %s.<br />',
      mysqli_connect_errno(),mysqli_connect_error());
  };*/
	$sql="SELECT categoria FROM categorias";
    $consulta=mysqli_query($db, $sql);
    while ($cat=mysqli_fetch_object($consulta)){
    	$estilos[]=$cat->categoria;
 //   	echo $cat->categoria;
    };
    @mysqli_close($db);
 ?>
 <form action="libros.php" method="post">
 	<p>Seleccione la categoria<p>
 	<select name="tipo">
 	<?php  
 		foreach($estilos as $codigo => $nombre){
 			echo "<option> $nombre </option> ";
 		}
 	?>
 	</select><br>
 	Valor minimo:<input type="text" name="minimo"><br>
 	Valor maximo:<input type="text" name="maximo"><br>
 	<input type="submit" value="Enviar">
 	<input type="reset" value="Borrar">
 </form>
 <?php
 	$procesando=isset($_POST['minimo'])?$_POST['minimo']:null;
	if($procesando!=null){
		echo "Libros para "; echo $_POST['tipo'];
		$libros=array();
		$tipo=$_POST['tipo'];
		$min=$_POST['minimo'];
		$max=$_POST['maximo'];
		$db = @mysqli_connect('localhost','root','','p7');
	//	if ($db) {
	//	    echo 'Conexión realizada correctamente.<br />';
	//	    echo 'Información sobre el servidor: ',
	//	         mysqli_get_host_info($db),'<br />';
	//	    echo 'Versión del servidor: ',
	//	         mysqli_get_server_info($db),'<br />';
	//	  } else {
	//	    printf(
	//	      'Error %d: %s.<br />',
	//	      mysqli_connect_errno(),mysqli_connect_error());
  	//	};
		$sql="SELECT titulo, precio FROM libros WHERE categoria='$tipo' AND precio >= '$min' AND  precio <= '$max'";
		$consulta=mysqli_query($db, $sql);
	//	if ($consulta){
	//		echo "consulta ok";
	//	}else{echo "consulta no ok";};
		echo "<table>";
		echo "<th>Titulo</th><th>Precio</th>";
		while ($lib=mysqli_fetch_object($consulta)){
			echo "<tr>";
			echo "<td>"; echo "$lib->titulo";echo "</td>";echo "<td>"; echo "$lib->precio";echo "</td>";
			echo "<tr>";
		};
    	@mysqli_close($db);
	//echo "<ul>";
	    echo "</table>";
	//	foreach($libros as $codigo => $nombre){
	//	 			echo "<li> $nombre </li>";
	//	 		};
	//    echo "</ul>";
    };
?>
</body>
</html>