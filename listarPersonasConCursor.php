<?php
include_once "base_de_datos.php";
$consulta = "SELECT * FROM personas";
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
				<th>id</th>
				<th>documento</th>
				<th>nombres</th>
				<th>apellidos</th>
				<th>direccion</th>
				<th>telefono</th>
				<th>firma</th>
				<th>placa</th>
				<th>tipo</th>
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
				<td><?php echo $persona->id ?></td>
				<td><?php echo $persona->documento ?></td>
				<td><?php echo $persona->nombres ?></td>
				<td><?php echo $persona->apellidos ?></td>
				<td><?php echo $persona->direccion?></td>
				<td><?php echo $persona->telefono?></td>
				<td><?php echo $persona->firma?></td>
				<td><?php echo $persona->placa?></td>
				<td><?php echo $persona->tipo_usuario?></td>
				<td><a href="<?php echo "editar.php?id=" . $persona->id ?>">Editar</a></td>
				<td><a href="<?php echo "eliminar.php?id=" . $persona->id ?>">Eliminar</a></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
</body>
</html>