<?php

const HOST = "127.0.0.1";
const USER = "root";
const DB_NAME = "wm_bd";
const PASS = "";

/**
 * Stablish connection to the database
 */
function start_connection(){
    echo "INFO: Connecting to database...\n";
    $connection = new mysqli(HOST, USER, PASS, DB_NAME);

    if (!$connection) {
        die('ERROR: Could not connect to DB!: ' . $connection->error_log. "\n");
        return NULL;
    }
    else {
        echo "INFO: Connected successfully!\n";
        return $connection;
    }
}

?>
