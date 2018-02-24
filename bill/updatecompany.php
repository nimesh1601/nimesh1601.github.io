<?php 
	session_start();
	include 'connection.php';
	 if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {
		 header('Location:login.php');
	 }
else{
	if(isset($_GET["customerId"])){
		$customerId =$_GET["customerId"];
    $query = "SELECT * FROM customer WHERE customerId='{$customerId}'";
    if($result = mysqli_query($link,$query)){
      while ($row = mysqli_fetch_array($result)) {
        $customerName = $row["customerName"];
        $contact=$row["contact"];
        $emailId=$row["emailId"];
        $club=$row["club"];
        $sms=$row["sms"];
        $birthDate=$row["birthDate"];
      }
    }
    else{
      header('Location:updateerrormessage.html');
    }
	}
else if(isset($_POST["contact"]))
{
      $customerId= $_POST["customerId"];
      $customerName = $_POST["customerName"];
      $contact=$_POST["contact"];
      $emailId=$_POST["emailId"];
      $club=$_POST["club"];
      $sms=$_POST["sms"];
      $birthDate=$_POST["birthDate"];
      //die($companyId);
	if(1)
	{
		$query = "UPDATE customer SET
    customerName = '{$customerName}',
    contact='{$contact}',
    emailId='{$emailId}',
    club='{$club}',
    sms='{$sms}',
    birthDate='{$birthDate}'
		WHERE customerId={$customerId}";
		if(mysqli_query($link, $query)){
			header('Location:updatemessage.html');
		}
    else{
      
      die($customerId);
    }
	}

}
else{
  header('Location:index.php');
}	
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php 
include 'head.php';
?>
</head>
  <body class="layout layout-header-fixed">
		<?php
			include 'topnav.php';
		?>
    <div class="layout-main">
 		<?php
			include 'sidenav.php';
		?>
      <div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
            <h1 class="title-bar-title">
              <span class="d-ib">Update Client Information</span>

            </h1>
            <p class="title-bar-description">
              <small>This form is concerned for updating information of Riviere only</small>
            </p>
          </div>
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
			
			<form action=<?php echo $_SERVER['PHP_SELF'] ?> method="post" id="updatec">
			<input type="hidden" value= <?php echo "'".$customerId."'"; ?> name ="customerId">    
              <div class="form-group">
                <label for="name">Customer Name</label>
                <input name="customerName" class="form-control" value=<?php echo '"'.$customerName.'"' ?> type="text">
              </div>
              <div class="form-group">
                <label for="contact">Contact</label>
                <input name="contact" class="form-control" value=<?php echo '"'.$contact.'"' ?> type="text">
              </div>
              <div class="form-group">
                <label for="emailId">E-mail Id</label>
                <input name="emailId" class="form-control" value=<?php echo '"'.$emailId.'"' ?> type="text">
              </div>
              <div class="form-group">
                <label for="birtDate">Birth Date</label>
                <input name="birthDate" class="form-control" value=<?php echo '"'.$birthDate.'"' ?> type="date">
              </div>
              <div class="form-group">
                <label for="club">Club</label>
                <select class="form-control" name="club">
                  <option value="0">Silver</option>
                  <option value="1">Gold</option>
                  <option value="2">Platinum</option>
                </select>
              </div>
              <div class="form-group">
                <label for="sms">SMS</label>
                <select class="form-control" name="sms">
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>       
              <div class="form-group">
                <input type="submit" id="addc" class="btn btn-primary" type="button">
                <input type="reset" class="btn btn-default" type="button" value="Clear">
              </div>
			  </form>
            </div>
          </div>
        </div>
      </div>
      <div class="layout-footer">
        <div class="layout-footer-body">
          <small class="version">Version 1.0.0</small>
          <small class="copyright">2017 &copy; <a href="http://www.mnsdevelopers.com/">MNS Developers </a></small>
        </div>
      </div>
    </div>

    <script src="js/vendor.min.js"></script>
    <script src="js/elephant.min.js"></script>
    <script src="js/application.min.js"></script>
    <script src="js/demo.min.js"></script>
  </body>
</html>