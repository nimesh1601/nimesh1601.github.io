<!DOCTYPE html>
<?php 
	session_start();
	include 'connection.php';
	 if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {
		 header('Location:login.php');
	 }
else{
	if(isset($_GET["companyId"])){
		$companyId =$_GET["companyId"];
	$query = "SELECT * FROM company WHERE companyId='{$companyId}'";
		if($result = mysqli_query($link,$query)){
			while ($row = mysqli_fetch_array($result)) {
				$companyName = $row["companyName"];
				$address = $row["address"];
				$gstin = $row["gstin"];
				$pan = $row["pan"];
				$state = $row["state"];
				$stateCode = $row["stateCode"];
			}
	}			
					
	}
	else{
		header('Location:index.php');
	}
}
?>
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
        <div class="profile">
          <div class="profile-header">
            <div class="profile-cover">
              <div class="profile-container">
                <div class="profile-card" >
                  <div class="profile-overview">
                    <h1 class="profile-name"><?php echo $companyName ?></h1>
                    <a href= <?php echo '"updatecompany.php?companyId='.$companyId.'"'?>> <button class="profile-follow-btn" type="button">Update</button></a>
                    <p><b>Address : </b> <?php echo $address;?></p>
					<p><b>GSTIN : </b><?php echo $gstin;?></p>
					<p><b>PAN : </b><?php echo $pan;?></p>
					<p><b>State :</b> Rs. <?php echo $state;?></p>
					<p><b>State-Code :</b> <?php echo $stateCode;?></p>
                  </div>
<!--                   <div class="profile-info">
                    <ul class="profile-nav">
                      <li>
                        <a href="#">
                          <h3 class="profile-nav-heading"><?php echo $duedate;?></h3>
                          <em>
                            <small>Due Date</small>
                          </em>
                        </a>
                        <a href="#">
                          <h3 class="profile-nav-heading">Rs. <?php echo $due;?></h3>
                          <em>
                            <small>Due Amount</small>
                          </em>
                        </a>
                      </li>
                    </ul>
                  </div> -->
                </div>
                <div class="profile-tabs">
                  <ul class="profile-nav">
                    <li class="active">
                      <a href="#">Overview</a>
                    </li>

                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="profile-body">
            <div class="profile-container">
              <table class="table table-middle nowrap">
                <tr>
                  <th>Invoice No</th>
                  <th>Amount</th>
                </tr>
<?php
  $query = "SELECT * FROM invoice WHERE companyId='{$companyId}'";
    if($result = mysqli_query($link,$query)){
      while ($row = mysqli_fetch_array($result)) {
        $invoiceId= $row["invoiceId"];
        $invoiceNo = $row["invoiceNo"];
        $gtotal = $row["gtotal"];
        echo '<tr><td> <a href="viewinvoicefull.php?invoiceId='.$invoiceId.'" >'.$invoiceNo.'</a></td><td> '.$gtotal.'</td></tr>';
      }
  } 

?>
              </table>            
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="js/vendor.min.js"></script>
    <script src="js/elephant.min.js"></script>
    <script src="js/application.min.js"></script>
    <script src="js/profile.min.js"></script>
  </body>


</html>