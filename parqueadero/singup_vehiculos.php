<?php

  require 'database.php';

  $message = '';
  

  if (!empty($_POST['placa']) && !empty($_POST['marca'])) {
    $sql = "INSERT INTO registrar_vehiculo ( placa,marca,tipo_vehiculo) VALUES (:placa, :marca, :tipo_vehiculo)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':placa', $_POST['placa']);
    $stmt->bindParam(':marca', $_POST['marca']);
    $stmt->bindParam(':tipo_vehiculo', $_POST['tipo_vehiculo']);
    

    if ($stmt->execute()) {
      $message = 'Registro creado';
    } else {
      $message = 'Lo lamentamos a ocurrido un error al registrarse';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    
  </head>
  <body>
  <?php require 'partials/header.php' ?>

<?php if(!empty($message)): ?>
  <p> <?= $message ?></p>
<?php endif; ?>

<h1>Registro</h1>


<form action="signup_vehiculos.php" method="POST">
  <input name="placa" type="text" placeholder="Ingresa tu numero de placa">
  <input name="marca" type="text" placeholder="Ingresa la marca de tu vehiculo">
  <input name="tipo_vehiculo" type="text" placeholder="Ingresa que tipo de auto es">
  <input type="submit" value="Registarse">
</form>

</body>
<footer>
  <?php require 'partials/footer.php' ?>
</footer>
</html>