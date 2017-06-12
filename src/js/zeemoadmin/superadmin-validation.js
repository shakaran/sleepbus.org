  $(document).ready(function() { 	 
   $("#option1").click(function() 
   {
    document.getElementById('show_error').innerHTML="";
    var path=document.frm.path.value;
    var checked_ids=document.frm.checked_ids.value;
    var item_name=document.frm.item_name.value;
    var location=document.frm.location.value;
    var parent_id=document.frm.parent_id.value;	

	var cat_id = '';
	if(document.frm.cat_id)	var cat_id = document.frm.cat_id.value;
	
    var superadmin=document.getElementById('superadmin').value;
    if(trim(superadmin) == "")
    {
     document.getElementById('show_error').innerHTML="Invalid password";
     document.getElementById('superadmin').focus();
     return false;
    }
	else
	{
 	 var param = {superadmin:superadmin};
	 // you can send multiple argument as {cp:cp,name:name}
    
	 $.ajax({
  	 url: path+admin+'/home/validateSuperadminPassword',
	 type:'POST', // You may use GET method also
   	 data: param, 
  	 success: function(result) {

     if(result == false)
	 {
	   $('#show_error').text('Invalid Password');
	   carry=false;
	 }
	 else
	 {
	  // if you have custom attribute then you can change the parent.location using if and else statement with item name
	  if(cat_id=='') parent.location=path+admin+"/"+location+"DeleteRecord/"+checked_ids+"/"+item_name+"/"+parent_id;
	  else parent.location=path+admin+"/"+location+"DeleteRecord/"+checked_ids+"/"+item_name+"/"+parent_id+'/'+cat_id;
	 }
   	} 
   });	 
  } 
 });
});