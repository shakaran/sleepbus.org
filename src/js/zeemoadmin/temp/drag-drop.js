$(document).ready(function(){ 
						   
	$(function() {
		var file_path=document.getElementById('file_path').value;
		var parent_id=document.getElementById('parent_id').value;
		$("#recordList ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize") + '&parent_id='+parent_id; 
			$.post(file_path, order, function(theResponse){
				$('#ResponseMessage').fadeIn();
				$("#ResponseMessage").html(theResponse);
				clearTimeout(flash.timeout);
                // Hide the message after 4 seconds
                $('#ResponseMessage').timeout = setTimeout(function() {
                $('#ResponseMessage').fadeOut();
            }, 3000);
				
			}); 
			
        	

																		 
		}								  
		});
	});

});	