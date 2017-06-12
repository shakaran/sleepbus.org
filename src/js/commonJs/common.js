function trim(str)
{ 
 return(str.replace(/^\s+|\s+$/g, '')); 
}

function ValidateSearchForm()
{
 var search_text=document.getElementById('search_text').value;
 if(trim(search_text)=='')
 {
  alert('Please enter search text');	 
  return false;
 }
 else
 {
  var path=$("#path").val();	 
  window.location=path+"search?key="+search_text;
  return false;
 }
}

function SendSearchInfo(path,cp,ppr,key)
{
 
 var param={cp:cp,ppr:ppr,key:key};
 $.ajax({
	 url:path+'search/SearchPaging',
	 type:'POST',
	 data:param,
	 success:function(result){
		 $('#search_content').html(result);
         $('html, body').animate({scrollTop:$(".top_search_page").offset().top},1000);
	 }
   });
}
function ValidateSearchPageForm()
{
 var search_text=document.getElementById('search_page_text').value;
 if(trim(search_text)=='')
 {
  alert('Please enter search text');	 
  return false;
 }
 else
 {
  var path=$("#path").val();	 
  window.location=path+"search?key="+search_text;
  return false;
 }
}

function downloads(base_url,brochue_id)
{
 document.location.href=base_url+"Downloads/"+brochue_id;
}
function ValidateMessageText(message)
{
 if(message!='')
 {
  var pattern=/^([a-zA-Z0-9_.-]|[\s]|[,]|[\?])+$/;
  if(!pattern.test(message))
  {
   return false;
  }
  else return true;
  }
 }
function ValidateNameText(name)
{
 if(name!='')
 {
  var pattern=/^([a-zA-Z]|[\s])+$/;
  if(!pattern.test(name))
  {
   return false;
  }
  else return true;
  }
 }
function ValidateNewsLetterForm()
{
 var field_values= new Array(),error_count=0,error_value,focus_field;
 //$("div #all_error").remove();
 $("div #errorDiv").remove();
 $("div #error").remove();	 
 field_values[0]=new Array($.trim($("#newsletter_name").val()),'newsletter_name','Please enter your name','Name');

 field_values[1]=new Array($.trim($("#newsletter_email").val()),'newsletter_email','Please enter email address','Email');
 
 $.each(field_values,function(key,value){
 if(value[0] == "" || value[0] == value[3])
  {
   //$("#"+value[1]).addClass('field_error');
   if(error_count == 0){ error_value=value[2]; focus_field=value[1];}
   error_count++;
  }
  else if(value[1] == "newsletter_email" && (ValidateEmail(value[0])==false))
  {
   $("#"+value[1]).addClass('field_error');	   
   if(error_count == 0) {error_value="Please enter valid email address"; focus_field=value[1];}
   error_count++;
  }
 })
 if(error_count > 0)
 {
  var header_height=$("div#header-band").height()+100;	 
  //var header_height=20;	 
  $('html, body').animate({scrollTop: $("#form-block").offset().top-header_height}, 600); 
  var errorDiv=$("<div />",{"class":"has-error","text":error_value,"id":"error"})	 
  $("div #form-block").prepend(errorDiv);
  $("#"+focus_field).focus();
  return false;
 }
 else return true;

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
$(".toptext").click(function(){
	 $(this).slideUp();
	})