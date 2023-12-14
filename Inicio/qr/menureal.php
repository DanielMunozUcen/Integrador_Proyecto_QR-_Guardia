<?php
session_start();
// Supongamos que $_SESSION['usuario'] contiene el nombre de usuario
if (!isset($_SESSION['usuario'])) {
    // Redirigir a la página de login.php
    header("Location: ../login.php");
    exit(); // Asegura que el script se detenga después de redirigir
}
$nombreUsuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Usuario no definido';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lector QR</title>
    <link rel="stylesheet" href="menureal.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>

<!-- Mostrar el contenido de la sesión -->
<center>
    <div class="general">
        <div class="sesion">
            <br>
            <p class="titulo">Bienvenido: <?php include 'name.php'; ?></p>
        </div>

        <h5 class = "subtitulo">Seleccione el edificio en el cual se va hacer el ingreso o egreso del usuario</h5>
        <br>
        <div class="center-container">
            <input id="check" type="checkbox">
            <label for="check" class="check-trail">
                <span class="check-handler"></span>
            </label>
        </div>

        
        <div class="botton-center">
            <input type="text" id="campo_visible" style="border: none; color: transparent;">
            <input type="hidden" name="campo_oculto" id="campo_oculto">
            <input type="hidden" name="valor" id="valorInput">
        </div>
        <br>

        <img class="logo" src="1200px-Logo_nuevo_ucen.png" alt="Logo_Nuevo_UCEN">
        <br><br><br> <br><br><br>

        <a href="../cerrar_sesion.php" class="ov-btn-slide-bottom">Cerrar sesión</a>
    </div>


</center>

<script>
    function enviarValor(valor) {

        var valorInput = document.getElementById('valorInput');
        valorInput.value = valor;

        var edificioSeleccionado = document.getElementById('check').checked ? 'B' : 'A';

    console.log('Valor capturado:', edificioSeleccionado);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'procesar.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Procesar la respuesta JSON
                var respuesta = JSON.parse(xhr.responseText);

                // Formatear la respuesta para mostrarla en SweetAlert con saltos de línea
                var mensaje = 'Rut: ' + respuesta.rut + '<br>' +
                              'Nombre: ' + respuesta.nombre + ' ' + respuesta.apellido + '<br>'+
                              'Tipo: ' + respuesta.tipo + '<br>' + 
                              'Marca: ' + respuesta.marca + '<br>' +
                              'Color: ' + respuesta.color + '<br>'
                              ;

                if (respuesta.estado == 0) {
                    titulo= '<strong>Ingreso</strong> <br>';
                } else if (respuesta.estado == 1) {
                    titulo= '<strong>Salida</strong> <br>';
                }

                // Mostrar el valor recibido en un popup con SweetAlert
                Swal.fire({
                    title: titulo,
                    html: mensaje,
                    icon: 'info',
                    confirmButtonText: 'Ok'
                });
            }
        };

        // Enviar también el valor del edificio al servidor
        xhr.send('valor=' + encodeURIComponent(valorInput.value) + '&edificio=' + encodeURIComponent(edificioSeleccionado));
    }


    document.addEventListener('DOMContentLoaded', function() {
            // Variable para almacenar la entrada del lector
            var valorLector = '';

            // Detectar la presión de teclas
            document.addEventListener('keypress', function(e) {
                // Obtener el carácter leído por el lector
                var char = String.fromCharCode(e.which);

                // Verificar si se presionó 'Enter' (código 13)
                if (e.keyCode === 13) {
                    // Procesar el valor completo al presionar 'Enter'
                    // valorLector = valorLector.replace("'", "-");
                    console.log('Valor capturado:', valorLector);

                    // Actualizar el campo visible con el valor completo
                    document.getElementById('campo_visible').value = valorLector;

                    // Actualizar el valor en el formulario oculto
                    document.getElementById('campo_oculto').value = valorLector;

                    // Reiniciar el valor del lector para la próxima lectura
                    enviarValor(valorLector);
                    valorLector = '';
                } else {
                    // Concatenar el carácter al valor existente
                    valorLector += char;
                }
                
            });
        });


</script>





</body>
</html>











   
