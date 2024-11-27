<?php
require_once("config.php"); // Incluir el archivo de configuración

// Conectar a la base de datos
try {
  $db = conectar(); // Conectar a la base de datos
  $sql = "SELECT * FROM equipos ORDER BY id DESC"; // Consulta SQL
  $sentencia = $db->prepare($sql); // Preparar la sentencia SQL
  $sentencia->execute(); // Ejecutar la sentencia SQL
  $equipos = $sentencia->fetchAll(); // Obtener los resultados de la consulta

  // var_dump($equipos);

} catch (Exception $e) { // Maneja la excepción
  $_SESSION["error"] =  $e->getMessage();; // Guardar el mensaje de error en la sesión
  header("Location: index.php?error=true"); // redirige a la página de inicio
  exit; // termina el script
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- <link rel="stylesheet" href="css/index.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container py-5">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <!--  -->
        <?php
        echo mostrar_error(); // Mostrar el mensaje de error
        ?>
        <!--  -->
        <?php
        echo mostrar_mensaje(); // Mostrar el mensaje de éxito
        ?>
        <!--  -->
        <?php if (!empty($equipos)): // Si no hay equipos ?>
          <a href="index.php" class="btn btn-success float-end">Agregar equipo</a>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Gamertag</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Juegos</th>
                <th>Miembros</th>
                <th>registro</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($equipos as $equipo): // Recorre los equipos ?>
                <tr>
                  <td><?php echo $equipo["gamertag"]; ?></td>
                  <td><?php echo $equipo["nombre"]; ?></td>
                  <td><?php echo $equipo["email"]; ?></td>
                  <td><?php echo $equipo["juego"]; ?></td>
                  <td><?php echo $equipo["miembros"]; ?></td>
                  <td><?php echo date("d/M/Y", strtotime($equipo["creado"])); ?></td>
                  <td>
                    <a class="btn btn-primary btn-sm" href="<?php echo sprintf("equipo.php?id=%s", $equipo["id"]) ?>">
                      Editar
                    </a>
                    <!--  -->
                    <a class="btn btn-danger btn-sm" href="<?php echo sprintf("delete.php?id=%s", $equipo["id"]) ?>">
                      Borrar
                    </a>
                  </td>

                </tr>
              <?php endforeach; // Cierra el foreach ?>
            </tbody>
          </table>
        <?php else: ?>
          <div class="alert alert-danger text-center">No hay equipos registrados en la base de datos.</div>
        <?php endif; ?>
      </div>
    </div>
  </div>

</body>

</html>