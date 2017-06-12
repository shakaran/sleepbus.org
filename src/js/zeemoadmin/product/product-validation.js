function ValidateCategoryForm()
{
 var errors=new Array("error","error1","error2","error3");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#category_name").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter category name","category_name");
  e++;
 }else RemoveError("category_name");
 if(trim($("#description").val())=="")
 {
  errorFields[e]=new Array("error2","Please enter description","description");
  e++;
 }else RemoveError("description");
 return ShowErrorOnField(errorFields);
}

function UpdateMainImage(url)
{
 window.location=url;
}


function ValidateProductForm()
{
 var errors=new Array("error","error1","error2","error3");	
 var errorFields=new Array(),e=0;
 MakeValueEmpty(errors);
 if(trim($("#product_name").val())=="") 
 {
  errorFields[e]=new Array("error1","Please enter product name","product_name");
  e++;
 }else RemoveError("product_name");
 if(trim($("#intro_text").val())=="")
 {
  errorFields[e]=new Array("error2","Please enter intro text","intro_text");
  e++;
 }else RemoveError("intro_text");
 if(ValidateCkeditorFieldValue(CKEDITOR.instances.description.getData(),'description'))
 {
  errorFields[e]=new Array("error3","Please enter description","cke_description");
 }
 return ShowErrorOnField(errorFields);
}

function UpdateMainImage(url)
{
 window.location=url;
}

function ValidateCopyMoveProducts()
{
 document.getElementById("error").innerHTML="";
 document.getElementById("error1").innerHTML="";  
 document.getElementById("error2").innerHTML="";  
 document.getElementById("error3").innerHTML="";  

 var error=false;
 var focus_id="";

 if(trim(document.getElementById("scid").value)== 0) 
 {
  document.getElementById("error1").innerHTML = "Please select source category";
  error=true;
 }

 if(trim(document.getElementById("dcid").value)== 0) 
 {
  document.getElementById("error2").innerHTML = "Please select destination category";
  error=true;
 }

 if(trim(document.getElementById("option").value)=="") 
 {
  document.getElementById("error3").innerHTML = "Please select action";
  error=true;
 }
 var scid = document.getElementById('scid').value;
 var dcid = document.getElementById('dcid').value;
 if(scid != 0 && dcid != 0)
 {
  if(scid==dcid)
  {
   document.getElementById("error").innerHTML = "Source and destination category can not be same";
   error = true;
  }
 }

 var total_products = document.copy_move_frm.total_products.value;
 var checked = false;
 if(total_products > 0)
 {
  for(i=1; i <= total_products; i++)
  {
   if(document.getElementById('product_'+i).checked) 
   {
    checked = true;	 
    break;
   }
  }
  if(checked==false)
  { 
   document.getElementById("error4").innerHTML = "Please select at least one product";
   error=true;
  }
 }
 else error=true;

 if(error==true) return false;
}

function OpenAddProductForm(file_path,cat_id,depth)
{
 $.prettyPhoto.open(file_path+admin+"/products/AddProductForm/"+cat_id+"/"+depth+"&iframe=true&width=920&height=590");
}
function OpenEditProductForm(file_path,product_id,cat_id,depth)
{
 $.prettyPhoto.open(file_path+admin+"/products/edit-product/"+product_id+"/"+cat_id+"/"+depth+"&iframe=true&width=920&height=590");
}
