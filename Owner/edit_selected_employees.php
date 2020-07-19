<?php  
    if(isset($_POST["employee_id"]))  
    { 
        session_start();
        include"connection.php";
        $output = '';  
        $query = "SELECT empID,empName , empPhone,Bname,br.bid
                FROM employee emp,Branch br
                WHERE emp.bid =br.bid and empID = '".$_POST["employee_id"]."'";                  
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($result))  
        {  
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
                <label> Branch </label>
                <select name="branch" class="form-control" required="required" >
                    <option value="'.$row["bid"].'">  '.$row["Bname"].'  </option> ';
                $branches = "SELECT BID ,Bname FROM branch WHERE ownID =".$_SESSION['ownID']." and BID NOT IN
                            (SELECT BID FROM employee WHERE empID=".$_POST["employee_id"].")";  
                $br_list = mysqli_query($conn, $branches) ; 
                while ($br_row=mysqli_fetch_assoc($br_list))
                {
                    $output.= ' <option value="'.$br_row["BID"].'" > '.$br_row["Bname"].'</option>';
                }
    
    
            $output.='</select>
            </div>   ';  
        }  
        echo $output;
    }     
?>

