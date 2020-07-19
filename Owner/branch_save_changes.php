<?php 
    session_start();
    include"connection.php";
    if (isset($_POST['edit_btn']))
    { 
        $br_id=$_POST['id'];
        $br_name=$_POST['br_name'];
        $br_phone=$_POST['br_phone'];
        $update_br = "UPDATE branch
                    SET `BName`='$br_name',`BPhone`='$br_phone'
                    WHERE  BID= $br_id ; "; 
        $result = mysqli_query($conn,$update_br);
        if ($result)
        {
            $_SESSION['err']=1 ; 
            header('Location:branches.php'); 
        }else
        {
            $_SESSION['err'] = 2; 
            $_SESSION['msg']= mysqli_error($conn);
            header('Location:branches.php'); 
        }
    }
?>
