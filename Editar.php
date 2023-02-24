<?php
include 'funciones.php';

$config = include 'config.php';

$resultado = [
  'error' => false,
  'mensaje' => ''
];

if (!isset($_GET['id'])) {
  $resultado['error'] = true;
  $resultado['mensaje'] = 'El medicamento no existe';
}

if (isset($_POST['submit'])) {
  try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

    $medicamento = [
      "id"                       => $_GET['id'],
      "dirección de sucursal"    => $_POST['dirección de sucursal'],
      "nombre del empleado"      => $_POST['nombre del empleado'],
      "nombre del medicamento"   => $_POST['nombre del medicamento'],
      "número de existencias"    => $_POST['número de existencias']
    ];
    
    $consultaSQL = "UPDATE medicamento SET
        dirección de sucursal = :dirección de sucursal,
        nombre del empleado = :nombre del empleado,
        nombre del medicamento = :nombre del medicamento,
        número de existencias = :número de existencias,
        updated_at = NOW()
        WHERE id = :id";
    
    $consulta = $conexion->prepare($consultaSQL);
    $consulta->execute($medicamento);

  } catch(PDOException $error) {
    $resultado['error'] = true;
    $resultado['mensaje'] = $error->getMessage();
  }
}

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
    
  $id = $_GET['id'];
  $consultaSQL = "SELECT * FROM medicamento WHERE id =" . $id;

  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  $medicamento = $sentencia->fetch(PDO::FETCH_ASSOC);

  if (!$medicamento) {
    $resultado['error'] = true;
    $resultado['mensaje'] = 'No se ha encontrado el medicamento';
  }

} catch(PDOException $error) {
  $resultado['error'] = true;
  $resultado['mensaje'] = $error->getMessage();
}
?>

<?php require "templates/header.php"; ?>

<?php
if ($resultado['error']) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= $resultado['mensaje'] ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

<?php
if (isset($_POST['submit']) && !$resultado['error']) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-success" role="alert">
          El medicamento ha sido actualizado correctamente
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

<?php
if (isset($medicamento) && $medicamento) {
  ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="mt-4">Editando el medicamento<?= escapar($medicamento['nombre del medicamento']) . ' ' . escapar($medicamento['nemero de existencias'])  ?></h2>
        <hr>
        <form method="post">
          <div class="form-group">
            <label for="dirección de sucursal">dirección de sucursal</label>
            <input type="text" name="dirección de sucursal" id="dirección de sucursal" value="<?= escapar($medicamento['dirección de sucursal']) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="Nombre del empleado">Nombre del empleado</label>
            <input type="text" name="Nombre del empleado" id="Nombre del empleado" value="<?= escapar($medicamento['Nombre del empleado']) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="nombre del medicamento">nombre del medicamento</label>
            <input type="text" name="nombre del medicamento" id="nombre del medicamento" value="<?= escapar($medicamento['nombre del medicamento']) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="número de existencias">número de existencias</label>
            <input type="number" name="número de existencias" id="número de existencias" value="<?= escapar($medicamento['número de existencias']) ?>" class="form-control">
          </div>
          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Actualizar">
            <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php
}
?>

<?php require "templates/footer.php"; ?>
