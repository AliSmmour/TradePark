<!DOCTYPE html>
<html>
    <head>
    <?php session_start();?>
        <title>TradeParks</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="Ali Sammour">
        <link rel="icon" href="img/TradePark.png">
        <!--Js -->
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/bootstrap.js"></script>
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
        
        <div class="limiter" style=" background:url('img/bg1.jpg') no-repeat top center ;
-webkit-background-size : cover ;
-moz-background-size : cover ;
-o-background-size : cover ;
background-size : cover ; ">
            <div class="container-login100">
			    <div class="wrap-login100">
				    <form class="login100-form" action="signinprocess.php" method="post">
                        <span class="login100-form-title p-b-26"> Sign In</span>
                        <?php 
                            if (isset($_SESSION['err'])){
                                if ($_SESSION['err']==1)
                                {
                                ?>
                                    <div class="alert alert-<?php echo $_SESSION['color'] ;?> alert-dismissable" >
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php echo $_SESSION['msg'];?>
                                    </div>
                        <?php
                            $_SESSION['err']=0 ;
                            $_SESSION['msg']='' ;
                            $_SESSION['color']='' ;
                                }
                            }
        
        ?>
					    <div class="wrap-input100 ">
						    <input class="input100" type="text" name="user" placeholder="Email or phone" required="required" autofocus>
						    <span class="focus-input100"></span>
					    </div>
					    <div class="wrap-input100">
						    <input class="input100" type="password" id="pass"  name="pass" placeholder="Password" required="required" >
                            <span class="focus-input100"></span>
					    </div>
						<!--Show Password-->
                        <input type="checkbox" onclick="myFunction()">Show Password
                        <script type="text/javascript">
                            function myFunction()
                            {
                                var pass_input = document.getElementById("pass");
                                if (pass_input.type === "password")
                                {
                                    pass_input.type = "text";
                                } else
                                {
                                    pass_input.type = "password";
                                }
                            }
                        </script> 

					    <div class="container-login100-form-btn">
						    <div class="wrap-login100-form-btn">
							    <div class="login100-form-bgbtn logbtn"></div>
							    <input type="submit" class="login100-form-btn" name="signin" value="Sign in">
						    </div>
					    </div>

					    <div class="text-center p-t-115">
						    <span class="txt1">Don’t have an account?</span>
						    <a class="txt2" href="register.php ">Sign Up</a>
					    </div>
				    </form>
			    </div>
		    </div>
        </div>
        <?php include "footer.php" ?>
    </body>
</html>