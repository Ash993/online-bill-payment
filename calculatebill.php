<!DOCTYPE html>
<html>
<?php
session_start();
if(!isset($_SESSION['id']))
{
	header('location:admin.php');
}
?>
<head>
<style>
 .center{margin: auto;
         width: 80%;
         padding:20px;
         position:absolute;
         text-align:center;
         font-size: 20px;
         font-weight:bold;
         }
 </style>
 </head>
<body>
<script>
function validate(){
	var x=confirm('Do you want to generate bill for this customer?');
	return x;
	
}
</script>
<div class="center">
<h1 style="font-size:60px">Calculate Bill</h1>
<form action="" method="get">
<?php
if(isset($_GET['search']))
{
?>
Customer Number:
<input type="text" name="cust_nmb" value="<?php echo $_GET['cust_nmb']?>">
<?php
}
else
{
	
	?>
	Customer Number:
	<input type="text" name="cust_nmb">
	<?php
}
?>
<input type="submit" name="search" value="Search Customer"></input>
</form>
<?php
if(isset($_GET['search'])){
	$cust_number=$_GET['cust_nmb'];
	include('dbcon.php');
	$query="SELECT * FROM `customer` WHERE cust_id='$cust_number'";
	$run =mysqli_query($con,$query);
	if(mysqli_num_rows($run)<1){
		?>
<script>
alert("No such customer exists!");
</script>

		<?php
	}
	
	else{
	$data= mysqli_fetch_assoc($run);
$id=$data['cust_id'];
$billnumber=mt_rand(10000,99999);								
			?>
<form method="post" action="" onsubmit="return validate()">			
Customer Name:
<input type="text" name="cust_name" value="<?php echo $data['cust_name']?>" readonly><br><br>
Bill Number:

<input type="text" name="cust_bill_nmb" value="<?php echo $billnumber?>" readonly><br><br>
Month:
<select name="month" required>

  <option value="January">January</option>
  <option value="February">February</option>
  <option value="March">March</option>
  <option value="April">April</option>
  <option value="May">May</option>
  <option value="June">June</option>
  <option value="July">July</option>
  <option value="August">August</option>
  <option value="September">September</option>
  <option value="October">October</option>
  <option value="November">November</option>
  <option value="December">December</option>
</select><br><br>
<script>
function f(){
	var x=document.getElementById('unit');
	
<?php
		$query="SELECT * FROM `admin`";
	$run1 =mysqli_query($con,$query);
	$data1=mysqli_fetch_assoc($run1);

	$kwh=$data1['kwh_cost'];
?>
var y=document.getElementById('bill');
y.value=x.value*<?php echo $kwh?>;
}
</script>
Expiry Date:<input type="date" name="exp_date" required><br><br>
Unit Consumed:
<input type="number" name="unit_used" id="unit" value="0" required><br><br>
Bill Amount:
<input type="number" name="bill_amt" value="0"  id="bill" readonly> <input type="button" onclick="f()" value="Calculate" name="calculatebill"><br><br>
<input type="submit"  value="Generate Bill" name="calculatebill"/>
</form>
</div>
<?php
	}
}

if(isset($_POST['calculatebill']))
{
	$id=$_GET['cust_nmb'];
	$custname=$_POST['cust_name'];
	$custbillno=$_POST['cust_bill_nmb'];
	$month=$_POST['month'];
	$expdate=$_POST['exp_date'];
	$unit=$_POST['unit_used'];
	$bill=$_POST['bill_amt'];

			$query="INSERT INTO `customer bill`(`cust_id`, `cust_expiry_date`, `month`, `unit_used`, `cust_bill`, `bill_number`, `cust_status`, `cust_penalty`) VALUES ('$id','$expdate','$month','$unit','$bill','$custbillno','DUE','0')";
		$run=mysqli_query($con,$query);
		if($run){
			?>
			<script>
			alert("The bill for the customer is successfully generated!");
			window.open('admintables.php','_self');
			</script>
		<?php
		}
}
?>

</body>
</html>