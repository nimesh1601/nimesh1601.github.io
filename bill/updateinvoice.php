<?php 
	session_start();
	include 'connection.php';
	 if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {
		 header('Location:login.php');
	 }
else{
	if(isset($_GET["invoiceId"])){
		$invoiceId =$_GET["invoiceId"];
    $query = "SELECT * FROM invoice WHERE invoiceId='{$invoiceId}'";
    if($result = mysqli_query($link,$query)){
      while ($row = mysqli_fetch_array($result)) {
      $invoiceId = $row["invoiceId"];
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
    header('Location:updateerrormessage.html');
  }
	}
else if(isset($_POST["invoiceNo"]))
{
      $invoiceId=$_POST["invoiceId"];
      $invoiceNo=$_POST["invoiceNo"];
      $mot= $_POST["mot"];
      $vehicleNo = $_POST["vehicleNo"];
      $dueDate=$_POST["dueDate"];

      $companyName=$_POST["companyName"];
      $companyId=$_POST["companyId"];
      $address= $_POST["address"];
      $gstin = $_POST["gstin"];
      $pan=$_POST["pan"];
      $state=$_POST["state"];
      $stateCode=$_POST["stateCode"];

      $itotal = $_POST["itotal"];

      $aproductName= $_POST["productName"];
      $ahsnCode = $_POST["hsnCode"];
      $anos= $_POST["nos"];
      $aqty = $_POST["qty"];
      $arate = $_POST["rate"];
      $aamount = $_POST["amount"];

      $cartage=$_POST["cartage"];
      $packing=$_POST["packing"];     
      $mtotal=$_POST["mtotal"];

      $cgstp=$_POST["cgstp"];
      $cgst=$cgstp*$mtotal/100;
      $sgstp=$_POST["sgstp"];
      $sgst=$sgstp*$mtotal/100;
      $igstp=$_POST["igstp"];
      $igst=$igstp*$mtotal/100;
      $gstTotal=$_POST["gstTotal"];

      $gstReverse= $_POST["gstReverse"];

      $gtotal=$_POST["gtotal"];
      if(!$companyId){
        //die('entered');
        $query1 = "INSERT INTO `company` (`companyName`,`address`,`gstin`,`pan`,`state`,`stateCode`) VALUES ('{$companyName}','{$address}','{$gstin}','{$pan}','{$state}','{$stateCode}')";

        if(mysqli_query($link, $query1)){
          $query = "SELECT * FROM company where companyName= '".$companyName."'";
          if($result = mysqli_query($link,$query)){
            $count=1;
            while ($row = mysqli_fetch_array($result)) {
              $companyId=$row[0];
            }
            //header('Location:index.php');
            //header('Location:invoiceadd.php?companyId='.$companyId);


            }
          

        }       
      }
      //die($companyId);
	if(1)
	{
		$query = "UPDATE invoice SET
      invoiceNo='{$invoiceNo}',
      mot= '{$mot}',
      vehicleNo = '{$vehicleNo}',
      dueDate='{$dueDate}',
      companyId='{$companyId}',
      address= '{$address}',
      gstin = '{$gstin}',
      pan='{$pan}',
      state='{$state}',
      stateCode='{$stateCode}',
      itotal = '{$itotal}',
      cartage='{$cartage}',
      packing='{$packing}',     
      mtotal='{$mtotal}',
      cgst='{$cgst}',
      cgstP='{$cgstp}',
      sgst='{$sgst}',
      sgstP='{$sgstp}',
      igst='{$igst}',
      igstP='{$igstp}',
      gstTotal='{$gstTotal}',
      gtotal='{$gtotal}',
      gstReverse= '{$gstReverse}'

		WHERE invoiceId={$invoiceId}";
		if(mysqli_query($link, $query)){
			$query2 = "DELETE FROM invoicedetails WHERE invoiceId='{$invoiceId}'";
      if(mysqli_query($link, $query2)){
          foreach( $aproductName as $key => $productName ) {
            $hsnCode = $ahsnCode[$key];
            $rate = $arate[$key];
            $nos = $anos[$key];
            $qty = $aqty[$key];
            $amount = $aamount[$key];
            $query1 = "INSERT INTO `invoicedetails` (`invoiceId`,`productName`,`hsnCode`,`nos`,`qty`,`rate`,`amount`) VALUES ('{$invoiceId}','{$productName}','{$hsnCode}','{$nos}','{$qty}','{$rate}','{$amount}')";
            if(mysqli_query($link, $query1)){
              header('Location:viewinvoicefull.php?invoiceId='.$invoiceId);
            }
          }

      }
		}
    else{

      header('Location:updateerrormessage.html');
      
      //die($id);
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
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript">
    !function(a,b){"use strict";"undefined"!=typeof module&&module.exports?module.exports=b(require("jquery")):"function"==typeof define&&define.amd?define(["jquery"],function(a){return b(a)}):b(a.jQuery)}(this,function(a){"use strict";var b=function(c,d){this.$element=a(c),this.options=a.extend({},b.defaults,d),this.matcher=this.options.matcher||this.matcher,this.sorter=this.options.sorter||this.sorter,this.select=this.options.select||this.select,this.autoSelect="boolean"!=typeof this.options.autoSelect||this.options.autoSelect,this.highlighter=this.options.highlighter||this.highlighter,this.render=this.options.render||this.render,this.updater=this.options.updater||this.updater,this.displayText=this.options.displayText||this.displayText,this.source=this.options.source,this.delay=this.options.delay,this.$menu=a(this.options.menu),this.$appendTo=this.options.appendTo?a(this.options.appendTo):null,this.fitToElement="boolean"==typeof this.options.fitToElement&&this.options.fitToElement,this.shown=!1,this.listen(),this.showHintOnFocus=("boolean"==typeof this.options.showHintOnFocus||"all"===this.options.showHintOnFocus)&&this.options.showHintOnFocus,this.afterSelect=this.options.afterSelect,this.addItem=!1,this.value=this.$element.val()||this.$element.text()};b.prototype={constructor:b,select:function(){var a=this.$menu.find(".active").data("value");if(this.$element.data("active",a),this.autoSelect||a){var b=this.updater(a);b||(b=""),this.$element.val(this.displayText(b)||b).text(this.displayText(b)||b).change(),this.afterSelect(b)}return this.hide()},updater:function(a){return a},setSource:function(a){this.source=a},show:function(){var d,b=a.extend({},this.$element.position(),{height:this.$element[0].offsetHeight}),c="function"==typeof this.options.scrollHeight?this.options.scrollHeight.call():this.options.scrollHeight;if(this.shown?d=this.$menu:this.$appendTo?(d=this.$menu.appendTo(this.$appendTo),this.hasSameParent=this.$appendTo.is(this.$element.parent())):(d=this.$menu.insertAfter(this.$element),this.hasSameParent=!0),!this.hasSameParent){d.css("position","fixed");var e=this.$element.offset();b.top=e.top,b.left=e.left}var f=a(d).parent().hasClass("dropup"),g=f?"auto":b.top+b.height+c,h=a(d).hasClass("dropdown-menu-right"),i=h?"auto":b.left;return d.css({top:g,left:i}).show(),this.options.fitToElement===!0&&d.css("width",this.$element.outerWidth()+"px"),this.shown=!0,this},hide:function(){return this.$menu.hide(),this.shown=!1,this},lookup:function(b){if("undefined"!=typeof b&&null!==b?this.query=b:this.query=this.$element.val()||this.$element.text()||"",this.query.length<this.options.minLength&&!this.options.showHintOnFocus)return this.shown?this.hide():this;var d=a.proxy(function(){a.isFunction(this.source)?this.source(this.query,a.proxy(this.process,this)):this.source&&this.process(this.source)},this);clearTimeout(this.lookupWorker),this.lookupWorker=setTimeout(d,this.delay)},process:function(b){var c=this;return b=a.grep(b,function(a){return c.matcher(a)}),b=this.sorter(b),b.length||this.options.addItem?(b.length>0?this.$element.data("active",b[0]):this.$element.data("active",null),this.options.addItem&&b.push(this.options.addItem),"all"==this.options.items?this.render(b).show():this.render(b.slice(0,this.options.items)).show()):this.shown?this.hide():this},matcher:function(a){var b=this.displayText(a);return~b.toLowerCase().indexOf(this.query.toLowerCase())},sorter:function(a){for(var e,b=[],c=[],d=[];e=a.shift();){var f=this.displayText(e);f.toLowerCase().indexOf(this.query.toLowerCase())?~f.indexOf(this.query)?c.push(e):d.push(e):b.push(e)}return b.concat(c,d)},highlighter:function(a){var b=this.query;if(""===b)return a;var f,c=a.match(/(>)([^<]*)(<)/g),d=[],e=[];if(c&&c.length)for(f=0;f<c.length;++f)c[f].length>2&&d.push(c[f]);else d=[],d.push(a);var h,g=new RegExp(b,"g");for(f=0;f<d.length;++f)h=d[f].match(g),h&&h.length>0&&e.push(d[f]);for(f=0;f<e.length;++f)a=a.replace(e[f],e[f].replace(g,"<strong>$&</strong>"));return a},render:function(b){var c=this,d=this,e=!1,f=[],g=c.options.separator;return a.each(b,function(a,c){a>0&&c[g]!==b[a-1][g]&&f.push({__type:"divider"}),!c[g]||0!==a&&c[g]===b[a-1][g]||f.push({__type:"category",name:c[g]}),f.push(c)}),b=a(f).map(function(b,f){if("category"==(f.__type||!1))return a(c.options.headerHtml).text(f.name)[0];if("divider"==(f.__type||!1))return a(c.options.headerDivider)[0];var g=d.displayText(f);return b=a(c.options.item).data("value",f),b.find("a").html(c.highlighter(g,f)),g==d.$element.val()&&(b.addClass("active"),d.$element.data("active",f),e=!0),b[0]}),this.autoSelect&&!e&&(b.filter(":not(.dropdown-header)").first().addClass("active"),this.$element.data("active",b.first().data("value"))),this.$menu.html(b),this},displayText:function(a){return"undefined"!=typeof a&&"undefined"!=typeof a.name?a.name:a},next:function(b){var c=this.$menu.find(".active").removeClass("active"),d=c.next();d.length||(d=a(this.$menu.find("li")[0])),d.addClass("active")},prev:function(a){var b=this.$menu.find(".active").removeClass("active"),c=b.prev();c.length||(c=this.$menu.find("li").last()),c.addClass("active")},listen:function(){this.$element.on("focus",a.proxy(this.focus,this)).on("blur",a.proxy(this.blur,this)).on("keypress",a.proxy(this.keypress,this)).on("input",a.proxy(this.input,this)).on("keyup",a.proxy(this.keyup,this)),this.eventSupported("keydown")&&this.$element.on("keydown",a.proxy(this.keydown,this)),this.$menu.on("click",a.proxy(this.click,this)).on("mouseenter","li",a.proxy(this.mouseenter,this)).on("mouseleave","li",a.proxy(this.mouseleave,this)).on("mousedown",a.proxy(this.mousedown,this))},destroy:function(){this.$element.data("typeahead",null),this.$element.data("active",null),this.$element.off("focus").off("blur").off("keypress").off("input").off("keyup"),this.eventSupported("keydown")&&this.$element.off("keydown"),this.$menu.remove(),this.destroyed=!0},eventSupported:function(a){var b=a in this.$element;return b||(this.$element.setAttribute(a,"return;"),b="function"==typeof this.$element[a]),b},move:function(a){if(this.shown)switch(a.keyCode){case 9:case 13:case 27:a.preventDefault();break;case 38:if(a.shiftKey)return;a.preventDefault(),this.prev();break;case 40:if(a.shiftKey)return;a.preventDefault(),this.next()}},keydown:function(b){this.suppressKeyPressRepeat=~a.inArray(b.keyCode,[40,38,9,13,27]),this.shown||40!=b.keyCode?this.move(b):this.lookup()},keypress:function(a){this.suppressKeyPressRepeat||this.move(a)},input:function(a){var b=this.$element.val()||this.$element.text();this.value!==b&&(this.value=b,this.lookup())},keyup:function(a){if(!this.destroyed)switch(a.keyCode){case 40:case 38:case 16:case 17:case 18:break;case 9:case 13:if(!this.shown)return;this.select();break;case 27:if(!this.shown)return;this.hide()}},focus:function(a){this.focused||(this.focused=!0,this.options.showHintOnFocus&&this.skipShowHintOnFocus!==!0&&("all"===this.options.showHintOnFocus?this.lookup(""):this.lookup())),this.skipShowHintOnFocus&&(this.skipShowHintOnFocus=!1)},blur:function(a){this.mousedover||this.mouseddown||!this.shown?this.mouseddown&&(this.skipShowHintOnFocus=!0,this.$element.focus(),this.mouseddown=!1):(this.hide(),this.focused=!1)},click:function(a){a.preventDefault(),this.skipShowHintOnFocus=!0,this.select(),this.$element.focus(),this.hide()},mouseenter:function(b){this.mousedover=!0,this.$menu.find(".active").removeClass("active"),a(b.currentTarget).addClass("active")},mouseleave:function(a){this.mousedover=!1,!this.focused&&this.shown&&this.hide()},mousedown:function(a){this.mouseddown=!0,this.$menu.one("mouseup",function(a){this.mouseddown=!1}.bind(this))}};var c=a.fn.typeahead;a.fn.typeahead=function(c){var d=arguments;return"string"==typeof c&&"getActive"==c?this.data("active"):this.each(function(){var e=a(this),f=e.data("typeahead"),g="object"==typeof c&&c;f||e.data("typeahead",f=new b(this,g)),"string"==typeof c&&f[c]&&(d.length>1?f[c].apply(f,Array.prototype.slice.call(d,1)):f[c]())})},b.defaults={source:[],items:8,menu:'<ul class="typeahead dropdown-menu" role="listbox"></ul>',item:'<li><a class="dropdown-item" href="#" role="option"></a></li>',minLength:1,scrollHeight:0,autoSelect:!0,afterSelect:a.noop,addItem:!1,delay:0,separator:"category",headerHtml:'<li class="dropdown-header"></li>',headerDivider:'<li class="divider" role="separator"></li>'},a.fn.typeahead.Constructor=b,a.fn.typeahead.noConflict=function(){return a.fn.typeahead=c,this},a(document).on("focus.typeahead.data-api",'[data-provide="typeahead"]',function(b){var c=a(this);c.data("typeahead")||c.typeahead(c.data())})});</script>
<script>
    $(document).ready(function () {
        $('#companyName').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "sample2.php",
                    data: 'query=' + query,            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            }
        });
    });
</script>
<script>
function showHint(str) {
    if (str.length == 0) {

        document.getElementById("companyName").innerHTML ='';
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "sample.php?q=" + str, true);
        xmlhttp.send();
    }
}
//alert(<?php echo $companyName ?>);

</script>
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
              <span class="d-ib">Edit Invoice</span>

            </h1>
            <p class="title-bar-description">
              <small>This form is concerned for editing Invoie only</small>
            </p>
          </div>
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
			
			<form action=<?php echo $_SERVER['PHP_SELF'] ?> method="post" id="updatec">
			<input type="hidden" value= <?php echo "'".$invoiceId."'"; ?> name ="invoiceId">
              <div class="form-group">
                <h4>Company Details :</h4>
              </div>        
              <div class="form-group">
                <label for="name">Company Name</label>
                <input name="companyName" class="form-control" type="text" id="companyName" onchange="showHint(this.value)" value=<?php echo '"'.$companyName.'"' ?> >
              </div>
              <p id="txtHint">
              </p>
              <br>
              <div class="form-group">
                <h4>Invoce Details :</h4>
              </div>                
              <div>
                <div class="form-group">
                  <label for="invoiceNo">Invoice No</label>
                  <input name="invoiceNo" class="form-control" type="text" value=<?php echo '"'.$invoiceNo.'"' ?>>
                </div>
              </div>
              <div class="row gutter-xs">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="mot">Mode of Transport</label>
                    <input name="mot" class="form-control" type="text" value=<?php echo '"'.$mot.'"' ?>>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="vehicleNo">Vehicle No</label>
                    <input name="vehicleNo" class="form-control" type="text" value=<?php echo '"'.$vehicleNo.'"' ?>>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="dueDate">Due Date</label>
                <input name="dueDate" class="form-control" type="text" value=<?php echo '"'.$dueDate.'"' ?>>
              </div>
              <br>
              <div class="form-group">
                <h4>Product Details :</h4>
              </div>
              <div id="productd">
                <?php
                  $query = "SELECT * FROM invoicedetails WHERE invoiceId='{$invoiceId}'";
                      if($result = mysqli_query($link,$query)){
                        while ($row = mysqli_fetch_array($result)) {
                          $productName= $row["productName"];
                          $hsnCode = $row["hsnCode"];
                          $nos= $row["nos"];
                          $qty = $row["qty"];
                          $rate = $row["rate"];
                          $amount = $row["amount"];
                          echo '
                            <div class="form-group">
                              <label for="productName">Product Name</label>
                              <input name="productName[]" class="form-control" type="text" value="'.$productName.'"">
                            </div>
                            <div class="row gutter-xs">
                              <div class="col-sm-3">
                                <div class="form-group">
                                  <label for="hsnCode">HSM Code</label>
                                  <input name="hsnCode[]" class="form-control" type="text"value="'.$hsnCode.'"">
                                </div>
                              </div>
                              <div class="col-sm-3">
                                <div class="form-group">
                                  <label for="nos">Identity marks/Nos</label>
                                  <input name="nos[]" class="form-control" type="text"value="'.$nos.'"">
                                </div>
                              </div>
                              <div class="col-sm-3">
                                <div class="form-group">
                                  <label for="qty">QTY</label>
                                  <input name="qty[]" class="form-control" type="text"value="'.$qty.'"">
                                </div>
                              </div>
                              <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="rate">Rate</label>
                                    <input name="rate[]" class="form-control" type="text"value="'.$rate.'"">
                                </div>
                              </div>               
                            </div>
                            <div class="form-group">
                              <label for="amount">Amount</label>
                              <input name="amount[]" class="form-control amount" type="text" onchange="caltotal()" onkeyup="caltotal()"value="'.$amount.'"">
                            </div>                          
                          ';                   
                        }
                      }                  
                ?>
              </div>
              <div class="form-group">
                <input type="button" id="addp" class="btn btn-warning" value="Add Product" onclick="addItem()">
                <input type="button" id="deletp" class="btn btn-warning" value="Delete All Products" onclick="deleteItem()">
              </div>            
              <div class="form-group">
                <label for="itotal">Total</label>
                <input name="itotal" class="form-control" type="text"  id="itotal" value=<?php echo '"'.$itotal.'"' ?> readonly="true">
              </div>
              <br>
              <div class="row gutter-xs">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="cartage">Cartage</label>
                    <input name="cartage" class="form-control" type="text" id="cartage" onkeyup="caltotal()"  required="true" value=<?php echo '"'.$cartage.'"' ?>>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="packing">Packing Charge</label>
                    <input name="packing" class="form-control" type="text" id="packing" onkeyup="caltotal()" required="true" value=<?php echo '"'.$packing.'"' ?>>
                  </div>
                </div>             
              </div>
              <div class="form-group">
                <label for="mtotal">Total</label>
                <input name="mtotal" class="form-control" type="text"  id="mtotal" value=<?php echo '"'.$mtotal.'"' ?> readonly="true">
              </div>
              <br>
              <div class="form-group">
                <h4>Tax Details :</h4>
              </div>

              <div class="row gutter-xs">
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="cgst">CGST %</label>
                    <input name="cgstp" class="form-control" type="text" id="cgst" onkeyup="caltotal()"  required="true" value=<?php echo '"'.$cgstp.'"' ?>>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="sgst">SGST %</label>
                    <input name="sgstp" class="form-control" type="text" id="sgst" onkeyup="caltotal()" required="true" value=<?php echo '"'.$sgstp.'"' ?>>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="igst">IGST %</label>
                    <input name="igstp" class="form-control" type="text" id="igst" onkeyup="caltotal()"  required="true" value=<?php echo '"'.$igstp.'"' ?>>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label for="gstReverse">GST Payable on Reverse</label>
                      <input name="gstReverse" class="form-control" type="text" id="gstReverse" onkeyup="caltotal()" value="0" required="true" value=<?php echo '"'.$gstReverse.'"' ?>>
                  </div>
                </div>
                <input type="hidden" name="gstTotal" id="gstTotal" value=<?php echo '"'.$gstTotal.'"' ?>>              
              </div>
              <div class="form-group">
                <label for="total">Grand Total</label>
                <input name="gtotal" class="form-control" type="text"  id="gtotal" value=<?php echo '"'.$gtotal.'"' ?> readonly="true">
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
    <script type="text/javascript">
      var x = $("#companyName").val();
showHint(x);
    </script>

<script type="text/javascript">
  function addItem() {
    $("#productd").append('<br> <div class="form-group"> <label for="productName">Product Name</label> <input name="productName[]" class="form-control" type="text"> </div><div class="row gutter-xs"> <div class="col-sm-3"> <div class="form-group"> <label for="hsnCode">HRM Code</label> <input name="hsnCode[]" class="form-control" type="text"> </div></div><div class="col-sm-3"> <div class="form-group"> <label for="nos">Identity marks/Nos</label> <input name="nos[]" class="form-control" type="text"> </div></div><div class="col-sm-3"> <div class="form-group"> <label for="qty">QTY</label> <input name="qty[]" class="form-control" type="text"> </div></div><div class="col-sm-3"> <div class="form-group"> <label for="rate">Rate</label> <input name="rate[]" class="form-control" type="text"> </div></div></div><div class="form-group"> <label for="amount">Amount</label> <input name="amount[]" class="form-control amount" type="text" onchange="caltotal()" onkeyup="caltotal()"> </div>');
       

  }

  function deleteItem() {
    $("#productd").html(' <div class="form-group"> <label for="productName">Product Name</label> <input name="productName[]" class="form-control" type="text"> </div><div class="row gutter-xs"> <div class="col-sm-3"> <div class="form-group"> <label for="hsnCode">HRM Code</label> <input name="hsnCode[]" class="form-control" type="text"> </div></div><div class="col-sm-3"> <div class="form-group"> <label for="nos">Identity marks/Nos</label> <input name="nos[]" class="form-control" type="text"> </div></div><div class="col-sm-3"> <div class="form-group"> <label for="qty">QTY</label> <input name="qty[]" class="form-control" type="text"> </div></div><div class="col-sm-3"> <div class="form-group"> <label for="rate">Rate</label> <input name="rate[]" class="form-control" type="text"> </div></div></div><div class="form-group"> <label for="amount">Amount</label> <input name="amount[]" class="form-control amount" type="text" onchange="caltotal()" onkeyup="caltotal()"> </div>');
  }
  function caltotal(){
      var value=0;
      $('.amount').each(function(index,data) {
        //alert("hi");
       value = parseInt($(this).val())+value;
    });
      $("#itotal").val(value);
      //value = $("#total").val();
      //value = value + $("#cgst").val()*value/100 + $("#igst").val()*value/100 +$("#sgst").val()*value/100+ $("#gstReverse").val()*value/100;
      var z = (parseInt($("#packing").val())+parseInt($("#cartage").val()))+value;
      $("#mtotal").val(z);
      var x = (parseInt($("#cgst").val())+ parseInt($("#sgst").val())+ parseInt($("#igst").val())+parseInt($("#gstReverse").val()))/100*z;
      $("#gstTotal").val(x);
      value = x +z;
      $("#gtotal").val(value);
      }
</script>

    <script src="js/elephant.min.js"></script>
    <script src="js/application.min.js"></script>
    <script src="js/demo.min.js"></script>
  </body>
</html>