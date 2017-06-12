function ValidatePageHeadingForm()
{
 var errors=new Array("error","error1","error2");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#heading_id").val())=="") 
 {
  errorFields[e]=new Array("error1","Please select page","heading_id");
  e++;
 }else RemoveError("heading_id");
 if(trim($("#page_heading").val())=="") 
 {
  errorFields[e]=new Array("error2","Please enter page heading","page_heading");
  e++;
 }else RemoveError("page_heading");
 
 return ShowErrorOnField(errorFields);
}

function ValidateCommonSetting()
{
 var errors=new Array("error","error1","error2",'error3');	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
  var unit_fund=trim($("#unit_fund").val());	
  if(unit_fund=="") 
  {
   errorFields[e]=new Array("error3","Please enter fund price for a safe sleep","unit_fund");
   e++;
  }
  else if(!Number(unit_fund)) 
  {
   errorFields[e]=new Array("error3","Please enter numeric value only","unit_fund");
   e++;
  }
  else RemoveError("unit_fund");

 return ShowErrorOnField(errorFields);
}
function ValidateLeadForm()
{
 var errors=new Array("error","error1");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#name").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter lead type name","name");
  e++;
 }else RemoveError("name");
 return ShowErrorOnField(errorFields);
}
function ValidateIconsForm()
{
 var errors=new Array("error","error1","error2","error3","error4");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#icon_title").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter title","icon_title");
  e++;
 }else RemoveError("icon_title");
 if(trim($("#url").val())=="") 
 {
  errorFields[e]=new Array("error2","Please enter URL","url");
  e++;
 }
 else if(!ValidateUrl($("#url").val()))
 {
  errorFields[e]=new Array("error2","Please enter valid url","url");
  e++;
 }
 else RemoveError("url");
 if($("#submit_form").val()=="Submit")
 {
  if($("#image_file").val()=="")
  {
   errorFields[e]=new Array("error3","Please browse to upload image","image_file");
   e++;
  }else RemoveError("image_file");
  if($("#hover_image").val()=="")
  {
   errorFields[e]=new Array("error4","Please browse to upload image","hover_image");
   e++;
  }else RemoveError("hover_image");
 }
 return ShowErrorOnField(errorFields);
}

ValidateFooterForm =function()
{
 var errors=new Array("error","error1");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(ValidateCkeditorFieldValue(CKEDITOR.instances.content_id.getData(),'content_id'))
 {
  errorFields[e]=new Array("error1","Please enter footer content","cke_content_id");
 }
 return ShowErrorOnField(errorFields);
}
