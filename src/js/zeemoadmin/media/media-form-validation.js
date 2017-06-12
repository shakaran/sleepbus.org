function ValidateMediaForm()
{
 var errors=new Array("error","error1","error2","error3");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#media_title").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter topic","media_title");
  e++;
 }else RemoveError("media_title");
 if(trim($("#publication").val())=="") 
 {
  errorFields[e]=new Array("error3","Please enter publication","publication");
  e++;
 }else RemoveError("publication");
 
 if(trim($("#url").val())=="") 
 {
  errorFields[e]=new Array("error2","Please enter URL","url");
  e++;
 } 
 else if((!ValidateUrl($("#url").val())))
 {
  errorFields[e]=new Array("error2","Please enter valid URL","url");
  e++;
 } else RemoveError("url");
 return ShowErrorOnField(errorFields);
}


