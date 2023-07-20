<?php

// TODO: delete this file if needed
$xmlString =
'<note>
<to>Tove</to>
<from>Jani</from>
<heading>Reminder</heading>
<bo>Dont forget me this weekend!</bo>
</note>'; 
// Aquí debes proporcionar tu cadena XML

$dom = new DOMDocument(); //Representa un documento HTML o XML en su totalidad; sirve como raíz del árbol de documento. 

//Deshabilita errores libxml y permite al usuario extraer información de errores según sea necesario 
libxml_use_internal_errors(true);

if ($dom->loadXML($xmlString) === false) {
    // Se encontraron errores de análisis en el XML
    $errors = libxml_get_errors(); //Recupera un array de errores
    foreach ($errors as $error) {
        echo "\n  Error Message: ".$error->message;
        
    }
    libxml_clear_errors();// Limpia el buffer de errores de libxml 
} else {
    echo "El XML es aceptado.";
}



