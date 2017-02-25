<?php
include_once 'dbconnect.php';
$university = $_POST['University'];
$query=("SELECT Person, Address, PhoneNumber FROM `userdetail` WHERE University='$university'");
$stmtUni=mysql_query($query);
echo $university;
$msg="";
$msg.= '<table class="table table-striped table-bordered table-hover"> 
		  <tr>
          <th>Person</th>
          <th>Address</th>
          <th>PhoneNumber</th>
          </tr>';
    while($row = mysql_fetch_array($stmtUni))
    {
     $msg.='<tr>
	 <td>'. $row['Person'] .'</td>
	 <td>'. $row['Address'].'</td>
     <td>'. $row['PhoneNumber'] .'</td>
      </tr>';
     }
    $msg.='</table>';
  

?>
<form>
<?php echo $msg;?>
</form>
