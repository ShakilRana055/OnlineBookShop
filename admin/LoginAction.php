<?php
session_start();
include("../connection/DatabaseConnection.php");

$msg = "";

if(isset($_POST['submit'])){  

	// creating super admin as default
	CreatingUser($con);

	$user = trim($_POST['Email']);
	$pass = trim($_POST['Password']);
	$md5Password = md5($pass);

	$sql = "SELECT * FROM `users` WHERE `Email` = '$user' AND `Password` = '$md5Password'";

	$result = mysqli_query($con, $sql);
	$data = mysqli_fetch_assoc($result);

	if(!empty($data)){
		$_SESSION['user'] = $data;
		$date= date('Y-m-d H:i:s');
		$_SESSION['login_time'] = $date;
		header('Location: views/index.php');
		exit;
	}else{
		$msg="Your Email or Password is not valid!";
	}
}

function CreatingUser($con){
	$sql = "SELECT * FROM `users` WHERE `Email` = 'superadmin@gmail.com' AND `Password` = 'superadmin@123'";
	$result = mysqli_query($con, $sql);
	if($result == null){
		$superAdminPassword =  md5("Ab@123");
		$currentDate = date('Y-m-d H:s:i');

		$sql = "INSERT INTO `users`(`Name`, `Email`, `Password`, `PhotoUrl`, `UserType`, `CreatedDate`) 
				VALUES ('Super Admin', 'superadmin@gmail.com', '$superAdminPassword', '/image/superadmin.jpg', 'SuperAdmin', '$currentDate')";
		$result = mysqli_query($con, $sql);
	}
}
?>