<?php
//requerimos la conexion de la bd
$con = mysqli_connect('localhost', 'root', '', 'wm_bd');


$query = "SELECT * FROM oc_logs";
$exec = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($exec)) {
    echo "Informacion de los pedidos " . " [' " . $row['OC'] . " '," . $row['Proveedor'] . "'," . $row['Producto'] . " ]";
}


// Ahora todo el código junto usando pie chart


$con = mysqli_connect('localhost', 'root', '', 'oc_logs');

?>


<html>

<head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

        // Load the Visualization API and the corechart package.
        google.charts.load('current', { 'packages': ['corechart'] });

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {

            // Create the data table.
            var data = google.visualization.arrayToDataTable([

                ['FechaHoy'],
                <?php
                $query = "SELECT  FechaHoy from oc_logs";

                $exec = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($exec)) {

                    echo "['" . $row['FechaHoy'] . "']";
                }
                ?>

            ]);
            // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Mushrooms', 3],
          ['Onions', 1],
          ['Olives', 1],
          ['Zucchini', 1],
          ['Pepperoni', 2]
        ]);

            // Set chart options
            var options = {
                'title': 'Ordenes Por dia',
                'width': 400,
                'height': 300
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</head>

<body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
</body>

</html>