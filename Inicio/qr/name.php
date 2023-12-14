<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion_be.php';

// Supongamos que $_SESSION['usuario'] contiene el nombre de usuario
$nombreUsuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Usuario no definido';

// Consulta SQL para obtener el nombre completo del usuario
$query = "SELECT CONCAT(nombre, ' ', apellido) as nom FROM usuario WHERE rut='$nombreUsuario'";

// Ejecutar la consulta
$resultado = mysqli_query($conexion, $query);

if ($resultado) {
    // Verificar si se encontraron resultados
    if (mysqli_num_rows($resultado) > 0) {
        // Obtener el nombre completo del usuario
        $fila = mysqli_fetch_assoc($resultado);
        $nombreCompleto = $fila['nom'];
    } else {
        // Si no se encontraron resultados
        $nombreCompleto = 'Usuario no encontrado'; // Asignar un mensaje de usuario no encontrado
    }
    // Liberar el resultado
    mysqli_free_result($resultado);
} else {
    // Si hay un error en la consulta
    $nombreCompleto = 'Error en la consulta'; // Asignar un mensaje de error
}
// Cerrar la conexión a la base de datos (si es necesario)
mysqli_close($conexion);

// Devolver el nombre completo del usuario
echo $nombreCompleto;
?>