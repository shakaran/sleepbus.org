ValidateAccountSignupForm = function()

{

 var field_values= new Array(),error_count=0,error_value,focus_field;

 $("div #errorDiv").remove();

 $("div #error").remove();

 field_values[0]=new Array($.trim($("#full_name").val()),'full_name','Please enter your name','Enter your full name');

 field_values[1]=new Array($.trim($("#email").val()),'email','Please enter email address','Enter your email');



 field_values[2]=new Array($.trim($("#password").val()),'password','Please enter your password','Enter a password');

 

 

 field_values[3]=new Array($.trim($("#account_type").val()),'account_type',"Please select account type");



 var other_type=$.trim($("#other_type").val());

 



 $.each(field_values,function(key,value){





 if((value[0] == "" || value[0] == value[3]))

  {

   $("#"+value[1]).addClass('field_error');

   if(error_count == 0){ error_value=value[2]; focus_field=value[1];}

   error_count++;

  }

  else if(value[1] == "email" && (ValidateEmail(value[0])==false))

  {

   if(error_count == 0) {error_value="Please enter valid email address"; focus_field=value[1];}

   error_count++;

  }

  else if(value[1] == "password" && (value[0].length < 6))

  {

   if(error_count == 0) {error_value="Length of password must be of 6 or more characters"; focus_field=value[1];}

   error_count++;

  }

  

  else if(((value[1] == "account_type")  && (value[0] == "other")) && ((other_type == "") || (other_type=="Other = Please specify")))

  {

   if(error_count == 0){ error_value="Please specify your other type"; focus_field='other_type';}

   error_count++;

   value[1]="other_type";

  }

  else

  {

   $("#"+value[1]).removeClass('field_error');

  }

 })

 

/* if(document.getElementById('agree').checked == false)

 {

  $("#agree").addClass('field_error');

  if(error_count == 0){ error_value="Please check the consent of your age"; focus_field='agree';}

  error_count++;

 }

 else

 {

  $("#agree").removeClass('field_error');

 }
*/
 

 if(error_count > 0)

 {

  var header_height=$("div#header-band").height()+100;	 

  //var header_height=20;	 

  $('html, body').animate({scrollTop: $("#signupfrom").offset().top-header_height}, 600); 

  var errorDiv=$("<div />",{"class":"has-error","text":error_value,"id":"error"})	 

  $("div #signupfrom").prepend(errorDiv);

  $("#"+focus_field).focus();

  return false;

 }

 else return true;

}

$("#toggle-view").click(function(){

	 if($(this).text() == "Show")

	 {

	  document.getElementById("password").type='text';

	  $(this).text('Hide');

	 }

	 else

	 {

	  document.getElementById("password").type='password';

	  $(this).text('Show');

	 }

	 

	})

$("#account_type").change(function(){

	if($(this).val() == 'other')

	{

	 $("#other_access").show();

	}

	else

	{

	 $("#other_access").hide();

	}

	})