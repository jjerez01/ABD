<!DOCTYPE html>
<html lang="es">
<head>
	<title>Escribe tu relato</title>
	<meta charset="utf-8">
    <link rel="stylesheet" href="./css/escribeRelato.css">
</head>
<body>
	<h1>Escribe tu relato</h1>
	<form action="./conexion/process/procesaRelato.php" method="post">
		<div class="input-container">
			<label for="titulo">Titulo</label>
			<input type="text" name="titulo" id="titulo" placeholder="Escribe el titulo de tu relato">
		</div>
		<div class="input-container">
			<label for="texto">Texto</label>
			<textarea id="texto" name="texto" rows="10" cols="50" placeholder="Escribe aquí tu relato"></textarea>
		</div>
		<div class="input-container">
			<input type="submit" value="Enviar">
		</div>
	</form>
</body>
</html>


    



