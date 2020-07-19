<?php  
    if(isset($_POST["owner_id"]))  
    { 
        include"connection.php";
        $output = '';  
        $query = "SELECT ownID,ownName , ownEmail , ownPassword ,ownPhone,OwnActive
                FROM owner
                WHERE ownID = '".$_POST["owner_id"]."'";                  
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($result))  
        {  
        $status=$row["OwnActive"];
        $output.= '  
            <div >
                <input type="hidden" name="id" class="form-control" value="'.$row["ownID"].'" />
            </div>
            <div >
                <label> Owner Name</label>
                <input type="text" name="owner_name" class="form-control" placeholder="owner Name" value="'.$row["ownName"].'" readonly="readonly" />
            </div>
            <div >
                <label>Owner Email</label>
                <input type="text" name="owner_email" class="form-control" placeholder="owner Email" value="'.$row["ownEmail"].'" readonly="readonly" />
            </div>
            <div >
                <label> Owner Password </label>
                <input type="text" name="owner_password" class="form-control" placeholder="owner password" value="'.$row["ownPassword"].'" required="required"  />
            </div>
            <div >
                <label> owner Phone</label>
                <input type="number" name="owner_phone" class="form-control" placeholder="07[7,8,9]#######" value="'.$row["ownPhone"].'"   required="required"/>
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

