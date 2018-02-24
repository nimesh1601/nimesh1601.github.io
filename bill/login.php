<?php 
session_start();
include 'connection.php';
     $error="";
   if ((isset($_SESSION['username']) && $_SESSION['username'] != '')) {
    header('Location:index.php');
   }
   else{
     if(isset($_POST["username"])&& isset($_POST["password"] ))
     {
       $query = "Select * from user";
          if($result = mysqli_query($link,$query)){
            while ($row = mysqli_fetch_array($result)) {
              if($row[1]==$_POST["username"])
              {
                if($row[2]==$_POST["password"]){
                  $_SESSION['username']=$row[1];
                  $_SESSION['id']=$row[0];
                  header('Location:index.php');
                }
                else{
                  $error="Username and Password doesn't match";
                }
                
              }
              else{
                  $error="Username doesn't exist";
              }
            }
          }
     }
     else{
     // die();
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
  <body>
    <div class="login">
      <div class="login-body" style="text-align: center;">
        <a class="login-brand" href="login.php">
          <h3>Billing System</h3>
        </a>
        <h3 class="login-heading">Sign in</h3>
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
              <button class="btn btn-primary btn-block" type="submit">Sign in</button>
            </div>
            <div class="form-group">
              <ul class="list-inline">
                <li>
                </li>
              </ul>
              <ul class="list-inline">
                <li><a href="resetpassword.php">Forgot password?</a></li>
              </ul>
            </div>
          </form>
        </div>
      </div>
      <div class="login-footer">
        <ul class="list-inline">
          <li>|</li>
          <li>© MNS Developers 2017</li>
          <li>|</li>      
        </ul>
      </div>
    </div>
    <script src="js/vendor.min.js"></script>
    <script src="js/elephant.min.js"></script>
  </body>
</html>