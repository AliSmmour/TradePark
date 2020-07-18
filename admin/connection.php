<?php
$conn= mysqli_connect("localhost","root","","tradepark");
if (!$conn)
{
    echo '<script > swal( "Error" ,  "connection Faild" ,  "'. mysqli_connect_error().'" );  </script>';
}
?>