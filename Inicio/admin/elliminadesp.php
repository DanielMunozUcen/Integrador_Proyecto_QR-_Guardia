<?php
session_start();
// Supongamos que $_SESSION['usuario'] contiene el nombre de usuario
$nombreUsuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Usuario no definido';
?>


hola admin


<button class= "cerrar">
            <a href="../cerrar_sesion.php" class="button">Cerrar sesión</a>
</button>
