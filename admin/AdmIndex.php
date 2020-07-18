<!DOCTYPE html>
<html>
    <head>
        <title>TradeParks-Admin</title>
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
        <div id="page-wrapper" style="margin: 2%;">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Dashboard <small>Statistics Overview</small></h1>
                    <ol class="breadcrumb">
                        <li class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</li>
                    </ol>
                    <div class="alert alert-orange alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Welcome <?php echo $_SESSION['AdmName'];?> 
                    </div>
                </div>
            </div><!-- /.row -->

        <div class="row">
            <div class="col-lg-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                </i><i class='fas fa-store style="font-size:48px;  fa-5x " '></i>
                            </div>
                        <div class="col-xs-6 text-right">
                            <p class="announcement-heading">
                                <?php
                                    $sql= "SELECT Distinct  COUNT(BID) FROM branch";
                                    $result = mysqli_query($conn,$sql);
                                    $row = mysqli_fetch_array($result); 
                                    $quantity = $row[0];
                                    echo $quantity;
                                ?>
                            </p>
                            <p class="announcement-text">Number of Branches</p>
                        </div>
                        </div>
                    </div>
                    <a href="branches.php">
                        <div class="panel-footer" style="color: #31708F;">
                            <div class="row">
                                <div class="col-xs-6">View  </div>
                                <div class="col-xs-6 text-right">
                                    <i class="fa fa-arrow-circle-right"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <i class=" fas fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-6 text-right">
                                <p class="announcement-heading">      
                                    <?php
                                        $sql= "SELECT COUNT(ownID) FROM owner";
                                        $result = mysqli_query($conn,$sql);
                                        $row = mysqli_fetch_array($result); 
                                        $quantity = $row[0];
                                        echo $quantity;
                                    ?>    
                                </p>
                                <p class="announcement-text">Number of Owners</p>
                            </div>
                        </div>
                    </div>
                    <a href="owners.php">
                        <div class="panel-footer" style="color: #A94442;">
                            <div class="row">
                                <div class="col-xs-6">View </div>
                                <div class="col-xs-6 text-right">
                                <i class="fa fa-arrow-circle-right"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        <div class="col-lg-4">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <i class="fas fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-6 text-right">
                        <p class="announcement-heading">
                            <?php
                                $sql= "SELECT  COUNT(empId) FROM employee ";
                                $result = mysqli_query($conn,$sql);
                                $row = mysqli_fetch_array($result); 
                                $quantity = $row[0];
                                echo $quantity;
                            ?>
                        </p>
                        <p class="announcement-text">Number of Emplyees</p>
                        </div>
                </div>
            </div>
            <a href="emolyees.php">
                <div class="panel-footer" style="color:#8A6D3B;">
                    <div class="row">
                        <div class="col-xs-6">View </div>
                        <div class="col-xs-6 text-right">
                            <i class="fa fa-arrow-circle-right"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

<!---------------------------------------------------------------------------->
        <div class="row" style="margin: 1%;">
            <div class="col-lg-12" >
            <div class="panel panel-orange">
                <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> TRAFFIC</h3>
                </div>
                <div class="panel-body" >
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                    // Load Charts and the corechart and barchart packages.
                    google.charts.load('current', {'packages':['corechart']});
                    // Draw the pie chart and bar chart when Charts is loaded.
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'Topping');
                        data.addColumn('number', 'Slices');
                        data.addRows([
                            ['Branches', 
                                <?php
                                    $sql= "SELECT Distinct  COUNT(BID) FROM branch";
                                    $result = mysqli_query($conn,$sql);
                                    $row = mysqli_fetch_array($result); 
                                    $quantity = $row[0];
                                    echo $quantity;
                                ?>
                            ],
                            ['Owners', 
                                <?php 
                                    $sql= "SELECT COUNT(ownID) FROM owner";
                                    $result = mysqli_query($conn,$sql);
                                    $row = mysqli_fetch_array($result); 
                                    $quantity = $row[0];
                                    echo $quantity;
                                ?>
                            ],
                            ['Employees', 
                                <?php
                                    $sql= "SELECT  COUNT(empId) FROM employee";
                                    $result = mysqli_query($conn,$sql);
                                    $row = mysqli_fetch_array($result); 
                                    $quantity = $row[0];
                                    echo $quantity;
                                ?>
                            ],
                        ]);
                    var piechart_options = {title:'Pie Chart: How Much Trainers, Trainee And Course in YULMS DB ',
                        width:620,
                        height:300};
                        var piechart = new google.visualization.PieChart(document.getElementById('piechart_div'));
                        piechart.draw(data, piechart_options);
                        var barchart_options = {title:'Barchart:How Much Trainers, Trainee And Course in YULMS DB',
                            width:620,
                            height:300,
                            legend: 'none'};
                        var barchart = new google.visualization.BarChart(document.getElementById('barchart_div'));
                        barchart.draw(data, barchart_options);
                    }
                    </script>
                    <table class="columns">
                        <tr>
                            <td><div id="piechart_div"></div></td>
                            <td><div id="barchart_div" ></div></td>
                        </tr>
                    </table>
                </div>
                </div>
            </div>
        </div><!-- /.row -->
        </div>
        </div>        
        <?php include "footer.php" ?>
    </body>
</html>