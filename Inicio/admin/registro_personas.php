<?php

if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["rut"]) and !empty($_POST["nombre"]) and !empty($_POST["apellido"]) and !empty($_POST["fono"]) and !empty($_POST["correo"]) and !empty($_POST["clave"])) {

        $rut = $_POST['rut'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $fono = $_POST['fono'];
        $correo = $_POST['correo'];
        $clave = $_POST['clave'];
        $clave = hash('sha512', $clave);
        $anio_actual = date("Y");

        $consulta_rut= $conexion->query("SELECT * from usuario
                                        inner join guardia on guardia.rut_g=usuario.rut
                                        where usuario.rut='$rut' and usuario.estado=1");
        
        if ($consulta_rut->num_rows == 0) {
            $consulta_rut2= $conexion->query("SELECT * from usuario
                                        inner join guardia on guardia.rut_g=usuario.rut
                                        where usuario.rut='$rut' and usuario.estado=0");     
            if ($consulta_rut2->num_rows == 0) {
                $consulta_correo= $conexion->query("SELECT * from usuario
                                        inner join guardia on guardia.rut_g=usuario.rut
                                        where usuario.correo='$correo' and usuario.estado=0");
                if ($consulta_correo->num_rows == 0) {  
                    $sql = $conexion->query("INSERT INTO usuario (rut, nombre, apellido, fono, correo, clave) VALUES ('$rut', '$nombre', '$apellido', '$fono', '$correo', '$clave')");
                    $sql = $conexion->query("INSERT INTO guardia (rut_g, inicio) VALUES ('$rut', '$anio_actual')");
                    if ($sql == 1) {
                        echo '<script>
                                Swal.fire({
                                icon: "success",
                                title: "Bien",
                                text: "Guardia registrado exitosamente!",
                            });
                        </script>';
                    } else { echo '<script>
                            Swal.fire({
                            icon: "error",
                            title: "Error..",
                            text: "Error al registrar guardia!",
                            });
                            </script>';
                    }
                }else{
                    echo '<script>
                    Swal.fire({
                        icon: "error", 
                        title: "Error",
                        text: "Correo del guardia ya esta en uso",
                    });
                </script>';
                }
            }else{
                echo '<script>
                    Swal.fire({
                        icon: "error", 
                        title: "Error",
                        text: "Rut del guardia ya existe en la base de datos",
                    });
                </script>';
            }
        }else{
            $sql = $conexion->query("UPDATE usuario SET nombre='$nombre', apellido='$apellido', fono=$fono, correo='$correo', estado='0' WHERE rut='$rut'");
            echo '<script>
                        Swal.fire({
                        icon: "success",
                        title: "Bien",
                        text: "Guardia registrado exitosamente!",
                    });
                </script>';
        } 
    } else {
        echo '<script>
                Swal.fire({
                    icon: "warning",
                    title: "Oops...",
                    text: "Hay campos vacios !",
                });
              </script>';
    }
}
?>
