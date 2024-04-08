<?php
// Incluir el archivo bd.php que contiene la conexión a la base de datos
include 'conexion/bd.php';

header("Access-Control-Allow-Origin: http://localhost:3000");

// Consulta SQL para obtener los datos de la tabla 'Informacion'
$sql = "SELECT * FROM `informacion`";

$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    // Convertir los datos en un array asociativo
    $data = array();
    while($row = $result->fetch_assoc()) {
        $imgData = base64_encode($row['img']);
        // Construir un nuevo array con la imagen codificada en base64
        $row['img'] = $imgData;
        $data[] = $row;
    }
    
    // Devolver los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    echo "No se encontraron registros";
}

// Cerrar la conexión (si es necesario)
$conexion->close();
?>
