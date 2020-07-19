<?php
include "connection.php";
$table = '' ;
$c = 1; 
if(isset($_POST["search_key"]))
{
	$sdata=$_POST["search_key"];
	if ($_POST['search_key'] !='')
	{
		$sql="SELECT * FROM owner own,admin adm
        WHERE adm.admid=own.admid and (OwnName like '%$sdata%'|| OwnEmail like '%$sdata%'||OwnPhone like'%$sdata%')
        Order by ownActive DESC,ownName ASC" ;
	}
	else
	{
		$sql = "SELECT * FROM owner own ,admin adm where adm.admid = own.admid Order by ownActive DESC,ownName ASC";
	}
	$result = mysqli_query($conn,$sql) ; 
	if(mysqli_num_rows($result)<1)
	{
	    $table.='<tr> <th colspan="5" class="text-center"> NO DATA FOUND </th> </tr> ' ;
	}else
	{
        while($row=mysqli_fetch_assoc($result))
                {
                    $own_id=$row['OwnID'];
                    $table.="<tr>";
                    if ($row["OwnActive"]==0)
                    {
                        $table.= "<td style='background-color:#ff6767' title='".$row['AdmName']."'>".$c." </td>";
                    }else{
                        $table.= "<td>".$c." </td>";
                    }
                    $table.= "<td>".$row['OwnName']." </td>";
                    $table.= "<td>".$row['OwnEmail']." </td>";
                    $table.= "<td>".$row['OwnPhone']." </td>";
                    $table.= "<td>
                    <!-- Button trigger modal -->
                    <button name='edit' id='$own_id' class='btn btn-success edit_data_btn btn-block' style='width:47% ;display:inline-block'><i class='fas fa-edit'></i>
                    Edit
                    </button>
                    <button name='view' id='$own_id' class='btn btn-info view_data_btn btn-block' style='width:47% ;display:inline-block'><i class='fas fa-eye'></i>
                        View
                    </button>
                </td>
                </tr>";
                $c++;
                }      
	}
    echo $table;
}
?>