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
    <title>Metricas ingresos</title>
    <!-- Incluir la librería Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
    <img src="logo.png" alt="Logo" class="logo">
    <div class="container">
    <center>
    <h1>Métricas Ingresos por edificio</h1>
    
    <label for="fecha">Selecciona una fecha:</label>
    <input type="date" id="fecha" value="<?php echo date('Y-m-d'); ?>"> <!-- Valor por defecto: fecha actual -->
    
    <button onclick="obtenerDatos()">Obtener Datos</button>
    </center>
    <canvas id="graficoBarras" width="800" height="400"></canvas>
    </div>
    <a href="../cerrar_sesion.php" class="boton azul">Cerrar sesion</a>  
    <a href="../admin/menuadmin.php" class="metricas">Volver a menu</a>
    <script>
        var grafico; // Variable global para el gráfico

        function obtenerDatos() {
            var fechaSeleccionada = document.getElementById('fecha').value;

            // Realizar la solicitud al backend con la fecha seleccionada
            fetch(`http://localhost/xampp/Integrador/Ultimo%20avance/Inicio/Metricas/metricas_back.php?fecha=${fechaSeleccionada}`)
                .then(response => response.json())
                .then(data => {
                    // Si existe un gráfico previo, destruirlo antes de crear uno nuevo
                    if (grafico) {
                        grafico.destroy();
                    }

                    // Procesar los datos y actualizar el gráfico
                    var edificios = [];
                    var totalIngresos = [];

                    data.forEach(metrica => {
                        edificios.push(metrica.edificio);
                        totalIngresos.push(metrica.total_ingresos);
                    });

                    var ctx = document.getElementById('graficoBarras').getContext('2d');
                    grafico = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: edificios,
                            datasets: [{
                                label: 'Total de Ingresos por Edificio',
                                data: totalIngresos,
                                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        precision: 0, // Sin decimales
                                        callback: function (value) {
                                            return value.toLocaleString(); // Evita los separadores de miles
                                        }
                                    }
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        // Llamar a la función obtenerDatos() al cargar la página con la fecha actual por defecto
        window.onload = obtenerDatos;
    </script>
</body>
</html>
