<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <title>Owner Add Branchs</title>
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
        <div id="page-wrapper" style="margin: 2%;">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Branches <small>Add New Branch </small></h1>
                    <ol class="breadcrumb">
                        <li class="active"><i class="fas fa-plus-square"></i> Add Branches</li>
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
                        <h3 class="panel-title"><i class="fas fa-plus-square"></i> Add Branch</h3>
                    </div>
                    <div class="panel-body" >
                        <div class="container-login100">
			                <div class="wrap-login100">
				                <form class="login100-form" action="#" method="post" onsubmit="return checking()">
                                    <span class="login100-form-title p-b-26"> Add New Branch</span>
					                <div class="wrap-input100 ">
						                <input class="input100" type="text" name="branch_name" placeholder="Branch Name " required="required">
						                <span class="focus-input100"></span>
					                </div>
					                <div class="wrap-input100 ">
						                <input class="input100" type="number" name="branch_phone" id="phone" placeholder="07[7,8,9]######" required="required" minlength="10" maxlength="10">
						                <span class="focus-input100"></span>
                                    </div>
					                <div class="container-login100-form-btn">
						                <div class="wrap-login100-form-btn">
							                <div class="login100-form-bgbtn logbtn"></div>
							                    <input type="submit" class="login100-form-btn" name="add" value="Add to List">
						                    </div>
					                </div>
					                <div class="text-center p-t-115">
						                <a class="txt2" href="branches.php ">
                                            Back to Branches Screen 
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
            var phone = document.getElementById("phone").value;
            var patt = phone.match(/07[7-9][0-9]{7}/);
            if (patt ) 
            {
                return true ;
            }else{
                swal( "Error" , "Invalid phone number" ,  "error" );
                document.getElementById("phone").focus();
                return false ; 
            }
        }
    </script>
    


</html>