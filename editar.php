<?php
if(!isset($_GET["id"]));
$id = $_GET["id"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM personas WHERE id = ?;");
$sentencia->execute([$id]);
$persona = $sentencia->fetch(PDO::FETCH_OBJ);
if($persona === FALSE){
	echo "¡No existe alguna persona con ese ID!";
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registrar persona</title>
</head>
<body>
	<form method="post" action="guardarDatosEditados.php">
        <input name="id" type="hidden" placeholder="id" value="<?php echo $persona->id; ?>">
      </br>
      <label for="documento">documento:</label>
    </br>
      <input value="<?php echo $persona->documento; ?>"name="documento" required type="text" id="documento" placeholder>
      </br>

       <label for="nombres">documento:</label>
    </br>
      <input value="<?php echo $persona->nombres; ?>"name="nombre" required type="text" id="nombre" placeholder>
      </br>

       <label for="apellidos">documento:</label>
    </br>
      <input value="<?php echo $persona->apellidos; ?>"name="apellidos" required type="text" id="apellidos" placeholder>
      </br>

       <label for="direccion">documento:</label>
    </br>
      <input value="<?php echo $persona->direccion; ?>"name="direccion" required type="text" id="direccion" placeholder>
      </br>

       <label for="telefono">documento:</label>
    </br>
      <input value="<?php echo $persona->telefono; ?>"name="telefono" required type="text" id="telefono" placeholder>
      </br>

       <label for="firma">documento:</label>
    </br>
      <input value="<?php echo $persona->firma; ?>"name="firma" required type="text" id="firma" placeholder>
      </br>

       <label for="placa">documento:</label>
    </br>
      <input value="<?php echo $persona->placa; ?>"name="placa" required type="text" id="placa" placeholder>
      </br>

       <label for="tipo_usuario">documento:</label>
    </br>
      <input value="<?php echo $persona->tipo_usuario; ?>"name="tipo_usuario" required type="text" id="tipo_usuario" placeholder>
    </br>
		<br><br><input type="submit" value="Guardar cambios">
	</form>
</body>
</html>