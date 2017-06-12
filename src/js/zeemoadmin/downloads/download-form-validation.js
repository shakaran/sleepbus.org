function ValidateCategoryForm()
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