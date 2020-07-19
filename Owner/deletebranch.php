<?php
session_start();
include"connection.php";
$bid=$_GET['b_id'];
$sql= "DELETE FROM Employee WHERE BID= $bid;" ; 
$sql.="DELETE FROM Branch WHERE BID= $bid;" ; 
$result =mysqli_multi_query($conn,$sql) ; 
if ($result)
{
	 $_SESSION['err']=1 ; 
    header('Location:branches.php'); 
}
else
{
	$_SESSION['msg'] = mysqli_error($conn); 
	 $_SESSION['err']=2 ; 
    header('Location:branches.php'); 
}

?>