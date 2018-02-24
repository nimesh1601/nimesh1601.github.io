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
  <style>
  #moredetails{
	  display:none;
  }
  </style>
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
              <span class="d-ib">Add Customer</span>

            </h1>
            <p class="title-bar-description">
              <small>This form is concerned for new customer registration only</small>
            </p>
          </div>
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
			<form action="insertcompany.php" method="post" id="clientadd" enctype="multipart/form-data">  
              <div class="form-group">
                <label for="name">Customer Name</label>
                <input name="customerName" class="form-control" type="text">
              </div>
              <div class="form-group">
                <label for="contact">Contact</label>
                <input name="contact" class="form-control" type="text">
              </div>
              <div class="form-group">
                <label for="emailId">E-mail Id</label>
                <input name="emailId" class="form-control" type="text">
              </div>
              <div class="form-group">
                <label for="birtDate">Birth Date</label>
                <input name="birthDate" class="form-control" type="date">
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