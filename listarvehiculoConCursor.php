<?php
include_once "base_de_datos.php";
$consulta = "SELECT * FROM vehiculo";
# Preparar sentencia e indicar que vamos a usar un cursor
$sentencia = $base_de_datos->prepare($consulta, [
    PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL,
]);
# Ejecutar sin parámetros
$sentencia->execute();
# Iteramos más abajo...
?>
<!--Recordemos que podemos intercambiar HTML y PHP como queramos-->
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Tabla de ejemplo</title>
	<style>
	table, th, td {
	    border: 1px solid black;
	}
	</style>
</head>
<body>
	<table>
		<thead>
			<tr>
				<th>placa</th>
				<th>marca</th>
				<th>tipo vehiculo</th>
				<th>Editar</th>
				<th>Eliminar</th>
			</tr>
		</thead>
		<tbody>
			<!--
				Y aquí usamos el ciclo while y fecthObject, el cuerpo
                del ciclo queda intacto pero ahora estamos usando
                cursores :)
			-->
			<?php while ($persona = $sentencia->fetchObject()) {?>
			<tr>
				<td><?php echo $persona->placa ?></td>
				<td><?php echo $persona->marca ?></td>
				<td><?php echo $persona->tipo_vehiculo ?></td>
				<td><a href="<?php echo "editar - copia.php?placa=" . $persona->placa ?>">Editar</a></td>
				<td><a href="<?php echo "eliminar.php?id=" . $persona->id ?>">Eliminar</a></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
</body>
</html>