<?php

$servername="localhost";
$serverusername="root";
$serverpassword ="";
$dbname ="electricity";
$conn = mysqli_connect($servername,$serverusername,$serverpassword,$dbname);

if($conn){

    echo'';

}else{
    echo 'something went wrong';
}




?>