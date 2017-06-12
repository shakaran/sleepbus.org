function OpenPageContentForm(file_path)
{
 window.location=file_path;
}
function ValidateContactForm()
{
 var errors=new Array("error","error1","error2","error3","error4","error5","error6","error7");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 var email=trim($("#email").val());
 if(trim($("#address").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter address","address");
  e++;
 }else RemoveError("address");
 if(email !="" && (ValidateEmail(email)==false)) 
 {
  errorFields[e]=new Array("error5","Invalid email address","email");
  e++;
 }else RemoveError("email");
 if(trim($("#phone").val())=="")
 {
  errorFields[e]=new Array("error4","Please enter phone no.","phone");
  e++;
 }
 else if(!ValidatePhone($("#phone").val()))
 {
  errorFields[e]=new Array("error4","Invalid phone no.","phone");
  e++;
 }
 else RemoveError("phone");
 if(trim($("#phone2").val())=="")
 {
  errorFields[e]=new Array("error7","Please enter phone no.","phone2");
  e++;
 }
 else RemoveError("phone2");
 if(trim($("#fax").val()) !="" && (!ValidatePhone($("#fax").val())))
 {
  errorFields[e]=new Array("error6","Invalid fax no.","fax");
  e++;
 }else RemoveError("fax");
 return ShowErrorOnField(errorFields);
}
function ValidateHomePageForm()
{
 var errors=new Array("error","error6","error7");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(ValidateCkeditorFieldValue(CKEDITOR.instances.content_id.getData(),'content_id'))
 {
  errorFields[e]=new Array("error6","Please enter home page content","cke_content_id");
  e++;
 }else RemoveError("content_id");
 if(ValidateCkeditorFieldValue(CKEDITOR.instances.banner_content.getData(),'banner_content'))
 {
  errorFields[e]=new Array("error7","Please enter  banner content","cke_banner_content");
 }
 
 return ShowErrorOnField(errorFields);
}
function ValidateMoreInfoSectionForm()
{
 var errors=new Array("error1","error2","error3","error4");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#info_title").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter title","info_title");
  e++;
 }else RemoveError("info_title");
 if((trim($("#url").val())!="") && (!ValidateUrl($("#url").val())))
 {
  errorFields[e]=new Array("error4","Please enter valid url","url");
  e++;
 }
 else RemoveError("url");
 if(ValidateCkeditorFieldValue(CKEDITOR.instances.description.getData(),'description'))
 {
  errorFields[e]=new Array("error2","Please enter description","cke_description");
 }
 return ShowErrorOnField(errorFields);
}

function OpenMoreInfoForm(file_path, parent_id)
{
 $.prettyPhoto.open(file_path+"&iframe=true&width=894&height=620");
}

function OpenEditMoreInfoForm(file_path,image_id)
{
 $.prettyPhoto.open(file_path+"/"+image_id+"&iframe=true&width=894&height=620");
}
function OpenAddWhyUsForm(file_path, parent_id)
{
 $.prettyPhoto.open(file_path+"&iframe=true&width=694&height=510");
}

function OpenEditWhyUsForm(file_path,image_id)
{
 $.prettyPhoto.open(file_path+"/"+image_id+"&iframe=true&width=694&height=510");
}

function ValidateAboutSectionForm()
{
 var errors=new Array("error1","error2","error3","error4","error5");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);

 if(trim($("#item_title").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter title","item_title");
  e++;
 }else RemoveError("item_title");
 
 if($("#page_type2").is(":checked"))
 {
  if(trim($("#url").val())=="")
  {
   errorFields[e]=new Array("error4","Please enter url","url");
   e++;
  }
  else if((trim($("#url").val())!="") && (!ValidateUrl($("#url").val())))
  {
   errorFields[e]=new Array("error4","Please enter valid url","url");
   e++;
  }else RemoveError("url");
 }

 if(ValidateCkeditorFieldValue(CKEDITOR.instances.intro_text.getData(),'intro_text'))
 {
  errorFields[e]=new Array("error2","Please enter intro text","cke_intro_text");
 }
 
 return ShowErrorOnField(errorFields);
}

function ValidateClientsForm()
{
 var errors=new Array("error1","error2","error3");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#clients_title").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter title","clients_title");
  e++;
 }else RemoveError("clients_title");
 
 if($("#submit_form").val()=="Submit")
 {
  if($("#image_file").val()=="")
  {
   errorFields[e]=new Array("error2","Please select an image","image_file");
   e++;
  }else RemoveError("image_file");
 }
 if((trim($("#url").val())!="") && (!ValidateUrl($("#url").val())))
 {
  errorFields[e]=new Array("error3","Please enter valid url","url");
  e++;
 }
 else RemoveError("url");
 return ShowErrorOnField(errorFields);
}


