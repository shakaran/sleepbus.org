  $(document).ready(function() { 	
   $("#check_all").click(function() 
   {
	if(document.getElementById('check_all').checked == true)
	{
	 $(".level_check_box").attr("checked",true);
	 document.getElementById('checked_box').value=document.getElementById('total_checkbox').value
	}
	if(document.getElementById('check_all').checked == false)
	{
	 $(".level_check_box").attr("checked",false);
	 document.getElementById('checked_box').value=0;
	}  
   });
 });
 function UncheckAll(checked_id)
 {
  if(document.getElementById(checked_id).checked == false)
  {
   document.getElementById('check_all').checked=false;
   document.getElementById('checked_box').value=Number(document.getElementById('checked_box').value)-1;
  }
  else
  {
   document.getElementById('checked_box').value=Number(document.getElementById('checked_box').value)+1;
  }
  CheckAll(document.getElementById('checked_box').value);
 }
 function CheckUncheckSubmodule(module_id)
 {
  var total_submodule=document.getElementById('total_submodule_'+module_id).value;
  if(document.getElementById('module_checkbox_'+module_id).checked == true)
  {
   for(i=0;i<total_submodule;i++)
   {
    document.getElementById('submodule_checkbox_'+module_id+'_'+i).checked=true;
    document.getElementById('checked_box').value=Number(document.getElementById('checked_box').value)+1;
   }
  }
  else
  {
   for(i=0;i<total_submodule;i++)
   {
	if(document.getElementById('submodule_checkbox_'+module_id+'_'+i).checked == true)
	{
 	 document.getElementById('checked_box').value=Number(document.getElementById('checked_box').value)-1;
	}
    document.getElementById('submodule_checkbox_'+module_id+'_'+i).checked=false;
   }
  }
  CheckAll(document.getElementById('checked_box').value);
 }

function CheckUncheckModule(module_id,submodule_id,checkbox_id)
{
 if(document.getElementById(checkbox_id).checked == true)
 {
  if(document.getElementById('module_checkbox_'+module_id).checked == false)
  {
   document.getElementById('module_checkbox_'+module_id).checked=true;
   document.getElementById('checked_box').value=Number(document.getElementById('checked_box').value)+1;
  }
 }
 else
 {
  document.getElementById('checked_box').value=Number(document.getElementById('checked_box').value)-1;	 
  var total_submodule=document.getElementById('total_submodule_'+module_id).value;
  var unchecked_sub=0;
  for(i=0;i<total_submodule;i++)
  {
   if(document.getElementById('submodule_checkbox_'+module_id+'_'+i).checked==true)
   {
    document.getElementById('module_checkbox_'+module_id).checked=true;
    document.getElementById('checked_box').value=Number(document.getElementById('checked_box').value)+1;	
    break;
   }
   else
   {
    unchecked_sub++;
   }
  }
  if(unchecked_sub == total_submodule)
  {
   document.getElementById('module_checkbox_'+module_id).checked=false;
   //document.getElementById('checked_box').value=Number(document.getElementById('checked_box').value)-1;
  }
 }
 CheckAll(document.getElementById('checked_box').value);
}
function CheckAll(checked_box)
{
 var total_checkbox=document.getElementById('total_checkbox').value;
 if(Number(checked_box) == Number(total_checkbox))
 {
  document.getElementById('check_all').checked=true;
 }
}
function ValidateLevelForm()
{
 var errors=new Array("name_error","checked_box_error");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#level_name").val())== "") 
 {
  errorFields[e]=new Array("name_error","Please enter level name","level_name");
  e++;
 }else RemoveError("level_name");
 if(trim($("#checked_box").val())==0) 
 {
  errorFields[e]=new Array("checked_box_error","Please check at least one module / submodule","check_box_field");
  e++;
 }else RemoveError("check_box_field");

 return ShowErrorOnField(errorFields);
}






 
