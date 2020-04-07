<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['cid']))
{
	header('location:user.php');
}
?>
			<?php
include('dbcon.php');

$billno=$_GET['billno'];
		$query="SELECT * FROM `customer bill` WHERE bill_number='$billno'";
				$run=mysqli_query($con,$query);
				$data=mysqli_fetch_assoc($run);
				$month=$data['month'];
?>
<script>
function validate(){
	var x=true;
			
	var c=document.getElementById('card');
	if(c.value.length!=16)
	{
		x=false;
		alert("Card Number must be of 16 digits!");
	}
	var m=document.getElementById('month');
	if(m.value=='Month')
	{
		x=false;
		alert("You have to choose a expiry month!")
	}
	var y=document.getElementById('year');
	if(y.value=='0')
	{
		x=false;
		alert("You have to choose a expiry year!")
	}
	var cvv=document.getElementById('cvv');
	if(isNaN(cvv.value)||cvv.value.length!=3){
	x=false;
		alert("Enter a valid CVV!")
 }
	
	return x;
}
</script>
	<div class="container" id="cnt">
    <div class="row">
        <div class="col-xs-12 col-md-4 col-md-offset-4">
		    <form role="form" method="post" action="" onsubmit="return validate()">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <h3 class="text-center">Payment Details</h3>
                    </div>
                </div>
                <br>
                <div class="container" id="mc">
                <div>
                   Debit Card             <input type="radio" name="x" checked="checked"/>
                 </div>
                 <div>
                   Credit Card            <input type="radio" name="x">
                </div>  
               <div>
                   Net Banking            <input type="radio" name="x">
                </div>  
            </div>
                <div class="panel-body">
                
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>CARD NUMBER</label>
                                    <div class="input-group">
                                        <input type="number" id="card" class="form-control" placeholder="Valid Card Number" onkeypress="return isNumberKey(event)" 
   required maxlength=16 />
                                        <span class="input-group-addon"><span class="fa fa-credit-card"></span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-7 col-md-7">
                            	<div class="row">
                                <div class="form-group" id="frm">
                                	
                                    <label><span class="hidden-xs">     EXPIRATION</span><span class="visible-xs-inline"></span> DATE</label>
                                   
<select name="month" id="month">
    <option value="Month">Month</option>
    <option value="jan">January</option>
    <option value="feb">February</option>
    <option value="mar">March</option>
    <option value="apr">April</option>
    <option value="may">May</option>
    <option value="jun">June</option>
    <option value="jul">July</option>
    <option value="aug">August</option>
    <option value="sep">September</option>
    <option value="oct">October</option>
    <option value="nov">November</option>
    <option value="dec">December</option>
</select>
 <select name="year" id="year">
    <option value="Year">Year</option>
   </select>
                                </div>
                                </div>
                            </div>

                            <div class="col-xs-5 col-m
							d-5 pull-right">
                                <div class="form-group">
                                    <label>CVV CODE</label>
                                    <input type="password"  class="form-control" id="cvv" placeholder="CVV" onkeypress="return isNumberKey(event)" 
    maxlength=3 />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Total Charges</label>
                                    <input type="text" class="form-control" value="<?php echo $data['cust_bill'];?>" placeholder="" readonly />
                                </div>
                            </div>
                        </div>
                   
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-warning btn-lg btn-block" type="submit" name="payment">Process payment</button>
                        </div>
						 </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($_POST['payment']))
{
		 $query="UPDATE `customer bill` SET `cust_status`='PAID' WHERE  bill_number='$billno'";
		 	$run=mysqli_query($con,$query);
 if($run)
 {?>
	<script>
	alert("You have successfully paid your bill!");
	window.open('usertable.php?month=<?php echo $month?>','_self');
	</script>
	<?php
}
}
?>


<style>
    .cc-img {
        margin: 0 auto;
    }
    #frm {
    	padding-left: 30px;
    }
    #cnt {
    	padding-top: 75px;
    }
   </style>
<script type="text/javascript">
var select=document.getElementById("year");

select.innerHTML="";
for(var i=2018;i<=2050;i++)
{
    var opt=i;
    if(i==2018)
    {
        
      select.innerHTML+="<option value=0>Year</option>";  
  }
   else
   { 
    select.innerHTML+="<option value="+opt+">"+opt+"</option>";}
}
</script>
</body>
</html>