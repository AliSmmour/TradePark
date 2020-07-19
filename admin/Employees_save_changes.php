<?php 
    session_start();
    include"connection.php";
    if (isset($_POST['edit_btn']))
    { 
        $emp_id=$_POST['id'];
        $emp_phone=$_POST['employee_phone'];
        $account_st=$_POST['account_status'];
        $admin_id = $_SESSION["AdmID"];

        $update_emp = "UPDATE employee
                    SET `empActive`='$account_st',`empPhone`='$emp_phone',`AdmID`='$admin_id'
                    WHERE  empID= $emp_id ; "; 
        $result = mysqli_query($conn,$update_emp);
        if ($result)
        {
            $_SESSION['err']=1 ; 
            header('Location:emolyees.php'); 
        }else
        {
            $_SESSION['err'] = 2; 
            $_SESSION['msg']= mysqli_error($conn);
            header('Location:emolyees.php'); 
        }
    }
?>
