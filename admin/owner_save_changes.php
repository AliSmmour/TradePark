<?php 
    session_start();
    include"connection.php";
    if (isset($_POST['edit_btn']))
    { 
        $own_id=$_POST['id'];
        $own_phone=$_POST['owner_phone'];
        $account_st=$_POST['account_status'];
        $own_password=$_POST['owner_password'];
        $admin_id = $_SESSION["AdmID"];

        $update_own = "UPDATE Owner
                    SET `ownPassword`='$own_password',`ownActive`='$account_st',`ownPhone`='$own_phone',`AdmID`='$admin_id'
                    WHERE  ownID= $own_id ; "; 
        if ($account_st==0)
        {
            $update_own.= "UPDATE branch
                    SET `BActive`='0'
                    WHERE ownID= $own_id ;";
            $update_own.= "UPDATE employee
                    SET `empActive`='0',`AdmID`='$admin_id'
                    WHERE BID in (SELECT BID from branch where ownID= $own_id );";
        }else
        {
            $update_own.= "UPDATE branch
                    SET `BActive`='1'
                    WHERE ownID= $own_id ;";
            $update_own.= "UPDATE employee
                    SET `EmpActive`='1',`AdmID`='$admin_id'
                    WHERE BID in (SELECT BID from branch where ownID= $own_id );";
        } 
        $result = mysqli_multi_query($conn,$update_own);
        if ($result)
        {
            $_SESSION['err']=1 ; 
            header('Location:owners.php'); 
        }else
        {
            $_SESSION['err'] = 2; 
            $_SESSION['msg']= mysqli_error($conn);
            header('Location:owners.php'); 
        }
    }
?>
