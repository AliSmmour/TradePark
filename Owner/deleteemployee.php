<?php
session_start();
include"connection.php";
$eid=$_GET['emp_id'];
$sql= "DELETE FROM Employee WHERE Empid= $eid;" ; 
$result =mysqli_query($conn,$sql) ; 
if ($result)
{
	 $_SESSION['err']=1 ; 
    header('Location:emolyees.php'); 
}
else
{
	$_SESSION['msg'] = mysqli_error($conn); 
	 $_SESSION['err']=2 ; 
    header('Location:emolyees.php'); 
}

?>