<?php

session_start();

if (session_destroy()) {
	# code...
	header("location: ../index.php");
}


?>