function ValidateResourcePage()
{
 var errors=new Array("error1","error2","error3","error4","error5","error6","error7");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#page_heading").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter page heading","page_heading");
  e++;
 }else RemoveError("page_heading");
 if(trim($("#meta_title").val())=="") 
 {
  errorFields[e]=new Array("error3","Please enter meta title","meta_title");
  e++;
 } else RemoveError("meta_title");
 if(ValidateCkeditorFieldValue(CKEDITOR.instances.content_id.getData(),'content_id'))
 {
  errorFields[e]=new Array("error7","Please enter content","cke_content_id");
 }
 return ShowErrorOnField(errorFields);
}



