<?php
include "connection.php";
$table = '' ;
$c = 1; 
if(isset($_POST["search_key"]))
{
	$sdata=$_POST["search_key"];
	if ($_POST['search_key'] !='')
	{
		$sql="SELECT BID,BName,Bphone,BActive,OwnName ,OwnPhone,AdmName
        FROM branch br , owner own ,Admin adm
        WHERE br.OwnID=own.OwnID and own.AdmID=adm.ADmID and (OwnName like '%$sdata%'|| BName like '%$sdata%'||OwnPhone like'%$sdata%'||BPhone like'%$sdata%')
        Order by BActive DESC,OwnName ASC ,BName ASC" ;
	}
	else
	{
		$sql = "SELECT BID,BName,Bphone,BActive,OwnName ,OwnPhone,AdmName
        FROM branch br , owner own ,Admin adm
        WHERE br.OwnID=own.OwnID and own.AdmID=adm.ADmID
        Order by BActive DESC,OwnName ASC ,BName ASC";
	}
	$result = mysqli_query($conn,$sql) ; 
	if(mysqli_num_rows($result)<1)
	{
	    $table.='<tr> <th colspan="5" class="text-center"> NO DATA FOUND </th> </tr> ' ;
	}else
	{
        while($row=mysqli_fetch_assoc($result))
                {
                    $b_id=$row['BID'];
                    $table.="<tr>";
                    if ($row["BActive"]==0)
                    {
                        $table.= "<td style='background-color:#ff6767' title='".$row['AdmName']."'>".$c." </td>";
                    }else{
                        $table.= "<td>".$c." </td>";
                    }
                    $table.= "<td>".$row['BName']." </td>";
                    $table.= "<td>".$row['Bphone']." </td>";
                    $table.= "<td>".$row['OwnName']."    ". $row['OwnPhone']."</td>";
                    $table.= "<td>
                    <!-- Button trigger modal -->
                    <button name='view' id='$b_id' class='btn btn-info view_data_btn btn-block' ><i class='fas fa-eye'></i>
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