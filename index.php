<?php 
require_once("config.php"); // Inicia la sesión para usar $_SESSION
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
      <div class="col-12 col-md-6 col-lg-4">
        <?php echo mostrar_error(); ?>
        <?php echo mostrar_mensaje(); ?>
        <div class="card">
          <h3 class="card-header border-bottom-0">Registro de equipo</h3>
          <div class="card-body">
            
            <form action="process.php" method="post">
              <!---->
              <!-- <div class="mb-3">
                <label class="form-label" for="id">ID de usuario (invisible)</label>
                <input class="form-control" type="hidden" name="id" id="id"><br>
              </div> -->
              <!---->
              <div class="mb-3">
                <label class="form-label" for="gamertag">Gamertag:</label>
                <input class="form-control" type="text" name="gamertag" id="gamertag">
              </div>
              <!---->
              <div class="mb-3">
                <label class="form-label" for="nombre">Nombre:</label>
                <input class="form-control" type="text" name="nombre" id="nombre">
              </div>
              <!---->
              <div class="mb-3">
                <label class="form-label" for="email">Correo electronico:</label>
                <input class="form-control" type="email" name="email" id="email">
              </div>
              <!---->
              <div class="mb-3">
                <label class="form-label" for="juego">Seleciona un juego:</label>
                <select class="form-select" name="juego" id="juego">
                <?php foreach (cargar_juegos() as $juego): ?>
                    <option value="<?php echo $juego[0] ?>"><?php echo $juego[1] ?></option>
                <?php endforeach; ?>
                </select>
              </div>
              <!---->
              <div class="mb-3">
                <label class="form-label" for="miembros">Numero de miembros:</label>
                <input class="form-control" type="range" name="miembros" id="miembros" min="1" max="6" value="1">
              </div>
              <!---->
              <div class="mb-3">
                <label class="form-label" for="url">Red social:</label>
                <input class="form-control" type="url" name="url" id="url">
              </div>
              <!---->
              <div class="mb-3">
                <label class="form-label" for="color">Color del equipo:</label>
                <input class="form-control" type="color" name="color" id="color">
              </div>
              <!---->
              <button class="btn btn-success" type="submit">Registrarse</button>
              <button class="btn btn-danger" type="reset">Reiniciar</button>
            </form>
          </div>
        </div>
        <div class="card-footer">
          <a href="equipos.php" class="btn btn-primary btn-sm">Ver equipos</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>