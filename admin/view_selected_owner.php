<?php  
 if(isset($_POST["owner_id"]))  
 { 
    include"connection.php";
    $output = '';  
    $query = "SELECT * FROM owner
    WHERE ownID = '".$_POST["owner_id"]."'";  
    $result = mysqli_query($conn, $query);  
    $output .= '  
        <div class="table-responsive">
            <div class="panel panel-orange">
                <div class="panel-heading">
                    <center> <img src="img/TradePark3.png"  alt="" style="width: 7rem; height:7rem;"> </center>
                </div>
            <div class="panel-body">
                <table>';  
                while($row = mysqli_fetch_assoc($result))  
                {  
                    $output .= '  
                        <tr>
                            <td colspan="2"><center>
                                <img src="data:image/jpeg;base64,'.base64_encode($row["OwnPic"] ).' "height="100%" width="25%" class="img-thumbnail"/> 
                                </center></td>
                        </tr>
                        <tr>
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
                            <td width="30%"><label>Owner Address : </label></td>  
                            <td width="70%">  Later </td>
                        </tr>
                    ';  
                }  
    $query2 = "SELECT BName,BID FROM branch br , owner own 
                WHERE own.OwnId = br.OwnId and own.OwnID='".$_POST["owner_id"]."'";  
    $result2 = mysqli_query($conn, $query2);  
    $output .= '  
                <tr>  
                    <td width="30%"><label>Branches : </label></td> 
                </tr>
                    ';
    while($row2 = mysqli_fetch_assoc($result2))  
    {    $b_id= $row2["BID"];
        $output.='<tr>  
                    <td ></td>
                    <td><b>'.$row2["BName"].'<b> </td>
                <tr>';
            $query3 = "SELECT EmpName FROM Branch br , Employee emp , Owner own 
            WHERE br.BID=emp.BID and br.OwnID=own.OwnID and br.BID='".$b_id."' and own.OwnID='".$_POST["owner_id"]."'
            ORDER by EmpName";
            $result3 = mysqli_query($conn, $query3); 
            while($row3 = mysqli_fetch_assoc($result3))  
            {  
                $output .= ' <tr><td></td> <td class="text-center"> '.$row3["EmpName"].'  </td></tr>';  
            }  
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