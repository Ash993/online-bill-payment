<!doctype html>
<html>
<?php
session_start();
if(!isset($_SESSION['cid']))
{
	header('location:user.php');
}
?>
    <head>
        <meta charset = "utf-8" />
        <title>
            USER PAGE
        </title>
        <meta name  ="viewport" content = "width=device width,initial scale = 1">
        <link rel = "stylesheet" type = "text/css" media="screen" href="styleAT.css" />
        </head>
        <body>
			<?php
include('dbcon.php');
$cid=$_SESSION['cid'];
		$query="SELECT * FROM `customer bill` WHERE cust_id='$cid'";
				$run=mysqli_query($con,$query);
				
?>

            <table>
                <caption> don't be late!</caption>
                <tr>
                   
                    <th>Name</th>
                    <th>bill (Rs.)</th>
					 <th>bill number</th>
                     <th>Month</th>
                    <th>payment status</th>
                    <th>penality</th>
					<th>Make Payment</th>
                </tr>
				<?php
				while($data=mysqli_fetch_assoc($run)){
					$id=$data['cust_id'];
								$query="SELECT * FROM `customer` WHERE cust_id='$id'";
				$run2=mysqli_query($con,$query);
				$data2=mysqli_fetch_assoc($run2);
				?>
				<tr>
                   
                    <th><?php echo $data2['cust_name']?></th>
                    <th><?php echo $data['cust_bill']?></th>
					 <th><?php echo $data['bill_number']?></th>
		             <th><?php echo $_GET['month']?></th>					 
                    <th><?php echo $data['cust_status']?></th>
                    <th><?php echo $data['cust_penalty']?></th>
					<?php
					if($data['cust_status']=='DUE')
					{
						?>
						                    <th><a href="x.php?billno=<?php echo $data['bill_number']?>"><button>Pay Bill</button></a></th>
						<?php
					}
					else
					{
						?>
							<th>Bill Paid</th>
							<?php
					}
					?>
				
                </tr>
				<?php
				}
				?>
            </table>
        </body>
</html>
