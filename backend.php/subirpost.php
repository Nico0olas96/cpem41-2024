<?php
include 'conexion/bd.php';

// Permitir solicitudes desde el origen de la aplicación React
header('Access-Control-Allow-Origin: http://localhost:3000');
// Otros encabezados CORS necesarios, si es necesario
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Resto del código de manejo de la solicitud aquí


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $titulo = $_POST['titulo']; 
    $descripcion = $_POST['descripcion']; 
    // Recibir y procesar la imagen si corresponde
    // Guardar la imagen en el servidor y obtener la ruta o guardarla en la base de datos como una cadena base64
    $img = ''; // Ruta de la imagen o cadena base64
    $link = $_POST['link'];
    $finalI = $_POST['finalI'];
    $createdAt = date("Y-m-d"); // Obtener la fecha actual
    
    // Insertar los datos en la base de datos
    $sql = "INSERT INTO informacion (titulo, descripcion, img, link, finalI, createdAt) 
            VALUES ('$titulo', '$descripcion', '$img', '$link', '$finalI', '$createdAt')";
    
    if ($conexion->query($sql) === TRUE) {
        // Éxito al guardar los datos
        echo json_encode(array('message' => 'Publicación subida exitosamente'));
    } else {
        // Error al guardar los datos
        echo json_encode(array('message' => 'Error al subir la publicación: ' . $conexion->error));
    }
} else {
    // Método de solicitud no válido
    echo json_encode(array('message' => 'Método de solicitud no válido'));
}

// Cerrar conexión
$conexion->close();
?>
