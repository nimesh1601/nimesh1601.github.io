<?php 
	session_start();
	include 'connection.php';
	 if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {
		 header('Location:login.php');
	 }
else{
	if(isset($_GET["customerId"])){
		$customerId =$_GET["customerId"];
	}
	$error1 ="";
$error2 ="";
	if(1)
	{
		$query = "DELETE FROM customer WHERE customerId='{$customerId}'";
		if(mysqli_query($link, $query)){
			header('Location:deletemessage.html');
		}
		else{
			header('Location:deleteerror.html');
		}
	}	
 }
?>