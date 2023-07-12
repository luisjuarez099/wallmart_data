<?php
$database = "wm_bd";
$servername = "localhost";
$password = "";
$username = "root";

$conn = mysqli_connect($servername, $username, $password, $database); //variable de conexion a la BD
$ruta = "2023-06-12employeeData.xml"; //ruta del archivo xml 

//comprobacion de la BD
if (!$conn) {
    die("Conexion fallo: " . mysqli_connect_error());
}

// TODO: read from db
$employees = simplexml_load_file($ruta); //Interprets an XML file into an object
 
foreach ($employees as $employee) {

	// create new row into HTML
    echo "<tr>";
        echo "<td> " . $employee->OC . "</td>";
        echo "<td> " . $employee->Proveedor . " </td>";
        echo "<td> " . $employee->Producto . " </td>";
        echo "<td> " . $employee->Descripcion . " </td>";
        echo "<td> " . $employee->Cantidad . " </td>";
        echo "<td> " . $employee->FechaEntrega . " </td>";
        echo "<td> " . $employee->Precio . " </td>";
    echo "</tr>";
    
    	// TODO: move to database.php
	// call store procedure
    mysqli_query($conn, "SET @p0='" . $employee->OC . "'");
    mysqli_query($conn, "SET @p1='" . $employee->Proveedor . "'");
    mysqli_query($conn, "SET @p2='" . $employee->Producto . "'");
    mysqli_query($conn, "SET @p3='" . $employee->Descripcion . "'");
    mysqli_query($conn, "SET @p4='" . $employee->Cantidad . "'");
    mysqli_query($conn, "SET @p5='" . $employee->FechaEntrega . "'");
    mysqli_query($conn, "SET @p6='" . $employee->Precio . "'");

    // set args for store procedure call
    mysqli_multi_query($conn, "CALL insert_wm (@p0,@p1,@p2,@p3,@p4,@p5,@p6)");
}
