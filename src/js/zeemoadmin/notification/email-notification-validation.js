$(function(){
 $("#receiver_yes").click(function(){
    $("#receiver_box").slideDown();  
	})
 $("#receiver_no").click(function(){
    $("#receiver_box").slideUp();  
	})	

})
function OpenPageContentForm(file_path)
{
 window.location=file_path;
}
function ValidateEmailMessageForm()
{
 var errors=new Array("error","error1","error2","error3","error4");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#subject").val())=="") 
 {
  errorFields[e]=new Array("error3","Please enter subject","subject");
  e++;
 }else RemoveError("subject");
 if(trim($("#sender_email").val())=="") 
 {
  errorFields[e]=new Array("error4","Please enter sender email address","sender_email");
  e++;
 }
 else if(!ValidateEmails(trim($("#sender_email").val())))
 {
  errorFields[e]=new Array("error4","Invalid Email Address","sender_email");
  e++;
 } 
 else RemoveError("sender_email");


 
 if(ValidateCkeditorFieldValue(CKEDITOR.instances.message.getData(),'message'))
 {
  errorFields[e]=new Array("error1","Please enter message","cke_message");
 }
 return ShowErrorOnField(errorFields);


}
function ValidateSetUpEmailMessageForm()
{
 if($("#receiver_yes").prop('checked') == true)
 {	
  var errors=new Array("error","error1","error2","error3","error4","error5","error6","error7","error8");	

 }
 else
 {
  var errors=new Array("error","error1","error2","error5","error6","error7");	
 }
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 
 var sender_email=trim($("#sender_email").val());
 var sender_name=trim($("#sender_name").val());
 if(sender_email != "" || sender_email != "")
 {
  if(sender_email == "")
  {
   errorFields[e]=new Array("error1","Please enter sender email address","sender_email");
   e++;
  }
  else if(!ValidateEmail(sender_email))
  {
   errorFields[e]=new Array("error1","Invalid email address","sender_email");
   e++;
  }
  else RemoveError("sender_email");
 
  if(sender_name == "")
  {
   errorFields[e]=new Array("error2","Please enter sender name","sender_name");
   e++;
  }
  else RemoveError("sender_name");
 }
 
 if($("#receiver_yes").prop('checked') == true)
 {	
  var receiver_to_emails=trim($("#receiver_to_emails").val());
  var receiver_cc_emails=trim($("#receiver_cc_emails").val());
  var receiver_bcc_emails=trim($("#receiver_bcc_emails").val());
  
  if(receiver_to_emails =="") 
  {
   errorFields[e]=new Array("error3","Please enter at least one email address","receiver_to_emails");
   e++;
  }
  else if(!ValidateEmails(receiver_to_emails))
  {
   errorFields[e]=new Array("error3","The receiver email id field must contain all valid email address(es)","receiver_to_emails");
   e++;
  }
  else RemoveError("receiver_to_emails");
 
  if(receiver_cc_emails != "" && (!ValidateEmails(receiver_cc_emails)))
  {
   errorFields[e]=new Array("error4","The receiver cc email id field must contain all valid email address(es)","receiver_cc_emails");
   e++;
  }
  else RemoveError("receiver_bcc_emails");

  if(receiver_bcc_emails != "" && (!ValidateEmails(receiver_bcc_emails)))
  {
   errorFields[e]=new Array("error8","The receiver bcc email id field must contain all valid email address(es)","receiver_bcc_emails");
   e++;
  }
  else RemoveError("receiver_bcc_emails");

 }
 
 
 if(trim($("#subject").val())=="") 
 {
  errorFields[e]=new Array("error5","Please enter subject","subject");
  e++;
 }else RemoveError("subject");
 
 if(ValidateCkeditorFieldValue(CKEDITOR.instances.message.getData(),'message'))
 {
  errorFields[e]=new Array("error6","Please enter message","cke_message");
 }
 return ShowErrorOnField(errorFields);
}

function ValidateThankYouMessageForm()
{
 var errors=new Array("error","error1");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 
 if(ValidateCkeditorFieldValue(CKEDITOR.instances.message.getData(),'message'))
 {
  errorFields[e]=new Array("error1","Please enter message","cke_message");
 }
 return ShowErrorOnField(errorFields);
}

function ValidateSenderInformation()
{
 var errors=new Array("error","error1","error2");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);

 var sender_email=trim($("#sender_email").val());
 var sender_name=trim($("#sender_name").val());

 if(sender_email == "")
 {
  errorFields[e]=new Array("error1","Please enter sender email address","sender_email");
  e++;
 }
 else if(!ValidateEmail(sender_email))
 {
  errorFields[e]=new Array("error1","Invalid email address","sender_email");
  e++;
 }
 else RemoveError("sender_email");
 
 if(sender_name == "")
 {
  errorFields[e]=new Array("error2","Please enter sender name","sender_name");
  e++;
 }
 else RemoveError("sender_name");


 return ShowErrorOnField(errorFields);
 
}
