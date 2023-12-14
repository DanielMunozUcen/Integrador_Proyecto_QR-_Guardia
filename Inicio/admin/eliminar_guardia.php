<?php
include "conexion.php";

if (!empty($_GET["rut"])) {
    $rut = $_GET["rut"];

    $sql = $conexion->query("UPDATE usuario SET estado='1' WHERE rut='$rut'");

    if ($sql === true) {
        header("Location: ../admin/menuadmin.php?guardia_eliminado=true");
    } else {
        echo '<script>
                Swal.fire({
                icon: "error",
                title: "Error..",
                text: "Error al eliminar  guardia!",
                });
                </script>';
    }
}
?>
