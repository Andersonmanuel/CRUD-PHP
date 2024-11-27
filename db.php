<?php

// db_cursos_php_int
$conexion     = null;

try {
    // Datos para DSN o Data Source Name
    $engine       = "mysql";             // motor de base de datos
    $host         = "localhost";         // servidor
    $name         = "db_curso_php_int";  // nombre de la base de datos
    $charset      = "utf8";              // caracter

    //credenciales de acceso
    $username     = "root";  // usuario
    $password     = "";      // contraseña

    $options = 
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // modo de error
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // modo de fetch
    ];

    //Nombre de Origen de la base de datos
    // Debe ser motor:host=host;dbname=%s;charset=charset
    $dsn          = sprintf("%s:host=%s;dbname=%s;charset=%s", $engine, $host, $name, $charset); // DSN o Data Source Name
    $conexion     = new PDO($dsn, $username, $password, $options); // Conectar a la base de datos

    //para recibir excepciones en caso de errores
    //$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    // echo "La conexion se realizo correctamente"; // Si la conexión se realizó correctamente, mostrar un mensaje de confirmación.

    // $sentencia = $conexion->prepare("SELECT * FROM productos"); // Preparar la sentencia SQL
    // $sentencia->execute(); // Ejecutar la sentencia SQL

    // $resultados = $sentencia->fetchAll(); // Obtener los resultados de la sentencia SQL
    //print_r($resultados); // Mostrar los resultados de la sentencia SQL

    // if (empty($resultados)) {  // Si no hay resultados, mostrar un mensaje de confirmación.
    //     echo "No hay productos en la base de datos"; // Si no hay resultados, mostrar un mensaje de confirmación.
    // }else{  // Si hay resultados, mostrar un mensaje de confirmación.
    //     foreach ($resultados as $producto) { // Recorrer los resultados de la sentencia SQL
    //         echo sprintf("<h1>%s</h1>", $producto["nombre"]); // Mostrar el nombre del producto
    //         echo sprintf("<p>%s</p>", $producto["precio"]); // Mostrar el precio del producto
    //         echo $producto["oferta"] == 1 ? "En oferta" : "No en oferta"; // Mostrar si el producto está en oferta o no
    //         echo sprintf("<p><b>%s</b></p>", date('d-m-y H:i', strtotime($producto["creado"]))); // Mostrar la fecha de creación del producto
    //     }
    // }

    
    return $conexion; // Devolver la conexión a la base de datos
    
} catch (PDOException $e) { // Manejar la excepción PDOException
    // echo "Hubo un error con la conexion: " . $e->getMessage(); // Si la conexión falló, mostrar un mensaje de error con el mensaje
    throw new Exception(sprintf("Hubo un error con la conexion a la base de datos: %s", $e->getMessage())); // Si la conexión falló, lanzar una excepción con el mensaje de error
        
}
