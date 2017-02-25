<?php
include_once 'dbconnect.php';

if($_POST['edit_id'])
{
	$id = $_POST['edit_id'];	
	$stmt=mysql_query("DELETE FROM users WHERE userId='". $id ."'");
	$row=mysql_fetch_array($stmt);
	if($row){
	
		echo "stmt";
		echo "Denied";
	}
	else
	{
		echo "Query Problem";
	}
}

?>

