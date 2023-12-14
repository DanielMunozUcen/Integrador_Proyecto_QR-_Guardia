<?php 
    include "conexion_be.php";
    $email =$_POST['email'];
    $token =$_POST['token'];
    $codigo =$_POST['codigo'];
    $res=$conexion->query("select * from passwords where 
        correo='$email' and token='$token' and codigo=$codigo")or die($conexion->error);
    $correcto=false;
    if(mysqli_num_rows($res) > 0){
        $fila = mysqli_fetch_row($res);
        $fecha =$fila[4];
        $fecha_actual=date("Y-m-d h:m:s");
        $seconds = strtotime($fecha_actual) - strtotime($fecha);
        $minutos=$seconds / 60;
        $correcto=true;
    }else{
        $correcto=false;
    }
   
   

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar password</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <link rel="stylesheet" href="verificartoken.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-md-center" style="margin-top:15%">
            <?php if($correcto){ ?>
                <form class="col-3" action="cambiarpassword.php" method="POST" onsubmit="return validarContraseñas(event)">
                    <h2>Restablecer contraseña</h2>
                    <div class="mb-3">
                        <label for="password" class="form-label">Nueva contraseña</label>
                        <input type="password" class="form-control" id="password" name="p1">
                    </div>
                    <div class="mb-3">
                        <label for="confirm-password" class="form-label">Confirmar contraseña</label>
                        <input type="password" class="form-control" id="confirm-password" name="p2">
                        <input type="hidden" class="form-control" id="email" name="email" value="<?php echo $email?>">
                    </div>
                    <button type="submit" class="btn btn-primary" id="submitButton">Cambiar</button>
                </form>
            <?php } else { ?>
                <div class="alert alert-danger">Código incorrecto o vencido</div>
            <?php } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function validarContraseñas(event) {
            var password1 = document.getElementById('password').value;
            var password2 = document.getElementById('confirm-password').value;

            if (password1 !== password2) {
                // Mostrar SweetAlert si las contraseñas no coinciden
                Swal.fire({
                    icon: 'error',
                    title: 'Las contraseñas no coinciden',
                    text: 'Por favor, asegúrate de que las contraseñas ingresadas sean idénticas.',
                });
                return false; // Evitar el envío del formulario si las contraseñas no coinciden
            }
            
            return true; // Enviar el formulario si las contraseñas coinciden
        }
    </script>
</body>
</html>
