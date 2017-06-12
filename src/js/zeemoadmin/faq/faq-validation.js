function ValidateFaqForm()
{
 var errors=new Array("error","error1","error2");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#question").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter question","question");
  e++;
 }else RemoveError("question");
 if(ValidateCkeditorFieldValue(CKEDITOR.instances.answer.getData(),'answer'))
 {
  errorFields[e]=new Array("error2","Please enter description","cke_answer");
 }
 return ShowErrorOnField(errorFields);
}
