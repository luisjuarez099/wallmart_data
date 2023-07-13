# FTP CLIENT
This directory handles the main logic for the ftp server

## ftp-monitor.php
This files is in charge of monitoring the ftp server awaiting for orders. Once an order had arrived call functions in **read-xml-order.php** and **put-orders.php** to extract the data and send it to the database
