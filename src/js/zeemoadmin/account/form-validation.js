function ValidateAccountTypeForm()
{
 var errors=new Array("error","error1");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#type_name").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter account type name","type_name");
  e++;
 }else RemoveError("type_name");
 return ShowErrorOnField(errorFields);
}
