<?php
session_start();
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


$_SESSION['msg']='' ;
$_SESSION['err']=0 ;

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
  {
if(isset($_POST["signin"]))
{
    $user=$_POST["user"];
    $pass=$_POST["pass"];
    #Check if the user is Admin 
    
    $stmt = $con->prepare("SELECT * FROM admin WHERE (AdmEmail='$user' or AdmPhone='$user')AND AdmPassword='$pass'; ");
    $stmt->execute(array($username, $password));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0)
    {   
        $_SESSION['AdmID'] = $row['AdmID'];
        $_SESSION['AdmName'] = $row['AdmName'];
        $_SESSION['AdmEmail'] = $row['AdmEmail'];
        
        header('Location: admin/AdmIndex.php');
        exit();
    }else
    {
        
        #Check if the user is Owner
        $stmt = $con->prepare("SELECT * FROM owner WHERE (OwnEmail='$user' or OwnPhone='$user')AND OwnPassword='$pass'; ");
        $stmt->execute(array($username, $password));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
    if ($count > 0)
        {
            if($row["OwnActive"]==0) # owner account  is deactive 
            {
                $_SESSION['err'] = 1;
                $_SESSION['msg']= "Your Email is Deactive ";
                $_SESSION['color']="warning";
                header('Location:index.php'); 
                exit();
            }else
            {
                $_SESSION['ownName'] = $row['OwnName'];
                $_SESSION['ownEmail'] = $row['OwnEmail'];
                $_SESSION['ownID'] = $row['OwnID'];
                header('Location: owner/OwnIndex.php');
                exit(); 
            }
            
        }
        # Not user or owner
        else
        {
            $_SESSION['err'] = 1 ;
            $_SESSION['msg']= "Invalid username or password !";
            $_SESSION['color']="danger";
            header('Location:index.php'); 
            exit();
        }
    }
}
  }
?>