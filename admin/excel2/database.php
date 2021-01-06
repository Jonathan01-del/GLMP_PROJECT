<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "vx_report";
$conn = new mysqli($serverName, $userName, $password, $dbName); //createConnection
//checkConnection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/*
$userName = "eworldma_ewms";
$password = "2PrWA+f+_)FW";
$dbName = "eworldma_ewms2020";
*/
?>