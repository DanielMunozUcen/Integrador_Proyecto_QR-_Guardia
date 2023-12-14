<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $valorRecibido = isset($_POST['valor']) ? $_POST['valor'] : '';
    $edificioRecibido = isset($_POST['edificio']) ? $_POST['edificio'] : '';

    // Parámetros de conexión a la base de datos
    $db_host = '127.0.0.1';
    $db_port = '3306';
    $db_database = 'integrador_proyecto';
    $db_username = 'root';
    $db_password = '';

    // Conexión a la base de datos
    $conn = new mysqli($db_host, $db_username, $db_password, $db_database);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    //PRUEBA
    // Verificar si el valor tiene el formato específico
    if (preg_match('/httpsÑ--portal\.sidiv\.registrocivil\.cl-docstatus_RUN¿\d+\'\d+\/type¿CEDULA\/serial¿\d+\/mrz¿\d+/', $valorRecibido)) {
        // Extraer el número deseado
        $pattern = "/(?<=¿)\d+'\d+/";
        preg_match($pattern, $valorRecibido, $matches);

        if (isset($matches[0])) {
            $textoDeseado = $matches[0];

            // Transformar el número al formato 9999999-9
            $textoTransformado = str_replace("'", "-", $textoDeseado);
            $valorRecibido = $textoTransformado;  
        }
    }else{
        $valorRecibido = str_replace("'", "-", $valorRecibido);
    }

    //FIN PRUEBA
    // Consultar la tabla estudiante
    $query = "SELECT * FROM estudiante WHERE rut_e = '$valorRecibido'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Si el estudiante existe, realizar otra consulta a la tabla usuario
        $usuarioQuery = "SELECT * FROM usuario 
                        inner join transporte on transporte.rut_e=usuario.rut
                        WHERE rut = '$valorRecibido'";
        $usuarioResult = $conn->query($usuarioQuery);

        if ($usuarioResult->num_rows > 0) {
            // Obtener los datos del usuario
            $usuarioData = $usuarioResult->fetch_assoc();
            // Realizar el insert en la tabla ingreso_egreso
            $rutEstudiante = $usuarioData['rut'];
            $rutGuardia = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Usuario no definido';
            $fechaActual = date('Y-m-d');
            $horaActual = date('H:i:s');
            $estado = ($usuarioData['estado'] == 0) ? 'ingreso' : 'egreso';


            $insertQuery = "INSERT INTO ingreso_egreso (rut_e, rut_g, fecha, hora, edificio, tipo) VALUES ('$rutEstudiante', '$rutGuardia', '$fechaActual', '$horaActual', '$edificioRecibido','$estado')";
            $conn->query($insertQuery);

            // Modificar el estado del usuario
            $nuevoEstado = ($usuarioData['estado'] == 0) ? 1 : 0;
            $updateEstadoQuery = "UPDATE usuario SET estado = '$nuevoEstado' WHERE rut = '$valorRecibido'";
            $conn->query($updateEstadoQuery);

            // Devolver los datos del usuario
            echo json_encode($usuarioData);
        } else {
            // No se encontró un usuario con el rut dado
            echo "Usuario no encontrado";
        }
    } else {
        // No se encontró un estudiante con el rut dado
        echo "Estudiante no encontrado";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Redirigir si se accede directamente a este archivo sin un formulario POST
    header('Location: index.php');
    exit();
}
?>