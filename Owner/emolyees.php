<?php session_start();?>
<!DOCTYPE html>
<html>
    <?php 
        function Employee_info($conn)
        {
            $table='';
            $records="SELECT EmpID , EmpName,EmpPhone,EmpActive,BName,AdmName FROM employee emp ,branch br,admin adm 
            where emp.BID=br.bID and (emp.AdmID=adm.AdmID or emp.AdmID is null) and emp.BID in (SELECT BID from branch WHERE ownID =".$_SESSION['ownID'].")
            Order by BName ASC,EmpActive DESC,EmpName ASC";
            $result = mysqli_query($conn,$records);
            $c = 1; 
            if(mysqli_num_rows($result)>0)
            {
                while($row=mysqli_fetch_assoc($result))
                {
                    $emp_id=$row['EmpID'];
                    $table.="<tr>";
                    if ($row["EmpActive"]==0)
                    {
                        $table.= "<td style='background-color:#ff6767' title='".$row['AdmName']."'>".$c." </td>";
                    }else{
                        $table.= "<td>".$c." </td>";
                    }
                    $table.= "<td>".$row['EmpName']." </td>";
                    $table.= "<td>".$row['EmpPhone']." </td>";
                    $table.= "<td>".$row['BName']." </td>";
                    $table.= "<td>
                    <!-- Button trigger modal -->
                    <button name='edit' id='$emp_id' class='btn btn-success edit_data_btn btn-block' style='width:30% ;display:inline-block'><i class='fas fa-edit'></i>
                    Edit
                    </button>
                    <a  class='btn btn-danger btn-block' style='width:30% ;display:inline-block' name='btnDelete' href='deleteemployee.php?emp_id=$emp_id'>
                        <i class='fas fa-trash-alt'></i>
                        Delete
                    </a>
                    <button name='view' id='$emp_id' class='btn btn-info view_data_btn btn-block' style='width:30% ;display:inline-block'><i class='fas fa-eye'></i>
                        View
                    </button>
                </td>
                </tr>";
                $c++;
                }      
            }
            return $table;
        }
    ?>
    <head>
        <title>Owner employees-screen</title>
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
        <?php
            #To show aert after operation (edit )
            if ($_SESSION['err']==1) {
                echo '<script> swal("","Operation Successfully","success") </script>';
                $_SESSION['err']=0 ;
            }elseif ($_SESSION['err']==2) {
                $msg= $_SESSION['msg'] ;
                echo '<script> swal("Error","'.$msg.'","error") </script>';
                $_SESSION['err']=0 ;
                $_SESSION['msg']='';
            }
        ?>
        <?php include "navbar.php" ?>
        <div id="page-wrapper" style="margin: 2%;">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Employees <small>Employee information</small></h1>
                    <ol class="breadcrumb">
                        <li class="active"><i class="fas fa-users"></i> Employees</li>
                    </ol>
                </div>
            </div><!-- /.row -->
<!---------------------------------------------------------------------------->
        <div class="row">
            <div class="col-lg-12" >
                <div class="panel panel-orange">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-users"></i> Employees</h3>
                    </div>
                    <div class="panel-body" >
                        <div class="col-lg-12">
                            <h2>View Employees </h2>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group has-orange"> <label for="searchdata">Search here </label> <input id="searchdata" type="text" name="searchdata" class="form-control " autocomplete="off" autofocus="autofocus">
                            <br>
                            <div>
                                <a href="add_employees.php"><button class="btn btn-warning center">Add New Employee</button></a>
                            </div>
                            <br>
                                <table class="table table-bordered table-hover table-striped tablesorter">
                                    <thead>
                                        <tr>
                                            <th>#</th> <th>Name</th> <th>Phone</th> <th title="Branch - Owner"> Work in</th> <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table"> <?php echo Employee_info($conn); ?> </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.row -->
    <?php include "footer.php" ?>
    </body>

    <!-------------------------Start script Search--------------------------->
    <script> 
        $(document).ready(function(){      
            $('#searchdata').keyup(function(){
            var search_key = $(this).val() ;  
            $.ajax({       
                url:"load_search_Employees.php", 
                method:"POST",
                data:{search_key:search_key}, 
                success:function(data){
                    $('#table').html(data);
                    }
                });
            });
        });
    </script>
<!-------------------------End script Search--------------------------->

<!-----------------------------start view Modal ----------------------->
<style type="text/css" media="print">
    @media print
    {
        /*Hide Element */
        .row , .modal-footer , .remove {display: none;}
        /*Specifics */
        .modal-body {font-size: 16pt  ;width: 100% ; height: 100%;}
        .panel-orange > .panel-heading { background-color: #F8931F !important; }
        a { color:blue !important; padding: 0; }
        #view ,.modal-content ,div ,.table-responsive { border: none; overflow: hidden; }    
    }
</style>



    <div id="view" class="modal fade">  
        <div class="modal-dialog">  
            <div class="modal-content">  
                <div class="modal-header remove" >  
                    <button type="button" class="close" data-dismiss="modal">&times;</button>  
                    <h4 class="modal-title">Employees Details</h4>  
                </div>  
                <div class="modal-body" id="Employee_detail">  
                </div>  
                <div class="modal-footer">  
                    <button type="button" class="btn btn-info btn-lg btn-block" onclick="window.print();"><i class="fas fa-print"> Print</i></button>  
                </div>  
            </div>  
        </div>  
    </div>  

    <script>
        $(document).ready(function(){
        $(document).on('click', '.view_data_btn', function(){  
            var Employee_id = $(this).attr("id");  
            if(Employee_id != '')  
            {  
                $.ajax({  
                    url:"view_selected_Employees.php",  
                    method:"POST",  
                    data:{Employee_id:Employee_id},  
                        success:function(data){  
                            $('#Employee_detail').html(data);  
                            $('#view').modal('show');  
                        }  
                    });  
            }            
        });  
        });
</script>

<!-----------------------------End view Modal ----------------------->



<!-----------------------------Start Edit modal------------------------->


    <div id="edit" class="modal fade">  
        <div class="modal-dialog">  
            <div class="modal-content">  
                <div class="modal-header">  
                    <button type="button" class="close" data-dismiss="modal">&times;</button>  
                    <h4 class="modal-title">Edit Employee Information </h4>  
                </div>  
                <div class="modal-body" id="Employee_detail">
                    <form action="Employees_save_changes.php" method="post">
                        <div id="edit_form">
                        </div><br>
                            <input type="submit" name="edit_btn" value="Save Changes" class="btn btn-success btn-lg btn-block">
                    </form>
                </div>  
                <div class="modal-footer">  
                </div>  
            </div>  
        </div>  
    </div>  


    <script>
        $(document).ready(function(){
            $(document).on('click', '.edit_data_btn', function(){  
                var employee_id = $(this).attr("id");  
                if(employee_id != '')  
                {  
                    $.ajax({  
                        url:"edit_selected_employees.php",  
                        method:"POST",  
                        data:{employee_id:employee_id},  
                        success:function(data){  
                            $('#edit_form').html(data);  
                            $('#edit').modal('show');  
                        }  
                    });  
                }            
            });  
        });
    </script>
<!-----------------------------End Edit modal------------------------->


</html>