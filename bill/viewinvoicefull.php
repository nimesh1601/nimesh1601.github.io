<?php 
  session_start();
  include 'connection.php';
   if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {
     header('Location:login.php');
   }
   ?>
<?php
  if(isset($_GET["invoiceId"])){
    $query = "SELECT * FROM account";
    if($result = mysqli_query($link,$query)){
      while ($row = mysqli_fetch_array($result)) {
        $owner = $row[1];
        $mobile = $row[2];
        $tel = $row[3];
        $ogstin = $row["gstin"];
        $opan=$row["pan"];        
        $bankAccount = $row[6];
        $bank = $row[7];
        $branch = $row["branch"];
        $accNo=$row["accNo"];        
        $ifscCode = $row[10];
      }
    }    




    $invoiceId =$_GET["invoiceId"];
    $query = "SELECT * FROM invoice WHERE invoiceId='{$invoiceId}'";
    if($result = mysqli_query($link,$query)){
      while ($row = mysqli_fetch_array($result)) {
      $invoiceNo=$row["invoiceNo"];
      $mot= $row["mot"];
      $vehicleNo = $row["vehicleNo"];
      $dueDate=$row["dueDate"];
      $companyId=$row["companyId"];
      $address= $row["address"];
      $gstin = $row["gstin"];
      $pan=$row["pan"];
      $state=$row["state"];
      $stateCode=$row["stateCode"];

      $itotal = $row["itotal"];

      $cartage=$row["cartage"];
      $packing=$row["packing"];     
      $mtotal=$row["mtotal"];

      $cgstp=$row["cgstP"];
      $sgstp=$row["sgstP"];
      $igstp=$row["igstP"];
      $cgst=$row["cgst"];
      $sgst=$row["sgst"];
      $igst=$row["igst"];
      $gstTotal=$row["gstTotal"];

      $gstReverse= $row["gstReverse"];

      $gtotal=$row["gtotal"];
      }
      $query = "SELECT * FROM company WHERE companyId='{$companyId}'";
      if($result = mysqli_query($link,$query)){
        while ($row = mysqli_fetch_array($result)) {
          $companyName=$row["companyName"];
        }
      }   
  }
else{
  die('Invalid select query: ' . mysql_error());
}
  }
?>
<!DOCTYPE html>
<html lang="en">
  

<head>
<style type="text/css">
  @media print{
    @page {margin :0;}
    body {margin:1.6cm;}
  }
</style>
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
          <div class="panel">
            <div class="panel-body p-a-lg">
              <div class="row">
                <div class="col-md-12" style="text-align: center">
                  <h4>GST Invoice</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                          <th scope="row" colspan="6">
                            <div class="text-left">
                                <strong>Billed By:<br>
                                <?php echo $owner ?><br>
                                Address :F-772 Vishwakarma Indusrial Area Jaipur<br>
                                Contact :<?php echo $mobile ?><br>
                                Gstin:<?php echo $ogstin ?><br>
                                PAN :<?php echo $opan ?></strong>
                            </div>
                          </th>
                          <th scope="row" colspan="6">
                            <div class="text-right">
                                <strong>Billed To:<br>
                                <?php echo $companyName ?><br>
                                Address:<?php echo $address ?><br>
                                Gstin:<?php echo $gstin ?><br>
                                PAN :<?php echo $pan ?><br>
                                State :<?php echo $state ?><br>
                                State Code :<?php echo $stateCode ?></strong>
                            </div>
                          </th>
                        </tr>
                        <tr>
                          <th scope="row" colspan="3">
                            <div class="text-left">
                                <strong>Invoice No - <?php echo $invoiceNo ?></strong>
                            </div>
                          </th>
                          <th scope="row" colspan="3">
                            <div class="text-left">
                                <strong>Mode of Transport - <?php echo $mot ?></strong>
                            </div>
                          </th>
                          <th scope="row" colspan="3">
                            <div class="text-left">
                                <strong>Vehicle No - <?php echo $vehicleNo ?></strong>
                            </div>
                          </th>
                          <th scope="row" colspan="3">
                            <div class="text-left">
                                <strong>Due Date - <?php echo $dueDate ?></strong>
                            </div>
                          </th>
                        </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Description of Goods</th>
                          <th>HSN Code</th>
                          <th>Nos</th>
                          <th>Qty</th>
                          <th>Rate</th>
                          <th>Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $query = "SELECT * FROM invoicedetails WHERE invoiceId='{$invoiceId}'";
                          $count=0;
                              if($result = mysqli_query($link,$query)){
                                while ($row = mysqli_fetch_array($result)) {
                                  $count++;
                                  $productName= $row["productName"];
                                  $hsnCode = $row["hsnCode"];
                                  $nos= $row["nos"];
                                  $qty = $row["qty"];
                                  $rate = $row["rate"];
                                  $amount = $row["amount"];
                                  echo '
                                    <tr>
                                      <th scope="row">'.$count.'</th>                                    
                                      <td>'.$productName.'</td>
                                      <td>'.$hsnCode.'</td>
                                      <td>'.$nos.'</td>
                                      <td>'.$qty.'</td>
                                      <td>'.$rate.'</td>
                                      <td>'.$amount.'</td> 
                                    </tr>                                
                                  ';
                                }
                              }
                        ?>
                        <tr>
                          <td scope="row" colspan="3">
                            <h4>Bank Account Details</h4>
                            <?php echo $bankAccount ?><BR>
                            Bank : <?php echo $bank ?><br>
                            Ac/No : <?php echo $accNo ?><br>
                            IFSC Code : <?php echo $ifscCode ?><br>
                          </td>
                          <td scope="row" colspan="1">
                          Total Amount in words : <br><strong><u> <span id="inwords"></span></u></strong>
                          </td>                         
                          <th scope="row" colspan="2">
                            <div class="text-right">
                              Subtotal
                              <br>Cartage
                              <br>Packing Charge
                              <br>Total
                              <br> CGST @<?php echo $cgstp ?>%
                              <br> SGST @<?php echo $sgstp ?>%
                              <br> IGST @<?php echo $igstp ?>%
                              <br> Total GST
                              <br> Grand total
                              <br>Gst Payble on reverse charge
                            </div>
                          </th>
                          <td>
                            <?php echo $itotal ?>
                            <br><?php echo $cartage ?>
                            <br> <?php echo $packing ?>
                            <br> <?php echo $mtotal ?>
                            <br> <?php echo $cgst ?>
                            <br> <?php echo $sgst ?>
                            <br> <?php echo $igst ?>
                            <br> <?php echo $gstTotal ?>
                            <br>
                            <strong><span id="gtotal"><?php echo $gtotal ?></span></strong>
                            <br><?php echo $gstReverse ?>
                          </td>
                        </tr>
                        <tr>
                          <th scope="row" colspan="12">                    
                            <small>
                              <strong>
                                1.Goods once sold will not be taken back.&nbsp;<br>
                                2.Intrest @18% will be charged from the date of bill if payment is not made before due date&nbsp;<br>
                                3.Our Resposiblity ceases the moment the goods leave our godown.&nbsp;<br>
                                4.Subject to JAIPUR Jurisdiction                        
                              </strong>
    
                            </small>
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="text-center hidden-print">
                    <div class="p-y-lg">
                      <a class="btn btn-success btn-sm" href="javascript:window.print()">
                        <span class="icon icon-print icon-lg icon-fw"></span>
                        Print
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="text-center hidden-print">
                    <div class="p-y-lg">
                      <a class="btn btn-success btn-sm" href="updateinvoice.php?invoiceId=<?php echo $invoiceId ?>" >
                        <span class="icon icon-edit icon-lg icon-fw"></span>
                        Edit
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="layout-footer hidden-print">
        <div class="layout-footer-body">
          <small class="version">Version 1.0.0</small>
          <small class="copyright">2017 &copy; <a href="http://www.mnsdevelopers.com/">MNS Developers </a></small>
        </div>
      </div>
    </div>
<script type="text/javascript">
  var a = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ','eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen '];
  var b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];

  function inWords (num) {
      if ((num = num.toString()).length > 9) return 'overflow';
      n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
      if (!n) return; var str = '';
      str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
      str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
      str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
      str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
      str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'only ' : '';
      return str;
  }
  var x = parseInt($("#gtotal").html());
  //alert(x);
  $("#inwords").html(inWords(x));
</script>
  </body>

</html>