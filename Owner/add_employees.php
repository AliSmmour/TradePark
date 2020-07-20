<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <title>Owner Add Employees</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="Ali Sammour">
        <link rel="icon" href="img/TradePark.png">
        <!--Js -->
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/tablesorter/jquery.tablesorter.js"></script>
        <script src="js/tablesorter/tables.js"></script>
        <!-- Css -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/util.css" rel="stylesheet">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
        <!-- alert -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.14/angular.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.0/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.0/sweetalert.min.css">

    </head>
    <body>
        
        <?php include "navbar.php" ?>
        <?php
            function branches_list($conn)
            {
                $output ='';
                $sql = "SELECT * FROM Branch WHERE ownID =".$_SESSION['ownID']."";
                $res = mysqli_query($conn,$sql) ; 
                while ($row=mysqli_fetch_assoc($res))
                {
                    $output.='<option value="'.$row["BID"].'">'.$row["BName"].'</option>' ;  
                }
                return $output ;
            }
        ?>
        <div id="page-wrapper" style="margin: 2%;">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Employees <small>Add New Employee </small></h1>
                    <ol class="breadcrumb">
                        <li class="active"><i class="fas fa-user-plus"></i> Add Employees</li>
                    </ol>
                </div>
            </div><!-- /.row -->
<!---------------------------------------------------------------------------->
        <div class="row">
            <div class="col-lg-12" >
                <div class="panel panel-orange" style=" background:url('img/bg1.jpg') no-repeat top center ;
                                                        -webkit-background-size : cover ;
                                                        -moz-background-size : cover ;
                                                        -o-background-size : cover ;
                                                        background-size : cover ; ">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fas fa-user-plus"></i> Add Employee</h3>
                    </div>
                    <div class="panel-body" >
                        <div class="container-login100">
			                <div class="wrap-login100">
				                <form class="login100-form" action="#" method="post" enctype="multipart/form-data" onsubmit="return checking()">
                                    <span class="login100-form-title p-b-26"> Add New Employee</span>
					                <div class="wrap-input100 ">
						                <input class="input100" type="text" name="Employee_name" placeholder="Employee Name " required="required">
						                <span class="focus-input100"></span>
					                </div>
					                <div class="wrap-input100 ">
						                <input class="input100" type="file" name="pic" id="pic" required>
						                <span class="focus-input100"></span>
                                    </div>
                                    <div class="wrap-input100 ">
						                <input class="input100" type="number" name="Employee_phone" id="phone" placeholder="07[7,8,9]######" required="required" minlength="10" maxlength="10">
						                <span class="focus-input100"></span>
                                    </div>
                                    <div class="wrap-input100 ">
						                <select name="Employee_branch"  required="required" id="br" class="input100" >
                                            <option selected="selected" value="0" disabled>Choose Branch</option>
                                            <?php echo branches_list($conn);?>  
                                        <span class="focus-input100"></span>
						                </select>
                                    </div>
					                <div class="container-login100-form-btn">
						                <div class="wrap-login100-form-btn">
							                <div class="login100-form-bgbtn logbtn"></div>
							                    <input type="submit" class="login100-form-btn" name="add" value="Add to List">
						                    </div>
					                </div>
					                <div class="text-center p-t-115">
						                <a class="txt2" href="emolyees.php ">
                                            Back to Employees Screen 
                                        </a>
					                </div>
				                </form>
			                </div>
		                </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.row -->
    <?php include "footer.php" ?>
    </body>

    <!-------------------------Start Check --------------------------->
    <script>
        function checking ()
        { 
            var pic = document.getElementById("pic").value.split(".");
            var pic_ex =pic[1].toLowerCase();
            var extension =["gif","png","jpg","jpeg"];
            var valid_pic = extension.includes(pic_ex);
            var phone = document.getElementById("phone").value;
            var patt = phone.match(/07[7-9][0-9]{7}/);
            var select_br = document.getElementById("br").value;
            if (patt && (select_br!='0')&& valid_pic ) 
            {
                return true ;
            }else{
                if (!patt)
                {
                    swal( "Error" , "Invalid phone number" ,  "error" );
                    document.getElementById("phone").focus();
                    return false ; 
                }else if (select_br=='0')
                {
                    swal( "Error" , "Please Choose a branch" ,  "error" );
                    document.getElementById("br").focus();
                    return false ; 
                }else if (!valid_pic)
                {
                    swal("Invalid Image" ,"valid images are gif,png,jpg,jpeg ",  "error");
                    document.getElementById("pic").focus();
                    return false ; 
                }
            }
        }
    </script>
    


</html>
<?php
    include"connection.php";
    if(isset($_POST["add"]))
    {
        
        $Emp_name=$_POST["Employee_name"];
        $Emp_phone=$_POST["Employee_phone"];
        $Emp_br=$_POST["Employee_branch"];
        $Emp_pic= addslashes(file_get_contents($_FILES["pic"]["tmp_name"]));
        $insert = "INSERT INTO Employee (EmpName,EmpPhone,EmpPic,BID,EmpActive)
                    VALUES ('$Emp_name','$Emp_phone','$Emp_pic','$Emp_br','1')";
        $result=mysqli_query($conn,$insert);
        if ($result) 
        {
            echo '<script> swal( "" ,  "Add successfully!" ,  "success" ); </script>';
        }else
        {
            $err=mysqli_error($conn);
        echo ' <script> swal( "Error" ,  "'.$err.'" ,  "error" );  </script>';
        }
      
    }
?>