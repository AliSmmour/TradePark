<?php  
 if(isset($_POST["branch_id"]))  
 { 
    include"connection.php";
    $output = '';  
    $query = "SELECT BName,Bphone,OwnName ,OwnPhone,OwnEmail,BLat,Blng
                FROM branch br , owner own 
                WHERE br.OwnID=own.OwnID and BID = '".$_POST["branch_id"]."'";  
    $result = mysqli_query($conn, $query);  
    $output .= '  
        <div class="table-responsive">
            <div class="panel panel-orange">
                <div class="panel-heading">
                    <center> <img src="img/TradePark3.png"  alt="" style="width: 7rem; height:7rem;"> </center>
                </div>
            <div class="panel-body">
                <table width="100%">';  
                while($row = mysqli_fetch_assoc($result))  
                {  
                    $latitude = $row["BLat"];
                    $longitude = $row["Blng"];
                    $output .= '  
                        <tr>
                            <td width="30%"><label>Branch Name :</label></td>  
                            <td width="70%">   '.$row["BName"].'</td>  
                        </tr>  
                        <tr>
                        <tr>  
                            <td width="30%"><label>Branch Phone :</label></td>  
                            <td width="70%">   '.$row["Bphone"].'</td>
                        </tr>
                            <td width="30%"><label>Owner Name :</label></td>  
                            <td width="70%">   '.$row["OwnName"].'</td>  
                        </tr>  
                        <tr>  
                            <td width="30%"><label>Owner Email :</label></td>  
                            <td width="70%">   '.$row["OwnEmail"].'</td>  
                        </tr>  
                        <tr>  
                            <td width="30%"><label>Owner Phone :</label></td>  
                            <td width="70%">   '.$row["OwnPhone"].'</td>
                        </tr>
                        <tr>   
                            <td colspan="2" height="20%">
                            <iframe  class="text-center"id="map" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" src="https://maps.google.com/maps?q='.$latitude.','. $longitude.'&output=embed"></iframe>
                            </td>
                        </tr>
                    ';  
                }  
    $output .= '  
    <tr>  
        <td width="30%"><label>Employees : </label></td> 
    </tr>  ';
    $query2 = "SELECT EmpName ,EmpPhone FROM Employee emp where BID ='".$_POST["branch_id"]."'";  
    $result2 = mysqli_query($conn, $query2);  
    while($row2 = mysqli_fetch_assoc($result2))  
    {   
        $output.='<tr>  
                    <td width="30%"> </td>
                    <td width="70%"> '.$row2['EmpName'].'    '. $row2['EmpPhone'].'   </td> 
                </tr>';
    }  
    $output .= ' 
    </td> 
    </tr>';
    $output.=' 
    </table>  </div>
    </div>
    </div> ';  
    echo $output;  
    }  
?>