function ValidateCategoryForm1()
{
 var errors=new Array("error","error1");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#category_name").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter category name","category_name");
  e++;
 }else RemoveError("category_name");
 return ShowErrorOnField(errorFields);
}
function ValidateBloggerForm()
{
 var errors=new Array("error","error1");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#blogger_name").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter blogger name","blogger_name");
  e++;
 }else RemoveError("blogger_name");
 return ShowErrorOnField(errorFields);
}


function ValidateBlogForm()
{
 var errors=new Array("error","error1","error2","error3","error4","error5","error6");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#cat_id").val())=="") 
 {
  errorFields[e]=new Array("error4","Please select a category","cat_id");
  e++;
 }else RemoveError("cat_id");
 if(trim($("#blog_name").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter blog name","blog_name");
  e++;
 }else RemoveError("blog_name");
 if(trim($("#blogger_id").val())=="")
 {
  errorFields[e]=new Array("error5","Please select a blogger","blogger_id");
  e++;
 }else RemoveError("blogger_id");
 if(ValidateCkeditorFieldValue(CKEDITOR.instances.intro_text.getData(),'intro_text'))
 {
  errorFields[e]=new Array("error2","Please enter intro text","cke_intro_text");
  e++;
 }else RemoveError("intro_text");
 
 if(ValidateCkeditorFieldValue(CKEDITOR.instances.banner_image_text.getData(),'banner_image_text'))
 {
  errorFields[e]=new Array("error6","Please enter banner content","cke_banner_image_text");
  e++;
 }else RemoveError("banner_image_text");

 if(ValidateCkeditorFieldValue(CKEDITOR.instances.description.getData(),'description'))
 {
  errorFields[e]=new Array("error3","Please enter description","cke_description");
 }
 return ShowErrorOnField(errorFields);
}

