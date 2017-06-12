function ValidateBannerForm()
{
 var errors=new Array("error1","error2","error3");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(($("#current_image").val()=="") && ($("#image_file").val()==""))
 {
  errorFields[e]=new Array("error2","Please select banner image","image_file");
  e++;
 }else RemoveError("image_file");

 if((trim($("#url").val()) !="") && (!ValidateUrl($("#url").val())))
 {
  errorFields[e]=new Array("error3","Please enter valid url","url");
  e++;
 }
 else RemoveError("url");
 return ShowErrorOnField(errorFields);
}

function OpenBannerForm(file_path,page_id,page_type,upload_banner_for)
{
 $.prettyPhoto.open(file_path+admin+"/banners/AddBanner/"+page_type+"/"+page_id+"/"+upload_banner_for+"&iframe=true&width=920&height=580");
}


 $(document).ready(function() {
  $("#time_option1").click(function() 
  { 
   document.getElementById("show_error").innerHTML="";
   var error=false;  
   var focus_id="";

   var time_interval = trim(document.getElementById("time_interval").value);
   if(time_interval=="")
   {
    document.getElementById("show_error").innerHTML="Please enter interval time.";
    if(focus_id=="") focus_id="time_interval";
    error=true;
   }
   else if((time_interval != "" && ValidateNumber(time_interval)==false) || (Number(time_interval) == 0))
   {
    document.getElementById("show_error").innerHTML="Interval time must be a nubmer other than zero.";
    if(focus_id=="") focus_id="time_interval";
    error=true;
   }
 
   if(error==true) 
   {
    if(focus_id) document.getElementById(focus_id).focus();
    return false;
   } 
   else
   {
    document.interval_frm.submit(); 
   }
  }); 
 });
function OpenProductBannerForm(path)
{
 window.location=path;
}

 $(document).ready(function() {
  $("#time_option1").click(function() 
  { 
   document.getElementById("show_error").innerHTML="";
   var error=false;  
   var focus_id="";

   var time_interval = trim(document.getElementById("time_interval").value);
   if(time_interval=="")
   {
    document.getElementById("show_error").innerHTML="Please enter interval time.";
    if(focus_id=="") focus_id="time_interval";
    error=true;
   }
   else if((time_interval != "" && ValidateNumber(time_interval)==false) || (Number(time_interval) == 0))
   {
    document.getElementById("show_error").innerHTML="Interval time must be a nubmer other than zero.";
    if(focus_id=="") focus_id="time_interval";
    error=true;
   }
 
   if(error==true) 
   {
    if(focus_id) document.getElementById(focus_id).focus();
    return false;
   } 
   else
   {
    document.interval_frm.submit(); 
   }
  }); 
 });

