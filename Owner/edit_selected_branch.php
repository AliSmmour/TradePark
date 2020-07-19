<?php  
    if(isset($_POST["br_id"]))  
    { 
        include"connection.php";
        $output = '';  
        $query = "SELECT BID,BName , BPhone
                FROM branch WHERE BID = '".$_POST["br_id"]."'";                  
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($result))  
        {  
        $output.= '  
            <div >
                <input type="hidden" name="id" class="form-control" value="'.$row["BID"].'" />
            </div>
            <div >
                <label> Branch Name</label>
                <input type="text" name="br_name" class="form-control" placeholder="br Name" value="'.$row["BName"].'" required="required" />
            </div>
            <div >
                <label> Branch Phone</label>
                <input type="number" name="br_phone" class="form-control" placeholder="07[7,8,9]#######" value="'.$row["BPhone"].'"   required="required"/>
            </div>';
        }  
        echo $output;
    }     
?>

