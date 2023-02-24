<?php

include 'funciones.php';

if (isset($_POST['submit'])) {
 
  $resultado = [
    'error' => false,
    'mensaje' => 'Usuario agregado con éxito'
  ];
  
  $config = include 'config.php';

  try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    // Código que insertará un alumno

  } catch(PDOException $error) {
    $resultado['error'] = true;
    $resultado['mensaje'] = $error->getMessage();
  }
}
$empleado = [
  "nombre"   => $_POST['nombre'],
  "apellido" => $_POST['apellido'],
  "email"    => $_POST['email'],
  "teléfono "=> $_POST['teléfono'],
];
$consultaSQL = "INSERT INTO empleados (nombre, apellido, email, telefono)";
    $consultaSQL .= "values (:" . implode(", :", array_keys($empleado)) . ")";
    
    $sentencia = $conexion->prepare($consultaSQL);
    $sentencia->execute($empleado);

  } catch(PDOException $error) {
    $resultado['error'] = true;
    $resultado['mensaje'] = $error->getMessage();
  }
}
?>

<?php include "templates/header.php"; ?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-4">Crea un Empleado</h2>
      <hr>
      <form method="post">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" id="nombre" class="form-control">
        </div>
        <div class="form-group">
          <label for="apellido">Apellido</label>
          <input type="text" name="apellido" id="apellido" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
          <label for="teléfono">Teléfono</label>
          <input type="text" name="teléfono" id="teléfono" class="form-control">
        </div>
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-primary" value="Enviar">
          <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include "templates/footer.php"; ?>
