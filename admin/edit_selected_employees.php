<?php  
    if(isset($_POST["employee_id"]))  
    { 
        include"connection.php";
        $output = '';  
        $query = "SELECT empID,empName , empPhone,empActive
                FROM employee
                WHERE empID = '".$_POST["employee_id"]."'";                  
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($result))  
        {  
        $status=$row["empActive"];
        $output.= '  
            <div >
                <input type="hidden" name="id" class="form-control" value="'.$row["empID"].'" />
            </div>
            <div >
                <label> Employee Name</label>
                <input type="text" name="employee_name" class="form-control" placeholder="employee Name" value="'.$row["empName"].'" readonly="readonly" />
            </div>
            <div >
                <label> Employee Phone</label>
                <input type="number" name="employee_phone" class="form-control" placeholder="07[7,8,9]#######" value="'.$row["empPhone"].'"   required="required"/>
            </div>
            <div >
                <label> Account Status </label>
                <select name="account_status" class="form-control"  required="required">
                    <option value="0" ';
                        if($status==0){
                            $output.=' selected="selected" ';
                            }
                            $output.='> Deactive </option>          
                        <option value="1" ';
                        if($status==1){
                            $output.=' selected="selected" ';
                        }
                            $output.='> Active </option>
                </select>
            </div>';
        }  
        echo $output;
    }     
?>

