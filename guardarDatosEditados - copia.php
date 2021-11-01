<?php

#Salir si alguno de los datos no está presente
if( !isset($_POST["placa"]) || !isset($_POST["marca"]) || !isset($_POST["tipo_vehiculo"]));

#Si todo va bien, se ejecuta esta parte del código...


include_once "base_de_datos.php";
$placa = $_POST["placa"];
$marca = $_POST["marca"];
$tipo = $_POST["tipo_vehiculo"];

$sentencia = $base_de_datos->prepare("UPDATE vehiculo SET  marca= ?, tipo_vehiculo= ? WHERE placa = ?;");
$resultado = $sentencia->execute([$placa, $marca, $tipo]); # Pasar en el mismo orden de los ?
if($resultado === TRUE) echo "Cambios guardados";
else echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del usuario";
?>