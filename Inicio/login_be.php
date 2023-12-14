<?php

session_start();
include 'conexion_be.php';

$rut = $_POST['rut'];
$clave = $_POST['clave'];
$clave = hash('sha512', $clave);

$consulta_usuario = "SELECT * FROM usuario WHERE rut='$rut' and clave='$clave'";
$validar_login = mysqli_query($conexion, $consulta_usuario);

if(mysqli_num_rows($validar_login) > 0){
    // Obtener información del usuario
    $info_usuario = mysqli_fetch_assoc($validar_login);
    
    // Consultar si es administrador
    $consulta_admin = "SELECT * FROM admin WHERE rut_adm='$rut'";
    $es_admin = mysqli_query($conexion, $consulta_admin);
    
    // Consultar si es guardia
    $consulta_guardia = "SELECT * FROM guardia WHERE rut_g='$rut'";
    $es_guardia = mysqli_query($conexion, $consulta_guardia);
    
    if(mysqli_num_rows($es_admin) > 0){
        $_SESSION['usuario'] = $rut;
        $_SESSION['tipo_usuario'] = 'admin';
        header("location: admin/menuadmin.php");
        exit;
    } elseif(mysqli_num_rows($es_guardia) > 0){
        $_SESSION['usuario'] = $rut;
        $_SESSION['tipo_usuario'] = 'guardia';
        header("location: qr/menureal.php");
        exit;
    } else {
        echo'
        <script>
            alert("Usuario no registrado como administrador o guardia");
            window.location = "login.php";
        </script>
        ';
        exit;
    }
} else {
    echo'
    <script>
        window.location = "login.php?login=no";
    </script>
    ';
    exit;
}

?>