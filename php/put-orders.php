<?php

require "db-conn.php";

/**
 * Receives an associative array containing the order data and inserts the data into the database
 * @param data assosiative array containing the order data
 */
function insertOC($data) {
try {
    echo "INFO: Inserting data into DB...\n";

    $connection = start_connection();
    foreach ($data as $elem) {

        // Get data from array param
        $id = intval($elem['id']);
        $prov = $elem['proveedor'];
        $prod = $elem['producto'];
        $desc = $elem['descripcion'];
        $cant = intval($elem['cantidad']);
        $fecha = date("Y-m-d", strtotime($elem['fechaEnt']));
        $precio = doubleval($elem['precio']);
        
        // Set data as args for store procedure
        mysqli_query($connection, "SET @p0='" . $id . "'");
        mysqli_query($connection, "SET @p1='" . $prov . "'");
        mysqli_query($connection, "SET @p2='" . $prod . "'");
        mysqli_query($connection, "SET @p3='" . $desc . "'");
        mysqli_query($connection, "SET @p4='" . $cant . "'");
        mysqli_query($connection, "SET @p5='" . $fecha . "'");
        mysqli_query($connection, "SET @p6='" . $precio . "'");

        // Call store procedure
        $success=mysqli_multi_query($connection, "CALL insert_wm (@p0,@p1,@p2,@p3,@p4,@p5,@p6)");

        // If query fail send error
        if ($success === true)
            echo "INFO: New order recorded to DB!\n";
        else
            echo "ERROR: Could not insert order into DB! :(\n" . $connection->error;
    } 

} catch (Exception $e) {
    echo "Error expetion $e";

    }

    echo "Done!\n";
}

?>