<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['registrar_personas'])) {
    $records = $conn->prepare('SELECT numero, tipo_documento, apellidos, nombres, direccion, telefono, firma FROM registrar_personas WHERE numero = :numero');
    $records->bindParam(':numero', $_SESSION['registrar_personas']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Bienvenido al ingreso de nuestro parqueadero</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="slider.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <?php require 'partials/header.php' ?>
    <?php if(!empty($user)): ?>
      <br> Bienvenido. <?= $user['nombre']; ?>
      <br>Haz ingresado correctamente
      <a href="logout.php">
        Desconectarse
      </a>
    <?php else: ?>
    <?php endif; ?>
    

  </body>
  <footer>
      <?php require 'partials/footer.php' ?>
  </footer>
</html>
