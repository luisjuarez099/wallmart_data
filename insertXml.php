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

    mysqli_query($conn ,"SET @p1='".$employee->OC."'");
    mysqli_query($conn ,"SET @p2='". $employee->Proveedor."'");
    mysqli_query($conn ,"SET @p3='".$employee->Producto."'");
    mysqli_query($conn ,"SET @p4='".$employee->Descripcion."'");
    mysqli_query($conn ,"SET @p5='".$employee->Cantidad ."'");
    mysqli_query($conn ,"SET @p6='".$employee->FechaEntrega."'");
    mysqli_query($conn ,"SET @p7='".$employee->Precio."'");
    mysqli_multi_query ($conn, "CALL insert_wm (@p1,@p2,@p3,@p4,@p5,@p6,@p7 )") OR DIE (mysqli_error($conn));

    
}
