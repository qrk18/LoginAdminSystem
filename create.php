<?php
require_once 'dbconnect.php';

	
	if($_POST)
	{
		//$emp_name = $_POST['emp_name'];
		//$emp_dept = $_POST['emp_dept'];
		//$emp_salary = $_POST['emp_salary'];
		
		$id = $_POST['Id'];
		$person = $_POST['Person'];
		$Address = $_POST['Address'];
		$University = $_POST['University'];
		$PhoneNumber = $_POST['PhoneNumber'];
		$Employment = $_POST['Employment'];
		$Research = $_POST['Research'];
		
		try{
			
			//$stmt = $db_con->prepare("INSERT INTO tbl_employees(emp_name,emp_dept,emp_salary) VALUES(:ename, :edept, :esalary)");
			//$query="INSERT INTO userdetail(Id,Person,Address, University, PhoneNumber, Employment, Research)Values('".$person."','".$Address."','".$University."','".$PhoneNumber."','".$Employment."','".$Research."'");
			$query="INSERT INTO userdetail(Person,Address, University, PhoneNumber, Employment, Research)Values('$person','$Address','$University','$PhoneNumber','$Employment','$Research')";
			$stmt=mysql_query($query);
						
			if($stmt)
			{
				//echo $query;
				echo "Successfully Added";
			}
			else{
				//echo $query;
				echo "Query Problem";
			}	
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
	}

?>