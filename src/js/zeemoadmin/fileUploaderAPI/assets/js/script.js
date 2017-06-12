$(function(){

    var ul = $('#upload ul');

    $('#drop a').click(function(){
		
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });

    // Initialize the jQuery File Upload plugin
    $('#upload').fileupload({

        // This element will accept file drag/drop uploading
        dropZone: $('#drop'),

        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {

            var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
                ' data-fgColor="#008000" data-readOnly="1" data-bgColor="#fff" class="not-show" /><p></p><span></span></li>');

            
		    // Append the file name and file size
            tpl.find('p').html(data.files[0].name+"<div class='wait' align='center'>Please wait, file is being uploaded <br /><img src='"+$("#base_path").val()+"images/ajax-loader.gif' style='padding-top:7px;'></div>")
                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

            // Add the HTML to the UL element
            data.context = tpl.prependTo(ul);

            // Initialize the knob plugin
            tpl.find('input').knob();

            // Listen for clicks on the cancel icon
            tpl.find('span').click(function(){
               
                if(tpl.hasClass('working')){
                    jqXHR.abort();
					
                }
				
                
				if(tpl.hasClass('error'))
				{
                 //tpl.fadeOut();
				 tpl.remove();
				}
               
				
				

            });
			

            // Automatically upload the file once it is added to the queue
            var jqXHR = data.submit();
        },

        progress: function(e, data){

            // Calculate the completion percentage of the upload
			
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
            data.context.find('input').val(progress).change();
            
            if(progress == 100){
				
                data.context.removeClass('working');

            }
        },
		// ---- Code by Rajeev
		// Introduce new function 'fileLoaded': called in jquery.fileupload.js for showing image
        fileLoaded:function(e, data){
			
			    
			    var responseMessage=new Array();
			    responseMessage=data.jqXHR.responseText.split(":");			
				
				var uploaded_file=responseMessage[1];
				var path_to_upload=$("#path_to_upload").val();
				var base_path=$("#base_path").val();
				var upload_type=$("#upload_type").val();
				
				data.context.find('div.wait').remove();
				
				if(upload_type == "image")
				{
				 var img_content=$("<im />");
				 data.context.find('div').after(img_content)
				 //------------ Load Image -----------------

			     var requested_url=base_path+admin+'/home/showImage';
				
			     var param = {'img_src':base_path+path_to_upload+"/"+uploaded_file}; 

				 $.ajax({
  				 url: requested_url,
				 type:'POST', // You may use GET method also
  			 	 data: param, 
	  	    	 success: function(result) {
					
				 data.context.find('im').html(result);
				 
				 var item_id=responseMessage[2];
				 

               // Preparing form for adding image title and description
				var image_description=$("#description").val();
				var open_form_title='';
				var form_content='';
				
				// if image description is not there
				var open_form_title="Add Title";
				var is_description=(image_description)?'1':'0';
				form_content="<div class='section1'><div class='caption'>Title : </div><div class='field1'><input type='text' id='image_title_"+item_id+"' name='image_title_"+item_id+"' value='' class='title_field'></div><div class='updator'><input type='button' value='Update' onclick='UpdateImageTitle("+item_id+","+is_description+")'>&nbsp;&nbsp;&nbsp;&nbsp;<input type='button' value='Close' onclick='CancelChange("+item_id+")'></div></div>";
				
				if(image_description == true)
				{
				 open_form_title+=" & Description";
				 form_content+="<div class='section2'><div class='caption'>Description</div><div class='field2'><textarea class='description_field' id='image_description_"+item_id+"' name='image_description_"+item_id+"' rows='4'></textarea></div></div>";
				}
				else
				{
				 form_content+="<inpu type='hidden' id='image_description_"+item_id+"' name='image_description_"+item_id+"' value='' />";
				}
				

				var li_object=data.context;
				var delete_item="<a href='javascript:void(0)' class='deleteItem' style='color:red;text-decoration:none'>Delete</a>&nbsp;|&nbsp;<a href='javascript:void(0)' class='removeItem' style='color:red;text-decoration:none' onclick='ShowForm("+item_id+")'>"+open_form_title+"</a>"				
				 
				 // Append link of 'Delete' and 'Add Title & Description' to the list
				 var tool=$("<tool />");
				 data.context.find('p i').append(tool);
				 data.context.find('tool').html(delete_item);
				 
				 
				 
				 
				 // Append title and description form to list of item.
				 // Preparing Delete and Add title & description link to the list 
				 
				 var add_form=$("<div />",{'id':'form_'+item_id,'class':'add_form'});
				 data.context.append(add_form);
				 data.context.find('div#form_'+item_id).html(form_content);
				 
				

 				 // Add event for delete item from list
				 data.context.find('tool a.deleteItem').on('click',function(){
				   var parameter={'parent_field':$('#parent_field').val(),'parent_id':$('#parent_id').val(),'item_id':responseMessage[2],'table_name':$('#table_name').val(),'path_to_upload':$('#path_to_upload').val(),'field_name':$('#field_name').val()};
				   deleteListItem(data.context,parameter);
				 })
				 
				 
   	            } 
				
               });
			}
			else if(upload_type == "brochure")
			{
			 var img_content=$("<im />");
			 data.context.find('div').after(img_content);
			 var brochure_file_res="<a href='"+base_path+path_to_upload+uploaded_file+"' target='_blank'><img src='"+base_path+"images/zeemoadmin/download_icon.png' class='show-image'></a>";
	         data.context.find('im').html(brochure_file_res);
			 
			  var item_id=responseMessage[2];
			 
               // Preparing form for adding brochure title and description
				var brochure_description=$("#description").val();
				var open_form_title='';
				var form_content='';
				
				// if image description is not there
				var open_form_title="Add Title";
				var is_description=(brochure_description)?'1':'0';
				form_content="<div class='section1'><div class='caption'>Title : </div><div class='field1'><input type='text' id='brochure_title_"+item_id+"' name='brochure_title_"+item_id+"' value='' class='title_field'></div><div class='updator'><input type='button' value='Update' onclick='UpdateBrochureTitle("+item_id+","+is_description+")'>&nbsp;&nbsp;&nbsp;&nbsp;<input type='button' value='Close' onclick='CancelChange("+item_id+")'></div></div>";
				
				if(brochure_description == true)
				{
				 open_form_title+=" & Description";
				 form_content+="<div class='section2'><div class='caption'>Description</div><div class='field2'><textarea class='description_field' id='brochure_description_"+item_id+"' name='brochure_description_"+item_id+"' rows='4'></textarea></div></div>";
				}
				else
				{
				 form_content+="<inpu type='hidden' id='brochure_description_"+item_id+"' name='brochure_description_"+item_id+"' value='' />";
				}
				

				var li_object=data.context;
				var delete_item="<a href='javascript:void(0)' class='deleteItem' style='color:red;text-decoration:none'>Delete</a>&nbsp;|&nbsp;<a href='javascript:void(0)' class='removeItem' style='color:red;text-decoration:none' onclick='ShowForm("+item_id+")'>"+open_form_title+"</a>"				
			 
			 
			 
				 // Append link of 'Delete' and 'Add Title & Description' to the list
				 var tool=$("<tool />");
				 data.context.find('p i').append(tool);
				 data.context.find('tool').html(delete_item);
				 
				 
				 
				 
				 // Append title and description form to list of item.
				 // Preparing Delete and Add title & description link to the list 
				 
				 var add_form=$("<div />",{'id':'form_'+item_id,'class':'add_form'});
				 data.context.append(add_form);
				 data.context.find('div#form_'+item_id).html(form_content);
				 
				

 				 // Add event for delete item from list
				 data.context.find('tool a.deleteItem').on('click',function(){
				   var parameter={'parent_field':$('#parent_field').val(),'parent_id':$('#parent_id').val(),'item_id':responseMessage[2],'table_name':$('#table_name').val(),'path_to_upload':$('#path_to_upload').val(),'field_name':$('#field_name').val()};
				   deleteListItem(data.context,parameter);
				 })
				 			 
			 
			 
/*			 
			  // Adding Delete Or Remove Link to list 
			  var tool=$("<tool />");
			  data.context.find('p i').append(tool);
			  var delete_item="<a href='javascript:void(0)' class='deleteItem' style='color:red;text-decoration:none'>Delete</a>&nbsp;|&nbsp;<a href='javascript:void(0)' class='removeItem' style='color:red;text-decoration:none'>Remove from list</a>"
			  data.context.find('tool').html(delete_item);
				 
			  // Add event for remove item from list
			  data.context.find('tool a.removeItem').on('click',function(){
			  removeListItem(data.context);
			 })
 			 // Add event for delete item from list
			 data.context.find('tool a.deleteItem').on('click',function(){
			 var parameter={'parent_field':$('#parent_field').val(),'parent_id':$('#parent_id').val(),'item_id':responseMessage[2],'table_name':$('#table_name').val(),'path_to_upload':$('#path_to_upload').val(),'field_name':$('#field_name').val()};
			 deleteListItem(data.context,parameter);
			})*/
			
			
		   }
			
			
         },

		// --------- End Code {Rajeev}
		fail:function(e, data){
			// Taking Error message from responseText
			data.context.find('div.wait').remove();
			var error_div=$("<er />",{'text':data.jqXHR.responseText});
			data.context.find('p').append(error_div);
            data.context.addClass('error');
			data.context.find('span').css('cursor','pointer');
        }

    });


    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Helper function that formats the file sizes
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }

        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }

        return (bytes / 1000).toFixed(2) + ' KB';
    }
    removeListItem = function(container)
	{
	 container.remove();
	}
	deleteListItem = function(container,param)
	{
	 var requested_url=$('#base_path').val()+admin+'/home/deleteRecord';
	 
	 $.ajax({
  				 url: requested_url,
				 type:'POST', // You may use GET method also
  			 	 data: param, 
	  	    	 success: function(result) {
				  if(result == true)
				  {
				   container.html('');
				   var success=$("<div />",{'text':'Record has been deleted successfully','class':'success'});
				   container.append(success);
				   container.find('.success').fadeIn(400);
				   setTimeout(function(){container.remove();},2000);
				  }
				  else{
					   alert('unable to delete');
					  }
				 }
				 
			})
	 
	 //console.log(parameter);
	}
});
function ShowForm(item_id)
{
 var openFormObject=$("div.open");
 var openListObject=$("li.extend");	
 
 //openFormObject.css('display','none');	
 openFormObject.slideUp('slow');
 openListObject.animate({height: "6em"}, 800);
 openFormObject.removeClass('open');
 openListObject.removeClass('extend'); 

 if(openFormObject.attr('id') != 'form_'+item_id)
 {
  $('#form_'+item_id).parent('li').animate({ height: "16em" }, 200); 
  $('#form_'+item_id).slideDown('slow');
  $('#form_'+item_id).parent('li').addClass('extend');
  $('#form_'+item_id).addClass('open');
 } 
 
}
function CancelChange(item_id)
{
 var openFormObject=$("div.open");
 var openListObject=$("li.extend");	
 
 //openFormObject.css('display','none');	
 openFormObject.slideUp('slow');
 openListObject.animate({height: "6em"}, 800);
 openFormObject.removeClass('open');
 openListObject.removeClass('extend'); 

/* $('#form_'+item_id).parent('li').animate({ height: "6em" }, 500); 
 $('#form_'+item_id).css('display','none');
*/
}
function UpdateImageTitle(item_id,is_description)
{
 var container;
 container=$('#form_'+item_id).find('div.updator');

	
 if(is_description)
 {	
  var param={'item_id':item_id,'table_name':$('#table_name').val(),'image_title':$('#image_title_'+item_id).val(),'description':$('#image_description_'+item_id).val(),'is_description':is_description};
 }
 else
 {
  var param={'item_id':item_id,'table_name':$('#table_name').val(),'image_title':$('#image_title_'+item_id).val(),'is_description':is_description};
 }

 var success=$("<div />",{'class':'success_update'});
     container.find("div.success_update").remove(); 
     container.append(success);
	 container.find('.success_update').html("<img src='"+$("#base_path").val()+"images/ajax-loader.gif' style='padding-top:7px;'>");
	 container.find('.success_update').fadeIn(400);
 
 var requested_url=$('#base_path').val()+admin+'/home/updateImageTitleDescription';
	 
 $.ajax({
  	url: requested_url,
	type:'POST', // You may use GET method also
   	data: param, 

  	    success: function(result) {
		if(result == true)
		{
 	     //var success=$("<div />",{'text':'Record updated successfully','class':'success_update'});
		// container.append(success);
		 //container.find('.success_update').fadeIn(400);
		 container.find('.success_update').html('Record updated successfully');
		 setTimeout(function(){container.find('div.success_update').remove();},4000);
		}
		else
		{
		 alert('unable to update');
		}
   	  } 
     });	 
 
}


function UpdateBrochureTitle(item_id,is_description)
{
 var container;
 container=$('#form_'+item_id).find('div.updator');

	
 if(is_description)
 {	
  var param={'item_id':item_id,'table_name':$('#table_name').val(),'brochure_title':$('#brochure_title_'+item_id).val(),'description':$('#brochure_description_'+item_id).val(),'is_description':is_description};
 }
 else
 {
  var param={'item_id':item_id,'table_name':$('#table_name').val(),'brochure_title':$('#brochure_title_'+item_id).val(),'is_description':is_description};
 }

 var success=$("<div />",{'class':'success_update'});
     container.find("div.success_update").remove(); 
 
     container.append(success);
	 container.find('.success_update').html("<img src='"+$("#base_path").val()+"images/ajax-loader.gif' style='padding-top:7px;'>");
	 container.find('.success_update').fadeIn(400);
 
 var requested_url=$('#base_path').val()+admin+'/home/updateBrochureTitleDescription';
	 
 $.ajax({
  	url: requested_url,
	type:'POST', // You may use GET method also
   	data: param, 

  	    success: function(result) {
		if(result == true)
		{
 	     //var success=$("<div />",{'text':'Record updated successfully','class':'success_update'});
		// container.append(success);
		 //container.find('.success_update').fadeIn(400);
		 container.find('.success_update').html('Record updated successfully');
		 setTimeout(function(){container.find('div.success_update').remove();},4000);
		}
		else
		{
		 alert('unable to update');
		}
   	  } 
     });	 
 
}