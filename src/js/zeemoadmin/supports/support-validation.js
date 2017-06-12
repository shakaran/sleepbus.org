function ValidateSupportForm()
{
 var errors=new Array("error","error1","error2");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#support_title").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter supporter title","support_title");
  e++;
 }else RemoveError("support_title");
 if(ValidateCkeditorFieldValue(CKEDITOR.instances.intro_text.getData(),'intro_text'))
 {
  errorFields[e]=new Array("error2","Please enter intro text","cke_intro_text");
  e++;
 }else RemoveError("intro_text");
 return ShowErrorOnField(errorFields);
}


