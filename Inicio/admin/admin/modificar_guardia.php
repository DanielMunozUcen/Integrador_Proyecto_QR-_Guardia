<?php
    if (!empty($_POST["btnregistrar"])) {
        if (!empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["fono"]) && !empty($_POST["correo"])) {
            
            $rut = $_POST['rut'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $fono = $_POST['fono'];
            $correo = $_POST['correo'];

            $sql = $conexion->query("UPDATE usuario SET nombre='$nombre', apellido='$apellido', fono=$fono, correo='$correo' WHERE rut='$rut'");

            if ($sql === false) {
                echo '<script>
                Swal.fire({
                icon: "error",
                title: "Error..",
                text: "Error al registrar guardia!",
                });
                </script>';
            } else {
                header("Location: ../admin/menuadmin.php?guardia_editado=true");
            }
        } else {
            echo '<script>
            Swal.fire({
                icon: "warning",
                title: "Oops...",
                text: "Hay campos vacios !",
            });
          </script>'; }
    }
?>
 