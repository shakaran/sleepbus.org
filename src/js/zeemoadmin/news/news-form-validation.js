function ValidateNewsForm()
{
 var errors=new Array("error","error1","error2","error3");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#news_title").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter news title","news_title");
  e++;
 }else RemoveError("news_title");
 if(trim($("#intro_text").val())=="")
 {
  errorFields[e]=new Array("error2","Please enter intro text","intro_text");
  e++;
 }else RemoveError("intro_text");
 if(ValidateCkeditorFieldValue(CKEDITOR.instances.description.getData(),'description'))
 {
  errorFields[e]=new Array("error3","Please enter description","cke_description");
 }
 return ShowErrorOnField(errorFields);
}
