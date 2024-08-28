<?php
 $DBhost='localhost';
 $DBuser='root';
 $DBpassword='';
 $conn=mysqli_connect($DBhost,$DBuser,$DBpassword);
 if(!$conn){
    die('Cannot connect to database'.mysqli_error());
 }
?>