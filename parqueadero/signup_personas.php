<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registrar</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="slider.css" rel="stylesheet" type="text/css" />
  </head>
  <body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Registro</h1>
    

    <form action="signup_personas.php" method="POST">
      <input name="id" type="text" placeholder="Ingresa tu numero de cedula">
      <select class="seleccion" name="Tipo_documento" required>
                    <option selected hidden value=""> Tipo documento </option>
                    <option value="administrador">Cedula ciudadania</option>
                    <option value="usuario">Cedula de extranjeria</option>
                    <option value="usuario">NIT</option>
                    <option value="usuario">Tarjeta de identidad</option>
                 </select>
      <input name="nombres" type="text" placeholder="Ingresa tu Nombres">
      <input name="apellidos" type="text" placeholder="Ingresa tu Apellidos">
      <input name="direccion" type="text" placeholder="Ingresa tu Direccion">
      <input name="telefono" type="text" placeholder="Ingresa tu Telefono">
      <input name="firma" type="text" placeholder="Ingresa tu firma">
      <input name="placa" type="text" placeholder="Ingresa la placa de tu vehiculo">
      <select class="seleccion" name="Tipo_usuario" required>
                    <option selected hidden value=""> Tipo usuario </option>
                    <option value="administrador">Ciudadano</option>
                    <option value="usuario">Administrador</option>
                    <option value="usuario">Persona </option>
                 </select> 
    </br>
    </br>
      <input type="submit" value="Registrarse">
    </form>

  </body>
  <footer>
      <?php require 'partials/footer.php' ?>
  </footer>
</html>
<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['numero']) && !empty($_POST['tipo_documento'])) {
    $sql = "INSERT INTO personas (id,tipo_documento,nombres,apellidos,direccion,telefono,firma, placa, tipo_usuario) VALUES (:id, :tipo_documento, :apellidos, :nombres, :direccion, :telefono, :firma, :placa, :tipo_usuario)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $_POST['id']);
    $stmt->bindParam(':tipo_documento', $_POST['tipo_documento']);
    $stmt->bindParam(':nombres', $_POST['nombres']);
    $stmt->bindParam(':apellidos', $_POST['apellidos']);
    $stmt->bindParam(':direccion', $_POST['direccion']);
    $stmt->bindParam(':telefono', $_POST['telefono']);
    $stmt->bindParam(':firma', $_POST['firma']);
    $stmt->bindParam(':placa', $_POST['placa']);
    $stmt->bindParam(':tipo_usuario', $_POST['tipo_usuario']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);  

    if ($stmt->execute()) {
      $message = 'Registro creado';
      header ('location:'.index.php);
    } else {
      $message = 'Lo lamentamos a ocurrido un error al registrarse';
    }
  }
?>
