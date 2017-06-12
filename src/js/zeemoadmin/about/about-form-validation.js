function ValidateAboutSectionForm()
{
 var errors=new Array("error1","error2","error3","error4","error5");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);

 if(trim($("#item_title").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter title","item_title");
  e++;
 }else RemoveError("item_title");
 
 if($("#page_type2").is(":checked"))
 {
  if(trim($("#url").val())=="")
  {
   errorFields[e]=new Array("error4","Please enter url","url");
   e++;
  }
  else if((trim($("#url").val())!="") && (!ValidateUrl($("#url").val())))
  {
   errorFields[e]=new Array("error4","Please enter valid url","url");
   e++;
  }else RemoveError("url");
 }
 if(ValidateCkeditorFieldValue(CKEDITOR.instances.intro_text.getData(),'intro_text'))
 {
  errorFields[e]=new Array("error2","Please enter intro text","cke_intro_text");
 }
 
 return ShowErrorOnField(errorFields);
}

function HideShowEditor(button_id)
{
 if(button_id==1)
 { 
  $("#new_page_editor").show();
  $("#url_id").hide();
 }
 if(button_id==2)
 { 
  $("#new_page_editor").hide();
  $("#url_id").show();
  $("#url").val('');
  $("#error4").html('');
 }
}

