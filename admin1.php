<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if(!isset($_SESSION['id']))
{
	header('location:admin.php');
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
       <!--Import Google Icon Font-->
       <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
       <!--Import materialize.css-->
       <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
   
       <!--Let browser know website is optimized for mobile-->
       <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>

    <nav class="blue ">
        <a href="" class="brand-logo center">Admin</a>
        <ul class="right">
                <li><a href="admin1.php"><span>Users</span></a></li>
            <li><a href="logout.php"><span>Logout</span></a></li>
			            <li><a href="update.php"><span>Update</span></a></li>
            <li><a href="admintables.php"><span>Bill Details</span></a></li>
			            <li><a href="calculatebill.php"><span>Create Bill</span></a></li>
            <li><a href=""><span class="new badge right black-text">4</span><i class="material-icons">notifications_active</i></a></li>

          
        </ul>
    </nav>

    <div class="container">
        <div class="row">
           <div class="col s12 m12">
               <div class="card-panel z-depth-5 hoverable">
                    <table class="stripped">
                            <tr>
							<th>CUSTOMER NO.</th>
                                <th>NAME</th>
								<th>SURNAME</th>
                                <th>EMAIL</th>
								<th>TELEPHONE NO.</th>
                                <th>DATE OF BIRTH</th>
								<th>ADDRESS</th>
								<th>POST CODE</th>
         
         
                            </tr>
							
                            <tbody>
							<?php
							include('dbcon.php');
							$query="SELECT * FROM `customer` WHERE 1";
					
				$run=mysqli_query($con,$query);
							 while($data=mysqli_fetch_assoc($run)){
								
								?>
                                <tr>
								<td><?php echo $data['cust_id']?></td>
                                    <td><?php echo $data['cust_name']?></td>
                                    <td><?php echo $data['surname']?></td>
									       <td><?php echo $data['cust_email']?></td>
										          <td><?php echo $data['telephone']?></td>
												         <td><?php echo $data['dob']?></td>
														        <td><?php echo $data['address']?></td>
																       <td><?php echo $data['postcode']?></td>
                                    
                                </tr>
								<?php
							}
								?>
                                
         </tbody>
                        </table>
               </div>
              
           </div> 
        </div>
    </div>

    
</body>
</html>