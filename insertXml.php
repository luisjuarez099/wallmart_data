<?php
$database = "wm_bd";
$servername = "localhost";
$password = "";
$username = "root";

$conn =new mysqli($servername, $username, $password, $database); //variable de conexion a la BD
$ruta = "2023-06-12employeeData.xml"; //ruta del archivo xml 
if (!$conn) {
    die("Conexion fallo: " . mysqli_connect_error());
}


$employees = simplexml_load_file($ruta); //Interprets an XML file into an object
foreach ($employees as $employee) {
    //Imprimir en formato de tabla
    echo "<tr>";
        echo "<td> " . $employee->OC . "</td>";
        echo "<td> " . $employee->Proveedor . " </td>";
        echo "<td> " . $employee->Producto . " </td>";
        echo "<td> " . $employee->Descripcion . " </td>";
        echo "<td> " . $employee->Cantidad . " </td>";
        echo "<td> " . $employee->FechaEntrega . " </td>";
        echo "<td> " . $employee->Precio . " </td>";
    echo "</tr>";

    mysqli_query($conn, "SET @p0='" . $employee->OC . "'");
    mysqli_query($conn, "SET @p1='" . $employee->Proveedor . "'");
    mysqli_query($conn, "SET @p2='" . $employee->Producto . "'");
    mysqli_query($conn, "SET @p3='" . $employee->Descripcion . "'");
    mysqli_query($conn, "SET @p4='" . $employee->Cantidad . "'");
    mysqli_query($conn, "SET @p5='" . $employee->FechaEntrega . "'");
    mysqli_query($conn, "SET @p6='" . $employee->Precio . "'");
    mysqli_multi_query($conn, "CALL insert_wm (@p0,@p1,@p2,@p3,@p4,@p5,@p6)");
    while (mysqli_more_results($conn)) {

        if ($result = mysqli_store_result($conn)) {

            while ($row = mysqli_fetch_assoc($result)) {

                // i.e.: DBTableFieldName="userID"
            echo "<tr>";
                echo "<td> " . $row["OC"] ."</td>";
                echo "<td> " . $row["Proveedor"] ."</td>";
                echo "<td> " . $row["Producto"] ."</td>";             
                echo "<td> " . $row["Descripcion"] ."</td>";
                echo "<td> " . $row["Cantidad"] ."</td>";
                echo "<td> " . $row["FechaEntrega"] ."</td>";
                echo "<td> " . $row["Precio"] ."</td>";
            echo "</tr>";
            }
            mysqli_free_result($result);
        }
        mysqli_next_result($conn);

    }

}