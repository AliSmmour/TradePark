
<style type="text/css">
    .navbar-light .navbar-nav>li>a:focus, .navbar-light .navbar-nav>li>a:hover {
        color: darkgray;
        background-color: transparent;
    }
</style>
<?php include "connection.php"; ?>
<?php
if (isset($_SESSION['AdmID'])) {
    header('Location: admin/AdmIndex.php'); // Redirect To Dashboard Page
  }


  if (isset($_SESSION['ownID'])) {
    header('Location: owner/OwnIndex.php');  // Redirect To Dashboard Page
  }

?>
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
        </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav navbar-right navbar-user">
            <li><a href="index.php">       <i class='fas fa-home'></i> Home</a></li>
            <li><a href="contact.php">     <i class="fas fa-address-book"> Contact Us</i>  </a></li>
            <li><a href="aboutUs.php">     <i class='fas fa-info'>  About Us</i>  </a></li>
            <li> &nbsp;&nbsp;&nbsp;&nbsp;</li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>