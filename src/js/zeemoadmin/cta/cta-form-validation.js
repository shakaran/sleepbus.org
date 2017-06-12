function ValidateIconSetting()
{
 var errors=new Array("error","error1","error2","error3");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#section_icon_name").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter CTA title","section_icon_name");
  e++;
 }else RemoveError("section_icon_name");
 
 var url = $("#url").val();
 if(trim(url) != '' && !ValidateUrl($("#url").val()))
 {
  errorFields[e]=new Array("error2","Please enter valid url","url");
  e++;
 }
 else RemoveError("url");

 if(ValidateCkeditorFieldValue(CKEDITOR.instances.intro_text.getData(),'intro_text'))
 {
  errorFields[e]=new Array("error3","Please enter CTA content","cke_intro_text");
 }else RemoveError("intro_text");

 return ShowErrorOnField(errorFields);
}

function ValidateMetatagsForm()
{
 var errors=new Array("error1");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#heading").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter heading","heading");
  e++;
 }else RemoveError("heading");
 return ShowErrorOnField(errorFields);
}

function OpenCtaForm(file_path,page_id,page_type,main_section,section)
{
 $.prettyPhoto.open(file_path+admin+"/cta/AddCta/"+page_type+"/"+page_id+"/"+main_section+"/"+section+"&iframe=true&width=620&height=310");
}
function OpenProductMetaForm(path)
{
 window.location=path;
}

 function ShowProductAlert(check_id,total_products)
{
 var total_checked = Number(document.getElementById("total_checked").value);
 if(total_checked >= 1)
 {
	 
  if(document.getElementById(check_id).checked == true)
  {
	
   alert("You can not check more than 1 item");
   document.getElementById(check_id).checked=false;  
  }
  else
  {
   document.getElementById("total_checked").value=total_checked-1;
  }
 }
 else
 {
   if(document.getElementById(check_id).checked == true)
   {
    if(total_products == 0)	  
    {
     alert("You can not check this location because it has no properties");
     document.getElementById(check_id).checked=false;   
    }
    else
    {
     document.getElementById("total_checked").value=total_checked+1;
     document.getElementById(check_id).checked=true;   
    }
   }
   if(document.getElementById(check_id).checked == false)
   {
    document.getElementById("total_checked").value=total_checked-1;
    document.getElementById(check_id).checked=false;   
   }
  }
 }

