<?php

$contact = $_REQUEST["q"];

include 'connection.php';
	$hint='   
              <div class="form-group">
                <label for="name">Customer Name</label>
                <input name="customerName" class="form-control" type="text">
              </div>
              <div class="form-group">
                <label for="emailId">E-mail Id</label>
                <input name="emailId" class="form-control" type="text">
              </div>
              <div class="form-group">
                <label for="birthDate">E-mail Id</label>
                <input name="birthDate" class="form-control" type="date">
              </div>
              <div class="form-group">
                <label for="club">Club</label>
                <select class="form-control">
                  <option value="0">Silver</option>
                  <option value="1">Gold</option>
                  <option value="2">Platinum</option>
                </select>
              </div>
              <div class="form-group">
                <label for="sms">SMS</label>
                <select class="form-control">
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div> ';
	$query = "SELECT * FROM customer WHERE contact='{$contact}'";
		if($result = mysqli_query($link,$query)){
			$count=0;
			while ($row = mysqli_fetch_array($result)) {
				$customerId = $row["customerId"];
				$customerName = $row["customerName"];
				$count++;
			}
			if($count){
				$hint = '	  <input type="hidden"  name ="customerId" value="'.$customerId.'"> Welcome back ' .$customerName.'!!';				
			}
			//die($address);
	}
// Output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "no suggestion" : $hint;

?>