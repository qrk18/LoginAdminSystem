<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user']) ) {
		header("Location: index.php");
		exit;
	}
	// select loggedin users detail
	$res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
	$userRow=mysql_fetch_array($res);
	$unApproveUser = mysql_query("SELECT userId, userName, userRole, approve FROM users where userRole='USER' and approve=0");

	//$query=mysql_query("UPDATE users SET approve = 1 WHERE approve= 0");
	
function updateUserField($givenUserId){
	  $userId = $givenUserId;
      $query=mysql_query("UPDATE users SET approve = 1 WHERE userId = $userId");
   }
	
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['userName']; ?></title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
<script type="text/javascript">
 function editFunction(id) {
       $('#btn-add').hide();
	   //var id = $(".edit-link").attr("id");
		var edit_id = {'edit_id':id};
		if(confirm('Sure to Approve ID no = ' +edit_id['edit_id']))
		{
			
				//$(".content-loader").load('approve_form.php?edit_id='+edit_id);
				
				$.post("approve_form.php",edit_id);
				alert("Approved");
				window.location.href="admin.php";
			
				
		}
		
	//alert("approved");
	
	
	
    }

 function denyFunction(id) {
       $('#btn-add').hide();
	   //var id = $(".edit-link").attr("id");
		var edit_id = {'edit_id':id};
		if(confirm('Sure to Deny ID no = ' +edit_id['edit_id']))
		{
			
				//$(".content-loader").load('approve_form.php?edit_id='+edit_id);
				
				$.post("deny_form.php",edit_id);
				alert("User has been denied and deleted");
				window.location.href="admin.php";
			
				
		}
		
	//alert("approved");
	
	
	
    }
</script>
</head>
<body>

	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
	  <div class="navbar-header">
		<h4>Admin Portal</h4>
	  </div>
        <!--<div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand">SERC Assignment</a>
        </div>--!>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['userName']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
   </nav> 

	<div id="wrapper">

	<div class="container">
    
    	<div class="page-header">
    	<h3>Approval Requests</h3>
    	</div>
        
        <!--<div class="row">
        <div class="col-lg-12">
        <h1>Focuses on PHP, MySQL, Ajax, jQuery, Web Design and more...</h1>
        </div>
        </div>-->
    
    </div>
	<!--<div>
	  <button type="submit" class="btn btn-block btn-primary" name="btn-approve">Click here to approve</a>
	  </div>-->
    <div class="container">
	 <table cellspacing="0" width="100%" id="example" class="table table-striped table-hover table-responsive">
        <thead>
        <tr>
         <th>Emp ID</th>
        <th>Emp Name</th> 
        <th>Approve</th>
        <th>Deny</th>
        </tr>
        </thead>
        <tbody>
        <?php
        require_once 'dbconnect.php';
        
        $stmt =mysql_query("SELECT * FROM users where approve=0 ORDER BY userId DESC");
      
		while($row=mysql_fetch_array($stmt))
		{
			?>
			<tr>
			<td><?php echo $row['userId']; ?></td>
			<td><?php echo $row['userName']; ?></td>
			
			
			<td align="center">
			<a id="<?php echo $row['userId']; ?>" class="edit-link" href="#" onClick= editFunction(<?php echo $row['userId']; ?>) title="Edit">
			<img src="edit.png" width="20px" />
            </a></td>
			<td align="center"><a id="<?php echo $row['userId']; ?>" class="delete-link" href="#" onClick=denyFunction(<?php echo $row['userId'];?>) title="Delete" >
			<img src="delete.png" width="20px" />
            </a></td>
			</tr>
			<?php
		}
		?>
        </tbody>
        </table>
    </div>
    </div>
    </div>
    
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
</body>
</html>
<?php ob_end_flush(); ?>