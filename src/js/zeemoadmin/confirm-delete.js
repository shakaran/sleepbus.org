  $(document).ready(function() { 	 
   $("#option1").click(function() 
   {
    var path = document.frm.path.value;
    var checked_ids = document.frm.checked_ids.value;
    var item_name = document.frm.item_name.value;
    var location = document.frm.location.value;
    var parent_id = document.frm.parent_id.value;
	
	var cat_id = '';
	if(document.frm.cat_id)	var cat_id = document.frm.cat_id.value;

    // if you have custom attribute then you can change the parent.location using if and else statement with item name
	if(cat_id=='') parent.location=path+admin+"/"+location+"DeleteRecord/"+checked_ids+"/"+item_name+"/"+parent_id;
	else parent.location=path+admin+"/"+location+"DeleteRecord/"+checked_ids+"/"+item_name+"/"+parent_id+'/'+cat_id;
   });	 
  }); 

	

 










 
