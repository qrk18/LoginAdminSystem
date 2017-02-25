<?php
include_once 'dbconnect.php';

if($_POST['del_id'])
{
	$id = $_POST['del_id'];	
	$stmt=mysql_query("DELETE FROM userdetail WHERE Id='". $id ."'");
	if($stmt)
		{
			echo "Successfully updated";
		}
		else{
			echo "Query Problem";
		}
}
?>