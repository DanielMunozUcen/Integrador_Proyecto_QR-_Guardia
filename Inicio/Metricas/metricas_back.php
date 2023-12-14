<?php
$conexion = mysqli_connect("localhost", "root", "", "integrador_proyecto");

if ($conexion) {
    if (isset($_GET['fecha'])) {
        $fecha_deseada = $_GET['fecha'];

        // Realizar la consulta para obtener las métricas filtradas por fecha
        $query = "SELECT edificio, COUNT(tipo) AS total_ingresos 
                  FROM ingreso_egreso 
                  WHERE tipo = 'ingreso' AND fecha = '$fecha_deseada' 
                  GROUP BY edificio";
    
        $resultado = mysqli_query($conexion, $query);

        if ($resultado) {
            // Procesar los resultados y almacenarlos en un array
            $metricas = array();
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $metricas[] = array(
                    'edificio' => $fila['edificio'],
                    'total_ingresos' => $fila['total_ingresos']
                );
            }

            // Liberar el resultado
            mysqli_free_result($resultado);

            // Cerrar la conexión a la base de datos
            mysqli_close($conexion);

            // Enviar los datos al frontend como JSON
            header('Content-Type: application/json');
            echo json_encode($metricas);
            exit();
        } else {
            // Manejar el error en la consulta
            echo "Error en la consulta: " . mysqli_error($conexion);
        }
    } else {
        // Si no se proporciona una fecha, realizar la consulta sin filtro de fecha
        $query = "SELECT edificio, COUNT(tipo) AS total_ingresos 
                  FROM ingreso_egreso 
                  WHERE tipo = 'ingreso' 
                  GROUP BY edificio";
    
        $resultado = mysqli_query($conexion, $query);

        if ($resultado) {
            // Procesar los resultados y almacenarlos en un array
            $metricas = array();
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $metricas[] = array(
                    'edificio' => $fila['edificio'],
                    'total_ingresos' => $fila['total_ingresos']
                );
            }

            // Liberar el resultado
            mysqli_free_result($resultado);

            // Cerrar la conexión a la base de datos
            mysqli_close($conexion);

            // Enviar los datos al frontend como JSON
            header('Content-Type: application/json');
            echo json_encode($metricas);
            exit();
        } else {
            // Manejar el error en la consulta
            echo "Error en la consulta: " . mysqli_error($conexion);
        }
    }
} else {
    // Manejar el error en la conexión
    echo "Error en la conexión a la base de datos";
}
?>
