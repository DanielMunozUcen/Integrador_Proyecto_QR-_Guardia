<?php
    session_start();
    if(isset($_SESSION['usuario'])){
        if($_SESSION['tipo_usuario'] === 'admin'){
            header("location: admin/menuadmin.php");
            exit;
        } elseif($_SESSION['tipo_usuario'] === 'guardia'){
            header("location: qr/menureal.php");
            exit;
        } else {
            // En caso de que el tipo de usuario no esté definido
            header("location: login.php");
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Título</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    function formatoAutomaticoRut() {
      var rutInput = document.getElementById("rut");
      var rutSinFormato = rutInput.value.replace(/[^\dKk]/g, ''); // Elimina cualquier caracter no numérico ni 'K'
      
      if (rutSinFormato.length <= 8) {
        rutInput.value = rutSinFormato; // No hay suficientes caracteres, no se formatea
      } else {
        var rutFormateado = rutSinFormato.replace(/^(\d{2})(\d{3})(\d{3})(\w{1})$/, '$1$2$3-$4');
        rutInput.value = rutFormateado;
      }
    }

    function SoloLetras(event) {
        var key = event.key;
        var soloNumeros = (key >= '0' && key <= '9') || key === 'K' || key === 'k' || key === '-';
        return soloNumeros;
    }
    </script>


</head>
<body>
    <div id="page" class="site login-show">
        <div class="container">
            <div class="wrappr">
                <div class="login">
                    <div class="content-heading">
                        <div class="y-style">
                            <div class="logo">
                                <img class="ImgLogoU" src="img/Logo UCEN_R.COQUIMBO_.png" alt="Logo">
                            </div>
                            <div class="welcome">
                                <h2>
                                    Estacionamiento QR<br/>
                                    para bicicletas
                                </h2>
                            </div>
                            <div class="logo">
                                <img class="ImgLogoP" src="img/QRcleta.png" alt="Logo">
                            </div>
                        </div>
                    </div>
                    <div class="content-form">
                        <div class="y-style">
                            <h1>Bienvenido</h1>
                             <!-- Formulario Iniciar Sesion -->
                            <form action="login_be.php" method="POST">
                                <div class="userInput">
                                    <div class="userInputContent">
                                        <div class="IconSide centrado">
                                            <span class="AiOutlineMail"></span>
                                        </div>

                                    <div class="InputSide centrado">
                                        <label for="exampleInputEmail1" class="form-label"></label>
                                        <input type="text" class="userInputText" name="rut" id="rut" placeholder="Ingrese RUT" oninput="formatoAutomaticoRut();"maxlength = "10 " required>
                                    </div> 
                                        

                                    </div>
                                </div>
                                <div class="userInput">
                                    <div class="userInputContent">
                                        <div class="IconSide centrado">
                                            <span class="AiOutlineLock"></span>
                                        </div>
                                        <div class="InputSide centrado">
                                            <input class="userInputText" type="password" placeholder="Ingresa tu contraseña" name="clave">
                                        </div>
                                        <div class="IconSide centrado">
                                            <!-- Aquí irá el icono de ojo (eye) -->
                                        </div>
                                    </div>
                                </div>
                                <p class="check">
                                    <input type="checkbox" id="remember">
                                    <label>Recuérdame</label>
                                </p>                               
                                <p><button class="Iniciar" type="submit">Iniciar sesión</button></p>
                            </form>
                             <!-- Envia al nuevo php restablecer contraseña -->
                            <div class="afterform">
                                <p>¿Se te olvido la contraseña?</p>
                                <!-- <a href="" class="t-signup">Registrate</a> -->
                                <a href="restablecerclave/recuperar_clave.php">Recuperala</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
        
        </div>
    </div>
    <script src="login.js"></script>
    <script>
    // Obtener el parámetro de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const correoNoEncontrado = urlParams.get('correo_no_encontrado');
    const estado = urlParams.get('estado');
    const loginok = urlParams.get('login');
    // Verificar si el parámetro está presente y es true
    if (correoNoEncontrado === 'true') {
        // Mostrar la alerta SweetAlert
        Swal.fire({
            icon: 'error',
            title: 'Correo no encontrado',
            text: 'El correo ingresado no existe. Por favor, verifica tu correo e inténtalo de nuevo.',
        });
    }
    if (correoNoEncontrado === 'false') {
        // Mostrar la alerta SweetAlert
        Swal.fire({
            icon: 'success',
            title: 'Correo encontrado',
            text: 'Verifique su Correo para restablecer su contraseña',
        });
    }
    if (estado === 'true') {
        // Mostrar la alerta SweetAlert
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: 'Contraseña se ha actualizado correctamente.',
        });
    }
    if (loginok === 'no') {
        // Mostrar la alerta SweetAlert
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Usuario o contraseña incorrectos.',
        });
    }
    </script>
</body>
</html>
