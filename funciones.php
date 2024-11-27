<?php

// crea uno conecion a la base de datos
// @return PDO
function conectar()  // funcion que conecta a la base de datos
{
    $db = require 'db.php'; // archivo de configuracion de la base de datos

    return $db; // devuelve la conexion
}
// regresa el error en caso de existir
// @return string | false
function mostrar_error() // funcion que muestra el error
{
   if (!isset($_SESSION["error"])){ // si no existe el error
    return false; // devuelve false
   } 

   $error = $_SESSION["error"]; // obtiene el error
   unset( $_SESSION["error"] ); // elimina el error de la sesion

   $html = sprintf('<div class="alert alert-danger">%s</div>', $error); // crea el mensaje de error
   return $html; // devuelve el mensaje de error
}
// regresa el error en caso de existir
// @return string | false
function mostrar_mensaje() // funcion que muestra el mensaje
{
    if (!isset($_SESSION["exito"])){ // si no existe el mensaje
        return false; // devuelve false
       } 
    
       $msj = $_SESSION["exito"]; // obtiene el mensaje
       unset( $_SESSION["exito"] ); // elimina el mensaje de la sesion
    
       $html = sprintf('<div class="alert alert-success">%s</div>', $msj); // crea el mensaje de exito
       return $html; // devuelve el mensaje de exito
}

//
// Regresa el array con los juegos disponibles
// @return array

function cargar_juegos() // carga los juegos
{
    $juegos =   // arreglo de juegos
    [
        ["Valorant"    , "Valorant"], // juego 1
        ["WZ2"         , "Warzone 2"], // juego 2
        ["LoL"         , "League of Legends"], // juego 3
        ["Overwatch 2" , "Overwatch 2"], // juego 4
        ["Apex"        , "Apex Legends"], // juego 5
    ];
    return $juegos; // devuelve los juegos
}
