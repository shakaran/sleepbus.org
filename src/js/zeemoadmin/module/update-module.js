  $(document).ready(function() { 	 
   $("#option1").click(function() 
   {
    document.getElementById('show_error').innerHTML="";
    var path=document.frm.path.value;
    var parent_id=document.frm.parent_id.value;
    var module_id=document.frm.module_id.value;
    var module_name=document.getElementById('module_name').value;
    if(trim(module_name) == "")
    {
     document.getElementById('show_error').innerHTML="Please enter module name";
     document.getElementById('module_name').focus();
     return false;
    }
	else
	{
 	 var param = {module_name:module_name,module_id:module_id,parent_id:parent_id};
	  // you can send multiple     argument as {cp:cp,name:name}
    
	 $.ajax({
  	 url: path+admin+'/modules/checkDuplicate',
	 type:'POST', // You may use GET method also
   	 data: param, 
  	 success: function(result) {
     if(result == 'duplicate')
	 {
	   $('#show_error').text('This name already exists');
	   carry=false;
	 }
	 else
	 {
	  parent.location=path+admin+"/modules/Update/"+parent_id;
	 }
   	} 
   });	 
  } 
 });
	
});
 

function OpenAddModule(file_path)
{
 $.prettyPhoto.open(file_path+"&iframe=true&width=720&height=500");
}
function OpenAddSubModule(file_path)
{
 $.prettyPhoto.open(file_path+"&iframe=true&width=720&height=250");
}
function ValidateModuleForm()
{
 var errors=new Array("error1","error2","error3","error4","error5");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#module_name").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter module name","module_name");
  e++;
 }else RemoveError("module_name");
 if(trim($("#url").val())=="") 
 {
  errorFields[e]=new Array("error2","Please enter URL","url");
  e++;
 } else RemoveError("url");
 
 if($("#submit_value").val()=="Submit")
 {
  if($("#home_page_icon").val()=="")
  {
   errorFields[e]=new Array("error3","Please browse to upload image","home_page_icon");
   e++;
  }else RemoveError("home_page_icon");
  if($("#header_icon").val()=="")
  {
   errorFields[e]=new Array("error4","Please browse to upload image","header_icon");
   e++;
  }else RemoveError("header_icon");
  if($("#left_menu_icon").val()=="")
  {
   errorFields[e]=new Array("error5","Please browse to upload image","left_menu_icon");
   e++;
  }else RemoveError("left_menu_icon");
 }
 return ShowErrorOnField(errorFields);
}

function ValidateSubModuleForm()
{
 var errors=new Array("error1","error2");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#module_name").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter submodule name","module_name");
  e++;
 }else RemoveError("module_name");
 if(trim($("#url").val())=="") 
 {
  errorFields[e]=new Array("error2","Please enter URL","url");
  e++;
 } else RemoveError("url");
 
 return ShowErrorOnField(errorFields);
}





 
