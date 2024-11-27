<?php
// Inicializar la sesion
require_once "config.php";  // incluye el archivo de configuración

//Nuestros procesos...
if (!isset($_POST["id"])) { // si no hay un id en la solicitud POST
    $_SESSION["error"] = "Acceso no autorizado."; // se crea un mensaje de error
    header("Location: index.php?error=true"); // redirige a la página de inicio
    exit; // termina el script
}

// informacion a ser insertada
$_POST = array_map('trim', $_POST); // limpia los datos de la solicitud POST

$id       = $_POST["id"]; // obtiene el id de la solicitud POST
$gamertag = $_POST["gamertag"]; // obtiene el gamertag de la solicitud POST
$nombre   = $_POST["nombre"]; // obtiene el nombre de la solicitud POST
$email    = $_POST["email"]; // obtiene el email de la solicitud POST
$juego    = $_POST["juego"]; // obtiene el juego de la solicitud POST
$miembros = $_POST["miembros"]; // obtiene el número de miembros de la solicitud POST
$url      = $_POST["url"]; // obtiene la url de la solicitud POST
$color    = $_POST["color"]; // obtiene el color de la solicitud POST

try { // intenta ejecutar el siguiente bloque de código
    // Validar el gamertag
    if (strlen($gamertag) < 5) { // si el gamertag tiene menos de 5 caracteres
        throw new Exception("Tu gamertag no es Válido."); // se lanza una excepción
    } 

    // validar el email del usuario
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // si el email no es válido
        throw new Exception("Ingresa un correo electronico válido."); // se lanza una excepción
    }

    // Nueva conexion a la base de datos
    $db = conectar(); // se conecta a la base de datos

    $sql = "UPDATE equipos 
    SET 
    gamertag = :gamertag,
    nombre = :nombre,
    email = :email,
    juego = :juego,
    miembros = :miembros,
    url = :url,
    color = :color
    WHERE id = :id"; // se crea la consulta SQL

    $sentencia = $db->prepare($sql); // se prepara la sentencia SQL

    //Bind de cada columna con su valor
    $sentencia->bindParam("id"       , $id); // se asocia el id con la columna id
    $sentencia->bindParam("gamertag" , $gamertag); // se vincula el campo gamertag
    $sentencia->bindParam("nombre"   , $nombre); // se vincula el campo nombre
    $sentencia->bindParam("email"    , $email); // se vincula el campo email
    $sentencia->bindParam("juego"    , $juego); // se vincula el campo juego
    $sentencia->bindParam("miembros" , $miembros); // se vincula el campo miembros
    $sentencia->bindParam("url"      , $url); // se vincula el campo url
    $sentencia->bindParam("color"    , $color);  // se vincula el campo color

    $sentencia->execute(); // se ejecuta la sentencia SQL

    // Cierre la conexion a la db
    $db = null; // se cierra la conexion a la base de datos

    $_SESSION["exito"] = sprintf("Se actualizo con éxito el equipo con ID %s", $id); // se almacena el mensaje de éxito en la sesión
    header(sprintf("Location: equipo.php?id=%s", $id)); // se redirecciona a la página de equipo con el id actualizado
    exit; // se termina la ejecución del script

} catch (Exception $e) { // se captura la excepción
    $_SESSION["error"] = $e->getMessage(); // se almacena el mensaje de error en la sesión
    header(sprintf("Location: equipo.php?id=%s&error=true", $id)); // se redirecciona a la página de equipo con el mensaje de error
    exit; // se termina la ejecución del script
}