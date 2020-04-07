
<?php
session_start();
if(isset($_SESSION['id']))
{
	header('location:admin1.php');
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset = "utf-8">
    <title>
        ADMIN
    </title>
    <link rel="stylesheet" href = " styleA.css ">

</head>
<div class = "login-box">
    <h1>Admin Login</h1>
	<form method="post" action="admin.php"   data-toggle="validator" role="form">
    <div class = "text-box">
	
            <i class="fa fa-user" aria-hidden="true"></i>
		
        <input type = "text" placeholder = "Username" name ="username" value= "" required>
		</div>
   
    <div class = "text-box">
            <i class="fa fa-lock" aria-hidden="true"></i>
            <input type = "password" placeholder = "Password" name ="password" value= "" required>
        </div>
    <input class = "btn" type = "submit" name = "login" value = "Submit">
	</form>
</div>
</html>
<?php
if(isset($_POST['login'])){
	$username=$_POST['username'];
	$password=$_POST['password'];
	include('dbcon.php');
	$query="SELECT * FROM `admin` WHERE username='$username' AND password='$password'";
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
		$_SESSION['id']=$data['id'];
	
		?>
				<script>
				window.open('admin1.php','_self');
				
				</script>
				<?php
			}

				

	
	}
?>