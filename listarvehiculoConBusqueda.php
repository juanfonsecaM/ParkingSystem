<?php
include_once "base_de_datos.php";

# Por defecto hacemos la consulta de todas las personas
$consulta = "SELECT * FROM vehiculo";

# Vemos si hay búsqueda
$busqueda = null;
if (isset($_GET["busqueda"])) {
    # Y si hay, búsqueda, entonces cambiamos la consulta
    # Nota: no concatenamos porque queremos prevenir inyecciones SQL
    $busqueda = $_GET["busqueda"];
    $consulta = "SELECT * FROM vehiculo WHERE placa LIKE ?";
}
# Preparar sentencia e indicar que vamos a usar un cursor
$sentencia = $base_de_datos->prepare($consulta, [
    PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL,
]);
# Aquí comprobamos otra vez si hubo búsqueda, ya que tenemos que pasarle argumentos al ejecutar
# Si no hubo búsqueda, entonces traer a todas las personas (mira la consulta de la línea 5)
if ($busqueda === null) {
    # Ejecutar sin parámetros
    $sentencia->execute();
} else {
    # Ah, pero en caso de que sí, le pasamos la búsqueda
    # Un arreglo que nomás llevará la búsqueda con % al inicio y al final
    $parametros = ["%$busqueda%"];
    $sentencia->execute($parametros);
}
# Sin importar si hubo búsqueda o no, se nos habrá devuelto un cursor que iteramos más abajo...
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
    <!--
        Un formulario que únicamente permite buscar. Se envía
        a este mismo script y se hace con GET
    -->
    <form action="listarvehiculoConBusqueda.php" method="GET">
    <!--
        Fíjate en el atributo name="busqueda", pues esa variable
        la estamos obteniendo de $_GET allá arriba

    -->
        <input type="text" placeholder="busqueda por placa" name="busqueda">
        <br>
        <br>
        <button type="submit">Buscar</button>
        <br>
        <br>
    </form>
	<table>
		<thead>
			<tr>
				<th>placa</th>
				<th>marca</th>
				<th>tipo vehiculo</th>
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
			</tr>
			<?php }?>
		</tbody>
	</table>
</body>
</html>