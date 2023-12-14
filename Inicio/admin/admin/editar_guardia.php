<?php
    include "conexion.php";
    $rut = $_GET["rut"];
    $sql = $conexion->query("SELECT * FROM usuario WHERE rut='$rut'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="editar_guardia.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="viewport"content="width=device-width, initial-scale=1, shrink-to-fit=no"></meta>

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

        if ((Keynum > 47 && Keynum < 58) || Keynum == 8 || Keynum == 13 || Keynum == 43) {
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
    

    </script>

</head>
<body>
    
<?php
    include "conexion.php";

    // Verificar si se envió el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Procesar los datos del formulario en modificar_guardia.php
        include "modificar_guardia.php";
    }

    $rut = $_GET["rut"];
    $sql = $conexion->query("SELECT * FROM usuario WHERE rut='$rut'");

    if ($sql === false) {
        die("Error en la consulta SQL: " . $conexion->error);
    }
?>
<div class="container">
<form class="col-4 p-3 m-auto" method="POST">
    <center>

    <h5 class="titulo">Editar Guardia</h5>
    </center>
    <br>
    <input type="hidden" name="rut" value="<?= $rut ?>">
    
    <?php
    while ($datos = $sql->fetch_object()) {
    ?>  
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" value="<?= $datos->nombre ?>"onkeypress="return SoloLetras(event);"  maxlength = "12" required>
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apellido</label>
            <input type="text" class="form-control" name="apellido" value="<?= $datos->apellido ?>"onkeypress="return SoloLetras(event);"  maxlength = "12" required>
        </div>  

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Fono</label>
            <input type="text" class="form-control" name="fono" value="<?= $datos->fono ?>"onkeypress="return SoloNumeros(event);" maxlength = "12" required>
        </div> 

        <div class="mb-3"> 
            <label for="exampleInputEmail1" class="form-label">Correo</label>
            <input type="text" class="form-control" name="correo" value="<?= $datos->correo ?>">
        </div> 
    <?php 
    }
    ?>

    <button type="submit" class="boton verde" name="btnregistrar" value="ok">Modificar</button>
    <a href="menuadmin.php" class="boton rojo">Volver</a>
    

</form>
</div>

</body>
</html>