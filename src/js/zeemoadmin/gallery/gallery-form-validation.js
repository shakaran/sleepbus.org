function ValidateCategoryForm()
{
 document.getElementById("error").innerHTML="";
 document.getElementById("error1").innerHTML="";  
 var error=false;
 var focus_id="";
 if(trim(document.getElementById("category_name").value)=="") 
 {
  document.getElementById("error1").innerHTML="Please enter category name";
  if(focus_id=="") focus_id="category_name";
  error=true;
 }
 if(error == true)
 {
  document.getElementById(focus_id).focus();
  return false;
 }
 else
 {
  return true;
 }
}
function ValidateProductForm()
{
 document.getElementById("error").innerHTML="";
 document.getElementById("error1").innerHTML="";  
 document.getElementById("error2").innerHTML="";
 document.getElementById("error3").innerHTML="";  
 document.getElementById("error4").innerHTML="";
 document.getElementById("error5").innerHTML="";  
 document.getElementById("error6").innerHTML="";
 document.getElementById("error7").innerHTML="";  
 document.getElementById("error8").innerHTML="";
 document.getElementById("error9").innerHTML="";  
 var error=false;
 var focus_id="";
 if(trim(document.getElementById("cat_id").value)=="") 
 {
  document.getElementById("error1").innerHTML="Please select category";
  if(focus_id=="") focus_id="cat_id";
  error=true;
 }
 if(trim(document.getElementById("product_title").value)=="") 
 {
  document.getElementById("error2").innerHTML="Please enter art title";
  if(focus_id=="") focus_id="product_title";
  error=true;
 }
 if(document.getElementById('submit_form').value == "Submit")
 {
  if(trim(document.getElementById("image_file").value)=="") 
  {
   document.getElementById("error8").innerHTML="Please uplaod an image";
   if(focus_id=="") focus_id="image_file";
   error=true;
  }
 }
 if(FCKeditorAPI.GetInstance('content').GetHTML(true)=="") 
 {
  document.getElementById('error9').innerHTML="Please enter content.";
  if(focus_id=="") focus_id="content";
  error=true;
 }
 if(error == true)
 {
  document.getElementById(focus_id).focus();
  return false;
 }
 else
 {
  return true;
 } 
}
function SetDisplayOnHomePage(category_id,path)
{
 document.getElementById('error').innerHTML="";
 var total_data=document.getElementById('total_data').value;
 var checked_ids_str;
 var checked_ids=new Array();
 j=0;
 for(i=0;i< Number(total_data);i++)
 {
  if(document.getElementById('displayed_on_home_page'+(i+1)).checked == true)
  {	 
   checked_ids[j]=document.getElementById('displayed_on_home_page'+(i+1)).value;
   j++;
  }
 }
 if(checked_ids.length == 0)
 {
  window.location=path+admin+"/gallery/SetDisplayedOnHomePage/"+category_id;
 }
 else
 {
  checked_ids_str=checked_ids.join("~");
  window.location=path+admin+"/gallery/SetDisplayedOnHomePage/"+category_id+"/"+checked_ids_str;
 }
}