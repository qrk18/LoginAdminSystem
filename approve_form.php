<?php
include_once 'dbconnect.php';

if($_POST['edit_id'])
{
	$id = $_POST['edit_id'];	
	$stmt=mysql_query("UPDATE users SET approve = 1 WHERE userId ='".$id."'");
	$row=mysql_fetch_array($stmt);
	if($row){
	
		echo "stmt";
		echo "Approved";
	}
	else
	{
		echo "Query Problem";
	}
}

?>

<div>
<?php
if($row){
	"stmt";
		echo "Approved";
}
else
{
	echo "Query Problem";
	
}
 ?>
</div>