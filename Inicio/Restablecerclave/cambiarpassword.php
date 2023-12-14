<?php 
    include "conexion_be.php";
    $email = $_POST['email'];
    $p1 = $_POST['p1'];
    $p2 = $_POST['p2'];

    if ($p1 == $p2) {
        // Encriptación de contraseña
        $p1 = hash('sha512', $p1);
        $conexion->query("UPDATE usuario SET clave='$p1' WHERE correo='$email'") or die($conexion->error);
        
        // Redirigir a login.php con un parámetro para mostrar la alerta
        header("Location: ../login.php?estado=true");
        exit();
    } else {
        exit();
    }
?>