<?php
include 'conexion/bd.php';

try {
    // Consultar todos los registros de la tabla informacion
    $sql = "SELECT * FROM `informacion`";
    $result = $conexion->query($sql);

    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        // Almacenar los resultados en un array
        $informacion = array();
        
        while ($row = $result->fetch_assoc()) {
            // Codificar la imagen en base64
            $imgData = base64_encode($row['img']);
            // Construir un nuevo array con la imagen codificada en base64
            $row['img'] = $imgData;
            $informacion[] = $row;
        }

        // Devolver los datos en formato JSON
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        echo json_encode($informacion);
    } else {
        // No se encontraron resultados
        echo json_encode(array('message' => 'No se encontraron resultados'));
    }

} catch (Exception $e) {
    // Ocurrió un error
    echo json_encode(array('message' => $e->getMessage()));
}

// Cerrar conexión
$conexion->close();



?>
