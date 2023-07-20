<?php

require "../php/read-xml-order.php";
require "../php/put-orders.php";

const FTP_HOST = 'localhost';
const FTP_USER = 'ftp_user';
const FTP_PASS = 'pass123';
const REMOTE_FILE = 'employeeData.xml';
const LOCAL_FILE = 'order.xml';

// Stablish connection to ftp server
$ftp = ftp_connect(FTP_HOST);
if (!$ftp)
    die("ERROR: Failed to connect to ftp server\n");
else
    echo "INFO: FTP connection success!\n";

// Login to the ftp server
$login = ftp_login($ftp, FTP_USER, FTP_PASS);
if (!$login)
    die("ERROR: Failed to login to ftp server!\n");
else
    echo "INFO: FTP login success!\n";

// Set server as passive
ftp_pasv($ftp, true);
echo "INFO: Waiting for orders in ftp server...\n";

// Look for orders arrive to ftp server
while (true) {

	// If order arrived  
    if (ftp_size($ftp, REMOTE_FILE) != -1) {   
        echo "INFO: New order has arrived to FTP server...\n";
        echo "INFO: Downloading file from FTP...\n";
    
        // download file
        if (copy('../ftp-server/'.REMOTE_FILE, LOCAL_FILE)) {
            echo "INFO: File download success!\n";

            // extract and insert data to db
            $data = get_xml_data(LOCAL_FILE);
            insertOC($data);

            // delete files from ftp and local
            echo "INFO: Deleting file " . REMOTE_FILE . " from ftp server...\n";
            unlink(LOCAL_FILE);
            unlink("../ftp-server/".REMOTE_FILE);
        }
        else
            echo "ERROR: File download failed!\n";
    }
}

?>
