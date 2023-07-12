<?php

require "connection.php";

function insertOC($data) {
    echo "INFO: Inserting data into DB...\n";

    $connection = start_connection();
    foreach ($data as $elem) {

        $id = intval($elem['id']);
        $prov = $elem['proveedor'];
        $prod = $elem['producto'];
        $desc = $elem['descripcion'];
        $cant = intval($elem['cantidad']);
        $fecha = date("Y-m-d", strtotime($elem['fechaEnt']));
        $precio = doubleval($elem['precio']);

        $query = "INSERT INTO oc (OC, Proveedor, Producto, Descripcion, Cantidad, FechaEntrega, Precio)
                    VALUES ($id, '$prov', '$prod', '$desc', $cant, '$fecha', $precio);";

        if ($connection->query($query) === true)
            echo "INFO: New order recorded to DB!\n";
        else
            echo "ERROR: Could not insert order into DB! :(\n" . $connection->error;
    }

    echo "Done!\n";
}

?>