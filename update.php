<?php
require_once 'dbconnect.php';

	
	if($_POST)
	{
		$id = $_POST['Id'];
		$person = $_POST['Person'];
		$Address = $_POST['Address'];
		$University = $_POST['University'];
		$PhoneNumber = $_POST['PhoneNumber'];
		$Employment = $_POST['Employment'];
		$Research = $_POST['Research'];		
		$query="UPDATE userdetail SET Person='".$person."',Address='".$Address."',University='".$University."',PhoneNumber='".$PhoneNumber."',Employment='".$Employment."',Research='".$Research."'WHERE Id ='". $id;
		$stmt = mysql_query("UPDATE userdetail SET Person='".$person."',Address='".$Address."',University='".$University."',PhoneNumber='".$PhoneNumber."',Employment='".$Employment."',Research='".$Research."'WHERE Id ='". $id."'");
			
		if($stmt)
		{
			echo $id. $person. $query;
			echo "Successfully updated";
		}
		else{
			echo $query;
			echo "Query Problem";
		}
	}

?>