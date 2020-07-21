<!DOCTYPE html>
<html>
    <head>
        <title>Create New Account </title>
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
        <?php "connection.php"?>
       
        <div class="limiter" style=" background:url('img/bg1.jpg') no-repeat top center ;
-webkit-background-size : cover ;
-moz-background-size : cover ;
-o-background-size : cover ;
background-size : cover ; ">
            <div class="container-login100">
			    <div class="wrap-login100">
				    <form class="login100-form" action="#" method="post" enctype="multipart/form-data" onsubmit="return checking()">
                        <span class="login100-form-title p-b-26"> Sign Up</span>
					    <div class="wrap-input100 ">
						    <input class="input100" type="text" name="name" placeholder="Full Name" required="required" autofocus >
						    <span class="focus-input100"></span>
					    </div>
					    <div class="wrap-input100">
						    <input class="input100" type="email" name="email" placeholder="Email" required="required" >
                            <span class="focus-input100"></span>
                        </div>
                        <div class="wrap-input100">
						    <input class="input100" type="password" name="pass" id="pass" placeholder="Password" required="required" minlength="8">
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
                        <div class="wrap-input100">
                            <input class="input100" type="password" name="c_pass" id="c_pass" placeholder="Confirm Password" onkeyup='check();' required="required" style="width: 90%; display: inline-block;">
                            <span id='message'></span>
                            <span class="focus-input100"></span>
                        </div>
                        <script type="text/javascript">//To Check password and conformed password
                            var check = function() {
                            if (document.getElementById('pass').value ==document.getElementById('c_pass').value) {
                                document.getElementById('message').style.color = 'green';
                                document.getElementById('message').innerHTML = '<i class="fas fa-check-circle"></i>';
                            } else {
                                document.getElementById('message').style.color = 'red';
                                document.getElementById('message').innerHTML = '<i class="fas fa-times-circle"></i>';
                                }
                                }
                        </script>
                        <div class="wrap-input100 ">
						    <input class="input100" type="number" name="phone" id="phone" placeholder="07[7,8,9]######" required="required" minlength="10" maxlength="10">
						    <span class="focus-input100"></span>
                        </div>
                        <div class="wrap-input100 ">
						        <input class="input100" type="file" name="pic" id="pic" required>
						        <span class="focus-input100"></span>
                        </div>
                        <div >
                            <input type="hidden" name="loc" id="loc" >
                        </div>
                        <!--map -->
 					    <iframe src="maps.php" width="100%" height="60%" name="loaded_map"></iframe>
                        <!--End Map-->
					    <div class="container-login100-form-btn">
						    <div class="wrap-login100-form-btn">
							    <div class="login100-form-bgbtn logbtn"></div>
							    <input type="submit" class="login100-form-btn" name="reg" id="reg"  value="Sign Up">
						    </div>
					    </div>

					    <div class="text-center p-t-115">
						    <span class="txt1">I hav already an </span>
						    <a class="txt2" href="index.php ">account</a>
					    </div>
                    </form>
                    
                    <script>
                        function checking ()
                        { 
                            var pic = document.getElementById("pic").value.split(".");
                            var pic_ex =pic[1].toLowerCase();
                            var extension =["gif","png","jpg","jpeg"];
                            var valid_pic = extension.includes(pic_ex);
                            var phone = document.getElementById("phone").value;
                            var patt = phone.match(/07[7-9][0-9]{7}/);
                            var pass =document.getElementById('pass').value ;
                            var cpass = document.getElementById('c_pass').value ;
                            var tpass = pass==cpass ;
                            if (patt && tpass && valid_pic) 
                            {
                                return true ;
                            }else{
                            if (!patt)
                            {
                                swal( "Error" , "Invalid phone number" ,  "error" );
                                document.getElementById("phone").focus();
                                return false ; 
                            }
                            else if (!tpass)
                            {
                                swal("Error" ,"Password and Confirm password are not the same ",  "error");
                                document.getElementById("pass").focus();
                                return false ; 
                            }
                            else if (!valid_pic)
                            {
                                swal("Invalid Image" ,"valid images are gif,png,jpg,jpeg ",  "error");
                                document.getElementById("pic").focus();
                                return false ; 
                            }
                            } 
                        }
                    </script>
			    </div>
		    </div>
        </div>
        <?php include "footer.php" ?>
    </body>
</html>
<script>
	$(function(){
    $("#reg").mouseenter(function() {
        var getAddress = $("iframe[name=loaded_map]").contents().find("#iloc").val();
        document.getElementById("loc").value = getAddress;
    });
});
</script>

<?php 
    if (isset($_POST['reg']))
    {
        $Name=$_POST['name'];
        $Email=$_POST['email'];
        $Password=$_POST['pass'];
        $Phone=$_POST['phone'];
        $Own_pic= addslashes(file_get_contents($_FILES["pic"]["tmp_name"]));
        $Location=$_POST['loc'];
        $removing = preg_replace("/[A-Z a-z \( \)]/","",$Location); 
        $ll = (explode(",",$removing));
        $lan=$ll[0];
        $lat=$ll[1];

        $sql="INSERT INTO OWNER (OwnPic,OwnName, OwnEmail, OwnPassword, OwnPhone,  OwnActive, OwnLat, OwnLng) 
                VALUES ('$Own_pic','$Name', '$Email', '$Password','$Phone', '1', '$lat','$lan');";
        $result=mysqli_query($conn,$sql);
        if ($result) 
        {
            echo '<script >swal( "" ,  "Registration successfully!" ,  "success" );</script>';
        }else
        {
            $err=mysqli_error($conn);
            echo '<script > swal( "Error" ,  "'.mysqli_error($conn).'" ,  "error" ); </script>';
        }

    }
    mysqli_close($conn);
?>