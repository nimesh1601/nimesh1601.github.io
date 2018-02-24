<?php 
	session_start();
	include 'connection.php';
	 if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {
		 header('Location:login.php');
	 }
else{
	if(isset($_GET["invoiceId"])){
		$invoiceId =$_GET["invoiceId"];
	}
	$error1 ="";
$error2 ="";
	if(1)
	{
		$query = "DELETE FROM invoice WHERE invoiceId='{$invoiceId}'";
		if(mysqli_query($link, $query)){
			$query = "DELETE FROM invoicedetails WHERE invoiceId='{$invoiceId}'";
			if(mysqli_query($link, $query)){
				header('Location:deletemessage.html');
			}
			
		}
		else{
			header('Location:deleteerror.html');
		}
	}	
 }
?>