<?php

	include 'connect.php';


	
	$id = $_GET['id'];
	$ids = $_GET['ids'];


	$query ="DELETE FROM selected_track WHERE ID =$id ";

	$qry = $con->query($query);

     echo '<script>window.alert("Track Activity is successfully Deleted!");window.location="../view-delegate.php?id='.$ids.'";</script>';
    
$con -> close();
?>