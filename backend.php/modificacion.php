<?php
include 'conexion/bd.php';

// Permitir solicitudes desde cualquier origen
header("Access-Control-Allow-Origin: *");
// Permitir los métodos HTTP especificados (POST, GET, OPTIONS, etc.)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
// Permitir ciertos encabezados en las solicitudes
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");




// Manejar la solicitud POST para subir un nuevo post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha enviado la información requerida
    if (isset($_POST['titulo']) && isset($_POST['finalI'])) {
        // Recuperar los datos del formulario
        $titulo = $_POST['titulo'];
        $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
        $link = isset($_POST['link']) ? $_POST['link'] : '';
        $finalI = $_POST['finalI'];

        // Procesar la imagen
        $imagen = $_FILES['imagen'];
        $imagen_nombre = $imagen['name'];
        $imagen_temporal = $imagen['tmp_name'];
        $imagen_destino = 'ruta/donde/guardar/imagenes/' . $imagen_nombre;

        // Mover la imagen a la ubicación deseada
        move_uploaded_file($imagen_temporal, $imagen_destino);

        // Preparar la consulta SQL para insertar el post en la tabla de Informacion
        $sql = "INSERT INTO Informacion (titulo, descripcion, link, finalI, imagen) VALUES ('$titulo', '$descripcion', '$link', '$finalI', '$imagen_destino')";

        if ($conexion->query($sql) === TRUE) {
            echo "Nuevo post agregado correctamente.";
        } else {
            echo "Error: " . $sql . "<br>" . $conexion->error;
        }
    } else {
        echo "Error: Los campos 'titulo' y 'finalI' son obligatorios.";
    }
}

// Cerrar la conexión
$conexion->close();



?>