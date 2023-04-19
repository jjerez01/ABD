<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Programa Saludos</title>
	<style>
		table, th, td {
		    border: 1px solid black;
		}
	</style>
</head>
<body>
	<?php
	$db = @mysqli_connect('localhost','root','','saludos');
	$mens=isset($_POST['msg']);
	if($mens==null)
	{//Entrada a través de login
			$usuario= $_POST['usuario'];
			$pswd= $_POST['password'];
		    $sql="SELECT usuario FROM usuarios WHERE usuario = '$usuario' and password = '$pswd' ";
		    $consulta=mysqli_query($db, $sql);
		    if(mysqli_num_rows($consulta))
		    {//Autorización correcta
				$sql2="SELECT origen, texto FROM mensajes WHERE destino = '$usuario'";
				$consulta2=mysqli_query($db, $sql2);
				$n=mysqli_num_rows($consulta2);
				if($n>0)
				{//Leyendo mensajes
					echo "Hola, "; echo $_POST['usuario'];
			     	echo "<table>";
			     	echo "<tr><td>Origen</td><td>Texto</td></tr> ";
			 		for($i=0;$i<$n;$i++)
			 		{
			 			$mensajes=mysqli_fetch_object($consulta2);
			 			echo "<tr><td>$mensajes->origen</td><td>$mensajes->texto</td></tr>";	
					};
					echo "</table>";	
				}//Fin de mensajes
				else
				{
					echo "No hay mensajes" ;
				};
				echo "<form action=\"procesar.php\" method=\"post\">";
					echo "Escribe tu mensaje!!! <br>";
					echo "Selecciona destino <br>";
					$sql3="SELECT usuario FROM usuarios";
			    	$consulta3=mysqli_query($db, $sql3);
			    	echo "<select name=\"nDestino\">";
			    	while ($dest=mysqli_fetch_object($consulta3)){
			    		echo "<option> $dest->usuario </option> ";
			 		};
			 	   echo "</select><br>";
					echo "Escribe tu texto: ";
					echo "<input type=\"hidden\" name=\"nOrigen\" value=\"$usuario\">";
					echo "<input type=\"text\" name=\"msg\">";
					echo "<input type=\"submit\" value=\"enviar\">";
				echo "</form>";
		    }//Fin de autorización correcta
		    else
		    {
		    	echo "Acceso prohibido" ;
		    }
		}//Fin de entrada a través de login
	else
  	 {
  	 	$ori=$_POST['nOrigen'];
  	 	$des=$_POST['nDestino'];
  	 	$men=$_POST['msg'];
  	 	$sql4="INSERT INTO mensajes (origen, destino, texto) VALUES ('$ori','$des','$men')";
  	 	$consulta4=mysqli_query($db, $sql4);
  	 	echo "Mensaje enviado";
  	 };
    @mysqli_close($db);

 	?>
</body>
</html>