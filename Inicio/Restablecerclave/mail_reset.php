<?php
// Dirección de correo del destinatario
$email = $email; // Asegúrate de que la variable $email esté definida correctamente

// Título del correo
$título = 'Restablecer Clave Sistema Registro Entrada/Salida Bicicletas';

// Generación de un código aleatorio
$codigo = rand(1000, 9999);

// Mensaje en formato HTML
$mensaje = '
<html>
<head>
  <title>Restablecer</title>
</head>
<body>
    <h1>Universidad Central</h1>
    <div style="text-align:center; background-color:#ccc">
        <p>Restablecer contraseña</p>
        <h3>' . $codigo . '</h3>
        <p> <a href="http://localhost/xampp/Integrador/Ultimo%20avance/Inicio/restablecerclave/reset.php?email=' . $email . '&token=' . $token . '"> 
            Para restablecer da clic aquí </a> </p>
        <p> <small>Si usted no envió este código favor de omitir</small> </p>
    </div>
</body>
</html>
';

// Cabeceras del correo electrónico
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
// Puedes añadir más cabeceras si es necesario, como el remitente

// Enviar el correo
$enviado = false;
if(mail($email, $título, $mensaje, $cabeceras)){
    $enviado = true;
}
?>
