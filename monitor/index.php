<?php

$host = "localhost"; // Dirección del servidor de la base de datos
$username = "root"; // Nombre de usuario de la base de datos
$passwd = ""; // Contraseña de la base de datos
$dbname = "wm_bd"; // Nombre de la base de datos

$conn = new mysqli($host, $username, $passwd, $dbname);



$cont = "SELECT COUNT(*) FROM count_trigger";
// Ejecutar la consulta
$resultado = $conn->query($cont);

// Verificar si la consulta se ejecutó correctamente
if ($resultado) {
  // Obtener el valor del resultado
  $row = $resultado->fetch_assoc();
  $totalRegistros = $row['COUNT(*)'];
  //envio de correo 
  
  $comando = ' ssmtp luisjuarezcc9@gmail.com < ../demo_data/mail.txt'; // Ejemplo de comando (listar archivos y directorios)

  // Ejecutar el comando y obtener la salida
  $output = shell_exec($comando);

  // Imprimir la salida del comando
  

  echo "El número total de registros en la tabla count_trigger es: " . $totalRegistros;
} else {
  echo "Error al ejecutar la consulta: " . $conn->error;
}
?>

<html>

<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", { packages: ["corechart"] });
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var totalRegistro = <?php echo $totalRegistros; ?>;
      var data = google.visualization.arrayToDataTable([
        ['bien', 'inertados correctamente'],
        ['bien', totalRegistro],
      ]);

      var options = {
        title: 'My Daily Activities',
        is3D: true,
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
      chart.draw(data, options);
    }

    
  </script>
</head>

<body>
  <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
  <script>
    var mensajeCorreo="Se a enviado el correo exitosamente";
    alert(mensajeCorreo);
  </script>
</body>
    
</html>