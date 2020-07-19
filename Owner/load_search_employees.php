<?php
session_start();
include "connection.php";
$table = '' ;
$c = 1; 
if(isset($_POST["search_key"]))
{
	$sdata=$_POST["search_key"];
	if ($_POST['search_key'] !='')
	{
		$sql="SELECT EmpID , EmpName,EmpPhone,EmpActive,BName,AdmName FROM employee emp ,branch br,admin adm 
        where emp.BID=br.bID and (emp.AdmID=adm.AdmID or emp.AdmID is null) and emp.BID in (SELECT BID from branch WHERE ownID =".$_SESSION['ownID'].")
        and (EmpName like '%$sdata%'||EmpPhone like'%$sdata%'||BName like'%$sdata%')
        Order by BName ASC,EmpActive DESC,EmpName ASC" ;
	}
	else
	{
		$sql = "SELECT EmpID , EmpName,EmpPhone,EmpActive,BName,AdmName FROM employee emp ,branch br,admin adm 
        where emp.BID=br.bID and (emp.AdmID=adm.AdmID or emp.AdmID is null) and emp.BID in (SELECT BID from branch WHERE ownID =".$_SESSION['ownID'].")
        Order by BName ASC,EmpActive DESC,EmpName ASC";
	}
	$result = mysqli_query($conn,$sql) ; 
	if(mysqli_num_rows($result)<1)
	{
	    $table.='<tr> <th colspan="5" class="text-center"> NO DATA FOUND </th> </tr> ' ;
	}else
	{
        while($row=mysqli_fetch_assoc($result))
                {
                    $emp_id=$row['EmpID'];
                    $table.="<tr>";
                    if ($row["EmpActive"]==0)
                    {
                        $table.= "<td style='background-color:#ff6767' title='".$row['AdmName']."'>".$c." </td>";
                    }else{
                        $table.= "<td>".$c." </td>";
                    }
                    $table.= "<td>".$row['EmpName']." </td>";
                    $table.= "<td>".$row['EmpPhone']." </td>";
                    $table.= "<td>".$row['BName']." </td>";
                    $table.= "<td>
                    <!-- Button trigger modal -->
                    <button name='edit' id='$emp_id' class='btn btn-success edit_data_btn btn-block' style='width:30% ;display:inline-block'><i class='fas fa-edit'></i>
                    Edit
                    </button>
                    <a  class='btn btn-danger btn-block' style='width:30% ;display:inline-block' name='btnDelete' href='deleteemployee.php?emp_id=$emp_id'>
                        <i class='fas fa-trash-alt'></i>
                        Delete
                    </a>
                    <button name='view' id='$emp_id' class='btn btn-info view_data_btn btn-block' style='width:30% ;display:inline-block'><i class='fas fa-eye'></i>
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