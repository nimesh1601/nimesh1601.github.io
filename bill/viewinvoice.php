<?php 
	session_start();
	include 'connection.php';
	 if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {
		 header('Location:login.php');
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
              <span class="d-ib">Company Information</span>

            </h1>
            <p class="title-bar-description">
              <small>This table describe all companies that are registered with you.</small>
            </p>
          </div>
          <div class="text-center m-b">
            <a class="btn btn-warning" href="addinvoice.php" style="background-color:#D9230F" >Add Invoice</a>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="panel">
                <div class="panel-body">
                  <div class="table-responsive">
                    <table id="demo-dynamic-tables-2" class="table table-middle nowrap">
                      <thead>
                        <tr>
                          <th>
                            <label class="custom-control custom-control-primary custom-checkbox">
                              <input class="custom-control-input" type="checkbox">
                              <span class="custom-control-indicator"></span>
                            </label>
                          </th>
                          <th>Invoice No</th>
                          <th>Company Name</th>
                          <th>Mode of Transport</th>
                          <th>Vehicle No</th>
                          <th>Amount</th>
                          <th>Due Date</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
<?php 
		$query = "SELECT * FROM invoice";
		if($result = mysqli_query($link,$query)){
			$count=1;
			while ($row = mysqli_fetch_array($result)) {
        		$invoiceId=$row["invoiceId"];
        		$invoiceNo=$row["invoiceNo"];
				$companyId=$row["companyId"];
				$mot=$row["mot"];
				//$date=date_format($date,"Y-M-D");
				$vehicleNo = $row["vehicleNo"];
				$gtotal = $row["gtotal"];
        		$dueDate = $row["dueDate"];
				//$assign = $row[6];
			$query2 = "SELECT * FROM company where companyId= '".$companyId."'";
			if($result2 = mysqli_query($link,$query2)){
				while ($row2 = mysqli_fetch_array($result2)) {
					$companyName=$row2["companyName"];
				}
			}			
				echo "
                        <tr>
                          <td>
                          </td>
						  <td data-order='".$invoiceNo."'>
                            <span class='icon-with-child m-r'>
                              <span class='icon-child bg-warning circle sq-20'>".$count."</span>
                            </span>	
							<strong>".$invoiceNo."</strong>
							</td>
							";
				echo '
                          <td class="maw-320">
                            <span class="truncate">'.$companyName.'</span>
                          </td>
                          <td><span class="truncate">'.$mot.'</span></td>
                          <td data-order="'.$vehicleNo.'">
                            <span class="truncate">'.$vehicleNo.'</span>
                          </td>
                          <td data-order="'.$gtotal.'">
                            <span class="truncate">'.$gtotal.'</span>
                          </td>
                          <td data-order="'.$dueDate.'">
                            <span class="truncate">'.$dueDate.'</span>
                          </td>
                          ' ;

                            echo '
                          <td>
                            <div class="btn-group pull-right dropdown">
                              <button class="btn btn-link link-muted" aria-haspopup="true" data-toggle="dropdown" type="button">
                                <span class="icon icon-ellipsis-h icon-lg icon-fw"></span>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-right">
							    <li><a href="viewinvoicefull.php?invoiceId='.$invoiceId.'">View Full Details</a></li>
                                <li><a href="updateinvoice.php?invoiceId='.$invoiceId.'">Update</a></li>
                                <li><a href="deleteinvoice.php?invoiceId='.$invoiceId.'">Delete</a></li>
                              </ul>
                            </div>
                          </td>
                        </tr>				
				';
				$count++;
			}
		}

?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
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
	<script>
	var modals = document.getElementById('addcompany');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementById("close1");

// When the user clicks on the button, open the modal 
btn.onclick = function() {
    modals.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
	//alert("hello");
    modals.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modals.style.display = "none";
    }
}</script>

  </body>
</html>