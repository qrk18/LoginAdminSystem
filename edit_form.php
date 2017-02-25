<?php
include_once 'dbconnect.php';

if($_GET['edit_id'])
{
	$id = $_GET['edit_id'];	
	$stmt=mysql_query("SELECT * FROM userdetail WHERE Id=".$id);
	$row=mysql_fetch_array($stmt);
}

?>
<style type="text/css">
#dis{
	display:none;
}
</style>


	
    
    <div id="dis">
    
	</div>
        
 	
	 <form method='post' id='emp-UpdateForm' action='#'>
 
    <table class='table table-bordered'>
 		<input type='hidden' name='Id' value='<?php echo $row['Id']; ?>' />
        <tr>
            <td>Person</td>
            <td><input type='text' name='Person' class='form-control' value='<?php echo $row['Person']; ?>' required></td>
        </tr>
 
        <tr>
            <td>Address</td>
            <td><input type='text' name='Address' class='form-control' value='<?php echo $row['Address']; ?>' required></td>
        </tr><tr>
            <td>University</td>
            <td><input type='text' name='University' class='form-control' value='<?php echo $row['University']; ?>' required></td>
        </tr><tr>
            <td>Phone Number</td>
            <td><input type='text' name='PhoneNumber' class='form-control' value='<?php echo $row['PhoneNumber']; ?>' required></td>
        </tr><tr>
            <td>Employment</td>
            <td><input type='text' name='Employment' class='form-control' value='<?php echo $row['Employment']; ?>' required></td>
        </tr><tr>
            <td>Research</td>
            <td><input type='text' name='Research' class='form-control' value='<?php echo $row['Research']; ?>' required></td>
        </tr>
 
        
 
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-update" id="btn-update">
    		<span class="glyphicon glyphicon-plus"></span> Save Updates
			</button>
            </td>
        </tr>
 
    </table>
</form>
     
