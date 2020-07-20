<?php session_start();?>
<!DOCTYPE html>
<html>
    <?php 
        function branch_info($conn)
        {
            $table='';
            $records="SELECT BID,BName,Bphone,OwnName ,OwnPhone,AdmName
            FROM branch br , owner own ,Admin adm
            WHERE br.OwnID=own.OwnID and own.AdmID=adm.ADmID and br.ownID='".$_SESSION['ownID']."'
            Order by BActive DESC,OwnName ASC ,BName ASC";
            $result = mysqli_query($conn,$records);
            $c = 1; 
            if(mysqli_num_rows($result)>0)
            {
                while($row=mysqli_fetch_assoc($result))
                {
                    $b_id=$row['BID'];
                    $table.="<tr>";
                    $table.= "<td>".$c." </td>";
                
                    $table.= "<td>".$row['BName']." </td>";
                    $table.= "<td>".$row['Bphone']." </td>";
                    $table.= "<td>".$row['OwnName']."    ". $row['OwnPhone']."</td>";
                    $table.= "<td>
                    <!-- Button trigger modal -->
                    <button name='edit' id='$b_id' class='btn btn-success edit_data_btn btn-block' style='width:30% ;display:inline-block'><i class='fas fa-edit'></i>
                        Edit
                    </button>
                    <a  class='btn btn-danger btn-block' style='width:30% ;display:inline-block' name='btnDelete' href='deletebranch.php?b_id=$b_id'>
                        <i class='fas fa-trash-alt'></i>
                        Delete
                    </a>
                    <button name='view' id='$b_id' class='btn btn-info view_data_btn btn-block' style='width:30% ;display:inline-block'><i class='fas fa-eye'></i>
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
        <title>Owner Branchs_screen</title>
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
                echo '<script> swal("","Oeration Successfully","success") </script>';
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
                    <h1>Branches <small>Branch information</small></h1>
                    <ol class="breadcrumb">
                        <li class="active"><i class="fas fa-user"></i> Branches</li>
                    </ol>
                </div>
            </div><!-- /.row -->
<!---------------------------------------------------------------------------->
        <div class="row">
            <div class="col-lg-12" >
                <div class="panel panel-orange">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fas fa-store"></i> Branches</h3>
                    </div>
                    <div class="panel-body" >
                        <div class="col-lg-12">
                            <h2>View Branches </h2>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group has-orange"> <label for="searchdata">Search here </label> <input id="searchdata" type="text" name="searchdata" class="form-control " autocomplete="off" autofocus="autofocus">
                            <br>
                            <div>
                                <a href="add_branche.php"><button class="btn btn-warning center">Add New Branch</button></a>
                            </div>
                            <br>
                                <table class="table table-bordered table-hover table-striped tablesorter">
                                    <thead>
                                        <tr>
                                            <th>#</th> <th>Name</th> <th>Phone</th> <th>Owner Detail</th> <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table"> <?php echo branch_info($conn); ?> </tbody>
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
                url:"load_search_branches.php", 
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
        iframe {width: 100%;}
        #view ,.modal-content ,div ,.table-responsive { border: none; overflow: hidden; }    
    }
</style>



    <div id="view" class="modal fade">  
        <div class="modal-dialog">  
            <div class="modal-content">  
                <div class="modal-header remove" >  
                    <button type="button" class="close" data-dismiss="modal">&times;</button>  
                    <h4 class="modal-title">Branches Details</h4>  
                </div>  
                <div class="modal-body" id="branch_detail">  
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
            var branch_id = $(this).attr("id");  
            if(branch_id != '')  
            {  
                $.ajax({  
                    url:"view_selected_branches.php",  
                    method:"POST",  
                    data:{branch_id:branch_id},  
                        success:function(data){  
                            $('#branch_detail').html(data);  
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
                    <h4 class="modal-title">Edit Branch Information </h4>  
                </div>  
                <div class="modal-body" id="branch_detail">
                    <form action="branch_save_changes.php" method="post">
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
                var br_id = $(this).attr("id");  
                if(br_id != '')  
                {  
                    $.ajax({  
                        url:"edit_selected_branch.php",  
                        method:"POST",  
                        data:{br_id:br_id},  
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