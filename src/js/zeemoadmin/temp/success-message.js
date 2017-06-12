// JavaScript Document
$(document).ready(function() {

    var flash = {

        exists: function() {
            return ($('#flash').length > 0);
        },

        show: function(msg) {
            var message;

            // Create the flash div if it does not exist
            if (!flash.exists()) {
                message = $('<div id="flash"></div>').appendTo('body');
             } else {
                message = $('#flash');
             }
			
            // Hide message when it's clicked on
            $('body').delegate('#flash', 'click', function() {
                flash.hide();
            });

            // Set the message if one was specified
            if (msg) {
                message.html(msg);
            }

            // Display the flash
            $('#flash').fadeIn();

            // Clear the timeout if one is set
            clearTimeout(flash.timeout);

            // Hide the message after 4 seconds
            flash.timeout = setTimeout(function() {
                flash.hide();
            }, 4000);
        },

        hide: function() {
            // Hide the flash
            $('#flash').fadeOut();

            // Clear the timeout if it exists
            if (flash.timeout) {
                clearTimeout(flash.timeout);
            }
        },

        // Flash message timeout
        timeout: null
    };

    // Display the flash message if one exists
			//alert(document.getElementById('flash').innerHTML);
			if($('input[name=success_message]').attr('value') !="")
			{
		     if (flash.exists())
			 {
              flash.show($('input[name=success_message]').attr('value'));
             }
			}


});
