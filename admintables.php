<!doctype html>
<html>
<?php
session_start();
if(!isset($_SESSION['id']))
{
	header('location:admin.php');
}
?>
    <head>
        <meta charset = "utf-8" />
        <title>
            ADMIN PAGE
        </title>
        <meta name  ="viewport" content = "width=device width,initial scale = 1">
        <link rel = "stylesheet" type = "text/css" media="screen" href="styleAT.css" />
        </head>
        <body>
		<?php
include('dbcon.php');
		$query="SELECT * FROM `customer bill` WHERE 1";
				$run=mysqli_query($con,$query);
				
?>
            <table>
                <caption> confidential!</caption>
                <tr>
                    <th> user_id</th>
                    <th>name</th>
                    <th>bill</th>
                    <th>payment status</th>
                </tr>
				<?php while($data=mysqli_fetch_assoc($run)){
								$id=$data['cust_id'];
								$query="SELECT * FROM `customer` WHERE cust_id='$id'";
				$run2=mysqli_query($con,$query);
				$data2=mysqli_fetch_assoc($run2);
								?>
                                <tr>
                                    <td><?php echo $data2['cust_name']?></td>
                                    <td><?php echo $data2['cust_email']?></td>
                                    <td>Rs. <?php echo $data['cust_bill']?></td>
									 <td><?php echo $data['cust_status']?></td>
                                </tr>
								<?php
							}
								?>
            </table>
        </body>
</html>
