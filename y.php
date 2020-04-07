<!DOCTYPE html>
<html>
<?php
session_start();
if(!isset($_SESSION['cid']))
{
	header('location:user.php');
}
?>
<head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container" id="cnt">
    <div class="row">
        <div class="col-xs-12 col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <h3 class="text-center">View Bill</h3>
                    </div>
                </div>
                <br>
             
			 		<?php
include('dbcon.php');
$cid=$_SESSION['cid'];
		$query="SELECT * FROM `customer` WHERE cust_id='$cid'";
				$run=mysqli_query($con,$query);
				$data=mysqli_fetch_assoc($run);
?>
			
                <div class="panel-body">
                    <form role="form" method="post" action="">
                       
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Customer Number</label>
                                    <input type="text" class="form-control" name="cust_id" placeholder="" value="<?php echo $data['cust_id']?>" readonly />
                                </div>
                            </div>
                        </div>
                   
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Month</label><br>
                                    <select name="month" id="month">
    <option value="">Select Month</option>
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
</select>
                                </div>
                            </div>
                        </div>
     
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-warning btn-lg btn-block" type="submit" name="bill">View Bill</button>
                        </div>
                    </div>
                </div>
            </div>
			               </form>
        </div>
    </div>
</div>
<?php
if(isset($_POST['bill']))
{
	$id=$_POST['cust_id'];
	$month=$_POST['month'];
	echo $id;
	include('dbcon.php');
		$query="SELECT * FROM `customer bill` WHERE month='$month' and cust_id='$id'";
				$run=mysqli_query($con,$query);
				$count=mysqli_num_rows($run);
				if($count<1)
				{
					?>
				
				<script>
				alert("No bills found in the record!");
				</script>
				<?php
}
else
{
	?>
	<script>
	window.open('usertable.php?month=<?php echo $month?>');
	</script>
	<?php
}
}
?>



 



<style>
    .cc-img {
        margin: 0 auto;
    }
    #cnt {
        padding-top: 75px;
    }
</style>

<script type="text/javascript">

var d = new Date();
var monthArray = new Array();
monthArray[0] = "January";
monthArray[1] = "February";
monthArray[2] = "March";
monthArray[3] = "April";
monthArray[4] = "May";
monthArray[5] = "June";
monthArray[6] = "July";
monthArray[7] = "August";
monthArray[8] = "September";
monthArray[9] = "October";
monthArray[10] = "November";
monthArray[11] = "December";
for(m = 0; m <= 11; m++) {
    var optn = document.createElement("OPTION");
    optn.text = monthArray[m];
    // server side month start from one
    optn.value = (m+1);
 
    // if june selected
   
    document.getElementById('month').options.add(optn);
}
</script>

</body>
</html>