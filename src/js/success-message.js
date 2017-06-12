// JavaScript Document

	        var msg=$('input[name=success_message]').attr('value');
			var path=$("#path").val();
			if(msg !="")
			{
		     msg=msg+"<div class='topclose'><img src='"+path+"images/close.png' alt='close' onclick='CloseMe()'></div>";		
			 $("<div>", {id : 'flash_message',html: msg,class : 'toptext' }).hide().prependTo("body").slideDown('slow').delay(6000).slideUp(function() { $(this).remove(); });
			}

   function CloseMe()
   {
    $(".toptext").remove();
   }
