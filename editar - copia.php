<?php
if(!isset($_GET["placa"]));
$id = $_GET["placa"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM vehiculo WHERE placa = ?;");
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
	<title>Registrar vehiculo</title>
</head>
<body>
	<form method="post" action="guardarDatosEditados - copia.php">
        <input name="placa" type="hidden" placeholder="placa" value="<?php echo $persona->persona; ?>">
      </br>
      <label for="marca">marca:</label>
    </br>
      <input value="<?php echo $persona->marca; ?>"name="marca" required type="text" id="marca" placeholder>
      </br>

       <label for="tipo_vehiculo">tipo_vehiculo:</label>
    </br>
      <input value="<?php echo $persona->tipo_vehiculo; ?>"name="tipo_vehiculo" required type="text" id="tipo_vehiculo" placeholder>
      </br>
		<br><br><input type="submit" value="Guardar cambios">
	</form>
</body>
</html>