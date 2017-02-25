<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user']) ) {
		header("Location: index.php");
		exit;
	}
	
	$res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
	$userRow=mysql_fetch_array($res);
	
	
	$query=mysql_query("UPDATE users SET approve = 1 WHERE userId=".$_SESSION['user']);
	
	
	if( isset($_POST['btn-modify']) ) {
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		// prevent sql injections / clear user invalid inputs
		
		if(empty($email)){
			$error = true;
			$emailError = "Please enter your email address.";
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Please enter valid email address.";
		}
		
		if(empty($pass)){
			$error = true;
			$passError = "Please enter your password.";
		}
		
		// if there's no error, continue to login
		if (!$error) {
			
			$password = hash('sha256', $pass); // password hashing using SHA256
		
			$res=mysql_query("Update userEmail, userPass  FROM users WHERE userEmail='$email'");
			$row=mysql_fetch_array($res);
			$count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row
			
			if( $count == 1 && $row['userPass']==$password && $row['approve'] == 1 && $row['userRole']=="USER") {
				$_SESSION['user'] = $row['userId'];
				header("Location: home.php");
			} 
			
			if( $count == 1 && $row['userPass']==$password && $row['userRole']=="ADMIN") {
				$_SESSION['user'] = $row['userId'];
				header("Location: admin.php");
			} 
			else {
				$errMSG = "Incorrect Credentials, Try again...";
			}
				
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['userEmail']; ?></title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
<script type="text/javascript">
 function editFunction(id) {
       $('#btn-add').hide();
	   //var id = $(".edit-link").attr("id");
		var edit_id = id;
		if(confirm('Sure to Edit ID no = ' +edit_id))
		{
			$(".content-loader").fadeOut('slow', function()
			 {
				$(".content-loader").fadeIn('slow');
				$(".content-loader").load('edit_form.php?edit_id='+edit_id);
				$("#btn-add").hide();
				$("#btn-view").show();
			});
		}
		
	$(document).on('submit', '#emp-UpdateForm', function() {
			 
	   $.post("update.php", $(this).serialize())
        .done(function(data){
			alert(data);
			$("#dis").fadeOut();
			$("#dis").fadeIn('slow', function(){
			     $("#dis").html('<div class="alert alert-info">'+data+'</div>');
			     $("#emp-UpdateForm")[0].reset();
				 $("body").fadeOut('slow', function()
				 {
					$("body").fadeOut('slow');
					window.location.href="index.php";
				 });				 
		     });	
		});   
	    return false;
    });
	
	
	
    }  

function deleteUser(id){
		var del_id = id;
		var parent = $('td').filter(function() {
						return $(this).textContent===del_id;
						}).parent('tr');
		
		//var parent = $(this).parent("td").parent("tr");
		if(confirm('Sure to Delete ID no = ' +del_id))
		{
			$.post('delete.php', {'del_id':del_id}, function(data)
			{
				alert(data);
				alert("data deleted");
				parent.remove();
				window.location.href="home.php";
			});	
		}
	}

function btnaddClick(){
		$(".content-loader").fadeOut('slow', function()
		{
			$(".content-loader").fadeIn('slow');
			$(".content-loader").load('add_form.php');
			$("#btn-add").hide();
			$("#btn-view").show();
		});
		$(document).on('submit', '#emp-SaveForm', function() {
	  
	   $.post("create.php", $(this).serialize())
        .done(function(data){
			alert(data);
			$("#dis").fadeOut();
			$("#dis").fadeIn('slow', function(){
				 $("#dis").html('<div class="alert alert-info">'+data+'</div>');
			     $("#emp-SaveForm")[0].reset();
		     });	
		 });   
	     return false;
    });
	}	
	
function btnViewClick(){
		
		$("body").fadeOut('slow', function()
		{
			$("body").load('index.php');
			$("body").fadeIn('slow');
			window.location.href="home.php";
		});
	}
	
function btnQueryUniversityClick(){
	$(".content-loader").fadeOut('slow', function()
		{
			$(".content-loader").fadeIn('slow');
			$(".content-loader").load('searchData.php');
			$("#btn-add").show();
			$("#btn-view").show();
		});
		
		$(document).on('submit', '#emp-SearchForm', function() {
	  
	   $.post("query_form.php", $(this).serialize())
        .done(function(data){
			//alert(data);
			$("#dis").fadeOut();
				//$(".content-loader").html(data);
				 $("#data").html(data);
			    	    
		 });   
	    return false;
    });
	

}

function btnQueryResearchClick(){
	$(".content-loader").fadeOut('slow', function()
		{
			$(".content-loader").fadeIn('slow');
			$(".content-loader").load('searchDataResearch.php');
			$("#btn-add").show();
			$("#btn-view").show();
		});
		
		$(document).on('submit', '#emp-ResearchForm', function() {
	  
	   $.post("query_form_Research.php", $(this).serialize())
        .done(function(data){
			//alert(data);
			$("#dis").fadeOut();
				//$(".content-loader").html(data);
				 $("#data").html(data);
			    	    
		 });   
	    return false;
    });
	

}
</script>
</head>
<body>

	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" >Welcome <?php echo $userRow['userName']; ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
         <!-- <ul class="nav navbar-nav">
           
          </ul> -->
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['userEmail']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
				<!--<li><a href="logout.php?delete"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Delete Account</a></li> -->
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
   </nav> 

	<div id="wrapper">

	<!--<div class="container">
    
    	<div class="page-header">
    	<h3>SERC Assignment</h3>
    	</div>
        
        <div class="row">
        <div class="col-lg-12">
        <h1>Focuses on PHP, MySQL, Ajax, jQuery, Web Design and more...</h1>
        </div>
        </div>
    
    </div> -->
	     
        	<div class="container">
      
        <h2 class="form-signin-heading">Employee Records.</h2><hr />
        <button class="btn btn-info" type="button"  onClick=btnaddClick() id="btn-add"> <span class="glyphicon glyphicon-pencil"></span> &nbsp; Add Employee</button>
        <button class="btn btn-info" type="button"  onClick= btnViewClick() id="btn-view"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; View Employee</button>
        <button class="btn btn-info" type="button"  onClick= btnQueryUniversityClick() id="btn-view"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; Data of particular University</button>
        <button class="btn btn-info" type="button"  onClick= btnQueryResearchClick() id="btn-view"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; Only Research Data of particular University</button>
        <hr />
        
      
		
		 <div class="content-loader">
        
        <table cellspacing="0" width="100%" id="example" class="table table-striped table-hover table-responsive">
        <thead>
        <tr>
        <th>Id</th>
        <th>Person</th>
       <th>Address</th>
       <th>University</th> 
       <th>Phone Number</th> 
       <th>Employment</th> 
       <th>Research</th> 
        <th>edit</th>
        <th>delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        require_once 'dbconnect.php';
        
        $stmt =mysql_query("SELECT * FROM userdetail ORDER BY Id");
      
		while($row=mysql_fetch_array($stmt))
		{
			?>
			<tr>
			<td><?php echo $row['Id']; ?></td>
			<td><?php echo $row['Person']; ?></td>
			<td><?php echo $row['Address']; ?></td>
			<td><?php echo $row['University']; ?></td>
			<td><?php echo $row['PhoneNumber']; ?></td>
			<td><?php echo $row['Employment']; ?></td>
			<td><?php echo $row['Research']; ?></td>
			
			<td align="center">
			<a id="<?php echo $row['Id']; ?>" class="edit-link" href="#" onClick= editFunction(<?php echo $row['Id']; ?>) title="Edit">
			<img src="edit.png" width="20px" />
            </a></td>
			<td align="center"><a id="<?php echo $row['Id']; ?>" class="delete-link" href="#" onClick=deleteUser(<?php echo $row['Id'];?>) title="Delete" >
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
    
    <br />
		
    </div>
	<div id="data">
	</div>
    <!--<script type="text/javascript" src="crud.js"></script> -->
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
</body>
</html>
<?php ob_end_flush(); ?>