<?php
require_once("config.php"); // Incluir el archivo de configuración

// Conectar a la base de datos
try {
  $id        = null; // ID de la tarea

    // Validando que exista el parametro en la url
    if (!isset($_GET["id"])) { // Si se ha pasado el ID de la tarea
        throw new Exception("No existe el equipo en la base de datos."); // Lanzar una excepción
    }
  $id        = $_GET["id"]; // ID de la tarea
  $db        = conectar(); // Conectar a la base de datos
  $sql       = "SELECT * FROM equipos WHERE id = :id LIMIT 1"; // Consulta SQL
  $sentencia = $db->prepare($sql); // Preparar la sentencia SQL
  $sentencia->bindParam("id", $id);
  $sentencia->execute(); // Ejecutar la sentencia SQL
  $equipos   = $sentencia->fetchAll(); // Obtener los resultados de la consulta

  // Validar si existe el equipo
  if (empty($equipos)) { // Si no existe el equipo
      throw new Exception("No existe elequipo en la base de datos."); // Lanzar una excepción
    }

    $equipos = $equipos[0]; // Obtener el primer equipo de la lista

  // var_dump($equipos);

} catch (Exception $e) { // Maneja la excepción
  $_SESSION["error"] = $e->getMessage(); // Guardar el mensaje de error en la sesión
  header("Location: index.php?error=true"); // redirige a la página de inicio
  exit; // termina el script
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo sprintf("Actualizando %s - Curso de PHP", $equipos["gamertag"]); ?></title>
  <!-- <link rel="stylesheet" href="css/index.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container py-5">
    <div class="row">
      <div class="col-12 col-md-6 col-lg-4">
        <?php echo mostrar_error(); ?>
        <?php echo mostrar_mensaje(); ?>
        <div class="card">
          <h3 class="card-header border-bottom-0">Actualizar equipo</h3>
          <div class="card-body">
            <form action="process_update.php" method="post">
              <!---->
              <input type="hidden" name="id" value="<?php echo $equipos["id"]; ?>">
              <div class="mb-3">
                <label class="form-label" for="gamertag">Gamertag:</label>
                <input
                value="<?php echo $equipos["gamertag"]; ?>"
                class="form-control" 
                type="text" 
                name="gamertag" 
                id="gamertag">
              </div>
              <!---->
              <div class="mb-3">
                <label class="form-label" for="nombre">Nombre:</label>
                <input
                value="<?php echo $equipos["nombre"]; ?>"
                class="form-control" 
                type="text" 
                name="nombre" 
                id="nombre">
              </div>
              <!---->
              <div class="mb-3">
                <label class="form-label" for="email">Correo electronico:</label>
                <input
                value="<?php echo $equipos["email"]; ?>"
                class="form-control" 
                type="email" 
                name="email" 
                id="email">
              </div>
              <!---->
              <div class="mb-3">
                <label class="form-label" for="juego">Seleciona un juego:</label>
                <select class="form-select" name="juego" id="juego">
                  <?php foreach (cargar_juegos() as $juego): // cargar_juegos() es una función que devuelve un array de juegos?>
                    <option value="<?php echo $juego[0] ?>"
                    <?php echo $juego[0] === $equipos["juego"] ? "selected" : null; // si el juego seleccionado es igual al juego del equipo, lo selecciono?>
                    ><?php echo $juego[1] // muestro el nombre del juego?>
                   </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <!---->
              <div class="mb-3">
                <label class="form-label" for="miembros">Numero de miembros:</label>
                <input
                value="<?php echo $equipos["miembros"]; ?>"
                class="form-control" 
                type="number" 
                name="miembros" 
                id="miembros" 
                min="1"
                max="6">
              </div>
              <!---->
              <div class="mb-3">
                <label class="form-label" for="url">Red social:</label>
                <input
                value="<?php echo $equipos["url"]; ?>"
                class="form-control" 
                type="url" 
                name="url" 
                id="url">
              </div>
              <!---->
              <div class="mb-3">
                <label class="form-label" for="color">Color del equipo:</label>
                <input
                value="<?php echo $equipos["color"]; ?>"
                class="form-control" 
                type="color" 
                name="color" 
                id="color">
              </div>
              <!---->
              <button class="btn btn-success" type="submit">Guardar cambios</button>
              <button class="btn btn-danger" type="reset">Cancelar</button>
            </form>
          </div>
        </div>
        <div class="card-footer">
          <a href="equipos.php" class="btn btn-primary btn-sm">Regresar a equipos</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>