<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Informacion de usuario</title>
</head>
<body>
//<div>$Nombre; </div>
	<div> $Apellido; </div>
	<div> $id; </div>
	<div>'frontend/archivos/usuario_'.$id.'.jpg';</div>
	if(file_exists("./frontend/archivos/usuario_".$id.".jpg")): 
	<img src="'frontend/archivos/usuario_'.$id.'.jpg';" style="width: 40px; height: 40px;">
      endif;
</body>
</html>