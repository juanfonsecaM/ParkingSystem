<?php
#Salir si alguno de los datos no está presente
if( !isset($_POST["id"]) || !isset($_POST["documento"]) || !isset($_POST["nombre"]) || !isset($_POST["apellidos"]) || !isset($_POST["direccion"]) || !isset($_POST["telefono"]) || !isset($_POST["firma"]) || !isset($_POST["placa"]) || !isset($_POST["Tipo_usuario"]));

#Si todo va bien, se ejecuta esta parte del código...

$documento=$_POST["documento"];

include_once "base_de_datos.php";
$id = $_POST["id"];
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];
$firma = $_POST["firma"];
$placa = $_POST["placa"];
$tipo = $_POST["Tipo_usuario"];

/*
	Al incluir el archivo "base_de_datos.php", todas sus variables están
	a nuestra disposición. Por lo que podemos acceder a ellas tal como si hubiéramos
	copiado y pegado el código
*/
$sentencia = $base_de_datos->prepare("INSERT INTO personas(id, documento, nombres, apellidos, direccion, telefono, firma, placa, tipo_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);");
$resultado = $sentencia->execute([$id, $documento, $nombre, $apellidos, $direccion, $telefono, $firma, $placa, $tipo]); # Pasar en el mismo orden de los ?

#execute regresa un booleano. True en caso de que todo vaya bien, falso en caso contrario.
#Con eso podemos evaluar

if($resultado === TRUE) echo "Insertado correctamente";

else echo "Algo salió mal. Por favor verifica que la tabla exista";


?>