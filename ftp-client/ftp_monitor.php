<?php

require "read-xml-order.php";
require "connection.php";

const FTP_HOST = 'localhost';
const FTP_USER = 'ftp_user';
const FTP_PASS = 'pass123';
const FTP_RMTE = 'employeeData.xml';
const FTP_LCAL = 'order.xml';

// Stablish connection
$ftp = ftp_connect('localhost');
if (!$ftp)
    die("ERROR: Failed to connect to ftp server\n");
else
    echo "INFO: FTP connection success!\n";

$login = ftp_login($ftp, FTP_USER, FTP_PASS);
if (!$login)
    die("ERROR: Failed to login to ftp server!\n");
else
    echo "INFO: FTP login success!\n";

ftp_pasv($ftp, true);
echo "INFO: Waiting for orders in ftp server...\n";

// Look for orders arrive to ftp server
while (true) {

	// If order arrived  
    if (ftp_size($ftp, FTP_RMTE) != -1) {   
        echo "INFO: New order has arrived to FTP server...\n";
        echo "INFO: Downloading file from FTP...\n";
    
        // download file
        //ftp copy del archivo xml
        
        if (copy('../ftp-server/'.FTP_RMTE, FTP_LCAL)) {
            echo "INFO: File download success!\n";

            // extract and insert data to db
            $data = get_xml_data(FTP_LCAL);
            insertOC($data);

            // delete files from ftp and local
            echo "INFO: Deleting file " . FTP_RMTE . " from ftp server...\n";
            unlink(FTP_LCAL);//borrar en local
            unlink("/opt/lampp/htdocs/UNEDL_PIV_2023A/phpWalmart/ftp-server/".FTP_RMTE);//borrar en ftp_server
        }
        else
            echo "ERROR: File download failed!\n";
    }
}

?>
