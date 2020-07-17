<?php
$dsn = 'mysql:host=localhost;dbname=tradepark';
$user = 'root';
$pass = '';
$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

try {
    $con = new PDO($dsn, $user, $pass, $option);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $e) {
    echo 'Failed To Connect' . $e->getMessage();
}

session_start();
$_SESSION['msg']='' ;
$_SESSION['err']=0 ;
if (isset($_SESSION['AdmID'])) {
    header('Location: admin/AdmIndex.php'); // Redirect To Dashboard Page
}
if (isset($_SESSION['ownID'])) {
    header('Location:owner/OwnIndex.php');  // Redirect To Dashboard Page
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
  {
if(isset($_POST["signin"]))
{
    $user=$_POST["user"];
    $pass=$_POST["pass"];
    #Check if the user is Admin 
    
    $stmt = $con->prepare("SELECT * FROM admin WHERE (admEmail='$user' or admPhone='$user')AND admPassword='$pass'; ");
    $stmt->execute(array($username, $password));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0)
    {
        $_SESSION['userName'] = $row['admName'];
        $_SESSION['userEmail'] = $row['admEmail'];
        $_SESSION['AdmID'] = $row['admID'];
        header('Location: admin/AdmIndex.php');
        exit();
    }else
    {
        
        #Check if the user is Owner
        $stmt = $con->prepare("SELECT * FROM owner WHERE (ownEmail='$user' or ownPhone='$user')AND ownPassword='$pass'; ");
        $stmt->execute(array($username, $password));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
    if ($count > 0)
        {
            $_SESSION['userName'] = $row['ownName'];
            $_SESSION['userEmail'] = $row['ownEmail'];
            $_SESSION['ownID'] = $row['ownID'];
            header('Location: owner/OwnIndex.php');
            exit();
        }
        # Not user or owner
        else
        {
            $_SESSION['err'] = 1 ;
            $_SESSION['msg']= "Invalid username or password !";
            header('Location:index.php'); 
            exit();
        }
    }
}
  }
?>