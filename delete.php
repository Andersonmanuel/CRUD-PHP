<?php
// Inicializar la sesion
require_once "config.php";  // incluye el archivo de configuración

//Nuestros procesos...
if (!isset($_GET["id"])) { // si no hay un id en la solicitud POST
    $_SESSION["error"] = "Acceso no autorizado."; // se crea un mensaje de error
    header("Location: index.php?error=true"); // redirige a la página de inicio
    die; // termina el script
}

//  Obtenemos el id de la solicitud GET
$id       = $_GET["id"]; // id del producto

//============================================================================================================

try { // intenta ejecutar el siguiente bloque de código
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

    //Borrado del registro
    $sql       = "DELETE FROM equipos WHERE id = :id"; // Consulta SQL
    $sentencia = $db->prepare($sql); // Preparar la sentencia SQL
    $sentencia->bindParam("id", $id);
    $sentencia->execute(); // Ejecutar la sentencia SQL
   //=============================================================================================================
    $db = null; // se cierra la conexion a la base de datos

    $_SESSION["exito"] = sprintf("Se borro con éxito el equipo con ID %s", $id); // se almacena el mensaje de éxito en la sesión
    header("Location: equipos.php"); // se redirecciona a la página de equipo con el id actualizado
    die; // se termina la ejecución del script

} catch (Exception $e) { // se captura la excepción
    $_SESSION["error"] = $e->getMessage(); // se almacena el mensaje de error en la sesión
    header("Location: equipos.php?error=true"); // se redirecciona a la página de equipo con el mensaje de error
    die; // se termina la ejecución del script
}