var ValidateLoginForm=function() {
	document.getElementById("error_message").innerHTML="";
	
	var msg=true;
	
	if(document.getElementById("username").value=="") {
		document.getElementById("error_message").innerHTML="Please enter user name.";
		msg=false;
	}
	else if(document.getElementById("password").value=="") {
		document.getElementById("error_message").innerHTML="Please enter password.";
		msg=false;
	};
	
	if(msg==false) {
		return false;
	}
}
function ChangePage(idd)
{
 var page_id=document.getElementById(idd).value;
 switch(page_id)
 {
  case "1":
   window.location='manage-homepage.php?page_id='+page_id;
  break;

  case "4":
   window.location='our-showroom.php?id='+page_id;
  break;
  
  case "5":
   window.location='contactus.php?id='+page_id;
  break;
  
  default: window.location='pages.php?id='+page_id;
 }
}

function CountCharacters(input_id, limitbox_id, maxlength)
{
 var length = document.getElementById(input_id).value.length;
 if(length > maxlength)
 {
  var string = document.getElementById(input_id).value.substr(0,maxlength);
  document.getElementById(input_id).value = string;
  alert("You have reached maximum limit");
 }
 document.getElementById(limitbox_id).value = document.getElementById(input_id).value.length;
}

//trim string from start and end
function trim(str)
{
 return(str.replace(/^\s+|\s+$/g, ''));
}

function ValidatePhone(phone)
{
 var len = phone.length;
 var phone_error=false;
 for(var i=0; i < len; i++) 
 {
  char = phone.charAt(i);
  if(isNaN(char) && (char != '(' ) && (char != ')' ) && (char != ' ' ) && (char != '+' ) && (char != '-' )) 
  {
   return false
  }
 } 
 return true;
}

function ValidateEmail(email)
{
 var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z]){2,4}$/;
 if(!pattern.test(email))
 {
  return false;
 }  
 else return true;
}
function ValidateEmails(emails)
{
 var all_emails=Array(),valid_value=0;
 all_emails=emails.split(",");
 if(all_emails.length > 0)
 {
  $.each(all_emails,function(id,email)
  {
   if(!ValidateEmail(email))
   {
    return false
   }
   else
   {
    valid_value++;
   }
  })
  if(valid_value == all_emails.length) return true; else return false;
 }
 else
 {
  return false;
 }
}
function ValidateFloat(num)
{
 var regx = /^(\d)*(.)?(\d){1,2}$/;
 if(num.match(regx)) return true;
 else return false;
}

function ValidateNumber(num)
{
 var regx = /^(\d)*$/;
 if(num.match(regx)) return true;
 else return false;
}

function ValidateUrl(theUrl)
{
 if(/^[a-z]+:\/\//i.test(theUrl))
 {
  return true;
 }
 else
 {
  return false;
 }
}
function AutoFillHTTP(field_name)
{
 var theUrl=document.getElementById(field_name).value;
 if(theUrl != "")
 {
  if(!(/^[a-z]+:\/\//i.test(theUrl)))
  {
   document.getElementById(field_name).value='http://'+theUrl;
  }
 }
}

function ValidateOption()
{
 var action = document.getElementById('action').value;
 if(action=="UpdateDisplay")
 {
  var total_checked = Number(document.getElementById("total_checked").value);
  if(total_checked < 1)
  {
   document.getElementById('success').innerHTML="";
   document.getElementById('error').innerHTML="Please check atleast one product";  
   return false; 
  }
 }
 if(action=="Update Position")
 {
  if(ShowPositionAlert()==false) return false;
 }
 return true;
}

function AdjustDeleteButton()
{
 var total_data = document.getElementById('total_data').value;
 document.getElementById("error").innerHTML ="";
 var checked_ids=new Array(); 
 var j=0;
 for(var i=1; i <= total_data; i++)
 {
  if(document.getElementById("data"+i) && document.getElementById("data"+i).checked) 
  {
	checked_ids[j]=document.getElementById("data"+i).value;
	j++;
  }
 }
 
 if(checked_ids.length > 0) 
 {
  if(checked_ids.length==1)
  {
   document.getElementById("single_remove").style.display='block';
   document.getElementById("remove_active").style.display='none';
   document.getElementById("remove_inactive").style.display='none';	  
  }
  else
  {
   document.getElementById("remove_active").style.display='block';
   document.getElementById("remove_inactive").style.display='none';
   document.getElementById("single_remove").style.display='none';
  }
 } 
 if(checked_ids.length==0)
 {
  document.getElementById("remove_inactive").style.display='block';
  document.getElementById("remove_active").style.display='none';
  document.getElementById("single_remove").style.display='none';
 } 

 if(checked_ids.length < total_data)
 {
  document.getElementById("remove_all").checked=false;
 }
 if(checked_ids.length == total_data)
 {
  document.getElementById("remove_all").checked=true;
 }
}

function CheckUncheckAll(remove_all, total_data, data)
{
 var total_data = document.getElementById(total_data).value;
 if(document.getElementById(remove_all).checked) 
 {
  for(var i=1; i <= total_data; i++)
  {
   document.getElementById(data+""+i).checked=true;;
  } 
 }
 else
 {
  for(var i=1; i <= total_data; i++)
  {
   document.getElementById(data+""+i).checked=false;;
  } 
 }
}

function DeleteAllMessage(item)
{

 document.getElementById("success").innerHTML="";
  $('html, body').animate({
				scrollTop: $("#error").offset().top
			}, 600); 

 document.getElementById("error").innerHTML="Please check atleast one "+item;
 
}


function ValidateDisplay(idd,max_checked, item)
{
 var total_checked = Number(document.getElementById("total_checked").value);
 document.getElementById('error').innerHTML="";
 if(total_checked==max_checked) 
 {
  if(document.getElementById(idd).checked)
  {
   document.getElementById('success').innerHTML="";
   document.getElementById('error').innerHTML="You can not check more than "+max_checked+" "+item+" to display on home page";
   document.getElementById(idd).checked=false;
   window.scrollTo(0,0);   
  }
  else
  {
   total_checked = total_checked-1;
   document.getElementById("total_checked").value = total_checked;       
  }	
 }
 else
 { 
  if(document.getElementById(idd).checked)
  {
   if(total_checked < max_checked)
   {
    total_checked = total_checked+1;
    document.getElementById("total_checked").value = total_checked;
   }	
  }
  else 
  {
   total_checked = total_checked-1;
   document.getElementById("total_checked").value = total_checked;   
  }
 }
}

function LimitTotalCheck(data_id, max_checked, data_name, error_id, total_checked_id)
{
 var total_checked = Number(document.getElementById(total_checked_id).value);
 document.getElementById(error_id).innerHTML="";
 if(total_checked==max_checked) 
 {
  if(document.getElementById(data_id).checked)
  {
   document.getElementById(error_id).innerHTML="You can not check more than "+max_checked+" "+data_name;
   document.getElementById(data_id).checked=false;
  }
  else
  {
   total_checked = total_checked-1;
   document.getElementById(total_checked_id).value = total_checked;       
  }	
 }
 else
 { 
  if(document.getElementById(data_id).checked)
  {
   if(total_checked < max_checked)
   {
    total_checked = total_checked+1;
    document.getElementById(total_checked_id).value = total_checked;
   }	
  }
  else 
  {
   total_checked = total_checked-1;
   document.getElementById(total_checked_id).value = total_checked;   
  }
 }
}

//check whether or not a radio is checked
function ValidateRadioButton(item_name)
{
 var length = document.getElementsByName(item_name).length;
 for(var i=0; i < length; i++)
 {
  if(document.getElementsByName(item_name)[i].checked==true) return true;
 }
 return false; 
}

//check whether or not a checkbox is checked
function GetTotalCheckedData(total_data,data)
{
 var total_data = document.getElementById(total_data).value;
 var checked = false;
 for(var i=1; i <= total_data; i++)
 {
  if(document.getElementById(data+""+i).checked)
  {
   checked = true;
   break;
  }
 } 
 if(checked==true) return 1;
 else return 0;
}

function ImplodeIds(total_data, data)
{
 var total_data = document.getElementById(total_data).value; 
 var ids=new Array(); 
 var j=0;
 for(var i=1; i <= total_data; i++)
 {
  if(document.getElementById(data+""+i).checked)
  {
   ids[j] = document.getElementById(data+""+i).value;
   j++;
  } 
 }
 return ids;
}


 
/* 9.00 - 5.00 weekadays and 9.00 - 3.00 Saturday */
// CI adding functions

function SubmitModuleForm()
{
 document.getElementById('submodule_dropdown_form').submit();
}
function addslashes (str)
{
 return (str + '').replace(/[\\"']/g, '\\$&').replace(/\u0000/g, '\\0');
}

function ValidateForgotPasswordForm()
{
 document.getElementById('error').innerHTML="";
 var email=document.getElementById('email').value;
 if(email == "")
 {
  document.getElementById('error').innerHTML="Please enter email address";
  return false;
 }
 else if(ValidateEmail(email)==false)
 {
  document.getElementById('error').innerHTML="Please enter valid email address";
  return false;
 }
 else
 { 
  return true;
 }
}

function ValidatePasswordRecoveryForm()
{
 document.getElementById('error').innerHTML="";
 document.getElementById('error1').innerHTML="";
 document.getElementById('error2').innerHTML="";
 var error=false;
 var focus_id="";
 var password=document.getElementById('password').value;
 var confirm_password=document.getElementById('confirm_password').value;
 
  if(password=="") 
  {
   document.getElementById("error1").innerHTML="Please enter password.";
   if(focus_id=="") focus_id="password";
   error = true;
  }
  if(password !="" && password.length < 10)
  {
   document.getElementById("error").innerHTML="Password should not be less than of 10 characters";
   if(focus_id=="") focus_id="password";
   error = true;
  }    
  if(confirm_password=="") 
  {
   document.getElementById("error2").innerHTML="Please enter confirm password.";
   if(focus_id=="") focus_id="confirm_password";  
   error = true;
  }
  if(error==false)
  {
   if(password !="" && confirm_password != "")
   {
    if(password != confirm_password)
    {
     document.getElementById("error").innerHTML="Password and confirm password did not match.";
     if(focus_id=="") focus_id="confirm_password";
     error = true;
    }
   }   
  } 
  if(error == false)
  {
   return true;
  } 
  else
  {
   return false;
  }
}


function ConfirmDelete(item_name, single_delete_permission, parent_id)
{
 var total_data = document.getElementById('total_data').value;
 var deletion_path = document.getElementById('deletion_path').value;
 
 var cat_path = '';
 if(document.getElementById('cat_id')) 
 {
  var cat_id = document.getElementById('cat_id').value;
  var cat_path = '/'+cat_id;
 }

 var checked_ids=new Array(); 
 var j=0;

 for(var i=1; i <= total_data; i++)
 {
  if(document.getElementById("data"+i) && document.getElementById("data"+i).checked) 
  {
   checked_ids[j]=document.getElementById("data"+i).value;
   j++;
  }
 }
 if(checked_ids.length==0)
 {
  $('html, body').animate({
				scrollTop: $("#error").offset().top
			}, 600); 	 
  document.getElementById("error").innerHTML="Please check atleast one "+item_name; 
 }
 var all_ids=checked_ids.join('~');
 
 if(item_name=="level" || item_name == "user")
 {
  width=294;
  height=165;
 }
 else if(item_name=="news" || item_name=="service" || item_name == "brochure_category")
 {
  width=294;
  height=176;
 }
 else if(item_name=="category")
 {
  width=330;
  height=160;
 }
 else
 {
  width=294;
  height=159;
 }

 if(checked_ids.length==1)
 {
  if(single_delete_permission=="yes")	
  { 
   $.prettyPhoto.open(deletion_path+"ConfirmSuperadmin/"+checked_ids+"/"+item_name+"/"+parent_id+cat_path+"&iframe=true&width="+width+"&height="+height);
  }
  else
  {	  
   $.prettyPhoto.open(deletion_path+"ConfirmDelete/"+checked_ids+"/"+item_name+"/"+parent_id+cat_path+"&iframe=true&width=294&height=112");
  }
 } 
 if(checked_ids.length > 1)
 {
  $.prettyPhoto.open(deletion_path+"ConfirmSuperadmin/"+all_ids+"/"+item_name+"/"+parent_id+cat_path+"&iframe=true&width="+width+"&height="+height);
 }   
}

function OpenLeadDetails(file_path, parent_id)
{
 $.prettyPhoto.open(file_path+"/"+parent_id+"&iframe=true&width=650&height=400");
}

function SubmitManageUserForm(path)
{
 window.location=path;
}

function OpenAddImageForm(file_path, parent_id)
{
 $.prettyPhoto.open(file_path+"/"+parent_id+"&iframe=true&width=854&height=550");
}

function OpenEditImageForm(file_path,parent_id,image_id)
{
 $.prettyPhoto.open(file_path+"/"+image_id+"/"+parent_id+"&iframe=true&width=694&height=500");
}

function OpenProductEditImageForm(file_path, image_id, parent_id, cat_id)
{
 $.prettyPhoto.open(file_path+"/"+image_id+"/"+parent_id+"/"+cat_id+"&iframe=true&width=694&height=450");
}

function OpenProductEditBrochureForm(file_path, brochure_id, parent_id, cat_id)
{
 $.prettyPhoto.open(file_path+"/"+brochure_id+"/"+parent_id+'/'+cat_id+"&iframe=true&width=694&height=312");
}


function OpenAddBrochureForm(file_path,parent_id)
{
 $.prettyPhoto.open(file_path+"/"+parent_id+"&iframe=true&width=854&height=550");
}


function OpenEditBrochureForm(file_path,parent_id,image_id)
{
 $.prettyPhoto.open(file_path+"/"+image_id+"/"+parent_id+"&iframe=true&width=694&height=312");
}

function SubmitManageImageForm(file)
{
 window.location=file;
}
function ValidateImageForm()
{
 var errors=new Array("error1","error2","error3");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(($("#submit_value").val()=="Submit") && ($("#image_file").val()=="")) 
 {
  errorFields[e]=new Array("error3","Please browse to upload image","image_file");
  e++;
 }else RemoveError("image_file");
 return ShowErrorOnField(errorFields);
}
function ValidateBrochureForm()
{
 var errors=new Array("error1","error2","error3");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#brochure_title").val())=="") 
 {
  errorFields[e]=new Array("error2","Please enter title","brochure_title");
  e++;
 }else RemoveError("brochure_title");

 if(($("#submit_value").val()=="Submit") && ($("#brochure_file").val()=="")) 
 {
  errorFields[e]=new Array("error3","Please select file","brochure_file");
  e++;
 }else RemoveError("brochure_file");
 return ShowErrorOnField(errorFields);
}


// CKEditor Validator Function
function ValidateCkeditorFieldValue(field_value,field_name)
{
 var container_id="cke_"+field_name;
 if(ValidateCkeditorValue(field_value))
 {
  $("#"+container_id).css("border","thin solid orange");
  return true;
 }
 else
 {
  $("#"+container_id).css("border","");
  return false
 }
}

function ValidateCkeditorValue(field_value)
{
 //field_value=$.trim(field_value.replace(/<[^>]*>|\s/g, ''));	
 var vArray = new Array();
 vArray = field_value.split("&nbsp;");
 var vFlag = 0;
 for(var i=0;i<vArray.length;i++)
 {
  if(vArray[i] == '' || vArray[i] == "")
  {
  continue;
  }
  else
  {
   vFlag = 1;
   break;
  }
 }
 if(vFlag == 0)
 {
  return true;
 }
 else
 {
  return false;
 }
}

function MakeValueEmpty(array_values)
{
 var array_length=array_values.length;
 if(array_length > 0)
 {
  for(var i=0;i<array_length;i++)
  {
   $("#"+array_values[i]).html('');
  }
 }
}
function ShowErrorOnField(errorFields)
{
 if(errorFields.length > 0)
 {	
  var first; 
  $.each(errorFields,function(key,value){
  if(key == 0)
  {
   $('html, body').animate({
				scrollTop: $("#"+value[0]).offset().top
			}, 600); 
  }
  $("#"+value[0]).html(value[1]);
  $("#"+value[2]).addClass('field_error'); 
  })
  return false;
 }
 else
 {
  return true;
 }
}
function RemoveError(field_name)
{
 $("#"+field_name).removeClass('field_error')
}

function OpenProjectEditImageForm(file_path, image_id, parent_id)
{
 $.prettyPhoto.open(file_path+"/"+image_id+"/"+parent_id+"&iframe=true&width=694&height=450");
}
