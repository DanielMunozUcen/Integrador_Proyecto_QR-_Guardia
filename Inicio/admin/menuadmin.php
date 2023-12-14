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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f5e1c41b5b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="menuadmin.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="viewport"content="width=device-width, initial-scale=1, shrink-to-fit=no"></meta>s

    <script>
    function SoloLetras(e) {
        var Key = e.keyCode || e.which;
        var tecla = String.fromCharCode(Key).toString();
        var letras = " A, B, C, D, E, F, G, H, I, J, K, L, M, N, Ñ, O, P, Q, R, S, T, U, V, W, X, Y, Z, Á, É, Í, Ó, Ú a, b, c, d, e, f, g, h, i, j, k, l, m, n, ñ, o, p, q, r, s, t, u, v, w, x, y, z, á, é, í, ó, ú";

        var especiales = [8, 13];
        var tecla_especial = false;

        for (var i in especiales) {
            if (Key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            alert("Ingresar solo letras");
            return false;
        }
    }
    function SoloNumeros(evt) {
        var Keynum;

        if (window.event) {
            Keynum = evt.keyCode;
        } else {
            Keynum = evt.which;
        }

        if ((Keynum > 47 && Keynum < 58) || Keynum == 8 || Keynum == 13 ) {
            return true;
        } else {
            alert("Ingresar solo números");
            return false;
        }
    }

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
    
    // Esta función valida el formato del RUT
    function validarRut(rut) {
    rut = rut.replace(/[.-]/g, ''); // Elimina puntos y guiones del RUT

    var cuerpo = rut.slice(0, -1); // Obtiene el cuerpo del RUT (sin el dígito verificador)
    var dv = rut.slice(-1).toUpperCase(); // Obtiene el dígito verificador y lo convierte a mayúscula

    var suma = 0;
    var multiplo = 2;

    for (var i = cuerpo.length - 1; i >= 0; i--) {
        suma += parseInt(cuerpo.charAt(i)) * multiplo;

        if (multiplo < 7) {
            multiplo += 1;
        } else {
            multiplo = 2;
        }
    }

    var dvEsperado = 11 - (suma % 11);
    dvEsperado = (dvEsperado === 11) ? 0 : (dvEsperado === 10) ? 'K' : dvEsperado.toString();

        if (dvEsperado === dv) {
            return true; // RUT válido
        } else {
            return false; // RUT inválido
        }
    }
    
    function validarInputRut() {
    var rutInput = document.getElementById("rut").value.trim(); // Elimina espacios en blanco al inicio y al final del valor

    if (rutInput !== '') { // Verifica que el campo no esté vacío
        if (validarRut(rutInput)) {
            // Si el RUT es válido, puedes realizar alguna acción aquí
            console.log("RUT válido");
        } else {
            // Si el RUT no es válido, muestra una alerta o realiza alguna acción adicional
            alert("El RUT ingresado no es válido.");
        }
    }
}




</script>

</head>
<body>
    <img src="Logo UCEN_R.COQUIMBO_.png" alt="Logo" class="logo">
    <div class="container">
        <h1 class="text-center p-3">Bienvenido: <?php include 'name.php'; ?></h1>
        <?php
        include "conexion.php";
        include "eliminar_guardia.php";
        ?>
        <div class="container-fluid row">
            <form class="col-4 p-3" method="POST">
                
                    <center>
                <h3 class="text-center-text-secondary">Registro de guardia</h3>
                    </center>
                <?php
                    
                    include "registro_personas.php";
                ?>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Rut</label>
                    <input type="text" class="form-control" name="rut" id="rut" placeholder="Ejemplo 10111222-1" oninput="formatoAutomaticoRut();" onblur="validarInputRut();" maxlength = "10 " required>
                </div> 

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Ejemplo Sebastian " onkeypress="return SoloLetras(event);"  maxlength = "12" required>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Apellido</label>
                    <input type="text" class="form-control" name="apellido" placeholder="Ejemplo Gonzales " onkeypress="return SoloLetras(event);"  maxlength = "12" required>
                </div>  

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Fono</label>
                    <input type="text" class="form-control" name="fono" placeholder="Ejemplo 911223344 " onkeypress="return SoloNumeros(event);" maxlength = "9" required>
                </div> 
                
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="correo" placeholder="ejemplo@dominio.com" required>
                    <small id="emailHelp" class="form-text text-muted">Ingresa una dirección de correo electrónico válida.</small>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Clave</label>
                    <input type="password" class="form-control" name="clave">
                </div> 


                <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok" >Ingresar</button>
            
            </form>

        <div class="col-8 p-4">
            <table class="table">
                <thead class="bg-info">

                    <tr>
                        <th scope="col">Rut</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Fono</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Estado</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "conexion.php";
                    $sql = $conexion->query("select * from usuario
                    inner join guardia on usuario.rut=guardia.rut_g 
                    where usuario.estado=0");

                    while($datos = $sql->fetch_object()){ ?>
                        <tr>
                            <td><?= $datos->rut ?></td>
                            <td><?= $datos->nombre ?></td>
                            <td><?= $datos->apellido ?></td>
                            <td><?= $datos->fono ?></td>
                            <td><?= $datos->correo ?></td>
                            <td><?= $datos->estado ?></td>
                            <td>
                                <a href="editar_guardia.php?rut=<?= $datos->rut ?>" class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="eliminar_guardia.php?rut=<?= $datos->rut ?>" class="btn btn-small btn-danger eliminar-usuario">
                                <i class="fa-solid fa-trash"></i>
                                </a>
                        </td>
                    <?php }
                    ?>
                    
                    </tbody>
                </table>
            </div>
           
        </div>
                       
        
       
                        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
        
    </div>   
    <a href="../cerrar_sesion.php" class="boton azul">Cerrar sesion</a>  
    <a href="../metricas/metricas_front.php" class="metricas">Metricas</a>  
          
    <script>


    const urlParams = new URLSearchParams(window.location.search);
    const guardia = urlParams.get('guardia_editado');
    if (guardia === 'true') {
        // Mostrar la alerta SweetAlert
        Swal.fire({
            icon: 'success',
            title: 'Exito..',
            text: 'Guardia editado con exito!.',
        });
    }

    const guardia1 = urlParams.get('guardia_eliminado');
    if (guardia1 === 'true') {
        // Mostrar la alerta SweetAlert
        Swal.fire({
            icon: 'success',
            title: 'Exito..',
            text: 'Guardia eliminado con exito!.',
        });
    }

    </script>
    </body>
</html>