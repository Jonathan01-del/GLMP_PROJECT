<?php
 session_start();

if (!isset($_SESSION['username']) || $_SESSION['role']!="admin") {
	# code...
	header("location: ../index.php");
}
?>

<h1> Hello : <?= $_SESSION['username'] ?></h1>
<h2>You are a : <?= $_SESSION['role']?></h2>
