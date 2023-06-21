<?php
$database = "wm_bd";
$servername = "localhost";
$password = "";
$username = "root";

$conn = mysqli_connect($servername, $username, $password, $database); //variable de conexion a la BD
$ruta = "0000-00-00employeeData.xml"; //ruta del archivo xml 
if (!$conn) {
    die("Conexion fallo: " . mysqli_connect_error());
}


$employees = simplexml_load_file($ruta); //Interprets an XML file into an object
foreach ($employees as $employee) {
    echo "<tr>";
    echo "<td> " . $employee->OC . " </td>";
    echo "<td> " . $employee->Proveedor . " </td>";
    echo "<td> " . $employee->Producto . " </td>";
    echo "<td> " . $employee->Descripcion . " </td>";
    echo "<td> " . $employee->Cantidad . " </td>";
    echo "<td> " . $employee->FechaEntrega . " </td>";
    echo "<td> " . $employee->Precio . " </td>";
    echo "</tr>";


    //Hacemos el insert miestra se va leyendo el xml
    $insert_wm_bd = "INSERT INTO oc (OC,Proveedor, Producto, Descripcion, Cantidad, FechaEntrega, Precio) VALUES ('$employee->OC','$employee->Proveedor','$employee->Producto','$employee->Descripcion','$employee->Cantidad','$employee->FechaEntrega','$employee->Precio')";
    //Preparamos el query para hacer insert.
    $sentencia = $conn->prepare($insert_wm_bd); //Prepara una sentencia SQL para su ejecución.
    $sentencia->execute(); //Ejecuta una consulta preparada
    $sentencia->close(); //Cierra una sentencia preparada
}
