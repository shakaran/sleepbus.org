function ValidateMetatagsForm()
{
 var errors=new Array("error1");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#page_title").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter title","page_title");
  e++;
 }else RemoveError("page_title");
 return ShowErrorOnField(errorFields);
}
function ValidateMetatagsUrlForm()
{
 var errors=new Array("error","error1");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#url").val())== "") 
 {
  errorFields[e]=new Array("error","Please enter URL","url");
  e++;
 }else RemoveError("url");
 if(trim($("#page_title").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter title","page_title");
  e++;
 }else RemoveError("page_title");

 return ShowErrorOnField(errorFields);
}

function OpenMetatagsForm(file_path,page_id,page_type,main_section,section)
{
 $.prettyPhoto.open(file_path+admin+"/metatags/AddMetaTags/"+page_type+"/"+page_id+"/"+main_section+"/"+section+"&iframe=true&width=920&height=540");
}
function OpenProductMetaForm(path)
{
 window.location=path;
}

function ValidateNotificationForm()
{
 var errors=new Array("error","error1","error2","error3");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 var blog_to_emailid=trim($("#blog_to_emailid").val());
 var blog_cc_emailid=trim($("#blog_cc_emailid").val());
 var blog_bcc_emailid=trim($("#blog_bcc_emailid").val());


 if(blog_to_emailid =="") 
 {
  errorFields[e]=new Array("error1","Please enter email address","blog_to_emailid");
  e++;
 }
 else if(!ValidateEmails(blog_to_emailid))
 {
  errorFields[e]=new Array("error1","The receiver email id(s) field must contain all valid email address(es)","blog_to_emailid");
  e++;
 }
 else RemoveError("blog_to_emailid");
 
 if(blog_cc_emailid != "" && (!ValidateEmails(blog_cc_emailid)))
 {
  errorFields[e]=new Array("error2","The cc email id(s) field must contain all valid email address(es)","blog_cc_emailid");
  e++;
 }
 else RemoveError("blog_cc_emailid");
 
 if(blog_bcc_emailid != "" && (!ValidateEmails(blog_bcc_emailid)))
 {
  errorFields[e]=new Array("error3","The cc email id(s) field must contain all valid email address(es)","blog_bcc_emailid");
  e++;
 }
 else RemoveError("blog_bcc_emailid");

 
 
 return ShowErrorOnField(errorFields);
}


