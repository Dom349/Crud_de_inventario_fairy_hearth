<?php
include 'funciones.php';

$error = false;
$config = include 'config.php';

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

  $consultaSQL = "SELECT * FROM empleados";

  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  $medicamento = $sentencia->fetchAll();

} catch(PDOException $error) {
  $error= $error->getMessage();
}
?>

<?php include "templates/header.php"; ?>

<?php
if ($error) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= $error ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

<?php include "templates/header.php"; ?>
  <div class="container">
  <div class="row">
    <div class="col-md-12">
      <a href="crear.php"  class="btn btn-primary mt-4">Crear medicamento</a>
      <hr>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-3">Lista de medicamentos</h2>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nom del empleado</th>
            <th>Nom del medicamento</th>
            <th>NUM de existencias</th>
            <th>di de sucursal</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($medicamento && $sentencia->rowCount() > 0) {
            foreach ($medicamento as $fila) {
              ?>
              <tr>
                <td><?php echo escapar($fila["id"]); ?></td>
                <td><?php echo escapar($fila["nombre del empleado"]); ?></td>
                <td><?php echo escapar($fila["nombre del medicamento"]); ?></td>
                <td><?php echo escapar($fila["número de existencias"]); ?></td>
                <td><?php echo escapar($fila["dirección de sucursal"]); ?></td>
              </tr>
              <?php
            }
          }
          ?>
        <tbody>
      </table>
    </div>
  </div>
</div>
<?php include "templates/footer.php"; ?>
