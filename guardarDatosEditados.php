<?php

#Salir si alguno de los datos no está presente
if( !isset($_POST["id"]) || !isset($_POST["documento"]) || !isset($_POST["nombre"]) || !isset($_POST["apellidos"]) || !isset($_POST["direccion"]) || !isset($_POST["telefono"]) || !isset($_POST["firma"]) || !isset($_POST["placa"]) || !isset($_POST["tipo_usuario"]));

#Si todo va bien, se ejecuta esta parte del código...


include_once "base_de_datos.php";
$id = $_POST["id"];
$documento = $_POST["documento"];
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];
$firma = $_POST["firma"];
$placa = $_POST["placa"];
$tipo = $_POST["tipo_usuario"];
$sentencia = $base_de_datos->prepare("UPDATE personas SET documento= ?, nombres= ?, apellidos= ?, direccion= ?, telefono= ?, firma= ?, placa= ?, tipo_usuario= ? WHERE id = ?;");
$resultado = $sentencia->execute([$id, $documento, $nombre, $apellidos, $direccion, $telefono, $firma, $placa, $tipo]); # Pasar en el mismo orden de los ?
if($resultado === TRUE) echo "Cambios guardados";
else echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del usuario";
?>