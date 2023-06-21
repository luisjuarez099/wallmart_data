<?php

$ruta = "0000-00-00employeeData.xml"; //ruta del archivo xml 

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
}

?>

