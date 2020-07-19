<?php 


if (empty($_SESSION['ownID'])) {
    header('location:../index.php');
    exit();
}

?>

<style type="text/css">
    .navbar-light .navbar-nav>li>a:focus, .navbar-light .navbar-nav>li>a:hover {
        color: darkgray;
        background-color: transparent;
    }
</style>
<?php include "connection.php"; ?>
<nav class="navbar navbar-light " role="navigation" style="background-color: #fff;">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" style="font-family: 'Do Hyeon', sans-serif;" href="index.php">
        <img src="img/TradePark.png"  alt="" style="height: 4rem; width: 6rem;">
        <b>Owner</b>
        </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav navbar-right navbar-user">
            <li><a href="Ownindex.php"><i class='fas fa-tachometer-alt'></i> Dashboard</a></li>
            <li><a href="branches.php"><i class='fas fa-store'>  Branches</i></a></li>
            <li><a href="add_branche.php"><i class='fas fa-plus-square'>  Add branch</i></a></li>
            <li><a href="emolyees.php"><i class='fas fa-users'>  Employees</i></a></li>
            <li><a href="add_employees.php"><i class='fas fa-user-plus'> Add Employee</i></a></li>
            <li><a href="deactive_employee.php"><i class='fas fa-user-slash'> Deactive Employee</i></a></li>
            <li class="dropdown user-dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user "></i>
                <?php echo $_SESSION['ownName'];?>
                    <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="Ownindex.php"><i class="fas fa-tachometer-alt"></i> Dashboard </a> </li>
                    <li><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
                </ul>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>