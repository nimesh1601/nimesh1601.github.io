<?php

	include 'connection.php';
		if($_POST["contact"]){
			$customerName = $_POST["customerName"];
			$contact=$_POST["contact"];
			$emailId=$_POST["emailId"];
			$club=$_POST["club"];
			$sms=$_POST["sms"];
			$birthDate=$_POST["birthDate"];

		$query1 = "INSERT INTO `customer` (`customerName`,`contact`,`emailId`,`birthDate`,`club`,`sms`) VALUES ('{$customerName}','{$contact}','{$emailId}','{$birthDate}','{$club}','{$sms}')";

			$query = "SELECT * FROM customer where contact= '".$contact."'";
			if($result = mysqli_query($link,$query)){
				$count=0;
				while ($row = mysqli_fetch_array($result)) {
					$customerId=$row[0];
					$count++;
				}
				if($count==0){
					$query1 = "INSERT INTO `customer` (`customerName`,`contact`,`emailId`,`birthDate`,`club`,`sms`) VALUES ('{$customerName}','{$contact}','{$emailId}','{$birthDate}','{$club}','{$sms}')";
					if(mysqli_query($link,$query1)){
						die("done");
						header('Location:index.php');
					}
					else{
						die("something went wrong call 99552376655");
					}
				}
				else{
					die("re");
				}
				
				//header('Location:invoiceadd.php?companyId='.$companyId);
				}
			
	}

?>