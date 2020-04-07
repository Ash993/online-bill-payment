
<?php
session_start();
if(isset($_SESSION['cid']))
	header('location:user1.php');
?> 
<html>
<head>
    <meta charset = "utf-8">
    <title>
        USER
    </title>
    <link rel="stylesheet" href = " styleU.css ">
</head>
<div class = "login-box">
<form method="post" action="">
    <h1>User Login</h1>
    <div class = "text-box">
            <i class="fa fa-user" aria-hidden="true"></i>
        <input type = "text" placeholder = "Username" name ="username" value= "">
    </div>

    <div class = "text-box">
            <i class="fa fa-lock" aria-hidden="true"></i>
            <input type = "password" placeholder = "Password" name ="password" value= "">
        </div>
    <input class = "btn" type = "submit" name = "login" value = "Submit">
	</form>
	<?php
	if(isset($_POST['login']))
	{
		$username=$_POST['username'];
		$password=$_POST['password'];
		include('dbcon.php');
		$query="SELECT * FROM `customer` WHERE cust_name='$username' AND cust_pass='$password'";
		$run =mysqli_query($con,$query);
		if(mysqli_num_rows($run)<1){
		?>
<script>
alert("Username or Password not found!")
		</script>
		<?php
	}
	else{
				$data=mysqli_fetch_assoc($run);
		$_SESSION['cid']=$data['cust_id'];
		?>
				<script>
				window.open('user1.php','_self');
				</script>
				<?php
			}

				

	
	}
?>
		
	
</div>
</html>