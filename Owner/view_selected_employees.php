<?php  
 if(isset($_POST["Employee_id"]))  
 { 
    include"connection.php";
    $output = '';  
    $query = "SELECT EmpID , EmpName,EmpPhone,EmpPic,BName,OwnName FROM employee emp ,branch br,owner own  
            WHERE emp.BID=br.bID  and br.ownId =own.ownId and  empID = '".$_POST["Employee_id"]."'";  
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
                                <img src="data:image/jpeg;base64,'.base64_encode($row["EmpPic"] ).' "height="100%" width="25%" class="img-thumbnail"/> 
                                </center></td>
                        </tr>
                            <td width="30%"><label>Employee Name :</label></td>  
                            <td width="70%">   '.$row["EmpName"].'</td>  
                        </tr>  
                        <tr>  
                            <td width="30%"><label>Employee Phone :</label></td>  
                            <td width="70%">   '.$row["EmpPhone"].'</td>
                        </tr>
                        <tr>  
                            <td width="30%"><label>Work in  : </label></td>  
                            <td width="70%"> '.$row["BName"].' - '.$row["OwnName"].' </td>
                        </tr>
                    ';  
                }  
    $output.=' 
    </table>  </div>
    </div>
    </div> ';  
echo $output;  
 }  
 ?>