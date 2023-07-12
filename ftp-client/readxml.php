<?php

function get_xml_data($path) {
    echo "INFO: Loading xml file -> " . $path . "...\n";
    $xml = simplexml_load_file($path);

    $data = [];
    $count = 0;
    foreach ($xml->dato as $oc) {

        $data[$count] = array(
            'id' => $oc->OC,
            'proveedor' => $oc->Proveedor,
            'producto' => $oc->Producto,
            'descripcion' => $oc->Descripcion,
            'cantidad' => $oc->Cantidad,
            'fechaEnt' => $oc->FechaEntrega,
            'precio' => $oc->Precio
        );

        $count++;
    }

    echo "INFO: XML data fetched successfully!\n";
    return $data;
}

?>
