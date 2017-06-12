function ValidateTestimonialsForm()
{
 var errors=new Array("error","error1","error2");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#testimonials_title").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter title","testimonials_title");
  e++;
 }else RemoveError("testimonials_title");
 if(ValidateCkeditorFieldValue(CKEDITOR.instances.description.getData(),'description'))
 {
  errorFields[e]=new Array("error2","Please enter description","cke_description");
 }
 return ShowErrorOnField(errorFields);
}
function ValidateVideoForm()
{
 var errors=new Array("error1","error2");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#video_title").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter title","video_title");
  e++;
 }else RemoveError("video_title");
 if(trim($("#video_code").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter video code","video_code");
  e++;
 }else RemoveError("video_code");

 return ShowErrorOnField(errorFields);
}
