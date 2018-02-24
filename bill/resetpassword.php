<?php 
session_start();
include 'connection.php';
		 $error="";
	 if ((isset($_SESSION['username']) && $_SESSION['username'] != '')) {
		     if(isset($_POST["username"])&& isset($_POST["password"] ))
     {
       $query = "Select * from user";
          if($result = mysqli_query($link,$query)){
            while ($row = mysqli_fetch_array($result)) {
              if($row[1]==$_POST["username"])
              {
                $user=$_POST["username"];
                $pass=$_POST["password"];
                $query1="UPDATE user SET password = '{$pass}' where user='{$user}'";
                if(mysqli_query($link,$query1))
                  header('Location:resetmessage.html');
                else
                  die();

              }
              else{
                  header('Location:passworderror.html');
              }
            }
            
          }
          else{
            die();
          }
     }
	 }
	 else{
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
  <body>
    <div class="login">
      <div class="login-body" style="text-align: center;">
        <a class="login-brand" href="index.php">
          <h3>Billing System</h3>
        </a>
        <h3 class="login-heading">Reset Password</h3>
        <div class="login-form">
			<?php echo $error; ?>
          <form data-toggle="validator" method="post" action=<?php echo $_SERVER['PHP_SELF'] ?>>
            <div class="form-group">
              <label for="username" class="control-label">Username</label>
              <input id="username" class="form-control" type="text" name="username" spellcheck="false" autocomplete="off" data-msg-required="Please enter your username." required>
            </div>
            <div class="form-group">
              <label for="password" class="control-label">Password</label>
              <input id="password" class="form-control" type="password" name="password" minlength="6" data-msg-minlength="Password must be 6 characters or more." data-msg-required="Please enter your password." required>
            </div>
            <div class="form-group">
              <label for="password" class="control-label">Confirm Password</label>
              <input id="password" class="form-control" type="password" name="confirmpassword" minlength="6" data-msg-minlength="Password must be 6 characters or more." data-msg-required="Please enter your password." required>
            </div>
            <div class="form-group">
              <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
            </div>
            <div class="form-group">
              <ul class="list-inline">
                <li>
                </li>
              </ul>
            </div>
          </form>
        </div>
      </div>
      <div class="login-footer">
        <ul class="list-inline">
          <li>|</li>
          <li><small>© 2017 <a href="http:/www.mnsdevelopers.com">MNS Developers></a></small></li>
          <li>|</li>		  
        </ul>
      </div>
    </div>
    <script src="js/vendor.min.js"></script>
    <script src="js/elephant.min.js"></script>
  </body>
</html>