<?php

	session_start();
	include "dbase/parts/connect.php";
	//$con = new mysqli("localhost", "root", "","vx_report");

	$msg = "";

	if (isset($_POST['login'])) {
		# code...
		$username=$_POST['username'];
		$password=$_POST['password'];
		$password=sha1($password);	
		$usertype=$_POST['userType'];

		$sql = "SELECT * FROM  users WHERE username=? AND password=? AND user_type=? ";

		$stmt = $con->prepare($sql);
		$stmt->bind_param("sss",$username,$password,$usertype);
		$stmt->execute();

		$result = $stmt->get_result();
		$row = $result->fetch_assoc();

		session_regenerate_id();
		$_SESSION['username'] =$row['username'];
		$_SESSION['role'] =$row['user_type'];
		session_write_close();

		if ($result->num_rows==1 && $_SESSION['role']=="database")
		 {
			# code...
			header("location: dbase/index.php");
		}
		else if ($result->num_rows==1 && $_SESSION['role']=="teacher") {
			# code...
			header("location:teacher.php");
		}
		else if ($result->num_rows==1 && $_SESSION['role']=="admin") {
			# code...
			header("location: admin/index.php");
		}
		else{

			$msg="Username or Password is Incorrect!";
		}

	}


?>

<!DOCTYPE html>
<html>
<head>
	<title>PLEASE LOGIN TO APP</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body class="bg-dark">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-5 bg-light mt-5 px-0">
					<h3 class="text-center text-light bg-danger p-3">PLEASE LOGIN TO SYSTEM</h3>

					<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="p-4">
						<div class="form-group">
							<input type="text" name="username" class="form-control form-control-lg" autofocus=""  placeholder="Username" required>
							
						</div>
						<div class="form-group">
							<input type="text" name="password" class="form-control form-control-lg"  placeholder="Password" required>
							
						</div>
						<div class="form-group">
							<label for="userType">I'm a :</label>
							<input type="radio" name="userType" value="database" class="custom-radio" required="">&nbsp; Database |
							<input type="radio" name="userType" value="teacher" class="custom-radio" required="">&nbsp; Marcomm |
							<input type="radio" name="userType" value="admin" class="custom-radio" required="">&nbsp; Admin 
						</div>
						<div class="form-group">
							<input type="submit" name="login" class="btn-danger btn btn-block" value="submit">
						</div>
						<h5 class="text-danger text-center"><?= $msg; ?></h5>
					</form>
					
				</div>
			</div>
		</div>
</body>
</html>