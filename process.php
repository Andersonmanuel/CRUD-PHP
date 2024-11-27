<?php
// Inicializar la sesion
require_once "config.php";  // incluye el archivo de configuración

//Nuestros procesos...
if (!isset($_POST["gamertag"])) { // si no hay un campo llamado gamertag en el POST 
    $_SESSION["error"] = "Acceso no autorizado."; // se crea un mensaje de error
    header("Location: index.php?error=true"); // redirige a la página de inicio
    exit; // termina el script
}

// $_SESSION["exito"] = "Este es un mensaje de exito.";
// header("location: index.php");
// exit;

try { // intenta ejecutar el código dentro de la sentencia try 
    //informacion a ser insertada
    //$_POST = array_map('trim', $_POST); // limpia los campos del POST
    $gamertag = trim($_POST["gamertag"]); // se limpia el campo gamertag
    $nombre   = trim($_POST["nombre"]); // se limpia el campo nombre
    $email    = trim($_POST["email"]); // se limpia el campo email
    $juego    = trim($_POST["juego"]); // se limpia el campo juego
    $miembros = trim($_POST["miembros"]); // se limpia el campo miembros
    $url      = trim($_POST["url"]); // se limpia el campo url
    $color    = trim($_POST["color"]); // se limpia el campo color

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

    $sql = "INSERT INTO equipos  
    ( gamertag, nombre, email, juego, miembros, url, color)
    VALUES 
    (:gamertag, :nombre, :email, :juego, :miembros, :url, :color)"; // se crea la sentencia SQL

    $sentencia = $db->prepare($sql); // se prepara la sentencia SQL

    //
    $sentencia->bindParam("gamertag", $gamertag); // se vincula el campo gamertag
    $sentencia->bindParam("nombre", $nombre); // se vincula el campo nombre
    $sentencia->bindParam("email", $email); // se vincula el campo email
    $sentencia->bindParam("juego", $juego); // se vincula el campo juego
    $sentencia->bindParam("miembros", $miembros); // se vincula el campo miembros
    $sentencia->bindParam("url", $url); // se vincula el campo url
    $sentencia->bindParam("color", $color);  // se vincula el campo color

    $sentencia->execute(); // se ejecuta la sentencia SQL

    // Para obtener el ID del registro insertado
    $id_equipo = $db->lastInsertId(); // se obtiene el ID del registro insertado

    // Cierre la conexion a la db
    $db = null; // se cierra la conexion a la base de datos

    $_SESSION["exito"] = sprintf("Se agregó con éxito con ID %s", $id_equipo); // se almacena el mensaje de éxito en la sesión
    header("Location: index.php"); // se redirecciona a la página de inicio
    exit; // se termina la ejecución del script

} catch (Exception $e) { // se captura la excepción
    $_SESSION["error"] = $e->getMessage(); // se almacena el mensaje de error en la sesión
    header("Location: index.php?error=true"); // se redirecciona a la página de inicio con el mensaje de error
    exit; // se termina la ejecución del script
}