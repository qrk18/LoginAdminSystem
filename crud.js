// JavaScript Document

$(document).ready(function(){
	alert("I'm clicked");
/* Data Insert Starts Here */
	$(document).on('submit', '#emp-SaveForm', function() {
	  
	   $.post("create.php", $(this).serialize())
        .done(function(data){
			$("#dis").fadeOut();
			$("#dis").fadeIn('slow', function(){
				 $("#dis").html('<div class="alert alert-info">'+data+'</div>');
			     $("#emp-SaveForm")[0].reset();
		     });	
		 });   
	     return false;
    });
	/* Data Insert Ends Here */
	
	/* Get Edit ID  */
	$(".edit-link").click(function()
	{
		alert("hi ja");
		var id = $(this).attr("id");
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
		return false;
	});
	/* Get Edit ID  */
	
	
});
