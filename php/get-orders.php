<?php

require 'db-conn.php';

/**
 * Call a stored procedure to retrieve all the orders from the database
 * @return Array[] array of sub-array's where each sub-array is a retrieved row.
 * All sub-array's are associative array's so the access for colums is the next syntax:
 * order['property']
 */
function retrieve_orders(){

    // Stablish connection
    $conn = start_connection();
    if (!$conn) {
        die("Conexion fallo: " . mysqli_connect_error());
    }

    // Call stored procedure to retrieve all orders from database
    echo "INFO: retrieving orders from database...\n";
    $data = mysqli_query($conn, "CALL read_data()");
    $conn->close();
    return $data;
}
