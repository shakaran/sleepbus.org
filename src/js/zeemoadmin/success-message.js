// JavaScript Document
$(document).ready(function() {
	        var msg=$('input[name=success_message]').attr('value');
			if(msg !="")
			{
			 $("<div>", {id : 'flash_message',text: msg }).hide().prependTo("body").slideDown('slow').delay(6000).slideUp(function() { $(this).remove(); });
			}
});
