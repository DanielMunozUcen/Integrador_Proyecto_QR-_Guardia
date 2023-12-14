<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Título</title>
    <link rel="stylesheet" href="recuperar_clave.css">
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
                            </div>
                        </div>
                    </div>
                    <div class="content-form">
                        <div class="y-style">
                            <h1>Restablecer Contraseña</h1>
                            <br>
                            <form action="restablecer.php" method="POST">
                                <div class="userInput">
                                    <div class="userInputContent">
                                        <div class="IconSide centrado">
                                            <span class="AiOutlineMail"></span>
                                        </div>
                                        <div class="InputSide centrado">
                                            
                                            <input class="userInputText" type="email" placeholder="Ingresa tu correo" name="email">
                                        </div>
                                    </div>
                                </div>                               
                                <p><button class="Iniciar" type="submit">Aceptar</button></p>
                                <p><a href="http://localhost/inicio/login.php" class="Iniciar">Volver a iniciar sesión</a></p>

                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div>
            
        </div>
    </div>
</body>
</html>
