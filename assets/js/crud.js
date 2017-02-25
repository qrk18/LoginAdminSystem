// JavaScript Document

$(document).ready(function(){
	

	
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
