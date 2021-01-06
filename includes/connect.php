<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "glmp_datawarehouse";
$con = new mysqli($serverName, $userName, $password, $dbName); //createConnection
//checkConnection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

?>