function ValidateCampaignForm()
{
 var errors=new Array("error","error1","error2");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#type_name").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter campaign name","type_name");
  e++;
 }else RemoveError("type_name");
 if(ValidateCkeditorFieldValue(CKEDITOR.instances.mission_statement.getData(),'mission_statement'))
 {
  errorFields[e]=new Array("error2","Please enter mission statement","cke_mission_statement");
 }else RemoveError("mission_statement");
 
 
 return ShowErrorOnField(errorFields);
}
