<?php

include 'funciones.php';

if (isset($_POST['submit'])) {
 
  $resultado = [
    'error' => false,
    'mensaje' => 'medicamento agregado con éxito'
  ];
  
  $config = include 'config.php';

  try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

  } catch(PDOException $error) {
    $resultado['error'] = true;
    $resultado['mensaje'] = $error->getMessage();
  }
}
$medicamento = [
  "dirección de sucursal"   => $_POST['dirección de sucursal'],
  "nombre del empleado"     => $_POST['nombre del empleado'],
  "nombre del medicamento"  => $_POST['nombre del medicamento'],
  "número de existencias"   => $_POST['número de existencias'],
];
$consultaSQL = "INSERT INTO medicamento (dirección de sucursal, nombre del empleado, nombre del medicamento, número de existencias)";
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
      <h2 class="mt-4">Crea un medicamento</h2>
      <hr>
      <form method="post">
        <div class="form-group">
          <label for="nombre">dirección de sucursal</label>
          <input type="text" name="dirección de sucursal" id="dirección de sucursal" class="form-control">
        </div>
        <div class="form-group">
          <label for="nombre del empleado">nombre del empleado</label>
          <input type="text" name="nombre del empleado" id="nombre del empleado" class="form-control">
        </div>
        <div class="form-group">
          <label for="nombre del medicamento">nombre del medicamento</label>
          <input type="text" name="nombre del medicamento" id="nombre del medicamento" class="form-control">
        </div>
        <div class="form-group">
          <label for=número de existencias">número de existencias</label>
          <input type="number" name="número de existencias" id="número de existencias" class="form-control">
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
