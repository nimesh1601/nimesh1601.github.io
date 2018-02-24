<?php

	include 'connection.php';
		if($_POST["invoiceNo"]){
			$customerName = $_POST["customerName"];
			$contact=$_POST["contact"];
			$emailId=$_POST["emailId"];
			$club=$_POST["club"];
			$sms=$_POST["sms"];
			$birthDate=$_POST["birthDate"];



			$gTotal = $_POST["gTotal"];
			$offer=$_POST["offer"];

			$aserviceName = $_POST["serviceName"];
			$arate = $_POST["rate"];
			$aamount = $_POST["amount"];

			

			if(!$customerId){
				//die('entered');
				$query1 = "INSERT INTO `customer` (`customerName`,`contact`,`emailId`,`birthDate`,`club`,`sms`) VALUES ('{$customerName}','{$contact}','{$emailId}','{$birthDate}','{$club}','{$sms}')";

				if(mysqli_query($link, $query1)){
					$query = "SELECT * FROM customer where contact= '".$contact."'";
					if($result = mysqli_query($link,$query)){
						$count=1;
						while ($row = mysqli_fetch_array($result)) {
							$customerId=$row[0];
						}

					}
					

				}				
			}


		$query1 = "INSERT INTO `invoice` (`customerId`,`gTotal`,`offer`,`date`) VALUES ('{$customerId}','{$gTotal}','{$offer}','{$date}')";

		if(mysqli_query($link, $query1)){
			$query = "SELECT * FROM invoice ";
			if($result = mysqli_query($link,$query)){
				while ($row = mysqli_fetch_array($result)) {
					$invoiceId=$row[0];
				}
				foreach( $aserviceName as $key => $serviceName ) {
				  $rate = $arate[$key];
				  $amount = $aamount[$key];
				  $query1 = "INSERT INTO `invoicedetails` (`invoiceId`,`serviceName`,`rate`,`amount`) VALUES ('{$invoiceId}','{$serviceName}','{$rate}','{$amount}')";
				  if(mysqli_query($link, $query1)){
				  	header('Location:viewinvoicefull.php?invoiceId='.$invoiceId);
				  }
				}

			}
			

		}
	}
	else{
		header('Location:error.php');
	}

?>