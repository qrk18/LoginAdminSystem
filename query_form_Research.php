<?php
include_once 'dbconnect.php';
$university = $_POST['University'];
$query=("SELECT DISTINCT Research FROM `userdetail` WHERE University='$university'");
$stmtUni=mysql_query($query);
echo $university;
$msg="";
$msg.= '<table class="table table-striped table-bordered table-hover"> 
		  <tr>
          <th>Research</th>
          
          </tr>';
    while($row = mysql_fetch_array($stmtUni))
    {
     $msg.='<tr>
	 <td>'. $row['Research'] .'</td>
	 
      </tr>';
     }
    $msg.='</table>';
  

?>
<form>
<?php echo $msg;?>
</form>
